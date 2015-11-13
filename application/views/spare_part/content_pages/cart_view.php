
<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/assets/css/bootstrap-select.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/assets/css/user.style.css" type="text/css">

    <title>Spotter - Universal Directory Listing HTML Template</title>

</head>

<body onunload="" class="page-subpage page-pricing navigation-off-canvas" id="page-top">

<!-- Outer Wrapper-->
<div id="outer-wrapper">
    <!-- Inner Wrapper -->
    <div id="inner-wrapper">
        <!-- Navigation-->
        
        <!-- end Navigation-->
        <!-- Page Canvas-->
        <div id="page-canvas">
            <!--Off Canvas Navigation-->
            
            <!--end Off Canvas Navigation-->

            <!--Sub Header-->
            
            <!--end Sub Header-->

            <!--Page Content-->
            <div id="page-content">
                <section class="container equal-height">
                    <header>
                        <h1 class="page-title">Pricing</h1>
                    </header>
                    <div class="row">
<!--                        <div class="col-md-3 col-sm-3">
                            <div class="price-box white">
                                <header><h2>Free</h2></header>
                                <figure><span class="price">$0</span>forever</figure>
                                <ul>
                                    <li>1 Property</li>
                                    <li>1 Agent Profile</li>
                                    <li class="not-available">Agency Profile</li>
                                    <li class="not-available">Featured Properties</li>
                                </ul>
                                <a href="#" class="btn framed btn-color-default">Sign In</a>
                            </div>
                             /.price-box
                        </div>-->
                        <!-- /.col-md-3-->
<!--                        <div class="col-md-3 col-sm-3">
                            <div class="price-box white">
                                <header><h2>Silver</h2></header>
                                <figure><span class="price">$20</span>per month</figure>
                                <ul>
                                    <li>20 Properties</li>
                                    <li>10 Agents Profile</li>
                                    <li>5 Agency Profiles</li>
                                    <li>Featured Properties</li>
                                </ul>
                                <a href="#" class="btn framed btn-color-default">Sign In</a>
                            </div>
                             /.price-box
                        </div>-->
                        <!-- /.col-md-3-->
<!--                        <div class="col-md-3 col-sm-3">
                            <div class="price-box white featured">
                                <header><h2>Gold</h2></header>
                                <figure><span class="price">$40</span>per month</figure>
                                <ul>
                                    <li>30 Properties</li>
                                    <li>20 Agents Profile</li>
                                    <li>10 Agency Profiles</li>
                                    <li>Featured Properties</li>
                                </ul>
                                <a href="#" class="btn framed btn-color-default">Sign In</a>
                            </div>
                             /.price-box
                        </div>-->
                        
                        <!-- /.col-md-3-->
                        <div class="col-md-3 col-sm-3">
                            <div class="price-box white">                               
                                
                                <ul>
                                    <?php foreach ($items as $value){?>
                                    <li><?php echo $value->spare_name;?> </li> <P><?php echo $value->spare_price;?></P>
                                   <?php }?>
                                    
                                    
                                </ul>
<!--                                <a href="#" class="btn framed btn-color-default">Sign In</a>-->
                            </div>
                            <!-- /.price-box-->
                        </div>
                        <!-- /.col-md-3-->
                    </div>
                    <!-- /.row-->
                    
                    <!-- /.row-->
                    
                    <!-- /.row-->
                </section>
                <!-- /.container-->
            </div>
            <!-- end Page Content-->
        </div>
        <!-- end Page Canvas-->
        <!--Page Footer-->
        
        <!--end Page Footer-->
    </div>
    <!-- end Inner Wrapper -->
</div>
<!-- end Outer Wrapper-->


<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/before.load.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/jquery.hotkeys.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/custom.js"></script>

<!--[if lte IE 9]>
<script type="text/javascript" src="assets/js/ie-scripts.js"></script>
<![endif]-->
</body>
</html>