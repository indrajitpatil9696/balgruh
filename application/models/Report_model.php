<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 6/17/19
 * Time: 1:10 AM
 */
Class Report_model extends CI_Model
{
    function getColumnNames($table_name){
        $result = $this->db->query('show COLUMNS from '.$table_name);
        $fields = $result->result_array();
        $list =array();
        foreach ($fields as $field){
            array_push($list,$field['Field']);
        }
        return $list;
        }

}