<?php

class Newsletters_model extends CI_Model {

    var $id;
    var $subject;
    var $content;
    var $added_date;

    function __construct() {
        parent::__construct();
    }

    function get_id()
    {
        return $this->id;
    }

    function get_subject()
    {
        return $this->subject;
    }

    function get_content()
    {
        return $this->content;
    }

    function get_added_date()
    {
        return $this->added_date;
    }

    function set_id($id)
    {
        $this->id = $id;
    }

    function set_subject($subject)
    {
        $this->subject = $subject;
    }

    function set_content($content)
    {
        $this->content = $content;
    }

    function set_added_date($added_date)
    {
        $this->added_date = $added_date;
    }


}
