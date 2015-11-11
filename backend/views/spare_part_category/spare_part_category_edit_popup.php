<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Category Quick Edit</h4>
</div>
<form id="edit_category_form" name="edit_category_form">
    <div class="modal-body">

        <div class="form-group">
            <label for="name">Category<span class="mandatory">*</span></label>
            <input id="name" class="form-control" name="name" type="text" value="<?php echo $category->name; ?>">
            <input id="category_id"  name="category_id" type="hidden" value="<?php echo $category->id; ?>">
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