<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//Custon configuration file.
// function employeeservices->getEmployeeswithdep() ->  // designation 23 -> is managing director   not get report
//This is to set the site title
$config['APPLICATION_MAIN_TITLE'] = "AutoVille ";
$config['LOGIN_OPTION']           = 1;


//User Types
$config['ALL'] = 0;
$config['SUPERADMIN'] = 1;
$config['ADMIN']      = 2;
$config['REGISTERED'] = 3;


//Vehicle Types
$config['CARS']       = 1;
$config['BIKES']      = 2;
$config['COMMERCIAL'] = 3;

