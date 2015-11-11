<?php

class Newsletters_model extends CI_Model {

    var $id;
    var $subject;
    var $content;
    var $added_date;
    var $status;

    function __construct() {
        parent::__construct();
    }

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_subject() {
        return $this->subject;
    }

    public function set_subject($subject) {
        $this->subject = $subject;
    }

    public function get_content() {
        return $this->content;
    }

    public function set_content($content) {
        $this->content = $content;
    }

    public function get_added_date() {
        return $this->added_date;
    }

    public function set_added_date($added_date) {
        $this->added_date = $added_date;
    }

    public function get_status() {
        return $this->status;
    }

    public function set_status($status) {
        $this->status = $status;
    }

}
