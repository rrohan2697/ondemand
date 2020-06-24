<?php 
/**
 * Description of Admin Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') OR die('Not Allowed');

class Admin extends CI_Controller {

    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        
        parent::__construct();
        $this->load->model(['Admin_model']);
    }
    
    public function index(){
        redirect(base_url('admin/login'));
    }
    
    /* ------------------------ @Start admin login logout here -------------------------- */
    
    public function login(){
        if(!empty($this->session->userdata('admin_emailid'))){
            redirect(base_url('admin/dashboard'));
        }
        $data['title'] = 'Admin Login';
    	$this->load->view('admin/login', $data);
    }
    
    public function do_login(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Admin_model->do_login();
        if (!empty($result)) {
            $this->session->set_userdata('admin_emailid', $result['email']);
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('dashboard'), 'msg' => 'Welcome']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid Username or Password.']));
            return FALSE;
        }
    }
    
    public function logout() {
        $this->output->set_content_type('application/json');
        if($this->session->userdata('admin_emailid')){
           $this->session->unset_userdata('admin_emailid');
           $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/login'), 'msg' => 'Successfully Logout!!!']));
            return FALSE;
        }
        else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Successfully Logout!!!']));
            return FALSE;
        }
        
    }
    /* ------------------------- @End admin login logout here ----------------------- */
    
    /* ------------------- @Start admin forgot password here ----------------------- */
    
    public function forgot_password(){
        
        $data['title'] = 'Forgot Password';
    	$this->load->view('admin/forgot-password', $data);
    }
    
    public function check_emailid(){
    	$this->output->set_content_type('application/json');
        $this->form_validation->set_rules('emailid', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Admin_model->check_emailid();
        if (!empty($result)) {
            $this->Admin_model->update_admin_status($result['id']);
            $emailid = $this->security->xss_clean($this->input->post('emailid'));
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from('info@ondemand.com');
            $this->email->to($emailid);
            $this->email->subject('Reset password');
            $admin_id = $result['id'];
            $htmlContent = "<div style='padding-top:8px;'>Hi Admin, <br><br>Please click below link to create a new password</div>";
            $htmlContent .= "<a href='" . base_url('admin/reset-password/'.$admin_id). "'>Click Here</a>";
            // $htmlContent = "<p>Your New Password link is :" .base_url('admin/reset-password/'.$admin_id)."</p>";
            $this->email->message($htmlContent);
            //Send email
            $send = $this->email->send();
            if ($send) {
                $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/login'), 'msg' => 'Reset password link sent to your email.!']));
                return true;
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to send']));
                return false;
            }
            
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid Email ID...']));
            return FALSE;
        }
    }
    
    public function reset_password($admin_id){
        $data['admin_id'] = $admin_id;
        $data['title'] = 'Reset Password';
    	$this->load->view('admin/reset-password', $data);
    }
    
    public function do_reset_passowrd($admin_id){

    	$this->output->set_content_type('application/json');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confrim_password', 'Confirm Password', 'trim|required|matches[new_password]');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Admin_model->do_reset_passowrd($admin_id);
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/login'), 'msg' => 'Password Changed Successfully!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password did not changed successfully!']));
            return FALSE;
        }
    }
    /* --------------------- @End admin forgot password here -------------------------- */
    
    /* -------------------------- @Start admin dashboard here ----------------------------- */
    public function dashboard(){
        if($this->session->userdata('admin_emailid') === NULL){
            redirect(base_url('admin/login'));
        } 
        $data['title'] = 'Dashboard';
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $data['notications'] = $this->Admin_model->countnotification();
        $data['total_users'] = $this->Admin_model->get_numbersof_users();
        $data['new_users'] = $this->Admin_model->get_numbersof_newusers();
        $data['booking'] = $this->Admin_model->get_numbersof_order();
        $data['ongoingbooking'] = $this->Admin_model->get_numbersof_ongoingbooking();
        $data['services'] = $this->Admin_model->get_numbersof_services();
        // // $data['subscribed_users'] = $this->Admin_model->get_numbersof_subscribed_users();
    	$this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
    	$this->load->view('admin/dashboard');
        $this->load->view('admin/common-pages/footer');
    }
    /* -------------------------- @End admin dashboard here ----------------------------- */
    
    /* ---------------------- @Start admin change password here ------------------------ */
    public function change_password(){
        if ($this->session->userdata('admin_emailid') === NULL) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Change Password';
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
         $data['notications'] = $this->Admin_model->countnotification();
    	$this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/change-password');
        $this->load->view('admin/common-pages/footer');
    }
     
    public function do_change_password($admin_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Admin_model->do_check_oldpassword($admin_id);
        
        if (!empty($result)) {
            $changed = $this->Admin_model->do_change_passowrd($admin_id);
            if($changed){
                $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/dashboard'), 'msg' => 'Password Changed Successfully!']));
                return FALSE;
            }
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password did not changed successfully!']));
            return FALSE;
            
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Old password did not matched current password!']));
            return FALSE;
        }
    }
    /* ------------------------ @End admin change password here ------------------------ */

    /* ---------------------------- @Start admin profile Edit here ---------------------------- */
    public function profile(){
        if ($this->session->userdata('admin_emailid') === NULL) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Edit Profile';
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
         $data['notications'] = $this->Admin_model->countnotification();
    	$this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/edit-profile');
        $this->load->view('admin/common-pages/footer');
    }
    
    public function do_edit_profile($admin_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('profile_title', 'Profile Title', 'trim|required');
        $this->form_validation->set_rules('email_id', 'Email Id', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['profile_url']['name'])) {
            $image_url = $this->uploadImage();
            if ($image_url == 0) {
                $errors = $this->session->userdata('errors');
                $this->session->unset_userdata('errors');
                $this->output->set_output(json_encode(['result' => -2, 'errors' => $errors]));
                return false;
            }
        }
        else {
            $admin_info = $this->Admin_model->get_admininfo_byid($admin_id);
            $image_url = $admin_info['profile_url'];
        }
        $result = $this->Admin_model->do_edit_profile($admin_id,$image_url);
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/dashboard'), 'msg' => 'Successfully saved your changes!']));
            return FALSE;
            
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Chnages Found Here']));
            return FALSE;
        }
    }

    public function uploadImage() {
        $file_name = $_FILES['profile_url']['name'];
        $file_tmpname = $_FILES['profile_url']['tmp_name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed_type = array("jpeg", "jpg", "png", "gif");
        if (in_array(strtolower($ext), $allowed_type)) {
            if ($_FILES["profile_url"]["size"] > 6000000) {
                $this->session->set_userdata('errors', ['profile_url' => 'Sorry, your file is too large.']);
                return 0;
            }
            $new_file_name = rand(111111, 999999) . '.' . $ext;
            move_uploaded_file($file_tmpname, './uploads/admin-profile/' . $new_file_name);
            return $new_file_name;
        } else {
            $this->session->set_userdata('errors', ['profile_url' => '.' . $ext . ' Extension Not Allowed Here...']);
            return 0;
        }
    }
    /* ------------------------------ @End admin profile Edit here ---------------------------- */
    
     public function chat($id = null){
        $data['title'] = 'Chat';
        if(empty($id)){
            $chat_list = $this->Admin_model->chatListDesc();
            if($chat_list){
                redirect(base_url('admin/chat/'.$chat_list['sender_id']));
            }
        }else{
            $data['user_id'] = $id;
        }
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $data['notications'] = $this->Admin_model->countnotification();
        $data['chatList'] = $this->Admin_model->chatList();
    	$this->load->view('admin/common-pages/header', $data);
//        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/chat');
        $this->load->view('admin/common-pages/footer');
    }
    
    public function chatInsert(){
        $this->output->set_content_type('application/json');
        $admin_id = 'TyM1oIvSbn';
        $user_id = $this->input->post('user_id');
        $msg = $this->input->post('msg');
        $check = $this->Admin_model->checkChatInsert($user_id,$admin_id);
        if($check){
            $result = $this->Admin_model->updateMessage($user_id,$msg);
            if($result){
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Inserted', 'url' => $_SERVER['HTTP_REFERER']]));
                return true;
            }
        }else{
            $result = $this->Admin_model->chatInsert($user_id,$msg);
            if($result){
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Inserted', 'url' => $_SERVER['HTTP_REFERER']]));
                    return true;
            }
            
        }
        
    }
    
    
}