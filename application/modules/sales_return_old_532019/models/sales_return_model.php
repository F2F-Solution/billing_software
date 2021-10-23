<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_return_model extends CI_Model {

    private $table_name4 = 'master_style';
    private $table_name5 = 'master_style_size';
    private $vendor = 'vendor';
    private $erp_invoice = 'erp_invoice';
    private $erp_invoice_details = 'erp_invoice_details';
    private $erp_invoice_product_details = 'erp_invoice_product_details';
    private $increment_table = 'increment_table';
    private $erp_product = 'erp_product';
    private $erp_user = 'erp_user';
    private $erp_stock = 'erp_stock';
    private $erp_stock_history = 'erp_stock_history';
    private $erp_sales_return = 'erp_sales_return';
    private $erp_sales_return_details = 'erp_sales_return_details';

    function __construct() {

        parent::__construct();
    }

    public function insert_sr($data) {

        if ($this->db->insert($this->erp_sales_return, $data)) {

            $insert_id = $this->db->insert_id();



            return $insert_id;
        }

        return false;
    }

    public function insert_sr_details($data) {

        $this->db->insert_batch($this->erp_sales_return_details, $data);

        return true;
    }

    public function insert_inv_details($data) {

        $this->db->insert_batch($this->erp_invoice_details, $data);

        return true;
    }

    public function insert_make_return_details($data) {


        $this->db->insert('sales_return_details', $data);

        return true;
    }

    public function update_stock($data, $firm_id) {

        $this->db->where('firm_id', $firm_id);
        $this->db->where('product_id', $data['product_id']);
        $query = $this->db->get('erp_stock')->result_array();
        $exists_qty = $query[0]['quantity'];


        $update_data = [
            "quantity" => $exists_qty + $data['return_qty'],
        ];

        $this->db->where('id', $query[0]['id']);
        $this->db->update('erp_stock', $update_data);



        $insert_data = [
            "ref_no" => $data['inv_number'],
            "type" => 'in',
            "category" => $data['cat_id'],
            "brand" => $data['brand_id'],
            "product_id" => $data['product_id'],
            "quantity" => $data['return_qty'],
            "created_date" => date('Y-m-d H:i'),
        ];
        $this->db->insert('erp_stock_history', $insert_data);

        return true;
    }

    public function update_return_qty($data) {

        $this->db->where('id', $data['inv_detail_id']);
        $query = $this->db->get('erp_invoice_details')->result_array();


        $update_data = [
            "return_quantity" => $query[0]['return_quantity'] + $data['return_qty'],
            "customer_exists_qty" => $query[0]['customer_exists_qty'] - $data['return_qty'],
        ];
        $this->db->where('id', $data['inv_detail_id']);
        $this->db->update('erp_invoice_details', $update_data);
        return true;
    }

    public function get_customer_list_by_keywords($customer) {

        $keyword = $customer;
        $this->db->select('customer.id,customer.store_name as value');
        $this->db->where('customer.status', 1);
        $this->db->where("customer.store_name LIKE '%$keyword%'");
        $this->db->join('erp_invoice', 'erp_invoice.customer = customer.id', 'left');
        $this->db->group_by('erp_invoice.customer');
        $query = $this->db->get('customer')->result_array();
        if ($query)
            return $query;
        else
            return 0;
    }

    public function get_customer_product_list($customer, $from_date, $to_date) {

        $this->db->select('erp_invoice_details.*');
        $this->db->join('erp_invoice_details', 'erp_invoice_details.in_id = erp_invoice.id', 'left');
        $this->db->where('erp_invoice.customer', $customer);
        $this->db->where('erp_invoice_details.customer_exists_qty !=', 0);
        if ($from_date != "")
            $this->db->where('erp_invoice.created_date >=', date('Y-m-d', strtotime($from_date)));
        if ($to_date != "")
            $this->db->where('erp_invoice.created_date <=', date('Y-m-d', strtotime($to_date)));

        $this->db->group_by('erp_invoice_details.product_id');
        $query = $this->db->get('erp_invoice')->result_array();
        $result = '';

        foreach ($query as $key => $data) {
            $this->db->select('id,product_name');
            $this->db->where('id', $data['product_id']);
            $product_details = $this->db->get('erp_product')->result_array();
            $result[$key]['id'] = $product_details[0]['id'];
            $result[$key]['value'] = $product_details[0]['product_name'];
        }

        return $result;
    }

    public function get_customerid_by_name($name) {
        $this->db->select('id');
        $this->db->where('customer.status', 1);
        $this->db->where('customer.store_name', $name);
        $query = $this->db->get('customer')->result_array();

        return $query[0]['id'];
    }

    public function get_category_invid($inv_id) {

        $this->db->select('id');
        $this->db->where('inv_id', $inv_id);
        $query = $this->db->get('erp_invoice')->result_array();

        if ($query) {
            $this->db->select('category,brand');
            $this->db->where('in_id', $query[0]['id']);
            $this->db->group_by('cat_id');
            $inv_cat_details = $this->db->get('erp_invoice_details')->result_array();
            $result = '';
            foreach ($inv_details as $key => $result) {
                $this->db->where('cat_id', $result['category']);
                $get_category = $this->db->get('erp_category')->result_array();
                $result[$key]['categoryName'] = $get_category[0]['categoryName'];
                $result[$key]['cat_id'] = $get_category[0]['cat_id'];

                $this->db->where('id', $result['brand']);
                $get_brand = $this->db->get('erp_brand')->result_array();
                $result[$key]['brands'] = $get_brand[0]['brands'];
                $result[$key]['brand_id'] = $get_brand[0]['id'];
            }

            return $result;
        } else {
            return 0;
        }
    }

    public function update_inv($data, $id) {

        $this->db->where($this->erp_invoice . '.id', $id);

        if ($this->db->update($this->erp_invoice, $data)) {

            return true;
        }

        return false;
    }

    public function delete_inv_details($id) {

        $this->db->where('in_id', $id);

        $this->db->delete($this->erp_invoice_details);
    }

    /* public function check_stock1($check_stock, $po_id) {

      $this->db->select('*');

      $this->db->where('category', $check_stock['category']);

      $this->db->where('product_id', $check_stock['product_id']);

      $this->db->where('firm', $check_stock['firm']);

      $current_stock = $this->db->get($this->erp_stock)->result_array();

      if (isset($current_stock) && !empty($current_stock)) {

      //Update Stock

      $quantity = $current_stock[0]['quantity'] + $check_stock['return_quantity'];

      $this->db->where('category', $check_stock['category']);

      $this->db->where('product_id', $check_stock['product_id']);

      $this->db->where('brand', $check_stock['brand']);

      $this->db->update($this->erp_stock, array('quantity' => $quantity));

      } else {

      //Insert Stcok

      $insert_stock = array();

      $insert_stock['category'] = $check_stock['category'];

      $insert_stock['product_id'] = $check_stock['product_id'];

      $insert_stock['brand'] = $check_stock['brand'];

      $insert_stock['quantity'] = $check_stock['return_quantity'];

      $this->db->insert($this->erp_stock, $insert_stock);

      }

      //Insert Stock History

      $insert_stock_his = array();

      $insert_stock_his['ref_no'] = $po_id['inv_id'];

      $insert_stock_his['type'] = 3;

      $insert_stock_his['category'] = $check_stock['category'];



      $insert_stock_his['product_id'] = $check_stock['product_id'];

      $insert_stock_his['brand'] = $check_stock['brand'];

      $insert_stock_his['quantity'] = $check_stock['return_quantity'];

      $insert_stock_his['created_date'] = date('Y-m-d H:i');

      //echo"<pre>"; print_r($insert_stock_his); exit;

      $this->db->insert($this->erp_stock_history, $insert_stock_his);

      } */

    public function check_stock($check_stock, $inv_id) {

        $this->db->select('*');

        $this->db->where('category', $check_stock['category']);

        $this->db->where('product_id', $check_stock['product_id']);

        $this->db->where('firm_id', $check_stock['firm']);

        $current_stock = $this->db->get($this->erp_stock)->result_array();

        if (isset($current_stock) && !empty($current_stock)) {



            $quantity = $current_stock[0]['quantity'] + $check_stock['return_quantity'];

            $this->db->where('category', $check_stock['category']);

            $this->db->where('product_id', $check_stock['product_id']);

            $this->db->where('firm_id', $check_stock['firm']);



            $this->db->update($this->erp_stock, array('quantity' => $quantity));
        } else {



            $insert_stock = array();

            $insert_stock['category'] = $check_stock['category'];

            $insert_stock['product_id'] = $check_stock['product_id'];

            $insert_stock['brand'] = $check_stock['brand'];

            $insert_stock['quantity'] = $check_stock['return_quantity'];

            $this->db->insert($this->erp_stock, $insert_stock);
        }



        $insert_stock_his = array();

        $insert_stock_his['ref_no'] = $inv_id['inv_id'];

        $insert_stock_his['type'] = 2;

        $insert_stock_his['category'] = $check_stock['category'];

        $insert_stock_his['product_id'] = $check_stock['product_id'];

        $insert_stock_his['brand'] = $check_stock['brand'];

        $insert_stock_his['quantity'] = -$check_stock['quantity'];

        $insert_stock_his['created_date'] = date('Y-m-d H:i');

        $this->db->insert($this->erp_stock_history, $insert_stock_his);
    }

    public function insert_stock_details($data) {



        $this->db->insert_batch($this->erp_stock, $data);

        return true;
    }

    public function insert_stock_history($data) {

        $this->db->insert_batch($this->erp_stock_history, $data);

        return true;
    }

    public function get_stock_details() {

        $this->db->select('*');

        return $this->db->get($this->erp_stock)->result_array();
    }

    public function update_increment($id) {

        $this->db->where($this->increment_table . '.id', 5);

        if ($this->db->update($this->increment_table, $id)) {

            return true;
        }

        return false;
    }

    public function get_customer($atten_inputs) {

        $this->db->select('name,id,mobil_number,email_id,address1');

        $this->db->where($this->vendor . '.status', 1);

        $this->db->like($this->vendor . '.name', $atten_inputs['q']);

        $query = $this->db->get($this->vendor)->result_array();

        return $query;
    }

    public function get_customer_by_id($id) {

        $this->db->select('name,mobil_number,email_id,address1');

        $this->db->where($this->vendor . '.id', $id);

        return $this->db->get($this->vendor)->result_array();
    }

    public function get_product($atten_inputs) {

        $this->db->select('id,model_no,product_name,product_description,product_image,type,cost_price');

        $this->db->where($this->erp_product . '.status', 1);

        $this->db->where($this->erp_product . '.type', 1);

        $this->db->like($this->erp_product . '.model_no', $atten_inputs['q']);

        $query = $this->db->get($this->erp_product)->result_array();

        return $query;
    }

    public function get_product_by_id($id) {

        $this->db->select('model_no,product_name,product_description,product_image');

        $this->db->where($this->erp_product . '.id', $id);

        return $this->db->get($this->erp_product)->result_array();
    }

    public function get_all_inv($filter) {

        $prodcut_id = $in_ids = array();

        if (!empty($filter)) {

            $product_id = $filter['product_id'];

            $this->db->select('in_id');

            $this->db->where('product_id', $product_id);

            $product_detail_query = $this->db->get('erp_invoice_details')->result_array();

            //echo $this->db->last_query();
            //exit;

            if (!empty($product_detail_query))
                $in_ids = array_map(function($product_detail_query) {

                    return $product_detail_query['in_id'];
                }, $product_detail_query);

            if (empty($in_ids)) {

                array_push($in_ids, 0);
            }
        }

        $this->db->select('customer.store_name,customer.name,customer.mobil_number,customer.email_id,customer.state_id,customer.address1,erp_invoice.id,erp_invoice.inv_id,erp_invoice.total_qty,erp_invoice.tax,erp_invoice.tax_label,'
                . 'erp_invoice.q_id,erp_invoice.customer,erp_invoice.net_total,erp_invoice.remarks,erp_invoice.subtotal_qty,erp_invoice.estatus,erp_invoice.estatus,erp_invoice.customer_po,erp_invoice.payment_status');

        if (!empty($in_ids)) {

            $this->db->where_in('erp_invoice.id', $in_ids);
        }

        $firms = $this->user_auth->get_user_firms();

        $frim_id = array();

        foreach ($firms as $value) {

            $frim_id[] = $value['firm_id'];
        }

        $this->db->where_in('erp_invoice.firm_id', $frim_id);

        $this->db->where('erp_invoice.estatus !=', 0);

        $this->db->where("erp_invoice.inv_id !=", 'Wings Invoice');

        $this->db->join('customer', 'customer.id=erp_invoice.customer');

        $query = $this->db->get('erp_invoice')->result_array();

        $i = 0;

        foreach ($query as $val) {

            $this->db->select('total_qty');

            $this->db->where('invoice_id', $val['id']);

            $this->db->order_by("id", "desc");

            $this->db->limit(1);

            $this->db->order_by("id", "desc");

            $this->db->limit(2);

            $query[$i]['return'] = $this->db->get('erp_sales_return')->result_array();

            $i++;
        }

        return $query;
    }

    function get_customer_data_by_sales() {
        $firms = $this->user_auth->get_user_firms();

        $frim_id = array();

        foreach ($firms as $value) {

            $frim_id[] = $value['firm_id'];
        }
        $this->db->select('erp_invoice.customer');
        $this->db->where_in('erp_invoice.firm_id', $frim_id);
        $this->db->group_by('erp_invoice.customer');
        $sales_return_customers = $this->db->get('erp_invoice')->result_array();

        $result = '';
        foreach ($sales_return_customers as $key => $data) {
            $this->db->select('id,store_name as customer_name');
            $this->db->where('id', $data['customer']);
            $customer_list = $this->db->get('customer')->result_array();
            $result[$key]['id'] = $customer_list[0]['id'];
            $result[$key]['customer_name'] = $customer_list[0]['customer_name'];
        }
        return $result;
    }

    function get_return_datatables($search_data) {

        $this->db->select('erp_invoice.*,customer.store_name as customer_name');
        $this->db->join('customer', 'customer.id=erp_invoice.customer');
        $query = $this->db->get('erp_invoice')->result_array();

        foreach ($query as $key => $data) {
            $this->db->select('SUM(return_qty) as return_quantity,SUM(sub_total) as return_amt');
            $this->db->where('customer', $data['customer']);
            $this->db->where('inv_id', $data['id']);
            $get_return_details = $this->db->get('sales_return_details')->result_array();
            $query[$key]['return_quantity'] = $get_return_details[0]['return_quantity'];
            $query[$key]['return_amt'] = $get_return_details[0]['return_amt'];
        }

        return $query;
    }

    function get_datatables($search_data) {



        $this->_get_datatables_query($search_data);

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get('erp_invoice')->result_array();



        $i = 0;

        foreach ($query as $val) {

            $this->db->select('total_qty,subtotal_qty,id,net_total');

            $this->db->where('invoice_id', $val['id']);

            $this->db->order_by("id", "desc");

            $this->db->limit(1);

            $query[$i]['return'] = $this->db->get('erp_sales_return')->result_array();

            $this->db->select('total_qty,subtotal_qty,id,net_total');

            $this->db->where('invoice_id', $val['id']);

            $this->db->order_by("id", "asc");

            $this->db->limit(1);

            $value = $this->db->get('erp_sales_return')->result_array();

            array_push($query[$i]['return'], $value[0]);

            $i++;
        }

//        echo '<pre>';
//        print_r($query);
//        die;
        //echo $this->db->last_query();
        //exit;



        return $query;
    }

    function _get_datatables_query($search_data = array()) {



        $prodcut_id = $in_ids = array();

        if (!empty($search_data['product_id'])) {

            $product_id = $search_data['product_id'];

            $this->db->select('in_id');

            $this->db->where('product_id', $product_id);

            $product_detail_query = $this->db->get('erp_invoice_details')->result_array();



            if (!empty($product_detail_query))
                $in_ids = array_map(function($product_detail_query) {

                    return $product_detail_query['in_id'];
                }, $product_detail_query);

            if (empty($in_ids)) {

                array_push($in_ids, 0);
            }
        }

        $this->db->select('customer.store_name,customer.name,customer.mobil_number,customer.email_id,customer.state_id,customer.address1,erp_invoice.id,erp_invoice.inv_id,erp_invoice.total_qty,erp_invoice.tax,erp_invoice.tax_label,'
                . 'erp_invoice.q_id,erp_invoice.delivery_qty,erp_invoice.customer,erp_invoice.net_total,erp_invoice.remarks,erp_invoice.subtotal_qty,erp_invoice.estatus,erp_invoice.estatus,erp_invoice.customer_po,erp_invoice.payment_status');

        if (!empty($in_ids)) {

            $this->db->where_in('erp_invoice.id', $in_ids);
        }

        $firms = $this->user_auth->get_user_firms();

        $frim_id = array();

        foreach ($firms as $value) {

            $frim_id[] = $value['firm_id'];
        }

        $this->db->where_in('erp_invoice.firm_id', $frim_id);

        $this->db->where('erp_invoice.estatus !=', 0);

        $this->db->where("erp_invoice.inv_id !=", 'Wings Invoice');

        $this->db->join('customer', 'customer.id=erp_invoice.customer');

        $column_order = array(null, 'erp_invoice.inv_id', 'customer.store_name', null, null, 'erp_invoice.total_qty', 'erp_invoice.net_total', null);

        $column_search = array('erp_invoice.inv_id', 'customer.store_name', 'erp_invoice.net_total', 'erp_invoice.total_qty');

        $order = array('erp_invoice.id' => 'DESC');

        $i = 0;

        foreach ($column_search as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $like = "" . $item . " LIKE '%" . $_POST['search']['value'] . "%'";

                    //$this->db->like($item, $_POST['search']['value']);
                } else {

                    //$query = $this->db->or_like($item, $_POST['search']['value']);

                    $like .= " OR " . $item . " LIKE '%" . $_POST['search']['value'] . "%'" . "";
                }
            }

            $i++;
        }

        if ($like) {

            $where = "(" . $like . " )";

            $this->db->where($where);
        }if (isset($_POST['order']) && $column_order[$_POST['order']['0']['column']] != null) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {

            $order = $order;

            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_all() {

        $this->db->from('erp_invoice');

        return $this->db->count_all_results();
    }

    function count_filtered($search_arr) {

        $this->_get_datatables_query($search_arr);

        $query = $this->db->get('erp_invoice');

        return $query->num_rows();
    }

    public function get_all_category($id) {

        $this->db->select('erp_category.*');
        $this->db->join('erp_invoice_details', 'erp_invoice_details.in_id=erp_invoice.id');
        $this->db->join('customer', 'customer.id=erp_invoice.customer');
        $this->db->join('erp_category', 'erp_category.cat_id=erp_invoice_details.category');
        $this->db->where('erp_invoice.customer', $id);
        $this->db->group_by('erp_invoice_details.category');
        $query = $this->db->get('erp_invoice')->result_array();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_brand($id) {

        $this->db->select('erp_brand.*');
        $this->db->join('erp_invoice_details', 'erp_invoice_details.in_id=erp_invoice.id');
        $this->db->join('customer', 'customer.id=erp_invoice.customer');
        $this->db->join('erp_brand', 'erp_brand.id=erp_invoice_details.brand');
        $this->db->where('erp_invoice.customer', $id);
        $this->db->group_by('erp_invoice_details.brand');
        $query = $this->db->get('erp_invoice')->result_array();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_all_inv_by_id($id) {

        $this->db->select('customer.store_name,customer.id as customer,customer.state_id, customer.name,customer.mobil_number,customer.email_id,customer.address1,erp_invoice.*,customer.tin');

        //$this->db->where('erp_invoice.estatus',1);

        $this->db->where('erp_invoice.customer', $id);

        $this->db->join('customer', 'customer.id=erp_invoice.customer');

        $query = $this->db->get('erp_invoice');

        if ($query->num_rows() >= 0) {

            return $query->result_array();
        }

        return false;
    }

    public function get_all_product_by_id($id) {

        $this->db->select('erp_product.id,erp_product.model_no,erp_product.product_name,erp_product.product_image,'
                . 'erp_po_details.product_description');

        $this->db->where('erp_po_details.id', $id);

        $this->db->join('erp_po', 'erp_po.id=erp_po_details.in_id');

        $this->db->join('erp_product', 'erp_product.id=erp_po_details.product_id');

        $query = $this->db->get('erp_po_details');

        if ($query->num_rows() >= 0) {

            return $query->result_array();
        }

        return false;
    }

    public function get_all_inv_details_by_id($id) {

        $this->db->select('erp_category.cat_id,erp_category.categoryName,erp_product.id,erp_product.product_name,erp_brand.id,erp_brand.brands,erp_product.model_no,erp_product.product_image,erp_product.type,erp_invoice_details.*');

        $this->db->where('erp_invoice.customer', $id);

        $this->db->join('erp_invoice', 'erp_invoice.id=erp_invoice_details.in_id');

        $this->db->join('erp_category', 'erp_category.cat_id=erp_invoice_details.category');

        $this->db->join('erp_product', 'erp_product.id=erp_invoice_details.product_id');

        $this->db->join('erp_brand', 'erp_brand.id=erp_invoice_details.brand', 'left');

        $query = $this->db->get('erp_invoice_details')->result_array();

        $i = 0;

        foreach ($query as $val) {

            $this->db->select('quantity');

            $this->db->where('category', $val['category']);

            $this->db->where('product_id', $val['product_id']);

            $this->db->where('brand', $val['brand']);

            $this->db->order_by('quantity', 'desc');

            $this->db->limit(1);

            $query[$i]['stock'] = $this->db->get('erp_stock')->result_array();

            $i++;
        }

        return $query;
    }

    public function get_all_customer_invoice_history($id, $from_date, $to_date) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $get_cutomer_details = $this->db->get('customer')->result_array();

        $result = '';
        $result['customer_id'] = $get_cutomer_details[0]['id'];
        $result['customer_name'] = $get_cutomer_details[0]['store_name'];
        $result['address'] = $get_cutomer_details[0]['address1'];
        $result['mobil_number'] = $get_cutomer_details[0]['mobil_number'];
        $result['email_id'] = $get_cutomer_details[0]['email_id'];
        $result['gstin'] = $get_cutomer_details[0]['tin'];
        $result['state_id'] = $get_cutomer_details[0]['state_id'];

        $this->db->select('erp_invoice.*');
        $this->db->where('erp_invoice.customer', $id);

        if ($from_date != "") {
            $this->db->where('erp_invoice.created_date >=', $from_date);
            $this->db->where('erp_invoice.created_date <=', $to_date);
        }

        $this->db->where('erp_invoice.inv_id !=', '');
        $invoice = $this->db->get('erp_invoice')->result_array();

        $result['invoice'] = $invoice;

        foreach ($invoice as $key => $data) {

            $this->db->select('erp_invoice_details.*,erp_product.product_name');
            $this->db->where('erp_invoice_details.in_id', $data['id']);
            $this->db->where('erp_invoice_details.quantity !=', 0);
            $this->db->where('erp_invoice_details.delivery_quantity !=', 0);
            $this->db->where('erp_invoice_details.customer_exists_qty !=', 0);
            $this->db->join('erp_product', 'erp_product.id=erp_invoice_details.product_id');
            $result['invoice'][$key]['invoice_details'] = $this->db->get('erp_invoice_details')->result_array();
        }

        return $result;
    }

    public function get_all_quotation_history_by_id($id) {

        $this->db->select('vendor.id,vendor.name,vendor.mobil_number,vendor.email_id,vendor.address1,erp_quotation_history.q_no,erp_quotation_history.total_qty,erp_quotation_history.tax,erp_quotation_history.ref_name,erp_quotation_history.tax_label,'
                . 'erp_quotation_history.net_total,erp_quotation_history.notification_date,erp_quotation_history.remarks,erp_quotation_history.subtotal_qty');

        $this->db->where('erp_quotation_history.eStatus', 1);

        $this->db->where('erp_quotation_history.id', $id);

        $this->db->join('vendor', 'vendor.id=erp_quotation_history.vendor');

        $query = $this->db->get('erp_quotation_history');

        if ($query->num_rows() >= 0) {

            return $query->result_array();
        }

        return false;
    }

    public function delete_po_deteils_by_id($id) {

        $this->db->where('po_id', $id);

        $this->db->delete($this->erp_po_details);
    }

    public function change_po_status($id, $status) {

        $this->db->where($this->erp_po . '.id', $id);

        if ($this->db->update($this->erp_po, array('estatus' => $status))) {

            return true;
        }

        return false;
    }

    public function update_po($data, $id) {

        $this->db->where($this->erp_po . '.id', $id);

        if ($this->db->update($this->erp_po, $data)) {

            return true;
        }

        return false;
    }

    public function delete_po($id) {

        $this->db->where('id', $id);

        if ($this->db->update($this->erp_po, $data = array('estatus' => 0))) {

            return true;
        }

        return false;
    }

    public function get_all_invoice_by_id($id) {

        $this->db->select('erp_user.nick_name,customer.id as customer,customer.store_name,customer.tin,customer.state_id,customer.advance, customer.name,customer.mobil_number,customer.email_id,customer.address1,customer.account_num, customer.ifsc,customer.bank_name,customer.customer_type,erp_invoice.id,erp_invoice.q_id,erp_invoice.inv_id,erp_quotation.q_no,erp_invoice.total_qty,erp_invoice.tax,erp_quotation.ref_name,erp_invoice.tax_label,'
                . 'erp_invoice.net_total,erp_invoice.round_off,erp_invoice.transport,erp_invoice.labour,erp_invoice.remarks,erp_invoice.subtotal_qty,erp_invoice.estatus,erp_invoice.customer_po,erp_invoice.created_date,erp_invoice.firm_id,erp_invoice.sales_man,erp_invoice.invoice_status,erp_invoice.delivery_status,erp_manage_firms.firm_name,erp_sales_man.sales_man_name');

        //$this->db->where('erp_invoice.estatus',1);

        $this->db->where('erp_invoice.id', $id);

        $this->db->join('erp_quotation', 'erp_quotation.id=erp_invoice.q_id', 'LEFT');

        $this->db->join('customer', 'customer.id=erp_invoice.customer', 'LEFT');

        $this->db->join('erp_user', 'erp_user.id=erp_quotation.ref_name', 'LEFT');

        $this->db->join('erp_manage_firms', 'erp_manage_firms.firm_id=erp_invoice.firm_id', 'LEFT');

        $this->db->join('erp_sales_man', 'erp_sales_man.id=erp_invoice.sales_man', 'LEFT');

        $query = $this->db->get('erp_invoice')->result_array();

        $i = 0;

        foreach ($query as $val) {

            $this->db->select('*');

            $this->db->where('j_id', intval($val['id']));

            $this->db->where('type', 'invoice');

            $query[$i]['other_cost'] = $this->db->get('erp_other_cost')->result_array();

            $this->db->select('SUM(total_qty) as total_quantity,SUM(return_qty) as return_quantity,SUM(sub_total) as return_amount,SUM(return_cost_total) as overall_net_total');
            $this->db->where('inv_id', $val['id']);
            $query[$i]['return_details'] = $this->db->get('sales_return_details')->result_array();

            $i++;
        }

        return $query;
    }

    public function get_all_invoice_details_by_id($id) {

        $this->db->select('erp_category.cat_id,erp_category.categoryName,erp_product.id,erp_product.product_name,erp_brand.id,erp_brand.brands,erp_product.hsn_sac_name,erp_invoice_details.category,erp_invoice_details.product_id,erp_invoice_details.brand,erp_invoice_details.quantity,erp_invoice_details.unit,'
                . 'erp_invoice_details.per_cost,erp_invoice_details.tax,erp_invoice_details.gst,erp_invoice_details.sub_total,erp_product.model_no,erp_product.product_image,erp_invoice_details.discount,erp_invoice_details.igst,'
                . 'erp_invoice_details.product_description');

        $this->db->where('erp_invoice_details.in_id', intval($id));

        $this->db->join('erp_quotation', 'erp_quotation.id=erp_invoice_details.q_id', 'LEFT');

        $this->db->join('erp_category', 'erp_category.cat_id=erp_invoice_details.category', 'left');

        $this->db->join('erp_product', 'erp_product.id=erp_invoice_details.product_id');

        $this->db->join('erp_brand', 'erp_brand.id=erp_invoice_details.brand', 'left');



        $query = $this->db->get('erp_invoice_details')->result_array();



        $i = 0;

        foreach ($query as $val) {

            $this->db->select('erp_stock.quantity');

            $this->db->where('product_id', $val['product_id']);

            //  if ($val['category'] != '')
            //    $this->db->where('category', $val['category']);
            //   if ($val['brand'] != '')
            //       $this->db->where('brand', $val['brand']);

            $query[$i]['stock'] = $this->db->get('erp_stock')->result_array();

            $i++;
        }

        return $query;
    }

    public function get_all_sr_by_id($id) {

        $this->db->select('erp_invoice.id');

        $this->db->where('erp_invoice.id', intval($id));

        $inv_id = $this->db->get('erp_invoice')->result_array();

        $this->db->select('erp_sales_return.*');

        $this->db->where('erp_sales_return.invoice_id', $inv_id[0]['id']);

        $query = $this->db->get('erp_sales_return')->result_array();







        $j = 0;

        foreach ($query as $val) {

            $this->db->select('SUM(return_quantity) as return_quantity');

            $this->db->where($this->erp_sales_return_details . '.in_id', $id);

            $this->db->where($this->erp_sales_return_details . '.return_id', $val['id']);

            $query[$j]['return_quantity'] = $this->db->get($this->erp_sales_return_details)->result_array();

            $this->db->select('SUM(sub_total) as sub_total');

            $this->db->where($this->erp_sales_return_details . '.in_id', $id);

            $this->db->where($this->erp_sales_return_details . '.return_id', $val['id']);

            $query[$j]['sub_total'] = $this->db->get($this->erp_sales_return_details)->result_array();

            $this->db->select('*');

            $this->db->where($this->erp_sales_return_details . '.in_id', $id);

            $this->db->where($this->erp_sales_return_details . '.return_id', $val['id']);

            $query[$j]['return_details'] = $this->db->get($this->erp_sales_return_details)->result_array();

            $j++;
        }

        return $query;
    }

    public function get_all_sr_details_by_id($id) {

        $this->db->select('erp_category.cat_id,erp_category.categoryName,erp_product.id,erp_product.product_name,erp_brand.id,erp_brand.brands,erp_product.hsn_sac_name,erp_sales_return_details.category,erp_sales_return_details.product_id,erp_sales_return_details.brand,'
                . 'erp_sales_return_details.return_quantity,erp_sales_return_details.unit,erp_sales_return_details.per_cost,erp_sales_return_details.tax,erp_sales_return_details.gst,erp_sales_return_details.sub_total,erp_product.model_no,erp_product.product_image,erp_sales_return_details.discount,erp_sales_return_details.igst,'
                . 'erp_sales_return_details.product_description,erp_sales_return_details.in_id');

        $this->db->where('erp_sales_return_details.in_id', intval($id));

        $this->db->join('erp_quotation', 'erp_quotation.id=erp_sales_return_details.q_id', 'LEFT');

        $this->db->join('erp_category', 'erp_category.cat_id=erp_sales_return_details.category', 'left');

        $this->db->join('erp_product', 'erp_product.id=erp_sales_return_details.product_id');

        $this->db->join('erp_brand', 'erp_brand.id=erp_sales_return_details.brand', 'left');

        $this->db->group_by('erp_sales_return_details.product_id');

//        $this->db->group_by('erp_sales_return_details.id', 'desc');

        $query = $this->db->get('erp_sales_return_details')->result_array();


        $this->db->select('product_id');

        $this->db->where($this->erp_invoice_details . '.in_id', $id);

        //$this->db->where($this->erp_sales_return_details . '.recevier', 1);

        $inv_details = $this->db->get($this->erp_invoice_details)->result_array();

        $product_id = array_column($inv_details, 'product_id');



        $j = 0;

        foreach ($query as $val) {



            $this->db->select('SUM(quantity) as actual_qty');

            $this->db->where($this->erp_invoice_product_details . '.in_id', $id);

            $this->db->where($this->erp_invoice_product_details . '.product_id', $val['product_id']);

            //$this->db->where($this->erp_sales_return_details . '.recevier', 1);

            $query[$j]['actual_qty'] = $this->db->get($this->erp_invoice_product_details)->result_array();



            $this->db->select('SUM(return_quantity) as return_qty');

            $this->db->where($this->erp_sales_return_details . '.in_id', $id);

            $this->db->where($this->erp_sales_return_details . '.product_id', $val['product_id']);

            //$this->db->where($this->erp_sales_return_details . '.recevier', 1);

            $query[$j]['return'] = $this->db->get($this->erp_sales_return_details)->result_array();





            $this->db->select('erp_invoice_details.quantity');

            $this->db->where('in_id', $val['in_id']);

            $query[$j]['invoice'] = $this->db->get('erp_invoice_details')->result_array();

            $j++;
        }



        $i = 0;

        foreach ($query as $val) {

            $this->db->select('erp_stock.quantity');

            $this->db->where('product_id', $val['product_id']);

            //  if ($val['category'] != '')
            //    $this->db->where('category', $val['category']);
            //   if ($val['brand'] != '')
            //       $this->db->where('brand', $val['brand']);

            $query[$i]['stock'] = $this->db->get('erp_stock')->result_array();

            $i++;
        }


        return $query;
    }

    public function get_all_sr_bill_details_by_id($id, $in_id) {

        $this->db->select('erp_category.cat_id,erp_category.categoryName,erp_product.id,erp_product.product_name,erp_brand.id,erp_brand.brands,erp_product.hsn_sac_name,erp_sales_return_details.category,erp_sales_return_details.product_id,erp_sales_return_details.brand,'
                . 'erp_sales_return_details.return_quantity,erp_sales_return_details.unit,erp_sales_return_details.per_cost,erp_sales_return_details.tax,erp_sales_return_details.gst,erp_sales_return_details.sub_total,erp_product.model_no,erp_product.product_image,erp_sales_return_details.discount,erp_sales_return_details.igst,'
                . 'erp_sales_return_details.product_description,erp_sales_return_details.in_id,erp_sales_return_details.return_id');

        $this->db->where('erp_sales_return_details.return_id', intval($id));

        $this->db->join('erp_quotation', 'erp_quotation.id=erp_sales_return_details.q_id', 'LEFT');

        $this->db->join('erp_category', 'erp_category.cat_id=erp_sales_return_details.category', 'left');

        $this->db->join('erp_product', 'erp_product.id=erp_sales_return_details.product_id');

        $this->db->join('erp_brand', 'erp_brand.id=erp_sales_return_details.brand', 'left');

        $this->db->group_by('erp_sales_return_details.product_id');

//        $this->db->group_by('erp_sales_return_details.id', 'desc');

        $query = $this->db->get('erp_sales_return_details')->result_array();





        $j = 0;

        foreach ($query as $val) {



            $this->db->select('SUM(quantity) as actual_qty');

            $this->db->where($this->erp_invoice_product_details . '.in_id', $val['in_id']);

            $this->db->where($this->erp_invoice_product_details . '.product_id', $val['product_id']);

            //$this->db->where($this->erp_sales_return_details . '.recevier', 1);

            $query[$j]['actual_qty'] = $this->db->get($this->erp_invoice_product_details)->result_array();



            $this->db->select('SUM(return_quantity) as return_qty');

            $this->db->where($this->erp_sales_return_details . '.in_id', $val['in_id']);

            $this->db->where($this->erp_sales_return_details . '.product_id', $val['product_id']);

            //$this->db->where($this->erp_sales_return_details . '.recevier', 1);

            $query[$j]['return'] = $this->db->get($this->erp_sales_return_details)->result_array();





            $this->db->select('erp_invoice_details.quantity');

            $this->db->where('in_id', $val['in_id']);

            $query[$j]['invoice'] = $this->db->get('erp_invoice_details')->result_array();

            $j++;
        }



        $i = 0;

        foreach ($query as $val) {

            $this->db->select('erp_stock.quantity');

            $this->db->where('product_id', $val['product_id']);

            //  if ($val['category'] != '')
            //    $this->db->where('category', $val['category']);
            //   if ($val['brand'] != '')
            //       $this->db->where('brand', $val['brand']);

            $query[$i]['stock'] = $this->db->get('erp_stock')->result_array();

            $i++;
        }

        return $query;
    }

    public function delete_sr_details($id) {

        $this->db->where('in_id', $id);

        $this->db->delete($this->erp_sales_return_details);
    }

    public function sales_return_details($id) {

        $this->db->select('sales_return_details.*,erp_product.id,erp_product.product_name,customer.store_name,customer.state_id,erp_product.hsn_sac');
        // $this->db->join('erp_category', 'erp_category.cat_id=erp_product.category_id', 'join');
        $this->db->join('erp_product', 'erp_product.id=sales_return_details.product_id');
        // $this->db->join('erp_brand', 'erp_brand.id=erp_product.brand_id', 'join');
        $this->db->join('customer', 'customer.id=sales_return_details.customer', 'join');
        $this->db->where('sales_return_details.inv_id', $id);
        $query = $this->db->get('sales_return_details')->result_array();

        foreach ($query as $key => $data) {
            $this->db->select('*');
            $this->db->where('cat_id', $data['cat_id']);
            $cat_data = $this->db->get('erp_category')->result_array();
            $query[$key]['categoryName'] = $cat_data[0]['categoryName'];


            $this->db->select('*');
            $this->db->where('id', $data['brand_id']);
            $cat_data = $this->db->get('erp_brand')->result_array();
            $query[$key]['brands'] = $cat_data[0]['brands'];
        }

        return $query;
    }

}
