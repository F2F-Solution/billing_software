<div class="result_div">
    <table id="basicTable_call_back" class="table table-striped table-bordered responsive no-footer dtr-inline totlqua-cntr cgst2-right
           sgst2-right subtotal1-right invamountgst-right customergstn-cntr">
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
                <th class="action-btn-align">CGST %</th>
                <th class="action-btn-align  proimg-wid" >SGST%</th>
                <th class="action-btn-align " >Subtotal</th>
                <th class="action-btn-align">Return Amt</th>
                <th class="action-btn-align">Balance Amt</th>
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
                ?>
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
            <td class="text_right total-bg"></td>
            <td class="text_right total-bg"></td>
            <td class="text_right total-bg"></td>
            <td></td>
            </tfoot>
            <?php
        } else {
            ?>
            <tr><td colspan="12">No Data Found.</td></tr>
            <?php
        }
        ?>
        </tbody>

    </table>
</div>