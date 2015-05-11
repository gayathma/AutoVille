<h1> Profile Info</h1>
<div class="modal-body">
    <form id="edit_user_form" class="form-horizontal" role="form" method="POST" name="edit_user_form">
        <div class="form-group">
            <label  class="col-lg-2 control-label">About Me</label>
            <div class="col-lg-10">
                <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-lg-2 control-label">Title</label>
            <div class="col-lg-6">
                <input name="title" type="text" class="form-control" id="title" placeholder=" " value="<?php echo $result->title; ?>">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-lg-2 control-label">Name</label>
            <div class="col-lg-6">
                <input name="name" type="text" class="form-control" id="name" placeholder=" " value="<?php echo $result->name; ?>">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-lg-2 control-label">User Name</label>
            <div class="col-lg-6">
                <input name="user_name" type="text" class="form-control" id="username" placeholder=" " value="<?php echo $result->user_name; ?>">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-lg-2 control-label">User Type</label>
            <div class="col-lg-6">
                <input name="user_type" type="text" class="form-control" id="type" placeholder=" "value="<?php echo $result->user_type; ?>">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-lg-2 control-label">E-mail</label>
            <div class="col-lg-6">
                <input name="email" type="text" class="form-control" id="email" placeholder=" " value="<?php echo $result->email; ?>">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-lg-2 control-label">Address</label>
            <div class="col-lg-6">
                <input name="address" type="text" class="form-control" id="address" placeholder=" "value="<?php echo $result->address; ?>">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-lg-2 control-label">Contact No 01</label>
            <div class="col-lg-6">
                <input name="contact_no_1" type="text" class="form-control" id="mobile1" placeholder=" " value="<?php echo $result->contact_no_1; ?>">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-lg-2 control-label">Contact No 02</label>
            <div class="col-lg-6">
                <input name="contact_no_2" type="text" class="form-control" id="mobile2" placeholder=" " value="<?php echo $result->contact_no_2; ?>">
            </div>
        </div>

        <div class="form-group">
            <label  class="col-lg-2 control-label">Current Password</label>
            <div class="col-lg-6">
                <input name="c_password" type="password" class="form-control" id="c-pwd" placeholder=" " >
            </div>
        </div>
        
        <div class="form-group">
            <label  class="col-lg-2 control-label">New Password</label>
            <div class="col-lg-6">
                <input name="" type="password" class="form-control" id="n-pwd" placeholder=" ">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-lg-2 control-label">Re-type New Password</label>
            <div class="col-lg-6">
                <input name="n_pasword" type="password" class="form-control" id="rt-pwd" placeholder=" ">
            </div>
        </div>

        <div class="form-group">
            <label  class="col-lg-2 control-label">Change Avatar</label>
            <div class="col-lg-6">
                <input name="profile_pic" type="file" class="file-pos" id="exampleInputFile">
            </div>
        </div>

        <span id="rtn_msg"></span>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="button" id="saveBtn" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </form>
    <script type="text/javascript">

    $('#user_menu').addClass('active open');
  
 $(document).delegate('#saveBtn' , 'click', function(e){
           $("#edit_user_form").validate({
            rules: {
                title: {
                    required: true
                },
                name: {
                    required: true
                },
                user_name: "required",
                user_type: {
                    required: true,
                    digits: true
                },
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
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                password: "required",
                re_pasword: {
                    required: true,
                    equalTo: '#password'
                }


            },
            messages: {
                title: {
                    required: "Please enter a title"
                },
                name: {
                    required: "Please enter a name"
                },
                user_name: "Please enter a user name",
                user_type: {
                    required: "Please enter a user type",
                    digits: "Invalid user type"
                },
                email: {
                    required: "Please enter a email",
                    email: "Invalid Email"
                },
                address: "Please enter a address",
                contact_no_1: {
                    required: "Please enter a email",
                    digits: "Enter numbers only",
                    maxlength: "Phone number is too long",
                    minlength: "Phone number is too short"
                },
                contact_no_2: {
                    required: "Please enter a email",
                    digits: "Enter numbers only",
                    maxlength: "Phone number is too long",
                    minlength: "Phone number is too short"
                },
                password: "Please enter a password",
                re_pasword:
                        {
                            required: "Retype the Password",
                            equalTo: "Passwords are not matching"
                        }
            }, submitHandler: function (form)
            {
               

            }
        }); 
           
              if ($('#edit_user_form').valid()) {
             $.post(site_url + '/users/update_user', $('#edit_user_form').serialize(), function (msg)
                {
                    
                    if (msg == 1) {

                        toastr.success("Profile Successfully updated !!", "AutoVille");
                        $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');
                        edit_user_form.reset();

                        window.location = site_url + '/users/load_profile_of_user'



                    } else {
                        $('#rtn_msg').html('<div class="alert alert-block alert-danger fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>An error occured.</strong></div>');
                    }
                });
        }
        });
   
</script>
</div>


