<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/18/19
 * Time: 6:46 PM
 */
Class Student_model extends CI_Model
{
    function student_list($id = null)
    {
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $this->db->or_where('student_table.fname', $search);
            $this->db->or_where('student_table.mname', $search);
            $this->db->or_where('student_table.lname', $search);


        }
        $this->db->order_by('student_table.id', 'desc');
        $this->db->join('student_group', 'student_table.sgid=student_group.sgid');
        if(!empty($id)){
            $this->db->where('student_table.id',$id);
            $this->db->where('student_table.status','1');
            $this->db->or_where('student_table.status',null);
        }
        $this->db->where('student_table.status','1');
        $this->db->or_where('student_table.status',null);
        $query = $this->db->get('student_table');
        return($query->result_array());

    }

    function student_marks_list($sid=null){

        if(!empty($sid)){
            $this->db->order_by('student_marks.id', 'desc');
            $this->db->where('student_marks.sid',$sid);
            $this->db->where('student_marks.status','1');
            $this->db->or_where('student_marks.status',null);
        $query = $this->db->get('student_marks');
        return($query->result_array());}
        return null;
    }

    function student_mudatvadh_list($sid=null){

        if(!empty($sid)) {
            $this->db->order_by('student_mudatvadh.id', 'desc');
            $this->db->where('student_mudatvadh.sid', $sid);
            $this->db->where('student_mudatvadh.status', '1');
            $this->db->or_where('student_mudatvadh.status', null);

            $query = $this->db->get('student_mudatvadh');
            return ($query->result_array());
        }
        return null;
    }

    function student_group_list(){
        $query = $this->db->get('student_group');
        return($query->result_array());
    }

    function  student_save($id = null)
    {


        $photostatus = $this->input->post('photoexist');
        $file_name = $photostatus;
        if(!empty($photostatus)|| empty($photostatus)){
            $file_name_new = $_FILES['studphoto']['name'];
            if(!empty($file_name_new)){

                if (!is_dir('student_photo')) {
                    mkdir('./student_photo/', 0777, TRUE);
                }

                $config['upload_path'] = './student_photo/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = 10000;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('studphoto')) {
                    $file_name=null;
                } else {
                    $upload_data = $this->upload->data();
                    $file_name=$upload_data['file_name'];
                    $fname = $this->input->post('fname');
                    $lname =$this->input->post('lname');
                    $new_name = $upload_data['file_path'].$fname."_".$lname."_".date('Y-m-d H:i:s').".".pathinfo($file_name,PATHINFO_EXTENSION);
                    rename($upload_data['full_path'],$new_name);
                    $file_name = $fname."_".$lname."_".date('Y-m-d H:i:s').".".pathinfo($file_name,PATHINFO_EXTENSION);
                }
            }
        }



        $adm_date = $this->input->post('adm_date');
        $birth_date = $this->input->post('birth_date');
        if(empty($adm_date)){
            $adm_date = null;
        }
        if(empty($birth_date)){
            $birth_date = null;
        }

        if (!empty($id)) {
            /*Update Student Records*/
            $studentdata = array(
                'register_no' => $this->input->post('register_no'),
                'fname' => $this->input->post('fname'),
                'mname' => $this->input->post('mname'),
                'lname' => $this->input->post('lname'),
                'address' => $this->input->post('address'),
                'dharm_jaat' => $this->input->post('dharm_jaat'),
                'parents_name' => $this->input->post('parents_name'),
                'parents_income' => $this->input->post('parents_income'),
                'niradhar_reason' => $this->input->post('niradhar_reason'),
                'adm_date' => $adm_date,
                'birth_date' => $birth_date,
                'adm_source' => $this->input->post('adm_source'),
                'std' => $this->input->post('std'),
                'photo' => (!empty($file_name))?$file_name:'',
                'sgid' => $this->input->post('sgid'),
                'contact_nos' => $this->input->post('contact_nos'),
                'aadhar_no' => $this->input->post('aadhar_no'),
                'order_no' => $this->input->post('order_no'),
                'status' => '1'
            );

            $this->db->where('id',$id);

            if ($this->db->update('student_table', $studentdata)) {
                return true;
            } else {

                return false;
            }
        } else {
            /*Insert New Student*/
            $studentdata = array(
                'register_no' => $this->input->post('register_no'),
                'fname' => $this->input->post('fname'),
                'mname' => $this->input->post('mname'),
                'lname' => $this->input->post('lname'),
                'address' => $this->input->post('address'),
                'dharm_jaat' => $this->input->post('dharm_jaat'),
                'parents_name' => $this->input->post('parents_name'),
                'parents_income' => $this->input->post('parents_income'),
                'niradhar_reason' => $this->input->post('niradhar_reason'),
                'adm_date' => $adm_date,
                'birth_date' => $birth_date,
                'adm_source' => $this->input->post('adm_source'),
                'std' => $this->input->post('std'),
                'photo' => (!empty($file_name))?$file_name:'',
                'sgid' => $this->input->post('sgid'),
                'contact_nos' => $this->input->post('contact_nos'),
                'aadhar_no' => $this->input->post('aadhar_no'),
                'order_no' => $this->input->post('order_no'),
                'status' => '1'
            );

            if ($this->db->insert('student_table', $studentdata)) {
                return true;
            } else {

                return false;
            }
        }
    }

    function delete($id = null){
        if(!empty($id)){
             $data = array('student_table.status'=>'0');
            $this->db->where('student_table.id',$id);
            if($this->db->update('student_table',$data)){
                return true;
            }
            else{
                return false;
            }

        }
    }
    function save_csv_data($studentdata){

        $this->db->where('student_table.register_no', $studentdata['register_no']);
        $this->db->where('student_table.fname', $studentdata['fname']);
        $this->db->where('student_table.mname', $studentdata['mname']);
        $this->db->where('student_table.lname', $studentdata['lname']);
        $query = $this->db->get('student_table');
        if(count($query->result_array())==0){
        if ($this->db->insert('student_table', $studentdata)) {
            return true;
        } else {

            return false;
        }}
        else{
            return false;
        }
    }
}