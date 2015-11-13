<!-- page start-->
<section class="panel">
    <header class="panel-heading">
        All Advertisements
        <span class="pull-right">
            <button type="button" onclick="reload_advertisements()" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</button>
        </span>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-lg-2 col-sm-2">
                        <select class="form-control input-sm m-bot15">
                            <?php foreach ($reg_users as $user) { ?>
                                <option id="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-7">
                        <div class="col-md-5">
                            <input type="text" placeholder="Search Here" class="input-sm form-control">
                        </div>
                        <div class="col-md-2">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-success"> Go!</button> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="advertisement_div"> 
        <table class="table table-hover p-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Chassis No</th>
                    <th>Transmission</th>
                    <th>Fuel Type</th>
                    <th>Body Type</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Added By</th>
                    <th>Active Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result) { ?>
                    <tr id="advertisement_<?php echo $result->id; ?>">
                        <td class="p-name">
                            <a href="project_details.html"><?php echo ucfirst($result->manufacture . ' ' . $result->model . ' ' . $result->year); ?></a>
                            <br>
                            <small>Created <?php echo date('Y-m-d', strtotime($result->added_date)); ?></small>
                        </td>
                        <td class="p-team">
                            <?php echo $result->chassis_no; ?>
                        </td>
                        <td class="p-team">
                            <?php echo $result->transmission; ?>
                        </td>
                        <td class="p-team">
                            <?php echo $result->fuel_type; ?>
                        </td>
                        <td class="p-team">
                            <?php echo $result->body_type; ?>
                        </td>
                        <td class="p-team">
                            <?php echo $result->colour; ?>
                        </td>
                        <td class="p-progress">
                            <?php echo $result->price; ?>
                        </td>
                        <td class="p-progress">
                            <?php echo $result->added_by_user; ?>
                        </td>
                        <td>
                            <?php if ($result->is_published == '1') { ?>
                                <span class="label label-primary">Active</span>
                                <a class="btn btn-success btn-xs"  onclick="change_advertisement_status('<?php echo $result->id; ?>', '2', this, '<?php echo $result->added_by; ?>', '<?php echo $result->id; ?>');"><i class="fa fa-arrow-up " title="Reject Advertisement"></i></a> 
                            <?php } elseif ($result->is_published == '0') { ?>
                                <span class="label label-default">Pending</span> 
                                <a class="btn btn-success btn-xs"  onclick="change_advertisement_status('<?php echo $result->id; ?>', '1', this, '<?php echo $result->added_by; ?>', '<?php echo $result->id; ?>');"><i class="fa fa-arrow-up " title="Approve Advertisement"></i></a> 
                            <?php } else { ?>
                                <span class="label label-danger">Rejected</span>  
                            <?php } ?>


                        </td>
                        <td>
                            <a class="btn btn-danger btn-xs"  onclick="delete_advertisement(<?php echo $result->id; ?>);"><i class="fa fa-trash-o " title="Remove"></i></a>
                            <a href="project_details.html" class="btn btn-info btn-xs"><i class="fa fa-folder" title="View"></i></a>

                        </td>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
<!-- page end-->


<script type="text/javascript">
    //delete advertisement
    function delete_advertisement(id) {

        if (confirm('Are you sure want to delete this Vehicle Advertisement ?')) {

            $.ajax({
                type: "POST",
                url: site_url + '/vehicle_advertisements/delete_advertisement',
                data: "id=" + id,
                success: function (msg) {
                    //alert(msg);
                    if (msg == 1) {
                        //document.getElementById(trid).style.display='none';
                        $('#advertisement_' + id).hide();
                    }
                    else if (msg == 2) {
                        alert('Cannot be deleted as it is already assigned to others. !!');
                    }
                }
            });
        }
    }

    function change_advertisement_status(advertisement_id, value, element, seller_id, vehicle_id) {

        var condition = 'Do you want to approve this advertisement ?';
        if (value == 2) {
            condition = 'Do you want to reject this advertisement?';
        }

        if (confirm(condition)) {

//            $.post(site_url + '/vehicle_advertisements/change_publish_status', {id: advertisement_id, value: value, seller_id: seller_id, vehicle_id: vehicle_id}, function (msg) {
//                if (msg == 1) {
//                    if (value == 1) {
//                        $(element).parent().html('<span class="label label-primary">Active</span><a class="btn btn-success btn-xs"  onclick="change_advertisement_status(' + advertisement_id + ', 2, this,' + seller_id + ',' + vehicle_id + ');"><i class="fa fa-arrow-up " title="Reject Advertisement"></i></a> ');
//                    } else {
//                        $(element).parent().html('<span class="label label-danger">Rejected</span> ');
//                    }
//
//                } else if (msg == 2) {
//                    alert('Error !!');
//                }
//            });
            $.ajax({
                type: "POST",
                url: site_url + '/vehicle_advertisements/change_publish_status',
                data: {id: advertisement_id, value: value, seller_id: seller_id, vehicle_id: vehicle_id},
                success: function(msg) {
                    
                    if (msg == 1) {
                        if (value == 1) {
                            $(element).parent().html('<span class="label label-primary">Active</span><a class="btn btn-success btn-xs"  onclick="change_advertisement_status(' + advertisement_id + ', 2, this,' + seller_id + ',' + vehicle_id + ');"><i class="fa fa-arrow-up " title="Reject Advertisement"></i></a> ');
                        } else {
                            $(element).parent().html('<span class="label label-danger">Rejected</span> ');
                        }

                    } else if (msg == 2) {
                        alert('Error !!');
                    }
                }
            });
        }
    }

    //Reloading advertisements
    function reload_advertisements() {
        $('#advertisement_div').html('<center><div class="load-anim"><i id="animate-icon" class="fa fa-spinner fa-3x fa-spin loader-icon-margin"></i></div></center>');
        var x = $('.load-anim').show().delay(5000);
        $.post(site_url + '/vehicle_advertisements/search_advertisements', {}, function (msg) {
            $('#advertisement_div').html('');
            $('#advertisement_div').html(msg);
            x.fadeOut('slow');
        });
    }

</script>


<!-- active selected menu -->

<script type="text/javascript">
    $('#advertisements_menu').addClass('active');
</script>