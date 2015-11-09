<!--toastr-->
<link href="<?php echo base_url(); ?>application_resources/assets/toastr-master/toastr.css" rel="stylesheet" type="text/css" />
<section class="container">
    <div class="row">
        <!--Content-->
        <div class="col-md-9">
            <header>
                <h1 class="page-title"><?php echo $heading; ?></h1>
            </header>
            <form id="commercial_form" name="commercial_form" role="form" method="post" enctype="multipart/form-data">

             
                <section>
                    <h3>Topic</h3>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" id="topic" name="topic"/>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3>Commercial Description</h3>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <textarea id="vehicle-description-field" class="form-control" name="description" rows="7"></textarea>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section>
                    <h3>Enter your website url</h3>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" id="url" name="url"/>
                            </div>
                        </div>
                    </div>
                </section>           

                <section>
                    <h3>Price</h3>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">                                
                                <input id="price" class="form-control" type="text" name="price" onkeypress="return numbersonly(this, event, '.')">
                            </div>
                        </div>
                    </div>
                </section>


                <section>
                    <h3>Address & Contact</h3>
                    <!--/.row-->
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="phone-number">Phone Number</label>
                                <input type="text" readonly="true" class="form-control" id="phone-number" name="phone-number" pattern="\d*" value="<?php echo $this->session->userdata('USER_PHONE'); ?>">
                            </div>
                        </div>
                        <!--/.col-md-4-->
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" readonly="true" class="form-control" id="email" name="email" value="<?php echo $this->session->userdata('USER_EMAIL'); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/.row-->

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="state">Address</label>
                                <textarea readonly="true" class="form-control" id="address" name="address"><?php echo $this->session->userdata('USER_ADDRESS'); ?></textarea>
                            </div>
                        </div>

                    </div>
                </section>               
                <!--Gallery-->
                <section>
                    <h3>Gallery</h3>

<!--                <form  id="fileupload"  action="<?php // echo site_url() . '/fileupload'    ?>" method="POST" enctype="multipart/form-data">-->
                    <script src="<?php echo base_url(); ?>application_resources/file_upload_plugin/ajaxupload.3.5.js" type="text/javascript"></script>
                    <script type="text/javascript">
                                    //upload commercial images

                                    $(function() {
                                        var btnUpload = $('#upload');
                                        var status = $('#status');
                                        new AjaxUpload(btnUpload, {
                                            action: '<?php echo site_url(); ?>/website_advertisements/upload_commercial_image',
                                            name: 'uploadfile',
                                            onSubmit: function(file, ext) {
                                                if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                                                    // extension is not allowed 
                                                    status.text('Only JPG, PNG or GIF files are allowed');
                                                    return false;
                                                }                                              

                                            },
                                            onComplete: function(file, response) {
                                                //On completion clear the status
                                                //status.text('');
                                                $("#files").html("");
                                                $("#sta").html("");
                                                //Add uploaded file to list
                                                if (response != "error") {
                                                    $('#files').html("");
                                                    $('<div></div>').appendTo('#files').html('<img src="<?php echo base_url(); ?>uploads/commercial_images/' + response + '"   width="200px" height="200px" /><br />');
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
                        <div id="upload">                            
                            <button type="button" class="btn btn-info" id="browse">Browse</button>
                            <input type="text" id="logo" name="logo" style="visibility: hidden" value=""/>
                        </div>
                        <div id="sta"><span id="status" ></span></div>
                    </div>
                    <div class="form-group">
                        <div id="files" class="project-logo">
                        </div>
                    </div>

                </section>
            </form>
            <!--end Gallery-->
            <!--            <form>-->
            <hr>
            <section>
                <figure class="pull-left margin-top-15">
                    <p>By clicking “Submit“ button you agree with <a href="terms-conditions.html" class="link">Terms & Conditions</a></p>
                </figure>
                <div class="form-group">
                    <button type="button" class="btn btn-default pull-right" id="add_commercial_btn">Submit</button>
                </div>
                <!-- /.form-group -->
            </section>
            <!--            </form>-->
            <!--/#form-submit-->
        </div>
        
    </div>
</section>
<script src="<?php echo base_url(); ?>application_resources/assets/toastr-master/toastr.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/jquery.validate.min.js"></script>

<script type="text/javascript">
    // add advertisement sumbit btn action
    $(document).on('click', '#add_commercial_btn', function() {
        if ($('#commercial_form').valid()) {
            $('#commercial_form').submit();
        }
    });

    $(document).ready(function() {

        $("#commercial_form").validate({
            rules: {
                topic: "required",
                price:{
                    required:true,
                    digits: true
                },
                logo:"required",
                url:"required"
            },
            messages: {
                topic: "Please enter a Topic",
                price:{
                    required:"Please enter a Price",
                    digits:"Enter numbers only"
                },
                logo:"Please upload an image",
                url:"Please enter the url"
            }, submitHandler: function(form)
            {
                $.post(site_url + '/website_advertisements/add_commercial', $('#commercial_form').serialize(), function(msg)
                {                  
                    if (msg == 1) {
                        toastr.success("Successfully submited your advertisement !!", "AutoVille");
                        setTimeout("location.href = site_url+'/website_advertisements/post_new_commercial_advertisement';", 1000);
                    } else {
                        $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');

                    }
                });


            }
        });

    });
</script>