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
                $class_no = 3;
            } else if ($resultcount == 2) {
                $class_no = 3;
            } else if ($resultcount == 1) {
                $class_no = 3;
            }
            ?>
            <h4>Results</h4>
            <div class="row">
                <?php foreach ($results as $result) { ?>
                    <!--one result-->
                    <div class="col-md-<?php echo $class_no; ?> col-sm-<?php echo $class_no; ?>">
                        <div class="item" >
                            <div class="image">
                                <div class="quick-view"><i class="fa fa-plus" 
                                    <?php if (!$this->session->userdata('USER_LOGGED_IN')) { ?>                                                               
                                                               onclick="add_to_cart(<?php echo $result->id; ?>)"
                                                           <?php } ?>
                                                           ></i><span>Add To Cart</span></div>                          

                                <a href="<?php echo site_url() ?>/spare_parts/spare_parts_advertisements/spare_part_advertisement_detail_view/<?php echo $result->id; ?>">
                                    <div class="overlay">
                                        <div class="inner">
                                            <div class="content">
                                                <h4>Description</h4>
                                                <p><?php echo $result->description; ?></p>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="item-specific">
                                        <span></span>
                                    </div>
                                    <img src="<?php echo base_url() . 'uploads/spare_part_images/' . $result->image; ?>" height="180" width="260" alt=""/>
                                </a>
                            </div>
                            <div class="wrapper">
                                <h3><?php echo $result->name; ?> </h3>

                                <figure><?php echo $result->category; ?></figure>
                                <div class="price"><?php echo "Rs. " . number_format($result->price,2); ?></div>
                                <br>

                                <?php if ($result->is_featured == '1') { ?>
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
        <?php } ?>				

    </div>

</div><!--.layer-two-->

<div class="layer-three pull-right">
    <div class="pagination">
        <?php echo $links; ?>
    </div>											
</div>

<script type="text/javascript">

    function setting_pagination_content(url) {

        $.post(url, {}, function (msg)
        {
            $('#spareparts_search_results').html(msg);
        });
    }

    //add spare parts to the cart
    function add_to_cart(id) {
        
        //alert('added');

        $.ajax({
            type: "POST",
            url: site_url + '/spare_parts/cart/add_items_to_cart',
            data: "id=" + id,
            success: function (msg) {
                if (msg != 0) {
                    toastr.success("Successfully added to the cart!!", "AutoVille");                    
                } else {
                    alert('Error loading vehicles');
                }
            }
        });

    }

</script>


