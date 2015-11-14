<h2>Saved Searches</h2>
<div>
    <div class="dashboard-block">
        <div class="">
            <table class="table table-bordered table-striped  dashboard-tables saved-cars-table">
                <thead>
                    <tr>
                        <td>Description</td>
                        <td>Price</td>
                        <td>Timestamp</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $vehicle_images_service = new Vehicle_images_service();
                    foreach ($my_advertisements as $my_advertisement) {
                        $image = $vehicle_images_service->get_images_for_advertisement_one($my_advertisement->id);
                        ?>
                        <tr id="list_<?php echo $my_advertisement->search_id; ?>">
                            <td>
                                <a class="car-image" href="<?php echo site_url() . '/vehicle_advertisements/vehicle_advertisement_detail_view/' . $my_advertisement->id; ?>">
                                    <img  class="lazy" src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $my_advertisement->id . '/thumbnail/' . $image->image_path; ?>">
                                </a>

                                <h5>
                                    <a href="<?php echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $my_advertisement->id; ?>"><?php echo $my_advertisement->manufacture . " " . $my_advertisement->model . " " . $my_advertisement->year; ?></a>
                                </h5>
                                <ul class="inline list-unstyled">
                                    <li>
                                        <i class="fa fa-caret-right"></i>
                                        <?php echo $my_advertisement->body_type; ?>
                                    </li>

                                </ul>

                            </td>
                            <td>
                                <div class="price"> <?php echo "Rs. " . number_format($my_advertisement->price, 2, '.', ','); ?></div>
                            </td>

                            <td><span class="text-success"><?php echo date('d M Y H:i a', strtotime($my_advertisement->date)); ?></span></td>

                            <td align="center">
                                <a href="#" onclick="delete_advertisement(<?php echo $my_advertisement->search_id; ?>)" title="Remove"> <i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <nav>
        <ul class="pagination pull-right">
            <?php echo $links; ?>
        </ul>
    </nav>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/toastr-master/toastr.js"></script>
<script>
                                    //delete advertisement
                                    function delete_advertisement(id) {

                                        $.ajax({
                                            type: "POST",
                                            url: '<?php echo site_url(); ?>/dashboard/delete_saved_search',
                                            data: "id=" + id,
                                            success: function(msg) {
                                                if (msg == 1) {
                                                    $('#list_' + id).hide();
                                                    toastr.success("Successfully removed  !!", "AutoVille");
                                                } else if (msg == 2) {
                                                    toastr.error('Error occured. !!', "AutoVille");
                                                }
                                            }
                                        });
                                    }
</script>