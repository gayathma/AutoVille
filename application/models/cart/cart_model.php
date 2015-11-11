<?php

class Cart_model extends CI_Model{
    
    var $id;
    var $user_id;
    var $spare_part_id;
    var $added_date;
    
    function get_id() {
        return $this->id;
    }

    function get_user_id() {
        return $this->user_id;
    }

    function get_spare_part_id() {
        return $this->spare_part_id;
    }

    function get_added_date() {
        return $this->added_date;
    }

    function set_id($id) {
        $this->id = $id;
    }

    function set_user_id($user_id) {
        $this->user_id = $user_id;
    }

    function set_spare_part_id($spare_part_id) {
        $this->spare_part_id = $spare_part_id;
    }

    function set_added_date($added_date) {
        $this->added_date = $added_date;
    }


}