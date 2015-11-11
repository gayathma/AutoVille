<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Body Type Quick Edit</h4>
</div>
<form id="edit_body_type_form" name="edit_body_type_form">
    <div class="modal-body">

        <div class="form-group">
            <label for="name">Body Type<span class="mandatory">*</span></label>
            <input id="name" class="form-control" name="name" type="text" value="<?php echo $body_type->name; ?>">
            <input id="body_type_id"  name="body_type_id" type="hidden" value="<?php echo $body_type->id; ?>">
        </div>
        <span id="rtn_msg_edit"></span>
    </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
        <button class="btn btn-success" type="submit">Save changes</button>
    </div>
</form>

<script type="text/javascript">

    //edit body type form validation
    $("#edit_body_type_form").validate({
        rules: {
            name: "required"
        },
        messages: {
            name: "Please enter a body type"
        }, submitHandler: function (form)
        {
            $.post(site_url + '/body_type/update_body_types', $('#edit_body_type_form').serialize(), function (msg)
            {
                if (msg == 1) {
                    $('#rtn_msg_edit').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully Updated!!.</strong></div>');

                    window.location = site_url + '/body_type/manage_body_types';
                } else {
                    $('#rtn_msg_edit').html('<div class="alert alert-block alert-danger fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>An error occured.</strong></div>');

                }
            });


        }
    });
</script>