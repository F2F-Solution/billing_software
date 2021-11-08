<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?php echo $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/js/jquery.scannerdetection.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js//sweetalert.css">
<script src="<?php echo $theme_path; ?>/js/sweetalert.min.js" type="text/javascript"></script>
<style type="text/css">
    .text_right {
        text-align: right;
    }

    .box,
    .box-body,
    .content {
        padding: 0;
        margin: 0;
        border-radius: 0;
    }

    #top_heading_fix h3 {
        top: -57px;
        left: 6px;
    }

    #TB_overlay {
        z-index: 20000 !important;
    }

    #TB_window {
        z-index: 25000 !important;
    }

    .dialog_black {
        z-index: 30000 !important;
    }

    #boxscroll22 {
        max-height: 291px;
        overflow: auto;
        cursor: inherit !important;
    }

    .error_msg,
    em {
        color: rgb(255, 0, 0);
        font-size: 12px;
        font-weight: normal;
    }

    .ui-datepicker td.ui-datepicker-today a {
        background: #999999;
    }

    .auto-asset-search {
        position: absolute !important;
    }

    .auto-asset-search ul#country-list li {
        margin-left: -40px !important;
        width: 297px;
    }

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
        width: 297px;
    }

    ul li {
        list-style-type: none;
    }

    #suggesstion-box {
        z-index: 99;
    }
</style>
<?php
$model_numbers_json = array();
if (!empty($products)) {
    foreach ($products as $list) {
        $model_numbers_json[] = '{ id: "' . $list['id'] . '", value: "' . $list['product_name'] . '"}';
    }
}
$model_numbers_extra = array();
if (!empty($products)) {
    foreach ($products as $list) {
        if (!empty($list['model_no'])) {
            $model_numbers_extra[] = '{ id: "' . $list['id'] . '", value: "' . $list['model_no'] . '"}';
        }
    }
}
$customers_json = array();
if (!empty($customers)) {
    foreach ($customers as $list) {
        $customers_json[] = '{ id: "' . $list['id'] . '", value: "' . $list['store_name'] . '"}';
    }
}
?>
<div class="mainpanel">
    <div id='empty_data'></div>
    <div class="contentpanel mb-45">
        <div class="media">
            <h4>New Purchase Request</h4>
        </div>
        <table class="static" style="display: none;">
            <tr>
                <td class="action-btn-align s_no"></td>
                <td>
                    <select id='cat_id' class='form-align cat_id static_style class_req form-control' style="width:100%" name='categoty[]'>
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
                    <input type="hidden" style="width:100%" class='form-align form-control tabwid model_no_extra ' readonly="readonly" />
                </td>
                <td style="display:none">
                </td>
                <td>
                    <input type="text" name="model_no[]" style="width:100%" id="model_no" class='form-align auto_customer tabwid model_no form-control' tabindex="1" />
                    <span class="error_msg"></span>
                    <input type="hidden" name="product_id[]" id="product_id" class=' tabwid form-align product_id' />
                    <input type="hidden" name="type[]" id="type" class=' tabwid form-align type' />
                    <div id="suggesstion-box1" class="auto-asset-search suggesstion-box1"></div>
                </td>
                <td>
                    <select name='brand[]' tabindex="1" class="form-align form-control brand_id">
                        <option>Select</option>
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
                <td class="action-btn-align">
                    <input type="text" tabindex="1" name='unit[]' style="width:70px;" class="unit" />
                    <span class="error_msg"></span>
                </td>
                <td>
                    <!-- <input type="text"  name='available_quantity[]' style="width:70px;" class="form-control  stock_qty" value="0" readonly="readonly"/> -->
                    <input type="text" tabindex="1" name='quantity[]' style="width:70px;" class="qty form-control" id="qty" />
                    <span class="error_msg"></span>
                </td>
                <td>
                    <input type="text" tabindex="1" name='per_cost[]' style="width:70px;" class="cost_price percost " id="price" />
                    <span class="error_msg"></span>
                </td>
                <td class="action-btn-align">
                    <input type="text" tabindex="1" style="width:70px;" class="gross" />
                </td>
                <td>
                    <input type="text" tabindex="1" name='discount[]' style="width:70px;" class="discount" />
                </td>
                <td class="action-btn-align cgst_td">
                    <input type="text" tabindex="1" name='tax[]' style="width:70px;" class="pertax" />
                </td>
                <td class="action-btn-align sgst_td">
                    <input type="text" tabindex="1" name='gst[]' style="width:70px;" class="gst" />
                </td>
                <td class="action-btn-align igst_td">
                    <input type="text" tabindex="1" name='igst[]' style="width:70px;" class="igst wid50" />
                </td>
                <td>
                    <input type="text" tabindex="1" name='transport[]' style="width:70px;" class="transport" />
                </td>
                <td>
                    <input type="text" tabindex="1" style="width:70px;" name='sub_total[]' readonly="readonly" id="sub_toatl" class="subtotal text_right" />
                </td>
                <td class="action-btn-align"><a id='delete_group' class="btn-sm btn-default"><span class="glyphicon glyphicon-trash"></span></a></td>
            </tr>
        </table>
        <form method="post" class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Firm Name <span style="color:#F00; font-style:oblique;">*</span></label>
                        <div class="col-sm-8">
                            <?php if (count($firms) > 1) { ?>
                                <select onchange="Firm(this.value)" name="po[firm_id]" class="form-control form-align required" id="firm" tabindex="1">
                                    <option value="">Select</option>
                                    <?php
                                    if (isset($firms) && !empty($firms)) {
                                        foreach ($firms as $firm) {
                                    ?>
                                            <option value="<?php echo $firm['firm_id']; ?>"> <?php echo $firm['firm_name']; ?> </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            <?php
                            } else {
                            ?>
                                <select onchange="Firm(this.value)" name="po[firm_id]" class="form-control form-align required" id="firm" tabindex="1">
                                    <?php
                                    if (isset($firms) && !empty($firms)) {
                                        foreach ($firms as $firm) {
                                    ?>
                                            <option value="<?php echo $firm['firm_id']; ?>"> <?php echo $firm['firm_name']; ?> </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">PR NO</label>
                        <div class="col-sm-8">
                            <input type="text" name="po[pr_no]" class="code form-control colournamedup  form-align" readonly="readonly" value="" id="pr_id">
                            <input type="hidden" name="po[po_no]" class="code form-control colournamedup  form-align" readonly="readonly" value="" id="po_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Supplier Name <span style="color:#F00; font-style:oblique;">*</span></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" tabindex="1" name="supplier[store_name]" id="customer_name" class=' form-align auto_customer required ' />
                                <div class="input-group-addon">
                                    <i class="fa fa-bank"></i>
                                </div>
                            </div>
                            <span class="error_msg"></span>
                            <input type="hidden" name="supplier[id]" id="customer_id" class='form-control id_customer tabwid form-align' />
                            <input type="hidden" name="credit_days" id="credit_days" class='credit_days' />
                            <div id="suggesstion-box" class="auto-asset-search "></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Delivery Status<span style="color:#F00; font-style:oblique;">*</span></label>
                        <div class="col-sm-8">
                            <?php
                            $delivery_status = array('pending');
                            //                            if ($this->user_auth->is_section_allowed('purchase', 'purchase_request')) {
                            //                                $delivery_status = array('delivered', 'partially_delivered', 'pending');
                            //                            } else {
                            //                                $delivery_status = array('pending');
                            //                            }
                            ?>
                            <select name="po[delivery_status]" class="form-control required form-align" id="delivery_status" tabindex="1">
                                <?php
                                if (isset($delivery_status) && !empty($delivery_status)) {
                                    foreach ($delivery_status as $status) {
                                ?>
                                        <option value="<?php echo $status; ?>"> <?php echo ucwords(str_replace("_", " ", $status)); ?> </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">Supplier&nbsp;Mobile&nbsp;No</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="supplier[mobil_number]" id="customer_no" class="form-align" />
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </div>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">Supplier Email ID</label>
                        <div class="col-sm-8" id='customer_td'>
                            <div class="input-group">
                                <input type="text" name="supplier[email_id]" id="email_id" class=" form-align" />
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                            </div>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">GSTIN No</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="supplier[tin_no]" id="tin" class="form-align" />
                                <div class="input-group-addon">
                                    <i class="fa fa-cog"></i>
                                </div>
                            </div>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">PR Status<span style="color:#F00; font-style:oblique;">*</span></label>
                        <div class="col-sm-8">
                            <?php
                            //                            if ($this->user_auth->is_section_allowed('purchase', 'purchase_request')) {
                            //                                $pr_status = array('waiting', 'approved');
                            //                            } else {
                            //                                $pr_status = array('waiting');
                            //                            }
                            $pr_status = array('waiting');
                            ?>
                            <select name="po[pr_status]" class="form-control required form-align" id="pr_status" tabindex="1">
                                <?php
                                if (isset($pr_status) && !empty($pr_status)) {
                                    foreach ($pr_status as $status) {
                                ?>
                                        <option value="<?php echo $status; ?>"> <?php echo ucwords(str_replace("_", " ", $status)); ?> </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">Supplier Address</label>
                        <div class="col-sm-8">
                            <textarea name="supplier[address1]" id="address1" class="form-control form-align"></textarea>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">Date</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" tabindex="1" class="form-align datepicker required" name="po[created_date]" placeholder="dd-mm-yyyy" value="<?php echo date('d-m-Y'); ?>">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <span class="error_msg"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">Bill Type<span style="color:#F00; font-style:oblique;">*</span></label>
                        <div class="col-sm-8">
                            <input type="radio" class="receiver" value="cash" id="bill1" checked="checked" name="po[po_type]" />Cash Purchase
                            <input type="radio" class="receiver" value="credit" name="po[po_type]" />Credit Purchase<br>
                            <span id="type1" class="error_msg"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mscroll">
                <table class="table table-striped table-bordered responsive dataTable no-footer dtr-inline" id="add_quotation">
                    <thead>
                        <tr>
                            <td width="2%" class="first_td1">S.No</td>
                            <td width="15%" class="first_td1">Category</td>
                            <td width="30%" class="first_td1">Product Name</td>
                            <td width="10%" class="first_td1">Brand</td>
                            <td width="5%" class="first_td1">Unit</td>
                            <td width="8%" class="first_td1 action-btn-align">QTY</td>
                            <td width="8%" class="first_td1 action-btn-align">Unit Price</td>
                            <td width="5%" class="first_td1 action-btn-align">Total</td>
                            <td width="7%" class="first_td1 action-btn-align">Discount %</td>
                            <td width="5%" class="first_td1 action-btn-align cgst_td">CGST %</td>
                            <td width="5%" class="first_td1 action-btn-align sgst_td">SGST %</td>
                            <td width="5%" class="first_td1 action-btn-align igst_td">IGST %</td>
                            <td width="6%" class="first_td1 action-btn-align">Transport</td>
                            <td width="5%" class="first_td1">Net Value</td>
                            <td width="5%" class="action-btn-align"><a id='add_group' class="btn btn-success form-control pad10"><span class="glyphicon glyphicon-plus"></span> Add</a></td>
                        </tr>
                    </thead>
                    <tbody id='app_table'>
                        <tr>
                            <td class="action-btn-align s_no">
                                <?php echo 1; ?>
                            </td>
                            <td>
                                <select id='cat_id' class='form-control cat_id static_style class_req required' name='categoty[]' style="width:100%">
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
                                <input type="hidden" style="width:100%" class='form-control form-align  tabwid model_no_extra' readonly="" />
                            </td>
                            <td style="display:none">
                            </td>
                            <td>
                                <input type="text" name="model_no[]" id="model_no" style="width:100%" class='form-control form-align auto_customer tabwid model_no required' tabindex="1" readonly="" />
                                <span class="error_msg"></span>
                                <input type="hidden" name="product_id[]" id="product_id" class='product_id tabwid form-align' />
                                <input type="hidden" name="type[]" id="type" class=' tabwid form-align type' />
                                <div id="suggesstion-box1" class="auto-asset-search suggesstion-box1"></div>
                            </td>
                            <td>
                                <select id='brand_id' name='brand[]' tabindex="1" class="form-control brand_id">
                                    <option value="">Select</option>
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
                            <td class="action-btn-align">
                                <input type="text" tabindex="1" name='unit[]' style="width:70px;" class="unit" />
                                <span class="error_msg"></span>
                            </td>
                            <td>
                                <!-- <input type="text" name='available_quantity[]' style="width:70px;" class="form-control  stock_qty" value="" readonly="readonly" /> -->
                                <input type="text" tabindex="1" name='quantity[]' style="width:70px;" class="qty required form-control" />
                                <span class="error_msg"></span>
                            </td>
                            <td>
                                <input type="text" tabindex="1" name='per_cost[]' style="width:70px;" class="cost_price percost required" />
                                <span class="error_msg"></span>
                            </td>
                            <td class="action-btn-align">
                                <input type="text" tabindex="1" style="width:70px;" class="gross" />
                            </td>
                            <td>
                                <input type="text" tabindex="1" name='discount[]' style="width:70px;" class="discount" />
                            </td>
                            <td class="action-btn-align cgst_td">
                                <input type="text" tabindex="1" name='tax[]' style="width:70px;" class="pertax" />
                            </td>
                            <td class="action-btn-align sgst_td">
                                <input type="text" tabindex="1" name='gst[]' style="width:70px;" class="gst" />
                            </td>
                            <td class="action-btn-align igst_td">
                                <input type="text" tabindex="1" name='igst[]' style="width:70px;" class="igst wid50" />
                            </td>
                            <td>
                                <input type="text" tabindex="1" name='transport[]' style="width:70px;" class="transport" />
                            </td>
                            <td>
                                <input type="text" style="width:70px;" name='sub_total[]' readonly="readonly" class="subtotal text_right" />
                            </td>
                            <td class="action-btn-align"><a id='delete_group' class="btn-sm btn-default"><span class="glyphicon glyphicon-trash"></span></a></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="width:70px; text-align:right;"><b>Total</b></td>
                            <td><input type="text" name="po[total_qty]" readonly="readonly" class="total_qty" style="width:70px;" id="total" /></td>
                            <td colspan="7" style="text-align:right;"><b>Sub Total</b></td>
                            <td><input type="text" name="po[subtotal_qty]" readonly="readonly" class="final_sub_total text_right" style="width:70px;" /></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="width:70px; text-align:right;"></td>
                            <td colspan="7" style="text-align:right;font-weight:bold;"><input type="text" tabindex="1" name="po[tax_label]" class='tax_label text_right' style="width:100%;" /></td>
                            <td>
                                <input type="text" name="po[tax]" class='totaltax text_right' tabindex="1" style="width:70px;" />
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="width:70px; text-align:right;"></td>
                            <td colspan="7" style="text-align:right;font-weight:bold;">Net Total</td>
                            <td><input type="text" name="po[net_total]" readonly="readonly" class="final_amt text_right" style="width:70px;" /></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="15">
                                <span class="remark">Remarks</span>
                                <input name="po[remarks]" type="text" class="form-control remark" tabindex="1" />
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="inner-sub-tit mstyle">TERMS AND CONDITIONS</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">1. Delivery Schedule</label>
                        <div class="col-sm-8">
                            <div>
                                <input type="text" class="form-control datepicker class_req borderra0 terms" name="po[delivery_schedule]" placeholder="dd-mm-yyyy">
                                <span id="colorpoerror" style="color:#F00;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">3. Mode of Payment</label>
                        <div class="col-sm-8">
                            <div>
                                <input type="text" class="form-control class_req borderra0 terms" name="po[mode_of_payment]" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <input type="hidden" name="po[supplier]" id="c_id" class='id_customer' />
            <input type="hidden" name="gst_type" id="gst_type" class="gst_type" />
            <div class="action-btn-align mb-bot20">
                <button class="btn btn-primary" name="print" value="no" id="save"><span class="glyphicon glyphicon-plus"></span> Create </button>
                <button class="btn btn-primary" name="print" value="yes" id="save" tabindex="1"><span class="glyphicon glyphicon-plus"></span> Save and <span class="glyphicon glyphicon-print"></span> print</button>
            </div>
            <br />
        </form>
    </div>
</div>
<script type="text/javascript">
    var formHasChanged = false;
    var submitted = false;
    $('#save').live('click', function() {
        m = 0;
        $('.required').each(function() {
            var tr = $('#app_table tr').length;
            if (tr > 1) {
                test = $(this).closest('tr td').find('input.model_no').val();
                if (test == '') {
                    $(this).closest('tr').remove();
                }
            }
        });
        $('.required').each(function() {
            this_val = $.trim($(this).val());
            this_id = $(this).attr("id");
            this_class = $(this).attr("class");
            if (this_val == "") {
                $(this).closest('tr td').find('.error_msg').text('This field is required').css('display', 'inline-block');
                $(this).closest('div .form-group').find('.error_msg').text('This field is required').css('display', 'inline-block');
                m++;
            } else {
                $(this).closest('tr td').find('.error_msg').text('');
                $(this).closest('div .form-group').find('.error_msg').text('');
            }
        });
        if ($('input[type=radio]:checked').length <= 0) {
            $("#type1").html("This field is required");
            m = 1;
        } else {
            $("#type1").html("");
        }
        if (m > 0) {
            $('html, body').animate({
                scrollTop: ($('.error_msg:visible').offset().top - 60)
            }, 500);
            return false;
        } else {
            submitted = true;
        }
    });
    $(document).ready(function() {
        $(".receiver").attr('checked').val();
    });
    $(document).ready(function() {
        $(".receiver").attr('checked').val();
        if ($('#gst_type').val() != '') {
            if ($('#gst_type').val() == 31) {
                $('#add_quotation').find('tr td.sgst_td').show();
                $('#add_quotation').find('tr td.igst_td').hide();
            } else {
                $('#add_quotation').find('tr td.igst_td').show();
                $('#add_quotation').find('tr td.sgst_td').hide();
            }
        } else {
            $('#add_quotation').find('tr td.igst_td').hide();
        }
        $('#firm').focus();
        $('#firm').trigger('change');
        $('body').on('keydown', 'input#customer_name', function(e) {
            var c_data = [<?php echo implode(',', $customers_json); ?>];
            $("#customer_name").blur(function() {
                var keyEvent = $.Event("keydown");
                keyEvent.keyCode = $.ui.keyCode.ENTER;
                $(this).trigger(keyEvent);
                // Stop event propagation if needed
                return false;
            }).autocomplete({
                source: function(request, response) {
                    // filter array to only entries you want to display limited to 10
                    var outputArray = new Array();
                    for (var i = 0; i < c_data.length; i++) {
                        if (c_data[i].value.toLowerCase().match(request.term.toLowerCase())) {
                            outputArray.push(c_data[i]);
                        }
                    }
                    response(outputArray.slice(0, 10));
                },
                minLength: 0,
                delay: 0,
                autoFocus: true,
                select: function(event, ui) {
                    cust_id = ui.item.id;
                    $.ajax({
                        type: 'POST',
                        data: {
                            cust_id: cust_id
                        },
                        url: "<?php echo $this->config->item('base_url'); ?>" + "purchase_order/get_customer/",
                        success: function(data) {
                            var result = JSON.parse(data);
                            if (result != null && result.length > 0) {
                                $("#customer_id").val(result[0].id);
                                $("#gst_type").val(result[0].state_id);
                                $("#c_id").val(result[0].id);
                                $("#customer_name").val(result[0].store_name);
                                $("#customer_no").val(result[0].mobil_number);
                                $("#email_id").val(result[0].email_id);
                                $("#address1").val(result[0].address1);
                                $("#tin").val(result[0].tin);
                                $("#credit_days").val(result[0].credit_days);
                                if ($('#gst_type').val() != '') {
                                    if ($('#gst_type').val() == 31) {
                                        $('#add_quotation').find('tr td.sgst_td').show();
                                        $('#add_quotation').find('tr td.igst_td').hide();
                                    } else {
                                        $('#add_quotation').find('tr td.igst_td').show();
                                        $('#add_quotation').find('tr td.sgst_td').hide();
                                    }
                                } else {
                                    $('#add_quotation').find('tr td.igst_td').hide();
                                }
                            }
                        }
                    });
                }
            });
        });
    });
    $('#add_group').click(function() {
        var tableBody = $(".static").find('tr').clone();
        $(tableBody).closest('tr').find('select,.model_no,.percost,.qty').addClass('required');
        $('#app_table').append(tableBody);
        if ($('#gst_type').val() != '') {
            if ($('#gst_type').val() == 31) {
                $('#add_quotation').find('tr td.sgst_td').show();
                $('#add_quotation').find('tr td.igst_td').hide();
            } else {
                $('#add_quotation').find('tr td.igst_td').show();
                $('#add_quotation').find('tr td.sgst_td').hide();
            }
        } else {
            $('#add_quotation').find('tr td.igst_td').hide();
        }
        var i = 1;
        $('#app_table tr').each(function() {
            $(this).closest("tr").find('.s_no').html(i);
            i++;
        });
    });
    $('#delete_group').live('click', function() {
        $(this).closest("tr").remove();
        calculate_function();
        var i = 1;
        $('#app_table tr').each(function() {
            $(this).closest("tr").find('.s_no').html(i);
            i++;
        });
    });
    $(".remove_comments").live('click', function() {
        $(this).closest("tr").remove();
        var full_total = 0;
        $('.total_qty').each(function() {
            full_total = full_total + Number($(this).val());
        });
        $('.full_total').val(full_total);
        console.log(full_total);
    });
    $('.qty,.percost,.pertax,.totaltax,.gst,.igst,.discount,.transport').live('keyup', function() {
        calculate_function();
    });

    function calculate_function() {
        var final_qty = 0;
        var final_sub_total = 0;
        $('.qty').each(function() {
            var qty = $(this);
            var percost = $(this).closest('tr').find('.percost');
            var pertax = $(this).closest('tr').find('.pertax');
            var gst = $(this).closest('tr').find('.gst');
            var igst = $(this).closest('tr').find('.igst');
            var subtotal = $(this).closest('tr').find('.subtotal');
            var discount = $(this).closest('tr').find('.discount');
            var transport = $(this).closest('tr').find('.transport');
            if (Number(qty.val()) != 0) {
                tot = Number(qty.val()) * Number(percost.val());
                $(this).closest('tr').find('.gross').val(tot);
                pertax1 = Number(pertax.val() / 100) * Number(percost.val());
                gst1 = Number(gst.val() / 100) * Number(percost.val());
                igst1 = Number(igst.val() / 100) * Number(percost.val());
                discount1 = Number(discount.val() / 100) * Number(percost.val());
                sub_total1 = (Number(qty.val()) * Number(percost.val())) + (pertax1 * Number(qty.val())) + (gst1 * Number(qty.val()) + (igst1 * Number(qty.val())));
                sub_total = (sub_total1 + Number(transport.val())) - (discount1 * Number(qty.val()));
                subtotal.val(sub_total.toFixed(2));
                final_qty = final_qty + Number(qty.val());
                final_sub_total = final_sub_total + sub_total;
            }
        });
        $('.total_qty').val(final_qty);
        $('.final_sub_total').val(final_sub_total.toFixed(2));
        $('.final_amt').val((final_sub_total + Number($('.totaltax').val())).toFixed(2));
    }
    $(".datepicker").datepicker({
        setDate: new Date(),
        onClose: function() {
            $("#app_table").find('tr:first td  input.model_no').focus();
        }
    });
    $('#search').live('click', function() {
        for_loading();
        $.ajax({
            url: BASE_URL + "po/search_result",
            type: 'GET',
            data: {
                po: $('#po_no').val(),
                style: $('#style').val(),
                supplier: $('#supplier').val(),
                supplier_name: $('#supplier').find('option:selected').text(),
                from_date: $('#from_date').val(),
                to_date: $('#to_date').val()
            },
            success: function(result) {
                for_response();
                $('#result_div').html(result);
            }
        });
    });
</script>
<script>
    $('body').on('keydown', '#add_quotation input.model_no', function(e) {
        // var product_data = [<?php echo implode(',', $model_numbers_json); ?>];
        var _this = $(this);
        $('#add_quotation tbody tr input.model_no').autocomplete({
            source: function(request, response) {
                var val = _this.closest('tr input.model_no').val();
                cat_id = $('#firm').val();
                cust_id = $('#customer_id').val();
                var product_data = [];
                if ($.trim(val).length != 0) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            firm_id: cat_id,
                            pro: val
                        },
                        async: false,
                        url: '<?php echo base_url(); ?>quotation/get_product_by_frim_id',
                        success: function(data) {
                            product_data = JSON.parse(data);
                        }
                    });
                }
                // filter array to only entries you want to display limited to 10
                var outputArray = new Array();
                for (var i = 0; i < product_data.length; i++) {
                    //  if (product_data[i].value.toLowerCase().match(request.term.toLowerCase())) {
                    outputArray.push(product_data[i]);
                    //   }
                }
                response(outputArray.slice(0, 10));
            },
            minLength: 0,
            delay: 0,
            autoFocus: true,
            autoFill: false,
            select: function(event, ui) {
                this_val = $(this);
                product = ui.item.value;
                $(this).val(product);
                model_number_id = ui.item.id;
                $.ajax({
                    type: 'POST',
                    data: {
                        model_number_id: model_number_id,
                        c_id: cust_id
                    },
                    url: "<?php echo $this->config->item('base_url'); ?>" + "purchase_order/get_product/" + cat_id,
                    success: function(data) {
                        var result = JSON.parse(data);
                        if (result != null && result.length > 0) {
                            if (result[0].quantity != null) {
                                this_val.closest('tr').find('.stock_qty').val(result[0].quantity);
                            } else {
                                this_val.closest('tr').find('.stock_qty').val('0');
                            }
                            this_val.closest('tr').find('.unit').val(result[0].unit);
                            this_val.closest('tr').find('.brand_id').val(result[0].brand_id);
                            this_val.closest('tr').find('.cat_id').val(result[0].category_id);
                            this_val.closest('tr').find('.discount').val(result[0].discount);
                            this_val.closest('tr').find('.cost_price').val(result[0].cost_price);
                            this_val.closest('tr').find('.type').val(result[0].type);
                            this_val.closest('tr').find('.product_id').val(result[0].id);
                            this_val.closest('tr').find('.model_no').val(result[0].product_name);
                            this_val.closest('tr').find('.model_no_extra').val(result[0].model_no);
                            this_val.closest('tr').find('.product_description').val(result[0].product_description);
                            if ($('#gst_type').val() != '') {
                                if ($('#gst_type').val() == 31) {
                                    this_val.closest('tr').find('.pertax').val(result[0].cgst);
                                    this_val.closest('tr').find('.gst').val(result[0].sgst);
                                } else {
                                    this_val.closest('tr').find('.pertax').val(result[0].cgst);
                                    this_val.closest('tr').find('.igst').val(result[0].igst);
                                }
                            }
                            calculate_function();
                            var name = $('#app_table tr:last').find('.model_no').val();
                            if (name != '')
                                $('#add_group').trigger('click');
                            this_val.closest('tr').find('.qty').focus();
                        }
                    }
                });
            }
        });
    });
    $('body').on('keydown', 'input.model_no_extra', function(e) {
        // var product_data = [<?php echo implode(',', $model_numbers_extra); ?>];
        cat_id = $('#firm').val();
        cust_id = $('#customer_id').val();
        var product_data = [];
        $.ajax({
            type: 'POST',
            data: {
                firm_id: cat_id
            },
            async: false,
            url: '<?php echo base_url(); ?>quotation/get_model_no_by_frim_id',
            success: function(data) {
                product_data = JSON.parse(data);
            }
        });
        $(".model_no_extra").autocomplete({
            source: function(request, response) {
                // filter array to only entries you want to display limited to 10
                var outputArray = new Array();
                for (var i = 0; i < product_data.length; i++) {
                    if (product_data[i].value.toLowerCase().match(request.term.toLowerCase())) {
                        outputArray.push(product_data[i]);
                    }
                }
                response(outputArray.slice(0, 10));
            },
            minLength: 0,
            delay: 0,
            autoFill: false,
            select: function(event, ui) {
                this_val = $(this);
                product = ui.item.value;
                $(this).val(product);
                model_number_id = ui.item.id;
                $.ajax({
                    type: 'POST',
                    data: {
                        model_number_id: model_number_id,
                        c_id: cust_id
                    },
                    url: "<?php echo $this->config->item('base_url'); ?>" + "purchase_order/get_product/" + cat_id,
                    success: function(data) {
                        var result = JSON.parse(data);
                        if (result != null && result.length > 0) {
                            this_val.closest('tr').find('.unit').val(result[0].unit);
                            this_val.closest('tr').find('.brand_id').val(result[0].brand_id);
                            this_val.closest('tr').find('.cat_id').val(result[0].category_id);
                            this_val.closest('tr').find('.discount').val(result[0].discount);
                            this_val.closest('tr').find('.cost_price').val(result[0].cost_price);
                            this_val.closest('tr').find('.type').val(result[0].type);
                            this_val.closest('tr').find('.product_id').val(result[0].id);
                            this_val.closest('tr').find('.model_no').val(result[0].product_name);
                            this_val.closest('tr').find('.model_no_extra').val(result[0].model_no);
                            this_val.closest('tr').find('.product_description').val(result[0].product_description);
                            if ($('#gst_type').val() != '') {
                                if ($('#gst_type').val() == 31) {
                                    this_val.closest('tr').find('.pertax').val(result[0].cgst);
                                    this_val.closest('tr').find('.gst').val(result[0].sgst);
                                } else {
                                    this_val.closest('tr').find('.pertax').val(result[0].cgst);
                                    this_val.closest('tr').find('.igst').val(result[0].igst);
                                }
                            }
                            calculate_function();
                            var name = $('#app_table tr:last').find('.model_no').val();
                            if (name != '')
                                $('#add_group').trigger('click');
                        }
                    }
                });
            }
        });
    });
    $('.pro_class').live('click', function() {
        $(this).closest('tr').find('.cat_id').val($(this).attr('pro_cat'));
        $(this).closest('tr').find('.pertax').val($(this).attr('pro_cgst'));
        $(this).closest('tr').find('.gst').val($(this).attr('pro_sgst'));
        $(this).closest('tr').find('.discount').val($(this).attr('pro_discount'));
        $(this).closest('tr').find('.cost_price').val($(this).attr('pro_cost'));
        $(this).closest('tr').find('.type').val($(this).attr('pro_type'));
        $(this).closest('tr').find('.product_id').val($(this).attr('pro_id'));
        $(this).closest('tr').find('.model_no').val($(this).attr('pro_name'));
        $(this).closest('tr').find('.product_description').val($(this).attr('pro_name') + "  " + $(this).attr('pro_description'));
        $(this).closest('tr').find(".suggesstion-box1").hide();
        calculate_function();
    });

    function Firm(val) {
        if (val != '') {
            $.ajax({
                type: 'POST',
                data: {
                    firm_id: val
                },
                url: '<?php echo base_url(); ?>masters/products/get_category_by_frim_id',
                success: function(data) {
                    var result = JSON.parse(data);
                    if (result != null && result.length > 0) {
                        option_text = '<option value="">Select Category</option>';
                        $.each(result, function(key, value) {
                            option_text += '<option value="' + value.cat_id + '">' + value.categoryName + '</option>';
                        });
                        $('.cat_id').html(option_text);
                        $('.cat_id,.model_no,.model_no_extra').val('');
                        $('.model_no,.model_no_extra').removeAttr('readonly', 'readonly');
                    } else {
                        $('.cat_id,.model_no,.model_no_extra').val('');
                        $('.model_no,.model_no_extra').attr('readonly', 'readonly');
                    }
                }
            });
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                data: {
                    firm_id: val
                },
                url: '<?php echo base_url(); ?>quotation/get_prefix_by_frim_id/',
                success: function(data1) {
                    $('#po_id').val(data1[0]['prefix']);
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            type: data1[0]['prefix'],
                            code: 'PO'
                        },
                        url: '<?php echo base_url(); ?>quotation/get_increment_id/',
                        success: function(data2) {
                            $('#po_id').val(data2);
                            //console.log(data2);
                            var increment_id = $('#po_id').val().split("/");
                            sales_id = 'PO-' + data1[0]['prefix'] + '-' + increment_id[1] + '' + increment_id[2];
                            $('#po_id').val(sales_id);
                            pr_id = 'PR-' + data1[0]['prefix'] + '-' + increment_id[1] + '' + increment_id[2];
                            $('#pr_id').val(pr_id);
                        }
                    });
                }
            });
        } else {
            $('.cat_id,.model_no,.model_no_extra').val('');
            $('.model_no,.model_no_extra').attr('readonly', 'readonly');
        }
    }
    $(window).bind('scannerDetectionReceive', function(event, data) {
        target_ele = event.target.activeElement;
    });
    /* $(document).scannerDetection({
     timeBeforeScanTest: 200, // wait for the next character for upto 200ms
     startChar: [120], // Prefix character for the cabled scanner (OPL6845R)
     endChar: [13], // be sure the scan is complete if key 13 (enter) is detected
     avgTimeByChar: 40, // it's not a barcode if a character takes longer than 40ms
     onComplete: function (barcode, qty) {
     $(target_ele).val('');
     val = $('#app_table').find('.product_id').val();
     if (val == '') {
     $('#app_table').find('tr:first').remove();
     }
     cust_id = $('#customer_id').val();
     barcode = barcode;
     if (barcode != '' && cust_id != '') {
     $.ajax({
     type: 'POST',
     async: false,
     data: {barcode: barcode, cust_id: cust_id},
     url: '<?php echo base_url(); ?>sales/get_all_products/',
     success: function (data) {
     var result = JSON.parse(data);
     if (result != null && result.length > 0) {
     $.each(result, function (key, value) {
     var prod_array = new Array();
     $(".product_id").each(function () {
     prod_array.push($(this).val());
     });
     if (jQuery.inArray(value.id, prod_array) > -1 && prod_array.length > 0)
     {
     qty_val = $('#app_table .tr_' + value.id).find('.qty').val();
     var add = Number(qty_val) + Number(1);
     $('#app_table .tr_' + value.id).find('.qty').val(add);
     calculate_function();
     } else {
     var tableBody = $(".static").find('tr').clone();
     $(tableBody).closest('tr').find('select,.model_no,.model_no_ser,.percost,.qty').addClass('required');
     $('#app_table').append(tableBody);
     $(tableBody).closest('tr').find('.model_no').val(result[0]['product_name']);
     if (result[0]['product_image'] == '')
     $(tableBody).closest('tr').find('.product_image').attr('src', "<?php echo $this->config->item("base_url") . 'attachement/product/' ?>" + result[0]['product_image']);
     else
     $(tableBody).closest('tr').find('.product_image').attr('src', "<?php echo $this->config->item("base_url") . 'attachement/product/no-img.gif' ?>");
     $(tableBody).closest('tr').find('.product_description').val(result[0]['product_description']);
     $(tableBody).closest('tr').find('.qty').val('1');
     $(tableBody).closest('tr').addClass('tr_' + result[0]['id']);
     $(tableBody).closest('tr').find('.product_id').val(result[0]['id']);
     $(tableBody).closest('tr').find('.selling_price').val(result[0]['selling_price']);
     $(tableBody).closest('tr').find('.type').val(result[0]['type']);
     $(tableBody).closest('tr').find('.discount').val(result[0]['discount']);
     $(tableBody).closest('tr').find('.brand_id').val(result[0]['brand_id']);
     $(tableBody).closest('tr').find('.unit').val(result[0]['unit']);
     $(tableBody).closest('tr').find('.cat_id').val(result[0]['category_id']);
     $(tableBody).closest('tr').find('.model_no').val(result[0]['product_name']);
     $(tableBody).closest('tr').find('.model_no_extra').val(result[0]['model_no']);
     if ($('#gst_type').val() != '')
     {
     if ($('#gst_type').val() == 31)
     {
     $(tableBody).closest('tr').find('.pertax').val(result[0]['cgst']);
     $(tableBody).closest('tr').find('.gst').val(result[0]['sgst']);
     } else {
     $(tableBody).closest('tr').find('.pertax').val(result[0]['cgst']);
     $(tableBody).closest('tr').find('.igst').val(result[0]['igst']);
     }
     }
     calculate_function();
     // Firm(result[0]['firm_id'], result[0]['category_id']);
     }
     });
     } else {
     sweetAlert("Error...", "This Product is not available!", "error");
     return false;
     }
     }
     });
     } else {
     sweetAlert("Error...", "This Product is not available!", "error");
     return false;
     }
     }
     });*/
    $('input').on('keypress', function() {
        formHasChanged = true;
    });
    $('select').on('click', function() {
        formHasChanged = true;
    });
    $(window).bind('beforeunload', function() {
        if (formHasChanged && !submitted) {
            return 'Are you sure you want to leave?';
        }
    });
</script>