<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Category Quick Edit</h4>
</div>
<form id="edit_category_form" name="edit_category_form">
    <div class="modal-body">
        <script src="<?php echo base_url(); ?>backend_resources/file_upload_plugin/ajaxupload.3.5.js" type="text/javascript"></script>
        <script>
            //upload category logo
         
              
                var btnUpload = $('#browse_edit');
                var status = $('#status_edit');
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
                        $("#files_edit").html("");
                        $("#sta_edit").html("");
                        //Add uploaded file to list
                        if (response != "error") {
                            $('#files_edit').html("");
                            $('<div></div>').appendTo('#files_edit').html('<img src="<?php echo base_url(); ?>uploads/spare_part_category/' + response + '"   width="100px" height="68px" /><br />');
                            picFileName = response;
                            document.getElementById('logo_edit').value = response;
                            //                    document.getElementById('cover_image').value = response;
                        } else {
                            $('<div></div>').appendTo('#files_edit').text(file).addClass('error');
                        }
                    }
                });
        </script>
        <div class="form-group">
            <label for="name">Category<span class="mandatory">*</span></label>
            <input id="name" class="form-control" name="name" type="text" value="<?php echo $category->name; ?>">
            <input id="category_id"  name="category_id" type="hidden" value="<?php echo $category->id; ?>">
        </div>
        <div class="form-group">
            <div id="upload">

                <label class="form-label">Upload Image</label>
                <button type="button" class="btn btn-info" id="browse_edit">Browse</button>
                <input type="text" id="logo_edit" name="logo" style="visibility: hidden" value=""/>
            </div>
            <div id="sta_edit"><span id="status_edit" ></span></div>
        </div>
        <div class="form-group">
            <div id="files_edit" class="project-logo">
                <?php if (!empty($category->image)) { ?>
                    <img src="<?php echo base_url(); ?>uploads/spare_part_category/<?php echo $category->image; ?>"   width="100px" height="68px" /><br />
                <?php } ?>
            </div>
        </div>
        <span id="rtn_msg_edit"></span>
    </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
        <button class="btn btn-success" type="submit">Save changes</button>
    </div>
</form>

<script type="text/javascript">

    //edit category form validation
    $("#edit_category_form").validate({
        rules: {
            name: "required"
        },
        messages: {
            name: "Please enter a category"
        }, submitHandler: function (form)
        {
            $.post(site_url + '/spare_parts_category/update_category', $('#edit_category_form').serialize(), function (msg)
            {
                if (msg == 1) {
                    $('#rtn_msg_edit').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully Updated!!.</strong></div>');

                    window.location = site_url + '/spare_parts_category/manage_categories';
                } else {
                    $('#rtn_msg_edit').html('<div class="alert alert-block alert-danger fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>An error occured.</strong></div>');

                }
            });


        }
    });
</script>