<?php
/**
 * Description of Admin_model 
 *
 * @author Mukesh Yadav
 */
class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->reconnect();
    }

    public function do_login() {
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password')))
        );
        $result = $this->db->get_where('od_admin', $data);
        return $result->row_array();
    }

    public function get_admin($email){
        $query = $this->db->get_where('od_admin',['email'=>$email]);
        return $query->row_array();
    }
    
    public function get_admininfo_byid($id){
        $query = $this->db->get_where('od_admin',['id'=>$id]);
        return $query->row_array();
    }
    
    public function do_check_oldpassword($admin_id){
        
        $oldpassword = $this->security->xss_clean(hash('sha256', $this->input->post('current_password')));
        $query = $this->db->get_where('od_admin', ['id'=>$admin_id, 'password'=>$oldpassword]);
        return $query->row_array();
    }

    public function do_change_passowrd($admin_id){
        $newpassword = $this->security->xss_clean(hash('sha256', $this->input->post('new_password')));
        $this->db->update('od_admin', ['password'=>$newpassword], ['id'=>$admin_id]);
        return $this->db->affected_rows();        
    }

    public function do_reset_passowrd($admin_id){
        $newpassword = $this->security->xss_clean(hash('sha256', $this->input->post('new_password')));
        $this->db->update('od_admin', ['password'=>$newpassword], ['id'=>$admin_id,'is_forgot'=>'Active']);
        if(!empty($this->db->affected_rows())){
            $this->db->update('od_admin', ['is_forgot'=>'Inactive'], ['id'=>$admin_id]);
            return $this->db->affected_rows();
        }
        else{
            return false;
        }        
    }

    public function check_emailid(){
        $email = $this->security->xss_clean($this->input->post('emailid'));
        $query = $this->db->get_where('od_admin',['email'=>$email]);
        return $query->row_array();
    }

    public function update_admin_status($id){
        $this->db->update('od_admin', ['is_forgot'=>'Active'], ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function do_edit_profile($admin_id,$image_url){
        $username = $this->security->xss_clean($this->input->post('username'));
        $profile_title = $this->security->xss_clean($this->input->post('profile_title'));
        $email_id = $this->security->xss_clean($this->input->post('email_id'));
        $profile_data = array(
            'username' => $username,
            'profile_title' => $profile_title,
            'email' => $email_id,
            'profile_url' => $image_url
        );
        $this->db->update('od_admin', $profile_data, ['id'=>$admin_id]);
        return $this->db->affected_rows();
    }

    public function get_numbersof_users(){
        $this->db->from('od_users');
        return $this->db->count_all_results();
    }
 public function get_numbersof_order(){
        $this->db->from('od_orders');
        return $this->db->count_all_results();
    } 
    public function get_numbersof_ongoingbooking(){
        $this->db->from('od_orders');
        $this->db->where('status','Ongoing');
        return $this->db->count_all_results();
    }
    public function get_numbersof_services(){
        $this->db->from('od_services');
        return $this->db->count_all_results();
    }

    public function get_numbersof_newusers(){
        $this->db->from('od_users');
        $this->db->where('created_at >= DATE(NOW()) - INTERVAL 7 DAY');
        return $this->db->count_all_results();
    }
    
    public function chatList(){
        $this->db->select('chat.*,od_users.id,od_users.user_name,od_users.profile_url,od_users.id as user_id');
        $this->db->from('chat');
        $this->db->join('od_users','od_users.id=chat.sender_id');
        $this->db->where('reciever_id','TyM1oIvSbn');
        $this->db->order_by('chat.id', 'desc');
        $sel =  $this->db->get();
        return $sel->result_array();
        
    }
    public function chatListDesc(){
        $this->db->select('chat.*,od_users.id,od_users.user_name,od_users.profile_url');
        $this->db->from('chat');
        $this->db->join('od_users','od_users.id=chat.sender_id');
        $this->db->where('reciever_id','TyM1oIvSbn');
        $this->db->order_by('chat.id', 'desc');
        $sel =  $this->db->get();
        return $sel->row_array();
        
    }
    
    public function checkChatInsert($user_id,$admin_id){
        $this->db->select('*');
        $this->db->from('chat');
        $this->db->where('sender_id',$user_id); 
        $this->db->where('reciever_id',$admin_id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function updateMessage($user_id,$msg){
        $this->db->where('sender_id',$user_id);
        $this->db->where('reciever_id','TyM1oIvSbn');
        $this->db->update('chat',['message'=>$msg,'date'=>date('y-m-d'),'time'=> date('h:i')]);
        return $this->db->affected_rows();      
        
    }
    
    public function chatInsert($user_id,$msg){
        $data = array(
        'sender_id'=>$user_id,
        'reciever_id'=>'TyM1oIvSbn',
        'message'=>$msg,
        'date'=> date('y-m-d'),
        'time'=> date('h:i')
        );
        
        $this->db->insert('chat',$data);
        return $this->db->insert_id();
    }
    public function countnotification(){
        $this->db->from('od_orders');
        $this->db->where('status','Ongoing');
        return $this->db->count_all_results();
    }
}