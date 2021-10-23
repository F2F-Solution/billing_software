<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brand_model extends CI_Model {

    private $table_name = 'erp_brand';
    private $table_name1 = 'increment_table';
    var $joinTable1 = 'erp_manage_firms r';
    var $primaryTable = 'erp_brand b';
    var $selectColumn = 'b.id,b.brands,r.firm_name,b.firm_id';
    var $column_order = array(null, 'r.firm_name', 'b.brands', null); //set column field database for datatable orderable
    var $column_search = array('r.firm_name', 'b.brands'); //set column field database for datatable searchable
    var $order = array('b.id' => 'DESC'); // default order

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

    public function get_datatables() {
        $this->db->select($this->selectColumn);

        $this->_get_datatables_query();

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        return $query->result();
    }

    function _get_datatables_query() {

        //Join Table

        $this->db->join($this->joinTable1, 'r.firm_id=b.firm_id');

        $this->db->where('b.status', 1);

        $firms = $this->user_auth->get_user_firms();

        $frim_id = array();

        foreach ($firms as $value) {

            $frim_id[] = $value['firm_id'];
        }

        $this->db->where_in('b.firm_id', $frim_id);

        $this->db->from($this->primaryTable);

        $i = 0;

        foreach ($this->column_search as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->like($item, $_POST['search']['value']);
                } else {

                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }

            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {

            $order = $this->order;

            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function count_all() {
        $this->db->from($this->primaryTable);

        return $this->db->count_all_results();
    }

    public function count_filtered() {
        $this->_get_datatables_query();

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_brand_duplicate() {

        $this->db->select('erp_brand.*');
        $brands = $this->db->get('erp_brand')->result_array();
        $data = [];
        $datas = "";
        $invoice_details_data = "";
        foreach ($brands as $keyb => $brands_data) {
            $this->db->select('erp_brand.id, erp_brand.firm_id, erp_brand.brands');
            $this->db->where('erp_brand.firm_id', $brands_data['firm_id']);
            $this->db->where('erp_brand.brands', $brands_data['brands']);
            $data['brands_duplicate'] = $this->db->get('erp_brand')->result_array();


            if (count($data['brands_duplicate']) > 1) {

                foreach ($data['brands_duplicate'] as $key => $duplicate) {
                    if ($key > 0) {
                        $datas[] = $duplicate;
//                        $brand_id = $duplicate['id'];
//                        $this->select('inv.id,inv.in_id');
//                        $this->db->where('inv.brand', $brand_id);
//                        $invoice_details = $this->db->get('erp_invoice_details as inv')->result_array();
//                        $datas[] = $invoice_detailss;
//                        if (!empty($invoice_details)) {
//                            $invoice_details_data[$key] = $invoice_details;
//                        } else {
//                            $invoice_details_data[$key] = $brand_id;
//                        }
                    }
                }
            }
        }
        echo "<pre>";
        print_r($datas);
        exit;
    }

}
