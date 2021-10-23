<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?php echo $theme_path; ?>/js/jquery-ui-1.10.3.min.js"></script>
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
                    <li role="presentation" class="active"><a href="#add_sales_man" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">Edit Designation</a></li>
                </ul>
                <div class="tab-content tabbor">
                    <div role="tabpanel" class="tab-pane active" id="add_sales_man">
                        <form action="<?php echo $this->config->item('base_url'); ?>designation/edit_designation/<?php echo $designation[0]['id']; ?>" enctype="multipart/form-data" name="form" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation Name: <span class="req">*</span></label>
                                        <input type="text" name="name" class="name form-control form-align required_field" id="designation_name" maxlength="15" value="<?php echo $designation[0]['name']; ?> "/>
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
                                            <td><a href="<?php echo $this->config->item('base_url') . 'designation'; ?>" class="btn btn-defaultback"><span class="glyphicon"></span> Back </a></td>
                                        </tr>
                                    </tbody></table>
                            </div>
                            <input type="hidden" name="designation_id" id="designation_id" value="<?php echo $designation[0]['id']; ?>">
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
    $('#submit').on('click', function () {
        m = 0;
        $('.required_field').each(function () {
            this_ele = $(this);
            this_val = $.trim($(this).val());
            this_id = $(this).attr('id');
            if (this_val == '') {
                $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
                m++;
            } else if ($.inArray(this_id, ['designation_name']) != -1) {
                this_length = $.trim(this_ele.val()).length;
                if (this_id == 'designation_name' && (this_length > 15 || this_length < 3)) {
                    $(this).closest('div.form-group').find('.error_msg').text('This field limit betweeen 3 and 15 letters').slideDown('500').css('display', 'inline-block');
                    m++;
                }
            }
        });
        if (m == 0) {
            $.ajax({
                type: 'POST',
                async: false,
                url: '<?php echo base_url() . 'designation/is_designation_available/'; ?>',
                data: {designation_name: $('#designation_name').val(), designation_id: $('#designation_id').val()},
                success: function (response) {
                    if (response == 'no') {
                        $('#designation_name').closest('div.form-group').find('.error_msg').text('This designation name is not available').slideDown('500').css('display', 'inline-block');
                        m++;
                    } else {
                        $('#designation_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                    }
                }
            });
        }
        if (m > 0)
            return false;
    });

</script>









