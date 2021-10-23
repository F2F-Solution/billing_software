<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?php echo $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<link href="<?php echo $theme_path; ?>/plugin/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<script type='text/javascript' src='<?php echo $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<script type='text/javascript' src='<?= $theme_path; ?>/js/jquery.table2excel.min.js'></script>
<style>
    .bg-red {background-color: #dd4b39 !important;}
    .bg-green {background-color:#09a20e !important;}
    .bg-yellow{ background-color:orange !important;}
    .ui-datepicker td.ui-datepicker-today a {background:#999999;}
    .btn-group > .btn, .btn-group-vertical > .btn { border-width: 0px!important;}
    table tr td:nth-child(4) { text-align:center; }
    table tr td:nth-child(7) { text-align:right; }
    table tr td:nth-child(8) { text-align:right; }
    table tr td:nth-child(10) { text-align:right; }
    table tr td:nth-child(11) { text-align:right !important; }
    #myDIVSHOW {
        display:none;
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
                <h4>Profit and Loss Report</h4>
            </div>
            <div class="col-md-2">
                <input type="button" id="show"  class="btn btn-info clor" style="float:right; margin-top:9px;" value="Advance Search">
                <!--<button id="hide" class="btn btn-danger clor">hide</button>-->
            </div>
        </div>
    </div>
    <div class="panel-body" id="myDIVSHOW">
        <div class="row search_table_hide search-area">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">From Date</label>
                    <input type="text" id='from_date'  class="form-control datepicker" name="inv_date" placeholder="dd-mm-yyyy" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">To Date</label>
                    <input type="text"  id='to_date' class="form-control datepicker" name="inv_date" placeholder="dd-mm-yyyy">
                </div>
            </div>
            <div class="col-md-2">

                <div class="form-group mcenter">
                    <label class="control-label col-md-12 mnone">&nbsp;</label>
                    <a id='search' class="btn btn-success  mtop4"><span class="glyphicon glyphicon-search "></span> Search</a>
                    <a class="btn btn-danger1 mtop4" id="clear"><span class="fa fa-close"></span> Clear</a>
                </div>
            </div>
        </div>
    </div>
    <div class="contentpanel">
        <div id='result_div' class="panel-body mt-top5">
            <div class="">
                <table id="myTable" class="display last-td-center dataTable table table-striped table-bordered responsive dataTable dtr-inline no-footer invoiceamount-right
                       commissionamount-right originalamt-right profitamt-left" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <td class="action-btn-align">S.No</td>
<!--                            <td class="action-btn-align">Quotation No</td>-->
                            <td>Customer Name</td>
<!--                            <td>Quotation Amount</td>-->
                            <td>Invoice NO</td>
                            <td class="action-btn-align">Invoice Date</td>
                            <td>Invoice Amount</td>
                            <td>Return Amount</td>
                            <td>Total Amount</td>
                            <td>Commission Amount</td>
                            <td>Original Amount</td>
                            <td>Profit %</td>
                            <td>Profit Amount</td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td class="text_right total-bg"></td>
                            <td class="text_right total-bg"></td>
                            <td class="text_right total-bg"></td>
                            <td class="text_right total-bg"></td>
                            <td class="text_right total-bg"></td>
                            <td></td>
                            <td class="text_right total-bg"></td>
                        </tr>
                    </tfoot>
                    <tbody id="result_data">
                        <?php
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="action-btn-align mb-10">
                <button class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</button>
                <!--<button class="btn btn-success excel_btn1"><span class="glyphicon glyphicon-print"></span> Excel</button>-->
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
    </div><!-- contentpanel -->

</div><!-- mainpanel -->
<div id="export_excel"></div>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/fSelect.js'></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var table;
        //datatables
        table = jQuery('#myTable').DataTable({
            "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
            "pageLength": 50,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "retrieve": true,
            "order": [], //Initial no order.
            //dom: 'Bfrtip',
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('report/profit_ajaxList/'); ?>",
                "type": "POST",
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0, 9], //first column / numbering column
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
                var cols = [4, 5, 6, 7, 8, 10];
                for (x in cols) {
                    total = api.column(cols[x]).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    // Total over this page
                    pageTotal = api.column(cols[x], {page: 'current'}).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    // Update footer
                    $(api.column(cols[x]).footer()).html(pageTotal.toFixed(2));
                }


            },
        });
        new $.fn.dataTable.FixedHeader(table);
    });


</script>
<script>
    $('.print_btn').click(function () {
        window.print();
    });
    $('#clear').live('click', function ()
    {
        window.location.reload();
    });

</script>
<script type="text/javascript">
    $('.complete_remarks').live('blur', function ()
    {
        var complete_remarks = $(this).parent().parent().find(".complete_remarks").val();
        var ssup = $(this).offsetParent().find('.remark_error');
        if (complete_remarks == '' || complete_remarks == null)
        {
            ssup.html("Required Field");
        } else
        {
            ssup.html("");
        }
    });

    $(document).ready(function () {
        jQuery('.datepicker').datepicker();
    });
    $().ready(function () {
        $("#po_no").autocomplete(BASE_URL + "gen/get_po_list", {
            width: 260,
            autoFocus: true,
            matchContains: true,
            selectFirst: false
        });
    });
    $('#search').live('click', function () {
        for_loading();
        $.ajax({
            url: BASE_URL + "report/search_profit_list",
            type: 'GET',
            data: {
                from_date: $('#from_date').val(),
                to_date: $('#to_date').val()
            },
            success: function (result) {
                for_response();
                var table = $('#myTable').DataTable();
                table.destroy();
                $('#result_data').html(result);
                datatable();

            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function ()
    {

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
</script>
<script>
    $('.excel_btn1').live('click', function () {
        fnExcelReport1();
    });
</script>
<script>

    function datatable() {
        var table;
        table = jQuery('#myTable').DataTable({
            "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
            "pageLength": 50,
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
                var cols = [4, 6, 5, 8];
                for (x in cols) {
                    total = api.column(cols[x]).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    // Total over this page
                    pageTotal = api.column(cols[x], {page: 'current'}).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    // Update footer
                    if (Math.floor(pageTotal) == pageTotal && $.isNumeric(pageTotal)) {
                        pageTotal = pageTotal;

                    } else {
                        pageTotal = pageTotal.toFixed(2);/* float */

                    }
                    $(api.column(cols[x]).footer()).html(pageTotal);
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
    function fnExcelReport1()
    {
        /* var tab_text = "<table border='5px'><tr width='100px' bgcolor='#87AFC6'>";
         var textRange;
         var j = 0;
         tab = document.getElementById('myTable'); // id of table
         for (j = 0; j < tab.rows.length; j++)
         {
         tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
         //tab_text=tab_text+"</tr>";
         }
         tab_text = tab_text + "</table>";
         tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
         tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
         tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
         var ua = window.navigator.userAgent;
         var msie = ua.indexOf("MSIE ");
         if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
         {
         txtArea1.document.open("txt/html", "replace");
         txtArea1.document.write(tab_text);
         txtArea1.document.close();
         txtArea1.focus();
         sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
         } else                 //other browser not tested on IE 11
         sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
         return (sa);*/

        var tab_text = "<table id='custom_export' border='5px'><tr width='100px' bgcolor='#87AFC6'>";
        var textRange;
        var j = 0;
        tab = document.getElementById('myTable'); // id of table
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
            name: "Profit and Loss Report",
            filename: "Profit and Loss Report",
            fileext: ".xls",
            exclude_img: false,
            exclude_links: false,
            exclude_inputs: false
        });
    }
    $('#excel-prt').on('click', function ()
    {
        var arr = [];
        arr.push({'from_date': $('#from_date').val()});
        arr.push({'to_date': $('#to_date').val()});
        var arrStr = JSON.stringify(arr);
        window.location.replace('<?php echo $this->config->item('base_url') . 'report/profit_excel_report?search=' ?>' + arrStr);
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