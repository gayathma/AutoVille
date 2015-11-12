<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Manufacture Quick edit</h4>
</div>

<form id="edit_manufacture_form" name="edit_manufacture_form" method="post">
    <div class="modal-body">
        <script src="<?php echo base_url(); ?>backend_resources/file_upload_plugin/ajaxupload.3.5.js" type="text/javascript"></script>
        <script>
            //upload manufacture logo
            var btnUpload = $('#upload_edit');
            var status = $('#status_edit');
            new AjaxUpload(btnUpload, {
                action: '<?php echo site_url(); ?>/manufacture/upload_manufacture_logo',
                name: 'uploadfile',
                onSubmit: function (file, ext) {
                    if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                        // extension is not allowed 
                        status.text('Only JPG, PNG or GIF files are allowed');
                        return false;
                    }
                },
                onComplete: function (file, response) {
                    //On completion clear the status
                    //status.text('');
                    $("#files_edit").html("");
                    $("#sta_edit").html("");
                    //Add uploaded file to list
                    if (response != "error") {
                        $('#files_edit').html("");
                        $('<div></div>').appendTo('#files_edit').html('<img src="<?php echo base_url(); ?>uploads/manufacture_logo/' + response + '"   width="100px" height="68px" /><br />');
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
            <label for="name">Manufacture<span class="mandatory">*</span></label>
            <input id="name" class="form-control" name="name" type="text" value="<?php echo $manufacture->name; ?>">
            <input id="manufacture_id"  name="manufacture_id" type="hidden" value="<?php echo $manufacture->id; ?>">

        </div>
        <div class="form-group">
            <div id="upload_edit">

                <label class="form-label">Upload Logo</label>
                <button type="button" class="btn btn-info" id="browse_edit">Browse</button>
                <input type="text" id="logo_edit" name="logo" style="visibility: hidden" value=""/>
            </div>
            <div id="sta_edit"><span id="status_edit" ></span></div>
        </div>

        <div class="form-group">
            <div id="files_edit" class="project-logo">
                <?php if (!empty($manufacture->logo)) { ?>
                    <img src="<?php echo base_url(); ?>uploads/manufacture_logo/<?php echo $manufacture->logo; ?>"   width="100px" height="68px" /><br />
                <?php } ?>
            </div>
        </div>
    </div>
    <span id="rtn_msg_edit"></span>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
        <button class="btn btn-success" type="submit">Save changes</button>
    </div>
</form>


<script type="text/javascript">

    $("#edit_manufacture_form").validate({
        rules: {
            name: "required"
        },
        message: {
            name: "Please enter a Manufacturer"
        }, submitHandler: function (form) {
            $.post('<?php echo site_url(); ?>/manufacture/edit_manufacture', $('#edit_manufacture_form').serialize(), function (msg) {
                if (msg == 1) {
                    $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');
                    window.location = site_url + '/manufacture/manage_manufactures';
                } else {
                    $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');
                }
            });
        }
    });

</script>

