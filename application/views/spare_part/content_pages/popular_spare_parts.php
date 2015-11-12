<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/owl.carousel.min.js"></script>
<script>
    $(window).load(function() {

        if ($('.owl-carousel').length > 0) {
            if ($('.carousel-full-width').length > 0) {
                setCarouselWidth();
            }
            $(".carousel.wide").owlCarousel({
                rtl: false,
                items: 1,
                responsiveBaseWidth: ".slide",
                nav: true,
                navText: ["", ""]
            });
        }

    });
</script>
<div class="owl-carousel wide carousel">
    <?php
    foreach ($new_arrivals as $value) { ?>
        <div class="slide">
            <div class="inner">
                <div class="image">
                    <div class="item-specific">
                        <div class="inner">
                            <div class="content">

                            </div>
                        </div>
                    </div>
                    <img  src="<?php echo base_url() . 'uploads/spare_part_images/' . $value->image; ?>" height="180" width="260" alt=""/>
                </div>
                <div class="wrapper">
                    <a href="item-detail.html"><h3><?php echo $value->name; ?></h3></a>
<!--                    <figure>
                        <i class="fa fa-map-marker"></i>
                        <span>970 Chapel Street, Rosenberg, TX 77471</span>
                    </figure>
                    <div class="info">
                        <div class="rating" data-rating="4">
                            <aside class="reviews">6 reviews</aside>
                        </div>
                        <div class="type">
                            <i><img src="assets/icons/restaurants-bars/restaurants/restaurant.png" alt=""></i>
                            <span>Restaurant</span>
                        </div>
                    </div>-->
                    <!--/.info-->
                    <p><?php echo $value->description;?>
                    </p>
                    <a href="<?php echo site_url() ?>/spare_parts/spare_parts_advertisements/spare_part_advertisement_detail_view/<?php echo $value->id; ?>" class="read-more icon">Read More</a>
                </div>
                <!--/.wrapper-->
            </div>
            <!--/.inner-->
        </div>
        <!--/.slide-->
    <?php } ?>
</div>