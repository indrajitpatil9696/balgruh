<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/27/19
 * Time: 11:40 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Marks extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model("marks_model");
        $this->load->model("student_model");

    }

    function index(){
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data['csrf'] = $csrf;
        if($this->session->userdata('logged_in')) {
            $data['title'] = 'प्रवेशित मार्कलिस्ट';
            $data['user_name']=$this->session->userdata('logged_in');
            $data['result']=$this->student_model->student_list();

            $this->load->view('header',$data);
            $this->load->view('marks_list',$data);
            $this->load->view('footer',$data);}
      else{
            redirect('login');
      }
    }

    function new($sid = null){
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data['csrf'] = $csrf;
        if(!empty($sid)){
            if($this->session->userdata('logged_in')) {
                $data['title'] = 'प्रवेशित मार्कलिस्ट नोंद';
                $data['user_name']=$this->session->userdata('logged_in');
                $data['sid']=$sid;
                $data['result']=$this->marks_model->student_marks_list($sid);
                $data['student']=$this->student_model->student_list($sid);

                $this->load->view('header',$data);
                $this->load->view('fill_marklist',$data);
                $this->load->view('footer',$data);}
            else{
                redirect('login');
            }
        }
    }

    function save($sid=null){
        if($this->marks_model->student_marks_save($sid)){
            redirect('marks/new/'.$sid);
        }
    }
    function delete($mid=null,$sid=null){
        if($this->marks_model->student_marks_delete($mid)){
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>माहिती यशस्वीरित्या डिलीट झाली...!</div>");
            redirect('marks/new/'.$sid);
        }
    }
}