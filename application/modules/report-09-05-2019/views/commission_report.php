<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />

<div class="mainpanel">
    <div class="media mt--20">
        <h4>Commission Report </h4>
    </div>
    <div class="contentpanel mb-45">

        <table class="table table-striped table-bordered responsive no-footer dtr-inline search_table_hide" style="display:none;">
            <tr>
            </tr>
        </table>
        <div id='result_div' class="panel-body">
            <table id="basicTable_call_back" class="table table-striped table-bordered responsive dataTable no-footer dtr-inline">
                <thead>
                    <tr>
                        <td class="action-btn-align">S.No</td>
                        <td class='action-btn-align'>Invoice #</td>
                        <td class="action-btn-align">Customer Name</td>
                        <td class="action-btn-align">Invoice Amount</td>
                        <td >Balance</td>
                        <td >Invoice Date</td>
                        <td >Reference</td>
                        <td >Commission Rate</td>
                        <td >Commission Pay</td>
                        <td >Commission Status</td>
                        <td >Action</td>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>

    </div><!-- contentpanel -->

</div><!-- mainpanel -->
<script>
    $(document).ready(function () {

        var table;
        table = jQuery('#basicTable_call_back').DataTable({
            "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "retrieve": true,
            "order": [], //Initial no order.
            //dom: 'Bfrtip',
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('report/commission_report_ajaxList/'); ?>",
                "type": "POST",
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0, 11], //first column / numbering column
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
                var cols = [3, 4, 7, 8];
                for (x in cols) {
                    total = api.column(cols[x]).data().reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    console.log("success : " + total);

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

    });
</script>
<script src="<?= $theme_path; ?>/js/fixedheader/jquery.dataTables.min.js"></script>