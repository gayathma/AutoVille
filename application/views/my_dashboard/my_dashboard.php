<div id="content" class="content full dashboard-pages">
    <div class="container">
        <div class="dashboard-wrapper">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <!-- SIDEBAR -->
                    <div class="users-sidebar tbssticky">
                        <a href="user-dashboard.html" class="btn btn-block btn-primary add-listing-btn">New Ad listing</a>
                        <ul class="list-group">
                            <li class="list-group-item"> <span class="badge">5</span> <a href="user-dashboard.html"><i class="fa fa-home"></i> Dashboard</a></li>
                            <li class="list-group-item"> <span class="badge">5</span> <a href="user-dashboard-saved-searches.html"><i class="fa fa-folder-o"></i> Saved Searches</a></li>
                            <li class="list-group-item"> <span class="badge">12</span> <a href="user-dashboard-saved-cars.html"><i class="fa fa-star-o"></i> Saved Cars</a></li>
                            <li class="list-group-item"> <a href="<?php echo site_url(); ?>/vehicle_advertisements/post_new_advertisement"><i class="fa fa-plus-square-o"></i> Create new Advertisement</a></li>
                            <li class="list-group-item active"> <span class="badge">2</span> <a href="user-dashboard-manage-ads.html"><i class="fa fa-edit"></i> Manage Ads</a></li>
                            <li class="list-group-item"> <a href="user-dashboard-profile.html"><i class="fa fa-user"></i> My Profile</a></li>
                            <li class="list-group-item"> <a href="user-dashboard-settings.html"><i class="fa fa-cog"></i> Account Settings</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                    <?php echo $this->load->view('my_dashboard/my_advertisements');?>
                </div>
            </div>
        </div>
    </div>
</div>