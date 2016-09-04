<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
    public function __construct($rules = array())
    {
        parent::__construct($rules);
    }

    public function is_unique($str, $field, $id=null)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);

        $this->CI->db->limit(1)->get_where($table, ['id !=' => $id, $field => $str])->num_rows();

        if (!is_null($id)) {
            return isset($this->CI->db)
                ? ($this->CI->db->limit(1)->get_where($table, ['id !=' => $id, $field => $str])->num_rows() === 0)
                : FALSE;
        } else {
            return isset($this->CI->db)
                ? ($this->CI->db->limit(1)->get_where($table, [$field => $str])->num_rows() === 0)
                : FALSE;
        }
    }
}