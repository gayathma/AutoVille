<div class="container">
    <header><h2>Featured Vehicles</h2></header>
    <div class="row">

        <!--Featured Vehicles-->
        <?php
        $resultcount = count($featured_vehicles);
        if (!$resultcount == 0) {
            ?>

            <?php foreach ($featured_vehicles as $result) { ?>
                <div class="col-md-3 col-sm-3">
                    <div class="item featured">
                        <div class="image">
                            <div class="quick-view" id="1"><i class="fa fa-eye"></i><span>Quick View</span></div>
                            <a href="<?php echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $result->id; ?>">
                                <div class="overlay">
                                    <div class="inner">
                                        <div class="content">
                                            <h4>Description</h4>
                                            <p><?php echo $result->description; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!--                            <div class="item-specific">
                                                                <span title="Bedrooms"><img src="assets/img/bedrooms.png" alt="">2</span>
                                                                <span title="Bathrooms"><img src="assets/img/bathrooms.png" alt="">2</span>
                                                                <span title="Area"><img src="assets/img/area.png" alt="">240m<sup>2</sup></span>
                                                                <span title="Garages"><img src="assets/img/garages.png" alt="">1</span>
                                                            </div>-->
                                <div class="icon">
                                    <i class="fa fa-thumbs-up"></i>
                                </div>
                                <img src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $result->id . '/' . $result->image_path; ?>" height="180" width="260" alt=""/>
                            </a>
                        </div>
                        <div class="wrapper">
                            <a href="">
                                <h3><?php echo $result->manufacture . " " . $result->model; ?></h3></a>
                             <figure><?php echo $result->body_type; ?></figure>
                            <div class="info">
                                <div class="type">
                                    <i><img src="assets/img/hotel-last-minute.jpg" alt=""></i>
                                    <dl>
                            <?php if (!is_null($result->fuel_type)) { ?>
                                        <dt>Engine</dt>
                                        <dd><?php echo $result->fuel_type; ?></dd>
                                    <?php } ?>

                                    <?php if (!is_null($result->kilometers)) { ?>
                                        <dt>Kilometers</dt>
                                        <dd><?php echo $result->kilometers; ?></dd>
                                    <?php } ?>

                                    <?php if (!is_null($result->year)) { ?>
                                        <dt>Year</dt>
                                        <dd><?php echo $result->year; ?></dd>
                                    <?php } ?>
                        </dl>
                                </div>
                                <!--<div class="rating" data-rating="4"></div>-->
                            </div>
                        </div>
                    </div>
                    <!-- /.item-->
                </div>
            <?php } ?>
        <?php } ?>
        <!-- /.item-->
    </div>
    <!--/.col-sm-4-->
</div>
