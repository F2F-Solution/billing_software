<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<style>
    .btn-xs {padding: 0px 3px 1px 4px !important; }
    .bg-red {background-color: #dd4b39 !important;}
    .bg-green {background-color:#09a20e !important;}
    .bg-yellow{ background-color:orange !important; }
    .ui-datepicker td.ui-datepicker-today a {background:#999999;}

    .img-polaroid {
        max-width: 150px;
        max-height: 180px;
    }

    .img-polaroid {
        padding: 4px;
        background-color: #fff;
        border: 1px solid #ccc;
        border: 1px solid rgba(0,0,0,0.2);
        -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .suf {
        margin-top:10px;
    }

</style>
<div class="mainpanel">

    <div class="media mt--20">
        <h4>Settings</h4>
    </div>

    <div class="contentpanel">
        <div class="panel-body mt-top5">
            <div class="">

                <?php
                $result = validation_errors();

                if (trim($result) != ""):
                    ?>

                    <div class="alert alert-error">

                        <button data-dismiss="alert" class="close" type="button">&times;</button>

                        <?php echo implode("</p>", array_unique(explode("</p>", validation_errors()))); ?>
                    </div>

                <?php endif;
                ?>

                <?php
                // $user_role = json_decode($roles[0]["roles"]);
                //$this->pre_print->viewExit($user_role);

                $attributes = array('class' => 'stdform editprofileform', 'method' => 'post');
                echo form_open_multipart('masters/biometric/settings', $attributes);
                ?>

                <div class="row">

                 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Employee ID(prefix,suffix)</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <?php
                                    $default = '';

                                    if (isset($settings['emp_id_prefix']))
                                        $default = $settings['emp_id_prefix']["value"];

                                    $data = array(
                                        'name' => 'setting[emp_id_prefix]',
                                        'value' => $default,
                                        'class' => 'required input-small character empid-width',
                                    );

                                    if (!in_array("masters:edit_settings", $user_role)) {
                                        $data["disabled"] = "disabled";
                                    }

                                    echo form_input($data);
                                    ?>

                                    <?php
                                    $default = '';

                                    if (isset($settings['emp_id_suffix']))
                                        $default = $settings['emp_id_suffix']["value"];

                                    $data = array(
                                        'name' => 'setting[emp_id_suffix]',
                                        'value' => $default,
                                        'class' => 'required input-small numeric empid-width suf',
                                    );

                                    if (!in_array("masters:edit_settings", $user_role)) {
                                        $data["disabled"] = "disabled";
                                    }
                                    //      print_r($data);exit;
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Minimum Overtime Hours</label>
                            <div class="col-sm-8">
                                <div class="input-group inlin">
                                    <?php
                                    $default = '';

                                    if (isset($settings['min_ot_hours']))
                                        $default = $settings['min_ot_hours']["value"];

                                    $data = array(
                                        'name' => 'setting[min_ot_hours]',
                                        'value' => isset($_POST['save']) ? set_value('setting[min_ot_hours]') : $default,
                                        'class' => 'required input-medium time',
                                    );

                                    if (!in_array("masters:edit_settings", $user_role)) {
                                        // $data["disabled"] = "disabled";
                                    }

                                    echo form_input($data) . " (in hh : mm)";
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                   

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Allow Manual Attendance</label>
                            <div class="col-sm-5" style="margin-top:5px;">
                                <div class="input-group inlin">

                                    <?php
                                    $ma_yes = FALSE;

                                    $ma_no = FALSE;

                                    if (isset($_POST['save'])) {

                                        if (isset($post['setting']['manual_attendance_entry'])) {

                                            if (set_value('setting[manual_attendance_entry]') == 1)
                                                $ma_yes = TRUE;

                                            else if (set_value('setting[manual_attendance_entry]') == 0)
                                                $ma_no = TRUE;
                                        }
                                    }

                                    else {

                                        if (isset($settings['manual_attendance_entry'])) {
                                            if ($settings["manual_attendance_entry"]["value"] == 1)
                                                $ma_yes = TRUE;

                                            else if ($settings["manual_attendance_entry"]["value"] == 0)
                                                $ma_no = TRUE;
                                        }
                                    }

                                    $data = array('name' => 'setting[manual_attendance_entry]', 'type' => 'radio', "value" => 1, 'checked' => $ma_yes, 'class' => 'required-radio');

                                    if (!in_array("masters:edit_settings", $user_role)) {
                                        // $data["disabled"] = "disabled";
                                    }
                                    echo form_checkbox($data);
                                    ?> Yes &nbsp; &nbsp;

                                    <?php
                                    $data = array('name' => 'setting[manual_attendance_entry]', 'type' => 'radio', "value" => 0, "checked" => $ma_no, 'class' => 'required-radio');

                                    if (!in_array("masters:edit_settings", $user_role)) {
                                        // $data["disabled"] = "disabled";
                                    }

                                    echo form_checkbox($data);
                                    ?> No &nbsp; &nbsp;

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Late Coming Threshold</label>
                            <div class="col-sm-8">
                                <div class="input-group inlin">
                                    <?php
                                    $default = '';

                                    if (isset($settings['late_coming_threshold_value']))
                                        $default = $settings['late_coming_threshold_value']["value"];

                                    $data = array(
                                        'name' => 'setting[late_coming_threshold_value]',
                                        'value' => isset($_POST['save']) ? set_value('setting[late_coming_threshold_value]') : $default,
                                        'class' => 'required input-medium time',
                                    );

                                    if (!in_array("masters:edit_settings", $user_role)) {
                                        // $data["disabled"] = "disabled";
                                    }

                                    echo form_input($data) . " (in hh : mm)";
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Early Going Threshold</label>
                            <div class="col-sm-8">
                                <div class="input-group inlin">
                                    <?php
                                    $default = '';

                                    if (isset($settings['early_going_threshold_value']))
                                        $default = $settings['early_going_threshold_value']["value"];

                                    $data = array(
                                        'name' => 'setting[early_going_threshold_value]',
                                        'value' => isset($_POST['save']) ? set_value('setting[early_going_threshold_value]') : $default,
                                        'class' => 'required input-medium time',
                                    );

                                    if (!in_array("masters:edit_settings", $user_role)) {
                                        // $data["disabled"] = "disabled";
                                    }

                                    echo form_input($data) . " (in hh : mm)";
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Saturday Holidays</label>
                            <div class="col-sm-5" style="margin-top:5px;">
                                <div class="input-group inlin">

                                    <?php
                                    for ($i = 1; $i < 6; $i++) {
                                        if ($i == 1) {
                                            $week_name = 'st';
                                        } elseif ($i == 2) {
                                            $week_name = 'nd';
                                        } elseif ($i == 3) {
                                            $week_name = 'rd';
                                        } else {
                                            $week_name = 'th';
                                        }
                                        $check = "";
                                        if ($settings['Week_end_holidays'] != "") {
                                            $explode_holidays = explode(',', $settings['Week_end_holidays']['value']);

                                            if (in_array($i, $explode_holidays)) {

                                                $check = "checked";
                                            }
                                        }
                                        //echo $check;
                                        echo'<input type="checkbox" value="' . $i . '" name="setting[Week_end_holidays][]" ' . $check . '> ' . $i . '' . $week_name . ' Week &nbsp; &nbsp;<br>';
                                    }
                                    ?>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Quater Day Time</label>
                            <div class="col-sm-8">
                                <div class="input-group inlin">
                                    <?php
                                    $default = '';

                                    if (isset($settings['quater_day_calculation']))
                                        $default = $settings['quater_day_calculation']["value"];

                                    $data = array(
                                        'name' => 'setting[quater_day_calculation]',
                                        'value' => isset($_POST['save']) ? set_value('setting[quater_day_calculation]') : $default,
                                        'class' => 'required input-medium time',
                                    );

                                    if (!in_array("masters:edit_settings", $user_role)) {
                                        // $data["disabled"] = "disabled";
                                    }

                                    echo form_input($data) . " (in hh : mm)";
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Half Day Time</label>
                            <div class="col-sm-8">
                                <div class="input-group inlin">
                                    <?php
                                    $default = '';

                                    if (isset($settings['half_day_calculation']))
                                        $default = $settings['half_day_calculation']["value"];

                                    $data = array(
                                        'name' => 'setting[half_day_calculation]',
                                        'value' => isset($_POST['save']) ? set_value('setting[half_day_calculation]') : $default,
                                        'class' => 'required input-medium time',
                                    );

                                    if (!in_array("masters:edit_settings", $user_role)) {
                                        // $data["disabled"] = "disabled";
                                    }

                                    echo form_input($data) . " (in hh : mm)";
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

            
                    <br/>
                    <div class="frameset_table action-btn-align" >

                        <?php
                        $data = array(
                            'name' => 'save',
                            'value' => 'Save',
                            'class' => 'submit btn btn-success',
                            'id' => 'save_btn',
                            'titlt' => 'Save'
                        );

                        echo form_submit($data);
                        ?>
                        <input type="reset" value="Clear" class=" btn btn-danger1" id="cancel" />

                    </div>

                </div>

            </div>

        </div>
    </div>

</div><!-- contentpanel -->

</div><!-- mainpanel -->

<script type="text/javascript">

    var ln_yes = "<?= $ln_yes ?>";

    var w_yes = "<?= $w_yes ?>";

    var lm_yes = "<?= $lm_yes ?>";

    var wn_yes = "<?= $wn_yes ?>";

    var el_yes = "<?= $el_yes ?>";

    $(document).ready(function () {

        //alert(lm_yes);

        if (!ln_yes)
            $("#leave_notify").hide();

        if (!w_yes)
            $("#wage_notify").hide();

        if (!lm_yes)
            $(".leave_extra").hide();

        if (!wn_yes)
            $(".wage_extra").hide();

        if (!el_yes)
            $(".earned-leave-show").hide();



        $(".leave").click(function () {



            if ($(this).attr("value") == 1)

            {

                $("#leave_notify").show();

            } else

            {

                $("#leave_notify").hide();

            }

        });

        $(".wage").click(function () {



            if ($(this).attr("value") == 1)

            {

                $("#wage_notify").show();

            } else

            {

                $("#wage_notify").hide();

            }

        });

        $(".current_leave").click(function () {



            if ($(this).attr("value") == 1)

            {

                $(".leave_extra").show();

            } else

            {

                $(".leave_extra").hide();

            }

        });

        $(".current_wage").click(function () {

            //alert($(this).attr("value"));

            if ($(this).attr("value") == 1)

            {

                $(".wage_extra").show();

            } else

            {

                $(".wage_extra").hide();

            }

        });

        $(".earned-leave").click(function () {



            if ($(this).attr("value") == 1)

            {

                $(".earned-leave-show").show();

            } else

            {

                $(".earned-leave-show").hide();

            }

        });

    });

</script>