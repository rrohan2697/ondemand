<?php
/**
 * Description of Settings_model
 *
 * @author Mukesh Yadav
 */
class Settings_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db->reconnect();
    }

    public function get_websettings($type){
        $this->db->select('id,content_title,content_description');
        $this->db->from('od_settings');
        $this->db->where('id',$type);
        $query = $this->db->get();
        return $query->row_array();
    }

    

    public function edit_term_condition($id){
        $description = $this->input->post('content_description');
        $this->db->update('od_settings',['content_description'=>$description], ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function get_faqs(){
        $query = $this->db->get('od_faqs');
        return $query->result_array();
    }

    public function do_add_faq(){
        $faq_data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
        );
        $this->db->insert('od_faqs', $faq_data);
        return $this->db->insert_id();
    }

    public function do_edit_faq($id){
        $faq_data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
        );
        $this->db->update('od_faqs', $faq_data, ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function get_faqs_byid($id){
        $query = $this->db->get_where('od_faqs', ['id'=>$id]);
        return $query->row_array();
    }

    public function faq_delete($id){
        $this->db->delete('od_faqs', ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function get_banner_images(){
        $query = $this->db->get('od_banner_images');
        return $query->result_array();
    }

    public function get_images_byid($id){
        $query = $this->db->get_where('od_banner_images', ['id'=>$id]);
        return $query->row_array();
    }

    public function do_edit_banner_images($image_url,$id){
        $this->db->update('od_banner_images', ['image_url'=>$image_url], ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function do_add_banner_images($image_url){
        $this->db->insert('od_banner_images', ['image_url'=>$image_url]);
        return $this->db->insert_id();
    }

    public function do_delete_banner_images($id){
        $this->db->delete('od_banner_images', ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function change_status($id,$status){
        $this->db->update('od_banner_images', ['status'=>$status], ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function get_service_charges(){
        $query = $this->db->get('od_service_charges');
        return $query->result_array();
    }

    public function get_charges_byid($id){
        $query = $this->db->get_where('od_service_charges', ['id'=>$id]);
        return $query->row_array();
    }

    public function do_edit_service_charges($id){
        $data = array(
            'delivery_charge' =>$this->security->xss_clean($this->input->post('delivery_charge')),
            'tax_charge' =>$this->security->xss_clean($this->input->post('tax_charge')),
        );
        $this->db->update('od_service_charges', $data, ['id'=>$id]);
        return $this->db->affected_rows();
    }
    
     
    

    public function get_time_slot(){
        $query = $this->db->get('od_time_slot');
        return $query->result_array();
    }
    public function do_edit_time_slot($id){
         $faq_data = array(
            'start_time' => $this->input->post('start_time'),
            // 'end_time' => $this->input->post('end_time'),
        );
        
        $this->db->update('od_time_slot',$faq_data, ['id'=>$id]);
        return $this->db->affected_rows();
    }
    public function time_slot_byid($id){
         $query = $this->db->get_where('od_time_slot',['id'=>$id]);
         return $query->row_array();

    }
    public function do_add_time_slot(){
        $faq_data = array(
            'start_time' => $this->input->post('start_time'),
            // 'end_time' => $this->input->post('end_time'),
        );
        $this->db->insert('od_time_slot', $faq_data);
        return $this->db->insert_id();
    }
    public function do_delete_time_slot($id){
        $this->db->delete('od_time_slot', ['id'=>$id]);
        return $this->db->affected_rows();
    }
    public function change_statustimeslot($id,$status){
        $this->db->update('od_time_slot', ['status'=>$status], ['id'=>$id]);
        return $this->db->affected_rows();
    }
    
}
