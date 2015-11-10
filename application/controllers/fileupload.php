<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fileupload extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * load file upload handler library
     */
    function index() {

        error_reporting(E_ALL | E_STRICT);
        $this->load->library("UploadHandler");
    }

    /**
     * load file upload handler library when folder is given
     * @param string $folder Input folder name
     */
    function custom_init($folder) {
        $_POST['last_vehicle_id'] = $folder;
        error_reporting(E_ALL | E_STRICT);
        $this->load->library("UploadHandler");
    }

}
