<section class="container page-item-detail">
    <div class="row">
        <!--Item Detail Content-->
        <div class="col-md-9">
            <section class="block" id="main-content">
                <header class="page-title">
                    <div class="title">
                        <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $spare_part_detail->id; ?>" />
                        <h1 itemprop="name"><?php echo $spare_part_detail->name; ?></h1>
                        <figure style="color: red;"><strong>Rs. <?php echo number_format($spare_part_detail->price, 2, '.', ','); ?></strong></figure>
                    </div>
                    <div class="info">                        
                        <div class="type">
                            <a class="btn btn-default framed icon pull-right roll" href="#" onclick="window.print();">
                                Print
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                </header>
                <div class="row">
                    <!--Detail Sidebar-->
                    <aside class="col-md-4 col-sm-4" id="detail-sidebar">
                        <!--Contact-->
                        <section>
                            <header><h3>Contact</h3></header>
                            <address>
                                <div><?php echo $seller_add->address; ?></div>
                                <figure>
                                    <div class="info">
                                        <i class="fa fa-mobile"></i>
                                        <span><?php echo $seller_add->contact_no_1; ?></span>
                                    </div>
                                    <?php
                                    if (isset($seller_add->contact_no_2))
                                        if ($seller_add->contact_no_2 != '') {
                                            ?>
                                            <div class="info">
                                                <i class="fa fa-phone"></i>
                                                <span><?php echo $seller_add->contact_no_2; ?></span>
                                            </div>
                                        <?php } ?>
                                    <div class="info">
                                        <i class="fa fa-envelope"></i>
                                        <a href="mailto:<?php echo $seller_add->email; ?>"><?php echo $seller_add->email; ?></a>
                                    </div>
                                    <div class="info">
                                        <i class="fa fa-globe"></i>
                                        <a href="#">www.autoville.lankapanel.biz</a>
                                        
                                    </div>
                                    
                                </figure>
                            </address>
                        </section>
                        <!--end Contact-->
                        <!--Share-->
<!--                        <section class="clearfix">
                            <header class="pull-left">
                                <a class="roll" href="#reviews">
                                    <h3>Share</h3>
                                </a>
                            </header>
                            <figure class="pull-right">
                                <div class="addthis_sharing_toolbox"></div>

                            </figure>-->
                        </section>
                        <!--End Share-->
                        <!--Contact Form-->
<!--                        <section>
                            <?php //echo $this->load->view('vehicle_adds/ask_for_price_view'); ?>
                        </section>-->
                        <!--end Contact Form-->

<!--                        <section style="background-color: #fff;">
                            <?php //echo $this->load->view('vehicle_adds/loan_calculator'); ?>
                        </section>-->
                    </aside>
                    <!--end Detail Sidebar-->
                    <!--Content-->
                    <div class="col-md-8 col-sm-8">
                        <section>
                            <article class="item-gallery">
                                <div class="owl-carousel item-slider">
                                    <?php
                                    //$i = 0;
//                                    foreach ($images as $image) {
//                                        ++$i
//                                        ?>
<!--                                        <div class="owl-item //<?php if ($i == 1) { ?> active<?php } ?>">
                                            <div class="slide"><img //<?php if ($i == 1) { ?> itemprop="image" <?php } ?> src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $vehicle_detail->id . '/' . $image->image_path; ?>" data-hash="<?php echo $i; ?>" alt=""></div>
                                        </div>-->

                                    <?php// } ?>
                                    
                                    <a><img src="<?php echo base_url() . 'uploads/spare_part_images/' . $spare_part_detail->image; ?>" height="180" width="260" alt=""/><

                                </div>
                                <!-- /.item-slider -->
<!--                                <div class="thumbnails">
                                    <span class="expand-content btn framed icon" data-expand="#gallery-thumbnails" >More<i class="fa fa-plus"></i></span>
                                    <div class="expandable-content height collapsed show-70" id="gallery-thumbnails">
                                        <div class="content">
                                            <?php
                                            $i = 0;
                                            foreach ($images as $image) {
                                                ++$i
                                                ?>
                                                <a href="#<?php echo $i; ?>" id="thumbnail-<?php echo $i; ?>" <?php if ($i == 1) { ?> class="active" <?php } ?>><img src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $vehicle_detail->id . '/' . $image->image_path; ?>" alt=""></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>-->
                            </article>
                            <!-- /.item-gallery -->
                            <article class="block">
                                <header><h2>Description</h2></header>
                                <p itemprop="description"><?php echo $spare_part_detail->description; ?></p>
                            </article>
                            <!-- /.block -->
                            <article class="block">
                                <header><h2>Info</h2></header>
                                <dl class="lines">
                                    <dt>Model, Body type</dt>
                                    <dd><?php echo $spare_part_detail->model; ?></dd>
                                    <dt>Year</dt>
                                    <dd><?php echo $spare_part_detail->year; ?></dd>
                                    <dt>Fuel</dt>
                                    <dd><?php echo $spare_part_detail->fuel_type; ?></dd>
                                    <dt>Manufacture</dt>
                                    <dd><?php echo $spare_part_detail->manufacture; ?></dd>                              
                                </dl>
                            </article>
                            <!-- /.block -->

                            
                            <!-- /.block -->

                        </section>
                        <!--Reviews-->                        
                        <!--end Review Form-->
                    </div>
                    <!-- /.col-md-8-->
                </div>
                <!-- /.row -->
        </div>
    </section>

            <!-- /#main-content-->
        
        
    