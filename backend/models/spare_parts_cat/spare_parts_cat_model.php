<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category_model
 *
 * @author nAdEel
 */
class Spare_parts_cat_model extends CI_Model {

    var $id;
    var $name;
    var $image;
    var $is_published;
    var $is_deleted;
    var $added_date;
    var $added_by;
    var $updated_date;
    var $updated_by;

    function get_id() {
        return $this->id;
    }

    function get_name() {
        return $this->name;
    }

    function get_image() {
        return $this->image;
    }

    function get_is_published() {
        return $this->is_published;
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

    function set_name($name) {
        $this->name = $name;
    }

    function set_image($image) {
        $this->image = $image;
    }

    function set_is_published($is_published) {
        $this->is_published = $is_published;
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
