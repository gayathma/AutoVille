
<ul class="sidebar-menu" id="nav-accordion">
    <li>
        <a  href="<?php echo site_url(); ?>/dashboard" id="dashboard_menu">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" id="user_menu">
            <i class="fa fa-users"></i>
            <span>Users</span>
        </a> 
        <ul class="sub">
            <li><a  href="<?php echo site_url(); ?>/users/manage_admins" onclick="">Manage Administrators</a></li>
            <li><a  href="<?php echo site_url(); ?>/reg_users/manage_registered_users">Manage Registered Users</a></li>
        </ul>
    </li>

    <?php
    $perm = Access_controll_service::check_access('ADD_ADVERTISEMENT');
    if ($perm) {
        ?>
        <li class="sub-menu">
            <a href="javascript:;" id="advertisements_menu">
                <i class="fa fa-film"></i>
                <span>Advertisements</span>
            </a>
            <ul class="sub">
                <li><a  href="<?php echo site_url(); ?>/vehicle_advertisements/manage_advertisements">Vehicle Advertisements</a></li>
                <li><a  href="<?php echo site_url(); ?>/vehicle_advertisements/get_Approved_advertisements">Featured Advertisements</a></li>
                <li><a  href="<?php echo site_url(); ?>/website_advertisements/manage_advertisements">Website Advertisements</a></li>
                <li><a  href="<?php echo site_url(); ?>/spare_part_advertisement/manage_advertisements">Spare parts Advertisements</a></li>
            </ul>
        </li>
    <?php } ?>


    <li class="sub-menu">
        <a href="javascript:;" id="pages_menu">
            <i class="fa fa-folder-open"></i>
            <span>Manage Pages</span>
        </a> 
        <ul class="sub">
            <li><a href="<?php echo site_url(); ?>/contents/load_contents_by_hcode/ABOUTUS">About Us</a></li>
            <li><a href="<?php echo site_url(); ?>/contents/load_contents_by_hcode/DESTINATIONS">FAQs</a></li>
            <li><a href="<?php echo site_url(); ?>/contents/load_contents_by_hcode/RIGHTSIDESNIPPET">Rightside Snippet</a></li>
            <li><a href="<?php echo site_url(); ?>/contents/load_contents_by_hcode/WELCOMEHOMEPAGE">Welcomer Message Home Page</a></li>
            <li><a href="<?php echo site_url(); ?>/contents/load_contents_by_hcode/WELCOMEINNERPAGE">Welcomer Message </a></li>
            <li><a href="<?php echo site_url(); ?>/contents/load_contents_by_hcode/WHYUS">Why Us</a></li>
        </ul>
    </li>
    
     <li class="sub-menu">
        <a href="javascript:;" id="campaign_menu">
            <i class="fa fa-rss"></i>
            <span>Campaign</span>
        </a> 
        <ul class="sub">
            <li><a  href="<?php echo site_url(); ?>/subscribe/manage_newsletters">Newsletters</a></li>
            <li><a  href="<?php echo site_url(); ?>/subscribe/manage_subscribers">Subscribers</a></li>
        </ul>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" id="comments_menu">
            <i class="fa fa-comment-o"></i>
            <span>Reviews</span>
        </a> 
        <ul class="sub">
            <li><a  href="<?php echo site_url(); ?>/comments/manage_comments">Website Reviews</a></li>
            <li><a  href="<?php echo site_url(); ?>/vehicle_news/manage_vehicle_news">Vehicle News</a></li>
            <li><a  href="<?php echo site_url(); ?>/faq/manage_faq">Manage FAQ's</a></li>
        </ul>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" id="vehicle_spec_menu">
            <i class="fa fa-cogs"></i>
            <span>Vehicle Specifications</span>
        </a>
        <ul class="sub">
            <li><a  href="<?php echo site_url(); ?>/transmission/manage_transmissions">Manage Transmission</a></li>
            <li><a  href="<?php echo site_url(); ?>/vehicle_model/manage_models">Manage Vehicle Models</a></li>
            <li><a  href="<?php echo site_url(); ?>/manufacture/manage_manufactures">Manage Manufactures</a></li>
            <li><a  href="<?php echo site_url(); ?>/body_type/manage_body_types">Manage Vehicle Body Types</a></li>
            <li><a  href="<?php echo site_url(); ?>/fuel_type/manage_fuel_types">Manage Fuel Types</a></li>
            <li><a  href="<?php echo site_url(); ?>/equipment/manage_equipment">Manage Equipments</a></li>
            <li><a  href="<?php echo site_url(); ?>/celebrity/manage_celebrity">Manage Celebrity</a></li>
        </ul>        
    </li>

    <li class="sub-menu">
        <a href="javascript:;" id="settings_menu">
            <i class="fa  fa-wrench"></i>
            <span>Settings</span>
        </a>
        <ul class="sub">
            <li><a  href="<?php echo site_url(); ?>/privilege_master/manage_privilege_masters">Manage Master Privileges</a></li>
            <li><a  href="<?php echo site_url(); ?>/privilege/manage_privileges">Manage Privileges</a></li>

        </ul>        
    </li>




</ul>

