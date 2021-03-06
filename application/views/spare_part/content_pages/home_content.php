<!-- Map Canvas-->
<div class="map-canvas list-width-30">
    <!-- Map -->    
    <div class="map">
        <?php echo $this->load->view('spare_part/content_pages/search_bar'); ?> 
    </div>
    <!-- end Map -->
        

    <!--Items List-->
    <?php echo $this->load->view('spare_part/content_pages/categories'); ?>
    <!--end Items List-->
</div>
<!-- end Map Canvas-->
<!--Featured-->
<section id="featured" class="block background-color-grey-dark equal-height">
    <div class="container">
        <header><h2>Featured</h2></header>
        <?php echo $this->load->view('spare_part/content_pages/featured_spare_parts'); ?>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
<!--end Featured-->

<!--Popular-->
<section id="popular" class="block background-color-white">
    <div class="container">
        <header><h2>New Arrivals- Spare Parts</h2></header>
        <?php echo $this->load->view('spare_part/content_pages/popular_spare_parts'); ?>
        <!--/.owl-carousel-->
    </div>
    <!--/.container-->
</section>
<!--end Popular-->
