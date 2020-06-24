<?php
/**
 * Description of Services_model
 *
 * @author Mukesh Yadav
 */
class Service_provider_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->reconnect();
    }

    public function get_service_provider(){
        $this->db->select('odsp.*,odc.id as category_id, odc.category_name');
        $this->db->from('od_services_provider odsp');
        $this->db->join('od_category odc','odc.id = odsp.category_id');
        $this->db->order_by('odsp.id','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_service_byid($id){
        $query = $this->db->get_where('od_services_provider', ['id'=>$id]);
        return $query->row_array();
    }

    public function do_add_service($profile_url){
        $data = array(
            'category_id' => $this->security->xss_clean($this->input->post('category_name')),
            'subcategory_id' => $this->security->xss_clean($this->input->post('sub_category_name')),
            'name' => $this->security->xss_clean($this->input->post('name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'phone_number' => $this->security->xss_clean($this->input->post('phone_number')),
            'addressline1' => $this->security->xss_clean($this->input->post('addressline1')),
            'addressline2' => $this->security->xss_clean($this->input->post('addressline2')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'postcode' => $this->security->xss_clean($this->input->post('postcode')),
            'profile_url' => $profile_url,
        );
        $this->db->insert('od_services_provider', $data);
        return $this->db->insert_id();
    }

    public function do_edit_service($profile_url, $id){
        $data = array(
            'category_id' => $this->security->xss_clean($this->input->post('category_name')),
            'subcategory_id' => $this->security->xss_clean($this->input->post('sub_category_name')),
            'name' => $this->security->xss_clean($this->input->post('name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'phone_number' => $this->security->xss_clean($this->input->post('phone_number')),
            'addressline1' => $this->security->xss_clean($this->input->post('addressline1')),
            'addressline2' => $this->security->xss_clean($this->input->post('addressline2')),
            'city' => $this->security->xss_clean($this->input->post('city')),
            'postcode' => $this->security->xss_clean($this->input->post('postcode')),
            'profile_url' => $profile_url,
        );
        $this->db->update('od_services_provider', $data, ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function chnage_status($user_id, $user_status){
        $this->db->update('od_services_provider', ['status' => $user_status], ['id' => $user_id]);
        return $this->db->affected_rows();
    }

    public function do_delete_service($id){
        $this->db->delete('od_services_provider', ['id'=>$id]);
        return $this->db->affected_rows();
    }
    public function get_service_providerbyid($id){
         $this->db->select('odsp.*,odc.category_name,odcs.subcategory_name');
        $this->db->from('od_services_provider odsp');
        $this->db->join('od_category odc','odsp.category_id = odc.id');
        $this->db->join('od_subcategory odcs','odsp.subcategory_id = odcs.id');
        $this->db->where('odsp.id',$id);
        $query = $this->db->get();
        return $query->row_array();

    }
}
