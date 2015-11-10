<div class="row">
    <?php foreach ($featured_spare_parts as $value) { ?>
        <div class="col-md-3 col-sm-3">
            <div class="item featured">
                <div class="image">
                    <div class="quick-view" id="1"><i class="fa fa-eye"></i><span>Quick View</span></div>
                    <a href="item-detail.html">
                        <div class="overlay">
                            <div class="inner">
                                <div class="content">
                                    <h4><?php echo $value->name;?></h4>
                                    <p>Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa</p>
                                </div>
                            </div>
                        </div>
                        <div class="item-specific">
                            <span title="Bedrooms"><img src="http://themestarz.net/html/spotter/http://themestarz.net/html/spotter/assets/img/bedrooms.png" alt="">2</span>
                            <span title="Bathrooms"><img src="http://themestarz.net/html/spotter/http://themestarz.net/html/spotter/assets/img/bathrooms.png" alt="">2</span>
                            <span title="Area"><img src="http://themestarz.net/html/spotter/http://themestarz.net/html/spotter/assets/img/area.png" alt="">240m<sup>2</sup></span>
                            <span title="Garages"><img src="http://themestarz.net/html/spotter/http://themestarz.net/html/spotter/assets/img/garages.png" alt="">1</span>
                        </div>
                        <div class="icon">
                            <i class="fa fa-thumbs-up"></i>
                        </div>
                        <img src="http://themestarz.net/html/spotter/http://themestarz.net/html/spotter/assets/img/items/1.jpg" alt="">
                    </a>
                </div>
                <div class="wrapper">
                    <a href="item-detail.html"><h3><?php echo $value?></h3></a>
                    <figure>63 Birch Street</figure>
                    <div class="info">
                        <div class="type">
                            <i><img src="assets/icons/restaurants-bars/restaurants/restaurant.png" alt=""></i>
                            <span>Restaurant</span>
                        </div>
                        <div class="rating" data-rating="4"></div>
                    </div>
                </div>
            </div>
            <!-- /.item-->
        </div> 
    <?php } ?>
</div>