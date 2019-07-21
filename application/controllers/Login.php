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
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        if(!$this->session->userdata('logged_in')) {
            $data['title'] = 'नवचैतन्य गेटवे';
        }else{
            $data['title'] = 'डॅशबोर्ड ';
        }
        $data['csrf'] = $csrf;
        $query = $this->db->get('launch');
        $data['launch'] = $query->result_array();

        $this->load->view('header',$data);
        $this->load->view('footer',$data);

    }
public function launch(){
        $data['status'] = 1;
        $this->db->where('launch.status','0');
    $this->db->update('launch',$data);
        redirect('login');
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