<?php
/**
 * Description of Users_model
 *
 * @author Mukesh Yadav
 */
class Users_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->reconnect();
    }

    public function get_users(){
        $this->db->order_by('id','DESC');
        $query = $this->db->get('od_users');
        return $query->result_array();
    }

    public function chnage_status($user_id, $user_status){
        $this->db->update('od_users', ['status' => $user_status], ['id' => $user_id]);
        return $this->db->affected_rows();
    }

    public function view_user_info($id){
        $query = $this->db->get_where('od_users',['id'=>$id]);
        return $query->row_array();
    }

    public function get_token_by($user_id){
        $query = $this->db->get_where('od_firebase_token', ['user_id'=>$user_id, 'status' => 'Active']);
        return $query->row_array();
    }

    public function add_commonnotification($title, $description, $user_id){
        $data = array(
            'user_id' =>$user_id,
            'title' =>$title,
            'body' =>$description
        );
        $this->db->insert('od_notification',$data);
        return $this->db->insert_id();
    }

    public function get_notification($user_id){
        $query = $this->db->get_where('od_notification', ['user_id'=>$user_id]);
        return $query->result_array();
    }
    public function view_user_detail($user_id){
        $query = $this->db->get_where('od_users', ['id'=>$user_id]);
        return $query->row_array();
    }
    public function get_user_address($user_id){
        $query = $this->db->get_where('od_address', ['user_id'=>$user_id]);
        return $query->result_array();
    }
    public function get_contactus(){
        $this->db->order_by('id','DESC');
        $query = $this->db->get('od_contactus');
        return $query->result_array();
    }
     public function get_social(){
        $query = $this->db->get('od_social');
        return $query->result_array();
    }
     public function social_byid($id){
         $query = $this->db->get_where('od_social',['id'=>$id]);
         return $query->row_array();

    }
    public function do_add_social(){
        $data = array(
            'name' => $this->input->post('name'),
            'sociallink' => $this->input->post('social_link'),
        );
        $this->db->insert('od_social', $data);
        return $this->db->insert_id();
    }
    public function do_delete_social($id){
        $this->db->delete('od_social', ['id'=>$id]);
        return $this->db->affected_rows();
    }

     public function do_edit_time_slot($id){
        $data = array(
            'name'=>$this->input->post('name'),
            'sociallink '=>$this->input->post('social_link'),
            
        );
        $this->db->update('od_social',$data,['id'=>$id]);
        return $this->db->affected_rows();
    }
}
