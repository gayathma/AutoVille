<!--toastr-->
<link href="<?php echo base_url(); ?>application_resources/assets/toastr-master/toastr.css" rel="stylesheet" type="text/css" />
<section class="container">
    <div class="row">
        <!--Content-->
        <div class="col-md-9">
            <header>
                <h1 class="page-title"><?php echo $heading; ?></h1>
            </header>
            <form id="add_spare_part_form" name="add_spare_part_form" role="form" method="post" enctype="multipart/form-data">

                <section>
                    <h3>About Spare Part</h3>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="name">Name<span class="mandatory">*</span></label>
                                <div class="form-group">
                                    <input type="text" id="name" name="name"/>
                                </div>
                            </div>
                        </div>
                        <!--/.col-md-4-->

                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="category">category<span class="mandatory">*</span></label>
                                <div id="model_wrapper">
                                    <select name="category" id="category" title="This field is required." data-live-search="true" class="live_select">
                                        <option value="">Select Category</option>
                                        <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?>Test category</option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="price">Price<span class="mandatory">*</span></label>
                                <input id="price" class="form-control" type="text" name="price" onkeypress="return numbersonly(this, event, '.')">
                            </div>
                        </div>
                    </div>                
                                    


                </section>


                <section>
                    <h3>About Vehicle</h3>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="manufacturer">Manufacturer<span class="mandatory">*</span></label>
                                <select name="manufacturer" id="manufacturer" title="This field is required." data-live-search="true" class="live_select" >
                                    <option value="" selected>Select Manufacturer</option>
                                    <?php foreach ($manufactures as $manufacture) { ?>
                                        <option value="<?php echo $manufacture->id; ?>"><?php echo $manufacture->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!--/.col-md-4-->

                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="model">Model<span class="mandatory">*</span></label>
                                <div id="model_wrapper">
                                    <select name="model" id="model" title="This field is required." data-live-search="true" class="live_select">
                                        <option value="">Select Model</option>
                                        <?php foreach ($models as $model) { ?>
                                            <option value="<?php echo $model->id; ?>"><?php echo $model->name; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="fabrication">Fabrication<span class="mandatory">*</span></label>
                                <select name="fabrication" id="fabrication" title="This field is required."  data-live-search="true">
                                    <option value="">Select Fabrication</option>
                                    <option value="1990">1990</option>
                                    <option value="1991">1991</option>
                                    <option value="1992">1992</option>
                                    <option value="1993">1993</option>
                                    <option value="1994">1994</option>
                                    <option value="1995">1995</option>
                                    <option value="1996">1996</option>
                                    <option value="1997">1997</option>
                                    <option value="1998">1998</option>
                                    <option value="1999">1999</option>
                                    <option value="2000">2000</option>
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>
                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--/.row-->
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="fuel_type">Fuel Type<span class="mandatory">*</span></label>
                                <select name="fuel_type" id="fuel_type" title="This field is required." data-live-search="true">
                                    <option value="">Select Fuel Type</option>
                                    <?php foreach ($fuel_types as $fuel_type) { ?>
                                        <option value="<?php echo $fuel_type->id; ?>"><?php echo $fuel_type->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                    </div>                 


                </section>

                <section>
                    <h3>Spare Part Description</h3>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <textarea id="vehicle-description-field" class="form-control" name="description" rows="7"></textarea>
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

<!--                <form  id="fileupload"  action="<?php // echo site_url() . '/fileupload'     ?>" method="POST" enctype="multipart/form-data">-->
                    <script src="<?php echo base_url(); ?>application_resources/file_upload_plugin/ajaxupload.3.5.js" type="text/javascript"></script>
                    <script type="text/javascript">
                                    //upload commercial images

                                    $(function () {
                                        var btnUpload = $('#upload');
                                        var status = $('#status');
                                        new AjaxUpload(btnUpload, {
                                            action: '<?php echo site_url(); ?>/spare_parts/spare_parts_advertisements/upload_spare_part_image',
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
                                                $("#files").html("");
                                                $("#sta").html("");
                                                //Add uploaded file to list
                                                if (response != "error") {
                                                    $('#files').html("");
                                                    $('<div></div>').appendTo('#files').html('<img src="<?php echo base_url(); ?>uploads/spare_part_images/' + response + '"   width="200px" height="200px" /><br />');
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
                    <button type="button" class="btn btn-default pull-right" id="add_spare_part_btn">Submit</button>
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
                                    $(document).on('click', '#add_spare_part_btn', function () {
                                        if ($('#add_spare_part_form').valid()) {
                                            $('#add_spare_part_form').submit();
                                        }
                                    });

                                    $(document).ready(function () {

                                        $("#add_spare_part_form").validate({                                            
                                            rules: {
                                                name: "required",
                                                category: "required",
                                                manufacturer:"required",
                                                model:"required",
                                                price: {
                                                    required: true,
                                                    digits: true
                                                },
                                                logo: "required",
                                                fabrication: "required",
                                                fuel_type:"required"
                                            },
                                            messages: {
                                                name: "Please enter a Name",
                                                category: "Please select a category",
                                                manufacturer:"Please select a manufacturer",
                                                model:"required",
                                                price: {
                                                    required: "Please enter a Price",
                                                    digits: "Enter numbers only"
                                                },
                                                logo: "Please upload an image",
                                                fabrication: "Please select the fabrication",
                                                fuel_type:"Please select a fuel type"
                                            }, submitHandler: function (form)
                                            {
                                                $.post(site_url + '/spare_parts/spare_parts_advertisements/add_spare_parts', $('#add_spare_part_form').serialize(), function (msg)
                                                {
                                                    if (msg == 1) {
                                                        toastr.success("Successfully submited your advertisement !!", "AutoVille");
                                                        setTimeout("location.href = site_url+'/spare_parts/spare_parts_advertisements/post_new_spare_part_advertisement';", 1000);
                                                    } else {
                                                        $('#rtn_msg').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');

                                                    }
                                                });


                                            }
                                        });

                                    });
</script>