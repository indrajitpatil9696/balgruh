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
        $this->load->helper('sms_helper');
        $this->load->model("donation_model");

    }
    public function index()
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data['csrf'] = $csrf;

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
                $flash_message="<div class='alert alert-success'>माहिती सेव झाली...!</div>";
                $reciever = $this->input->post('contact_no');
                $donor_name = $this->input->post('dname');
                if($this->input->post('sendsms')==1) {
                    $this->db->where('sms_table.status',1);
                    $this->db->where('sms_table.type',1);
                    $query = $this->db->get('sms_table');
                    $sms = $query->result_array();
                    if(count($sms)>0) {
                        $message = $donor_name . ' ' .$sms[0]['sms_content'];
                    }
                }
                $messageFounders = 'दि.'.date('d/M/Y',strtotime($this->input->post('donation_date'))).' देणगीदार :'.$donor_name .' देणगी :'.$this->input->post('donation');
                $recieverFounder='7038662573';
                $response =sendSms($message,$reciever);
                sendSms($messageFounders,$recieverFounder);
                if(!empty($response)){
                    if($response['return']==true){
                        $flash_message = $flash_message ."<div class='alert alert-success'>sms सेंड झाला.</div>";
                    }
                    else{
                        $flash_message = $flash_message ."<div class='alert alert-danger'>sms  सेंड करताना व्यत्यय ".$response['message']."</div>";
                    }
                }
                $this->session->set_flashdata('message', $flash_message);

            } else {
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>सेव करताना व्यत्यय </div>");

            }
        }
            redirect('donation');

    }

    public function view($did = null){
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data['csrf'] = $csrf;
        if($this->session->userdata('logged_in')) {
        $data['title'] = 'डॅशबोर्ड | देणगी माहिती';
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
        if($this->donation_model->donation_delete($id)){
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>माहिती यशस्वीरित्या डिलीट झाली...!</div>");
            redirect('donation');
        }
        else{
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>सेव करताना व्यत्यय </div>");
            redirect('donation');
        }
    }
    public function report(){
        if($this->session->userdata('logged_in')) {
            $data['title'] = 'देणगी रिपोर्ट';
            $data['report']='donation';
            $this->load->view('header', $data);
            $this->load->view('reporter', $data);
            $this->load->view('footer', $data);
        }
        else{
            redirect('login');
        }

    }
    public function export(){

    }

}