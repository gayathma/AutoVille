<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Celebrity Quick edit</h4>
</div>

<form id="edit_celebrity_form" name="edit_celebrity_form" method="post">
    <div class="modal-body">

        <div class="form-group">
            <label for="name">Celebrity<span class="mandatory">*</span></label>
            <input id="name" class="form-control" name="name" type="text" value="<?php echo $celebrity->name; ?>">
            <input id="manufacture_id"  name="celebrity_id" type="hidden" value="<?php echo $celebrity->id; ?>">
        </div>
        
        <div class="form-group">
            <label for="name">Description<span class="mandatory">*</span></label>
            <input id="name" class="form-control" name="name" type="text" value="<?php echo $celebrity->description; ?>">            
        </div>               
        
        <div class="form-group">
            <div id="upload">

                <label class="form-label">Upload Logo</label>
                <button type="button" class="btn btn-info" id="browse">Browse</button>
                <input type="text" id="logo" name="logo" style="visibility: hidden" value=""/>
            </div>
            <div id="sta"><span id="status" ></span></div>
        </div>

        <div class="form-group">
            <div id="files" class="project-logo">
                <img src="<?php echo base_url(); ?>uploads/celebrity/<?php echo $celebrity->image; ?>"   width="100px" height="68px" /><br />
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

    $("#edit_celebrity_form").validate({
        rules: {
            name: "required"
        },
        message: {
            name: "Please enter a Celebrity"
        }, submitHandler: function (form) {
            $.post('<?php echo site_url(); ?>/celebrity/edit_celebrity', $('#edit_manufacture_form').serialize(), function (msg) {
                if (msg == 1) {
                    $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');
                    window.location = site_url + '/celebrity/manage_celebrity';
                } else {
                    $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');
                }
            });
        }
    });

</script>

