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

                    <li role="presentation" class="active"><a href="#sales_man_list" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Department List</a></li>
                    <li role="presentation" class=""><a href="#add_sales_man" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">Add Department</a></li>
                </ul>
                <div class="tab-content tabbor">
                    <div role="tabpanel" class="tab-pane" id="add_sales_man">
                        <form action="<?php echo $this->config->item('base_url'); ?>department/add_department" enctype="multipart/form-data" name="form" method="post">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department Name: <span class="req">*</span></label>
                                        <input type="text" name="name" class="name form-control form-align required_field" id="department_name" maxlength="15"/>
                                        <span class="error_msg"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department Head: <span class="req">*</span></label>
                                        <select name="department_head"  class="form-control form-align required_field" id="department_head" >
                                            <option value="">Select</option>
                                            <?php
                                            if (isset($department_head) && !empty($department_head)) {
                                                foreach ($department_head as $dept_head) {
                                                    ?>
                                                    <option value="<?php echo $dept_head['id']; ?>"> <?php echo ucfirst($dept_head['username']); ?> </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
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
                                            <td><a href="<?php echo $this->config->item('base_url') . 'department'; ?>" class="btn btn-defaultback"><span class="glyphicon"></span> Cancel </a></td>
                                        </tr>
                                    </tbody></table>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane active tablelist" id="sales_man_list">
                        <div class="frameset_big1">
                            <!--<h4 align="center" class="sup-align">Customer Details</h4>-->
                            <table id="basicTable" class="table table-striped table-bordered responsive dataTable no-footer dtr-inline target-cntr" id="list">
                                <thead>
                                <th width='5%' class="action-btn-align">S.No</th>
                                <th width='20%'>Department Name</th>
                                <th width='10%'>Head Name</th>
                                <th width='10%' class="action-btn-align">Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($departments) && !empty($departments)) {
                                        $i = 0;
                                        foreach ($departments as $val) {

                                            $i++;
                                            ?>
                                            <tr>
                                                <td class="first_td"><?php echo "$i"; ?></td>
                                                <td><?php echo ucfirst($val['name']); ?></td>
                                                <td><?php echo ucfirst($val['username']); ?></td>
                                                <td class="action-btn-align">
                                                    <a href="<?php echo $this->config->item('base_url') . 'department/edit_department/' . $val['id']; ?>" class="tooltips btn btn-default btn-xs" title="Edit"><span class="fa fa-edit"></span></a>&nbsp;&nbsp;
                                                    <a href="javascript:void(0);" department_id="<?php echo $val['id']; ?>" class="tooltips btn btn-default btn-xs delete_department" title="Delete"><i class="fa fa-fw fa-trash" data-original-title="Delete" title="Delete"></i></a>
                                                </td>
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
    </div>
</div>
<br />
<?php $base_url = $this->config->item('base_url'); ?>
<script>
    $('.delete_department').click(function () {
        var department_id = $(this).attr('department_id');
        var current_row = $(this).closest('tr');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . 'department/delete/'; ?>' + department_id,
            success: function (data) {
                if (data == '1') {
                    current_row.hide();
                    window.location = base_url + 'department';
                }
            }
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
            } else if ($.inArray(this_id, ['department_name']) != -1) {
                this_length = $.trim(this_ele.val()).length;
                if (this_id == 'department_name' && (this_length > 15 || this_length < 3)) {
                    $(this).closest('div.form-group').find('.error_msg').text('This field limit betweeen 3 and 15 letters').slideDown('500').css('display', 'inline-block');
                    m++;
                }
            }
        });
        if (m == 0) {
            $.ajax({
                type: 'POST',
                async: false,
                url: '<?php echo base_url() . 'department/is_department_available/'; ?>',
                data: {department_name: $('#department_name').val()},
                success: function (response) {
                    if (response == 'no') {
                        $('#department_name').closest('div.form-group').find('.error_msg').text('This department name is not available').slideDown('500').css('display', 'inline-block');
                        m++;
                    } else {
                        $('#department_name').closest('div.form-group').find('.error_msg').text('').slideUp('500');
                    }
                }
            });
        }
        if (m > 0)
            return false;
    });
</script>







