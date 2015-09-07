<?php

class Faq_service extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->model('faq/faq_model');
    }
    
    public function get_all_questions() {
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->where('faq.is_deleted', '0');
        $this->db->order_by("faq.added_date", "dsc");       
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_question_by_id($faq_model){
        $data = array('id'=>$faq_model->getId(),'is_deleted' =>'0');
        $query = $this->db->get_where('faq',$data);
        return $query->row();
    }
    
     /*
     * service function to update publish status of a FAQ Question
     */
    
     public function publish_question($faq_model){
         $data = array('is_published' => $faq_model->getIs_published());
         $this->db->update('faq',$data,array('id' => $faq_model->getId()));
         
         return $this->db->affected_rows();
     }
      
     
     public function update_faq($faq_model){
         $data = array('answer',$faq_model->getAnswer());
         
     }
}