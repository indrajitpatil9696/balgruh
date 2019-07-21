<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/27/19
 * Time: 11:40 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mudatvadh extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model("student_model");

    }

    function index(){
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data['csrf'] = $csrf;
        if($this->session->userdata('logged_in')) {
            $data['title'] = 'प्रवेशित मुदतवाढ';
            $data['user_name']=$this->session->userdata('logged_in');
            $data['result']=$this->student_model->student_list();

            $this->load->view('header',$data);
            $this->load->view('mudatvadh_list',$data);
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
                $data['title'] = 'प्रवेशित मुदतवाढ नोंद';
                $data['user_name']=$this->session->userdata('logged_in');
                $data['sid']=$sid;
                $data['result']=$this->student_model->student_mudatvadh_list($sid);
                $data['student']=$this->student_model->student_list($sid);

                $this->load->view('header',$data);
                $this->load->view('fill_mudatlist',$data);
                $this->load->view('footer',$data);}
            else{
                redirect('login');
            }
        }
    }

    function save($sid=null){
        if($this->student_model->student_mudatvadh_save($sid)){
            redirect('mudatvadh/new/'.$sid);
        }
    }
    function delete($mid=null,$sid=null){
        if($this->student_model->student_marks_delete($mid)){
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>माहिती यशस्वीरित्या डिलीट झाली...!</div>");
            redirect('mudatvadh/new/'.$sid);
        }
    }
}