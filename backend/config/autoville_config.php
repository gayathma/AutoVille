<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//Custom configuration file.

//This is to set the site title
$config['APPLICATION_MAIN_TITLE'] = "AutoVille ";
$config['LOGIN_OPTION']           = 1;


//User Types
$config['ALL'] = 0;
$config['SUPERADMIN'] = 1;
$config['ADMIN']      = 2;
$config['REGISTERED'] = 3;

//Systems
$systems= array('ADVERTISEMENT','USERS','PAGES','REVIEWS','VEHICLE SPECS','SETTINGS');
$config['SYSTEMS']=$systems;


//Vehicle Types
$config['CARS']       = 1;
$config['BIKES']      = 2;
$config['COMMERCIAL'] = 3;

$config['URL'] = 'http://autoville.lankapanel.biz/index.php';

