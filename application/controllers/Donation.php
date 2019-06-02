<?php
/*
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/18/19
 * Time: 6:21 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model("donation_model");

    }
    public function index()
    {
        if($this->session->userdata('logged_in')) {
            $data['title'] = 'देणगी माहिती';
            $data['did'] = null;
            $data['user_name']=$this->session->userdata('logged_in');
            $data['result']=$this->donation_model->donation_list(null);
            $this->load->view('header', $data);
            $this->load->view('fill_donationlist', $data);
            $this->load->view('footer', $data);
        }else{
            redirect('login');
        }
    }

    public function save($did = null)
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('dname', 'Donor Name', 'required');
        $this->form_validation->set_rules('contact_no', 'Contact Number', 'required');
        $this->form_validation->set_rules('receipt_no', 'Receipt Number', 'required');
        $this->form_validation->set_rules('donation', 'Donation Details', 'required');
        $this->form_validation->set_rules('receiptor', 'Receipt Number', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
            redirect('donation');
        }
        else {
            if ($this->donation_model->donation_save()) {
                $this->session->set_flashdata('message', "<div class='alert alert-success'>माहिती यशस्वीरित्या अपडेट  झाली...!</div>");

            } else {
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>सेव करताना व्यत्यय </div>");

            }
        }
            redirect('donation');

    }

    public function view($did = null){
        if($this->session->userdata('logged_in')) {
        $data['title'] = 'डॅशबोर्ड | प्रवेशित माहिती';
        $data['did'] = $did;
        $data['result']=$this->donation_model->donation_list($did);
        $data['user_name']=$this->session->userdata('logged_in');

        $this->load->view('header', $data);
        $this->load->view('donation_view', $data);
        $this->load->view('footer', $data);}
        else{
            redirect('login');
        }
    }
    public function delete($id = null){
        if($this->donation_model->delete($id)){
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>माहिती यशस्वीरित्या डिलीट झाली...!</div>");
            redirect('donation');
        }
        else{
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>सेव करताना व्यत्यय </div>");
            redirect('donation');
        }
    }

}