<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script type="text/javascript" src="<?= $theme_path; ?>/js/department.js"></script>

<div class="contentinner">
    <div class="media mt--20">
        <h4 class="widgettitle">Edit Public Holiday</h4>
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
        <div class="panel-body mt-top5">
            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>S.No</th>

                        <th>Reason <span class="req">*</span></th>

                        <th>From Date <span class="req">*</span></th>

                        <th>To Date <span class="req">*</span></th>

                        <th>Department <span class="req">*</span></th>

             <!--<th><a href="javascript:void(0);" class="btn btn-danger add_row"><i class="icon-plus icon-black"></i></a></th>-->

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td class="center">1</td>

                        <td class="center"><?php
                            $data = array(
                                'name' => 'holiday[reason]',
                                'value' => isset($_POST['save']) ? $post['reason'] : $holiday[0]['reason'],
                                'class' => 'required'
                            );

                            echo form_input($data);
                            ?></td>

                        <td class="center"><?php
                            $data = array(
                                'name' => 'holiday[holiday_from]',
                                'readonly' => 'readonly',
                                'value' => isset($_POST['save']) ? $post['holiday_from'] : $holiday[0]['from_date'],
                                'class' => 'required input-small datepicker hl_start_date hol-wid'
                            );

                            echo form_input($data);
                            ?></td>

                        <td class="center"><?php
                            $data = array(
                                'name' => 'holiday[holiday_to]',
                                'readonly' => 'readonly',
                                'value' => isset($_POST['save']) ? $post['holiday_to'] : $holiday[0]['to_date'],
                                'class' => 'required input-small datepicker hl_end_date hol-wid'
                            );



                            echo form_input($data);
                            ?></td>



                        <td class="center">

                            <?php
                            if (isset($departments) && !empty($departments)) {

                                foreach ($departments as $dept) {

                                    $options[$dept['id']] = ucwords($dept['name']);
                                }
                            }



                            $default = array();

                            if (isset($_POST['save'])) {

                                //$default = $post["department"];

                                if (isset($post["department"]) && !empty($post["department"])) {

                                    foreach ($post["department"] as $val) {



                                        $default[] = $val;
                                    }
                                }
                            } else {

                                if (isset($depts) && !empty($depts)) {

                                    $default = array();

                                    foreach ($depts as $dep) {

                                        $default[] = $dep["department"];
                                    }
                                } else
                                    $default[] = $holiday['department'];
                            }

                            //print_r($default);

                            echo form_multiselect('holiday[department][]', $options, $default, 'class="required uniformselect"');
                            ?>

                        </td>

             <!--<td>&nbsp;</td>-->

                    </tr>

                </tbody>

            </table>

            <?php
            if (isset($_GET["page"])) {

                echo "<input type='hidden' name='page' value='home'>";
            }
            ?>



            <div class="button_right_align action-btn-align">  <?php
                $data = array(
                    'name' => 'save',
                    'value' => 'Update',
                    'class' => 'btn btn-info border4 submit',
                    'title' => 'Update'
                );



                echo form_submit($data);

                $url = $this->config->item('base_url') . "masters/biometric/public_holidays/";

                if (isset($_GET["page"]))
                    $url = $this->config->item('base_url') . "masters/biometric/view_public_holiday/" . $holiday[0]['id'];
                ?>

                <a href="<?= $url ?>" title="Cancel" ><input type="button" class="btn btn-danger border4" value="Cancel" /></a></div>

        </div>
    </div>
</div><!--contentinner-->

<script type="text/javascript">



    /*For Public Holidays Module*/

    $(".hl_end_date").live('change', function () {

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



    $(".hl_start_date").live('change', function () {

        $(this).closest("tr").find("input.hl_end_date").val('')

    });



</script>
