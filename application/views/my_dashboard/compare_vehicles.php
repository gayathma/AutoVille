<h2>Compare Vehicles</h2>
<div>
    <div class="dashboard-block">
        <div class="">
            <table class="table table-bordered table-striped">                

                <tr>
                    <th>Vehicle</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><img src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $result->id . '/' . $result->image_path; ?>" height="80" width="160" alt=""/></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th></th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><h4><?php echo $result->manufacture . " " . $result->model . " " ?>
                                <?php
                                if (!is_null($result->year)) {
                                    echo $result->year;
                                }
                                ?></h4></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Price</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo "Rs. " . number_format($result->price, 2, '.', ','); ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <?php if ($this->session->userdata('USER_LOGGED_IN')) { ?>
                        <th>Actions</th>    
                        <?php foreach ($vehicle_list as $result) { ?>
                            <td align="center"><a href="#"><i class="fa fa-trash-o" onclick="delete_compared_vehicle(<?php echo $result->id; ?>)"></i></a></td>      
                        <?php } ?>
                    <?php } ?>
                </tr>        

                <!--Main Details-->
                <tr><td style="border:0px solid black;"><h2>Main Details</h2></td></tr>


                <tr>
                    <th>Manufacturer</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->manufacture; ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Model</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->model; ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Build(year)</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->year; ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Body Type</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->body_type; ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Transmission</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->transmission; ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Fuel</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->fuel_type; ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Chassis No</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->chassis_no; ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Mileage (in km)</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->kilometers; ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Color</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->colour; ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Condition</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->sale_type; ?></td>
                    <?php } ?>
                </tr>

                <tr>
                    <th>Doors</th>
                    <?php foreach ($vehicle_list as $result) { ?>
                        <td><?php echo $result->doors; ?></td>
                    <?php } ?>
                </tr>

                <!--Equipments-->
                <tr><td style="border:0px solid black;"><h2>Equipments</h2></td></tr>

                <?php foreach ($equipments as $equipment) { ?>
                    <tr>
                        <th><?php echo $equipment->name; ?></th>

                        <?php
                        foreach ($vehicle_equipments as $vehicle_equipment) {

                            $is_contain = FALSE;
                            foreach ($vehicle_equipment as $v => $value) {

                                if (strcmp($equipment->name, $value->name) == 0) {
                                    $is_contain = TRUE;
                                }
                            }

                            if ($is_contain == TRUE) {
                                ?>
                                <td align="center"><i class="fa fa-check"></i></td>

                            <?php } else { ?>
                                <td align="center"><i class="fa fa-minus"></i></td>

                                <?php
                            }
                        }
                        ?>
                    </tr>
                <?php } ?>


            </table>
        </div>
    </div>

</div>


<script src="<?php echo base_url(); ?>application_resources/assets/toastr-master/toastr.js"></script>

<script>
                                //delete vehicle added to compare
                                function delete_compared_vehicle(id) {

                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo site_url(); ?>/vehicle_compare/delete_compared_vehicles',
                                        data: "vehicle_id=" + id,
                                        success: function (msg) {

                                            if (msg == 1) {

                                                $.post('<?php echo site_url(); ?>/vehicle_compare/load_compare_vehicles', {}, function (msg)
                                                {
                                                    $('#dashboard_right_content').html(msg);
                                                });

                                                $.ajax({
                                                    type: "POST",
                                                    url: site_url + '/vehicle_compare/load_vehicle_popup',
                                                    success: function (msg) {
                                                        if (msg != 0) {
                                                            $('#compare_vehicle_list').html(msg);
                                                        } else {
                                                            alert('Error loading vehicles');
                                                        }
                                                    }
                                                });

                                                toastr.success("Successfully removed  !!", "AutoVille");

                                            } else if (msg == 2) {
                                                toastr.error('Error occured. !!', "AutoVille");
                                            }
                                        }
                                    });
                                }
</script>