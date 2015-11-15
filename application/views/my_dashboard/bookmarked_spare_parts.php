<h2>My Bookmarks</h2>


<?php if (!empty($bookmarked_spare_parts)) { ?>
    <section id="items">
        <?php
        foreach ($bookmarked_spare_parts as $vehicle) {
            ?>
            <div class="item list admin-view" id="list_<?php echo $vehicle->bookmark_id; ?>">
                <div class="image">
                    <div class="quick-view" data-target="#modal-bar" data-toggle="modal">
                        <i class="fa fa-eye"></i>
                        <span>Quick View</span>
                    </div>
                    <a href="<?php echo site_url() ?>/spare_parts/spare_parts_advertisements/spare_part_advertisement_detail_view/<?php echo $vehicle->id; ?>">
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
                        <img src="<?php echo base_url() . 'uploads/spare_part_images/' . $vehicle->image; ?>" height="180" width="260" alt=""/>
                     
                    </a>
                </div>
                <div class="wrapper">
                    <a href="<?php echo site_url() ?>/spare_parts/spare_parts_advertisements/spare_part_advertisement_detail_view/<?php echo $vehicle->id; ?>">
                        <h3><?php echo $vehicle->manufacture . " " . $vehicle->model . " " . $vehicle->year; ?></h3>
                    </a>
                    <figure><?php echo substr($vehicle->description, 0, strrpos(substr($vehicle->description, 0, 50), ' ')); ?> <a href="<?php echo site_url() ?>/spare_parts/spare_parts_advertisements/spare_part_advertisement_detail_view/<?php echo $vehicle->id; ?>"> .. <strong>Readmore</strong></a></figure>
                    
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
                url: site_url + '/spare_parts/bookmarked_spare_parts/remove_bookmark',
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