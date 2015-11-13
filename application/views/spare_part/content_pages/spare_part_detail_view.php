<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/owl.carousel.min.js"></script>
<script>
    $(window).load(function () {

        if ($('.owl-carousel').length > 0) {
            if ($('.carousel-full-width').length > 0) {
                setCarouselWidth();
            }
            $(".item-slider").owlCarousel({
                rtl: false,
                items: 1,
                lazyLoad: true,
                autoHeight: true,
                responsiveBaseWidth: ".slide",
                nav: false,
                callbacks: true,
                URLhashListener: true,
                navText: ["", ""]
            });

            $('.item-gallery .thumbnails a').on('click', function () {
                $('.item-gallery .thumbnails a').each(function () {
                    $(this).removeClass('active');
                });
                $(this).addClass('active');
            });
            $('.item-slider').on('translated.owl.carousel', function (event) {
                var thumbnailNumber = $('.item-slider .owl-item.active img').attr('data-hash');
                $('.item-gallery .thumbnails #thumbnail-' + thumbnailNumber).trigger('click');
            });
        }
    });

</script>
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

                        <!--End Share-->
                        <!--Contact Form-->

                    </aside>
                    <!--end Detail Sidebar-->
                    <!--Content-->
                    <div class="col-md-8 col-sm-8">
                        <section>
                            <article class="item-gallery">
                                <div class="owl-carousel item-slider">
                                    <div class="owl-item">
                                        <div class="slide">
                                            <a><img  src="<?php echo base_url() . 'uploads/spare_part_images/' . $spare_part_detail->image; ?>" height="180" width="260" alt=""/></a>
                                        </div>
                                    </div>
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
                    <div class="col-md-8 col-sm-8">
                        <section>
                            <h2>Quick Poll</h2>
                            <p>Are you planning on taking advantage of any Black Friday vehicle specials? </p>

                            <div class="radios">
                                <label class="label_radio" for="radio-01">
                                    <input name="sample-radio" id="radio-01" value="1" type="radio" checked /> Yes
                                </label>
                                <label class="label_radio" for="radio-02">
                                    <input name="sample-radio" id="radio-02" value="1" type="radio" /> No
                                </label>
                                <label class="label_radio" for="radio-03">
                                    <input name="sample-radio" id="radio-03" value="1" type="radio" /> Not Sure
                                </label>
                            </div>

                        </section>
                    </div>
                </div>
                <!-- /.row -->
            </section>
            <!-- /#main-content-->
        </div>

    </div><!-- /.row-->
</section>