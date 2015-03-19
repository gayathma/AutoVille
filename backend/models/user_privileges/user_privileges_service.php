<?php

class User_privileges_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('employee_privileges/employee_privileges_model');
    }

    public function get_all_employee_privileges() {


        $this->db->select('*');
        $this->db->from('employee_privileges');
        $query = $this->db->get();
        return $query->result();
    }

    function get_assigned_privileges_by_user_id($user_id) {

        $query = $this->db->get_where('user_privileges', array('id' => $user_id));
        return $query->result();
    }

    function delete_employee_privilege($employee_privilege_code) {

        return $this->db->delete('employee_privileges', array('employee_privilege_code' => $employee_privilege_code));
    }

    function update_employee_privilege($employee_privilege_model) {

        $data = array(
            'employee_code' => $employee_privilege_model->get_employee_code(),
            'privilege_code' => $employee_privilege_model->get_privilege_code()
        );


        $this->db->where('employee_privilege_code', $employee_privilege_model->get_employee_privilege_code());

        return $this->db->update('employee_privileges', $data);
    }

    function add_new_user_privilege($user_privilege_model) {

        $this->db->select('*');
        $this->db->from('user_privileges');
        $this->db->where('user_code', $user_privilege_model->get_user_code());
        $this->db->where('privilege_code', $user_privilege_model->get_privilege_code());
        $query = $this->db->get();
        $a = 0;
        foreach ($query->result() as $pri) {
            $a = 1;
            $user_privilege_model->set_user_privilege_code($pri->user_privilege_code);
        }
        if ($a == 0) {
            return $this->db->insert('employee_privileges', $user_privilege_model);
        } else {
            return $this->db->delete('employee_privileges', array('employee_privilege_code' => $user_privilege_model->get_employee_privilege_code()));
        }
    }

    function add_new_employee_privilege_system($employee_privilege_model) {

        $this->db->select('*');
        $this->db->from('employee_privileges');
        $this->db->where('employee_code', $employee_privilege_model->get_employee_code());
        $this->db->where('privilege_code', $employee_privilege_model->get_privilege_code());
        $query = $this->db->get();
        $a = 0;
        foreach ($query->result() as $pri) {
            $a = 1;
        }
        if ($a == 0) {
            return $this->db->insert('employee_privileges', $employee_privilege_model);
        }
    }

    function delete_new_employee_privilege_system($employee_privilege_model) {

        $this->db->select('*');
        $this->db->from('employee_privileges');
        $this->db->where('employee_code', $employee_privilege_model->get_employee_code());
        $this->db->where('privilege_code', $employee_privilege_model->get_privilege_code());
        $query = $this->db->get();
        $a = 0;
        foreach ($query->result() as $pri) {
            $a = 1;
            $employee_privilege_model->set_employee_privilege_code($pri->employee_privilege_code);
        }
        if ($a == 1) {
            return $this->db->delete('employee_privileges', array('employee_privilege_code' => $employee_privilege_model->get_employee_privilege_code()));
        }
    }

}
