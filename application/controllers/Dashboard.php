<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/18/19
 * Time: 6:21 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
            $data['title'] = 'डॅशबोर्ड';
            $data['user_name']=$this->session->userdata('logged_in');
            $this->load->view('header', $data);
            $this->load->view('dashboard', $data);
            $this->load->view('footer', $data);
        }else{
            redirect('login');
        }
    }
    public function newStudent()
    {

    }
}