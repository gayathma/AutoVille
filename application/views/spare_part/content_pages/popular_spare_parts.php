<div class="owl-carousel wide carousel">
    <?php foreach ($new_arrivals as $value) {?>
        
   
    <div class="slide">
        <div class="inner">
            <div class="image">
                <div class="item-specific">
                    <div class="inner">
                        <div class="content">
                            
                        </div>
                    </div>
                </div>
                <img src="http://themestarz.net/html/spotter/http://themestarz.net/html/spotter/assets/img/items/restaurant/8.jpg" alt="">
            </div>
            <div class="wrapper">
                <a href="item-detail.html"><h3><?php echo $value->name;?></h3></a>
                <figure>
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
                </div>
                <!--/.info-->
                <p>Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut,
                    imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis.
                    Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra dui...
                </p>
                <a href="item-detail.html" class="read-more icon">Read More</a>
            </div>
            <!--/.wrapper-->
        </div>
        <!--/.inner-->
    </div>
    <!--/.slide-->
    <?php }?>
</div>