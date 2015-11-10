<?php

class Content_service extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * get content using hcode
     * @param object $content_model Input model 
     * @return object
     */
    function get_content_by_hcode($content_model) {
        $query = $this->db->get_where('contents', array(
            'content_hcode' => $content_model->get_content_hcode()
        ));
        return $query->row();
    }

    /**
     * get content using hcode
     * @param string $hcode Input hcode string
     * @return object
     */
    function get_content_by_hcodes($hcode) {
        $query = $this->db->get_where('contents', array(
            'content_hcode' => $hcode
        ));
        return $query->row();
    }

}

?>
