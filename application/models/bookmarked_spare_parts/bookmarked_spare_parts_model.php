<?php

class Bookmarked_spare_parts_model extends CI_Model {

    var $id;
    var $user_id;
    var $spare_part_id;
    var $is_deleted;
    var $added_date;
    var $added_by;
    var $updated_date;
    var $updated_by;

    function get_id() {
        return $this->id;
    }

    function get_user_id() {
        return $this->user_id;
    }

    function get_spare_part_id() {
        return $this->spare_part_id;
    }

    function get_is_deleted() {
        return $this->is_deleted;
    }

    function get_added_date() {
        return $this->added_date;
    }

    function get_added_by() {
        return $this->added_by;
    }

    function get_updated_date() {
        return $this->updated_date;
    }

    function get_updated_by() {
        return $this->updated_by;
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

    function set_is_deleted($is_deleted) {
        $this->is_deleted = $is_deleted;
    }

    function set_added_date($added_date) {
        $this->added_date = $added_date;
    }

    function set_added_by($added_by) {
        $this->added_by = $added_by;
    }

    function set_updated_date($updated_date) {
        $this->updated_date = $updated_date;
    }

    function set_updated_by($updated_by) {
        $this->updated_by = $updated_by;
    }

}
