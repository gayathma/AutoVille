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
                <input type="hidden" id="user_loged_id" value="<?php echo $this->session->userdata('USER_ID'); ?>"/>
                <?php foreach ($results as $result) { ?>
                    <!--one result-->
                    <div class="col-md-<?php echo $class_no; ?> col-sm-<?php echo $class_no; ?>">
                        <div class="item" >
                            <div class="image">
                                <div class="quick-view">
                                    <i class="fa fa-plus"  onclick="add_to_cart('<?php echo $result->id; ?>')" ></i><span>Add To Cart</span>
                                </div>       

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
                                <h3><?php echo $result->name; ?> 
                                    <?php if ($this->session->userdata('USER_LOGGED_IN')) { ?>

                                        <!--Bookmark-->
                                        <?php
                                        $bookmarked_spare_parts_service = new Bookmarked_spare_parts_service();
                                        $bookmarked_spare_part_det      = $bookmarked_spare_parts_service->get_bookmarkd_spare_part($this->session->userdata('USER_ID'), $result->id);
                                        ?>                                        

                                        <!--Add New Bookmark-->
                                        <?php if (empty($bookmarked_spare_part_det)) { ?>

                                            <input type="hidden" id="bookmark_id_<?php echo $result->id; ?>" value="0">
                                            <input type="hidden" id="bookmark_status_<?php echo $result->id; ?>" value="0">

                                            <span id="add_bookmark_div_<?php echo $result->id; ?>">
                                                <a class="star_class" style="cursor: pointer" onclick="bookmark('<?php echo $result->id; ?>')">              
                                                    <img alt="1" id="star_img_<?php echo $result->id; ?>" src="<?php echo base_url(); ?>application_resources/raty/images/star-off.png" title="Bookmark">
                                                </a>                                         
                                            </span> 

                                            <!--Remove Bookmark-->
                                        <?php } else { ?>
                                            <input type="hidden" id="bookmark_id_<?php echo $result->id; ?>" value="<?php echo $bookmarked_spare_part_det->bookmarked_id; ?>">
                                            <input type="hidden" id="bookmark_status_<?php echo $result->id; ?>" value="1">

                                            <span id="bookmarked_div_<?php echo $result->id; ?>">
                                                <a class="star_class" style="cursor: pointer" onclick="bookmark('<?php echo $result->id; ?>')">              
                                                    <img alt="1" id="star_img_<?php echo $result->id; ?>" src="<?php echo base_url(); ?>application_resources/raty/images/star-on.png" title="Remove Bookmark">
                                                </a>
                                            </span>
                                        <?php } ?>
                                        <!--End Bookmark-->

                                    <?php } ?>
                                </h3>

                                <figure><?php echo $result->category; ?></figure>
                                <div class="price"><?php echo "Rs. " . number_format($result->price, 2); ?></div>
                                <br>

                                <?php if ($result->is_featured == '1') { ?>
                                    <div class="type label-success label">
                                        <span>Featured</span>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="wrapper">
                                <h3>


                                </h3>    
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
                                        if ($('#user_loged_id').val()) {
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
                                        } else {
                                            toastr.danger("Please log in to continue !!", "AutoVille");
                                        }

                                    }

//bookmark spare part
                                    function bookmark(spare_part_id) {

                                        var bookmark_status = $('#bookmark_status_' + spare_part_id).val();
                                        var bookmark_id = $('#bookmark_id_' + spare_part_id).val();

                                        if (bookmark_status == '0') {
                                            //add bookmark
                                            if (confirm('Bookmark this Vehicle?')) {

                                                $.ajax({
                                                    type: "POST",
                                                    url: site_url + '/spare_parts/bookmarked_spare_parts/bookmark_spare_part',
                                                    data: "spare_part_id=" + spare_part_id,
                                                    success: function (msg) {
                                                        if (msg != 0) {
                                                            toastr.success("Successfully Bookmarked!!", "AutoVille");
                                                            $('#bookmark_status_' + spare_part_id).val('1');
                                                            $('#bookmark_id_' + spare_part_id).val(msg);
                                                            $('#star_img_' + spare_part_id).attr('src', '<?php echo base_url(); ?>application_resources/raty/images/star-on.png');
                                                            $('#star_img_' + spare_part_id).attr('title', 'Remove Bookmark');
                                                        } else {
                                                            alert('Error!');
                                                        }
                                                    }
                                                });
                                            }

                                        } else if (bookmark_status == '1') {
                                            //remove bookmark
                                            if (confirm('Remove Bookmark?')) {

                                                $.ajax({
                                                    type: "POST",
                                                    url: site_url + '/spare_parts/bookmarked_spare_parts/remove_bookmark',
                                                    data: "bookmark_id=" + bookmark_id,
                                                    success: function (msg) {
                                                        if (msg != 0) {
                                                            toastr.success("Bookmark Removed Successfully!!", "AutoVille");
                                                            $('#bookmark_status_' + spare_part_id).val('0');
                                                            $('#bookmark_id_' + spare_part_id).val('0');
                                                            $('#star_img_' + spare_part_id).attr('src', '<?php echo base_url(); ?>application_resources/raty/images/star-off.png');
                                                            $('#star_img_' + spare_part_id).attr('title', 'Bookmark');
                                                        } else {
                                                            alert('Error!');
                                                        }
                                                    }
                                                });
                                            }
                                        }

                                    }

</script>


