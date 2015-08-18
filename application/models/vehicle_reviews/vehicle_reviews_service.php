<?php

class Vehicle_reviews_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('vehicle_reviews/vehicle_reviews_model');
    }

    /*
     * Service function to add vehicle reviews
     */

    function add_vehicle_reviews($vehicle_reviews_model) {
        return $this->db->insert('review', $vehicle_reviews_model);
    }

    /*
     * Service function to get all vehicle reviews according to the vehicle id
     */

    function get_all_vehicle_reviews($vehicle_id) {
        $this->db->select('review.*,user.name as added_by_user,user.profile_pic');
        $this->db->from('review');
        $this->db->join('vehicle_advertisements', 'review.vehicle_id=vehicle_advertisements.id');
        $this->db->join('user', 'user.id = review.added_by','left');
        $this->db->where('review.is_deleted', '0');
        $this->db->where('review.is_published', '1');
        $this->db->where('review.vehicle_id',$vehicle_id);
        $this->db->order_by("review.added_date", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Service function to delete vehicle reviews
     */

    function delete_vehicle_reviews($vehicle_review_id) {
        $data = array('is_deleted' => '1');
        $this->db->where('id', $vehicle_review_id);
        return $this->db->update('review', $data);
    }

    /*
     * Service function to update vehicle reviews
     */

    function update_vehicle_reviews($vehicle_reviews_model) {
        $data = array('title' => $vehicle_reviews_model->get_title(),
            'updated_date' => $vehicle_reviews_model->get_updated_date(),
            'updated_by' => $vehicle_reviews_model->get_updated_by()
        );

        $this->db->where('id', $vehicle_reviews_model->get_id());
        return $this->db->update('review', $data);
    }

}
