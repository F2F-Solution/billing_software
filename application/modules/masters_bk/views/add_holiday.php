<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script type="text/javascript" src="<?= $theme_path; ?>/js/department.js"></script>
<div class="contentinner">
    <div class="media mt--20">
        <h4 class="widgettitle">Public Holidays Add</h4>
    </div>
    <div class="widgetcontent">

        <?php
        $result = validation_errors();

        if (trim($result) != ""):
            ?>

            <div class="alert alert-error">

                <button data-dismiss="alert" class="close" type="button">&times;</button>

                <?php echo implode("</p>", array_unique(explode("</p>", validation_errors()))); ?>



            </div>

        <?php endif; ?>



        <?php
        $attributes = array('class' => 'stdform editprofileform', 'method' => 'post');



        echo form_open('', $attributes);
        ?>

        <div class="scroll_bar">
            <div class="panel-body mt-top5">
                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>S.No</th>

                            <th>Reason <span class="req">*</span></th>

                            <th>From Date <span class="req">*</span></th>

                            <th>To Date <span class="req">*</span></th>

                            <th>Department <span class="req">*</span></th>

                            <th><a href="javascript:void(0);" class="btn btn-danger add_row">+</a></th>

                        </tr>

                    </thead>

                    <tbody>



                        <?php
                        if (!isset($holiday_length)):

                            $holiday_length = 1;

                        endif;

                        for ($i = 0; $i < $holiday_length; $i++) {
                            ?>

                            <tr>

                                <td class="center sno">1</td>

                                <td class="center"><?php
                                    $data = array(
                                        'name' => 'holiday[reason][]',
                                        'value' => isset($_POST['save']) ? $post['reason'][$i] : "",
                                        'class' => 'required'
                                    );

                                    echo form_input($data);
                                    ?></td>

                                <td class="center"><?php
                                    $data = array(
                                        'name' => 'holiday[holiday_from][]',
                                        'readonly' => 'readonly',
                                        'value' => isset($_POST['save']) ? $post['holiday_from'][$i] : "",
                                        'class' => 'required input-small datepicker hl_start_date'
                                    );

                                    echo form_input($data);
                                    ?></td>

                                <td class="center"><?php
                                    $data = array(
                                        'name' => 'holiday[holiday_to][]',
                                        'readonly' => 'readonly',
                                        'value' => isset($_POST['save']) ? $post['holiday_to'][$i] : "",
                                        'class' => 'required input-small datepicker hl_end_date'
                                    );

                                    echo form_input($data);
                                    ?></td>



                                <td class="center">

                                    <?php
                                    $default = array();

                                    if (isset($_POST['save'])) {

                                        //$default = $post["department"];

                                        if (isset($post["department"][$i]) && !empty($post["department"][$i])) {

                                            foreach ($post["department"][$i] as $val) {

                                                $default[] = $val;
                                            }
                                        }
                                    }

                                    //print_r($default);

                                    if (isset($departments) && !empty($departments)) {

                                        foreach ($departments as $dept) {

                                            $options[$dept['id']] = ucwords($dept['name']);
                                        }
                                    } else {

                                        $options = array();
                                    }

                                    echo form_multiselect('holiday[department][' . $i . '][]', $options, $default, 'class="dept required uniformselect form-control"');
                                    ?>

                                </td>

                                <td class="center">

                                    <?php
                                    if ($i == 0)
                                        $style = "visibility:hidden;";
                                    else
                                        $style = "visibility:visible;";
                                    ?>

                                    <a href="javascript:void(0);" class="btn btn-danger remove_row" style="<?php echo $style; ?>"><i class="fa fa-minus fa-black"></i></a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>




                <div class="button_right_align action-btn-align">  <?php
                    $data = array(
                        'name' => 'save',
                        'value' => 'Save',
                        'class' => 'btn btn-success border4 submit',
                        'title' => 'Save'
                    );



                    echo form_submit($data);
                    ?>

                    <a href="<?= $this->config->item('base_url') . "masters/biometric/public_holidays/" ?>" title="Cancel"><input type="button" class="btn btn-danger border4" value="Cancel" /></a></div>
            </div>
        </div>
    </div>

</div><!--contentinner-->

<script type="text/javascript">

    $(document).ready(function () {
        $('.dept').select2();

    });


    /*For Public Holidays Module*/

    $(".hl_end_date").on('change', function () {

        var start_date = $(this).closest("tr").find("input.hl_start_date").val().split("-");

        var end_date = $(this).val().split("-");

        var st = new Date(start_date[2], start_date[1] - 1, start_date[0]);

        var end = new Date(end_date[2], end_date[1] - 1, end_date[0]);

        if (st > end)

        {

            alert("To date must be equal/greater than from date");

            $(this).val('');

        }

    });



    $(".hl_start_date").on('change', function () {

        $(this).closest("tr").find("input.hl_end_date").val('')

    });


</script>