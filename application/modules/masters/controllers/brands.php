<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brands extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->clear_cache();
        if (!$this->user_auth->is_logged_in()) {
            redirect($this->config->item('base_url') . 'admin');
        }
        $main_module = 'masters';
        $access_arr = array(
            'brands/index' => array('add', 'edit', 'delete', 'view'),
            'brands/insert_brand' => array('add'),
            'brands/update_brand' => array('edit'),
            'brands/delete_master_brand' => array('delete'),
            'brands/add_duplicate_brandname' => array('add', 'edit'),
            'brands/update_duplicate_brandname' => array('add', 'edit'),
            'brands/brand_ajaxList' => 'no_restriction',
            'brands/get_duplicate' => 'no_restriction',
        );

        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            redirect($this->config->item('base_url'));
        }
        $this->load->model('masters/brand_model');
    }

    public function get_duplicate() {

        $data = $this->brand_model->get_brand_duplicate();
        echo "<pre>";
        print_r($data);
        exit;
    }

    public function index() {

        $data["brand"] = $this->brand_model->get_brand();
        $data['firms'] = $firms = $this->user_auth->get_user_firms();
        $this->template->write_view('content', 'masters/brands', $data);
        $this->template->render();
    }

    public function insert_brand() {
        $input = array('brands' => $this->input->post('brands'), 'created_by' => $this->user_auth->get_user_id(), 'firm_id' => $this->input->POST('firm_id'));
        $this->brand_model->insert_brand($input);
        $data["brand"] = $this->brand_model->get_brand();
        redirect($this->config->item('base_url') . 'masters/brands', $data);
    }

    public function update_brand() {
        $id = $this->input->post('value1');
        $input = array('brands' => $this->input->post('value2'), 'created_by' => $this->user_auth->get_user_id(), 'firm_id' => $this->input->POST('firm'));
        $this->brand_model->update_brand($input, $id);
        $data["brand"] = $this->brand_model->get_brand();
        redirect($this->config->item('base_url') . 'masters/brands');
    }

    public function delete_master_brand() {
        $id = $this->input->get('value1'); {
            $this->brand_model->delete_master_brand($id);
            $data["brand"] = $this->brand_model->get_brand();
            redirect($this->config->item('base_url') . 'masters/brands');
        }
    }

    public function add_duplicate_brandname() {

        $input = $this->input->post();
        $validation = $this->brand_model->add_duplicate_brandname($input);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo"Brand Name Already Exist";
        }
    }

    public function update_duplicate_brandname() {

        $input = $this->input->get('value1');
        $id = $this->input->get('value2');
        $validation = $this->brand_model->update_duplicate_brandname($input, $id);

        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Brand Name Already Exist";
        }
    }

    function clear_cache() {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    public function brand_ajaxList() {

        $list = $this->brand_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ass) {
            //  $edit_access = ($edit_access == 0) ? 'blocked_access' : '';
            // $delete_access = ($delete_access == 0) ? 'blocked_access' : '';

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $ass->firm_name;
            $row[] = $ass->brands;
            // $row[] = $edit_row . '&nbsp;&nbsp;' . $delete_row .
            if ($this->user_auth->is_action_allowed('masters', 'brands', 'edit')) {
                $rows = '<a href="#test1_' . $ass->id . '" data-toggle="modal" id="edit" class="tooltips btn btn-default btn-xs" title="" ><span class="fa fa-log-out "> <span class="fa fa-edit" ></span></span></a>';
            } else {
                $rows = '<a href="#" data-toggle="tooltip" class="tooltips btn btn-default btn-xs alerts" title="" ><span class="fa fa-log-out "> <span class="fa fa-edit"></span></span></a>';
            }
            if ($this->user_auth->is_action_allowed('masters', 'brands', 'delete')) {
                $row[] = $rows . '<a href="#test3_' . $ass->id . '" data-toggle="modal" id="delete_yes" name="delete" class="tooltips btn btn-default btn-xs" ><span class="fa fa-log-out"> <span class="fa fa-ban " hidin="' . $ass->id . '"></span>  </span></a>';
            } else {
                $row[] = $rows . '<a href="#" data-toggle="tooltip" class="tooltips btn btn-default btn-xs alerts" title="" ><span class="fa fa-log-out "> <span class="fa fa-ban"></span> </span></a>';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->brand_model->count_all(),
            "recordsFiltered" => $this->brand_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
        exit;
    }

}
