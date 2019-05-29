<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/27/19
 * Time: 11:41 PM
 */
Class Marks_model extends CI_Model
{
    function student_marks_save($sid=null){

            /*Insert New Student Marklist*/
        $per = "-";
        if(is_numeric($this->input->post('marks')) && is_numeric($this->input->post('total_marks')))
        $per = number_format(($this->input->post('marks')/$this->input->post('total_marks'))*100,2,'.','');
          $studentdata = array(
                'year' => $this->input->post('year'),
                'std' => $this->input->post('std'),
                'marks' => $this->input->post('marks'),
                'total_marks' => $this->input->post('total_marks'),
                'per' => $per,
                'result' => $this->input->post('result'),
                'sid' => $sid,
              'status' => 1
            );

            if ($this->db->insert('student_marks', $studentdata)) {
                return true;
            } else {

                return false;
            }
        }

        function  student_marks_delete($mid=null)
        {
            if (!empty($mid)) {
                $data = array('status'=> 0);
                $this->db->where('student_marks.id', $mid);
                if($this->db->update('student_marks',$data)){
                return true;}
                else{return false;}
            }
        }

        function student_marks_list($sid=null){


                if(!empty($sid)){
                    $this->db->order_by('student_marks.id', 'desc');
                    $this->db->where('student_marks.sid',$sid);
                    $this->db->where('student_marks.status',1);
                    $this->db->or_where('student_marks.status',null);
                    $query = $this->db->get('student_marks');
                    return($query->result_array());}
                return null;
            }


}