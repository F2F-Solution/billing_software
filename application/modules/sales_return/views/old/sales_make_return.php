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


                    <div class="form-group">

                        <label class="col-sm-4 control-label">Customer Name</label>

                        <div class="col-sm-8">

                            <input type="text"  name="customer[customer_name]" id="customer_name" class='  form-control auto_customer form-align required ' value="<?php echo $customer['customer_name']; ?>"  readonly="readonly"/>



                            <input type="hidden"  name="customer[id]" id="customer_id" class=' form-control  id_customer form-align tabwid' value="<?php echo $customer['customer_id']; ?>" />

                            <input type="hidden"  name="firm_id" id="firm_id" class=' form-control  firm_id form-align tabwid' value="<?php echo $customer['firm_id']; ?>" />

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-4 control-label">Customer Mobile No</label>

                        <div class="col-sm-8">

                            <input type="text"  name="customer[mobil_number]" class="form-control form-align required " id="customer_no" value="<?php echo $customer['mobil_number']; ?>" readonly="readonly"/>

                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-sm-4 control-label">Invocie Id</label>

                        <div class="col-sm-8">


                            <select id='customer_invoice_id' name="customer[invoice_id][]" class="form-control multi_select wid100" multiple="multiple" >

                                <option>Select</option>

                                <?php
                                if (isset($customer['invoice']) && !empty($customer['invoice'])) {

                                    foreach ($customer['invoice'] as $val) {
                                        ?>

                                        <option value='<?= $val['inv_id'] ?>'><?= $val['inv_id'] ?></option>

                                        <?php
                                    }
                                }
                                ?>

                            </select>

                        </div>

                    </div>

                    <input type="hidden" id="already_select" value="" name="already_select[]">


                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label class="col-sm-4 control-label">Customer Address</label>

                        <div class="col-sm-8">

                            <textarea name="customer[address1]" class=" form-control form-align required" id="address1" readonly="readonly"><?php echo $customer['address']; ?></textarea>

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

                            <input type="text"  name="customer[email_id]" class=" form-control form-align required " id="email_id" value="<?php echo $customer['email_id']; ?>" readonly="readonly"/>

                        </div>

                    </div>



                </div>

            </div>







            <div class="mscroll">

                <table class="table table-striped table-bordered responsive dataTable no-footer dtr-inline" id="add_quotation">

                    <thead>

                        <tr>

                            <td width="2%" class="first_td1">S.No</td>

                            <td width="8%" class="first_td1">Category</td>

                            <td width="12%" class="first_td1">Product Name</td>

                            <td width="8%" class="first_td1">Brand</td>

                            <td width="5%" class="first_td1">Unit</td>

                            <td  width="12%" class="first_td1 action-btn-align">QTY</td>

                            <td  width="8%" class="first_td1 action-btn-align">Unit Price</td>

                            <td  width="5%" class="first_td1">CGST %</td>

                            <?php
                            $gst_type = $customer['state_id'];

                            if ($gst_type != '') {

                                if ($gst_type == 31) {
                                    ?>

                                    <td  width="5%" class="first_td1  proimg-wid" >SGST%</td>

                                <?php } else { ?>

                                    <td  width="5%" class="first_td1 proimg-wid" >IGST%</td>



                                    <?php
                                }
                            }
                            ?>

                            <td  width="5%" class="first_td1">Net Value</td>

                            <td  width="2%" class="first_td1">Remove</td>



                        </tr>

                    </thead>



                    <tbody id='app_table'>


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
                    $gst_type = $po[0]['state_id'];
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
                    </tfoot>                                                                                                                                                                                                                                     <!--                            <tfoot>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        </tfoot>-->
                    <input type="hidden"  name="gst_type" id="gst_type" class="gst_type" value="<?php echo $customer['state_id']; ?>"/>

                </table>
            </div>
    </div>

    <div class="action-btn-align">

        <button class="btn btn-info " id="save"> Update </button>

        <a href="<?php echo $this->config->item('base_url'); ?>sales_return/sales_return_bill/<?php echo $val['id']; ?>" class="tooltips btn btn-info"><span class="glyphicon glyphicon-print"></span> Print </a>

        <a href="<?php echo $this->config->item('base_url') . 'sales_return/' ?>" class="btn btn-defaultback1"><span class="glyphicon"></span> Back </a>

        </form>

        <br />





    </div><!-- contentpanel -->

</div><!-- mainpanel -->







<table class="static" style="display: none;">
    <tr >
        <td class="action-btn-align s_no" width="3%"></td>
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
            <input type="text"  tabindex="-1"   name='unit[]' style="width:70px;" class="unit" />
            <span class="error_msg"></span>
        </td>
        <td width="16%"><div class="col-md-12 sales_qty_details">
                <div class="col-md-6">
                    <input type="text" tabindex="-1" name='available_quantity[]' style="width:40px;" class="form-control  stock_qty" value="0" readonly="readonly"/>
                </div>
                <div class="col-md-6">
                    <input type="text"  tabindex="-1"   name='return_quantity[]' style="width:40px;" class="qty form-control return_qty" />
                </div>
                <span class="error_msg"></span>
            </div>
        </td>
        <td width="11%">
            <input type="text" tabindex="-1"    name='per_cost[]' style="width:70px;" class="cost_price percost " id="price"/>

            <input type="hidden"   tabindex="-1"   name='pertax[]' style="width:70px;" class="pertax" />

            <input type="hidden"   tabindex="-1"   name='transport[]' style="width:70px;" class="transport" value=""/>

            <input type="hidden"   tabindex="-1"   name='discount[]' style="width:70px;" class="discount" />
            <span class="error_msg"></span>
        </td>


        <td  width="6%" class="action-btn-align sgst_td">
            <input type="text"  tabindex="-1"    name='gst[]' style="width:70px;" class="gst" />
        </td>
        <td width="7%" class="action-btn-align igst_td">
            <input type="text"   tabindex="-1"   name='igst[]' style="width:70px;" class="igst wid50"  />
        </td>

        <td width="7%">
            <input type="text"  tabindex="-1"  style="width:70px;" name='sub_total[]' readonly="readonly" id="sub_toatl" class="subtotal text_right" />
        </td>


        <td class="action-btn-align" >


            <a id='delete_group' href="javascript:" class="btn-sm btn-danger delete_group"><span class="glyphicon glyphicon-trash"></span></a>

        </td>

    </tr>
</table>


<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">

    $('#save').live('click', function () {
        m = 0;
        $('.invoice_id_table .return_qty').each(function () {
            var model_no = $(this).closest('tr').find('.model_no').val();
            // console.log(model_no.length);
            this_val = $.trim($(this).val());
            if (model_no.length > 0) {
                $(this).closest('tr').find('.model_no .error_msg').text('');
                if (Number(this_val) == '')
                {
                    $(this).closest('td').find('.error_msg').text('Required field').css('display', 'inline-block');
                    m++;
                } else {
                    $(this).closest('td').find('.error_msg').text("");
                }

            } else {
                $(this).closest('tr').find('.model_no_class .error_msg').text('Required field').css('display', 'inline-block');
                m++;
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
            $('#app_table').empty();
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
                    }
                });


            }
            if ($.trim(already_selected) != "") {

                var exists = already_selected.split(",");
                $.each(selectedValues, function (i, val) {

                    if (jQuery.inArray(val, exists) > -1 && exists.length > 0)
                    {

                    } else {



                        var option_text = '';
                        option_text += '<tr class="inv_id_trfirst' + val + '">';
                        option_text += '<td colspan = "4" style = "    text-align: left; width:26% !important;"><b>' + val + '</b> <a href="javascript:0" class="btn btn-xs btn-success" onclick="products_clone(\'' + val + '\')"><span class="glyphicon glyphicon-plus"></span></a></td>';
                        option_text += '</tr>';
                        option_text += '<tr class="inv_id_trsecond' + val + '"><td colspan="11">';
                        option_text += '<table width="100%" class="invoice_id_table table table-bordered inv_id_table_' + val + '"> </table>';
                        option_text += '</td></tr>';
                        $('#app_table').append(option_text);
                        exists.push(val);
                        var already_selected = $('#already_select').val(exists);
                    }

                });
            } else {

                var already_select = [];

                $.each(selectedValues, function (i, val) {

                    already_select.push(val);

                    var option_text = '';
                    option_text += '<tr class="inv_id_trfirst' + val + '">';
                    option_text += '<td colspan = "4" style = "    text-align: left; width:26% !important;"><b>' + val + '</b> <a href="javascript:0" class="btn btn-xs btn-success" onclick="products_clone(\'' + val + '\')"><span class="glyphicon glyphicon-plus"></span></a></td>';
                    option_text += '</tr>';
                    option_text += '<tr class="inv_id_trsecond' + val + '"><td colspan="11">';
                    option_text += '<table width="100%" class="invoice_id_table table table-bordered inv_id_table_' + val + '"> </table>';
                    option_text += '</td></tr>';
                    $('#app_table').append(option_text);
                });

                $('#already_select').val(already_select);


            }
        }


    });

    function products_clone(inv_id) {
        var tableBody = $(".static").find('tr').clone();
        var inv_table = "inv_id_table_" + inv_id;
        $(tableBody).closest('tr').find('select,.model_no,.model_no_ser,.percost,.qty').addClass('required');

        $('#app_table').find('.' + inv_table + '').append(tableBody);
        $('.subtable').show();
        var j = 1;
        $('#app_table').find('.' + inv_table + '  tr').each(function () {
            $(this).closest("tr").addClass('inv_div' + j + '');
            $(this).closest("tr").find('.s_no').html(j);
            $(this).closest("tr").find('.model_no ').attr('data-invid', inv_id);
            $(this).closest("tr").find('.delete_group ').attr('data-inc', j);
            $(this).closest("tr").find('.delete_group ').attr('data-invid', inv_id);
            j++;
        });

    }


    $('.delete_group').live('click', function () {

        var inv_id = $(this).attr('data-invid');
        var inc_id = $(this).attr('data-inc');
        var inv_table = "inv_id_table_" + inv_id;


        $(this).closest("tr").remove();

        calculate_function();



        var j = 1;
        $('#app_table').find('.' + inv_table + '  tr').each(function () {
            $(this).closest("tr").addClass('inv_div' + j + '');
            $(this).closest("tr").find('.s_no').html(j);
            $(this).closest("tr").find('.model_no ').attr('data-invid', inv_id);
            $(this).closest("tr").find('.delete_group ').attr('data-inc', j);
            j++;
        });


    });



    $('body').on('keydown', '#add_quotation input.model_no', function (e) {

        var _this = $(this);

        $('#add_quotation tbody tr input.model_no').autocomplete({
            source: function (request, response) {

                var val = _this.closest('tr input.model_no').val();

                var inv_id = _this.closest('tr input.model_no').attr('data-invid');

                firm_id = $('#firm_id').val();

                cust_id = $('#customer_id').val();

                var product_data = [];

                if ($.trim(val).length != 0) {

                    $.ajax({
                        type: 'POST',
                        data: {firm_id: firm_id, cust_id: cust_id, pro_key: val, inv_id: inv_id},
                        async: false,
                        url: '<?php echo base_url(); ?>quotation/get_product_by_invid',
                        success: function (data) {

                            product_data = JSON.parse(data);

                        }

                    });

                }
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
            autoFocus: true,
            autoFill: false,
            select: function (event, ui) {

                this_val = $(this);

                product = ui.item.value;

                $(this).val(product);

                model_number_id = ui.item.id;

                firm_id = $('#firm_id').val();

                var inv_id = $(this).closest('tr input.model_no').attr('data-invid');

                $.ajax({
                    type: 'POST',
                    data: {model_number_id: model_number_id, c_id: cust_id, inv_id: inv_id},
                    url: "<?php echo $this->config->item('base_url'); ?>" + "purchase_order/get_product_by_invid/" + firm_id,
                    success: function (data) {

                        var result = JSON.parse(data);

                        if (result != null && result.length > 0) {


                            var prod_array = new Array();
                            var inv_table = ".inv_id_table_" + inv_id;
                            $('' + inv_table + ' .product_id').each(function () {

                                prod_array.push($(this).val());

                            });

                            if (jQuery.inArray(result[0].id, prod_array) > -1 && prod_array.length > 0)
                            {
                                var inv_table = ".inv_id_table_" + inv_id;
                                var inv_table_produt = ".tr_product_" + result[0]['id'];


                                qty_val = $('' + inv_table + ' ' + inv_table_produt + '').attr('data-returnqty');



                                var add = Number(qty_val) + Number(1);



                                if (result[0].quantity < add) {

                                    toastr.clear();
                                    toastr.error("Product Not Exists", 'Warning Message.!', {
                                        positionClass: "toast-top-left"
                                    });

                                    this_val.closest('tr').remove();
                                } else {

                                    $('' + inv_table + ' ' + inv_table_produt + '').find('.qty').val(add);

                                    $('' + inv_table + ' ' + inv_table_produt + '').attr('data-returnqty', add);

                                    calculate_function();

                                    this_val.closest('tr').find('.model_no').val('');
                                }



                            } else {
                                if (result[0].quantity != null) {

                                    this_val.closest('tr').find('.stock_qty').val(result[0].quantity);

                                } else {

                                    this_val.closest('tr').find('.stock_qty').val('0');

                                }

                                this_val.closest('tr').find('.qty').attr('sales_qty', result[0].quantity);




                                this_val.closest('tr').addClass('tr_product_' + result[0]['id']);

                                this_val.closest('tr').attr('data-returnqty', 0);


                                this_val.closest('tr').find('.unit').val(result[0].unit);

                                this_val.closest('tr').find('.brand_id').val(result[0].brand_id);

                                this_val.closest('tr').find('.cat_id').val(result[0].category_id);

                                this_val.closest('tr').find('.discount').val(result[0].discount);

                                this_val.closest('tr').find('.cost_price').val(result[0].cost_price);

                                this_val.closest('tr').find('.type').val(result[0].type);

                                this_val.closest('tr').find('.product_id').val(result[0].id);

                                this_val.closest('tr').find('.product_name').val(result[0].product_name);

                                this_val.closest('tr').find('.model_no').val(result[0].product_name);

                                this_val.closest('tr').find('.model_no_extra').val(result[0].model_no);

                                this_val.closest('tr').find('.product_description').val(result[0].product_description);

                                if ($('#gst_type').val() != '')
                                {

                                    if ($('#gst_type').val() == 31)
                                    {
                                        this_val.closest('tr').find('.pertax').val(result[0].cgst);

                                        this_val.closest('tr').find('.gst').val(result[0].sgst);
                                        this_val.closest('tr').find('.igst').val(0.00);

                                    } else {
                                        this_val.closest('tr').find('.pertax').val(result[0].cgst);

                                        this_val.closest('tr').find('.igst').val(result[0].igst);
                                        this_val.closest('tr').find('.gst').val(0.00);

                                    }
                                }

                                calculate_function();



                                this_val.closest('tr').find('.qty').focus();

                                this_val.closest('tr').find('.qty').attr('tabindex', '');

                                this_val.closest('tr').find('.percost').attr('tabindex', '');


                            }

                        }

                    }

                });

            }

        });



    });


    $('.qty,.percost,.pertax,.totaltax,.gst,.igst,.discount,.transport').live('keyup', function () {

        calculate_function();

    });


    $('.qty').live('keyup', function () {
        var qty = $(this).val();

        var sales_qty = $(this).attr('sales_qty');



        if (qty > sales_qty) {
            $(this).closest('tr').find('.sales_qty_details .error_msg').text('Invalid quantity');
        } else {
            $(this).closest('tr').attr('data-returnqty', qty);
            $(this).closest('tr').find('.sales_qty_details .error_msg').text(' ');
            calculate_function();
        }


    });




    function calculate_function()

    {

        var final_qty = 0;

        var final_sub_total = 0;

        $('.qty').each(function () {

            var qty = $(this);

            var percost = $(this).closest('tr').find('.percost');

            var pertax = $(this).closest('tr').find('.pertax');

            var gst = $(this).closest('tr').find('.gst');

            var igst = $(this).closest('tr').find('.igst');

            var subtotal = $(this).closest('tr').find('.subtotal');

            var discount = $(this).closest('tr').find('.discount');

            var transport = $(this).closest('tr').find('.transport');

            if (Number(qty.val()) != 0)
            {

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



</script>




