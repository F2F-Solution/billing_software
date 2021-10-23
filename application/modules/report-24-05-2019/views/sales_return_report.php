<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<script type='text/javascript' src='<?= $theme_path; ?>/js/jquery.table2excel.min.js'></script>
<style>

    td a { border: none !important; }
    td a:hover { border: none !important; }
    .action-btn-align {text-align: center !important; }
    .bg-red {background-color: #dd4b39 !important;}
    .bg-green { background-color:#09a20e !important;}
    .bg-yellow{background-color:orange !important;}
    .ui-datepicker td.ui-datepicker-today a { background:#999999;}
    .btn-group > .btn, .btn-group-vertical > .btn { border-width: 0px!important;}
    table tr td:nth-child(6) {text-align:left; }
    table tr td:nth-child(9) {text-align:right !important;}
    table tr td:nth-child(7) {text-align:right !important;}
    table tr td:nth-child(8) {
        text-align: center !important;
    }
    #myDIVSHOW {
        display:none;
    }
    .search-area .col-md-2 {
        width: 16%;
    }
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
                    <h3><?= $this->config->item("company_name") ?></h3>
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
        <div class="row">
            <div class="col-md-10">
                <h4>Sales Return Report</h4>
            </div>
            <div class="col-md-2">
                <input type="button" id="show"  class="btn btn-info clor" style="float:right; margin-top:9px;" value="Advance Search"></button>
                <!--<button id="hide" class="btn btn-danger clor">hide</button>-->
            </div>
        </div>
    </div>
    <div class="panel-body mt--40" id="myDIVSHOW">
        <div class="row search_table_hide search-area">
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label">Firm</label>
                    <select id='firm' class="form-control">
                        <option value="">Select</option>
                        <?php
                        if (isset($firms) && !empty($firms)) {
                            foreach ($firms as $val) {
                                ?>
                                <option value='<?= $val['firm_id'] ?>'><?= $val['firm_name'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Invoice Id</label>
                    <select id='inv_id' class="form-control">
                        <option>Select</option>
                        <?php
                        if (isset($all_style) && !empty($all_style)) {
                            foreach ($all_style as $val) {
                                ?>
                                <option value='<?= $val['inv_id'] ?>'><?= $val['inv_id'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Customer</label>
                    <select id='customer'  class="form-control" >
                        <option>Select</option>
                        <?php
                        if (isset($all_supplier) && !empty($all_supplier)) {
                            foreach ($all_supplier as $val) {
                                ?>
                                <option value='<?= $val['id'] ?>'><?= $val['store_name'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label">From Date</label>
                    <input type="text" id='from_date'  class="form-control datepicker" name="inv_date" placeholder="yyyy-mm-dd" >
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label">To Date</label>
                    <input type="text"  id='to_date' class="form-control datepicker" name="inv_date" placeholder="yyyy-mm-dd" >
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label">GST</label>
                    <select id='gst_sales_report'  class="form-control" >
                        <option value="">Select</option>
                        <?php
                        if (isset($all_gst) && !empty($all_gst)) {
                            foreach ($all_gst as $val) {
                                if ($val != 0.00) {
                                    ?>
                                    <option value='<?= $val ?>'><?= $val ?>%</option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label">Product</label>
                    <select id='product'  class="form-control">
                        <option>Select</option>
                        <?php
                        if (isset($all_product) && !empty($all_product)) {
                            foreach ($all_product as $val) {
                                ?>
                                <option value='<?= $val['id'] ?>'><?= $val['product_name'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group mcenter">
                    <label class="control-label col-md-12 mnone">&nbsp;</label>
                    <a id='search' class="btn btn-success  mtop4"><span class="glyphicon glyphicon-search "></span> Search</a>
                    <a class="btn btn-danger1 mtop4" id="clear"><span class="fa fa-close"></span> Clear</a>
                </div>
            </div>
        </div>
    </div>
    <div class="contentpanel">
        <div class="panel-body mt-top5">
            <div class="result_div">
                <table id="basicTable_call_back" class="table table-striped table-bordered responsive no-footer dtr-inline totlqua-cntr cgst2-right
                       sgst2-right subtotal1-right invamountgst-right">
                    <thead>
                        <tr>
                            <th class="action-btn-align">S.No</th>
                            <th class="action-btn-align">Invoice ID</th>
                            <th class="action-btn-align">Firm Name</th>
                            <th class="action-btn-align">Firm GSTIN</th>
                            <th class="action-btn-align">Customer name</th>
                            <th class="action-btn-align">Customer GSTIN</th>
                            <th class="action-btn-align">Inv Amt</th>
                            <th class="action-btn-align">Return QTY</th>
                            <th class="action-btn-align">CGST</th>
                            <th class="action-btn-align  proimg-wid" >SGST</th>
                            <th class="action-btn-align " >Subtotal</th>
                            <th class="action-btn-align">Return Amt</th>
                            <th class="action-btn-align">Balance Amt</th>
                            <!-- <?php
                            $gst_type = $all_style[0]['state_id'];

                            if ($gst_type != '') {

                                if ($gst_type == 31) {
                                    ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <th class="action-btn-align  proimg-wid" >SGST%</th>

                                <?php } else { ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <th class="action-btn-align proimg-wid" >IGST%</th>



                                    <?php
                                }
                            }
                            ?> -->
                            <td class="action-btn-align">Return Date</td>

                        </tr>
                    </thead>

                    <tbody id='result_div'>
                        <?php
                        if (isset($customer) && !empty($customer)) {

                            $i = 1;

                            foreach ($customer as $vals) {
                                ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <a href="<?php echo base_url() . 'sales_return/make_return_view/' . $vals['inv_id'] ?>"><?php echo $vals['inv_number'] ?></a>
                                    </td>
                                    <td><?php echo $vals['firm_name']; ?></td>
                                    <td><?php echo ($vals['gstin']) ? $vals['gstin'] : ''; ?></td>
                                    <td><?php echo $vals['store_name']; ?> </td>
                                    <td><?php echo ($vals['tin']) ? $vals['tin'] : '' ?></td>
                                    <td class="text_right"><?php echo number_format($vals['net_total'], 2); ?></td>
                                    <td class="text_right"><?php echo number_format($vals['return_qty'], 2); ?></td>
                                    <td class="text_right">
                                        <?php echo number_format(($vals['sub_total'] * $vals['tax'] / 100), 2); ?>
                                    </td>
                                    <td class="text_right">
                                        <?php echo number_format(($vals['sub_total'] * $vals['gst'] / 100), 2); ?>
                                    </td>
                                    <td class="text_right"><?php echo $vals['sub_total']; ?></td>
                                    <td class="text_right"><?php echo $vals['return_amount']; ?></td>
                                    <td class="text_right"><?php echo number_format((($vals['net_total'] - $vals['return_amount']) - round($vals['receipt_bill'][0]['receipt_paid'] + $vals['advance'] + $vals['receipt_bill'][0]['receipt_discount'], 2)), 2) ?></td>
                                    <td><?php echo ($vals['created_date'] != '1970-01-01') ? date('d-M-Y', strtotime($vals['created_date'])) : ''; ?></td>

                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text_right total-bg"></td>
                    <td class="text_right total-bg"></td>
                    <td class="text_right total-bg"></td>
                    <td class="text_right total-bg"></td>
                    <td class="text_right total-bg return_qty_amt"></td>
                    <td class="text_right total-bg"></td>
                    <td class="text_right total-bg"></td>
                    <td></td>
                    </tfoot>
                </table>
            </div>
            <div class="action-btn-align mb-10">
                <button class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</button>

                <div class="btn-group">
                    <button type="button" class=" btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-print"></span> Excel
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" class="excel_btn1">Current Entries</a></li>
                        <li><a href="#" id="excel-prt">Entire Entries</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>
<div id="export_excel"></div>
<script>
    $('.print_btn').click(function () {
        window.print();
    });
    $('#clear').live('click', function ()
    {
        window.location.reload();
    });</script>
</div><!-- contentpanel -->

</div><!-- mainpanel -->
<script type="text/javascript">


    $(document).ready(function () {
        $('#customer').select2();
        $('#inv_id').select2();
    });

    $('#search').on('click', function () {
        for_loading();
        $.ajax({
            url: BASE_URL + "report/sales_return_search_result",
            type: 'GET',
            cache: false,
            data: {
                inv_id: $('#inv_id').val(),
                customer: $('#customer').val(),
                from_date: $('#from_date').val(),
                to_date: $('#to_date').val(),
                gst: $('#gst_sales_report').val(),
                product: $('#product').val(),
                firm: $('#firm').val(),
            },
            success: function (result) {
                for_response();
                $('.result_div').html('');
                $('.result_div').html(result);
                data_tab_init();
            }
        });
    });</script>
<script type="text/javascript">

    $(document).ready(function ()
    {
        var table;
        //datatables
        table = jQuery('#basicTable_call_back').DataTable({
            "processing": true, //Feature control the processing indicator.
            "retrieve": true,
            "fixedColumns": true,
            "order": [],
            "columnDefs": [
                {
                    "targets": [0, 13], //first column / numbering column
                    "orderable": false, //set not orderable
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
                var cols = [6, 7, 8, 9, 10, 11, 12];
                var numFormat = $.fn.dataTable.render.number('\,', '.', 2).display;

                for (x in cols) {
                    total = api.column(cols[x]).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                    // Total over this page
                    pageTotal = api.column(cols[x], {page: 'current'}).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                    // Update footer
//                    if (Math.floor(pageTotal) == pageTotal && $.isNumeric(pageTotal)) {
//                        pageTotal = pageTotal;
//                    } else {
//                        pageTotal = pageTotal.toFixed(2); /* float */
//
//                    }
                    $(api.column(cols[x]).footer()).html((numFormat(pageTotal)));
                }


            },
            responsive: true,
            columnDefs: [
                {responsivePriority: 1, targets: 0},
                {responsivePriority: 2, targets: -2}
            ],
        });
        new $.fn.dataTable.FixedHeader(table);

        $("#yesin").live("click", function ()
        {

            var hidin = $(this).parent().parent().find('.id').val();
            // alert(hidin);
            $.ajax({
                url: BASE_URL + "Project_cost_model/quotation_delete",
                type: 'POST',
                data: {value1: hidin},
                success: function (result) {

                    window.location.reload(BASE_URL + "Project_cost_model/quotation_list");
                }
            });
        });
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");
    });
    function data_tab_init() {
        var table;
        //datatables
        table = jQuery('#basicTable_call_back').DataTable({
            "processing": true, //Feature control the processing indicator.
            "retrieve": true,
            "fixedColumns": true,
            "order": [],
            "columnDefs": [
                {
                    "targets": [0, 13], //first column / numbering column
                    "orderable": false, //set not orderable
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
                var cols = [6, 7, 8, 9, 10, 11, 12];
                var numFormat = $.fn.dataTable.render.number('\,', '.', 2).display;
                for (x in cols) {
                    total = api.column(cols[x]).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                    // Total over this page
                    pageTotal = api.column(cols[x], {page: 'current'}).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                    // Update footer
//                    if (Math.floor(pageTotal) == pageTotal && $.isNumeric(pageTotal)) {
//                        pageTotal = pageTotal;
//                    } else {
//                        pageTotal = pageTotal.toFixed(2); /* float */
//
//                    }
                    $(api.column(cols[x]).footer()).html((numFormat(pageTotal)));
                }


            },
            responsive: true,
            columnDefs: [
                {responsivePriority: 1, targets: 0},
                {responsivePriority: 2, targets: -2}
            ]
        });
        new $.fn.dataTable.FixedHeader(table);
    }
    jQuery('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });

</script>
<script>
    $('.excel_btn1').live('click', function () {
        fnExcelReport1();
    });

    function fnExcelReport1()
    {
        var tab_text = "<table id='custom_export' border='5px'><tr width='100px' bgcolor='#87AFC6'>";
        var textRange;
        var j = 0;
        tab = document.getElementById('basicTable_call_back'); // id of table
        for (j = 0; j < tab.rows.length; j++)
        {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }
        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
        $('#export_excel').show();
        $('#export_excel').html('').html(tab_text);
        $('#export_excel').hide();
        $("#custom_export").table2excel({
            exclude: ".noExl",
            name: "Sales Return Report",
            filename: "Sales Return Report",
            fileext: ".xls",
            exclude_img: false,
            exclude_links: false,
            exclude_inputs: false
        });
    }
    $('#excel-prt').on('click', function () {

        var inv_id = $('#inv_id').val();
        var customer = $('#customer').val();
        var gst = $('#gst_sales_report').val();
        var product = $('#product').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var firm = $('#firm').val();
        window.location = (BASE_URL + 'report/getall_sales_return_entries?inv_id=' + inv_id + '&customer=' + customer + '&product=' + product + '&gst=' + gst + '&from_date=' + from_date + '&to_date=' + to_date + '&firm' + firm);
    });
</script>
<script>
    $(document).ready(function () {
        $("#show").click(function () {
            $("#myDIVSHOW").toggle();
        });
    });
    $('#show').click(function () {
        var self = this;
        change(self);
    });

    function change(el) {
        if (el.value === "Advance Search")
            el.value = "Hide";
        else
            el.value = "Advance Search";
    }
</script>
<script src="<?= $theme_path; ?>/js/fixedheader/jquery.dataTables.min.js"></script>


