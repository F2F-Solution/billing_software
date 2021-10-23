<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<link href="<?php echo $theme_path; ?>/plugin/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo $theme_path; ?>/plugin/datatables/js/jquery.dataTables.min.js"></script>
<style>
    .bg-red {
        background-color: #dd4b39 !important;
    }
    .bg-green {
        background-color:#09a20e !important;
    }
    .bg-yellow
    {
        background-color:orange !important;
    }
</style>
<div class="mainpanel">
    <!--<div class="pageheader">
<div class="media">
<div class="pageicon pull-left">
    <i class="fa fa-quote-right pageheader_icon iconquo"></i>
</div>
<div class="media-body">
    <ul class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
        <li>Home</li>
    </ul>
    <h4>Quotation List</h4>
     <a href="<?php echo $this->config->item('base_url') . 'purchase_order/' ?>" class="btn btn-success right topgen adden"><span class="glyphicon glyphicon-plus"></span> Add Quotation</a>
</div>

</div>
</div>-->
    <div class="media mt--20">
        <h4>Purchase Order List
            <a href="<?php if ($this->user_auth->is_action_allowed('purchase', 'purchase_order', 'add')): ?><?php echo $this->config->item('base_url') . 'purchase_order/' ?><?php endif ?>" class="btn btn-success right topgen <?php if (!$this->user_auth->is_action_allowed('purchase', 'purchase_order', 'add')): ?>alerts<?php endif ?>"><span class="glyphicon glyphicon-plus"></span> New Purchase Request</a>
        </h4>
    </div>
    <div class="contentpanel">
        <div id='result_div' class="panel-body mt-top5 pb0">
            <div class="tabpad">
                <table id="basicTable_call_back" class="table table-striped table-bordered responsive dataTable no-footer dtr-inline">
                    <thead>
                        <tr>
                            <td class="action-btn-align">S.No</td>
                            <td class="action-btn-align">Firm</td>
                            <td class='action-btn-align'>PR No</td>
                            <td class='action-btn-align'>PO No</td>
                            <td class="action-btn-align">Supplier Name</td>
                            <td class="action-btn-align">Total Quantity</td>
                            <td class="action-btn-align">Delivery Quantity</td>
                            <td class="action-btn-align">Total Amount</td>
                            <td class='action-btn-align'>Created Date</td>
                            <td class='action-btn-align'>PR Status</td>
                            <td class='action-btn-align'>Delivery Status</td>
                            <td class="hide_class action-btn-align">Action</td>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text_right"></td>
                            <td class="text_right"></td>
                            <td class="text_right"></td>
                            <td class="text_right"></td>
                            <td class="text_right"></td>
                            <td class="action-btn-align total-bg"></td>
                            <td class="action-btn-align total-bg"></td>
                            <td class="text_right total-bg"></td>
                            <td class="text_right"></td>
                            <td class="text_right"></td>
                            <td class="text_right"></td>
                            <td class="hide_class text_right"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="action-btn-align mb-10">
                <button class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</button>
            </div>
        </div>
        <?php
        if (isset($po) && !empty($po)) {
            foreach ($po as $val) {
                ?>

                <div id="test3_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
                    <div class="modal-dialog">
                        <div class="modal-content modalcontent-top">
                            <div class="modal-header modal-padding modalcolor"> <a class="close modal-close closecolor" data-dismiss="modal">×</a>
                                <h3 id="myModalLabel" class="inactivepop">In-Active user</h3>
                            </div>
                            <div class="modal-body">
                                Do You Want In-Active This Purchase Order?<strong><?= $val['po_no']; ?></strong>
                                <input type="hidden" value="<?php echo $val['id']; ?>" class="id" />
                            </div>
                            <div class="modal-footer action-btn-align">
                                <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
                                <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no">No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<script>
    $('.print_btn').click(function () {
        window.print();
    });
</script>
</div><!-- contentpanel -->

</div><!-- mainpanel -->
<script type="text/javascript">
    $(document).on('click', '.alerts', function () {
        sweetAlert("Oops...", "This Access is blocked!", "error");
        return false;
    });
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
            success: function (result) {
                for_response();
                $('#result_div').html(result);
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function ()
    {
//        $('#basicTable_call_back').DataTable({
//            "footerCallback": function (row, data, start, end, display) {
//                var api = this.api(), data;
//
//                // Remove the formatting to get integer data for summation
//                var intVal = function (i) {
//                    return typeof i === 'string' ?
//                            i.replace(/[\$,]/g, '') * 1 :
//                            typeof i === 'number' ?
//                            i : 0;
//                };
//
//                // Total over all pages
//                var cols = [5, 6, 7];
//                for (x in cols) {
//                    total = api.column(cols[x]).data().reduce(function (a, b) {
//                        return (intVal(a) + intVal(b)).toFixed(2);
//                    }, 0);
//
//                    // Total over this page
//                    pageTotal = api.column(cols[x], {page: 'current'}).data().reduce(function (a, b) {
//                        return intVal(a) + intVal(b);
//                    }, 0);
//
//                    // Update footer
//                    $(api.column(cols[x]).footer()).html(pageTotal.toFixed(2));
//                }
//
//
//            },
//            responsive: true,
//            columnDefs: [
//                {responsivePriority: 1, targets: 0},
//                {responsivePriority: 2, targets: -2}
//            ]
//        });
        $("#yesin").live("click", function ()
        {

            var hidin = $(this).parent().parent().find('.id').val();
            // alert(hidin);
            $.ajax({
                url: BASE_URL + "purchase_order/po_delete",
                type: 'POST',
                data: {value1: hidin},
                success: function (result) {

                    window.location.reload(BASE_URL + "purchase_order/purchase_order_list");
                }
            });

        });

        $('.modal').css("display", "none");
        $('.fade').css("display", "none");

    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        var table;
        table = jQuery('#basicTable_call_back').DataTable({
            "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
            "pageLength": 50,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "retrieve": true,
            "order": [], //Initial no order.
            //dom: 'Bfrtip',
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('purchase_order/purchase_order_ajaxList/'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                    "targets": 0,
                    "searchable": false
                }],
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
                var cols = [5, 6, 7];
                for (x in cols) {
                    total = api.column(cols[x]).data().reduce(function (a, b) {
                        return (intVal(a) + intVal(b)).toFixed(2);
                    }, 0);

                    // Total over this page
                    pageTotal = api.column(cols[x], {page: 'current'}).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    // Update footer
                    $(api.column(cols[x]).footer()).html(pageTotal.toFixed(2));
                }


            },
            responsive: true,
            columnDefs: [
                {responsivePriority: 1, targets: 0},
                {responsivePriority: 2, targets: -2}
            ]
        });


    });
</script>
<script src="<?= $theme_path; ?>/js/fixedheader/jquery.dataTables.min.js"></script>