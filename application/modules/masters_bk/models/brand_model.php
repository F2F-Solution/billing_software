<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brand_model extends CI_Model {

    private $table_name = 'erp_brand';
    private $table_name1 = 'increment_table';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert_brand($data) {
        if ($this->db->insert($this->table_name, $data)) {
            return true;
        }
        return false;
    }

    function get_brand() {
        $this->db->select($this->table_name . '.*');
        $this->db->select('erp_manage_firms.firm_name');
        $firms = $this->user_auth->get_user_firms();
        $frim_id = array();
        foreach ($firms as $value) {
            $frim_id[] = $value['firm_id'];
        }
        $this->db->where_in($this->table_name . '.firm_id', $frim_id);
        $this->db->where($this->table_name . '.status', 1);
        $this->db->join('erp_manage_firms', 'erp_manage_firms.firm_id=' . $this->table_name . '.firm_id', 'LEFT');
        $this->db->order_by('erp_brand.id', 'desc');
        $query = $this->db->get($this->table_name)->result_array();
        return $query;
    }

    function update_brand($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($this->table_name, $data)) {
            return true;
        }
        return false;
    }

    function delete_master_brand($id) {
        $this->db->where('id', $id);
        if ($this->db->update($this->table_name, $data = array('status' => 0))) {
            return true;
        }
        return false;
    }

    function add_duplicate_brandname($input) {
        $this->db->select('*');
        $this->db->where('brands', $input['cname']);
        $this->db->where('firm_id', $input['firm_id']);
        $this->db->where('status', 1);
        $query = $this->db->get('erp_brand');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function update_duplicate_brandname($input, $id) {
        //echo $input;
        //echo $id;
        //exit;
        $this->db->select('*');
        $this->db->where('brands', $input);
        $this->db->where('id !=', $id);
        $this->db->where('status', 1);
        $query = $this->db->get('erp_brand')->result_array();


        return $query;
    }

    function get_clr($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('erp_brand')->result_array();
        return $query;
    }

}
