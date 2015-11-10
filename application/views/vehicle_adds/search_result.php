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
            if ($is_advance_search == '0') {
                if ($resultcount == 3 || $resultcount > 3) {
                    $class_no = 4;
                } else if ($resultcount == 2) {
                    $class_no = 4;
                } else if ($resultcount == 1) {
                    $class_no = 4;
                }
            } else if ($is_advance_search == '1') {
                //advanced search
                $class_no = 3;
            }
            ?>
            <div class="row">
                <?php foreach ($results as $result) { ?>
                    <!--one result-->
                    <div class="col-md-<?php echo $class_no; ?> col-sm-<?php echo $class_no; ?>">
                        <div class="item" >
                            <div class="image">
                                <div class="quick-view"><i class="fa fa-plus" 
                                    <?php if (!$this->session->userdata('USER_LOGGED_IN')) { ?>
                                                               onclick="save_in_browser(<?php echo $result->id; ?>)"
                                                           <?php } else { ?>                                                               
                                                               onclick="add_to_compare(<?php echo $result->id; ?>)"
                                                           <?php } ?>
                                                           ></i><span>Park & Compare</span></div>
                                <a href="<?php echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $result->id; ?>">
                                    <div class="overlay">
                                        <div class="inner">
                                            <div class="content">
                                                <h4>Description</h4>
                                                <p><?php echo $result->description; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-specific">
                                        <span><?php echo $result->sale_type; ?></span>
                                    </div>                                                            
                                    <img src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $result->id . '/' . $result->image_path; ?>" height="180" width="260" alt=""/>
                                </a>
                            </div>
                            <div class="wrapper">
                                <h3><?php echo $result->manufacture . " " . $result->model; ?>

                                    <?php if ($this->session->userdata('USER_LOGGED_IN')) { ?>

                                        <!--Bookmark-->
                                        <?php
                                        $bookmarked_vehicles_service = new Bookmarked_vehicles_service();
                                        $bookmarked_vehile_det = $bookmarked_vehicles_service->get_bookmarkd_vehicle($this->session->userdata('USER_ID'), $result->id);
                                        ?>                                        

                                        <!--Add New Bookmark-->
                                        <?php if (empty($bookmarked_vehile_det)) { ?>

                                            <input type="hidden" id="bookmark_id_<?php echo $result->id; ?>" value="0">
                                            <input type="hidden" id="bookmark_status_<?php echo $result->id; ?>" value="0">

                                            <span id="add_bookmark_div_<?php echo $result->id; ?>">
                                                <a class="star_class" style="cursor: pointer" onclick="bookmark('<?php echo $result->id; ?>')">              
                                                    <img alt="1" id="star_img_<?php echo $result->id; ?>" src="<?php echo base_url(); ?>application_resources/raty/images/star-off.png" title="Bookmark">
                                                </a>                                         
                                            </span> 

                                            <!--Remove Bookmark-->
                                        <?php } else { ?>
                                            <input type="hidden" id="bookmark_id_<?php echo $result->id; ?>" value="<?php echo $bookmarked_vehile_det->bookmarked_id; ?>">
                                            <input type="hidden" id="bookmark_status_<?php echo $result->id; ?>" value="1">

                                            <span id="bookmarked_div_<?php echo $result->id; ?>">
                                                <a class="star_class" style="cursor: pointer" onclick="bookmark('<?php echo $result->id; ?>')">              
                                                    <img alt="1" id="star_img_<?php echo $result->id; ?>" src="<?php echo base_url(); ?>application_resources/raty/images/star-on.png" title="Remove Bookmark">
                                                </a>
                                            </span>
                                        <?php } ?>
                                        <!--End Bookmark-->

                                        <!--Heart-->
                                        <span id="add_like_div">
                                            <a class="star_class" style="cursor: pointer" title="I Love this" onclick="like_vehicle('<?php echo $result->id; ?>')">              
                                                <i class="fa fa-heart"></i>
                                                <span id="like_count_<?php echo $result->id; ?>">0</span>
                                            </a>                                         
                                        </span>

                                        <span id="add_dislike_div">
                                            <a class="star_class" style="cursor: pointer" title="Broken Heart" onclick="dislike_vehicle('<?php echo $result->id; ?>')">              
                                                <i class="fa fa-heart-o"></i>
                                                <span id="dislike_count_<?php echo $result->id; ?>">0</span>
                                            </a>
                                        </span>                                   
                                        <!--End Heart-->
                                    <?php } ?>
                                </h3>

                                <figure><?php echo $result->body_type; ?></figure>
                                <div class="price"><?php echo "Rs. " . CurrencyFormat($result->price); ?></div>
                                <br>

                                <?php if ($result->is_featured == '2') { ?>
                                    <div class="type label-success label">
                                        <span>Featured</span>
                                    </div>
                                <?php } ?>

                                <div class="info">
                                    <dl>
                                        <?php if (!is_null($result->fuel_type)) { ?>
                                            <dt>Engine</dt>
                                            <dd><?php echo $result->fuel_type; ?></dd>
                                        <?php } ?>

                                        <?php if (!is_null($result->kilometers)) { ?>
                                            <dt>Kilometers</dt>
                                            <dd><?php echo $result->kilometers; ?></dd>
                                        <?php } ?>

                                        <?php if (!is_null($result->year)) { ?>
                                            <dt>Year</dt>
                                            <dd><?php echo $result->year; ?></dd>
                                        <?php } ?>
                                    </dl>
                                </div>
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

<?php

function CurrencyFormat($number) {
    $decimalplaces = 2;
    $decimalcharacter = '.';
    $thousandseparater = ',';
    return number_format($number, $decimalplaces, $decimalcharacter, $thousandseparater);
}
?>

<script src="<?php echo base_url(); ?>application_resources/assets/toastr-master/toastr.js"></script>
<script src="<?php echo base_url(); ?>application_resources/jStorage/json2.js"></script>
<script src="<?php echo base_url(); ?>application_resources/jStorage/jstorage.js"></script>


<script type="text/javascript">

                                                //bookmark vehicle
                                                function bookmark(vehicle_id) {

                                                    var bookmark_status = $('#bookmark_status_' + vehicle_id).val();
                                                    var bookmark_id = $('#bookmark_id_' + vehicle_id).val();

                                                    if (bookmark_status == '0') {
                                                        //add bookmark
                                                        if (confirm('Bookmark this Vehicle?')) {

                                                            $.ajax({
                                                                type: "POST",
                                                                url: site_url + '/bookmarked_vehicles/bookmark_vehicle',
                                                                data: "vehicle_id=" + vehicle_id,
                                                                success: function (msg) {
                                                                    if (msg != 0) {
                                                                        toastr.success("Successfully Bookmarked!!", "AutoVille");
                                                                        $('#bookmark_status_' + vehicle_id).val('1');
                                                                        $('#bookmark_id_' + vehicle_id).val(msg);
                                                                        $('#star_img_' + vehicle_id).attr('src', '<?php echo base_url(); ?>application_resources/raty/images/star-on.png');
                                                                        $('#star_img_' + vehicle_id).attr('title', 'Remove Bookmark');
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
                                                                url: site_url + '/bookmarked_vehicles/remove_bookmark',
                                                                data: "bookmark_id=" + bookmark_id,
                                                                success: function (msg) {
                                                                    if (msg != 0) {
                                                                        toastr.success("Bookmark Removed Successfully!!", "AutoVille");
                                                                        $('#bookmark_status_' + vehicle_id).val('0');
                                                                        $('#bookmark_id_' + vehicle_id).val('0');
                                                                        $('#star_img_' + vehicle_id).attr('src', '<?php echo base_url(); ?>application_resources/raty/images/star-off.png');
                                                                        $('#star_img_' + vehicle_id).attr('title', 'Bookmark');
                                                                    } else {
                                                                        alert('Error!');
                                                                    }
                                                                }
                                                            });
                                                        }
                                                    }

                                                }


                                                //like
                                                function like_vehicle(vehicle_id) {

                                                    $.ajax({
                                                        type: "POST",
                                                        url: site_url + '/vehicle_like_dislike/add_vehicle_likes',
                                                        data: "vehicle_id=" + vehicle_id,
                                                        success: function (msg) {
                                                            $('#like_count_' + vehicle_id).html(msg);
                                                        }
                                                    });
                                                }

                                                //dislike
                                                function dislike_vehicle(vehicle_id) {

                                                    $.ajax({
                                                        type: "POST",
                                                        url: site_url + '/vehicle_like_dislike/add_vehicle_dislikes',
                                                        data: "vehicle_id=" + vehicle_id,
                                                        success: function (msg) {
                                                            $('#dislike_count_' + vehicle_id).html(msg);
                                                        }
                                                    });
                                                }

                                                //add vehicle to compare list
                                                function add_to_compare(id) {

                                                    $.ajax({
                                                        type: "POST",
                                                        url: site_url + '/vehicle_compare/add_vehicle_to_compare',
                                                        data: "id=" + id,
                                                        success: function (msg) {
                                                            if (msg != 0) {
                                                                toastr.success("Successfully parked in Garage!!", "AutoVille");
                                                                $('#compare_vehicle_list').html(msg);
                                                            } else {
                                                                alert('Error loading vehicles');
                                                            }
                                                        }
                                                    });

                                                }

                                                function save_in_browser(id) {

                                                    $.ajax({
                                                        type: "POST",
                                                        url: site_url + '/vehicle_compare/load_li_tags',
                                                        data: "id=" + id,
                                                        success: function (msg) {
                                                            if (msg != 0) {

                                                                //save key as vehicle_vehicleid, load_li_tags return <li> tag for one vehicle, save it as value                                                                   
                                                                //$.jStorage.set(key, value, options), Saves a value to local storage 
                                                                $.jStorage.set("vehicle_" + id, msg);
                                                                jStorege_get_values();

                                                            } else {
                                                                alert('Error loading vehicles');
                                                            }
                                                        }
                                                    });

                                                }


                                                //append all <li> tags and compare button,load compare_vehicle_list on header
                                                function jStorege_get_values() {

                                                    //$.jStorage.index() Returns all the keys currently in use as an array.
                                                    var key_list = $.jStorage.index();

                                                    var li_list = '<button style="border:0px solid black; background-color: transparent;" data-toggle="dropdown"><i class="fa fa-road"></i> Compare(' + key_list.length + ')<span class="caret"></span></button><ul class="dropdown-menu" id="added_vehicle_list">';

                                                    if (key_list.length == 0) {
                                                        li_list = '<li>Add Vehicle</li>';
                                                    }

                                                    //append all li tags
                                                    for (i = 0; i < key_list.length; i++) {
                                                        li_list += $.jStorage.get(key_list[i]);
                                                    }

                                                    var compare_btn = '<li><a href="<?php echo site_url(); ?>/vehicle_compare/load_compare_vehicles_dashboard_unreg_user/' + key_list + '" class="dealer-name"><button id="compareButton">Compare</button></a></li>';

                                                    //append compare button
                                                    if (key_list.length >= 2) {
                                                        li_list += compare_btn;
                                                    }

                                                    li_list += '</ul>';
                                                    $('#compare_vehicle_list').html(li_list);
                                                }


                                                //this function invokes from Pagination_custome.php in system/libraries    
                                                function setting_pagination_content(url) {

                                                    $.post(url, {}, function (msg)
                                                    {
                                                        $('#advanced_search_result_content').html(msg);
                                                    });
                                                }

</script>


