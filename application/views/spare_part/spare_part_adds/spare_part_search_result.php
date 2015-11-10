<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/raty/jquery.raty.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/raty/jquery.raty.css">

<style type="text/css">
    .star_class > img{
        max-height: 16px;
        max-width: 16px !important;
    }    
</style>


<div class="layer-two">

    <div id="cars-list" class="grid-view list-content">

        <?php
        $resultcount = count($results);
        if ($resultcount == 0) {
            ?>
            <h4>No Result Found</h4>
            <?php
        } else {
            //normal search         
            if ($resultcount == 3 || $resultcount > 3) {
                $class_no = 4;
            } else if ($resultcount == 2) {
                $class_no = 4;
            } else if ($resultcount == 1) {
                $class_no = 4;
            }
            ?>
            <div class="row">
                <?php foreach ($results as $result) { ?>
                    <!--one result-->
                    <div class="col-md-<?php echo $class_no; ?> col-sm-<?php echo $class_no; ?>">
                        <div class="item" >
                            <div class="image">
                                <div class="quick-view"><i class="fa fa-plus"></i><span>Park & Compare</span></div>
                                <a href="<?php //echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $result->id; ?>">
                                    <div class="overlay">
                                        <div class="inner">
                                            <div class="content">
                                                <h4>Description</h4>
                                                <p><?php echo $result->description; ?></p>
                                            </div>
                                        </div>
                                    </div>                                                                                             
                                    <img src="<?php echo base_url() . 'uploads/spare_part_images/vh_' . $result->id . '/' . $result->image; ?>" height="180" width="260" alt=""/>
                                </a>
                            </div>
                            <div class="wrapper">
                                <h3><?php echo $result->name; ?> </h3>

                                <figure><?php echo $result->category; ?></figure>
                                <div class="price"><?php echo "Rs. " . CurrencyFormat($result->price); ?></div>
                                <br>

                                <?php if ($result->is_featured == '2') { ?>
                                    <div class="type label-success label">
                                        <span>Featured</span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>                
                    </div>
                    <!--end one result-->
                <?php } ?>
            </div>
            <?php }  ?>				

        </div>

    </div><!--.layer-two-->

    <div class="layer-three pull-right">
        <div class="pagination">
            <?php echo $links; ?>
        </div>											
    </div>

    <?php

    function CurrencyFormat($number) {
        $decimalplaces = 2;
        $decimalcharacter = '.';
        $thousandseparater = ',';
        return number_format($number, $decimalplaces, $decimalcharacter, $thousandseparater);
    }
    ?>




