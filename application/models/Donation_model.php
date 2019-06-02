<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/18/19
 * Time: 6:46 PM
 */
Class Donation_model extends CI_Model
{
    function donation_save(){

        $donordata = array(
            'dname' => $this->input->post('dname'),
            'address' => $this->input->post('address'),
            'receipt_no' => $this->input->post('receipt_no'),
            'contact_no' => $this->input->post('contact_no'),
            'email' => $this->input->post('email'),
            'donation' => $this->input->post('donation'),
            'donation_info' => $this->input->post('donation_info'),
            'receiptor' => $this->input->post('receiptor'),
            'donation_date' => $this->input->post('donation_date'),
            'status' => 1
        );

        if ($this->db->insert('donor_list', $donordata)) {
            return true;
        } else {

            return false;
        }
    }
    function donation_update(){

    }
    function donation_list($did =null){
        if(!empty($sid)) {
            $this->db->order_by('donor_list.donation_date', 'desc');
            $this->db->where('donor_list.did', $did);
        }
            $this->db->where('donor_list.status',1);
            $this->db->or_where('donor_list.status',null);
            $query = $this->db->get('donor_list');
            return($query->result_array());

    }


    function donation_delete($did = null){
        if (!empty($did)) {
            $data = array('status'=> 0);
            $this->db->where('donor_list.id', $did);
            if($this->db->update('donor_list',$data)){
                return true;}
            else{return false;}
        }
    }
}