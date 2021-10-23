<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Designation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'javascript', 'pagination', 'form_validation', 'session_view'));
        $this->load->model('designation/designation_model');
    }

    public function index() {
        $data['designations'] = $this->designation_model->get_all_designations();
        $this->template->write_view('content', 'designation/designation', $data);
        $this->template->render();
    }

    public function add_designation() {
        $data['designations'] = $this->designation_model->get_all_designations();
        if ($this->input->post('submit')) {
            $designation = $this->input->post();
            $insert_id = $this->designation_model->insert_designation($designation);
            if (!empty($insert_id)) {
                $this->session->set_flashdata('flashSuccess', 'Designation successfully created!');
                redirect(base_url() . 'designation');
            } else {
                $this->session->set_flashdata('flashError', 'Designation not created. Please try again.');
                redirect(base_url() . 'designation');
            }
        }
        $this->template->write_view('content', 'designation/designation', $data);
        $this->template->render();
    }

    public function edit_designation($designation_id) {
        $data['designation'] = $this->designation_model->get_designation_by_id($designation_id);
        if ($this->input->post('submit')) {
            $designation = $this->input->post();
            if ($this->designation_model->update_designation($designation, $designation_id)) {
                $this->session->set_flashdata('flashSuccess', 'Designation has been successfully updated.');
                redirect('designation/edit_designation/' . $designation_id);
            } else {
                $this->session->set_flashdata('flashError', 'Designation not updated. Please try again.');
                redirect('designation/edit_designation/' . $designation_id);
            }
        }
        $this->template->write_view('content', 'designation/edit_designation', $data);
        $this->template->render();
    }

    public function delete($designation_id) {
        if ($designation_id) {
            if ($this->designation_model->delete_designation($designation_id)) {
                $this->session->set_flashdata('flashSuccess', 'Designation successfully deleted!');
                echo '1';
            } else {
                $this->session->set_flashdata('flashError', 'Designation not deleted. Please try again.');
                echo '0';
            }
        }
    }

    public function is_designation_available() {
        $designation_name = $this->input->post('designation_name');
        $designation_id = $this->input->post('designation_id');

        if ($this->designation_model->is_designation_available($designation_name, $designation_id)) {
            echo 'no';
        } else {
            echo 'yes';
        }
    }

}
