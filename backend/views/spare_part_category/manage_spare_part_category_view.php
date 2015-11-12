<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Manage Spare Parts Categories
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="clearfix">
                        <div class="btn-group">
                            <a id="editable-sample_new" class="btn btn-shadow btn-primary" href="#category_add_modal" data-toggle="modal">
                                Add New
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <table  class="display table table-bordered table-striped" id="category_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
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
                                <tr id="category_<?php echo $result->id; ?>">
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $result->name; ?></td>
                                    <td align="center"><img src="<?php echo base_url(); ?>uploads/spare_part_category/<?php echo $result->image; ?>" width="60px" /></td>

                                    <td align="center">
                                        <?php if ($result->is_published) { ?>
                                            <a class="btn btn-success btn-xs" onclick="change_publish_status(<?php echo $result->id; ?>, 0, this)" title="click to deactivate category"><i class="fa fa-check"></i></a>
                                        <?php } else { ?>
                                            <a class="btn btn-warning btn-xs" onclick="change_publish_status(<?php echo $result->id; ?>, 1, this)" title="click to activate category"><i class="fa fa-exclamation-circle"></i></a>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <a class="btn btn-primary btn-xs" onclick="display_edit_category_pop_up(<?php echo $result->id; ?>)"><i class="fa fa-pencil" title="Update"></i></a>
                                        <a class="btn btn-danger btn-xs" onclick="delete_category(<?php echo $result->id; ?>)"><i class="fa fa-trash-o " title="" title="Remove"></i></a>

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

<!--category add model-->
<div class="modal fade " id="category_add_modal" tabindex="-1" role="dialog" aria-labelledby="category_add_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add New Category</h4>
            </div>
            <form id="add_category_form" name="add_category_form">
                <div class="modal-body">
                    <script src="<?php echo base_url(); ?>backend_resources/file_upload_plugin/ajaxupload.3.5.js" type="text/javascript"></script>
                    <script>
                                        //upload category logo

                                        $(function () {
                                            var btnUpload = $('#upload');
                                            var status = $('#status');
                                            new AjaxUpload(btnUpload, {
                                                action: '<?php echo site_url(); ?>/spare_parts_category/upload_category_image',
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
                                                        $('<div></div>').appendTo('#files').html('<img src="<?php echo base_url(); ?>uploads/spare_part_category/' + response + '"   width="100px" height="68px" /><br />');
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
                        <label for="name">Enter Category
                             <span class="mandatory">*</span>
                        </label>
                       
                        <input id="name" class="form-control" name="name" type="text" placeholder="Category">
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
                    <span id="rtn_msg"></span>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success" type="submit">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
         </div>
</div>
        

<!--Category Edit Modal -->
<div class="modal fade "  id="category_edit_div" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="category_edit_content">

        </div>
    </div>
</div>


<!--toastr-->
<script src="<?php echo base_url(); ?>backend_resources/assets/toastr-master/toastr.js"></script>
<script type="text/javascript">

    $('#vehicle_spec_menu').addClass('active open');

    $(document).ready(function () {
        $('#category_table').dataTable();

        $("#add_category_form").validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Please enter a Category"
            }, submitHandler: function (form)
            {
                $.post(site_url + '/spare_parts_category/add_category', $('#add_category_form').serialize(), function (msg)
                {
                    if (msg == 1) {                        
                        $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');
                        add_category_form.reset();
                        window.location = site_url + '/spare_parts_category/manage_categories';


                    } else {
                        $('#rtn_msg').html('<div class="alert alert-block alert-danger fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>An error occured.</strong></div>');
                    }
                });


            }
        });

    });

    //delete categories
    function delete_category(id) {

        if (confirm('Are you sure want to delete this Category ?')) {

            $.ajax({
                type: "POST",
                url: site_url + '/spare_parts_category/delete_category',
                data: "id=" + id,
                success: function (msg) {
                    //alert(msg);
                    if (msg == 1) {
                        //document.getElementById(trid).style.display='none';
                        $('#category_' + id).hide();
                         
                         toastr.success("Successfully deleted !!", "AutoVille");
                         window.location = site_url + '/spare_parts_category/manage_categories';
                    }
                    else if (msg == 2) {
                        alert('Cannot be deleted as it is already assigned to others. !!');
                    }
                }
            });
        }
    }


    //change publish status of categories
    function change_publish_status(category_id, value, element) {

        var condition = 'Do you want to activate this category ?';
        if (value == 0) {
            condition = 'Do you want to deactivate this category?';
        }

        if (confirm(condition)) {
            $.ajax({
                type: "POST",
                url: site_url + '/spare_parts_category/change_publish_status',
                data: "id=" + category_id + "&value=" + value,
                success: function (msg) {
                    if (msg == 1) {
                        if (value == 1) {
                            $(element).parent().html('<a class="btn btn-success btn-xs" onclick="change_publish_status(' + category_id + ',0,this)" title="click to deactivate category"><i class="fa fa-check"></i></a>');
                        } else {
                            $(element).parent().html('<a class="btn btn-warning btn-xs" onclick="change_publish_status(' + category_id + ',1,this)" title="click to activate category"><i class="fa fa-exclamation-circle"></i></a>');
                        }

                    } else if (msg == 2) {
                        alert('Error !!');
                    }
                }
            });
        }
    }


    //Edit Category
    function  display_edit_category_pop_up(category_id) {

        $.post(site_url + '/spare_parts_category/load_update_category_popup', {category_id: category_id}, function (msg) {

            $('#category_edit_content').html('');
            $('#category_edit_content').html(msg);
            $('#category_edit_div').modal('show');
        });


    }

</script>



