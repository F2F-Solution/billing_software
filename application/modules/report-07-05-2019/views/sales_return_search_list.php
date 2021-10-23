<div class="result_div">
    <table id="basicTable_call_back" class="table table-striped table-bordered responsive no-footer dtr-inline totlqua-cntr cgst2-right
           sgst2-right subtotal1-right invamountgst-right customergstn-cntr">
        <thead>
            <tr>
                <td class="action-btn-align">S.No</td>
                <td class="action-btn-align">Customer</td>
                <td class="action-btn-align">Invoice ID</td>
                <td class="action-btn-align">Category</td>
                <td class="action-btn-align">Product</td>
                <td class="action-btn-align">Brand</td>
                <td class="action-btn-align">Total QTY</td>
                <td class="action-btn-align">Inv Amt</td>
                <td class="action-btn-align">Return Qty</td>
                <td class="action-btn-align">Return Amt</td>
                <td class="action-btn-align">CGST %</br><span><?php echo ($search_data['gst'] && $search_data['gst'] != 'Select') ? $search_data['gst'] . '%' : ''; ?></span></td>
                <td  class="action-btn-align  proimg-wid" >SGST%</br><span><?php echo ($search_data['gst'] && $search_data['gst'] != 'Select') ? $search_data['gst'] . '%' : ''; ?></span></td>

                <td class="action-btn-align">Created Date</td>

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
                        <td><?php echo $vals['store_name']; ?> </td>
                        <td><?php echo $vals['inv_number']; ?></td>
                        <td><?php echo $vals['categoryName']; ?></td>
                        <td><?php echo $vals['product_name']; ?></td>
                        <td><?php echo $vals['brands']; ?></td>
                        <td class="text_right"><?php echo $vals['total_qty']; ?></td>
                        <td class="text_right"><?php echo $vals['net_total']; ?></td>
                        <td class="text_right"><?php echo $vals['return_qty']; ?></td>
                        <td class="text_right"><?php echo $vals['sub_total']; ?></td>
                        <td class="text_right"><?php echo $vals['gst']; ?></td>
                        <td class="text_right"><?php echo $vals['igst']; ?></td>

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