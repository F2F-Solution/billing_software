<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<style>
    .input-group-addon .fa { width:10px !important; }
    .form-group .error_msg {
        color: #e71616;
        margin-top: 2px;
        font-size: 13px;
        font-weight: normal;
    }
</style>
<div class="mainpanel">
    <div class="media">

    </div>
    <div class="contentpanel">
        <div class="media mt--2">
            <h4>Department Details</h4>
        </div>
        <div class="panel-body  mb-25">
            <div class="tabs">
                <!-- Nav tabs -->
                <ul class="list-inline tabs-nav tabsize-17" role="tablist">
                    <li role="presentation" class="active"><a href="#add_sales_man" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">Edit Public Holiday</a></li>
                </ul>
                <div class="tab-content tabbor">
                    <div role="tabpanel" class="tab-pane active" id="add_sales_man">
                        <form action="<?php echo $this->config->item('base_url'); ?>public_holiday/edit_public_holiday/<?php echo $public_holiday[0]['id']; ?>" enctype="multipart/form-data" name="form" method="post">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Holiday Title: <span class="req">*</span></label>
                                        <input type="text" name="reason" class="name form-control form-align required_field" id="holiday_title" maxlength="15" value="<?php echo $public_holiday[0]['reason'] ?>"/>
                                        <span class="error_msg"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department: <span class="req">*</span></label>
                                        <select name="department"  class="form-control form-align required_field" id="department" >
                                            <option value="">Select</option>
                                            <?php
                                            if (isset($department) && !empty($department)) {
                                                foreach ($department as $dept) {
                                                    $selected = ($dept['id'] == $public_holiday[0]['department']) ? "selected" : "";
                                                    ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $dept['id']; ?>"> <?php echo ucfirst($dept['name']); ?> </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span class="error_msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Holiday From: <span class="req">*</span></label>
                                        <input type="text" name="holiday_from" class="form-control form-align datepicker hl_start_date wid required_field" id="holiday_from" value="<?php echo $public_holiday[0]['holiday_from'] ?>" />
                                        <span class="error_msg"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Holiday To: <span class="req">*</span></label>
                                        <input type="text" name="holiday_to" class="form-control form-align datepicker hl_end_date wid required_field" id="holiday_to" value="<?php echo $public_holiday[0]['holiday_to'] ?>" />
                                        <span class="error_msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="frameset_table action-btn-align">
                                <table>
                                    <tbody><tr>
                                            <td width="570">&nbsp;</td>
                                            <td><input type="submit" name="submit" class="btn btn-success" value="Save" id="submit"></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><a href="<?php echo $this->config->item('base_url') . 'public_holiday'; ?>" class="btn btn-defaultback"><span class="glyphicon"></span> Back </a></td>
                                        </tr>
                                    </tbody></table>
                            </div>
                            <input type="hidden" name="holiday_id" id="holiday_id" value="<?php echo $public_holiday[0]['id']; ?>">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<br />
<?php $base_url = $this->config->item('base_url'); ?>

<script>
    $(function () {
        $("#holiday_from, #holiday_to").datepicker({
            dateFormat: "yy-mm-dd",
        });
    });
    $('#submit').on('click', function () {
        m = 0;
        $('.required_field').each(function () {
            this_ele = $(this);
            this_val = $.trim($(this).val());
            this_id = $(this).attr('id');
            if (this_val == '') {
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
                m++;
            } else if ($.inArray(this_id, ['holiday_title']) != -1) {
                this_length = $.trim(this_ele.val()).length;
                if (this_id == 'holiday_title' && (this_length > 25 || this_length < 3)) {
                    $(this).closest('div.form-group').find('.error_msg').text('This field limit betweeen 3 and 25 letters').slideDown('500').css('display', 'inline-block');
                    m++;
                }
            }
        });
        if (m == 0) {
            /*
             $.ajax({
             type: 'POST',
             async: false,
             url: '<?php //echo base_url() . 'public_holiday/is_holiday_available/';               ?>',
             data: {holiday_title: $('#holiday_title').val(), holiday_id: $('#holiday_id').val()},
             success: function (response) {
             if (response == 'no') {
             $('#holiday_title').closest('div.form-group').find('.error_msg').text('This holiday_title is not available').slideDown('500').css('display', 'inline-block');
             m++;
             } else {
             $('#holiday_title').closest('div.form-group').find('.error_msg').text('').slideUp('500');
             }
             }
             });
             */
        }
        if (m > 0)
            return false;
    });


</script>








