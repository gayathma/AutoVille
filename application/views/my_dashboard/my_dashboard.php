<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/jquery.sticky.js"></script>
<section id="content" class="container page-profile">
    <header>
        <ul class="nav nav-pills">
            <li class="active">
                <a href="#">
                    <h1 class="page-title">My Dashboard</h1>
                </a>
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <aside id="sidebar" class="tbssticky">

                <!-- SIDEBAR -->
                <ul class="navigation-sidebar list-unstyled">

                    <?php if ($this->session->userdata('USER_LOGGED_IN')) { ?>
                        <li class="active dash_items">  <a class="dashboard_link" href="#"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                        <li class="dash_items">  <a class="dashboard_link" href="#"><i class="fa fa-edit"></i> <span>My Advertisements</span></a></li>
                        <li> <a href="<?php echo site_url(); ?>/vehicle_advertisements/post_new_advertisement"><i class="fa fa-plus-square-o"></i> <span>New Advertisement</span></a></li>
                        <li> <a href="<?php echo site_url(); ?>/website_advertisements/post_new_commercial_advertisement"><i class="fa fa-film"></i> <span>Commercials</span></a></li>
                    <?php } ?>
                    <li class="dash_items">  <a id="compare_vehicle_view" href="#"><i class="fa fa-compress"></i> <span>Compare Vehicles</span></a></li>
                    <?php if ($this->session->userdata('USER_LOGGED_IN')) { ?>    
                        <li class="dash_items"> <a id="searched_view" href="#"><i class="fa fa-star"></i> <span>Saved Searches</span></a></li>
                        <li class="dash_items"> <a id="bookmarked_vehicles_view" href="#"><i class="fa fa-bookmark"></i><span> Bookmarked Vehicles</span></a></li>
                        <li class="dash_items"> <a id="bookmarked_spare_part_view" href="#"><i class="fa fa-bookmark"></i><span> Bookmarked Spare Parts</span></a></li>
                        <li class="dash_items"> <a id="profile_link" href="#" ><i class="fa fa-user"></i> <span>My Profile</span></a></li>
                    <?php } ?>

                </ul>
            </aside>
        </div>
        <div class="col-md-9 col-sm-9" id="dashboard_right_content">
            <?php
            if ($my_advertisements != 0) {
                echo $this->load->view('my_dashboard/my_advertisements');
            } else {
                echo $this->load->view('my_dashboard/compare_vehicles');
            }
            ?>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        var goffset = $(".site-header-wrapper").height() + 19;
        var bottomffset = $("#page-footer").height();

        $(".tbssticky").sticky({topSpacing: goffset,bottomSpacing:bottomffset});
    });

    //load profile view
    $('#profile_link').on('click', function(e) {
        $('.dash_items').removeClass('active');
        $(this).parent().addClass('active');
        $.post('<?php echo site_url(); ?>/reg_user_profile/load_profile_of_reg_user', {}, function(msg)
        {
            $('#dashboard_right_content').html(msg);
        });
    });

    //load dashboard view
    $('.dashboard_link').on('click', function(e) {
        $('.dash_items').removeClass('active');
        $(this).parent().addClass('active');
        $.post('<?php echo site_url(); ?>/dashboard/load_my_advertisements', {}, function(msg)
        {
            $('#dashboard_right_content').html(msg);
        });
    });


    //load saved searches view
    $('#searched_view').on('click', function(e) {
        $('.dash_items').removeClass('active');
        $(this).parent().addClass('active');
        $.post('<?php echo site_url(); ?>/dashboard/load_saved_searches', {}, function(msg)
        {
            $('#dashboard_right_content').html(msg);
        });
    });

    //load compare vehicle view
    $('#compare_vehicle_view').on('click', function(e) {
        $('.dash_items').removeClass('active');
        $(this).parent().addClass('active');
        $.post('<?php echo site_url(); ?>/vehicle_compare/load_compare_vehicles', {}, function(msg)
        {
            $('#dashboard_right_content').html(msg);
        });
    });


    //load bookmarked vehicles view
    $('#bookmarked_vehicles_view').on('click', function(e) {
        $('.dash_items').removeClass('active');
        $(this).parent().addClass('active');
        $.post('<?php echo site_url(); ?>/dashboard/load_bookmarked_vehicles', {}, function(msg)
        {
            $('#dashboard_right_content').html(msg);
        });
    });
    
    //load bookmarked spare parts view
    $('#bookmarked_spare_part_view').on('click', function(e) {
        $('.dash_items').removeClass('active');
        $(this).parent().addClass('active');
        $.post('<?php echo site_url(); ?>/dashboard/load_bookmarked_spare_parts', {}, function(msg)
        {
            $('#dashboard_right_content').html(msg);
        });
    });

    //this function invokes from Pagination_custome.php in system/libraries    
    function setting_pagination_content(url) {

        $.post(url, {}, function(msg)
        {
            $('#dashboard_right_content').html(msg);
        });
    }


    $('.item.admin-view .hide-item').on('click', function(e) {
        $(this).closest('.item').toggleClass('is-hidden');
    });


</script>