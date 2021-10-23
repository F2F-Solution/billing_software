<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>

<script src="<?php echo $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>

<script type="text/javascript" src="<?php echo $theme_path; ?>/js/jquery.scannerdetection.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js//sweetalert.css">

<script src="<?php echo $theme_path; ?>/js/sweetalert.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/css/fSelect.css"/>
<script type='text/javascript' src='<?= $theme_path; ?>/js/fSelect.js'></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



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

    .text_right    {

        text-align:right;

    }


    .bootstrap-tagsinput{

        height: 72px;
        overflow-y: auto;
    }

    .box, .box-body, .content { padding:0; margin:0;border-radius: 0;}

    #top_heading_fix h3 {top: -57px;left: 6px;}

    #TB_overlay { z-index:20000 !important; }

    #TB_window { z-index:25000 !important; }

    .dialog_black{ z-index:30000 !important; }

    #boxscroll22 {max-height: 291px;overflow: auto;cursor: inherit !important;}

    .error_msg, em{color: rgb(255, 0, 0); font-size: 12px;font-weight: normal;}

    .ui-datepicker td.ui-datepicker-today a {

        background:#999999;

    }

    .auto-asset-search

    {

        position:absolute !important;

    }

    .auto-asset-search ul#country-list li

    {

        margin-left:-40px !important;

        width:297px;

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

        width:297px;

    }

    ul li {

        list-style-type: none;

    }
    .btn-xs {
        border-radius:0px !important;
    }

    #suggesstion-box{

        z-index: 99;

    }

    .fs-wrap, .multiple, .fs-default, .fs-dropdown{
        width: 100% !important;
    }
    .fs-dropdown {
        position: relative !important;
    }
    .ui-autocomplete {z-index: 9999 !important;}
    table tr td:nth-child(2) {text-align: left !important;}
    table tr td:nth-child(3) {text-align: left !important;}
</style>

<?php
$this->load->model('admin/admin_model');

$data['company_details'] = $this->admin_model->get_company_details();
?>

<div class="print_header">

    <table width="100%">

        <tr>

            <td width="15%" style="vertical-align:middle;">

                <div class="print_header_logo" ><img src="<?= $theme_path; ?>/images/logo.png" /></div>

            </td>

            <td width="85%">

                <div class="print_header_tit" >

                    <h3>The Total</h3>

                    <p>

                        <?= $data['company_details'][0]['address1'] ?>,

                        <?= $data['company_details'][0]['address2'] ?>,

                    </p>

                    <p></p>

                    <p><?= $data['company_details'][0]['city'] ?>-

                        <?= $data['company_details'][0]['pin'] ?>,

                        <?= $data['company_details'][0]['state'] ?></p>

                    <p></p>

                    <p>Ph:

                        <?= $data['company_details'][0]['phone_no'] ?>, Email:

                        <?= $data['company_details'][0]['email'] ?>

                    </p>

                </div>

            </td>

        </tr>

    </table>

</div>

<div class="mainpanel">

    <div class="media mt--20">

        <h4>Sales Return
            <p class="right">  <button class="btn btn-success topgen" title="Add Sales Return" onclick="sales_return_modal()" id="sal-inv" style="background-color:sal#ff5a92; color:#ffffff" data-toggle="modal" data-target="#sales_return_modal"><span class="glyphicon glyphicon-plus"></span>Make Return </button>&nbsp;


        </h4>

    </div>


    <div id="sales_return_modal" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content" style="overflow-y:auto;">
                <div class="modal-header bg-info ">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 class="modal-title" >Sales Return</h3>
                </div>
                <div class="modal-body">
                    <br>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Customer Name</label>
                        <div class="col-sm-8 relative">
                            <div class="input-group">
                                <input type="text" tabindex="1" name="customer_name" id="customer_name" class='form-align customer_auto' />
                                <input type="hidden" tabindex="1" name="customer_id" id="customer_id" class='form-align ' />
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <span class="customer_error_msg error_msg"></span>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">From Date</label>
                        <div class="col-sm-8 relative">
                            <div class="input-group">
                                <input type="text" tabindex="2" name="from_date" id="from_date" placeholder="dd-mm-yyyy" value="" class='datepicker from_date '/>
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <span class="fromdate_error_msg error_msg" style="margin-left: 200px;"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">To Date</label>
                        <div class="col-sm-8 relative">
                            <div class="input-group">
                                <input type="text" tabindex="3" name="to_date" id="to_date" placeholder="dd-mm-yyyy" value="" class=' datepicker to_date'  />
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <span class="todate_error_msg error_msg" style="margin-left: 200px;"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Product Name</label>
                        <div class="col-sm-8 ">

                            <div class="product_name_select">
                                <select id='product_name' name="product_name" class="form-control multi_select wid100" multiple="multiple" >

                                    <option>Select</option>


                                </select>

                            </div>
                        </div>
                        <span class="error_msg" style="margin-left: 200px;"></span>
                    </div>
                </div>
                <div id="suggesstion-box" class="auto-asset-search"></div>
                <div class="modal-footer">
                    <button type="button" name="submit" tabindex="5" id="submit_modal" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="hidden" name="product_id_arr" value="" id="product_id_arr"/>
                </div>
            </div>
        </div>
    </div>



    <div class="contentpanel">

        <div id='result_div' class="panel-body mt-top5 pb0">

            <div class="tabpad">

                <table id="basicTable_call_back" class="table table-striped table-bordered responsive dataTable no-footer dtr-inline totalqua-cntr returnqua-cntr presentqua-cntr totalamt-right" cellspacing="0" width="100%">

                    <thead>

                        <tr>

                            <td class="action-btn-align">S.No</td>

                            <td class='action-btn-align'>Inv ID</td>

                            <td>Customer Name</td>

                            <td class="action-btn-align">Total QTY</td>

                            <td>Total Amount</td>

                            <td class="action-btn-align">Return QTY</td>

                            <td>Return Amount</td>

                            <td>Action</td>


                        </tr>

                    </thead>

                    <tbody>

                    </tbody>


                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text_right total-bg"></td>
                            <td class="text_right total-bg"></td>
                            <td class="text_right total-bg"></td>
                            <td class="text_right total-bg"></td>

                            <td class="hide_class"></td>
                        </tr>
                    </tfoot>

                </table>

            </div>

            <div class="action-btn-align mb-10">

                <button class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</button>

            </div>

        </div>
    </div>

</div>



<script type="text/javascript">

    var table;

    jQuery(document).ready(function () {

        //datatables
        table = jQuery('#basicTable_call_back').DataTable({
            "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
            "pageLength": 50,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            //dom: 'Bfrtip',
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('sales_return/make_retun_ajax/'); ?>",
                "type": "POST",
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0, 7], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                {
                    "class": "text_right", "targets": [1, 2, 3]
                },
                {
                    "class": "action-btn-align", "targets": [4, 5, 6]
                },
                {
                    "class": "hide_class", "targets": [7]
                },
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                var cols = [3, 4, 5, 6];
                for (x in cols) {
                    total = api.column(cols[x]).data().reduce(function (a, b) {

                        return intVal(a) + intVal(b);
                    }, 0);
                    // Total over this page
                    pageTotal = api.column(cols[x], {page: 'current'}).data().reduce(function (a, b) {
                        if (b.indexOf('--') !== -1) {
                            var test = b.split('--');
                            b = 0;
                            //for (var j = 0, len = test.length; j < len; j++) {
                            b = intVal(b) + intVal(test[0]);
                            // }
                        }
                        return intVal(a) + intVal(b);
                    }
                    , 0);
                    // Update footer
//                    if (Math.floor(pageTotal) == pageTotal && $.isNumeric(pageTotal)) {
//                        pageTotal = pageTotal;
//
//                    } else {
//                        pageTotal = pageTotal.toFixed(2);/* float */
//
//                    }
                    $(api.column(cols[x]).footer()).html(pageTotal.toFixed(2));
                }


            },
            responsive: true,
//            columnDefs: [
//                {responsivePriority: 1, targets: 0},
//                {responsivePriority: 2, targets: -2}
//            ]
        });
        new $.fn.dataTable.FixedHeader(table);


    });

    $('#submit_modal').live('click', function () {


        var customer_name = $('#customer_name').val();

        var m = 0;

        if (customer_name == "") {
            $('.customer_error_msg').text('This field is required');
            m++;
        } else {
            $('.customer_error_msg').text('');
        }


        var product_exists = $('#product_id_arr').val();

        if (customer_name != "" && product_exists == "") {
            toastr.clear();
            toastr.error("Product Not Exists Please Try Another", 'Warning Message.!', {
                positionClass: "toast-top-center"
            });
            //  alert("Product Not Exists Please Try Another");
            m++;
        }


        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();

        $('.fromdate_error_msg').text('');
        $('.todate_error_msg').text('');

        if (from_date != "" && to_date == "") {
            $('.todate_error_msg').text('This field is required');
            m++;
        }
        if (to_date != "" && from_date == "") {
            $('.fromdate_error_msg').text('This field is required');
            m++;
        }

        var product_name = $('#product_name').val();

        if (m > 0) {
            return false;
        } else {
            var base_url = "<?php echo $this->config->item('base_url'); ?>";

            if (from_date != "" && to_date != "") {
                var from_date = encode(from_date);
                var to_date = encode(to_date);
            } else {
                var from_date = encode("from_date");
                var to_date = encode("to_date");
            }

            if (product_name == null) {
                var product_name = encode("product_name");
            } else {
                var product_name = encode("product_name");
            }

            var customer_id = $('#customer_id').val();

            window.location.href = base_url + "sales_return/make_return/" + customer_id + "/" + from_date + "/" + to_date + "/" + product_name;
            /*  $.ajax({
             type: 'POST',
             data: {customer_name: customer_name},
             url: "<?php echo $this->config->item('base_url'); ?>" + "sales_return/get_customerid_by_name/",
             success: function (id) {

             window.location.href = base_url + "sales_return/make_return/" + id + "/" + from_date + "/" + to_date + "/" + product_name;

             }

             });*/

        }



    });

    function encode(data) {


        var Base64 = {_keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=", encode: function (e) {
                var t = "";
                var n, r, i, s, o, u, a;
                var f = 0;
                e = Base64._utf8_encode(e);
                while (f < e.length) {
                    n = e.charCodeAt(f++);
                    r = e.charCodeAt(f++);
                    i = e.charCodeAt(f++);
                    s = n >> 2;
                    o = (n & 3) << 4 | r >> 4;
                    u = (r & 15) << 2 | i >> 6;
                    a = i & 63;
                    if (isNaN(r)) {
                        u = a = 64
                    } else if (isNaN(i)) {
                        a = 64
                    }
                    t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a)
                }
                return t
            }, decode: function (e) {
                var t = ""; var n, r, i; var s, o, u, a; var f = 0; e = e.replace(/++[++^A-Za-z0-9+/=]/g, ""); while (f < e.length){
                    s = this._keyStr.indexOf(e.charAt(f++));
                    o = this._keyStr.indexOf(e.charAt(f++));
                    u = this._keyStr.indexOf(e.charAt(f++));
                    a = this._keyStr.indexOf(e.charAt(f++));
                    n = s << 2 | o >> 4;
                    r = (o & 15) << 4 | u >> 2;
                    i = (u & 3) << 6 | a;
                    t = t + String.fromCharCode(n);
                    if (u != 64) {
                        t = t + String.fromCharCode(r)
                    }
                    if (a != 64) {
                        t = t + String.fromCharCode(i)
                    }
                }
                t = Base64._utf8_decode(t);
                return t
            }, _utf8_encode: function (e) {
                e = e.replace(/\r\n/g, "n");
                var t = "";
                for (var n = 0; n < e.length; n++) {
                    var r = e.charCodeAt(n);
                    if (r < 128) {
                        t += String.fromCharCode(r)
                    } else if (r > 127 && r < 2048) {
                        t += String.fromCharCode(r >> 6 | 192);
                        t += String.fromCharCode(r & 63 | 128)
                    } else {
                        t += String.fromCharCode(r >> 12 | 224);
                        t += String.fromCharCode(r >> 6 & 63 | 128);
                        t += String.fromCharCode(r & 63 | 128)
                    }
                }
                return t
            }, _utf8_decode: function (e) {
                var t = "";
                var n = 0;
                var r = c1 = c2 = 0;
                while (n < e.length) {
                    r = e.charCodeAt(n);
                    if (r < 128) {
                        t += String.fromCharCode(r);
                        n++
                    } else if (r > 191 && r < 224) {
                        c2 = e.charCodeAt(n + 1);
                        t += String.fromCharCode((r & 31) << 6 | c2 & 63);
                        n += 2
                    } else {
                        c2 = e.charCodeAt(n + 1);
                        c3 = e.charCodeAt(n + 2);
                        t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                        n += 3
                    }
                }
                return t
            }}

        var string = data;

        var encodedString = Base64.encode(string);

        return encodedString;
    }
    $(document).ready(function () {

        $('.multi_select').fSelect();


        $('.fs-label-wrap').find('.fs-label').text('Select Product Name');

        $('.customer_auto').on('keydown', function () {

            var _this = $(this).val();


            $('body').find(".customer_auto").autocomplete({
                source: function (request, response) {

                    $.ajax({
                        type: 'POST',
                        data: {customer_name: $('#customer_name').val()},
                        url: "<?php echo $this->config->item('base_url'); ?>" + "sales_return/get_customer_name_bykey/",
                        success: function (data) {


                            data = JSON.parse(data);

                            var c_data = data;

                            var outputArray = new Array();

                            for (var i = 0; i < c_data.length; i++) {



                                if (c_data[i].value.toLowerCase().match(request.term.toLowerCase())) {

                                    outputArray.push(c_data[i]);

                                }

                            }

                            if (outputArray.length == 0) {
                                var nodata = 'No Data Found';
                                outputArray.push(nodata);

                                $('#customer_id').val('');
                            }



                            response(outputArray.slice(0, 10));

                        }

                    });

                },
                minLength: 0,
                delay: 0,
                autoFocus: true,
                select: function (event, ui) {

                    cust_id = ui.item.id;

                    var from_date = $('#from_date').val();

                    var to_date = ($('#to_date').val());

                    $('#customer_id').val(cust_id);

                    get_product_list(cust_id, from_date, to_date);

                }

            });


        });

    });
    function sales_return_modal() {
        $('#sales_return_modal').show();

        $(".datepicker").datepicker();
        $('.datepicker').datepicker({
            dateFormat: "mm-dd-yy",
            changeMonth: true,
            changeYear: true
        });



        $('#customer_name').focus();
    }

    function cancel_modal() {
        $('#sales_return_modal').hide();
    }

    $("#to_date").on("change", function () {
        var to_date = this.value;
        var from_date = $('#from_date').val();
        var cust_id = $('#customer_id').val();

        var customer_name = $('#customer_name').val();

        if (customer_name == "") {
            $('.customer_error_msg').text('This field is required');
            m++;
        } else {
            $('.customer_error_msg').text('');
            get_product_list(cust_id, from_date, to_date);
        }



    });

    $("#from_date").on("change", function () {
        var from_date = (this.value);
        var to_date = ($('#to_date').val());
        var cust_id = $('#customer_id').val();

        var customer_name = $('#customer_name').val();

        if (customer_name == "") {
            $('.customer_error_msg').text('This field is required');
            m++;
        } else {
            $('.customer_error_msg').text('');
            get_product_list(cust_id, from_date, to_date);
        }

    });



    function get_product_list(cust_id, from_date, to_date) {


        $.ajax({
            type: 'POST',
            data: {cust_id: cust_id, from_date: from_date, to_date: to_date},
            url: "<?php echo $this->config->item('base_url'); ?>" + "sales_return/get_customer_product_list/",
            success: function (data) {

                var result = JSON.parse(data);

                var option_text = '';

                var product_id_arr = [];
                if (result != null && result.length > 0) {

                    option_text += '<div  tabindex="0"><select id="product_name" class="form-control multi_select product_name" multiple="multiple" autocomplete="off" name="product_name">';

                    option_text += '<option value="">Select Product Name</option>';


                    $.each(result, function (key, value) {

                        selected = '';

                        option_text += '<option  value="' + value.id + '"  ' + selected + '>' + value.value + '</option>';

                        product_id_arr.push(value.id);

                    });

                    option_text += '</select></div>';

                    $('#product_id_arr').val(product_id_arr);

                } else {

                    option_text += '<div  tabindex="0"><select id="product_name" class="form-control multi_select product_name" multiple="multiple" autocomplete="off" name="product_name">';

                    option_text += '<option value="">Select Product Name</option>';

                    option_text += '</select></div>';

                    $('#product_id_arr').val('');
                }



                $('.product_name_select').empty();

                $('.product_name_select').append(option_text);

                $('.multi_select').fSelect();

                $('.fs-label-wrap').find('.fs-label').text('Select Product Name');




            }

        });
    }

    $('.print_btn').click(function () {

        window.print();

    });


</script>

<link href="<?php echo $theme_path; ?>/plugin/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo $theme_path; ?>/plugin/datatables/js/jquery.dataTables.min.js"></script>