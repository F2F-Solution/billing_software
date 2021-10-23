<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?php echo $theme_path; ?>/js/jquery-ui-1.10.3.min.js"></script>
<link href="<?php echo $theme_path; ?>/plugin/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<div class="mainpanel">
    <div class="media">
    </div>
    <div class="contentpanel mb-50">
        <div class="media mt--2">
            <h4>Brand Details</h4>
        </div>
        <div class="panel-body">
            <div class="tabs">
                <ul class="list-inline tabs-nav tabsize-17" role="tablist">

                    <li role="presentation" class="active"><a href="#brand-details" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Brand List</a></li>
                    <li role="presentation" class=""><a href="<?php if ($this->user_auth->is_action_allowed('masters', 'brands', 'add')): ?>#brand<?php endif ?>" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false" class="<?php if (!$this->user_auth->is_action_allowed('masters', 'brands', 'add')): ?>alerts<?php endif ?>">Add Brand</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="brand">
                        <div class="frameset1">
                            <form action="<?php echo $this->config->item('base_url'); ?>masters/brands/insert_brand"  name="form" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Firm Name</label>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select name="firm_id"  class="form-control form-align required" id="firm" >
                                                        <?php
                                                        if (isset($firms) && !empty($firms)) {
                                                            foreach ($firms as $firm) {
                                                                ?>
                                                                <option value="<?php echo $firm['firm_id']; ?>"> <?php echo $firm['firm_name']; ?> </option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <span id="firmerr" class="val"  style="color:#F00; font-style:oblique;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Brand Name<span style="color:#F00; font-style:oblique;">*</span></label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" name="brands" class="brand brandnamedup borderra0 form-align" placeholder=" Enter Brand" id="brandname" maxlength="40" />
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-fa"></i>
                                                    </div>
                                                </div>
                                                <span id="cnameerror" class="reset" style="color:#F00; font-style:italic;"></span>
                                                <span id="dup" class="dup" style="color:#F00; font-style:italic;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="frameset_table action-btn-align">
                                    <input type="submit" value="Save" class="submit btn btn-success" id="submit" />
                                    <input type="reset" value="Clear" class=" btn btn-danger1" id="cancel" />
                                    <a href="<?php echo $this->config->item('base_url') . 'masters/brands' ?>" class="btn btn-defaultback"><span class="glyphicon"></span> Back </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane active tablelist" id="brand-details">
                        <div class="frameset1">
                            <div id="list">
                                <div class="">
                                    <table id="basicTable" class="table table-striped table-bordered responsive dataTable no-footer dtr-inline" >
                                        <thead>
                                        <th>S.No</th>
                                        <th>Firm Name</th>
                                        <th>Brand Name</th>
                                        <th class="action-btn-align">Actions</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($brand) && !empty($brand)) {
                                                $i = 1;
                                                foreach ($brand as $val) {
                                                    ?>
                                                    <tr>
                                                        <td class="first_td"><?php echo "$i"; ?></td>
                                                        <td ><?php echo!empty($val['firm_name']) ? $val['firm_name'] : '-'; ?></td>
                                                        <td ><?php echo ucfirst($val['brands']); ?></td>
                                                        <td class="action-btn-align">

                                                            <a href="<?php if ($this->user_auth->is_action_allowed('masters', 'brands', 'edit')): ?>#test1_<?php echo $val['id']; ?><?php endif ?>" data-toggle="modal" name="edit" class="tooltips btn btn-default btn-xs <?php if (!$this->user_auth->is_action_allowed('masters', 'brands', 'edit')): ?>alerts<?php endif ?>" title="Edit"><span class="fa fa-edit"></span></a>&nbsp;&nbsp;

                                                            <a href="<?php if ($this->user_auth->is_action_allowed('masters', 'brands', 'delete')): ?>#test3_<?php echo $val['id']; ?><?php endif ?>" data-toggle="modal" name="delete" class="tooltips btn btn-default btn-xs <?php if (!$this->user_auth->is_action_allowed('masters', 'brands', 'delete')): ?>alerts<?php endif ?>" title="In-Active"><span class="fa fa-ban"></span></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
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

        <script type="text/javascript">
            $(document).on('click', '.alerts', function () {
                sweetAlert("Oops...", "This Access is blocked!", "error");
                return false;
            });
            $('#brandname').live('blur', function ()
            {
                var cname = $('#brandname').val();
                if (cname == '' || cname == null || cname.trim().length == 0)
                {
                    $('#cnameerror').html("Required Field");
                } else
                {
                    $('#cnameerror').html(" ");
                }
            });


            $('#submit').live('click', function ()
            {
                cname = $.trim($("#brandname").val());
                var firm_id = $.trim($("#firm").val());
                if ($.trim(cname) != '')
                {
                    $.ajax(
                            {
                                url: BASE_URL + "masters/brands/add_duplicate_brandname",
                                type: 'POST',
                                async: false,
                                data: {cname: cname, firm_id: firm_id},
                                success: function (result)
                                {
                                    $("#dup").html(result);
                                }
                            });
                }
                var i = 0;

                $('select.required').each(function () {
                    this_val = $.trim($(this).val());
                    this_id = $(this).attr('id');

                    if (this_val == '') {
                        $('#firmerr').text('Required Field');
                        i = 1;
                    } else {
                        $('#firmerr').text('');

                    }
                });
                var cname = $('#brandname').val();
                if (cname == '' || cname == null || cname.trim().length == 0)
                {
                    $('#cnameerror').html("Required Field");
                    i = 1;
                } else
                {
                    $('#cnameerror').html("");
                }
                var m = $('#dup').html();
                if ((m.trim()).length > 0)
                {
                    i = 1;
                }
                if (i == 1)
                {
                    return false;
                } else
                {
                    return true;

                }
            });
        </script>
        <script type="text/javascript">
            // STYLE NAME DUPLICATION
//            $(".brandnamedup").live('blur', function ()
//            {
//                cname = $.trim($("#brandname").val());
//                var firm_id = $.trim($("#firm").val());
//                if ($.trim(cname) != '')
//
//                {
//
//                    $.ajax(
//                            {
//                                url: BASE_URL + "masters/brands/add_duplicate_brandname",
//                                type: 'POST',
//                                async: false,
//                                data: {cname: cname, firm_id: firm_id},
//                                success: function (result)
//                                {
//                                    $("#dup").html(result);
//                                }
//                            });
//                }
//            });

        </script>
        <br />

        <?php
        if (isset($brand) && !empty($brand)) {
            foreach ($brand as $val) {
                ?>

                <div id="test1_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1"
                     role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
                    <div class="modal-dialog">
                        <div class="modal-content modalcontent-top">
                            <div class="modal-header modal-padding modalcolor"><a class="close modal-close closecolor" data-dismiss="modal"><i class="fa fa-times"></i></a>
                                <h3 id="myModalLabel" style="color:white;margin-top:10px">Update Brand</h3>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <table class="table" width="60%">
                                        <tr>
                                            <td><input type="hidden" name="id" class="id form-control id_update" id="id" value="<?php echo $val["id"]; ?>" readonly="readonly" /></td>
                                        </tr>
                                        <tr>
                                            <td width="12%"><b>Firm</b></td>
                                            <td width="18%">
                                                <div class="">
                                                    <select name="firm_id"  class="form-control form-align required firm" id="firm" >
                                                        <option value="">Select</option>
                                                        <?php
                                                        if (isset($firms) && !empty($firms)) {
                                                            foreach ($firms as $firm) {
                                                                $select = ($firm['firm_id'] == $val['firm_id']) ? 'selected' : '';
                                                                ?>
                                                                <option value="<?php echo $firm['firm_id']; ?>" <?php echo $select; ?>> <?php echo $firm['firm_name']; ?> </option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <span id="firmerr" class="val firmerr"  style="color:#F00; font-style:oblique;"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Brand Name</strong></td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="brand form-control colornameup colornamecup brandnameup borderra0 form-align" name="brands"
                                                           value="<?php echo $val["brands"]; ?>" id="colornameup" maxlength="40" /><input type="hidden" class="root1_h"  value="<?php echo $val["brand"]; ?>"  />
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-fa"></i>
                                                    </div>
                                                </div>
                                                <span id="cnameerrorup" class="cnameerrorup" style="color:#F00; font-style:italic;"></span>
                                                <span id="dupup" class="dupup" style="color:#F00; font-style:italic;"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <div class="modal-footer action-btn-align">
                                <button type="button" class="edit btn btn-info1 "  id="edit">Update</button>
                                <button type="reset" class="btn btn-danger1 "  id="no" data-dismiss="modal"> Discard</button>
                            </div>
                        </div>
                    </div>
                </div>


                <script type="text/javascript">
                    $('.brandnamecup').live('change', function ()
                    {
                        var cname = $(this).parent().parent().find(".$brandnamecup").val();
                        //var sname=$('.style_nameup').val();
                        var m = $(this).offsetParent().find('.cnameerrorup');
                        if (cname == '' || cname == null || cname.trim().length == 0)
                        {
                            m.html("Required Field");
                        } else
                        {
                            m.html("");
                        }
                    });
                    $(document).ready(function ()
                    {
                        $('#no').live('click', function ()
                        {
                            var root_h = $(this).parent().parent().parent().find('.root1_h').val();
                            $(this).parent().parent().find('.brandnameup').val(root_h);
                            var m = $(this).offsetParent().find('.cnameerrorup');
                            var message = $(this).offsetParent().find('.dupup');
                            //var message=$(this).parent().parent().find('.dupup').html();
                            m.html("");
                            message.html("");
                        });
                    });
                </script>
                <script type="text/javascript">
                    $(".brandnameup").live('blur', function ()
                    {
        //                        alert("hi");
                        var cname = $.trim($(this).parent().parent().find('.brandnameup').val());
                        var id = $(this).offsetParent().find('.id_update').val();
                        var message = $(this).offsetParent().find('.dupup');
                        $.ajax(
                                {
                                    url: BASE_URL + "masters/brands/update_duplicate_brandname",
                                    type: 'get',
                                    data: {value1: cname, value2: id},
                                    success: function (result)
                                    {
                                        if (cname != '') {
                                            message.html(result);
                                        } else {
                                            message.html('');
                                        }
                                    }
                                });
                    });
                </script>
                <?php
            }
        }
        ?>


        <?php
        if (isset($brand) && !empty($brand)) {
            foreach ($brand as $val) {
                ?>
                <div id="test3_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
                    <div class="modal-dialog">
                        <div class="modal-content modalcontent-top">
                            <div class="modal-header modal-padding modalcolor"> <a class="close modal-close closecolor" data-dismiss="modal"><i class="fa fa-times"></i>"</a>

                                <h3 id="myModalLabel" class="inactivepop">In-Active Brand</h3>

                            </div>
                            <div class="modal-body">
                                Do You Want In-Active? &nbsp; <strong><?php echo $val["brand"]; ?></strong>
                                <input type="hidden" value="<?php echo $val['id']; ?>" class="hidin" />
                            </div>
                            <div class="modal-footer action-btn-align">
                                <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
                                <button type="button" class="btn btn-danger1 delete_all"  data-dismiss="modal" id="no">No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<script type="text/javascript">
    $("#edit").live("click", function ()
    {
        var cname = $.trim($(this).parent().parent().find('.brandnameup').val());
        var ids = $(this).offsetParent().find('.id_update').val();
        var message = $(this).offsetParent().find('.dupup');
        $.ajax(
                {
                    url: BASE_URL + "masters/brands/update_duplicate_brandname",
                    type: 'get',
                    async: false,
                    data: {value1: cname, value2: ids},
                    success: function (result)
                    {
                        if (cname != '') {
                            message.html(result);
                        } else {
                            message.html('');
                        }
                    }
                });
        var i = 0;
        var id = $(this).parent().parent().find('.id').val();
        var brand = $(this).parent().parent().find(".brand").val();
        var firm = $(this).parent().parent().find("select.required").val();
        if (firm == '') {
            $(this).parent().parent().find(".firmerr").text('Required Field');
            i = 1;
        } else {
            $(this).parent().parent().find(".firmerr").text(' ');
        }


        var m = $(this).offsetParent().find('.cnameerrorup');
        //var message=$(this).offsetParent().find('.dupup');
        var message = $(this).parent().parent().find('.dupup').html();
        if ((message.trim()).length > 0)
        {
            i = 1;
        }
        if (brand == '' || brand == null || brand.trim().length == 0)
        {
            m.html("Required Field");
            i = 1;
        } else
        {
            m.html("");
        }
        if (i == 1)
        {
            return false;
        } else
        {
            $.ajax({
                url: BASE_URL + "masters/brands/update_brand",
                type: 'POST',
                data: {value1: id, value2: brand, firm: firm},
                success: function (result)
                {
                    window.location.reload(BASE_URL + "index/");
                }
            });
        }
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");
    });
</script>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $(".delete_yes").live("click", function ()
        {

            var hidin = $(this).parent().parent().find('.hidin').val();

            $.ajax({
                url: BASE_URL + "masters/brands/delete_master_brand",
                type: 'get',
                data: {value1: hidin},
                success: function (result) {

                    window.location.reload(BASE_URL + "master_brand/");
                }
            });

        });

        $('.modal').css("display", "none");
        $('.fade').css("display", "none");

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#cancel').live('click', function ()
        {
            $('.reset').html("");
            $('.dup').html("");
        });
    });
</script>