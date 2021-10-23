<?php
if (isset($quotation) && !empty($quotation)) {
    $i = 1;
    $cgst = 0;
    $sgst = 0;
    foreach ($quotation as $val) {

        $net_total = $val['net_total'];
        if ($val['advance'] != '') {
            $net_total = $val['net_total'] - $val['advance'];
        }
        $invoice_total = $val['subtotal_qty'] + $val['transport'] + $val['labour'];
        ?>
        <tr>
            <td class='first_td action-btn-align'><?php echo $i; ?></td>

            <td><?php echo ($val['store_name']) ? $val['store_name'] : $val['name']; ?></td>

            <td><?php echo $val['inv_id']; ?></td>
            <td class="action-btn-align"><?php echo ($val['created_date'] != '' && $val['created_date'] != '0000-00-00') ? date('d-M-Y', strtotime($val['created_date'])) : '-'; ?></td>

            <td class="text_right"><?php echo ($val['net_total'] > 0) ? number_format($net_total, 2) : '0'; ?></td>
            <td class="text_right"><?php echo number_format($val['return_amount'], 2); ?></td>
            <td class="text_right"><?php echo number_format($val['payable_amt'], 2); ?></td>
            <td class="text_right"><?php echo $val['commission_rate']; ?></td>

            <?php if (isset($val['or_amount']) && !empty($val['or_amount'])) { ?>

                <td style="text-align: right;"><?php
                    if (isset($val['or_amount']) && !empty($val['or_amount'])) {
                        $j = 0;
                        $cgst = 0;
                        $sgst = 0;
                        $p = 0;
                        foreach ($val['or_amount'] as $vals) {

                            $p1 = $vals['cost_price'] * $vals['quantity'];

                            $cgst1 = ($vals['tax'] / 100 ) * ($vals['cost_price'] * $vals['quantity']);

                            $gst_type = $quotation[0]['state_id'];
                            if ($gst_type != '') {
                                if ($gst_type == 31) {

                                    $sgst1 = ($vals['gst'] / 100 ) * ($vals['cost_price'] * $vals['quantity']);
                                } else {
                                    $sgst1 = ($vals['igst'] / 100 ) * ($vals['cost_price'] * $vals['quantity']);
                                }
                            }
                            $cgst += $cgst1;
                            $sgst += $sgst1;
                            $p += $p1;
                        }
                        $j++;
                    }

                    $org_price = (($p + $cgst + $sgst + $val['transport'] + $val['labour']));

                    echo ($p) ? number_format($p, 2) : $val['payable_amt'];
                    ?></td>
                <td style="text-align: right;"><?php
                    $price = (($invoice_total - $val['commission_rate']) - $p) / $invoice_total;
                    $profit_per = $price * 100;
                    echo ($profit_per > 0 && !empty($p)) ? number_format($profit_per) . '%' : '0' . '%';
                    ?>
                </td>
                <td style="text-align: right;"><?php
                    $total_cost_price = number_format((($invoice_total - $val['commission_rate']) - $p), 2, '.', ',');

                    echo ($total_cost_price > 0 && !empty($p) ) ? $total_cost_price : '0';
                    ?></td>

            <?php } else {
                ?>
                <td></td>
                <td></td>
                <td></td>
                <?php
            }
            $i++;
        }
    }
    ?>

