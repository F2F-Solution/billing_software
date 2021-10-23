<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<style type="text/css">
    table {border-collapse:collapse; width:100%; font-size:8px }
    table.invoice-detail tr th{ text-align:center; border:0px solid #000; padding:2px; vertical-align:middle;}
    table.invoice-detail tr td { text-align:center; border:0px solid #000; padding:2px; vertical-align:middle;}
    .pdf-f{font-weight:bold}
    table.invoice-detail tbody tr td:nth-child(even){ background:#e1e1e1}
    table.ptable {border:0px solid #000;}
    table.ptable tr {border:0px solid #000;}
    .ptable { margin-bottom:0px;}
    .ptable tr td { padding:2px;}
    table.invoice-detail tfoot tr td.bor-tb0 { border-top:none !important; border-bottom:none !important;}
    .print_header_tit p { text-align:left; font-size:8px;}
</style>
<h4>Employee attendance details</h4>
<table class="invoice-detail" style="padding: 2px 2px;" row-style="page-break-inside:avoid;">

    <tr align="center">
        <td style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">S.NO</td>
        <td style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">Employee id</td>
        <td style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">User name</td>
        <td style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">Employee name</td>
<!--        <td style="border:1px solid #CCC; font-weight:bold; background-color:#39F; color:white;">In Time</td>
        <td style="border:1px solid #CCC; font-weight:bold; background-color:#39F; color:white;">Out Time</td>-->
        <td style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">Department</td>
        <td style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">Designation</td>
        <td style="border:1px solid black; font-weight:bold; background-color:#39F; color:white;">Status</td>
    </tr>
    <tbody>
        <?php
        if (isset($product_details) && !empty($product_details)) {
            foreach ($product_details as $vals) {
                ?>
                <tr>
                    <td align="center" style="border:1px solid black;">
                        <?php echo $vals['id']; ?>
                    </td>
                    <td align="left" style="border:1px solid black;">
                        <?php echo $vals['employee_id'] ?>
                    </td>
                    <td align="left" style="border:1px solid black;">
                        <?php echo $vals['username'] ?>
                    </td>
                    <td align="left" style="border:1px solid black;">
                        <?php echo $vals['first_name'] ?>
                    </td>
                    <td align="left" style="border:1px solid black;">
                        <?php echo $vals['department'] ?>
                    </td>
                    <td align="left" style="border:1px solid black;">
                        <?php echo $vals['designation'] ?>
                    </td>
                    <td align="left" style="border:1px solid black;">
                        <?php
                        echo $vals['present_status']
                        ?>
                    </td>

                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>


