<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 6/15/19
 * Time: 7:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model("sms_model");
    }
    public function sms(){
        if($this->session->userdata('logged_in')) {
            $data['title'] = 'SMS Setting';
            $data['did'] = null;
            $data['user_name']=$this->session->userdata('logged_in');
            $data['result']=$this->sms_model->getContent();
            $this->load->view('header', $data);
            $this->load->view('sms_setting', $data);
            $this->load->view('footer', $data);
        }else{
            redirect('login');
        }

    }
    public function access(){
        if($this->session->userdata('logged_in')) {
            $data['title'] = 'Access Setting';
            $data['did'] = null;
            $data['user_name']=$this->session->userdata('logged_in');
            $data['result']=$this->access_setting->getSettings();
            $this->load->view('header', $data);
            $this->load->view('access_setting', $data);
            $this->load->view('footer', $data);
        }else{
            redirect('login');
        }
    }
    public function update(){

    }

}