<?php

class Seller_subscribers_model extends CI_Model {

    var $id;
    var $email;
    var $seller_id;
    var $is_deleted;
    var $added_by;
    var $added_date;

    function get_added_by() {
        return $this->added_by;
    }

    function set_added_by($added_by) {
        $this->added_by = $added_by;
    }

    function get_id() {
        return $this->id;
    }

    function get_email() {
        return $this->email;
    }

    function get_seller_id() {
        return $this->seller_id;
    }

    function get_is_deleted() {
        return $this->is_deleted;
    }

    function get_added_date() {
        return $this->added_date;
    }

    function set_id($id) {
        $this->id = $id;
    }

    function set_email($email) {
        $this->email = $email;
    }

    function set_seller_id($seller_id) {
        $this->seller_id = $seller_id;
    }

    function set_is_deleted($is_deleted) {
        $this->is_deleted = $is_deleted;
    }

    function set_added_date($added_date) {
        $this->added_date = $added_date;
    }

}
