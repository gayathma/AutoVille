<script>
    $(window).load(function () {
        $(".list-slider").owlCarousel({
            rtl: false,
            items: 1,
            responsiveBaseWidth: ".slide",
            nav: true,
            navText: ["", ""]
        });
    });


</script>
<div class="list-slider owl-carousel">
    <?php foreach ($commercial_images as $value) { ?>
        <div class="slide">
            <a href="<?php echo $value->url; ?>" target="_blank"><img src="<?php echo base_url() . 'uploads/commercial_images/' . $value->image; ?>" height="250" width="250" alt=""></a>
        </div>
    <?php } ?>
</div>
<!-- /.list-slider -->
<br>
<br>
<div>
    <?php foreach ($celebrity as $value) { ?>
        <div class="slide item">
            <div class="image">
                <a href="#">
                    <div class="overlay">
                        <div class="inner">
                            <div class="content">
                                <h4><?php echo $value->name; ?></h4>
                                <p><?php echo $value->description; ?></p>
                            </div>
                        </div>
                    </div>
                    <img src="<?php echo base_url() . 'uploads/celebrity/' . $value->image; ?>" height="250" width="250" alt="" title="<?php echo $value->name; ?>">
                </a>
            </div>
        </div>
    <?php } ?>
</div>