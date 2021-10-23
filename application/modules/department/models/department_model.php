<?php

class Department_model extends CI_Model {

    private $table_name = 'department';
    private $users = 'users';

    function __construct() {
        $this->load->database();
    }

    public function insert_department($data = array()) {
        unset($data['submit']);
        if ($this->db->insert($this->table_name, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return FALSE;
        }
    }

    public function update_department($data = array(), $department_id) {
        unset($data['submit']);
        unset($data['department_id']);
        $this->db->where('id', $department_id);
        if ($this->db->update($this->table_name, $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_all_users() {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.status', 1);
        $query = $this->db->get($this->users . ' AS tab_1');
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
        return FALSE;
    }

    public function get_all_departments($filter) {
        $this->db->select('tab_1.*, users.username');
        $this->db->join('users', 'users.id=tab_1.department_head', 'left');
        if (!empty($filter['name'])) {
            $where = "(`tab_1`.`name` LIKE '%" . $filter['name'] . "%')";
            $this->db->where($where);
        }
        if (!empty($filter['department_head'])) {
            $where = "(`tab_1`.`department_head` LIKE '%" . $filter['department_head'] . "%')";
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

    public function toggle_department_status($department_id = NULL, $current_status = NULL) {
        if ($static_content_id != NULL && $current_status != NULL) {
            $new_status = ($current_status == 1) ? 0 : 1;
            $status_arr = array('status' => $new_status);
            $user_status_arr = array('status' => $new_status);
            // Update Static Content
            $this->db->where('id', $department_id);
            $this->db->update($this->table_name, $status_arr);
            return TRUE;
        }
        return FALSE;
    }

    public function delete_department($id) {
        $this->db->where('id', $id);
        if ($this->db->delete($this->table_name)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_total_departments($filter) {
        $this->db->select('COUNT(tab_1.id) AS count');
        $this->db->join('users', 'users.id=tab_1.department_head', 'left');
        if (!empty($filter['name'])) {
            $where = "(`tab_1`.`name` LIKE '%" . $filter['name'] . "%')";
            $this->db->where($where);
        }
        if (!empty($filter['department_head'])) {
            $where = "(`tab_1`.`department_head` LIKE '%" . $filter['department_head'] . "%')";
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

    public function is_department_available($department_name, $department_id = NULL) {
        $this->db->select($this->table_name . '.id');
        $this->db->where('LCASE(name)', strtolower($department_name));
        if (!empty($department_id))
            $this->db->where('id !=', $department_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function get_department_by_id($department_id = NULL) {
        if (!empty($department_id)) {
            $this->db->where('id', $department_id);
            $query = $this->db->get($this->table_name);
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return NULL;
        }
        return NULL;
    }

}
