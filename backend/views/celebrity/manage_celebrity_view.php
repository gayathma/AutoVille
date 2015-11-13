<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Manage Celebrity
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="clearfix">
                        <div class="btn-group">
                            <a id="editable-sample_new" class="btn btn-shadow btn-primary" href="#celebrity_add_modal" data-toggle="modal">
                                Add New
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <table  class="display table table-bordered table-striped" id="celebrity_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vehicle</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Active Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($results as $result) {
                                ?>
                                <tr id="celebrity_<?php echo $result->id; ?>">
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo ($result->manufacture . ' ' . $result->model . ' ' . $result->year); ?></td>
                                    <td><?php echo $result->name; ?></td>
                                    <td><?php echo $result->description; ?></td>
                                    <td align="center"><img src="<?php echo base_url(); ?>uploads/celebrity/<?php echo $result->image; ?>" width="60px" /></td>
                                    <td align="center">
                                        <?php if ($result->is_published) { ?>
                                            <a class="btn btn-success btn-xs" onclick="change_publish_status(<?php echo $result->id; ?>, 0, this)" title="click to deactivate celebrity"><i class="fa fa-check"></i></a> 
                                        <?php } else { ?> 
                                            <a class="btn btn-warning btn-xs" onclick="change_publish_status(<?php echo $result->id; ?>, 1, this)" title="click to activate celebrity"><i class="fa fa-exclamation-circle"></i></a> 
                                        <?php } ?>
                                    </td>
                                    <td align="center">
    <!--                                        <a href="<?php echo site_url(); ?>/manufacture/manage_manufactures" class="btn btn-success btn-xs"><i class="fa fa-pencil"  data-original-title="Update"></i></a>-->
                                        <a class="btn btn-primary btn-xs" onclick="display_edit_celebrity_pop_up(<?php echo $result->id; ?>)"><i class="fa fa-pencil" data-original-title="Update"></i> </a>
                                        <a class="btn btn-danger btn-xs" onclick="delete_celebrity(<?php echo $result->id; ?>)" ><i class="fa fa-trash-o " title="" data-original-title="Remove"></i></a>

                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<!--Celebrity add model-->
<div class="modal fade " id="celebrity_add_modal" tabindex="-1" role="dialog" aria-labelledby="celebrity_add_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add New Celebrity</h4>
            </div>
            <form id="add_celebrity_form" name="add_celebrity_form">
                <div class="modal-body">
                    <script src="<?php echo base_url(); ?>backend_resources/file_upload_plugin/ajaxupload.3.5.js" type="text/javascript"></script>
                    <script>
                                            //upload manufacture logo

                                            $(function () {
                                                var btnUpload = $('#upload');
                                                var status = $('#status');
                                                new AjaxUpload(btnUpload, {
                                                    action: '<?php echo site_url(); ?>/celebrity/upload_celebrity_logo',
                                                    name: 'uploadfile',
                                                    onSubmit: function (file, ext) {
                                                        if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                                                            // extension is not allowed 
                                                            status.text('Only JPG, PNG or GIF files are allowed');
                                                            return false;
                                                        }
                                                        //status.text('Uploading...Please wait');
                                                        //                                            $("#files").html("<i id='animate-icon' class='fa fa-spinner fa fa-2x fa-spin'></i>");

                                                    },
                                                    onComplete: function (file, response) {
                                                        //On completion clear the status
                                                        //status.text('');
                                                        $("#files").html("");
                                                        $("#sta").html("");
                                                        //Add uploaded file to list
                                                        if (response != "error") {
                                                            $('#files').html("");
                                                            $('<div></div>').appendTo('#files').html('<img src="<?php echo base_url(); ?>uploads/celebrity/' + response + '"   width="100px" height="68px" /><br />');
                                                            picFileName = response;
                                                            document.getElementById('logo').value = response;
                                                            //                    document.getElementById('cover_image').value = response;
                                                        } else {
                                                            $('<div></div>').appendTo('#files').text(file).addClass('error');
                                                        }
                                                    }
                                                });

                                            });


                    </script>
                  <div class="form-group">                       
                        <label for="name">Manufacture<span class="mandatory">*</span></label>
                        <select class="form-control" name="manufacture" id="manufacture" title="This field is required." data-live-search="true" class="live_select" >
                            <option value="" selected>Select Manufacturer</option>
                            <?php foreach ($manufactures as $manufacture) { ?>
                                <option value="<?php echo $manufacture->id; ?>"><?php echo $manufacture->name; ?></option>
                            <?php } ?>
                        </select>                        
                    </div>

                    <div class="form-group">
                        <label for="name">Model<span class="mandatory">*</span></label>
                        <select class="form-control" name="model" id="model" title="This field is required." data-live-search="true" class="live_select" >
                            <option value="" selected>Select Model</option>
                            <?php foreach ($models as $model) { ?>
                                <option value="<?php echo $model->id; ?>"><?php echo $model->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fabrication">Fabrication</label>
                        <select class="form-control" name="fabrication" id="fabrication" title="This field is required."  data-live-search="true">
                            <option value="">Select Fabrication</option>
                            <option value="1990">1990</option>
                            <option value="1991">1991</option>
                            <option value="1992">1992</option>
                            <option value="1993">1993</option>
                            <option value="1994">1994</option>
                            <option value="1995">1995</option>
                            <option value="1996">1996</option>
                            <option value="1997">1997</option>
                            <option value="1998">1998</option>
                            <option value="1999">1999</option>
                            <option value="2000">2000</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                        </select>
                    </div> 


                    <div class="form-group">
                        <label for="name">Celebrity<span class="mandatory">*</span></label>
                        <input id="name" class="form-control" name="name" type="text" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="name">Description<span class="mandatory">*</span></label>
                        <input id="description" class="form-control" name="description" type="text" placeholder="Enter description">
                    </div>
                    <div class="form-group">
                        <div id="upload">

                            <label class="form-label">Upload Image</label>
                            <button type="button" class="btn btn-info" id="browse">Browse</button>
                            <input type="text" id="logo" name="logo" style="visibility: hidden" value=""/>
                        </div>
                        <div id="sta"><span id="status" ></span></div>
                    </div>

                    <div class="form-group">
                        <div id="files" class="project-logo">
                        </div>
                    </div>
                </div>
                <span id="rtn_msg_edit"></span>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success" type="submit">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!--Celebrity edit modal-->
<div class="modal fade "  id="celebrity_edit_div" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="celebrity_edit_content">

        </div>
    </div>
</div>

<!--toastr-->
<script src="<?php echo base_url(); ?>backend_resources/assets/toastr-master/toastr.js"></script>
<script type="text/javascript">

                                            $('#vehicle_spec_menu').addClass('active open');

                                            $(document).ready(function () {
                                                $('#celebrity_table').dataTable();

                                                $("#add_celebrity_form").validate({
                                                    rules: {
                                                        manufacturer: "required",
                                                        model: "required",
                                                        name: "required",
                                                        description: "required"
                                                    },
                                                    messages: {
                                                        manufacturer: "Please select a manufacture",
                                                        model: "required",
                                                        name: "Please enter a Celebrity",
                                                        description: "Please enter a description"
                                                    }, submitHandler: function (form)
                                                    {
                                                        $.post(site_url + '/celebrity/add_celebrity', $('#add_celebrity_form').serialize(), function (msg)
                                                        {
                                                            if (msg == 1) {
                                                                $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');

                                                                add_celebrity_form.reset();
                                                                window.location = site_url + '/celebrity/manage_celebrity';
                                                            } else {
                                                                $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');

                                                            }
                                                        });


                                                    }
                                                });

                                            });

                                            //delete celebrity
                                            function delete_celebrity(id) {
                                                if (confirm('Are you sure want to delete this Celebrity ?')) {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: site_url + '/celebrity/delete_celebrity',
                                                        data: "id=" + id,
                                                        success: function (msg) {
                                                            if (msg == 1) {
                                                                $('#celebrity_' + id).hide();
                                                                toastr.success("Successfully deleted !!", "AutoVille");

                                                            }
                                                            else if (msg == 2) {
                                                                alert('Cannot be deleted as it is already assigned to others. !!');
                                                            }

                                                        }
                                                    });
                                                }
                                            }

                                            //change publish status of celebrity
                                            function change_publish_status(celebrity_id, value, element) {
                                                var condition = 'Do you want to activate this celebrity?';
                                                if (value == 0) {
                                                    condition = 'Do you want to deactivate this celebrity?';
                                                }

                                                if (confirm(condition)) {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: site_url + '/celebrity/change_publish_status',
                                                        data: "id=" + celebrity_id + "&value=" + value,
                                                        success: function (msg) {
                                                            if (msg == 1) {
                                                                if (value == 1) {
                                                                    $(element).parent().html('<a class="btn btn-success btn-xs" onclick="change_publish_status(' + celebrity_id + ', 0, this)" title="click to deactivate celebrity"><i class="fa fa-check"></i></a> ');
                                                                } else {
                                                                    $(element).parent().html('<a class="btn btn-warning btn-xs" onclick="change_publish_status(' + celebrity_id + ', 1, this)" title="click to activate celebrity"><i class="fa fa-exclamation-circle"></i></a> ');
                                                                }
                                                            } else if (msg == 2) {

                                                            }
                                                        }
                                                    });
                                                }
                                            }

                                            //edit celebrity
                                            function display_edit_celebrity_pop_up(celebrity_id) {

                                                $.post(site_url + '/celebrity/load_edit_celebrity_content', {celebrity_id: celebrity_id}, function (msg) {

                                                    $('#celebrity_edit_content').html('');
                                                    $('#celebrity_edit_content').html(msg);
                                                    $('#celebrity_edit_div').modal('show');
                                                });

                                            }




</script>

