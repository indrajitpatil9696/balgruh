<?php
/*
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/18/19
 * Time: 6:21 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model("student_model");
    }
    public function index()
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );


        if($this->session->userdata('logged_in')) {
            $data['title'] = 'प्रवेशित माहिती';
            $data['user_name']=$this->session->userdata('logged_in');
            $data['result']=$this->student_model->student_list();
            $data['csrf'] = $csrf;
            $this->load->view('header', $data);
            $this->load->view('student_list', $data);
            $this->load->view('footer', $data);
        }else{
            redirect('login');
        }
    }
    public function edit($id = null)
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data['csrf'] = $csrf;
        if($this->session->userdata('logged_in')) {
            if(!empty($id)){
                $data['title'] = 'डॅशबोर्ड | माहिती बदल';
                $data['sid'] = $id;
                $data['result']=$this->student_model->student_list($id);
            }
            else{
                $data['title'] = 'डॅशबोर्ड | नवीन प्रवेशित';
                $data['sid'] = null;
            }

            $data['groups']=$this->student_model->student_group_list();
            $data['user_name']=$this->session->userdata('logged_in');
            $this->load->view('header', $data);
            $this->load->view('newstudent', $data);
            $this->load->view('footer', $data);
        }else{
            redirect('login');
        }

    }
    public function save($id = null)
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data['csrf'] = $csrf;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('sgid', 'Status', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
            redirect('student/edit/'.$id);
        }
        else {
            if($this->student_model->student_save($id)){
                if(empty($id)) {
                    $this->session->set_flashdata('message', "<div class='alert alert-success'>माहिती यशस्वीरित्या सेव झाली...!</div>");
                }
                else {
                    $this->session->set_flashdata('message', "<div class='alert alert-success'>माहिती यशस्वीरित्या अपडेट  झाली...!</div>");

                }
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>सेव करताना व्यत्यय </div>");

            }
            redirect('student/edit/');
        }
    }

    public function view($id = null){

        if($this->session->userdata('logged_in')) {
        $data['title'] = 'डॅशबोर्ड | प्रवेशित माहिती';
        $data['sid'] = $id;
        $data['result']=$this->student_model->student_list($id);
        $data['marks']=$this->student_model->student_marks_list($id);
        $data['mudatvadh']=$this->student_model->student_mudatvadh_list($id);
        $data['groups']=$this->student_model->student_group_list();
        $data['user_name']=$this->session->userdata('logged_in');

        $this->load->view('header', $data);
        $this->load->view('stud_view', $data);
        $this->load->view('footer', $data);}
        else{
            redirect('login');
        }
    }
    public function delete($id = null){
        if($this->student_model->delete($id)){
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>माहिती यशस्वीरित्या डिलीट झाली...!</div>");
            redirect('student');
        }
        else{
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>सेव करताना व्यत्यय </div>");
            redirect('student');
        }
    }
    public function import()
    {
        if($this->session->userdata('logged_in')) {
            $data['action'] = 'student';
            $data['title'] = 'प्रवेशित CSV इम्पोर्ट';
            $this->load->view('header', $data);
            $this->load->view('file_uploader', $data);
            $this->load->view('footer', $data);
        }
        else{
            redirect('login');
        }
    }
    public function report(){
        if($this->session->userdata('logged_in')) {
            $data['title'] = 'प्रवेशित रिपोर्ट';
            $data['report']='student';
            $this->load->view('header', $data);
            $this->load->view('reporter', $data);
            $this->load->view('footer', $data);
        }
        else{
            redirect('login');
        }

    }
    public function export($reportname=null)
    {

        if ($this->session->userdata('logged_in')) {
            $data['action'] = 'student';
            $data['title'] = $this->getName($reportname);
            $data['report_name'] = $reportname;
            $this->load->view('header', $data);
            $this->load->model('report_model');
            $this->load->view('report_generate', $data);
            $this->load->view('footer', $data);
        } else {
            redirect('login');
        }
    }
    function getName($report){
        $names = array(
          'presentabsent'=>'प्रवेशित गैर-हजर/ताब्यात यादी रिपोर्ट',
          'mudatvadh'=>'प्रवेशित मुदतवाढ रिपोर्ट',
          'age'=>'प्रवेशित वयानुसार रिपोर्ट',
          'marklist'=>'प्रवेशित मार्कलिस्ट रिपोर्ट',
          'list'=>'प्रवेशित यादी रिपोर्ट',
          'profile'=>'प्रवेशित प्रोफाईल लिस्ट रिपोर्ट',
        );

        return $names[$report];
    }
    function getReport($report_name = null){
        $data = $this->input->post();
        $report = array(
            "result" => '<h1>HELLO</h1>'
        );

        echo json_encode($report,true);
    }
}