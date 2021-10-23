<?php

class Designation_model extends CI_Model {

    private $table_name = 'designation';

    function __construct() {
        $this->load->database();
    }

    public function insert_designation($data = array()) {
        unset($data['submit']);
        if ($this->db->insert($this->table_name, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return FALSE;
        }
    }

    public function update_designation($data = array(), $designation_id) {
        unset($data['submit']);
        unset($data['designation_id']);
        $this->db->where('id', $designation_id);
        if ($this->db->update($this->table_name, $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_all_designations($filter = array()) {
        $this->db->select('tab_1.*');
        if (!empty($filter['name'])) {
            $where = "(`tab_1`.`name` LIKE '%" . $filter['name'] . "%')";
            $this->db->where($where);
        }
        if ($filter['status'] != '') {
            $this->db->where('tab_1.status', $filter['status']);
        }
        $query = $this->db->get($this->table_name . ' AS tab_1');
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
        return FALSE;
    }

    public function delete_designation($id) {
        $this->db->where('id', $id);
        if ($this->db->delete($this->table_name)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_total_designations($filter = array()) {
        $this->db->select('COUNT(tab_1.id) AS count');
        if (!empty($filter['name'])) {
            $where = "(`tab_1`.`name` LIKE '%" . $filter['name'] . "%')";
            $this->db->where($where);
        }

        if ($filter['status'] != '') {
            $this->db->where('tab_1.status', $filter['status']);
        }
        $query = $this->db->get($this->table_name . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return NULL;
    }

    public function is_designation_available($designation_name, $designation_id = NULL) {
        $this->db->select($this->table_name . '.id');
        $this->db->where('LCASE(name)', strtolower($designation_name));
        if (!empty($designation_id))
            $this->db->where('id !=', $designation_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function get_designation_by_id($designation_id = NULL) {
        if (!empty($designation_id)) {
            $this->db->where('id', $designation_id);
            $query = $this->db->get($this->table_name);
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return NULL;
        }
        return NULL;
    }

}
