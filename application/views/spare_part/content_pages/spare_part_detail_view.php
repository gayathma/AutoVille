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
                                        <?php
                                        $user = $this->session->userdata("USER_ID");
                                        if (empty($user) || ($user != $spare_part_detail->added_by)) {
                                            ?>
                                            <i class="fa fa-comments"></i>
                                            <a href="#" id="startChat" class="">Chat with seller </a>
                                        <?php } ?>
                                    </div>
                                    
                                </figure>
                            </address>
                        </section>
                        <!--end Contact-->
                        <!--Share-->
                        
                        <!--End Share-->
                        <!--Contact Form-->
                        
                    </aside>
                    <!--end Detail Sidebar-->
                    <!--Content-->
                    <div class="col-md-8 col-sm-8">
                        <section>
                            <article class="item-gallery">
                                <div class="owl-carousel item-slider">
                                    
                                    <a><img src="<?php echo base_url() . 'uploads/spare_part_images/' . $spare_part_detail->image; ?>" height="180" width="260" alt=""/></a>
                                </div>
                                <!-- /.item-slider -->
                                
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
                            

                        </section>
                       
                    </div>
                    <!-- /.col-md-8-->
                </div>
                <!-- /.row -->
            </section>
            <!-- /#main-content-->
        </div>
       
    </div><!-- /.row-->
</section>