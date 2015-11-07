<!--Vehicle Image-->
<section class="hero-image search-filter-bottom">
    <?php echo $this->load->view('vehicle_adds/load_vehicle_sepecs_for_search'); ?>
</section>
<!--end Vehicle Image-->

<!--Featured Vehicles-->
<section id="featured" class="block background-color-grey-dark equal-height">
    <?php echo $this->load->view('vehicle_adds/featured_vehicles'); ?>    
</section>
<!--end Featured-->

<!--Categories-->
<section id="manufacturer_list" class="block background-color-white">
    <?php echo $this->load->view('manufacturers/manufacture_list_view'); ?>
</section>
<!--end Categories-->


<!--Price Drop-->
<section id="price-drop" class="block equal-height">
    <?php echo $this->load->view('vehicle_adds/price_drop_vehicles'); ?>
</section>
<!--end Price Drop-->


<!--Popular Vehicles-->
<section id="popular" class="block background-color-white">
    <?php echo $this->load->view('vehicle_adds/popular_vehicles'); ?>    
</section>
<!--end Popular vehicles-->

<!--Recent-->
<?php echo $this->load->view('vehicle_adds/recent_adds'); ?>
<!--end Recent-->

<!--Why Us-->
<section id="why-us" class="block background-color-grey-dark">
    <?php echo $this->load->view('content_pages/why_us'); ?>
</section>
<!--end Why Us-->

<!--Partners-->
<section id="partners" class="block">
    <div class="container">
        <header><h2>Partners</h2></header>
        <div class="logos">
            <?php for ($i = 0; $i <= 4; $i++) { ?>
                <div class="logo"><a href=""><img src="<?php echo base_url() . 'uploads/manufacture_logo/' . $names[$i]->logo; ?>" width="76" alt=""></a></div>                
            <?php } ?>
        </div>
    </div>
</section>
<!--end Partners-->

<section id="subscribe" class="block">
    <div class="container">
        <header>
            <h2>Subscribe</h2>
        </header>
        <form class="subscribe form-inline border-less-inputs" role="form" method="post" action="?">
            <div class="input-group">
                <input id="subscribe_email" class="form-control" type="email" placeholder="Enter your email and get the newest updates">
                <span class="input-group-btn">
                    <button class="btn btn-default btn-large" type="button">
                        Subscribe
                        <i class="fa fa-angle-right"></i>
                    </button>
                </span>
            </div>
        </form>
    </div>
</section>
