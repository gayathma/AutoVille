
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
                    <?php foreach ($items as $value) { ?>
                        <li><?php echo $value->spare_name; ?> </li> <P><?php echo $value->spare_price; ?></P>
                    <?php } ?>


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