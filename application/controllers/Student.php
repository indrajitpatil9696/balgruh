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
        if($this->session->userdata('logged_in')) {
            $data['title'] = 'प्रवेशित माहिती';
            $data['user_name']=$this->session->userdata('logged_in');
            $data['result']=$this->student_model->student_list();
            $this->load->view('header', $data);
            $this->load->view('student_list', $data);
            $this->load->view('footer', $data);
        }else{
            redirect('login');
        }
    }
    public function edit($id = null)
    {

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
}