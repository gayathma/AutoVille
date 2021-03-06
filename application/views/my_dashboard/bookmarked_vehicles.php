<h2>My Bookmarks</h2>


<?php if (!empty($bookmarked_vehicles)) { ?>
    <section id="items">
        <?php
        foreach ($bookmarked_vehicles as $vehicle) {
            ?>
            <div class="item list admin-view" id="list_<?php echo $vehicle->bookmark_id; ?>">
                <div class="image">
                    <div class="quick-view" data-target="#modal-bar" data-toggle="modal">
                        <i class="fa fa-eye"></i>
                        <span>Quick View</span>
                    </div>
                    <a href="<?php echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $vehicle->id; ?>">
                        <div class="overlay">
                            <div class="inner">
                                <div class="content">
                                    <h4>Description</h4>
                                    <p><?php echo $vehicle->description; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="item-specific">
                            <span class="price"><?php echo "Rs. " . number_format($vehicle->price, 2, '.', ','); ?></span>
                        </div>
                        <img  class="lazy" src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $vehicle->id . '/' . $vehicle->image_path; ?> ">
                    </a>
                </div>
                <div class="wrapper">
                    <a href="<?php echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $vehicle->id; ?>">
                        <h3><?php echo $vehicle->manufacture . " " . $vehicle->model . " " . $vehicle->year; ?></h3>
                    </a>
                    <figure><?php echo substr($vehicle->description, 0, strrpos(substr($vehicle->description, 0, 50), ' ')); ?> <a href="<?php echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $vehicle->id; ?>"> .. <strong>Readmore</strong></a></figure>

                    <div class="info">
                        <div class="type">
                            <i>
                                <img alt="" src="<?php echo base_url() . 'application_resources/assets/icons/transportation/road-transportation/caraccident.png' ?>">
                            </i>
                            <span><?php echo $vehicle->sale_type; ?></span>
                        </div>
                        <div class="type">
                            <i>
                                <img alt="" src="<?php echo base_url() . 'application_resources/assets/icons/transportation/road-transportation/car.png' ?>">
                            </i>
                            <span><?php echo $vehicle->body_type; ?></span>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <ul class="list-unstyled actions">
                        <li>
                            <a href="#" onclick="remove_bookmark(<?php echo $vehicle->bookmark_id; ?>)" title="Remove Bookmark">
                                <i class="fa fa-trash-o" style="color: red;"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
        }
        ?>
    </section>
    <nav>
        <ul class="pagination pull-right">
            <?php echo $links; ?>
        </ul>
    </nav>
<?php } else { ?>
    <h3>No Result Found</h3>
<?php } ?>



<script type="text/javascript">

    function remove_bookmark(bookmark_id) {

        if (confirm('Remove Bookmark?')) {

            $.ajax({
                type: "POST",
                url: site_url + '/bookmarked_vehicles/remove_bookmark',
                data: "bookmark_id=" + bookmark_id,
                success: function(msg) {
                    if (msg != 0) {
                        toastr.success("Bookmark Removed Successfully!!", "AutoVille");
                        $('#list_' + bookmark_id).hide();
                    } else {
                        alert('Error!');
                    }
                }
            });
        }

    }
</script>