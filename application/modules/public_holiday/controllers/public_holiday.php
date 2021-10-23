<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Public_holiday extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'javascript', 'pagination', 'form_validation', 'session_view'));
        $this->load->model('public_holiday/public_holiday_model');
        $this->load->model('department/department_model');
    }

    public function index() {
        $data['public_holiday'] = $this->public_holiday_model->get_all_public_holidays();
        $data['department'] = $this->department_model->get_all_departments();
        $this->template->write_view('content', 'public_holiday/public_holiday', $data);
        $this->template->render();
    }

    public function add_public_holiday() {
        $data['designations'] = $this->public_holiday_model->get_all_public_holidays();
        $data['department'] = $this->department_model->get_all_departments();
        if ($this->input->post('submit')) {
            $public_holiday = $this->input->post();
            $insert_id = $this->public_holiday_model->insert_public_holiday($public_holiday);
            if (!empty($insert_id)) {
                $this->session->set_flashdata('flashSuccess', 'Public Holiday successfully created!');
                redirect(base_url() . 'public_holiday');
            } else {
                $this->session->set_flashdata('flashError', 'Public Holiday not created. Please try again.');
                redirect(base_url() . 'public_holiday');
            }
        }
        $this->template->write_view('content', 'public_holiday/public_holiday', $data);
        $this->template->render();
    }

    public function edit_public_holiday($holiday_id) {
        $data['public_holiday'] = $this->public_holiday_model->get_public_holiday_by_id($holiday_id);
        $data['department'] = $this->department_model->get_all_departments();
        if ($this->input->post('submit')) {
            $public_holiday = $this->input->post();
            if ($this->public_holiday_model->update_public_holiday($public_holiday, $holiday_id)) {
                $this->session->set_flashdata('flashSuccess', 'Public Holiday has been successfully updated.');
                redirect('public_holiday/edit_public_holiday/' . $holiday_id);
            } else {
                $this->session->set_flashdata('flashError', 'Public Holiday not updated. Please try again.');
                redirect('public_holiday/edit_public_holiday/' . $holiday_id);
            }
        }
        $this->template->write_view('content', 'public_holiday/edit_public_holiday', $data);
        $this->template->render();
    }

    public function delete($holiday_id) {
        if ($holiday_id) {
            if ($this->public_holiday_model->delete_public_holiday($holiday_id)) {
                $this->session->set_flashdata('flashSuccess', 'Public Holiday successfully deleted!');
                echo '1';
            } else {
                $this->session->set_flashdata('flashError', 'Public Holiday not deleted. Please try again.');
                echo '0';
            }
        }
    }

}
