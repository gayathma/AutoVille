<h2>My Advertisements</h2>

<section id="items">
    <?php
    foreach ($my_advertisements as $my_advertisement) {
        ?>
        <div class="item list admin-view">
            <div class="image">
                <div class="quick-view" data-target="#modal-bar" data-toggle="modal">
                    <i class="fa fa-eye"></i>
                    <span>Quick View</span>
                </div>
                <a href="<?php echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $my_advertisement->id; ?>">
                    <div class="overlay">
                        <div class="inner">
                            <div class="content">
                                <h4>Description</h4>
                                <p><?php echo $my_advertisement->description; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="item-specific">
                        <span class="price"><?php echo "Rs. " . number_format($my_advertisement->price, 2, '.', ','); ?></span>
                    </div>
                    <?php if ($my_advertisement->is_published == '1') { ?>
                        <div class="icon">
                            <i class="fa fa-thumbs-up" title="Approved"></i>
                        </div>
                    <?php } ?>
                    <img  class="lazy" src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $my_advertisement->id . '/' . $my_advertisement->image_path; ?>">
                </a>
            </div>
            <div class="wrapper">
                <a href="<?php echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $my_advertisement->id; ?>">
                    <h3><?php echo $my_advertisement->manufacture . " " . $my_advertisement->model . " " . $my_advertisement->year; ?></h3>
                </a>
                <figure><?php echo substr($my_advertisement->description, 0, strrpos(substr($my_advertisement->description, 0, 50), ' ')); ?> <a href="<?php echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $my_advertisement->id; ?>"> .. <strong>Readmore</strong></a></figure>

                <div class="info">
                    <div class="type">
                        <i>
                            <img alt="" src="<?php echo base_url() . 'application_resources/assets/icons/transportation/road-transportation/caraccident.png' ?>">
                        </i>
                        <span><?php echo $my_advertisement->sale_type; ?></span>
                    </div>
                    <div class="type">
                        <i>
                            <img alt="" src="<?php echo base_url() . 'application_resources/assets/icons/transportation/road-transportation/car.png' ?>">
                        </i>
                        <span><?php echo $my_advertisement->body_type; ?></span>
                    </div>
                    <?php if ($my_advertisement->is_published == '0') { ?>
                        <div class="type label-warning label">
                            <span>Processing Approval</span>
                        </div>
                    <?php } ?>

                    <?php if ($my_advertisement->is_featured == '0') { ?>
                        <span> <button style="background-color: #77ad10" class="btn btn-success btn-small" id="btn_<?php echo $my_advertisement->id ?>" onclick="update_request_featured(<?php echo $my_advertisement->id; ?>, 1, this)">Make Featured </button></span>
                    <?php } else if ($my_advertisement->is_featured == '1') { ?>
                        <div class="type label-warning label">
                            <span>Pending Featured Approval ..</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="description">
                <ul class="list-unstyled actions">
                    <li>
                        <a href="<?php echo site_url(); ?>/vehicle_advertisements/edit_new_advertisement/<?php echo $my_advertisement->id; ?>" title="Edit this advertisement">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </li>
                    <li>
                        <a class="hide-item" href="#">
                            <i class="fa fa-eye"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="delete_advertisement(<?php echo $my_advertisement->id; ?>)" title="Remove this advertisement">
                            <i class="fa fa-trash-o" style="color: red;"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <?php if ($my_advertisement->is_featured == '2') { ?>
                <div class="ribbon approved">
                    <i class="fa fa-check" title="Featured"></i>
                </div>
            <?php } ?>
            <?php if ($my_advertisement->is_published == '2') { ?>
                <div class="ribbon in-queue">
                    <i class="fa fa-thumbs-down" title="Rejected"></i>
                </div>
            <?php } ?>

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

<script src="<?php echo base_url(); ?>application_resources/assets/toastr-master/toastr.js"></script>
<script>
                            //delete advertisement
                            function delete_advertisement(id) {

                                if (confirm('Are you sure want to remove this advertisement from your garage ?')) {

                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo site_url(); ?>/vehicle_advertisements/delete_advertisement',
                                        data: "id=" + id,
                                        success: function(msg) {
                                            if (msg == 1) {
                                                $('#list_' + id).hide();
                                                toastr.success("Successfully removed from your garage !!", "AutoVille");
                                            } else if (msg == 2) {
                                                toastr.error('Error occured. !!', "AutoVille");
                                            }
                                        }
                                    });
                                }
                            }


                            /*
                             * This is to update the is_featured status from 0 to 1- request featured
                             * author- Nadeesha
                             * 
                             */
                            function update_request_featured(advertisement_id, value, element) {

                                var condition = 'Do you want to Featured this Advertisement?';
                                if (value == 0) {
                                    condition = 'Do you want to Remove featured from this Advertisement?';
                                }

                                if (confirm(condition)) {
                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo site_url(); ?>/vehicle_advertisements/request_featured',
                                        data: "id=" + advertisement_id + "&value=" + value,
                                        success: function(msg) {
                                            if (msg == 1) {
                                                $(element).parent().html('<div class="type label-warning label"><span>Pending Featured Approval ..</span></div>');
                                                toastr.success("Successfully Updated !!", "AutoVille");

                                            }
                                        }
                                    });
                                }
                            }
</script>