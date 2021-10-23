<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<style type="text/css">
    .text_right
    {
        text-align:right;
    }
    .box, .box-body, .content { padding:0; margin:0;border-radius: 0;}
    #top_heading_fix h3 {top: -57px;left: 6px;}
    #TB_overlay { z-index:20000 !important; }
    #TB_window { z-index:25000 !important; }
    .dialog_black{ z-index:30000 !important; }
    #boxscroll22 {max-height: 291px;overflow: auto;cursor: inherit !important;}
    .auto-asset-search ul#country-list li:hover {
        background: #c3c3c3;
        cursor: pointer;
    }
    .auto-asset-search ul#country-list li {
        background: #dadada;
        margin: 0;
        padding: 5px;
        border-bottom: 1px solid #f3f3f3;
    }
    ul li {
        list-style-type: none;
    }

    .btn-xs {
        border-radius: 0px !important;
        padding: 2px 5px 1px 5px;
    }
</style>
<div class="print_header">
    <table width="100%">
        <tr>
            <td width="15%" style="vertical-align:middle;">
                <div class="print_header_logo" ><img src="<?= $theme_path; ?>/images/logo.png" /></div>
            </td>
            <td width="85%">

                <div class="print_header_tit" >
                    <h3> <?= $this->config->item("company_name"); ?></h3>
                    <p></p>
                    <p class="pf">  <?= $company_details[0]['address'] ?>,
                    </p>
                    <p></p>
                    <p class="pf"> Pin Code : <?= $company_details[0]['pincode'] ?></p>
                    <p></p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="mainpanel">
    <div class="media mt--40 hide_class">
        <h4 class="hide_class">View Purchase Order
        </h4>
    </div>
    <div class="contentpanel enquiryview ptpb-10 viewquo mb-45 mt-top2">
        <?php
        if (isset($po) && !empty($po)) {
            foreach ($po as $val) {
                ?>
                <table class="table ptable" cellpadding="0" cellspacing="0">
                    <tr class="tbor">
                        <td>GSTIN NO : <?= $company_details[0]['gstin']; ?></td>

                        <td colspan="2" align="right">Cell : <?= $company_details[0]['mobile_number']; ?> </td>
                    </tr>
                    <tr>
                        <td><span  class="tdhead">TO,</span>
                            <div><?php echo $val['store_name']; ?></div>
                            <div><?php echo $val['address1']; ?> </div>
                            <div>Mobile : <?php echo ($val['mobil_number']) ? $val['mobil_number'] : '-'; ?></div>
                            <div>Email :  <?php echo ($val['email_id']) ? $val['email_id'] : '-'; ?></div>
                            <div>GSTIN : <?php echo ($val['tin']) ? $val['tin'] : '-'; ?></div>
                        </td>

                        <td colspan="2" align="right" style="vertical-align:top;">
                            PO NO :<?php echo $val['po_no']; ?></td>
                    </tr>
                    <tr>
                        <td>Supplier GSTIN: <?php echo $val['tin']; ?></td>
                        <td colspan="2" align="right"> Date : <?= ($val['created_date'] != '1970-01-01') ? date('d-M-Y', strtotime($val['created_date'])) : '-'; ?></td>
                    </tr>
                </table>

                <form method="post" action="<?php echo $this->config->item('base_url') . 'purchase_order/dc_edit/' . $val['id'] ?>" id="add_delivary" >
                    <input type="hidden" name="firm_id" id="firm_id" value="<?php echo $po[0]['firm_id']; ?>">
                    <input type="hidden" name="po_no" id="po_id" value="<?php echo $po[0]['po_no']; ?>">
                    <table class="table table-striped table-bordered responsive" id="add_quotation" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <td  width="2%" class="first_td1 action-btn-align ser-wid">S.No</td>
                                <td width="10%" class="first_td1">HSN Code</td>
                                <td width="10%" class="hide_class first_td1">Category</td>
                                <td width="20%" class="first_td1">Product Name</td>
                                <td width="10%" class="hide_class first_td1">Brand</td>
                                <td width="5%" class="hide_class first_td1">Unit</td>
                                <td  width="8%" class="first_td1 action-btn-align ser-wid">QTY</td>
                                <td width="8%" class="hide_class first_td1 action-btn-align ser-wid">Delivery QTY</td>
                                <td  width="8%" class="first_td1 action-btn-align ser-wid">Unit Price</td>
                                <td  width="6%" class="first_td1 action-btn-align ser-wid">Total</td>
                                <!--<td  width="7%" class="first_td1 action-btn-align proimg-wid">Discount %</td>-->
                                <td  width="5%" class="first_td1 action-btn-align proimg-wid">CGST%</td>
                                <?php
                                $gst_type = $po[0]['state_id'];
                                if ($gst_type != '') {
                                    if ($gst_type == 31) {
                                        ?>
                                        <td  width="5%" class="first_td1 action-btn-align ser-wid" >SGST%</td>
                                    <?php } else { ?>
                                        <td  width="5%" class="first_td1 action-btn-align ser-wid" >IGST%</td>

                                        <?php
                                    }
                                }
                                ?>
                                <td  width="7%" class="first_td1 action-btn-align proimg-wid">Transport</td>
                                <td  width="7%" class="first_td1 action-btn-align qty-wid">Basic Value</td>
                            </tr>
                        </thead>
                        <tbody id='app_table'>
                            <?php
                            $i = 1;
                            if (isset($po_details) && !empty($po_details)) {
                                $delivery_qty = $total_qty = 0;
                                foreach ($po_details as $vals) {
                                    $total_qty = $total_qty + $vals['quantity'];
                                    ?>
                                    <tr data-id = "<?php echo $vals['id']; ?>">
                                        <td class="action-btn-align">
                                            <?php echo $i; ?>
                                        </td>
                                        <td class="">
                                            <?php echo!empty($vals['hsn_sac_name']) ? $vals['hsn_sac_name'] : '-'; ?>
                                        </td>
                                        <td class="hide_class">
                                            <?php echo!empty($vals['categoryName']) ? $vals['categoryName'] : '-'; ?>
                                            <input type="hidden" name="po[cat_id][]" id="catg_id" value="<?php echo $vals['category']; ?>">
                                        </td>
                                        <td>
                                            <?php echo $vals['product_name']; ?>
                                            <input type="hidden" name="po[pro_id][]" id="prod_id" value="<?php echo $vals['product_id']; ?>">
                                        </td>
                                        <td class="hide_class">
                                            <?php echo!empty($vals['brands']) ? $vals['brands'] : '-' ?>
                                            <input type="hidden" name="po[brand][]" id="brand_id" value="<?php echo $vals['brand']; ?>">

                                        </td>
                                        <td class="hide_class">
                                            <?php echo!empty($vals['unit']) ? $vals['unit'] : '-' ?>
                                        </td>
                                        <td class="action-btn-align act_qty">
                                            <?php if ($val['delivery_status'] != 'delivered') { ?>
                                                <input type="checkbox"  class="delivary hide_class"  />&nbsp;&nbsp;
                                            <?php } ?>
                                            <input type="hidden" name="id[]" value=" <?php echo $vals['id']; ?>"  />
                                            <input type="hidden" name="total_qty" value=" <?php echo $val['total_qty']; ?>"  />

                                            <?php echo $vals['quantity'] ?>
                                        </td>
                                        <td class="hide_class action-btn-align del_qty">
                                            <?php
                                            echo $vals['delivery_quantity'];
                                            $delivery_qty += $vals['delivery_quantity'];
                                            ?>
                                            <input type="hidden" class="delivery_quantity" value="<?php echo $vals['delivery_quantity'] ?>"  />
                                        </td>
                                        <td class="text_right">
                                            <?php echo number_format($vals['per_cost'], 2); ?>
                                        </td>
                                        <td class="text_right">
                                            <?php echo number_format(($vals['quantity'] * $vals['per_cost']), 2) ?>
                                        </td>
                                        <!--<td class="action-btn-align">-->
                                        <?php // echo $vals['discount']  ?>
                                        <!--</td>-->
                                        <td class="action-btn-align">
                                            <?php echo $vals['tax']; ?>
                                        </td>
                                        <?php
                                        $gst_type = $po[0]['state_id'];
                                        if ($gst_type != '') {
                                            if ($gst_type == 31) {
                                                ?>
                                                <td class="action-btn-align" >
                                                    <?php echo $vals['gst']; ?>
                                                </td>
                                            <?php } else { ?>
                                                <td class="action-btn-align" >
                                                    <?php echo $vals['igst']; ?>
                                                </td>

                                                <?php
                                            }
                                        }
                                        ?>
                                        <td class="action-btn-align">
                                            <?php echo $vals['transport'] ?>
                                        </td>
                                        <td class="text_right">
                                            <?php echo number_format($vals['sub_total'], 2) ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="3" class="hide_class" style="width:70px; text-align:right;"></td>
                                <td colspan="3" style="width:70px; text-align:right;"><b>Total</b></td>
        <!--                                <td class="action-btn-align"><?php //echo $vals['total_qty'];     ?></td>-->
                                <td class="action-btn-align"><?php echo $total_qty; ?></td>
                                <td class="hide_class action-btn-align total_del_qty"><?php echo number_format($delivery_qty); ?></td>
                                <td colspan="5" style="text-align:right;"><b>Sub Total</b></td>
                                <td class="text_right"><?php echo number_format($val['subtotal_qty'], 2); ?></td>
                            </tr>
                            <tr>
                                <td colspan="4"  class="hide_class" style="width:70px; text-align:right;"></td>
                                <td colspan="9" style="text-align:right;font-weight:bold;"><?php echo $val['tax_label']; ?> </td>
                                <td class="text_right">
                                    <?php echo number_format($val['tax'], 2); ?>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4"  class="hide_class" style="width:70px; text-align:right;"></td>
                                <td colspan="9"style="text-align:right;font-weight:bold;">Net Total</td>
                                <td class="text_right"><?php echo number_format($val['net_total'], 2); ?></td>

                            </tr>
                            <tr>
                                <td colspan="15" style="">
                                    <span style="float:left;  top:12px;">Remarks&nbsp;&nbsp;&nbsp;</span>
                                    <?php echo $val['remarks']; ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="hide_class action-btn-align">

                        <a href="<?php echo $this->config->item('base_url') . 'purchase_order/purchase_order_list/' ?>"class="btn btn-defaultback"><span class="glyphicon"></span> Back </a>
                        <a class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</a>

                        <?php if ($val['delivery_status'] == 'partially_delivered' || $val['delivery_status'] == 'pending') { ?>
                            <a type="submit" class="btn btn-success" id="save_delivary"><span class="glyphicon  glyphicon-check"></span> Delivered </a>
                        <?php } ?>
                    </div>
                </form>
                <?php
            }
        }
        ?>
    </div><!-- contentpanel -->
</div><!-- mainpanel -->
<script>
    $('.print_btn').click(function () {
        window.print();
    });
    var qtys = $('.delivary').closest('tr').find('input.delivery_quantity').val();
    $('.delivary').click(function () {

        var qty = $(this).closest('tr').find('input.delivery_quantity').val();
        var po_details_id = $(this).closest('tr').attr('data-id');
        //alert(po_details_id);
        if ($(this).prop('checked') == true) {
            $(this).closest('tr').find('input.delivary').prop('checked', true);
            $(this).closest('tr').find('td.del_qty').html('<input type="hidden" class="delivery_quantity" value="' + qty + '"><span data-toggle="tooltip" class="tooltips btn btn-success btn-xs" title="">Current Quantity</span> &nbsp;<br><input type="text" style="width:70px;" class="total_delivery_quantity" readonly="readonly" value="' + Number(qty) + '""><br>+<br><span data-toggle="tooltip" class="tooltips btn btn-primary btn-xs" title="">Delivery Quantity</span> &nbsp;<br><input type="text" class="delivery_qty required" style="width:70px" value="' + Number() + '"  name="delivery_quantity_"[' + po_details_id + ']"[]"\n\
/><span class="error_msg"></span>');
        }

        if ($(this).prop('checked') == false) {
            //  var total_delivery_quantity = $(this).closest('tr').find('input.total_delivery_quantity').val();
            var delivery_quantity = $(this).closest('tr').find('input.delivery_quantity').val();
            //alert(total_delivery_quantity);
            $(this).closest('tr').find('input.delivary').prop('checked', false);
            // $(this).closest('tr').find('td.del_qty').text('');


            $(this).closest('tr').find('td.del_qty').html('<input type="hidden" class="delivery_quantity" value="' + qty + '"><input type="text" id="delivery_quantity" style="width:70px;" readonly name="delivery_quantity[]" value="' + delivery_quantity + '">');
        }
    });
    $(document).on('blur', '.delivery_qty', function () {
        var po_details_id = $(this).closest('tr').attr('data-id');
        var qty = $(this).closest('tr').find('input.delivery_quantity').val();
        var del_qty = $(this).val();
        var actual_qty = $(this).closest('tr').find('td.act_qty').text();
        var delivered_qty = $(this).closest('tr').find('input.total_delivery_quantity').val();
        var total = parseInt(del_qty) + parseInt(delivered_qty);
//        alert("actua" + actual_qty + "delivery" + delivered_qty + "total" + total);
//        return false;
        if (parseInt(total) > parseInt($.trim(actual_qty))) {
            $(this).closest('tr').find('span.error_msg').text('Delivery Qty is more than actual Qty').css('color', 'red');
        } else {
            $(this).closest('tr').find('span.error_msg').text('');
            $(this).closest('tr').find('td.del_qty').html('<input type="hidden" class="delivery_quantity" style="width:70px;" value="' + qty + '"><input type="text" id="delivery_quantity" style="width:70px;" readonly name="delivery_quantity[' + po_details_id + '][]" value="' + total + '">');
            var a = 0;
            $("table#add_quotation tbody tr").each(function () {
                if ($(this).find('.delivary').prop('checked') == true) {
                    a += parseInt($(this).find('#delivery_quantity').val());
                } else {
                    a += parseInt($(this).find('.delivery_quantity').val());
                }
            });
            $("table#add_quotation tfoot").find('td.total_del_qty').text('');
            $("table#add_quotation tfoot").find('td.total_del_qty').text(a);
            // $(this).closest('table#add_quotation').find('tfoot').find('td.total_del_qty').text(a);
        }
    });



    $(document).on('click', '#save_delivary', function () {
        var m = 0;
        $('#app_table').find('input.required').each(function () {
            this_val = $.trim($(this).val());
            this_val2 = $.trim($(this).closest('tr').find('.act_qty').text());
            this_id = $(this);

            if (Number(this_val) > Number(this_val2)) {
                this_id.closest('tr td.del_qty').find('span.error_msg').text('Invalid Quantity').css({'display': 'inline-block'});
                m++;
            } else {
                this_id.closest('tr td.del_qty').find('span.error_msg').text('').css('display', 'none');
            }
        });
        if (m > 0)
        {
            return false;
        } else {


            $('#add_delivary').submit();
        }
    });
</script>

