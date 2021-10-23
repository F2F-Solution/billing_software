<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<style>
    .st{
        /*float: left;*/
        width: 82.1px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>th,
    .table>thead:first-child>tr:first-child>th, .table>caption+thead>tr:first-child>td,
    .table>colgroup+thead>tr:first-child>td, .table>thead:first-child>tr:first-child>td
    {
        padding: 5px;
    }
    #chartdiv {
        width: 100%;
        height: 288px;
    }
    td a { border: none !important; }
    td a:hover { border: none !important; }
</style>
<div class="mainpanel">
    <div class="media">
        <h4 class="com-left">Attendance Dashboard</h4>
        <?php
        $user_info = $this->user_info = $this->session->userdata('user_info');
        if (($user_info[0]['role'] != 1)) {

        } else {
            $amount = $this->admin_model->get_company_amount();
            ?>
            <h4 class="com-align">Company Amount: <?php echo number_format($amount[0]['value']); ?></h4>
        <?php }
        ?>
    </div>

    <?php
    //chart--1
    $this->load->model('admin/admin_model');
    $data = $this->admin_model->get_qty_chart();
    $monthslist = array('1.0' => 'Jan', '2.0' => 'Feb', '3.0' => 'Mar', '4.0' => 'Apr', '5.0' => 'May', '6.0' => 'Jun', '7.0' => 'Jul', '8.0' => 'Aug', '9.0' => 'Sept', '10.0' => 'Oct', '11.0' => 'Nov', '12.0' => 'Dec');
    $po_data = '';
    if (isset($data) && !empty($data)) {
        $po_data = $po_data . '[';
        foreach ($data as $key => $val) {
            $po_data = $po_data . '[' . $key . ', ' . $val . ']';
            if ($key != 12)
                $po_data = $po_data . ',';
        }
        $po_data = $po_data . ']';
    }else {
        $po_data = '[[1, 0], [2, 0], [3,0], [4, 0], [5, 0], [6, 0], [7, 0], [8, 0], [9, 0], [10, 0], [11, 0], [12, 0]]';
    }
    ?>
    <div class="row dash-icons">
        <div class="col-md-2">
<!--            <a href="<?php // echo $this->config->item('base_url') . 'masters/biometric/departments'    ?>">-->
            <a href="<?php echo $this->config->item('base_url') . 'department' ?>">
                <div class="dashboard-icons orange-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/11.png" />
                    <div>Departments</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
<!--            <a href="<?php // echo $this->config->item('base_url') . 'masters/biometric/designations'   ?>">-->
            <a href="<?php echo $this->config->item('base_url') . 'designation' ?>">
                <div class="dashboard-icons red-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/12.png" />
                    <div>Designation</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
<!--            <a href="<?php // echo $this->config->item('base_url') . 'masters/biometric/public_holidays'  ?>">-->
            <a href="<?php echo $this->config->item('base_url') . 'public_holiday' ?>">
                <div class="dashboard-icons blue-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/13.png" />
                    <div>Public Holidays</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo $this->config->item('base_url') . 'masters/biometric/employees' ?>">
                <div class="dashboard-icons pink-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/14.png" />
                    <div>Employees</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo $this->config->item('base_url') . 'masters/biometric/shifts' ?>">
                <div class="dashboard-icons green-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/15.png" />
                    <div>Shifts</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo $this->config->item('base_url') . 'attendance/monthly_attendance' ?>">
                <div class="dashboard-icons gray-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/16.png" />
                    <div>Add Monthly Attendance</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo $this->config->item('base_url') . 'attendance/daily_attendance' ?>">
                <div class="dashboard-icons dark-blue-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/17.png" />
                    <div>Add Daily Attendance</div>
                </div>
            </a>
        </div>
        <!--  <div class="col-md-2">
              <a href="<?php echo $this->config->item('base_url') . 'attendance/reports/attendance_reports/' ?>">
                  <div class="dashboard-icons yellow-bg hvr-ripple-out">
                      <img src="<?= $theme_path; ?>/images/icons/18.png" />
                      <div>Monthly Report</div>
                  </div>
              </a>
          </div>-->
        <div class="col-md-2">
            <a href="<?php echo $this->config->item('base_url') . 'attendance/reports/monthly_reports/' ?>">
                <div class="dashboard-icons yellow-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/18.png" />
                    <div>Monthly Report</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo $this->config->item('base_url') . 'attendance/daily_reports/' ?>">
                <div class="dashboard-icons purple-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/19.png" />
                    <div>Daily Report</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo $this->config->item('base_url') . 'attendance/late_coming_attendance' ?>">
                <div class="dashboard-icons tin-blue-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/20.png" />
                    <div>Late Coming Report</div>
                </div>
            </a>
        </div>
        <!--</div>
    <div class="row dash-icons">	-->
        <div class="col-md-2">
            <a href="<?php echo $this->config->item('base_url') . 'attendance/early_going_attendance' ?>">
                <div class="dashboard-icons tin-blue-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/21.png" />
                    <div>Early Going Report</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo $this->config->item('base_url') . 'attendance/reports/overtime_report' ?>">
                <div class="dashboard-icons tin-blue-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/22.png" />
                    <div>Over Time Report</div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="<?php echo $this->config->item('base_url') . 'masters/biometric/settings' ?>">
                <div class="dashboard-icons tin-blue-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/23.png" />
                    <div>Settings</div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="<?php echo $this->config->item('base_url') . 'attendance/data_migration' ?>">
                <div class="dashboard-icons tin-blue-bg hvr-ripple-out">
                    <img src="<?= $theme_path; ?>/images/icons/23.png" />
                    <div>Data Migration</div>
                </div>
            </a>
        </div>

    </div>
    <div class="contentpanel panel-body pb-0">
        <div class="row row-stat">
            <div class="col-md-12">
                <div class="mdiv1">
                    <div class="pull-left">
                        <div class="header-sale">
                            <a href="#" class="btn btn-success btn-group">Today Sales : <i class="fa fa-inr"></i> <span><?php echo ($total_sales != 0) ? $total_sales : '0.00'; ?></span></a>
                        </div>
                    </div>
                    <div class="pull-left">
                        <div class="header-sale">
                            <a href="#" class="btn btn-danger1 btn-group">Today Purchase  : <i class="fa fa-inr"></i> <span><?php echo ($total_purchases != 0) ? $total_purchases : '0.00'; ?></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <!--            <div class="col-md-4">
                            <div class="panel panel-success-alt noborder">
                                <div class="panel-heading noborder">
                                    <div class="panel-btns">
                                        <a href="#" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                    </div> panel-btns

                                    <div class="media-body1">
                                        <h5 class="md-title nomargin">Pending Enquiry</h5>
                                    </div> media-body
                                    <hr>
                                    <div class="clearfix mt20">
                                        <table class="table table-bordered">
                                            <thead>
                                            <th class="qty_align">Enquiry#</th>
                                            <th class="qty_align">Customer</th>
                                            <th class="qty_align">Date</th>
                                            </thead>
                                            <tbody>

            <?php
            if (isset($report['enquiry']) && !empty($report['enquiry'])) {
                foreach ($report['enquiry'] as $enquiry) {
                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td class="qty_align"><?php echo $enquiry['enquiry_no']; ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td class="qty_align"><?php echo $enquiry['customer_name']; ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <td class="qty_align"><?php echo date('d-M-Y', strtotime($enquiry['created_date'])); ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="3">No pending Enquiry</td></tr>';
            }
            ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div> panel-body
                            </div> panel
                        </div> col-md-4 -->
            <?php
            $data['invoice'] = $this->admin_model->get_firm_based_pending_invoice();
            //echo '<pre>';
            //print_r($data['invoice']);
            // exit;
            ?>

            <h5 style="text-align:center;color: #1e9ff2;"><b>TODAY ATTENDANCE LIST - <?php echo date('d/m/Y'); ?></b></h5>
            <div class="col-md-4">
                <div class="panel panel-primary noborder">
                    <div class="panel-heading  panel-back  noborder">

                        <div class="media-body1"><br />
                            <h5 class="md-title nomargin" style="color: #1e9ff2;">ABSENTEES lIST</h5>                        </div><!--<media-body >-->
                        <hr>
                        <div class="clearfix mt20">
                            <div id="parent">
                                <table class="table table-bordered fixTable margin0">

                                    <thead>
                                    <th class="qty_align">Name</th>
                                    </thead>
                                    <tbody>
                                        <?php
//                                        if (isset($data['invoice']) && !empty($data['invoice'])) {
//                                            foreach ($data['invoice'] as $receipt) {
//
                                        ?>
                                        <?php
                                        if (count($data_exists) > 0) {
                                            if (isset($absentees_users_data) && !empty($absentees_users_data)) {

                                                foreach ($absentees_users_data as $key => $list) {
                                                    ?>
                                                    <tr>
                                                        <td class="qty_align"><?php echo ucwords($list['username']); ?></td>
                                                    </tr>

                                                    <?php
                                                }
                                            } else {
                                                echo '<tr><td class="qty_align">No records found</td></tr>';
                                            }
                                        } else {
                                            echo '<tr><td class="qty_align">No Data found</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!--            <?php
            $data['today_po'] = $this->admin_model->get_cash_credit_po();
            $data['today_sales'] = $this->admin_model->get_cash_credit_sales();
            ?>
                        <div class="col-md-3">
                            <div class="panel panel-dark noborder">
                                <div class="panel-heading panel-red noborder">
                                    <div class="media-body1">
                                        <h5 class="md-title nomargin">Today's Purchase</h5>
                                    </div> media-body
                                    <hr>
                                    <div class="clearfix mt20">
                                        <div id="">
                                            <table class="table table-bordered margin0">
                                                <thead>
                                                    <tr>
                                                        <th align="left" style="text-align:left">Firm Name</th>
                                                        <th align="center" style="text-align:center">Cash</th>
                                                        <th align="center" style="text-align:center">Credit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
            <?php
            if (!empty($data['today_po'])) {
                foreach ($data['today_po'] as $val) {
                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td align="left"><?php echo $val['firm_name']; ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td align="center"><?php echo ($val['po_cash'][0]['po_cash'] != '') ? number_format($val['po_cash'][0]['po_cash'], 2) : '0.00'; ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td align="center"><?php echo ($val['po_credit'][0]['po_credit'] != 0) ? number_format($val['po_credit'][0]['po_credit'], 2) : '0.00'; ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </tr>
                    <?php
                }
            }
            ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-dark noborder">
                                <div class="panel-heading panel-red noborder">
                                    <div class="media-body1">
                                        <h5 class="md-title nomargin">Today's Sale</h5>
                                    </div> media-body
                                    <hr>
                                    <div class="clearfix mt20">
                                        <div id="">
                                            <table class="table table-bordered margin0">
                                                <thead>
                                                    <tr>
                                                        <th align="left" style="text-align:left">Firm Name</th>
                                                        <th align="center" style="text-align:center">Cash</th>
                                                        <th align="center" style="text-align:center">Credit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
            <?php
            if (!empty($data['today_sales'])) {
                foreach ($data['today_sales'] as $val) {
                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td align="left"><?php echo $val['firm_name']; ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td align="center"><?php echo ($val['inv_cash'][0]['inv_cash'] != '') ? number_format($val['inv_cash'][0]['inv_cash'], 2) : '0.00'; ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td align="center"><?php echo ($val['inv_credit'][0]['inv_credit'] != 0) ? number_format($val['inv_credit'][0]['inv_credit'], 2) : '0.00'; ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </tr>
                    <?php
                }
            }
            ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div> panel-body
                            </div>
                        </div>-->
            <!--<div class="clearfix"></div>-->

            <div class="col-md-4">
                <div class="panel panel-dark noborder">
                    <div class="panel-heading panel-red noborder">
                        <div class="media-body1"><br />
                            <h5 class="md-title nomargin" style="color: #1e9ff2;">LATE COMMERS LIST</h5>
                        </div><!-- media-body >-->
                        <hr>
                        <div class="clearfix mt20">
                            <div id="parent">
                                <table class="table table-bordered fixTable margin0">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="st qty_align">Name</th>
                                            <th colspan="2" class="st qty_align">ForeNoon</th>
                                            <th colspan="2" class="st qty_align">AfterNoon</th>
                                        </tr>
                                        <tr>
                                            <th>In-Time</th>
                                            <th>LateBy</th>
                                            <th>In-Time</th>
                                            <th>LateBy</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
//                                        if (isset($report['stock']) && !empty($report['stock'])) {
//                                            foreach ($report['stock'] as $stock) {
                                        ?>
                                        <?php
                                        if (isset($late_users_data) && !empty($late_users_data)) {

                                            foreach ($late_users_data as $key => $late_list) {
                                                ?>
                                                <tr>
                                                    <td class="st qty_align"><?php echo ucwords($late_list['username']); ?></td>
                                                    <td class="st qty_align"><?php echo $late_list['mor_in']; ?></td>
                                                    <td class="st qty_align"><?php echo $late_list['fn_late_by']; ?></td>
                                                    <td class="st qty_align"><?php echo $late_list['aftnun_in']; ?></td>
                                                    <td class="st qty_align"><?php echo $late_list['an_late_by']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo '<tr><td class="st qty_align" colspan="5">No records found</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-4
            <?php //}          ?>

            <?php //if (($user_info[0]['role'] == 1) || ($user_info[0]['role'] == 2)) {            ?>


            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body padding15">
                        <h5 class="md-title">Invoice Vs Month</h5>
                        <div id="basicFlotLegend" class="flotLegend"></div>
                        <div id="basicflot" class="flotChart"></div>
                    </div><!-- panel-body -->

            <div class="col-md-4">
                <div class="panel panel-primary noborder">
                    <div class="panel-heading  panel-back  noborder">

                        <div class="media-body1"><br />
                            <h5 class="md-title nomargin" style="color: #1e9ff2;">EARLY GOING LIST</h5>
                        </div><!--<media-body >-->
                        <hr>
                        <div class="clearfix mt20">
                            <div id="parent">
                                <table class="table table-bordered fixTable margin0">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="st qty_align">Name</th>
                                            <th colspan="2" class="st qty_align">ForeNoon</th>
                                            <th colspan="2" class="st qty_align">AfterNoon</th>
                                        </tr>
                                        <tr>
                                            <th>Out-Time</th>
                                            <th>EarlyGoing</th>
                                            <th>Out-Time</th>
                                            <th>EarlyGoing</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
//                                        if (isset($report['stock']) && !empty($report['stock'])) {
//                                            foreach ($report['stock'] as $stock) {
                                        ?>
                                        <?php
                                        if (isset($early_going_users_data) && !empty($early_going_users_data)) {

                                            foreach ($early_going_users_data as $key => $early_going_list) {
                                                ?>
                                                <tr>
                                                    <td class="st qty_align"><?php echo ucwords($early_going_list['username']); ?></td>
                                                    <td class="st qty_align"><?php echo $early_going_list['mor_out']; ?></td>
                                                    <td class="st qty_align"><?php echo $early_going_list['fn_early_going']; ?></td>
                                                    <td class="st qty_align"><?php echo $early_going_list['aftnun_out']; ?></td>
                                                    <td class="st qty_align"><?php echo $early_going_list['an_early_going']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo '<tr><td class="st qty_align" colspan="5">No records found</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div><!-- panel -->
    </div>
    <!--                <div class="col-md-6">
                            <div class="panel panel-default">
                            <div id="chartdiv"></div>
                        </div>
                    </div>-->


</div><!-- row

<div id="invoice_pen" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
    <div class="modal-dialog">
        <div class="modal-content modalcontent-top">
            <div class="modal-header modal-padding modalcolor"> <a class="close modal-close closecolor" data-dismiss="modal">�</a>
                <h3 id="myModalLabel" class="inactivepop">Invoice Details</h3>
            </div>
            <div id="cust_change">

            </div>
            <div class="modal-footer action-btn-align">
                <button type="button" class="btn btn-danger1 delete_all"  data-dismiss="modal" id="no">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php // }
?>
<!-- row

</div>--><!-- contentpanel -->

</div><!-- mainpanel -->





<!-- Resources -->
<link rel="stylesheet" href="<?= $theme_path; ?>/css/chart/export.css" type="text/css" />
<script src="<?= $theme_path; ?>/js/chart/amcharts.js"></script>
<script src="<?= $theme_path; ?>/js/chart/pie.js"></script>
<script src="<?= $theme_path; ?>/js/chart/export.min.js"></script>
<script src="<?= $theme_path; ?>/js/chart/light.js"></script>
<!-- Chart code -->
<script>
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "pie",
        "theme": "light",
        "dataProvider": [{
                "country": "CROMPTON",
                "litres": 20
            }, {
                "country": "HAVELLS FUSION",
                "litres": 4
            }, {
                "country": "ORIENT",
                "litres": 25
            }, {
                "country": "HAVELLS",
                "litres": 7
            }, {
                "country": "OTHERS",
                "litres": 1
            }],
        "valueField": "litres",
        "titleField": "country",
        "balloon": {
            "fixedPosition": true
        },
        "export": {
            "enabled": true
        }
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        "use strict";

        function showTooltip(x, y, contents) {
            var final_text = '';
            var qty = 0;
            var qty_val = 0;
            var qty_arr = contents.split(" ");

            qty = Math.round(qty_arr[2]);
            qty_val = Math.round(qty_arr[5]);

            if (qty_val == '')
            {
                qty_val = 0;
            }


            jQuery('<div id="tooltip" class="tooltipflot">Invoice Amount:Rs ' + qty_val + ' /-</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5
            }).appendTo("body").fadeIn(200);
        }

        /*****SIMPLE CHART*****/

        var newCust =<?= $po_data ?>;

        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var plot = jQuery.plot(jQuery("#basicflot"),
                [{
                        data: newCust,
                        label: "Invoice Amount",
                        color: "#03c3c4"
                    }
                ],
                {
                    series: {
                        lines: {
                            show: false

                        },
                        splines: {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            fill: 0.4
                        },
                        shadowSize: 0
                    },
                    points: {
                        show: true,
                    },
                    legend: {
                        container: '#basicFlotLegend',
                        noColumns: 0
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        borderColor: '#ddd',
                        borderWidth: 0,
                        labelMargin: 5,
                        backgroundColor: '#fff'
                    },
                    yaxis: {
                        min: 0,
                        color: '#eee'
                    },
                    xaxis: {
                        color: '#eee',
                        ticks: [[1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']]
                    }
                });

        var previousPoint = null;
        jQuery("#basicflot").bind("plothover", function (event, pos, item) {
            jQuery("#x").text(pos.x.toFixed(2));
            jQuery("#y").text(pos.y.toFixed(2));

            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    jQuery("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                            y = item.datapoint[1].toFixed(2);

                    showTooltip(item.pageX, item.pageY,
                            item.series.label + " of " + x + " = " + y);
                }

            } else {
                jQuery("#tooltip").remove();
                previousPoint = null;
            }

        });

        jQuery("#basicflot").bind("plotclick", function (event, pos, item) {
            if (item) {
                plot.highlight(item.series, item.datapoint);
            }
        });




        /*var previousPoint = null;
         jQuery("#basicflot2").bind("plothover", function (event, pos, item) {
         jQuery("#x").text(pos.x.toFixed(2));
         jQuery("#y").text(pos.y.toFixed(2));

         if (item) {
         if (previousPoint != item.dataIndex) {
         previousPoint = item.dataIndex;

         jQuery("#tooltip").remove();
         var x = item.datapoint[0].toFixed(2),
         y = item.datapoint[1].toFixed(2);

         showTooltip(item.pageX, item.pageY,
         item.series.label + " of " + x + " = " + y);
         }

         } else {
         jQuery("#tooltip").remove();
         previousPoint = null;
         }

         });

         jQuery("#basicflot2").bind("plotclick", function (event, pos, item) {
         if (item) {
         plot.highlight(item.series, item.datapoint);
         }
         });




         var previousPoint = null;
         jQuery("#basicflot3").bind("plothover", function (event, pos, item) {
         jQuery("#x").text(pos.x.toFixed(2));
         jQuery("#y").text(pos.y.toFixed(2));

         if (item) {
         if (previousPoint != item.dataIndex) {
         previousPoint = item.dataIndex;

         jQuery("#tooltip").remove();
         var x = item.datapoint[0].toFixed(2),
         y = item.datapoint[1].toFixed(2);

         showTooltip(item.pageX, item.pageY,
         item.series.label + " of " + x + " = " + y);
         }

         } else {
         jQuery("#tooltip").remove();
         previousPoint = null;
         }

         });

         jQuery("#basicflot3").bind("plotclick", function (event, pos, item) {
         if (item) {
         plot.highlight(item.series, item.datapoint);
         }
         });


         jQuery('#sparkline').sparkline([4, 3, 3, 1, 4, 3, 2, 2, 3, 10, 9, 6], {
         type: 'bar',
         height: '30px',
         barColor: '#428BCA'
         });

         jQuery('#sparkline2').sparkline([9, 8, 8, 6, 9, 10, 6, 5, 6, 3, 4, 2], {
         type: 'bar',
         height: '30px',
         barColor: '#999'
         });

         jQuery('#sparkline3').sparkline([4, 3, 3, 1, 4, 3, 2, 2, 3, 10, 9, 6], {
         type: 'bar',
         height: '30px',
         barColor: '#428BCA'
         });

         jQuery('#sparkline4').sparkline([9, 8, 8, 6, 9, 10, 6, 5, 6, 3, 4, 2], {
         type: 'bar',
         height: '30px',
         barColor: '#999'
         });

         jQuery('#sparkline5').sparkline([4, 3, 3, 1, 4, 3, 2, 2, 3, 10, 9, 6], {
         type: 'bar',
         height: '30px',
         barColor: '#428BCA'
         });

         jQuery('#sparkline6').sparkline([9, 8, 8, 6, 9, 10, 6, 5, 6, 3, 4, 2], {
         type: 'bar',
         height: '30px',
         barColor: '#999'
         });
         */

        /***** BAR CHART *****/

        /*var m3 = new Morris.Bar({
         // ID of the element in which to draw the chart.
         element: 'bar-chart',
         // Chart data records -- each entry in this array corresponds to a point on
         // the chart.
         data: [
         {y: '2006', a: 30, b: 20},
         {y: '2007', a: 75, b: 65},
         {y: '2008', a: 50, b: 40},
         {y: '2009', a: 75, b: 65},
         {y: '2010', a: 50, b: 40},
         {y: '2011', a: 75, b: 65},
         {y: '2012', a: 100, b: 90}
         ],
         xkey: 'y',
         ykeys: ['a', 'b'],
         labels: ['Series A', 'Series B'],
         lineWidth: '1px',
         fillOpacity: 0.8,
         smooth: false,
         hideHover: true,
         resize: true
         });

         var delay = (function () {
         var timer = 0;
         return function (callback, ms) {
         clearTimeout(timer);
         timer = setTimeout(callback, ms);
         };
         })();

         jQuery(window).resize(function () {
         delay(function () {
         m3.redraw();
         }, 200);
         }).trigger('resize'); */


        // This will empty first option in select to enable placeholder
        jQuery('select option:first-child').text('');

        // Select2
        jQuery("select").select2({
            minimumResultsForSearch: -1
        });

        // Basic Wizard
        jQuery('#basicWizard').bootstrapWizard({
            onTabShow: function (tab, navigation, index) {
                tab.prevAll().addClass('done');
                tab.nextAll().removeClass('done');
                tab.removeClass('done');

                var $total = navigation.find('li').length;
                var $current = index + 1;

                if ($current >= $total) {
                    $('#basicWizard').find('.wizard .next').addClass('hide');
                    $('#basicWizard').find('.wizard .finish').removeClass('hide');
                } else {
                    $('#basicWizard').find('.wizard .next').removeClass('hide');
                    $('#basicWizard').find('.wizard .finish').addClass('hide');
                }
            }
        });

        // This will submit the basicWizard form
        jQuery('.panel-wizard').submit(function () {
            alert('This will submit the form wizard');
            return false // remove this to submit to specified action url
        });

    });
</script>
<script src="<?= $theme_path; ?>/js/jquery-2.1.3.js"></script>
<script src="<?= $theme_path; ?>/js/tableHeadFixer.js"></script>
<script>
    function invoiceDetails(val)
    {

        $.ajax({
            type: 'POST',
            data: {customer: val},
            url: '<?php echo base_url(); ?>admin/get_customer_by_invoice/' + val,
            cache: false,
            success: function (data) {
                $('#cust_change').html('');
                $('#cust_change').html(data);
                $('.modal').css("display", "block");
                $('.fade').css("display", "block");
            }
        });

    }
    $(document).ready(function () {
        // $('#invoice_pen').modal('show');
        $(".fixTable").tableHeadFixer();
    });
</script>
<style>
    /*#parent {height: 244px;	}*/
    table.fixTable { border-top: none;}
</style>