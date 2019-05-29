<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/26/19
 * Time: 3:30 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model("student_model");
//        $this->load->model("donation_model");
//        $this->load->model("employee_model");

    }
    function index($action=null)
    {
        if($this->session->userdata('logged_in')) {

            $data_user['logged_in'] = $this->session->userdata('logged_in');
            $file_name_new = $_FILES['file']['name'];
            if (!empty($file_name_new)) {

                $config['upload_path'] = './uploads';
                $config['allowed_types'] = 'csv|xlsx|xls';
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = 10000;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $file_name = null;
                    $data['error'] = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . $data['error'] . " </div>");
                } else {
                    $upload_data = $this->upload->data();
                    $file_path = base_url('uploads/' . $upload_data['file_name']);


//                $csv =fopen($file_path,"r");

                    if ($action == 'student') {

                        $data_user['title'] = 'प्रवेशित CSV इम्पोर्ट';

                        $respose = array('success' => array(), 'error' => array());
                        $cnt_ok = $cnt_notok = 0;
                        if (($h = fopen($file_path, "r")) !== FALSE) {
                            // Each line in the file is converted into an individual array that we call $data
                            // The items of the array are comma separated

                            while (($data = fgetcsv($h, 1000, ",", '"')) !== FALSE) {
                                // Each individual array is being pushed into the nested array
                                if ($data[0] != 'रजि. नं.'):
                                    $the_big_array[] = $data;
                                    $student_data['register_no'] = $data[0];
                                    $student_data['fname'] = $data[1];
                                    $student_data['mname'] = $data[2];
                                    $student_data['lname'] = $data[3];
                                    $student_data['birth_date'] = $data[4];
                                    $student_data['parents_name'] = $data[5];
                                    $student_data['sgid'] = $data[6];
                                    $student_data['adm_date'] = $data[7];
                                    $student_data['order_no'] = $data[8];
                                    $student_data['address'] = $data[9];
                                    $student_data['contact_nos'] = $data[10];

                                    if ($this->student_model->save_csv_data($student_data)) {
                                        array_push($respose['success'], $data[0]);
                                        $cnt_ok++;
                                    } else {
                                        array_push($respose['error'], $data[0]);
                                        $cnt_notok++;
                                    }
                                endif;
                            }
                            fclose($h);
                        }

                        $string = "";
                        foreach ($respose['success'] as $datar) {
                            $string = $string . "<li>" . $datar . "</li>";
                        }
                        $un_string = "";
                        foreach ($respose['error'] as $datar) {
                            $un_string = $un_string . "<li>" . $datar . "</li>";
                        }
                        $this->session->set_flashdata('total_success', "<div class='alert alert-success'> Total Success : " . $cnt_ok . "</div>");
                        $this->session->set_flashdata('success', "<div class='alert alert-success'> Success Register No : " . $string . "</div>");
                        $this->session->set_flashdata('total_error', "<div class='alert alert-danger'> Total Error : " . $cnt_notok . "</div>");
                        $this->session->set_flashdata('error', "<div class='alert alert-danger'>Error Register No :" . $un_string . "</div>");
                    } else if ($action == 'donor') {

                    } else if ($action == 'employee') {

                    }
                    $data_user['action']='student';
                    $this->load->view('header', $data_user);
                    $this->load->view('file_uploader', $data_user);
                    $this->load->view('footer', $data_user);
                }

            }
        }
        else{
            redirect('login');
        }
    }
    function readCSV($filepath){


    }
}