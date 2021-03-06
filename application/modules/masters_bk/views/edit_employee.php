<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<link rel="stylesheet" href="<?= $theme_path ?>/css/bootstrap-multiselect.css" type="text/css"/>
<script type="text/javascript" src="<?= $theme_path ?>/js/jquery.MultiFile.js"></script>
<script type="text/javascript" src="<?= $theme_path ?>/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?= $theme_path; ?>/js/employee.js"></script>
<style>
    .btn-xs {padding: 0px 3px 1px 4px !important; }
    .bg-red {background-color: #dd4b39 !important;}
    .bg-green {background-color:#09a20e !important;}
    .bg-yellow{ background-color:orange !important; }
    .ui-datepicker td.ui-datepicker-today a {background:#999999;}

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;

    }
    li {
        float: left;
        border-right:1px solid #bbb;
    }
    li a {
        display: block;
        /*color: white;*/
        text-align: center;
        padding: 2px 16px;
        text-decoration: none;
    }
    .button_right_align{
        margin-top: 10px;
    }

    .profile{
        margin-top: -31px;
    }
    img {
        vertical-align: middle;
        margin-r: -131px;
        margin-left: -127px;
    }
    .profile_pic {
        margin-bottom: -59px;
        margin-top: 10px;
        width: 196px;
        margin-left: -9px;
    }
    .req { color:#FF0000; }

</style>
<div class="mainpanel">

    <div class="media mt--20">
        <h4>EDIT EMPLOYEE</h4>
    </div>

    <div class="contentpanel">
        <div class="panel-body mt-top5">

            <div class="">

                <div class="row">

                    <?php
                    $attributes = array('class' => 'stdform editprofileform', 'method' => 'post');



                    echo form_open_multipart('', $attributes);
                    ?>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <ul>

                                <?php
                                if (isset($error)) {
                                    ?>

                                    <script type="text/javascript">

                                        tab_index = "<?php echo $error ?>";

                                    </script>

                                    <?php
                                }
                                ?>
                                <li><a class="nav-item nav-link active" id="tabs-1-tab" data-toggle="tab" href="#tabs-1" role="tab" aria-controls="nav-home" aria-selected="true">General Details</a></li>
                                <li><a class="nav-item nav-link" id="tabs-2-tab" data-toggle="tab" href="#tabs-2" role="tab" aria-controls="nav-profile" aria-selected="false">Contacts</a></li>
                                <li><a class="nav-item nav-link" id="tabs-3-tab" data-toggle="tab" href="#tabs-3" role="tab" aria-controls="nav-contact" aria-selected="false">Company Details</a></li>
                                <li><a class="nav-item nav-link" id="tabs-4-tab" data-toggle="tab" href="#tabs-4" role="tab" aria-controls="nav-home" aria-selected="true">Educations</a></li>
                                <li><a class="nav-item nav-link" id="tabs-5-tab" data-toggle="tab" href="#tabs-5" role="tab" aria-controls="nav-profile" aria-selected="false">Family Members</a></li>
                                <li><a class="nav-item nav-link" id="tabs-6-tab" data-toggle="tab" href="#tabs-6" role="tab" aria-controls="nav-contact" aria-selected="false">Languages</a></li>
                                <li><a class="nav-item nav-link" id="tabs-7-tab" data-toggle="tab" href="#tabs-7" role="tab" aria-controls="nav-home" aria-selected="true">Identification</a></li>
                                <li><a class="nav-item nav-link" id="tabs-8-tab" data-toggle="tab" href="#tabs-8" role="tab" aria-controls="nav-profile" aria-selected="false">Reference Details</a></li>
                                <li><a class="nav-item nav-link" id="tabs-9-tab" data-toggle="tab" href="#tabs-9" role="tab" aria-controls="nav-contact" aria-selected="false">Experience</a></li>

                            </ul>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel" aria-labelledby="tabs-1-tab">
                            <!--<div class="span6" id="address_tab_1" style="width:40%;">-->

                            <h5 style="color:#23b7e5;">LOGIN INFORMATION</h5>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Emp Id</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
//$sel_value = ($sel_value != "status") ? $sel_value : "Employee status";

                                            $data = array(
                                                'name' => 'users[employee_id]',
                                                'class' => 'input-large required ',
                                                'readonly' => 'readonly',
                                                'value' => isset($_POST['save']) ? $post['users']['employee_id'] : $user[0]['employee_id']
                                            );



                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Access Id <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'users[access_id]',
                                                'class' => 'input-large required',
                                                'value' => isset($_POST['save']) ? $post['users']['access_id'] : $user[0]['access_id']
                                            );



                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Username <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'users[username]',
                                                'class' => 'input-large required',
                                                'value' => isset($_POST['save']) ? $post['users']['username'] : $user[0]['username']
                                            );



                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Password <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'users[password]',
                                                'class' => 'input-large required',
                                                'value' => isset($_POST['save']) ? $post['users']['password'] : '',
                                                'autocomplete' => 'off'
                                            );



                                            echo form_password($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <p class="help-block" style="position:relative;left:160px;">Leave this field blank, if you dont want to change password.</p>

                                <h5 style="color:#23b7e5;">PERSONAL INFORMATION</h5>


                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Firstname <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'users[first_name]',
                                                'class' => 'input-large required alphabet',
                                                'value' => isset($_POST['save']) ? $post['users']['first_name'] : $user[0]['first_name']
                                            );



                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Lastname <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'users[last_name]',
                                                'class' => 'input-large alphabet',
                                                'value' => isset($_POST['save']) ? $post['users']['last_name'] : $user[0]['last_name']
                                            );



                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">DOB <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'datepicker',
                                                'name' => 'users[dob]',
                                                'readonly' => 'readonly',
                                                'class' => 'input-large required datepicker input-date',
                                                'value' => isset($_POST['save']) ? $post['users']['dob'] : date('d-m-Y', strtotime($user[0]['dob']))
                                            );



                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Religion <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => '',
                                                'name' => 'users[religion]',
                                                'class' => 'input-large required alphabet',
                                                'value' => isset($_POST['save']) ? $post['users']['religion'] : $user[0]['religion']
                                            );



                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Mobile Number <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'users[mobile]',
                                                'class' => 'input-large required mobile numeric',
                                                'value' => isset($_POST['save']) ? $post['users']['mobile'] : $user[0]['mobile']
                                            );



                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Landline Number</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'users[landline_no]',
                                                'class' => 'input-large required numeric landline',
                                                'value' => isset($_POST['save']) ? $post['users']['landline_no'] : $user[0]['landline_no']
                                            );



                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email Id <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'users[email]',
                                                'class' => 'input-large required email',
                                                'value' => isset($_POST['save']) ? $post['users']['email'] : $user[0]['email']
                                            );



                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Blood Group <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $options = array('' => 'select');

                                            if (isset($blood_group) && !empty($blood_group)) {

                                                foreach ($blood_group as $val) {

                                                    $options[$val["value"]] = ucwords($val["value"]);
                                                }
                                            }

//$data = array('name'=> 'shirts','class'=>'required');

                                            $default = isset($_POST['save']) ? $post['users']['blood_group'] : $user[0]['blood_group'];

//print_r($default);

                                            echo form_dropdown('users[blood_group]', $options, $default, 'class="required"');
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label ">Gender <span class="req">*</span></label>
                                    <div class="col-sm-8 ">
                                        <div class="form-group ">
                                            <?php
                                            $male = FALSE;

                                            $female = FALSE;



                                            if (isset($_POST['save'])) {

                                                if (isset($post["users"]["gender"])) {

                                                    if ($post['users']['gender'] == 1) {

                                                        $male = TRUE;
                                                    } else if ($post['users']['gender'] == 2) {

                                                        $female = TRUE;
                                                    }
                                                }
                                            } else {

                                                if ($user[0]['gender'] == 'male') {



                                                    $male = TRUE;
                                                } else if ($user[0]['gender'] == 'female') {

                                                    $female = TRUE;
                                                }
                                            }



                                            $data = array(
                                                'name' => 'users[gender]',
                                                'type' => 'radio',
                                                'value' => '1',
                                                'class' => 'required-radio',
                                                'checked' => $male
                                            );



                                            echo form_checkbox($data);
                                            ?> Male &nbsp; &nbsp;



                                            <?php
                                            $data = array(
                                                'name' => 'users[gender]',
                                                'type' => 'radio',
                                                'value' => '2',
                                                'class' => 'required-radio',
                                                'checked' => $female
                                            );

                                            echo form_checkbox($data);
                                            ?>Female &nbsp; &nbsp;

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Marital Status <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <?php
                                            $single = FALSE;

                                            $married = FALSE;

                                            $widow = FALSE;

                                            $widower = FALSE;

                                            if (isset($_POST['save'])) {

                                                if (isset($post["users"]["marital_status"])) {

                                                    if ($post['users']['marital_status'] == 1) {

                                                        $single = TRUE;
                                                    } else if ($post['users']['marital_status'] == 2) {

                                                        $married = TRUE;
                                                    } else if ($post["users"]["marital_status"] == 3) {

                                                        $widow = TRUE;
                                                    } else if ($post["users"]["marital_status"] == 4) {

                                                        $widower = TRUE;
                                                    }
                                                }
                                            } else {

                                                if ($user[0]['marital_status'] == 'single') {

                                                    $single = TRUE;
                                                } else if ($user[0]['marital_status'] == 'married') {

                                                    $married = TRUE;
                                                } else if ($user[0]['marital_status'] == 'widow') {

                                                    $widow = TRUE;
                                                } else if ($user[0]['marital_status'] == 'widower') {

                                                    $widower = TRUE;
                                                }
                                            }

                                            $data = array(
                                                'name' => 'users[marital_status]',
                                                'type' => 'radio',
                                                'value' => '1',
                                                'class' => 'required-radio',
                                                'checked' => $single
                                            );



                                            echo form_checkbox($data);
                                            ?>Single &nbsp; &nbsp;

                                            <?php
                                            $data = array(
                                                'name' => 'users[marital_status]',
                                                'type' => 'radio',
                                                'value' => '2',
                                                'class' => 'required-radio',
                                                'checked' => $married
                                            );



                                            echo form_checkbox($data);
                                            ?>Married &nbsp; &nbsp;

                                            <?php
                                            $data = array(
                                                'name' => 'users[marital_status]',
                                                'type' => 'radio',
                                                'value' => '3',
                                                'class' => 'required-radio',
                                                'checked' => $widow
                                            );



                                            echo form_checkbox($data);
                                            ?>Widow &nbsp; &nbsp;

                                            <?php
                                            $data = array(
                                                'name' => 'users[marital_status]',
                                                'type' => 'radio',
                                                'value' => '4',
                                                'class' => 'required-radio',
                                                'checked' => $widower
                                            );



                                            echo form_checkbox($data);
                                            ?>Widower &nbsp; &nbsp;

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Employee Status <span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <?php
                                            $active = FALSE;

                                            $inactive = FALSE;

                                            if (isset($_POST['save'])) {

                                                if (isset($post["users"]["status"])) {

                                                    if ($post['users']['status'] == 1) {

                                                        $active = TRUE;
                                                    } else if ($post['users']['status'] == 0) {

                                                        $inactive = TRUE;
                                                    }
                                                }
                                            } else {

                                                if ($user[0]['status'] == 1) {

                                                    $active = TRUE;
                                                } else if ($user[0]['status'] == 0) {

                                                    $inactive = TRUE;
                                                }
                                            }

                                            $data = array(
                                                'name' => 'users[status]',
                                                'type' => 'radio',
                                                'value' => '1',
                                                'class' => 'required-radio',
                                                'checked' => $active
                                            );



                                            echo form_checkbox($data);
                                            ?>Active &nbsp; &nbsp;

                                            <?php
                                            $data = array(
                                                'name' => 'users[status]',
                                                'type' => 'radio',
                                                'value' => '0',
                                                'class' => 'required-radio',
                                                'checked' => $inactive
                                            );



                                            echo form_checkbox($data);
                                            ?>Deactive &nbsp; &nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 profile">

                                <h5 style="color:#23b7e5;">YOUR PROFILE PHOTO</h5>
                                <div class="profilethumb">

                                    <a href="#">Change Thumbnail</a>



                                    <?php
                                    //echo ".yhg" . $user[0]['image'];
                                    if ($user[0]['image'] != NULL) {
                                        $src = $this->config->item('base_url') . "attachments/user_profile/" . $user[0]['image'];
                                    } else {

                                        $src = $theme_path . "/img/profilethumb.png";
                                    }
                                    ?>

                                    <img src="<?= $src; ?>" alt="" class="img-polaroid" />

                                    <?php
                                    $data = array(
                                        'name' => 'users[image]',
                                        'type' => 'file',
                                        'class' => 'profile_pic'
                                    );



                                    echo form_input($data);
                                    ?>

                                    <input type="hidden" id="input_file" name="temp[file]" />

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel" aria-labelledby="tabs-2-tab" class="address_tab">


                            <div class="col-md-6"><h5 style="color:#23b7e5; margin-bottom:5px;">PRESENT ADDRESS</h5></div>

                            <div class="col-md-6"><h5 style="color:#23b7e5; margin-bottom:5px;" >PERMANENT ADDRESS</h5></div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <?php
                                $checked_pr = FALSE;



                                if (isset($_POST['save'])) {

                                    if (isset($input["address_checked"])) {



                                        $checked_pr = TRUE;
                                    }
                                }

                                $data = array(
                                    'id' => 'address_copy',
                                    'name' => 'address_checked',
                                    'value' => 1,
                                    'class' => "address",
                                    'checked' => $checked_pr
                                );

                                echo form_checkbox($data);
                                ?>&nbsp;same as present address

                                <?php
                                $line1 = $line2 = $line3 = $po = $dsct = $city = $state = $zip = "";

                                if (isset($_POST['save'])) {

                                    $line1 = $post["address"][1]["line1"];

                                    $line2 = $post["address"][1]["line2"];

                                    $line3 = $post["address"][1]["line3"];

                                    $po = $post["address"][1]["post_office"];

                                    $dsct = $post["address"][1]["district"];

                                    $city = $post["address"][1]["city"];

                                    $state = $post["address"][1]["state"];

                                    $zip = $post["address"][1]["zip"];
                                } else {

                                    if (isset($address[1]) && !empty($address[1])):

                                        $line1 = $address[1][0]["line1"];

                                        $line2 = $address[1][0]["line2"];

                                        $line3 = $address[1][0]["line3"];

                                        $po = $address[1][0]["post_office"];

                                        $dsct = $address[1][0]["district"];

                                        $city = $address[1][0]["city"];

                                        $state = $address[1][0]["state"];

                                        $zip = $address[1][0]["zip"];

                                    endif;
                                }
                                ?></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Address line 1<br /></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $line1 = $line2 = $line3 = $po = $dsct = $city = $state = $zip = "";



                                            if (isset($_POST['save'])) {

                                                $line1 = $post["address"][0]["line1"];

                                                $line2 = $post["address"][0]["line2"];

                                                $line3 = $post["address"][0]["line3"];

                                                $po = $post["address"][0]["post_office"];

                                                $dsct = $post["address"][0]["district"];

                                                $city = $post["address"][0]["city"];

                                                $state = $post["address"][0]["state"];

                                                $zip = $post["address"][0]["zip"];
                                            } else {

                                                if (isset($address[0]) && !empty($address[0])):

                                                    $line1 = $address[0][0]["line1"];

                                                    $line2 = $address[0][0]["line2"];

                                                    $line3 = $address[0][0]["line3"];

                                                    $po = $address[0][0]["post_office"];

                                                    $dsct = $address[0][0]["district"];

                                                    $city = $address[0][0]["city"];

                                                    $state = $address[0][0]["state"];

                                                    $zip = $address[0][0]["zip"];

                                                endif;
                                            }

                                            $data = array(
                                                'id' => 'line1',
                                                'name' => 'address[0][line1]',
                                                'class' => 'input-large required present line contact',
                                                'value' => $line1,
                                                'field_name' => 'line1'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Address line 1<br/></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'line21',
                                                'name' => 'address[1][line1]',
                                                'class' => 'input-large required permanent line contact',
                                                'value' => $line1,
                                                'field_name' => 'line1'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Address line 2<br /></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'line2',
                                                'name' => 'address[0][line2]',
                                                'class' => 'input-large required present line contact',
                                                'value' => $line2,
                                                'field_name' => 'line2'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Address line 2<br /></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'line22',
                                                'name' => 'address[1][line2]',
                                                'class' => 'input-large required permanent line contact',
                                                'value' => $line2,
                                                'field_name' => 'line2'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Address line 3<br /></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'line3',
                                                'name' => 'address[0][line3]',
                                                'class' => 'input-large required present lines contact',
                                                'value' => $line3,
                                                'field_name' => 'line3'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Address line 3<br /></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'line23',
                                                'name' => 'address[1][line3]',
                                                'class' => 'input-large required permanent lines contact',
                                                'value' => $line3,
                                                'field_name' => 'line3'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Post Office</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'po1',
                                                'name' => 'address[0][post_office]',
                                                'class' => 'input-large required present',
                                                'value' => $po,
                                                'field_name' => 'line4'
                                            );



                                            echo form_input($data);
                                            ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Post Office</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'po2',
                                                'name' => 'address[1][post_office]',
                                                'class' => 'input-large required permanent',
                                                'value' => $po,
                                                'field_name' => 'line4'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">District</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'dst1',
                                                'name' => 'address[0][district]',
                                                'class' => 'input-large required present',
                                                'value' => $dsct,
                                                'field_name' => 'line5'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">District</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'dst2',
                                                'name' => 'address[1][district]',
                                                'class' => 'input-large required permanent',
                                                'value' => $dsct,
                                                'field_name' => 'line5'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">City</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'city1',
                                                'name' => 'address[0][city]',
                                                'class' => 'input-large required present city contact',
                                                'value' => $city,
                                                'field_name' => 'line6'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">City</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'city2',
                                                'name' => 'address[1][city]',
                                                'class' => 'input-large required permanent city contact',
                                                'value' => $city,
                                                'field_name' => 'line6'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">State</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'state1',
                                                'name' => 'address[0][state]',
                                                'class' => 'input-large required present',
                                                'value' => $state,
                                                'field_name' => 'line7'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">State</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'state2',
                                                'name' => 'address[1][state]',
                                                'class' => 'input-large required permanent',
                                                'value' => $state,
                                                'field_name' => 'line7'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Pincode</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'zip1',
                                                'name' => 'address[0][zip]',
                                                'class' => 'input-large required numeric present',
                                                'value' => $zip,
                                                'field_name' => 'line8'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Pincode</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'id' => 'zip2',
                                                'name' => 'address[1][zip]',
                                                'class' => 'input-large required numeric permanent',
                                                'value' => $zip,
                                                'field_name' => 'line8'
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--                            <div class="span6" id="address_tab_2" style="width:40%;">
                                                            <h5 style="color:#23b7e5; margin-bottom:5px;" >PERMANENT ADDRESS</h5>
                                                        </div>-->

                            <h5 style="color:#23b7e5; margin-bottom:5px;" >EMERGENCY CONTACT DETAILS</h5>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Contact Name<span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'contact[name]',
                                                'class' => 'input-large required alphabet contact_name contact',
                                                'autocomplete' => 'off',
                                                'value' => $contact_name
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Contact Number<span class="req">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <?php
                                            $data = array(
                                                'name' => 'contact[contact_no]',
                                                'class' => 'input-large required numeric mobile contact_number contact',
                                                'autocomplete' => 'off',
                                                'value' => $contact_no,
                                            );



                                            echo form_input($data);
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--</div>-->

                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel" aria-labelledby="tabs-3-tab">
                            <table class="table table-bordered">

                                <thead>

                                    <tr>

                                        <th>S.No</th>

                                        <th>Designation <span class="req">*</span></th>

                                        <th>Salary Type <span class="req">*</span></th>

                                        <th>Department <span class="req">*</span></th>

                                        <th>Shift</th>

                                        <th>OT Applicable</th>

                                        <th>Salary Group</th>

                                        <?php if (in_array("reports:wage_reports", $roles)): ?>

                                            <th>Basic + DA</th>

                                        <?php endif; ?>

                                        <th>Date of Joining <span class="req">*</span></th>

                                        <th>Date of Leaving</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center">1</td>

                                        <td class="center">

                                            <?php
                                            $options = array('' => 'select');

                                            if (isset($designations) && !empty($designations)) {

                                                foreach ($designations as $des) {

                                                    $options[$des["id"]] = ucwords($des["name"]);
                                                }
                                            }

//$data = array('class'=>'uniformselect');

                                            if (isset($_POST['save'])) {

                                                $default = $post['user_dep']['designation'];
                                            } else {



                                                $default = $user_dep[0]['designation'];
                                            }



                                            echo form_dropdown('user_dep[designation]', $options, $default, 'class="required"');
                                            ?>



                                        </td>
                                        <td class="center">

                                            <?php echo ucwords($user_sal[0]["type"]); ?>

                                            <?php ?><?php
                                            $options = array(
                                                '' => 'select',
                                                '1' => 'Daily',
                                                '2' => 'Weekly',
                                                '3' => 'Monthly',
                                                    // '4'   => 'Pieces',
                                            );

                                            //$data = array('class'=>'uniformselect');

                                            if (isset($_POST['save'])) {

                                                $default = $post['user_salary']['type'];
                                            } else {

                                                switch ($user_sal[0]['type']) {

                                                    case 'daily':

                                                        $default = 1;

                                                        break;

                                                    case 'weekly':

                                                        $default = 2;

                                                        break;

                                                    case 'monthly':

                                                        $default = 3;

                                                        break;

                                                    case 'pieces':

                                                        $default = 4;

                                                        break;

                                                    default:

                                                        $default = '';
                                                }
                                            }

                                            echo form_dropdown('user_salary[type]', $options, $default, 'class="required"');
                                            ?><?php ?>



                                        </td>
                                        <td class="center">

                                            <?php
                                            $options = array('' => 'select');

                                            if (isset($departments) && !empty($departments)) {

                                                foreach ($departments as $dept) {

                                                    $options[$dept["dept_id"]] = ucwords($dept["dept_name"]);
                                                }
                                            }



//$data = array('class'=>'uniformselect');

                                            if (isset($_POST['save'])) {

                                                $default = $post['user_dep']['department'];
                                            } else {



                                                $default = $user_dep[0]['department'];
                                            }



                                            echo form_dropdown('user_dep[department]', $options, $default, 'class="required"');
                                            ?>




                                        </td>
                                        <td class="center">

                                            <?php echo ucwords($user_shift[0]["name"]); ?>

                                        </td><td class="center">

                                            <?php
                                            if ($user_shift[0]["ot_applicable"] == 0)
                                                echo "No";
                                            else
                                                echo "Yes";
                                            ?>

                                        </td>
                                        <td class="center">

                                            <?php echo ucwords($user_sal[0]["name"]); ?>

                                        </td>

                                        <?php
                                        $n = 0;

                                        if (in_array("reports:wage_reports", $roles)) {

                                            $n = 1;
                                        }
                                        ?>
                                        <?php if (in_array("reports:wage_reports", $roles)): ?>

                                            <td class="center">

                                                <?php
                                                /* $data = array(

                                                  'name'	=>'user_salary[basic]',

                                                  'class' =>'input-small required float',

                                                  'value' =>isset($_POST['save'])? $post['user_salary']['basic'] :$user_sal[0]['basic']

                                                  ); */

                                                echo $user_sal[0]['basic'] + $user_sal[0]['da'];
                                                ?>



                                            </td>

                                        <?php endif; ?>
                                        <td class="center">

                                            <?php
                                            $default = '';

                                            if (date('d-m-Y', strtotime($user_history[0]["date"])) != "01-01-1970")
                                                $default = date('d-m-Y', strtotime($user_history[0]['date']));

                                            $data = array(
                                                'id' => 'doj',
                                                'name' => 'user_history[doj]',
                                                'class' => 'input-small required input-date',
                                                'readonly' => 'readonly',
                                                'value' => isset($_POST['save']) ? $post['user_history']['doj'] : $default
                                            );

                                            echo form_input($data);
                                            ?>

                                        </td>
                                        <td class="center">

                                            <?php
                                            $default = '';

                                            if (date('d-m-Y', strtotime($dol[0]["date"])) != "01-01-1970")
                                                $default = date('d-m-Y', strtotime($dol[0]['date']));

                                            $data = array(
                                                'id' => 'dol',
                                                'name' => 'user_history[dol]',
                                                'class' => 'input-small input-date',
                                                'readonly' => 'readonly',
                                                'value' => isset($_POST['save']) ? $post['user_history']['dol'] : $default
                                            );

                                            echo form_input($data);
                                            ?>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h5 style="color:#23b7e5;">USER LEAVES</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>

                                        <th>Sick Leave per Month <span class="req">*</span></th>

                                        <th>Casual Leave per Month <span class="req">*</span></th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>

                                        <td class="center">1</td>

                                        <td class="center">

                                            <?php
                                            $data = array(
                                                'name' => 'leave[sick_leave]',
                                                'class' => 'input-small required float l_val',
                                                'value' => isset($_POST['save']) ? $post['leave']['sick_leave'] : $leave[0]['sick_leave']
                                            );

                                            echo form_input($data);
                                            ?>

                                        </td>

                                        <td class="center">

                                            <?php
                                            $data = array(
                                                'name' => 'leave[casual_leave]',
                                                'class' => 'input-small required float l_val',
                                                'value' => isset($_POST['save']) ? $post['leave']['casual_leave'] : $leave[0]['casual_leave']
                                            );

                                            echo form_input($data);
                                            ?>

                                        </td>



                                    </tr>

                                </tbody>

                            </table><div class="button_right_align">

                                <button class="btn btn-success  " data-toggle="modal" data-target="#myModal2">

                                    Change Shift

                                </button>

                                <?php //if (in_array("reports:wage_reports", $roles)):    ?>

                                <button class="btn btn-primary " data-toggle="modal" data-target="#myModal">

                                    Revise Salary

                                </button>

                                <?php //endif;    ?>

                                &nbsp;&nbsp;

                            </div>



                        </div>

                        <div class="tab-pane" id="tabs-4" role="tabpanel" aria-labelledby="tabs-4-tab">
                            <table class="table table-bordered education">
                                <colgroup>

                                    <col class="con0" />

                                    <col class="con1" />

                                    <col class="con0" />

                                    <col class="con1" />

                                    <col class="con0" />

                                </colgroup><thead>

                                    <tr>

                                        <th>S.No</th>

                                        <th>Specialization</th>

                                        <th>Institution</th>

                                        <th>Type</th>

                                        <th>Completed Year</th>

                                        <th>Percentage</th>

                                        <th><a href="javascript:void(0);" class="btn btn-danger add_row">+</th>

                                    </tr>

                                </thead>
                                <tbody>

                                    <?php
                                    $input = $this->input->post();

                                    if (isset($_POST['save'])) {

                                        if (!isset($edu_length) || $edu_length == 0):

                                            $edu_length = 1;

                                        endif;
                                    }

                                    else {

                                        $edu_length = count($edu);
                                    }

                                    for ($len = 0; $len < $edu_length; $len++) {
                                        ?>

                                        <tr>

                                            <td class="center sno"><?php echo $len + 1; ?></td>

                                            <td class="center">



                                                <?php
                                                $data = array(
                                                    'name' => 'edu[specialization][]',
                                                    'class' => 'input-small alphabet',
                                                    'value' => isset($_POST['save']) ? $post['edu']['specialization'][$len] : $edu[$len]['specialization']
                                                );

                                                echo form_input($data);
                                                ?>

                                            </td>

                                            <td class="center">

                                                <?php
                                                $data = array(
                                                    'name' => 'edu[institute][]',
                                                    'class' => 'input-small required alphabet',
                                                    'value' => isset($_POST['save']) ? $post['edu']['institute'][$len] : $edu[$len]['institute']
                                                );

                                                echo form_input($data);
                                                ?>

                                            </td>



                                            <td class="center">

                                                <?php
                                                $options = array('' => 'select');

                                                if (isset($edu_type) && !empty($edu_type)) {

                                                    foreach ($edu_type as $val) {

                                                        $options[$val["value"]] = ucwords($val["value"]);
                                                    }
                                                }

                                                $default = isset($_POST['save']) ? $post['edu']['type'][$len] : $edu[$len]['type'];

                                                echo form_dropdown('edu[type][]', $options, $default, 'class="required"');
                                                ?>



                                            </td>

                                            <td class="center">

                                                <?php
                                                $options = array('' => 'select');

                                                for ($i = 1945; $i <= date("Y"); $i++) {



                                                    $options[$i] = $i;
                                                }



                                                $default = isset($_POST['save']) ? $post['edu']['completed_year'][$len] : $edu[$len]['completed_year'];

                                                echo form_dropdown('edu[completed_year][]', $options, $default, 'class="required"');
                                                ?></td>

                                            <td class="center">

                                                <?php
                                                $data = array(
                                                    'name' => 'edu[percentage][]',
                                                    'class' => 'input-small required percentage float',
                                                    'value' => isset($_POST['save']) ? $post['edu']['percentage'][$len] : $edu[$len]['percentage']
                                                );

                                                echo form_input($data);
                                                ?></td>

                                            </td>

                                            <?php
                                            if ($len == 0)
                                                $style = "visibility:hidden;";
                                            else
                                                $style = "visibility:visible;";
                                            ?>

                                            <td class="center"><a href="javascript:void(0);" class="btn btn-danger remove_row" style="<?php echo $style; ?>"><i class="icon-minus icon-black"></i></a></td>

                                        </tr>

                                        <?php
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>

                        <div class="tab-pane" id="tabs-5" role="tabpanel" aria-labelledby="tabs-5-tab">
                            <table class="table table-bordered">
                                <colgroup>

                                    <col class="con0" />

                                    <col class="con1" />

                                    <col class="con0" />

                                    <col class="con1" />

                                    <col class="con0" />

                                </colgroup>
                                <thead>

                                    <tr>

                                        <th>S.No</th>

                                        <th>Name</th>

                                        <th>Relation</th>

                                        <th>Age</th>

                                        <th>Designation</th>

                                        <th>Monthly Income</th>

                                        <th class="hide">Proportion by which <br />gratuity will be shared</th>

                                        <th class="hide">Nominee</th>

                                        <th>Salary Settlement</th>

                                        <th><a href="javascript:void(0);" class="btn btn-danger add_row">+</th>

                                    </tr>

                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($_POST['save'])) {

                                        if (!isset($f_length) || $f_length == 0):

                                            $f_length = 1;

                                        endif;
                                    }

                                    else {

                                        $f_length = count($family);
                                    }

                                    for ($len = 0; $len < $f_length; $len++) {



                                        $per = "";

                                        $checked = FALSE;

                                        if (isset($_POST['save'])) {

                                            if (isset($input['family']['percentage'][$len]))
                                                $per = $post['family']['percentage'][$len];



                                            if (isset($input["family"]["nominee"][$len])) {

                                                $checked = TRUE;
                                            }
                                        } else {

                                            if (isset($nominee) && !empty($nominee)) {

                                                foreach ($nominee as $nme) {

                                                    if ($nme["family_member_id"] == $family[$len]['id']) {

                                                        $per = $nme["percentage"];

                                                        $checked = TRUE;
                                                    }
                                                }
                                            }
                                        }
                                        ?>

                                        <tr>

                                            <td class="center sno"><?php echo $len + 1 ?></td>

                                            <td class="center"> <?php
                                                $data = array(
                                                    'name' => 'family[name][]',
                                                    'class' => 'input-small required alphabet',
                                                    'value' => isset($_POST['save']) ? $post['family']['name'][$len] : $family[$len]['name']
                                                );

                                                echo form_input($data);
                                                ?></td>

                                            <td class="center"><?php
                                                $options = array("" => "select");

                                                if (isset($relations) && !empty($relations)) {

                                                    foreach ($relations as $rel) {

                                                        $options[$rel["value"]] = ucwords($rel["value"]);
                                                    }
                                                }

                                                $def = "";

                                                if (isset($_POST['save'])) {

                                                    $def = $post['family']['relation'][$len];
                                                } else {

                                                    $def = $family[$len]['relation'];
                                                }

                                                echo form_dropdown('family[relation][]', $options, $def, 'class="required"');
                                                ?></td>



                                            <td class="center">

                                                <?php
                                                /* 	$date_birth = date('d-m-Y',strtotime($family[$len]['dob']));

                                                  if($date_birth=="01-01-1970")

                                                  $date_birth = ''; */

                                                $data = array(
                                                    'name' => 'family[age][]',
                                                    'class' => 'input-small required age numeric',
                                                    'value' => isset($_POST['save']) ? $post['family']['age'][$len] : $family[$len]['age']
                                                );

                                                echo form_input($data);
                                                ?>

                                            </td>

                                            <td class="center"><?php
                                                $data = array(
                                                    'name' => 'family[designation][]',
                                                    'class' => 'input-small alphabet',
                                                    'value' => isset($_POST['save']) ? $post['family']['designation'][$len] : $family[$len]['designation']
                                                );

                                                echo form_input($data);
                                                ?></td>

                                            <td class="center"> <?php
                                                $data = array(
                                                    'name' => 'family[monthly_income][]',
                                                    'class' => 'input-small float',
                                                    'value' => isset($_POST['save']) ? $post['family']['monthly_income'][$len] : $family[$len]['monthly_income']
                                                );

                                                echo form_input($data);
                                                ?></td>

                                            <td class="center hide"> <?php
                                                $data = array(
                                                    'name' => 'family[percentage][' . $len . ']',
                                                    'class' => 'input-small numeric percentage',
                                                    'value' => $per
                                                );

                                                echo form_input($data);
                                                ?></td>

                                            <td class="center hide">

                                                <?php
                                                $data = array(
                                                    'name' => 'family[nominee][' . $len . ']',
                                                    'value' => 1,
                                                    'class' => "nominee",
                                                    'checked' => $checked
                                                );

                                                echo form_checkbox($data);
                                                ?>

                                            </td>

                                            <td class="center">

                                                <?php
                                                $selected = FALSE;

                                                if (isset($_POST['save'])) {

                                                    if (isset($input["wages"]["family_member_id"]) && $input["wages"]["family_member_id"] == $len)
                                                        $selected = TRUE;
                                                }

                                                else {

                                                    if (isset($share) && !empty($share)) {

                                                        if ($share[0]["family_member_id"] == $family[$len]['id']) {

                                                            $selected = TRUE;
                                                        }
                                                    }
                                                }

                                                $data = array(
                                                    'name' => 'wages[family_member_id]',
                                                    'value' => $len,
                                                    'class' => "radio-address",
                                                    'checked' => $selected,
                                                    'type' => 'radio'
                                                );

                                                echo form_checkbox($data);
                                                ?>



                                            </td>

                                            <?php
                                            if ($len == 0)
                                                $style = "visibility:hidden;";
                                            else
                                                $style = "visibility:visible;";
                                            ?>

                                            <td class="center"><a href="javascript:void(0);" class="btn btn-danger remove_row" style="<?php echo $style; ?>"><i class="icon-minus icon-black"></i></a></td>

                                        </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                            <?php
                            $style = "display:none";

                            if (isset($_POST['save'])) {

                                if (isset($input["wages"]["family_member_id"]))
                                    $style = "display:block";
                            }

                            else {



                                if (!empty($share)) {

                                    $style = "display:block";
                                }
                            }
                            ?>
                            <h4 class="head-title" style="<?= $style ?>" id="address-title">Salary Settlement Address</h4>

                            <table style="<?= $style ?>" id="address" width="100%">

                                <tbody>

                                    <tr>

                                        <td width="20%" class="address-head">Address:</td>

                                        <td width="70%"><?php
                                            $uline1 = $ucity = $uzip = "";

                                            if (isset($_POST['save'])) {

                                                $uline1 = $input["wages"]["address"];

                                                $ucity = $input["wages"]["city"];

                                                $uzip = $input["wages"]["zip"];
                                            } else {

                                                if (isset($share)) {

                                                    $uline1 = ucwords($share[0]["address"]);



                                                    $ucity = ucwords($share[0]["city"]);

                                                    $uzip = $share[0]["zip"];
                                                }
                                            }

                                            $data = array(
                                                'name' => 'wages[address]',
                                                'class' => 'input-large required wage-address',
                                                'value' => $uline1,
                                                'rows' => 3,
                                                'cols' => 5
                                            );



                                            echo form_textarea($data);
                                            ?>

                                        </td>

                                    </tr>

                                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>

                                    <tr>

                                        <td class="address-head">City:</td>

                                        <td><?php
                                            $data = array(
                                                'name' => 'wages[city]',
                                                'class' => 'input-large required alphabet wage-address',
                                                'value' => $ucity
                                            );



                                            echo form_input($data);
                                            ?>

                                        </td>

                                    </tr>

                                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>

                                    <tr>

                                        <td class="address-head">Pincode:</td>

                                        <td><?php
                                            $data = array(
                                                'name' => 'wages[zip]',
                                                'class' => 'input-large required numeric wage-address',
                                                'value' => $uzip
                                            );



                                            echo form_input($data);
                                            ?>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>
                        <div class="tab-pane" id="tabs-6" role="tabpanel" aria-labelledby="tabs-6-tab">
                            <table class="table table-bordered">
                                <thead>

                                    <tr>

                                        <th>S.No</th>

                                        <th>Languages</th>

                                        <th>Speak</th>

                                        <th>Read</th>

                                        <th>Write</th>

                                        <th><a href="javascript:void(0);" class="btn btn-danger add_row">+</th>

                                    </tr>

                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($_POST['save'])) {

                                        if (!isset($l_length) || $l_length == 0):

                                            $l_length = 1;

                                        endif;
                                    }

                                    else {

                                        $l_length = count($lang);
                                    }

                                    $k = 0;

                                    for ($len = 0; $len < $l_length; $len++) {
                                        ?>

                                        <tr>



                                            <td class="center sno"><?= $len + 1 ?></td>

                                            <td class="center"><?php
                                                $data = array(
                                                    'name' => 'lang[language][]',
                                                    'class' => 'input-small required lang',
                                                    'value' => isset($_POST['save']) ? $post['lang']['language'][$len] : $lang[$len]['language']
                                                );

                                                echo form_input($data);

                                                // echo set_value('lang[rws][]');
                                                //echo "<pre>";

                                                $read = $write = $speak = FALSE;

                                                if (isset($_POST['save'])) {

                                                    $rws = $_POST['lang']['rws'];
                                                } else {

                                                    $rws1 = explode(":", $lang[$len]['rws']);
                                                }

                                                //echo "speak:".$speak." read:" .$read." write:".$write." ";
                                                ?>

                                            </td>

                                            <td class="center"><span class=""><?php
                                                    if (isset($rws)) {

                                                        if ($rws[$k] == 1)
                                                            $speak = TRUE;
                                                    }

                                                    else {

                                                        if ($rws1[0] == 1)
                                                            $speak = TRUE;
                                                    }

                                                    $data = array(
                                                        'class' => 'input-small required-check',
                                                        'value' => 0,
                                                        'checked' => $speak
                                                    );
                                                    echo form_checkbox($data);

                                                    if (isset($_POST['save']))
                                                        echo form_hidden('lang[rws][]', $rws[$k++]);
                                                    else
                                                        echo form_hidden('lang[rws][]', $rws1[0]);
                                                    ?>



                                                </span></td>

                                            <td class="center"><span class=""><?php
                                                    if (isset($rws)) {

                                                        if ($rws[$k] == 1)
                                                            $read = TRUE;
                                                    }

                                                    else {

                                                        if (isset($rws1[1]) && $rws1[1] == 1)
                                                            $read = TRUE;
                                                    }

                                                    $data = array(
                                                        'class' => 'input-small required-check',
                                                        'value' => 0,
                                                        'checked' => $read
                                                    );
                                                    echo form_checkbox($data);

                                                    if (isset($_POST['save']))
                                                        echo form_hidden('lang[rws][]', $rws[$k++]);

                                                    else if (isset($rws1[1]))
                                                        echo form_hidden('lang[rws][]', $rws1[1]);
                                                    else
                                                        echo form_hidden('lang[rws][]', '');
                                                    ?></span></td>

                                            <td class="center"><span class=""><?php
                                                    if (isset($rws)) {

                                                        if ($rws[$k] == 1)
                                                            $write = TRUE;
                                                    }

                                                    else {

                                                        if (isset($rws1[2]) && $rws1[2] == 1)
                                                            $write = TRUE;
                                                    }

                                                    $data = array(
                                                        'class' => 'input-small required-check',
                                                        'value' => 0,
                                                        'checked' => $write
                                                    );
                                                    echo form_checkbox($data);

                                                    if (isset($_POST['save']))
                                                        echo form_hidden('lang[rws][]', $rws[$k++]);

                                                    else if (isset($rws1[2]))
                                                        echo form_hidden('lang[rws][]', $rws1[2]);
                                                    else
                                                        echo form_hidden('lang[rws][]', '');
                                                    ?></span> </td>

                                            <?php
                                            if ($len == 0)
                                                $style = "visibility:hidden;";
                                            else
                                                $style = "visibility:visible;";
                                            ?>

                                            <td class="center"><a href="javascript:void(0);" class="btn btn-danger remove_row" style="<?php echo $style; ?>"><i class="icon-minus icon-black"></i></a></td>

                                        </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="tabs-7" role="tabpanel" aria-labelledby="tabs-7-tab">
                            <table class="table table-bordered">

                                <thead>

                                    <tr>

                                        <th style="text-align:center;">

                                            Identification 1

                                        </th>

                                        <th style="text-align:center;">

                                            Identification 2

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td style="text-align:center;">

                                            <?php
                                            $data = array(
                                                'name' => 'identification_marks[identification_mark][]',
                                                'class' => 'input-large required alphabet',
                                                'value' => isset($_POST['save']) ? $post['identification_marks']['identification_mark'][0] :
                                                        $identification[0]['identification_mark']
                                            );
                                            echo form_input($data);
                                            ?>



                                        </td>

                                        <td style="text-align:center;">

                                            <?php
                                            $data = array(
                                                'name' => 'identification_marks[identification_mark][]',
                                                'class' => 'input-large required alphabet',
                                                'value' => isset($_POST['save']) ? $post['identification_marks']['identification_mark'][1] :
                                                        $identification[1]['identification_mark']
                                            );
                                            echo form_input($data);
                                            ?>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>
                        </div>
                        <div class="tab-pane" id="tabs-8" role="tabpanel" aria-labelledby="tabs-8-tab">
                            <table class="table table-bordered">

                                <thead>

                                    <tr>

                                        <th>S.No</th>

                                        <th>Name</th>

                                        <th>Relation</th>

                                        <th>Company Name</th>

                                        <th>Address</th>

                                        <th>Phone No</th>



                                    </tr>

                                </thead>

                                <tbody>

                                    <?php
                                    if (isset($input["ref"])) {

                                        if (!isset($ref_length) || $ref_length == 0):

                                            $ref_length = 2;

                                        endif;
                                    }

                                    else {

                                        $ref_length = count($ref);
                                    }

                                    for ($len = 0; $len < 2; $len++) {
                                        ?>

                                        <tr>

                                            <td class="center sno"><?= $len + 1; ?></td>

                                            <td class="center"><?php
                                                $data = array(
                                                    'name' => 'ref[name][]',
                                                    'class' => 'input-small required alphabet',
                                                    'value' => isset($_POST['save']) ? $post['ref']['name'][$len] : $ref[$len]['name']
                                                );

                                                echo form_input($data);
                                                ?></td>

                                            <td class="center"><?php
                                                $data = array(
                                                    'name' => 'ref[relation][]',
                                                    'class' => 'input-small required alphabet',
                                                    'value' => isset($_POST['save']) ? $input['ref']['relation'][$len] : $ref[$len]['relation']
                                                );

                                                echo form_input($data);
                                                ?></td>

                                            <td class="center"><?php
                                                $data = array(
                                                    'name' => 'ref[company_name][]',
                                                    'class' => 'input-small required character',
                                                    'value' => isset($_POST['save']) ? $post['ref']['company_name'][$len] : $ref[$len]['company_name']
                                                );
                                                echo form_input($data);
                                                ?></td>

                                            <td class="center"><?php
                                                $data = array(
                                                    'name' => 'ref[city][]',
                                                    'class' => 'input-large required alphabet',
                                                    'value' => isset($_POST['save']) ? $post['ref']['city'][$len] : $ref[$len]['city']
                                                );
                                                echo form_input($data);
                                                ?></td>

                                            <td class="center"><?php
                                                $data = array(
                                                    'name' => 'ref[contact_no][]',
                                                    'class' => 'input-small required numeric',
                                                    'value' => isset($_POST['save']) ? $post['ref']['contact_no'][$len] : $ref[$len]['contact_no']
                                                );
                                                echo form_input($data);
                                                ?></td>

                                            <?php
                                            if ($len == 0)
                                                $style = "visibility:hidden;";
                                            else
                                                $style = "visibility:visible;";
                                            ?>



                                        </tr>

                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>
                        <div class="tab-pane" id="tabs-9" role="tabpanel" aria-labelledby="tabs-9-tab">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>S.No</th>

                                        <th>Company</th>

                                        <th>Designation</th>

                                        <th>Start Date</th>

                                        <th>End Date</th>

                                        <th>Salary</th>

                                        <th>Reason for Leaving</th>

                                        <th><a href="javascript:void(0);" class="btn btn-danger add_row">+</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php
                                    if (!isset($exp_length) || $exp_length == 0):

                                        $exp_length = 1;

                                    endif;

                                    for ($len = 0; $len < $exp_length; $len++) {
                                        ?>

                                        <tr>

                                            <td class="center sno"><?= $len + 1; ?></td>

                                            <td class="center">

                                                <?php
                                                $data = array(
                                                    'name' => 'exp[company][]',
                                                    'class' => 'input-small required character',
                                                    'value' => isset($_POST['save']) ? $post['exp']['company'][$len] : $exp[$len]['company']
                                                );

                                                echo form_input($data);
                                                ?>



                                            </td>

                                            <td class="center">

                                                <?php
                                                $data = array(
                                                    'name' => 'exp[designation][]',
                                                    'class' => 'input-small required alphabet',
                                                    'value' => isset($_POST['save']) ? $post['exp']['designation'][$len] : $exp[$len]['designation']
                                                );

                                                echo form_input($data);
                                                ?>



                                            </td>

                                            <td class="center">

                                                <?php
                                                $date_start = date('d-m-Y', strtotime($exp[$len]['start_date']));

                                                if ($date_start == "01-01-1970")
                                                    $date_start = '';

                                                $data = array(
                                                    'name' => 'exp[start_date][]',
                                                    'readonly' => 'readonly',
                                                    'class' => 'input-small datepicker required start_date input-date',
                                                    'value' => isset($_POST['save']) ? $post['exp']['start_date'][$len] : $date_start
                                                );

                                                echo form_input($data);
                                                ?>



                                            </td>

                                            <td class="center">

                                                <?php
                                                $date_end = date('d-m-Y', strtotime($exp[$len]['end_date']));

                                                if ($date_end == "01-01-1970")
                                                    $date_end = '';

                                                $data = array(
                                                    'name' => 'exp[end_date][]',
                                                    'readonly' => 'readonly',
                                                    'class' => 'input-small datepicker required end_date input-date',
                                                    'value' => isset($_POST['save']) ? $post['exp']['end_date'][$len] : $date_end
                                                );

                                                echo form_input($data);
                                                ?>



                                            </td>

                                            <td class="center">

                                                <?php
                                                $data = array(
                                                    'name' => 'exp[salary][]',
                                                    'class' => 'input-small required float',
                                                    'value' => isset($_POST['save']) ? $post['exp']['salary'][$len] : $exp[$len]['salary']
                                                );

                                                echo form_input($data);
                                                ?>

                                            </td>

                                            <td class="center"><?php
                                                $data = array(
                                                    'name' => 'exp[reason_for_leaving][]',
                                                    'class' => 'input-small required character',
                                                    'value' => isset($_POST['save']) ? $post['exp']['reason_for_leaving'][$len] : $exp[$len]['reason_for_leaving']
                                                );

                                                echo form_input($data);
                                                ?></td>

                                            <?php
                                            if ($len == 0)
                                                $style = "visibility:hidden;";
                                            else
                                                $style = "visibility:visible;";
                                            ?>

                                            <td class="center"><a href="javascript:void(0);" class="btn btn-danger remove_row" style="<?= $style ?>"><i class="icon-minus icon-black"></i></a></td>

                                        </tr>

                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php
    if (isset($_GET['show'])) {

        $user_show = $_GET['show'];
    } else
        $user_show = 10;
    ?>
    <div class="button_right_align action-btn-align">

        <?php
        $data = array(
            'name' => 'save',
            'value' => 'Save',
            'class' => 'btn btn-success border4 submit',
            'title' => 'Save'
        );



        echo form_submit($data);
        ?>

        <a href="<?= $this->config->item('base_url') . "masters/biometric/employees" ?>" title="Back"><input type="button" class="btn btn-danger border4" value="Cancel" /></a>

    </div>
</div>




