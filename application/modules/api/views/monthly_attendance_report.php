<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<style type="text/css">
    table {border-collapse:collapse; width:100%; font-size:8px }
    table.invoice-detail tr th{ text-align:center; border:1px solid #000; padding:2px; vertical-align:middle;}
    table.invoice-detail tr td { text-align:center; border:1px solid #000; padding:2px; vertical-align:middle;}
    .pdf-f{font-weight:bold}
    table.invoice-detail tbody tr td:nth-child(even){ background:#e1e1e1}
    table.ptable {border:0px solid #000;}
    table.ptable tr {border:0px solid #000;}
    .ptable { margin-bottom:0px;}
    .ptable tr td { padding:2px;}
    table.invoice-detail tfoot tr td.bor-tb0 { border-top:none !important; border-bottom:none !important;}
    .print_header_tit p { text-align:left; font-size:8px;}
</style>
<h4 style='margin-left: 270px'>Attendance Report-

    <?php
    if (isset($monthly_users_details) && !empty($monthly_users_details)) {
        ?>
        <?php
        $created = date('Y-m-d');
        echo (date('M-Y', strtotime($created)));
        ?>
        <?php
    }
    ?>

</h4>

<?php
if (isset($monthly_users_details) && !empty($monthly_users_details)) {
    ?>

    <h5>Employee Name : <?php echo $monthly_users_details['user_name']; ?></h5>
    <h5>Department : <?php echo $monthly_users_details['department']; ?></h5>
    <h5>Designation : <?php echo $monthly_users_details['designation']; ?></h5>

    <?php
}
?>



<table class="invoice-detail" style="padding: 2px 2px;" row-style="page-break-inside:avoid;">

    <tr align="center">
        <td width="15%" style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">S.NO</td>
        <td width="15%" style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">Date</td>
        <td width="15%" style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">Day</td>
        <td width="15%" style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">In time-Out time</td>
<!--        <td style="border:1px solid #CCC; font-weight:bold; background-color:#39F; color:white;">In Time</td>
        <td style="border:1px solid #CCC; font-weight:bold; background-color:#39F; color:white;">Out Time</td>-->
        <td width="15%" style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">Break/Lunch</td>
        <td width="15%" style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">Over Time</td>
        <td width="15%" style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">Total Hours</td>
    </tr>
    <tbody>
        <?php
        $i = 1;
        if (isset($monthly_users_details) && !empty($monthly_users_details)) {
            foreach ($monthly_users_details['date'] as $vals) {
                ?>
                <tr>
                    <td width="15%" align="center">
                        <?php echo $i; ?>
                    </td>
                    <td width="15%" align="center">
                        <?php echo $vals['Date']; ?>
                    </td>
                    <td width="15%" align="center">
                        <?php
                        $datetime = DateTime::createFromFormat('Y-m-d', $vals['Date']);
                        echo $datetime->format('D');
                        ?>
                    </td>
                    <td width="15%" align="center">
                        <?php echo $vals['In_time'] . "-" . " " . $vals['Out_time']; ?>
                    </td>
                    <td width="15%"align="center">
                        <?php
                        if (isset($vals['break']) && !empty($vals['break'])) {
                            foreach ($vals['break'] as $breakdata) {
                                echo $breakdata['out_time'] . "-" . " " . $breakdata['in_time'];
                            }
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                    <td width="15%" align="center">

                        <?php
                        $time = "";
                        $time_diff = $vals['Out_time'] - $vals['In_time'];
                        if ($time_diff >= 9) {
                            $time = $time_diff - 8;
                            $time = $time . ":00:00";
                        }

                        echo $time;
                        ?>
                    </td>
                    <td width="15%" align="center">
                        <?php
                        $time = "";
                        $time_diff = $vals['Out_time'] - $vals['In_time'];
                        if ($time_diff != 0) {
                            $time = $time_diff;
                            $time = $time . ":00:00";
                        }
                        echo $time;
                        ?>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>


