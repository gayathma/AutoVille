<!-- page start-->
<section class="panel">
    <header class="panel-heading">
        All Advertisements
<!--        <span class="pull-right">
            <button type="button" onclick="reload_advertisements()" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</button>
        </span>-->
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-lg-2 col-sm-2">
                        <select class="form-control input-sm m-bot15">
                            <?php foreach ($reg_users as $result) { ?>
                                <option id="<?php echo $result->id; ?>"><?php echo $result->name; ?></option>
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
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>                    
                    <th>Category</th>
                    <th>Vehicle</th>
                    <th>Active Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($approved_ads as $result) { ?>
                    <tr id="advertisement_<?php echo $result->id; ?>">
                        <td class="p-team">
                            <?php echo $result->name; ?>
                        </td>
                        <td align="center"><img src="<?php echo base_url(); ?>uploads/spare_part_images/<?php echo $result->image; ?>" width="60px" /></td>
                        <td class="p-team">
                            <?php echo $result->price; ?>
                        </td>
                        <td class="p-team">
                            <?php echo $result->category; ?>
                        </td>
                        <td class="p-team">
                            <td><?php echo ($result->manufacture . ' ' . $result->model . ' ' . $result->year); ?></td>
                        </td>
                        <td>
                            <?php if ($result->is_featured == '2') { ?>
                                <span class="label label-primary">Featured</span>
                                <a class="btn btn-success btn-xs"  onclick="change_featured_status(<?php echo $result->id; ?>, 1, this);"><i class="fa fa-arrow-up " title="Remove Featured"></i></a> 
                            <?php } elseif ($result->is_featured == '1') { ?>
                                <span class="label label-default">Pending</span> 
                                <a class="btn btn-success btn-xs"  onclick="change_featured_status(<?php echo $result->id; ?>, 2, this);"><i class="fa fa-arrow-up " title="activate Featured"></i></a> 
                            <?php } else { ?>
                                <span class="label label-danger">Disable</span>  
                            <?php } ?> 
                        </td>
    <!--                        <td>
                            <a class="btn btn-danger btn-xs"  onclick="delete_advertisement(<?php echo $result->id; ?>);"><i class="fa fa-trash-o " title="Remove"></i></a>
                            <a href="project_details.html" class="btn btn-info btn-xs"><i class="fa fa-folder" title="View"></i></a>

                        </td>-->
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

    function change_featured_status(advertisement_id, value, element) {

        var condition = 'Do you want to make this advertisement Not Feaured ?';
        if (value == 2) {
            condition = 'Do you want to make this advertisement Featured?';
        }

        if (confirm(condition)) {
            $.ajax({
                type: "POST",
                url: site_url + '/spare_part_advertisement/change_featured_status',
                data: "id=" + advertisement_id + "&value=" + value,
                success: function (msg) {
                    if (msg == 1) {
                        if (value == 1) {
                            $(element).parent().html('<span class="label label-default">Pending</span><a class="btn btn-success btn-xs"  onclick="change_advertisement_status(<?php echo $result->id; ?>, 2, this);"><i class="fa fa-arrow-up " title="Remove Featured"></i></a> ');
                        } else {
                            $(element).parent().html('<span class="label label-primary">Featured</span><a class="btn btn-success btn-xs"  onclick="change_advertisement_status(<?php echo $result->id; ?>, 1, this);"><i class="fa fa-arrow-up " title="activate Featured"></i></a>  ');
                        }

                    } else if (msg == 2) {
                        alert('Error !!');
                    }
                }
            });
        }
    }

    //Reloading advertisements
//    function reload_advertisements() {
//        $('#advertisement_div').html('<center><div class="load-anim"><i id="animate-icon" class="fa fa-spinner fa-3x fa-spin loader-icon-margin"></i></div></center>');
//        var x = $('.load-anim').show().delay(5000);
//        $.post(site_url + '/vehicle_advertisements/search_advertisements', {}, function (msg) {
//            $('#advertisement_div').html('');
//            $('#advertisement_div').html(msg);
//            x.fadeOut('slow');
//        });
//    }
    
    

</script>


<!-- active selected menu -->

<script type="text/javascript">
    $('#advertisements_menu').addClass('active');
</script>