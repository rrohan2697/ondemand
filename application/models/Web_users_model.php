<?php
/**
 * Description of Web_users_model Model
 *
 * @author Mukesh Yadav
 */
class Web_users_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->reconnect();
    }
    
    public function getDataById($id){
        $sel = $this->db->get_where('od_users',['id'=>$id]);
        return $sel->row_array();
    }
    
    public function do_sign_up(){
        $user_data = array(
            'user_name' => $this->security->xss_clean($this->input->post('full_name')),
            'email' => $this->security->xss_clean($this->input->post('email_id')),
            'phone_number' => $this->security->xss_clean($this->input->post('signup_no')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('signup_pass')))
            
        );

        $this->db->insert('od_users', $user_data);
        $id =  $this->db->insert_id();
        $sel = $this->db->get_where('od_users',['id'=>$id]);
        return $sel->row_array();
    }

    public function do_login(){
        $user_data = array(
            'email' => $this->security->xss_clean($this->input->post('emailid')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('login_pass')))
        );

        $query = $this->db->get_where('od_users', $user_data);
        return $query->row_array(); 
    }

    public function check_email($email){
        $query = $this->db->get_where('od_users', ['email'=>$email]);
        return $query->row_array();
    }

    public function update_admin_status($user_id){
        $this->db->update('od_users',['is_forgot'=>'Active'], ['id'=>$user_id]);
        return $this->db->affected_rows();
    }

    public function do_reset_passowrd($user_id){
        $user_data = array(
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('new_password')))
        );
        $this->db->update('od_users', $user_data, ['id'=>$user_id]);
        return $this->db->affected_rows();
    }
    
    public function doProfileUpdate($user_id,$image){
        $data = array(
        'user_name'=>$this->security->xss_clean($this->input->post('profile_name')),
        'phone_number'=>$this->security->xss_clean($this->input->post('profile_phone')),
        'profile_url'=>$image
        );
        
        $this->db->where('id',$user_id);
        $this->db->update('od_users',$data);
        $sel = $this->db->get_where('od_users',['id'=>$user_id]);
        return $sel->row_array();
    }
    
    public function do_check_oldpassword($email){
        $oldpassword = $this->security->xss_clean(hash('sha256', $this->input->post('current_pass')));
        $query = $this->db->get_where('od_users', ['email'=>$email, 'password'=>$oldpassword]);
        return $query->row_array();
    }
    
    public function reset_password($email){
        $newpassword = $this->security->xss_clean(hash('sha256', $this->input->post('new_pass')));
        $this->db->update('od_users', ['password'=>$newpassword], ['email'=>$email]);
        return $this->db->affected_rows();
    }
    
    public function checkClient($email) {
        $query = $this->db->get_where('od_users', ['email' => $email]);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return 0;
    }
    
    public function client_login($session_data) {
        
        $data = array(
            'user_name' => $session_data['name'],
            'email' => $session_data['email'],
            'source' => $session_data['source'],
            
        );
        $this->db->insert('od_users', $data);
        $id =  $this->db->insert_id();
        $sel = $this->db->get_where('od_users',['id'=>$id]);
        return $sel->row_array();
    }
    
    public function checkChatInsert($user_id){
        $this->db->select('*');
        $this->db->from('chat');
        $this->db->where('sender_id',$user_id);
        $this->db->where('reciever_id','TyM1oIvSbn');
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
}
