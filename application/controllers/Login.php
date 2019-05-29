<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/12/19
 * Time: 4:47 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct ()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
    }
    public function index()
    {
        if(!$this->session->userdata('logged_in')) {
            $data['title'] = 'नवचैतन्य गेटवे';
        }else{
            $data['title'] = 'डॅशबोर्ड ';
        }
        $this->load->view('header',$data);
        $this->load->view('footer',$data);

    }

    public  function  verifylogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if($username!=null || $password!=null || $this->session->userdata('logged_in')){
            if($this->session->userdata('logged_in'))
            { 
                $username=$this->session->userdata('logged_in');
            
            }
            else{
                $data['user_name'] = $username;
            }
          
            $this->session->set_userdata('logged_in', $username);
            redirect('dashboard');
        }

        else{
            redirect('login');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        redirect('login');
    }
}