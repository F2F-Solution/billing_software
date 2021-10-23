<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'javascript', 'pagination', 'form_validation', 'session_view'));
        $this->load->model('department/department_model');
    }

    public function index() {
        $data['department_head'] = $this->department_model->get_all_users();
        $data['departments'] = $this->department_model->get_all_departments($filter);
        $this->template->write_view('content', 'department/department', $data);
        $this->template->render();
    }

    public function add_department() {
        $data['department_head'] = $this->department_model->get_all_users();
        $data['departments'] = $this->department_model->get_all_departments($filter);
        if ($this->input->post('submit')) {
            $department = $this->input->post();
            $insert_id = $this->department_model->insert_department($department);
            if (!empty($insert_id)) {
                $this->session->set_flashdata('flashSuccess', 'Department successfully created!');
                redirect(base_url() . 'department');
            } else {
                $this->session->set_flashdata('flashError', 'Department not created. Please try again.');
                redirect(base_url() . 'department');
            }
        }
        $this->template->write_view('content', 'department/department', $data);
        $this->template->render();
    }

    public function edit_department($department_id) {
        $data['department_head'] = $this->department_model->get_all_users();
        $data['department'] = $this->department_model->get_department_by_id($department_id);
        if ($this->input->post('submit')) {
            $department = $this->input->post();
            if ($this->department_model->update_department($department, $department_id)) {
                $this->session->set_flashdata('flashSuccess', 'Department has been successfully updated.');
                redirect('department/edit_department/' . $department_id);
            } else {
                $this->session->set_flashdata('flashError', 'Department not updated. Please try again.');
                redirect('department/edit_department/' . $department_id);
            }
        }
        $this->template->write_view('content', 'department/edit_department', $data);
        $this->template->render();
    }

    public function delete($department_id) {
        if ($department_id) {
            if ($this->department_model->delete_department($department_id)) {
                $this->session->set_flashdata('flashSuccess', 'Department successfully deleted!');
                echo '1';
            } else {
                $this->session->set_flashdata('flashError', 'Department not deleted. Please try again.');
                echo '0';
            }
        }
    }

    public function is_department_available() {
        $department_name = $this->input->post('department_name');
        $department_id = $this->input->post('department_id');

        if ($this->department_model->is_department_available($department_name, $department_id)) {
            echo 'no';
        } else {
            echo 'yes';
        }
    }

}
