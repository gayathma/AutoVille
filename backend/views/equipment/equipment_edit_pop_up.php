<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Equipment Quick Edit</h4>
</div>
<form id="edit_equipment_form" name="edit_equipment_form">
    <div class="modal-body">

        <div class="form-group">
            <label for="name">Vehicle Equipment<span class="mandatory">*</span></label>
            <input id="name" class="form-control" name="name" type="text" value="<?php echo $equipment->name; ?>">
            <input id="equipment_id"  name="equipment_id" type="hidden" value="<?php echo $equipment->id; ?>">
        </div>
        <span id="rtn_msg_edit"></span>
    </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>        
        <button class="btn btn-success" type="submit">Save changes</button>
    </div>
</form>

<script type="text/javascript">

    $("#edit_equipment_form").validate({
        rules: {
            name: "required"
        },
        messages: {
            name: "Please enter a Equipment"
        }, submitHandler: function (form) {

            $.post(site_url + '/equipment/edit_equipment', $('#edit_equipment_form').serialize(), function (msg)
            {
                if (msg == 1) {
                    $('#rtn_msg_edit').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');
                    window.location = site_url + '/equipment/manage_equipment';
                } else {
                    $('#rtn_msg_edit').html('<div class="alert alert-block alert-danger fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>An error occured.</strong></div>');
                }
            });
        }

    });

</script>