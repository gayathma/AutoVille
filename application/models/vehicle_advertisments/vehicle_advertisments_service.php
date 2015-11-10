<?php

class Vehicle_advertisments_service extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
    }

    /*
     * get all popular advertisemnts
     * @author Ashani
     */

    function get_popular_advertisements()
    {

        $this->db->select('searched_vehicles.*,
            count(searched_vehicles.vehicle_id) as no_of_views,
            vehicle_advertisements.id,'
                . 'vehicle_advertisements.kilometers,'
                . 'vehicle_advertisements.year,'
                . 'vehicle_advertisements.description,'
                . 'vehicle_images.image_path,'
                . 'manufacture.name as manufacture,'
                . 'model.name as model,'
                . 'fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('searched_vehicles');
        $this->db->join('vehicle_advertisements', 'vehicle_advertisements.id = searched_vehicles.vehicle_id');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id', 'left');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('vehicle_images', 'vehicle_images.vehicle_id = vehicle_advertisements.id');
        $this->db->order_by("no_of_views", "desc");
        $this->db->group_by('searched_vehicles.vehicle_id');
        $this->db->limit(4, 0);
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * This is the service function to get all advertisements
     */

    public function get_all_advertisements()
    {

        $this->db->select('vehicle_advertisements.*,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * This is the service function to search all advertisements
     */

    public function search_advertisements()
    {

        $this->db->select('vehicle_advertisements.*,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * This is the service function to get similar suggestions
     */

    public function similar_suggestions($manufacture, $model)
    {

        $this->db->select('vehicle_advertisements.*,vehicle_images.image_path,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->join('vehicle_images', 'vehicle_images.vehicle_id = vehicle_advertisements.id', 'left');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.is_published', '1');
        $this->db->group_by('vehicle_advertisements.id');

        if (!empty($manufacture) && !is_null($manufacture)) {
            $this->db->where('vehicle_advertisements.manufacture_id', $manufacture);
        }
        if (!empty($model) && !is_null($model)) {
            $this->db->where('vehicle_advertisements.model_id', $model);
        }


        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        $this->db->limit(3);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This is the service function to search all vehicles by 
     * vehicle specifications
     */
    public function search_vehicle_limit($manufacture, $model, $body_type, $maxyear, $minyear, $fuel_type
    , $sale_type, $color, $maxprice, $minprice, $transmission, $kilometers, $location, $keyword, $limit, $start, $type)
    {

        $this->db->select('vehicle_advertisements.*,vehicle_images.image_path,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->join('vehicle_images', 'vehicle_images.vehicle_id = vehicle_advertisements.id', 'left');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.is_published', '1');
        $this->db->group_by('vehicle_advertisements.id');

        if (!empty($manufacture) && !is_null($manufacture)) {
            $this->db->where('vehicle_advertisements.manufacture_id', $manufacture);
        }
        if (!empty($model) && !is_null($model)) {
            $this->db->where('vehicle_advertisements.model_id', $model);
        }
        if (!empty($body_type) && !is_null($body_type)) {
            $this->db->where('vehicle_advertisements.body_type_id', $body_type);
        }
        if (!empty($fuel_type) && !is_null($fuel_type)) {
            $this->db->where('vehicle_advertisements.fuel_type_id', $fuel_type);
        }
        if (!empty($transmission) && !is_null($transmission)) {
            $this->db->where('vehicle_advertisements.transmission_id', $transmission);
        }
        if (!empty($maxyear) && !is_null($maxyear)) {
            $this->db->where('vehicle_advertisements.year <=', $maxyear);
            $this->db->where('vehicle_advertisements.year >=', $minyear);
        }
        if (!empty($color) && !is_null($color)) {
            $this->db->where('vehicle_advertisements.colour', $color);
        }
        if (!empty($maxprice) && !is_null($maxprice)) {
            $this->db->where('vehicle_advertisements.price <=', $maxprice);
            $this->db->where('vehicle_advertisements.price >=', $minprice);
        }
        if (!empty($kilometers) && !is_null($kilometers)) {
            $this->db->where('vehicle_advertisements.kilometers', $kilometers);
        }
        if (!empty($location) && !is_null($location) && $location != 0) {
            $this->db->where('vehicle_advertisements.location_id', $location);
        }
        if (!empty($sale_type) && !is_null($sale_type)) {
            $this->db->like('vehicle_advertisements.sale_type', $sale_type);
        }
        if (!empty($keyword) && !is_null($keyword)) {
            $this->db->like('vehicle_advertisements.description', $keyword);
            $this->db->or_like('user.address', $keyword);
        }

        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        if ($type == 'half') {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();

        return $query->result();
    }

    /*
     * Add new Vehicle Addvertisement
     */

    function add_new_advertisements($vehicle_advertisement_model)
    {
        $this->db->insert('vehicle_advertisements', $vehicle_advertisement_model);
        return $this->db->insert_id();
    }

    /*
     * get last advertisement
     */
    function get_last_advertisement_id()
    {
        $this->db->select('id');
        $this->db->from('vehicle_advertisements');
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->row();
    }

    /*
     * This is the service function to get recently viewed vehicles
     */

    function get_recently_viewed_vehicles($user_id)
    {

        $this->db->select('vehicle_advertisements.id,'
                . 'vehicle_advertisements.kilometers,'
                . 'vehicle_advertisements.year,'
                . 'vehicle_advertisements.description,'
                . 'vehicle_advertisements.price,'
                . 'vehicle_images.image_path,'
                . 'manufacture.name as manufacture,'
                . 'model.name as model,'
                . 'fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('vehicle_images', 'vehicle_images.vehicle_id = vehicle_advertisements.id');
        $this->db->join('searched_vehicles', 'searched_vehicles.vehicle_id=vehicle_advertisements.id');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.is_published', '1');
        $this->db->where('searched_vehicles.user_id', $user_id);
        $this->db->group_by('vehicle_advertisements.id');
        $this->db->order_by("searched_vehicles.date", "desc");
        $this->db->limit(4);

        $query = $this->db->get();

        return $query->result();
    }

    /*
     * get one advertisement by id
     */
    function get_advertisement_by_id($id)
    {

        $this->db->select('vehicle_advertisements.*,user.email as user_email,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id', 'left');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    /*
     * get advertisements for a particular logged user
     */

    function get_advertisements_for_user($limit, $start, $user_id)
    {

        $this->db->select('vehicle_advertisements.*,vehicle_images.image_path,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id', 'left');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('vehicle_images', 'vehicle_images.vehicle_id = vehicle_advertisements.id');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.added_by', $user_id);
        $this->db->group_by('vehicle_advertisements.id');
        if ($limit != '' && $start != '') {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();
        return $query->result();
    }

    /*
     * This service function is to delete a advertisements
     */

    function delete_advertisement($advertisement_id)
    {
        $data = array('is_deleted' => '1');
        $this->db->where('id', $advertisement_id);
        return $this->db->update('vehicle_advertisements', $data);
    }

    /*
     * Get Featured advertisments  
     * Author - Nadeesha
     * 
     */

    function get_featured_advertisements($limit)
    {

        $this->db->select('vehicle_advertisements.id,'
                . 'vehicle_advertisements.kilometers,'
                . 'vehicle_advertisements.year,'
                . 'vehicle_advertisements.description,'
                . 'vehicle_images.image_path,'
                . 'manufacture.name as manufacture,'
                . 'model.name as model,'
                . 'fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id', 'left');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('vehicle_images', 'vehicle_images.vehicle_id = vehicle_advertisements.id');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.is_featured', '2');
        $this->db->group_by('vehicle_advertisements.id');
        if ($limit != '') {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    /*
     * get all price dropped vehicles
     */

    function get_price_drop_vehicles($limit)
    {

        $this->db->select('vehicle_advertisements.id,'
                . 'vehicle_advertisements.kilometers,'
                . 'vehicle_advertisements.year,'
                . 'vehicle_advertisements.description,'
                . 'vehicle_images.image_path,'
                . 'manufacture.name as manufacture,'
                . 'model.name as model,'
                . 'fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('vehicle_images', 'vehicle_images.vehicle_id = vehicle_advertisements.id');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.is_price_drop', '1');
        $this->db->group_by('vehicle_advertisements.id');
        if ($limit != '') {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    //update vehicle advertisemnt
    function update_vehicle_advertisement($vehicle_advertisement_model)
    {

        $data = array(
            'model_id' => $vehicle_advertisement_model->get_model_id(),
            'manufacture_id' => $vehicle_advertisement_model->get_manufacture_id(),
            'description' => $vehicle_advertisement_model->get_description(),
            'fuel_type_id' => $vehicle_advertisement_model->get_fuel_type_id(),
            'year' => $vehicle_advertisement_model->get_year(),
            'transmission_id' => $vehicle_advertisement_model->get_transmission_id(),
            'body_type_id' => $vehicle_advertisement_model->get_body_type_id(),
            'doors' => $vehicle_advertisement_model->get_doors(),
            'location_id' => $vehicle_advertisement_model->get_location_id(),
            'colour' => $vehicle_advertisement_model->get_colour(),
            'sale_type' => $vehicle_advertisement_model->get_sale_type(),
            'chassis_no' => $vehicle_advertisement_model->get_chassis_no(),
            'kilometers' => $vehicle_advertisement_model->get_kilometers(),
            'price' => $vehicle_advertisement_model->get_price(),
            'is_price_drop' => $vehicle_advertisement_model->get_is_price_drop(),
            'latitude' => $vehicle_advertisement_model->get_latitude(),
            'longitude' => $vehicle_advertisement_model->get_longitude(),
            'updated_by' => $vehicle_advertisement_model->get_updated_by(),
            'updated_date' => $vehicle_advertisement_model->get_updated_date()
        );
        $this->db->where('id', $vehicle_advertisement_model->get_id());
        return $this->db->update('vehicle_advertisements', $data);
    }

    /*
     * This is to update the is_featured status from 0 to 1- request featured
     * author- Nadeesha
     * 
     */

    function request_featured_advertisement($vehicle_advertisement_model)
    {
        $data = array('is_featured' => $vehicle_advertisement_model->get_is_published());
        $this->db->update('vehicle_advertisements', $data, array('id' => $vehicle_advertisement_model->get_id()));
        return $this->db->affected_rows();
    }

    /*
     * This service function to get new arrivals
     * author-Ishani
     */

    public function get_new_arrival($limit)
    {

        $this->db->select('vehicle_advertisements.id,'
                . 'vehicle_advertisements.year,'
                . 'vehicle_advertisements.price,'
                . 'vehicle_images.image_path,'
                . 'manufacture.name as manufacture,'
                . 'model.name as model,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('vehicle_images', 'vehicle_images.vehicle_id = vehicle_advertisements.id');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        $this->db->group_by('vehicle_advertisements.id');
        if ($limit != '') {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    /*
     * search from ar application
     */

    public function search($manufacture, $limit, $start, $type)
    {

        $this->db->select('vehicle_advertisements.*,vehicle_images.image_path,user.name as added_by_user,'
                . 'manufacture.name as manufacture,model.name as model,'
                . 'transmission.name as transmission,fuel_type.name as fuel_type,'
                . 'body_type.name as body_type');
        $this->db->from('vehicle_advertisements');
        $this->db->join('manufacture', 'manufacture.id = vehicle_advertisements.manufacture_id');
        $this->db->join('model', 'model.id = vehicle_advertisements.model_id');
        $this->db->join('transmission', 'transmission.id = vehicle_advertisements.transmission_id');
        $this->db->join('fuel_type', 'fuel_type.id = vehicle_advertisements.fuel_type_id');
        $this->db->join('body_type', 'body_type.id = vehicle_advertisements.body_type_id');
        $this->db->join('user', 'user.id = vehicle_advertisements.added_by');
        $this->db->join('vehicle_images', 'vehicle_images.vehicle_id = vehicle_advertisements.id', 'left');
        $this->db->where('vehicle_advertisements.is_deleted', '0');
        $this->db->where('vehicle_advertisements.is_published', '1');
        $this->db->group_by('vehicle_advertisements.id');

        if (!empty($manufacture) && !is_null($manufacture)) {
            $this->db->like('manufacture.name', $manufacture);
        }

        $this->db->order_by("vehicle_advertisements.added_date", "desc");
        if ($type == 'half') {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();

        return $query->result();
    }

}
