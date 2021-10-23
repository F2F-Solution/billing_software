<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>

<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/css/fSelect.css"/>
<script type='text/javascript' src='<?= $theme_path; ?>/js/fSelect.js'></script>

<style type="text/css">

    #toast-container.toast-top-left>div {
        width: 300px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 60px;
        top: -43px;
        left: 200px;
    }
    .toast-top-left {
        top: -43px;
        left: 200px;

    }

    .btn-xs

    {

        border-radius: 0px;

    }

    .text_right

    {

        text-align:right;

    }

    .box, .box-body, .content { padding:0; margin:0;border-radius: 0;}

    #top_heading_fix h3 {top: -57px;left: 6px;}

    #TB_overlay { z-index:20000 !important; }

    #TB_window { z-index:25000 !important; }

    .dialog_black{ z-index:30000 !important; }

    #boxscroll22 {max-height: 291px;overflow: auto;cursor: inherit !important;}

    .error_msg, em{color: rgb(255, 0, 0); font-size: 12px;font-weight: normal;}

    .auto-asset-search ul#country-list li:hover {

        background: #c3c3c3;

        cursor: pointer;

    }

    .auto-asset-search ul#product-list li:hover {

        background: #c3c3c3;

        cursor: pointer;

    }

    .auto-asset-search ul#country-list li {

        background: #dadada;

        margin: 0;

        padding: 5px;

        border-bottom: 1px solid #f3f3f3;

    }

    .auto-asset-search ul#product-list li {

        background: #dadada;

        margin: 0;

        padding: 5px;

        border-bottom: 1px solid #f3f3f3;

    }

    ul li {

        list-style-type: none;

    }

    .btn-info { background-color:#3db9dc;border-color: #3db9dc;color:#fff;  }

    .btn-info:hover { background-color:#25a7cb;}

    .btn-xs {

        border-radius: 0px !important;

        padding: 2px 5px 1px 5px;

    }
    .fs-wrap, .multiple, .fs-default, .fs-dropdown{
        width: 100% !important;
    }
    .subtable {
        display: none;
    }
</style>

<div class="mainpanel">

    <div id='empty_data'></div>

    <div class="contentpanel mb-25">

        <div class="media">

            <h4>Sales Return</h4>

        </div>




        <form  action="<?php echo $this->config->item('base_url'); ?>sales_return/make_return/<?php echo $customer['customer_id']; ?>" method="post" class=" panel-body">

            <div class="row hide_class ">

                <div class="col-md-6">


                    <div class="form-group" >

                        <label class="col-sm-4 control-label">Customer Name</label>

                        <div class="col-sm-8">

                            <input type="text"  name="customer[customer_name]" id="customer_name" class='  form-control auto_customer form-align  ' value="<?php echo $customer['customer_name']; ?>"  readonly="readonly"/>



                            <input type="hidden"  name="customer[id]" id="customer_id" class=' form-control  id_customer form-align tabwid' value="<?php echo $customer['customer_id']; ?>" />

                            <input type="hidden"  name="firm_id" id="firm_id" class=' form-control  firm_id form-align tabwid' value="<?php echo $customer['firm_id']; ?>" />

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-4 control-label">Customer Mobile No</label>

                        <div class="col-sm-8">

                            <input type="text"  name="customer[mobil_number]" class="form-control form-align  " id="customer_no" value="<?php echo $customer['mobil_number']; ?>" readonly="readonly"/>

                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-sm-4 control-label">Invocie Id</label>

                        <div class="col-sm-8">


                            <select id='customer_invoice_id' name="customer[invoice_id][]" class="form-control multi_select wid100 required" multiple="multiple" >

                                <option>Select</option>

                                <?php
                                if (isset($customer['invoice']) && !empty($customer['invoice'])) {

                                    foreach ($customer['invoice'] as $val) {
                                        if (!empty($val['invoice_details'])) {
                                            ?>

                                            <option value='<?= $val['inv_id'] ?>'><?= $val['inv_id'] ?></option>

                                            <?php
                                        }
                                    }
                                }
                                ?>

                            </select>

                            <span class="error_msg inv_id_error"></span>

                        </div>

                    </div>

                    <input type="hidden" id="already_select" value="" name="already_select[]">


                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label class="col-sm-4 control-label">Customer Address</label>

                        <div class="col-sm-8">

                            <textarea name="customer[address1]" class=" form-control form-align" id="address1" readonly="readonly"><?php echo $customer['address']; ?></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-4 control-label">GSTIN No</label>

                        <div class="col-sm-8">

                            <input type="text" name="customer[tin_no]" class="form-control form-align" value="<?= $customer['gstin'] ?>" readonly="readonly" />

                        </div>

                    </div>


                    <div class="form-group">

                        <label class="col-sm-4 control-label">Customer Email ID</label>

                        <div class="col-sm-8" id='customer_td'>

                            <input type="text"  name="customer[email_id]" class=" form-control form-align  " id="email_id" value="<?php echo $customer['email_id']; ?>" readonly="readonly"/>

                        </div>

                    </div>



                </div>

            </div>







            <div class="mscroll">

                <table class="table table-striped table-bordered responsive dataTable no-footer dtr-inline" id="add_quotation">

                    <thead>

                        <tr>

                            <td width="2%" class="first_td1">S.No</td>

                            <td width="9%" class="first_td1">INV ID</td>

                            <td width="9%" class="first_td1">Category</td>

                            <td width="14%" class="first_td1">Product Name</td>

                            <td width="8%" class="first_td1">Brand</td>

                            <td width="3%" class="first_td1">Unit</td>

                            <td  width="8%" class="first_td1 action-btn-align">QTY</td>

                            <td  width="5%" class="first_td1 action-btn-align">Unit Price</td>

                            <td  width="3%" class="first_td1">CGST %</td>

                            <?php
                            $gst_type = $customer['state_id'];

                            if ($gst_type != '') {

                                if ($gst_type == 31) {
                                    ?>

                                    <td  width="3%" class="first_td1  proimg-wid" >SGST%</td>

                                <?php } else { ?>

                                    <td  width="3%" class="first_td1 proimg-wid" >IGST%</td>



                                    <?php
                                }
                            }
                            ?>

                            <td  width="3%" class="first_td1">Basic Value</td>
                            <td  width="3%" class="first_td1">Net Value</td>

                            <td  width="2%" class="first_td1">Remove</td>



                        </tr>

                    </thead>



                    <tbody id='app_table'>
                        <?php
                        if (isset($customer['invoice']) && !empty($customer['invoice'])) {

                            $i = 1;

                            foreach ($customer['invoice'] as $vals) {
                                foreach ($vals['invoice_details'] as $inv_details) {
                                    ?>

                                    <tr class="invid_<?php echo $vals['inv_id']; ?>   invoice_tr_class" style="display:none" data-val="0">
                                        <td class="action-btn-align s_no" ><?php echo $i ?></td>
                                        <td class="action-btn-align" width=""><?php echo $vals['inv_id']; ?></td>
                                <input type="hidden" name="firm_id[]" value="<?php echo $vals['firm_id']; ?>" id="invoiceId"/>
                                <input type="hidden" name="inv_detail_id[]" value="<?php echo $inv_details['id']; ?>" id="invoiceId"/>
                                <input type="hidden" name="inv_id[]" value="<?php echo $vals['id']; ?>" id="invoiceId"/>
                                <input type="hidden" name="invoiceId[]" value="<?php echo $vals['inv_id']; ?>" id="invoiceId"/>
                                <input type="hidden" name="advance"  readonly="readonly" value="<?php echo (!empty($vals['advance'])) ? $vals['advance'] : 0; ?>"  class="advance"  />
                                <td width="">
            <!--                                    <input type="hidden" id='cat_id' class='form-align cat_id static_style class_req form-control' name='categoty[]' readonly="" value='<?php echo $inv_details['cat_id'] ?>'>
                                    <input type="text" class="form-align form-control" readonly="" value='<?php echo $inv_details['categoryName'] ?>' readonly="">-->

                                    <select id='cat_id' tabindex="-1" class='form-align cat_id static_style class_req form-control' style="width:100%" name='categoty[]' readonly="" >
                                        <option value="">Select</option>
                                        <?php
                                        if (isset($category) && !empty($category)) {
                                            foreach ($category as $val) {
                                                $select = ($val['cat_id'] == $inv_details['category']) ? 'selected' : '';
                                                ?>
                                                <option value="<?php echo $val['cat_id']; ?>" <?php echo $select; ?>><?php echo $val['categoryName'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                    <span class="error_msg"></span>
                                    <input type="hidden" style="width:100%"  class='form-align form-control tabwid model_no_extra ' readonly="readonly"/>
                                </td>
                                <td width="" class="model_no_class">
                                    <input type="text"  name="model_no[]" style="width:100%" id="model_no" value="<?php echo $inv_details['product_name'] ?>" class='form-align auto_customer tabwid model_no form-control' readonly="" />
                                    <span class="error_msg"></span>
                                    <input type="hidden"  name="product_id[]" id="product_id" class=' tabwid form-align product_id' value="<?php echo $inv_details['product_id'] ?>"/>
                                    <input type="hidden"  name="type[]" id="type" class=' tabwid form-align type' />
                                    <div id="suggesstion-box1" class="auto-asset-search suggesstion-box1"></div>
                                </td>
                                <td width="">

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!--                                    <input type="hidden" class="form-align form-control brand_id" name='brand[]' readonly="" value='<?php echo $inv_details['id'] ?>'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <input type="text" class=" form-align form-control" readonly="" value='<?php echo $inv_details['brands'] ?>' readonly="">-->

                                    <select tabindex="-1" name='brand[]'  class="form-align form-control brand_id" readonly="">
                                        <option >Select</option>
                                        <?php
                                        if (isset($brand) && !empty($brand)) {
                                            foreach ($brand as $val) {
                                                $select_brand = ($val['id'] == $inv_details['brand']) ? 'selected' : '';
                                                ?>
                                                <option value='<?php echo $val['id'] ?>'<?php echo $select_brand; ?>><?php echo $val['brands'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                    <span class="error_msg"></span>
                                </td>
                                <td class="" width="">
                                    <input type="text"  tabindex="-1"   name='unit[]' value="<?php echo $inv_details['unit']; ?>" style="width:70px;" class="unit form-control" readonly="readonly"/>
                                    <span class="error_msg"></span>
                                </td>
                                <td width=""><div class="col-md-12 sales_qty_details">
                                        <div class="col-md-6">
                                            <input type="text" tabindex="-1" name='available_quantity[]' style="width:40px;" class="form-control avail_qty  stock_qty" value="<?php echo $inv_details['customer_exists_qty'] ?>" readonly="readonly"/>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text"  tabindex="-1"   sales_qty="<?php echo $inv_details['customer_exists_qty'] ?>" name='return_quantity[]' style="width:40px;" class="qty form-control return_qty" data-invid="<?php echo $inv_details['id']; ?>"/>
                                        </div>
                                        <span class="error_msg"></span>
                                    </div>
                                </td>
                                <td width="">
                                    <input type="text" tabindex="-1"    name='per_cost[]' style="width:70px;" class="cost_price percost form-control " value="<?php echo $inv_details['per_cost'] ?>" id="price" readonly=""/>

                                    <input type="hidden" tabindex="-1"    name='total_sales_amt[]' style="width:70px;" class="total_sales_amt  form-control " value="<?php echo $inv_details['per_cost'] * $inv_details['customer_exists_qty']; ?>" id="total_sales_amt" readonly=""/>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!--<input type="hidden"   tabindex="-1"   name='pertax[]' style="width:70px;" class="pertax" value="0"/>-->

                                    <input type="hidden"   tabindex="-1"   name='transport[]' style="width:70px;" class="transport" value="<?php echo $vals['transport']; ?>"/>
                                    <input type="hidden"   tabindex="-1"   name='labour[]' style="width:70px;" class="labour" value="<?php echo $vals['labour']; ?>"/>
                                    <input type="hidden" name="round_off[]" class="round_off text_right" style="width:70px;" readonly="" value="<?php echo $vals['round_off']; ?>">

                                    <input type="hidden"   tabindex="-1"   name='discount[]' style="width:70px;" class="discount" value="<?php echo $inv_details['discount']; ?>"/>
                                    <span class="error_msg"></span>
                                </td>



                                <td  width="" class="action-btn-align gst_td">
                                    <input  type="text" tabindex="-1"  name='tax[]' style="width:70px;" class="pertax form-control" value="<?php echo number_format($inv_details['tax'], 2); ?>" readonly="" />
            <!--                                    <input type="text"  tabindex="-1"    name='gst[]' value="<?php echo number_format($inv_details['gst'], 2) ?>" style="width:70px;" class="gst form-control" readonly="" />-->
                                </td>

                                <?php
                                $gst_type = $customer['state_id'];

                                if ($gst_type != '') {

                                    if ($gst_type == 31) {
                                        ?>

                                        <td width="" class="action-btn-align igst_td">

                                            <input  type="text" tabindex="-1" name='gst[]' style="width:70px;" class="gst form-control" value="<?php echo number_format($inv_details['gst'], 2); ?>" readonly=""/>

                                        </td>

                                    <?php } else { ?>

                                        <td width="" class="action-btn-align igst_td">

                                            <input type="text" name='igst[]' tabindex="-1" style="width:70px;" class="igst form-control" value="<?php echo number_format($inv_details['igst'], 2); ?>" readonly=""/>

                                        </td>

                                        <?php
                                    }
                                }
                                ?>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!--                                <td width="" class="action-btn-align igst_td">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <input type="text"   tabindex="-1"   name='igst[]' value="<?php echo number_format($inv_details['igst'], 2) ?>" style="width:70px;" class="igst wid50 form-control"  readonly=""/>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </td>-->


                                <input type="hidden"  tabindex="-1"  style="width:70px;" name='sub_total[]' value="<?php echo $inv_details['sub_total'] ?>" readonly="readonly" id="sub_toatl" class="subtotal text_right form-control" />


                                <td width="">
                                    <input type="text"  tabindex="-1"  style="width:70px;" name='basic_return_amt[]' value="0.00" readonly="readonly" id="basic_return_amt" class="basic_return_amt<?php echo $inv_details['id']; ?>  text_right form-control" />
                                </td>
                                <td width="">
                                    <input type="text"  tabindex="-1"  style="width:70px;" name='total_return_amt[]' value="0.00" readonly="readonly" id="total_return_amt" class="total_return_amt<?php echo $inv_details['id']; ?>  text_right form-control" />
                                </td>


                                <td class="action-btn-align hide_class" >


                                    <a id='delete_group' href="javascript:" class="btn-sm btn-danger delete_group"><span class="glyphicon glyphicon-trash"></span></a>

                                </td>

                                </tr>
                                <?php
                                $i++;
                            }
                        }
                    }
                    ?>




                    </tbody>
                    <tbody class="subtable">
                    <td colspan="5" style="width:70px; text-align:right;">Total</td>
                    <td><input type="text"   name="po[total_qty]" readonly="readonly" class="total_qty" style="width:70px; margin-left:17px;" id="total" /></td>
                    <td colspan="3" style="text-align:right;">Sub Total</td>
                    <td><input type="text" name="po[subtotal_qty]"  readonly="readonly"  class="final_sub_total text_right" style="width:70px;" /><input type="hidden" class="temp_sub_total" value="" /></td>


                    </tbody>
                    <tbody class="subtable">
                    <td colspan="9" style="text-align:right;">Advance Amount</td>
                    <td><input type="text" name="advance"  readonly="readonly"  class="advance text_right" style="width:70px;" /></td>

                    </tbody>
                    <tbody class="addtional subtable">
                    <td colspan="9" style="text-align:right;">Round Off ( - )<br>

                    </td>
                    <td><input type="text" name="po[round_off]" class="round_off text_right" style="width:70px;" readonly />

                    </td>

                    </tbody>
                    <tbody class="additional subtable">
                    <td colspan="4" style="text-align:right;">CGST:</td>
                    <td><input type="text"  readonly class="add_cgst text_right" style="width:70px;" /></td>
                    <?php
                    $gst_type = $customer['state_id'];
                    if ($gst_type != '') {
                        if ($gst_type == 31) {
                            ?>
                            <td colspan="4" style="text-align:right;">SGST:</td>
                        <?php } else { ?>
                            <td colspan="4" style="text-align:right;">IGST:</td>
                            <?php
                        }
                    }
                    ?>
                    <td><input type="text"  readonly class="add_sgst text_right" style="width:70px;" /></td>

                    </tbody>
                    <tbody class="addtional subtable">
                    <td colspan="4" style="text-align:right;">Transport Charge</td>
                    <td><input type="text" name="po[transport]"  class="transport text_right" style="width:70px;" readonly=""/></td>
                    <td colspan="4" style="text-align:right;">Labour Charge</td>
                    <td><input type="text" name="po[labour]"  class="labour text_right" style="width:70px;" readonly="" /></td>

                    </tbody>
                    <tfoot class="subtable">
                        <tr>
                            <td colspan="4" style="width:70px; text-align:right;"></td>
                            <td colspan="5"style="text-align:right;font-weight:bold;">Net Total</td>
                            <td><input type="text"  name="po[net_total]"  readonly="readonly"  class="final_amt text_right" style="width:70px;" value="" /></td>

                        </tr>
                        <tr>
                            <td colspan="10">
                                <span>Remarks&nbsp;</span>
                                <input name="po[remarks]" type="text" class="form-control"  style="width:90%; display: inline"/>
                            </td>
                        </tr>
                    </tfoot>
                    <input type="hidden"  name="gst_type" id="gst_type" class="gst_type" value="<?php echo $customer['state_id']; ?>"/>

                </table>
            </div>


            <div class="action-btn-align">

                <button class="btn btn-info " id="save"> Update </button>
<!--                <a href="<?php echo $this->config->item('base_url'); ?>sales_return/sales_return_bill/<?php echo $val['id']; ?>" class="tooltips btn btn-info"><span class="glyphicon glyphicon-print"></span> Print </a>-->

                <a href="<?php echo $this->config->item('base_url') . 'sales_return/' ?>" class="btn btn-defaultback1"><span class="glyphicon"></span> Back </a>

            </div>
        </form>
        <br />


    </div><!-- contentpanel -->

</div><!-- mainpanel -->







<table class="static" style="display: none;">
    <tr >
        <td class="action-btn-align s_no" width="3%"></td>
        <td class="action-btn-align" width="6%"></td>
        <td width="11%">
            <select id='cat_id' tabindex="-1" class='form-align cat_id static_style class_req form-control' style="width:100%" name='categoty[]' >
                <option value="">Select</option>
                <?php
                if (isset($category) && !empty($category)) {
                    foreach ($category as $val) {
                        ?>
                        <option value='<?php echo $val['cat_id'] ?>'><?php echo $val['categoryName'] ?></option>
                        <?php
                    }
                }
                ?>

            </select>
            <span class="error_msg"></span>
            <input type="hidden" style="width:100%"  class='form-align form-control tabwid model_no_extra ' readonly="readonly"/>
        </td>
        <td width="16%" class="model_no_class">
            <input type="text"  name="model_no[]" style="width:100%" id="model_no" class='form-align auto_customer tabwid model_no form-control' />
            <span class="error_msg"></span>
            <input type="hidden"  name="product_id[]" id="product_id" class=' tabwid form-align product_id' />
            <input type="hidden"  name="type[]" id="type" class=' tabwid form-align type' />
            <div id="suggesstion-box1" class="auto-asset-search suggesstion-box1"></div>
        </td>
        <td width="11%">
            <select tabindex="-1" name='brand[]'  class="form-align form-control brand_id">
                <option >Select</option>
                <?php
                if (isset($brand) && !empty($brand)) {
                    foreach ($brand as $val) {
                        ?>
                        <option value='<?php echo $val['id'] ?>'><?php echo $val['brands'] ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <span class="error_msg"></span>
        </td>
        <td class="" width="7%">
            <input type="text"  tabindex="-1"   name='unit[]' style="width:70px;" class="unit" readonly=""/>
            <span class="error_msg"></span>
        </td>
        <td width="16%"><div class="col-md-12 sales_qty_details">
                <div class="col-md-6">
                    <input type="text" tabindex="-1" name='available_quantity[]' style="width:40px;" class="form-control avail_qty stock_qty" value="0" readonly="readonly"/>
                </div>
                <div class="col-md-6">
                    <input type="text"  tabindex="-1"   name='return_quantity[]' style="width:40px;" class="qty form-control return_qty" />
                </div>
                <span class="error_msg"></span>
            </div>
        </td>
        <td width="11%">
            <input type="text" tabindex="-1"    name='per_cost[]' style="width:70px;" class="cost_price percost " id="price" readonly=""/>

            <!--<input type="hidden"   tabindex="-1"   name='pertax[]' style="width:70px;" class="pertax" />-->

            <input type="hidden"   tabindex="-1"   name='transport[]' style="width:70px;" class="transport" value=""/>

            <input type="hidden"   tabindex="-1"   name='discount[]' style="width:70px;" class="discount" />
            <span class="error_msg"></span>
        </td>

        <!--
                <td  width="6%" class="action-btn-align sgst_td">
                    <input type="text"  tabindex="-1"    name='gst[]' style="width:70px;" class="gst" readonly=""/>
                </td>-->

        <td class="action-btn-align" width="7%">
            <input type="text"   tabindex="-1"   name='tax[]' style="width:70px;" class="pertax" value="" readonly="readonly" />
        </td>

        <?php
        $gst_type = $customer[0]['state_id'];
        if ($gst_type != '') {
            if ($gst_type == 31) {
                ?>
                <td width="7%"  class="action-btn-align sgst_td">
                    <input type="text"  name='gst[]' style="width:70px;" class="gst" value="" readonly="readonly" />
                </td>
            <?php } else { ?>
                <td width="7%" class="action-btn-align igst_td" >
                    <input type="text" name='igst[]' style="width:70px;" class="igst" value="" readonly="readonly"/>
                </td>
                <?php
            }
        }
        ?>

        <!--
                <td width="7%" class="action-btn-align igst_td">
                    <input type="text"   tabindex="-1"   name='igst[]' style="width:70px;" class="igst wid50" readonly="" />
                </td>-->

        <td width="7%">
            <input type="text"  tabindex="-1"  style="width:70px;" name='sub_total[]' readonly="readonly" id="sub_toatl" class="subtotal text_right" />
        </td>


        <td class="action-btn-align hide_class" >


            <a id='delete_group' href="javascript:" class="btn-sm btn-danger delete_group"><span class="glyphicon glyphicon-trash"></span></a>

        </td>

    </tr>
</table>



<script type="text/javascript">

    $('#save').live('click', function () {
        m = 0;
        $('.required').each(function () {

            this_val = $.trim($(this).val());




            if (this_val == '') {

                $('.inv_id_error').text('This field is required').css('display', 'inline-block');
                m++;


            } else {
                $('.inv_id_error').text("");

            }

        });
        $('.return_qty').each(function () {
            var qty = $(this).val();
            var sales_qty = $(this).attr('sales_qty');
            var inv_id = $(this).attr('data-invid');

            if (Number(qty) > Number(sales_qty)) {
                $(this).closest('tr').find('.sales_qty_details .error_msg').text('Invalid quantity');
                $('.total_return_amt' + inv_id + '').val("0.00");
                m++;
            } else {
                //$(this).closest('tr').attr('data-returnqty', qty);
                $(this).closest('tr').find('.sales_qty_details .error_msg').text(' ');
            }
        });
        if (m > 0)
        {
            return false;
        }

    });


    $('.multi_select').fSelect();

    $('.fs-label-wrap').find('.fs-label').text('Select Invoice ID');


    $(document).ready(function () {

        jQuery('.datepicker').datepicker();

    });

    $(document).on('change', '#customer_invoice_id', function () {

        var selectedValues = $('#customer_invoice_id').val();

        var already_select = [];

        var already_selected = $('#already_select').val();

        if (selectedValues == null || selectedValues == "Select") {
            $('#app_table').find('.invoice_tr_class').hide();
            $('#already_select').val('');
        } else {
            var exists = already_selected.split(",");

            if (selectedValues.length < exists.length) {


                $("#customer_invoice_id option:not(:selected)").each(function () {

                    var unselect = $(this).text();

                    if (unselect != "Select") {

                        $('.inv_id_trfirst' + unselect).remove();
                        $('.inv_id_trsecond' + unselect).remove();
                        y = jQuery.grep(exists, function (value) {
                            return value != unselect;
                        });
                        $('#already_select').val(y);

                        $('.invid_' + unselect + '').hide();
                        $('.invid_' + unselect + '').attr('data-val', 0);
                    }
                });


            }
            if ($.trim(already_selected) != "") {

                var exists = already_selected.split(",");
                $.each(selectedValues, function (i, val) {

                    if (jQuery.inArray(val, exists) > -1 && exists.length > 0)
                    {

                    } else {
                        exists.push(val);
                        var already_selected = $('#already_select').val(exists);

                        $('.invid_' + val + '').show();
                        $('.invid_' + val + '').attr('data-val', 1);
                    }

                });
            } else {

                var already_select = [];

                $.each(selectedValues, function (i, val) {
                    already_select.push(val);

                    $('.invid_' + val + '').show();
                    $('.invid_' + val + '').attr('data-val', 1);
                });

                $('#already_select').val(already_select);


            }
        }

        var j = 1;
        $('#app_table').find('tr').each(function () {
            $(this).closest("tr").find('.s_no').html(j);
            j++;
        });

    });


    $('.delete_group').live('click', function () {

        $(this).closest("tr").remove();
        var j = 1;
        $('#app_table').find('tr').each(function () {
            $(this).closest("tr").find('.s_no').html(j);
            j++;
        });


    });



    $('.return_qty').live('keyup', function () {
        var qty = $(this).val();

        var data = $(this);
        var sales_qty = $(this).attr('sales_qty');
        var inv_id = $(this).attr('data-invid');

        if (Number(qty) > Number(sales_qty)) {
            $(this).closest('tr').find('.sales_qty_details .error_msg').text('Invalid quantity');
            $('.total_return_amt' + inv_id + '').val("0.00");
            return false;
        } else {
            //$(this).closest('tr').attr('data-returnqty', qty);
            $(this).closest('tr').find('.sales_qty_details .error_msg').text(' ');
            calculate_function(data);
        }

    });


    function calculate_function(this_val)
    {
        var rq = this_val.closest('tr').find('.return_qty');

        var final_qty = 0;

        var final_sub_total = 0;

        var transport = Number($('.transport').val());

        var labour = Number($('.labour').val());

        var advance = Number($('.advance').val());

        var cgst = 0;

        var sgst = 0;

        //  $('.return_qty').each(function () {

        var rq = this_val.closest('tr').find('.return_qty');

        var inv_id = this_val.closest('tr').find('.return_qty').attr('data-invid');


        var qty = this_val.closest('tr').find('.avail_qty');

        var percost = this_val.closest('tr').find('.percost');

        var pertax = this_val.closest('tr').find('.pertax');

        var subtotal = this_val.closest('tr').find('.subtotal');

        var total_return_amt = this_val.closest('tr').find('.total_return_amt');

        var round_off = this_val.closest('tr').find('.round_off');

        if ($('#gst_type').val() != '')

        {

            if ($('#gst_type').val() == 31)

            {

                gst = this_val.closest('tr').find('.gst');



            } else {

                gst = this_val.closest('tr').find('.igst');

            }

        }


        if (Number(rq.val()) != 0 && Number(rq.val()) != '')
        {

            tot = Number(qty.val()) * Number(percost.val());

            taxless = Number(rq.val()) * Number(percost.val());

            pertax1 = Number(pertax.val() / 100) * Number(percost.val());

            gst1 = Number(gst.val() / 100) * Number(percost.val());

            cgst += Number(pertax.val() / 100) * taxless;

            sgst += Number(gst.val() / 100) * taxless;


            var discount1 = 0;

            sub_total1 = ((Number(qty.val()) - Number(rq.val())) * Number(percost.val()));

            sub_total = sub_total1 - (discount1 * (Number(qty.val()) - Number(rq.val())));

            subtotal.val(sub_total1.toFixed(2));

            final_qty = final_qty + (Number(qty.val()) - Number(rq.val()));

            final_sub_total = final_sub_total + sub_total;

            var total_return_val = rq.val() * percost.val();



            var subtotal_amt = total_return_val + cgst + sgst + transport + labour;
            var finaltotal_amt = subtotal_amt - advance;

            value = finaltotal_amt.toFixed(2);

            var round = value.split('.');


            $('.round_off').val('0.' + round[1]);

            var temp_round_off_minus = Number($('.round_off').val());

            var finals = finaltotal_amt - Number(temp_round_off_minus);

            finals = Math.abs(finals);

            $('.basic_return_amt' + inv_id + '').val((total_return_val).toFixed(2));

            $('.total_return_amt' + inv_id + '').val(finals.toFixed(2));



        } else {
            $('.basic_return_amt' + inv_id + '').val('0.00');
            $('.total_return_amt' + inv_id + '').val('0.00');
        }

        //  });

        $('.transport').val('0.00');

        $('.labour').val('0.00');

        $('.add_cgst').val(cgst.toFixed(2));

        $('.add_sgst').val(sgst.toFixed(2));

        $('.total_qty').val(final_qty);

        $('.final_sub_total').val(final_sub_total.toFixed(2));




    }




</script>




