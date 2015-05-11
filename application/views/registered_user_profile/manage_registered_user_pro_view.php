<div class="col-md-9 col-sm-8">
    <h2>My Profile</h2>
    <div class="dashboard-block">
        <div class="tabs profile-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a role="tab" aria-controls="personalinfo" href="#personalinfo" data-toggle="tab" aria-expanded="true">Personal Info</a>
                </li>             
                <li class="">
                    <a role="tab" aria-controls="changepassword" href="#changepassword" data-toggle="tab" aria-expanded="false">Change Password</a>
                </li>
            </ul>
            <form id="edit_reg_user_profile_form" class="form-horizontal" role="form" method="POST" name="edit_reg_user_profile_form">
                <div class="tab-content">


                    <div id="personalinfo" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name*</label>
                                        <input class="form-control" type="text" required="" placeholder="" value="<?php echo $result->name; ?>">
                                        <!--<input name="name" type="text" class="form-control" id="name" placeholder=" " value="<?php echo $result->name; ?>">-->
                                    </div>
                                    <div class="col-md-6">
                                        <label>Username</label>
                                        <input class="form-control" type="text" required="" placeholder="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email*</label>
                                        <input class="form-control" type="text" required="" placeholder="">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Address</label>
                                        <input class="form-control" type="text" required="" placeholder="">
                                    </div>
                                </div>                                                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Contact number 1</label>
                                        <input class="form-control" type="text" required="" placeholder="">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Contact number 2</label>
                                        <input class="form-control" type="text" required="" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="changepassword" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Current Password</label>
                                        <input class="form-control" type="password" placeholder="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>New password</label>
                                        <input class="form-control" type="password" placeholder="">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Confirm new password</label>
                                        <input class="form-control" type="password" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                   
                    <button type="button" id="saveBtn" class="btn btn-success">Update Details</button>
                    <button type="button" class="btn btn-default">Cancel</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('#user_menu').addClass('active open');

    $(document).delegate('#saveBtn', 'click', function(e) {
        $("#edit_reg_user_profile_form").validate({
            rules: {
                name: {
                    required: true
                },
                user_name: "required",
                //user_type: {
                //  required: true,
                //digits: true
                //},
                email: {
                    required: true,
                    email: true
                },
                address: "required",
                contact_no_1: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                contact_no_2: {
                    //required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                current_pwd: "required",
                new_pwd: "required",
                confirm_new_pwd: {
                    required: true,
                    equalTo: '#new_pwd'
                }

            },
            messages: {
                name: {
                    required: "Please enter your name"
                },
                user_name: "Please enter your user name",
                email: {
                    required: "Please enter your email",
                    email: "Invalid Email"
                },
                address: "Please enter your address",
                contact_no_1: {
                    required: "Please enter your contact number",
                    digits: "Enter numbers only",
                    maxlength: "Phone number is too long",
                    minlength: "Phone number is too short"
                },
                contact_no_2: {
                    digits: "Enter numbers only",
                    maxlength: "Phone number is too long",
                    minlength: "Phone number is too short"
                },
                current_pwd: "Please enter your password",
                new_pwd: "If you want to change the current password, enter a new one",
                confirm_new_pwd:
                        {
                            required: "Retype your new password",
                            equalTo: "Passwords do not match"
                        }

            }, submitHandler: function(form)
            {
                if ($('#edit_reg_user_profile_form').valid()) {
                    $.post(site_url + '/reg_user_profile/update_reg_user_profile', $('#edit_reg_user_profile_form').serialize(), function(msg)
                    {
                        if (msg == 1) {
                            toastr.success("Profile successfully updated!!", "Autoville");
                            $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully updated!!.</strong></div>');
                            edit_reg_user_profile_form.reset();
                            window.location = site_url + '/reg_user_profile/load_profile_of_reg_user'
                        } else {
                            $('#rtn_msg').html('<div class="alert alert-block alert-danger fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>An error occured.</strong></div>');
                        }

                    });
                }
            }
        });
    });

</script>








