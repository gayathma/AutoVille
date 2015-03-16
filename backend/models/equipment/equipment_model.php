<?php

class Equipment_model extends CI_Model{
    
    var $id;
    var $name;
    var $is_published;
    var $is_deleted;
    var $added_date;
    var $added_by;
    var $updated_date;
    var $updated_by;
    
    function __construct() {
        parent::__construct();
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getIs_published() {
        return $this->is_published;
    }

    function getIs_deleted() {
        return $this->is_deleted;
    }

    function getAdded_date() {
        return $this->added_date;
    }

    function getAdded_by() {
        return $this->added_by;
    }

    function getUpdated_date() {
        return $this->updated_date;
    }

    function getUpdated_by() {
        return $this->updated_by;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setIs_published($is_published) {
        $this->is_published = $is_published;
    }

    function setIs_deleted($is_deleted) {
        $this->is_deleted = $is_deleted;
    }

    function setAdded_date($added_date) {
        $this->added_date = $added_date;
    }

    function setAdded_by($added_by) {
        $this->added_by = $added_by;
    }

    function setUpdated_date($updated_date) {
        $this->updated_date = $updated_date;
    }

    function setUpdated_by($updated_by) {
        $this->updated_by = $updated_by;
    }


}
