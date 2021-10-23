<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_return extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->clear_cache();
        if (!$this->user_auth->is_logged_in()) {
            redirect($this->config->item('base_url') . 'admin');
        }
        $main_module = 'purchase';
        $access_arr = array(
            'purchase_return/purchase_order_list' => array('add', 'edit', 'delete', 'view'),
            'purchase_return/index' => array('add', 'edit', 'delete', 'view'),
            'purchase_return/search_result' => array('add', 'edit', 'delete', 'view'),
            'purchase_return/po_view' => array('add', 'edit', 'delete', 'view'),
            'purchase_return/po_delete' => array('delete'),
            'purchase_return/po_edit' => array('add', 'edit'),
            'purchase_return/update_po' => array('edit'),
            'purchase_return/change_status' => 'no_restriction',
            'purchase_return/get_customer' => 'no_restriction',
            'purchase_return/get_customer_by_id' => 'no_restriction',
            'purchase_return/get_product' => 'no_restriction',
            'purchase_return/get_product_by_id' => 'no_restriction',
            'purchase_return/history_view' => 'no_restriction',
            'purchase_return/stock_details' => 'no_restriction',
            'purchase_return/clear_cache' => 'no_restriction',
            'purchase_return/po_views' => array('add', 'edit', 'delete', 'view'),
        );
        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            redirect($this->config->item('base_url'));
        }


        $this->load->model('masters/categories_model');
        $this->load->model('master_style/master_model');
        $this->load->model('masters/brand_model');
        $this->load->model('quotation/Gen_model');
        $this->load->model('masters/customer_model');
        $this->load->model('enquiry/enquiry_model');
        $this->load->model('admin/admin_model');
        $this->load->model('purchase_return/purchase_return_model');
        $this->load->model('purchase_order/purchase_order_model');
    }

    public function index() {
        $datas["po"] = $po = $this->purchase_return_model->get_all_po();
        $datas['company_details'] = $this->admin_model->get_company_details();
//        echo "<pre>";
//        print_r($datas);
//        exit;
        $this->template->write_view('content', 'purchase_return/purchase_return_list', $datas);
        $this->template->render();
    }

    public function po_view($id) {
        $datas["po"] = $po = $this->purchase_return_model->get_all_po_by_id($id);
        $datas["po_details"] = $po_details = $this->purchase_return_model->get_all_pr_details_by_id($id);
        $datas['company_details'] = $this->purchase_order_model->get_company_details_by_firm($id);
//        echo "<pre>";
//        print_r($datas);
//        exit;
        $datas["category"] = $category = $this->categories_model->get_all_category();
        //  $datas['company_details'] = $this->admin_model->get_company_details();
        $datas["brand"] = $brand = $this->brand_model->get_brand();
        $this->template->write_view('content', 'purchase_return_view', $datas);
        $this->template->render();
    }

    public function po_views($id) {
        $datas["po"] = $po = $this->purchase_return_model->get_all_po_by_id($id);
        $datas["po_details"] = $po_details = $this->purchase_return_model->get_all_pr_details_by_id($id);
        $datas['company_details'] = $this->purchase_order_model->get_company_details_by_firm($id);
//        echo "<pre>";
//        print_r($datas);
//        exit;
        $datas["category"] = $category = $this->categories_model->get_all_category();
        //  $datas['company_details'] = $this->admin_model->get_company_details();
        $datas["brand"] = $brand = $this->brand_model->get_brand();
        $this->template->write_view('content', 'purchase_return_views', $datas);
        $this->template->render();
    }

    public function change_status($id, $status) {
        //echo $id; echo $status; exit;
        $this->purchase_return_model->change_po_status($id, $status);
        redirect($this->config->item('base_url') . 'purchase_return/purchase_return_list');
    }

    public function purchase_return_list() {

    }

    public function get_customer() {
        $atten_inputs = $this->input->get();
        $data = $this->purchase_return_model->get_customer($atten_inputs);
        echo '<ul id="country-list">';
        if (isset($data) && !empty($data)) {
            foreach ($data as $st_rlno) {
                if ($st_rlno['name'] != '')
                    echo '<li class="cust_class" cust_name="' . $st_rlno['name'] . '" cust_id="' . $st_rlno['id'] . '" cust_no="' . $st_rlno['mobil_number'] . '" cust_email="' . $st_rlno['email_id'] . '" cust_address="' . $st_rlno['address1'] . '">' . $st_rlno['name'] . '</li>';
            }
        }
        else {
            echo '<li style="color:red;">No Data Found</li>';
        }
        echo '</ul>';
    }

    public function get_customer_by_id() {
        $input = $this->input->post();
        $data_customer["customer_details"] = $this->purchase_return_model->get_customer_by_id($input['id']);
        echo json_encode($data_customer);
        exit;
    }

    public function get_product() {
        $atten_inputs = $this->input->get();
        $product_data = $this->purchase_return_model->get_product($atten_inputs);

        echo '<ul id="product-list">';
        if (isset($product_data) && !empty($product_data)) {
            foreach ($product_data as $st_rlno) {
                if ($st_rlno['model_no'] != '')
                    echo '<li class="pro_class" pro_cost="' . $st_rlno['cost_price'] . '" pro_type="' . $st_rlno['type'] . '" pro_id="' . $st_rlno['id'] . '" mod_no="' . $st_rlno['model_no'] . '" pro_name="' . $st_rlno['product_name'] . '" pro_description="' . $st_rlno['product_description'] . '" pro_image="' . $st_rlno['product_image'] . '">' . $st_rlno['model_no'] . '</li>';
            }
        }
        else {
            echo '<li style="color:red;">No Data Found</li>';
        }
        echo '</ul>';
    }

    public function get_product_by_id() {
        $input = $this->input->post();
        $data_customer["product_details"] = $this->purchase_return_model->get_product_by_id($input['id']);
        echo json_encode($data_customer);
        exit;
    }

    public function po_edit($id) {
        $datas["po"] = $po = $this->purchase_return_model->get_all_pr_by_id($id);
        $datas["po_details"] = $po_details = $this->purchase_return_model->get_all_pr_details_by_id($id);

        $datas["category"] = $category = $this->categories_model->get_all_category();
        $datas["brand"] = $brand = $this->brand_model->get_brand();
        $datas['firms'] = $firms = $this->user_auth->get_user_firms();
        $datas['company_details'] = $this->purchase_order_model->get_company_details_by_firm($id);
        //  $datas['company_details'] = $this->admin_model->get_company_details();
        echo '<pre>';
        print_r($datas);
        exit;
        $this->template->write_view('content', 'purchase_return_edit', $datas);
        $this->template->render();
    }

    function stock_details($stock_info, $po_id) {

        $this->purchase_return_model->check_stock($stock_info, $po_id);
    }

    public function update_po($id) {
        $input = $this->input->post();

        $purchase_order_id = $id;
        foreach ($input['id'] as $key => $val) {
            $erp_po_details_id = trim($val);
            $categoty = $input['categoty'][$key];
            $product = $input['product_id'][$key];
            $brand = $input['brand'][$key];

            $po_details = $this->purchase_return_model->get_po_details($erp_po_details_id);
            $already_delivery_qty = $po_details[0]['delivery_quantity'];
            $already_total_qty = $po_details[0]['quantity'];
            $return_qty = $input['return_quantity'][$erp_po_details_id][0];
            if ($return_qty == '') {
                $return_qty = 0;
            }
            if ($return_qty != '') {
                $data = array();

                //Get & Update Stock..
                $stock_arr = array();
                $po_id['po_id'] = $input['po']['po_no'];
                $stock_arr['category'] = $categoty;
                $stock_arr['product_id'] = $product;
                $stock_arr['brand'] = $brand;
                $stock_arr['return_quantity'] = $return_qty;
                $this->stock_details($stock_arr, $po_id);
                // ERP PR..
                $erp_pr = $this->purchase_return_model->get_erp_pr($purchase_order_id);
                $erp_pr_id = $erp_pr[0]['id'];
                $already_total_pr_qty = $erp_pr[0]['total_qty'];
                $already_delivery_pr_qty = $erp_pr[0]['delivery_qty'];
                $data = array();
                $data['delivery_qty'] = $already_delivery_pr_qty - $return_qty;
                $data['total_qty'] = $already_total_pr_qty - $return_qty;
                $data['net_total'] = $input['po']['net_total'];
                $data['subtotal_qty'] = $input['po']['subtotal_qty'];
                $this->purchase_return_model->update_erp_pr($erp_pr_id, $data);
                // Erp Pr_details Update
                // $this->purchase_return_model->delete_pr_details($purchase_order_id);
                $insert['po_id'] = $purchase_order_id;
                $insert['pr_id'] = $erp_pr_id;
                $insert['category'] = $categoty;
                $insert['product_id'] = $product;
                $insert['product_description'] = $product_description;
                $insert['brand'] = $brand;
                $insert['unit'] = $unit;
                $insert['return_quantity'] = $return_qty;
                $insert['per_cost'] = $per_cost;
                $insert['tax'] = $tax;
                $insert['gst'] = $gst;
                $insert['igst'] = $igst;
                $insert['discount'] = $discount;
                $insert['transport'] = $transport;
                $insert['sub_total'] = $input['sub_total'][$key];
                $insert['created_date'] = $created_date;
                $this->purchase_return_model->insert_pr_details($insert);
            }
        }
        redirect($this->config->item('base_url') . 'purchase_return/index');
    }

    public function po_delete() {
        $id = $this->input->POST('value1');
        $datas["po"] = $po = $this->purchase_return_model->get_all_po();
        $del_id = $this->purchase_return_model->delete_po($id);
        redirect($this->config->item('base_url') . 'purchase_return/purchase_return_list', $datas);
    }

    public function history_view($id) {
        $datas["his_quo"] = $his_quo = $this->purchase_return_model->all_history_quotations($id);
        $this->template->write_view('content', 'history_view', $datas);
        $this->template->render();
    }

    function clear_cache() {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */