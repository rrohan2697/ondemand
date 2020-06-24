<?php
/**
 * Description of Web_users Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Web_users extends CI_Controller{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        parent::__construct();
        $this->load->model(['Web_users_model']);
        $this->load->model(['Web_model']);
        date_default_timezone_set('Asia/Kolkata');
    }
    
    public function getUserById()
    {
        if (!empty($this->session->userdata('user_id'))) {
                $id = $this->session->userdata('user_id');
                $data = $this->Web_users_model->getDataById($id);
                return $data;
            }
        
    }

    public function do_login (){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('emailid','Email Id','trim|required|valid_email');
        $this->form_validation->set_rules('login_pass','Password','trim|required|min_length[6]');        
        if($this->form_validation->run() === false){
            $this->output->set_output(json_encode(['result' =>0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }
        $user_result = $this->Web_users_model->do_login();

        if(!empty($user_result)){
            if(!empty($user_result['status'] === 'Active')){
                $this->session->set_userdata('user_id', $user_result['id']);
                $this->session->set_userdata('user_email', $user_result['email']);
                $this->session->set_userdata('user_name', $user_result['user_name']);
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login successfully!', 'url' => $_SERVER['HTTP_REFERER']]));
                return true;
            }
            else{
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Your are blocked by Admin.', 'data' => 'Your are blocked by Admin.']));
                return false;
            }
        }
        else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email ID or Password is not correct!!', 'data' => 'Email ID or Password is not correct!!']));
            return false;
        }
    }

    public function do_sign_up(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('full_name','Full Name','trim|required');
        $this->form_validation->set_rules('email_id','Email Id','trim|required|valid_email|is_unique[od_users.email]');
        $this->form_validation->set_rules('signup_no','Phone Number','required');
        $this->form_validation->set_rules('signup_pass','Password','required');
        $this->form_validation->set_rules('signup_cpass','Confirm Password','required|matches[signup_pass]');
        $this->form_validation->set_rules('html','Terms and Conditions','required');
        if($this->form_validation->run() === false){
            $this->output->set_output(json_encode(['result' =>0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }
        $result = $this->Web_users_model->do_sign_up();
        if($result){
            
                if(!empty($result['status'] === 'Active')){
                $this->session->set_userdata('user_id', $result['id']);
                $this->session->set_userdata('user_email', $result['email']);
                $this->session->set_userdata('user_name', $result['user_name']);
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login successfully!', 'url' => $_SERVER['HTTP_REFERER']]));
                return true;
            }
            
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Register successfully!', 'url' => $_SERVER['HTTP_REFERER']]));
            return true;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email ID or Password is not correct!!', 'data' => 'Email ID or Password is not correct!!']));
            return false;

        }
    }

    public function logout(){
        $this->output->set_content_type('application/json');
        if($this->session->userdata('user_email')){
           $this->session->unset_userdata('user_id');
           $this->session->unset_userdata('user_email');
           if(!empty($this->cart->contents())){
              $this->cart->destroy();
           }    
           $this->output->set_output(json_encode(['result' => 1, 'url' => base_url(), 'msg' => 'Successfully Logout!!!']));
            return FALSE;
        }
        else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Successfully Logout!!!']));
            return FALSE;
        }
    }

    public function check_email(){
    	$this->output->set_content_type('application/json');
        $this->form_validation->set_rules('forgot_email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $emailid = $this->security->xss_clean($this->input->post('forgot_email'));
        $result = $this->Web_users_model->check_email($emailid);
        if (!empty($result)) {
             
            $this->Web_users_model->update_admin_status($result['id']);
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from('info@ondemand.com');
            $this->email->to($emailid);
            $this->email->subject('Reset password');
            $users_id = $result['id'];
            $htmlContent = "<div style='padding-top:8px;'>Hi , <br><br>Please click below link to create a new password</div>";
            $htmlContent .= "<a href='" . base_url('web-users/resetPassword/'.$users_id). "'>Click Here</a>";
            $this->email->message($htmlContent);
            $send = $this->email->send();
            if ($send) {
                $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('/'), 'msg' => 'Reset password link sent to your email.!']));
                return true;
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to send']));
                return false;
            }
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email-id does not exists.']));
            return FALSE;
        }
    }
    
    public function resetPassword($users_id){
        $data['title'] = 'Reset Your Password';
        $data['user_id'] = $users_id;
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/reset-password');
        $this->load->view('web/common-pages/footer');   
        
    }

    public function do_reset_passowrd($user_id){
    	$this->output->set_content_type('application/json');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Web_users_model->do_reset_passowrd($user_id);
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('/'), 'msg' => 'Password successfully change.!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password did not changed successfully!']));
            return FALSE;
        }
    }
    
    public function doProfileUpdate(){
      $this->output->set_content_type('application/json');
      $this->form_validation->set_rules('profile_name', 'Name', 'trim|required');
      $this->form_validation->set_rules('profile_phone', 'Phone Number', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }        
        $user = $this->getUserById();
        $user_id = $user['id'];
        if (!empty($_FILES['imageUpload']['name'])) {
                $image_name = $_FILES['imageUpload']['name'];
                $img = rand(1, 99999);
                $image_tmp = $_FILES['imageUpload']['tmp_name'];
                $allowed_types = ["jpeg","jpg","png"];
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                if(in_array($ext, $allowed_types)){
                    $image = $img.".".$ext;
                    move_uploaded_file($image_tmp, './uploads/users-profile/'.$image);
                }
            }else{
                $image = $user['profile_url'];
            }        
        $result = $this->Web_users_model->doProfileUpdate($user_id,$image);
        if($result){
            $this->session->set_userdata('user_name', $result['user_name']);
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url(), 'msg' => 'Profile Updated']));
            return FALSE;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to update','url' => base_url()]));
            return FALSE;
        }       
        
    }
    
    public function doChangePassword(){
       $this->output->set_content_type('application/json');
            $data['user_data'] = $user = $this->getUserById();
            $this->form_validation->set_rules('current_pass', 'Current Password', 'required');
            if ($this->form_validation->run() === FALSE) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
                return FALSE;
            }
            $this->form_validation->set_rules('new_pass', 'New Password', 'required');
            $this->form_validation->set_rules('conf_pass', 'Confirm Password', 'required|matches[new_pass]');
            $result = $this->Web_users_model->do_check_oldpassword($user['email']);
            if(empty($result)){
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Your current password did not match to our Databases']));
                return FALSE;
            }else{
                if($this->input->post('current_pass') == $this->input->post('new_pass')){
                    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Current Password and New Password should not be same!']));
                    return FALSE;
                }
                if ($this->form_validation->run() === FALSE) {
                    $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
                    return FALSE;
                }
            }
            $changed = $this->Web_users_model->reset_password($user['email']);
            if ($changed) {
                $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('/'), 'msg' => 'Password Updated Sucessfully.']));
                return FALSE;
            } 
    }
    
    public function fbLogin() {
            if ($this->facebook->is_authenticated()) {
                $userProfile = $this->facebook->request('get', '/me?fields=id,name,email');
                // print_r($userProfile);die;
                if (!isset($userProfile['error'])) {
                    if(empty($userProfile['email'])){
                        $this->session->set_flashdata('fb_req_email', "Email is required");
                        echo "<script>alert('Email not registered')</script>";
                        redirect(base_url('/'));
                        
                    }
                    $session_data['email'] = $userProfile['email'];
                    $session_data['name'] = $userProfile['name'];
                    $session_data['source'] = 'facebook';
                    $email = $session_data['email'];
                    $name = $session_data['name'];
                    $source = 'facebook';
                    $result = $this->Web_users_model->checkClient($email);
                    // print_r($result);die;
                    if ($result) {
                        $this->session->set_userdata('user_id', $result['id']);
                        $this->session->set_userdata('user_email', $result['email']);
                        $this->session->set_userdata('user_name', $result['user_name']);
                        redirect(base_url('/'));
                    } else {
                        $result = $this->Web_users_model->client_login($session_data);
                        $this->session->set_userdata('user_id', $result['id']);
                        $this->session->set_userdata('user_email', $result['email']);
                        $this->session->set_userdata('user_name', $result['user_name']);
                        redirect(base_url('/'));
                    }
                } else {
                   
                    $this->facebook->destroy_session();
                    $url = $this->session->userdata('postUrl');
                    redirect($_SERVER['http_reffrer']);
                }
            }
        }
    
    public function oauth2callback(){
            $this->output->set_content_type('application/json');
            $session_data['email'] = $this->input->post('email');
            $session_data['name'] = $this->input->post('name');
            $session_data['source'] = 'google';
            $email = $session_data['email'];
            $name = $session_data['name'];
            $source = 'google';
            $this->session->set_userdata('user_email', $email);
            $result = $this->Web_users_model->checkClient($email);
            if ($result) {
                $this->session->set_userdata('user_id', $result['id']);
                $this->session->set_userdata('user_email', $result['email']);
                $this->session->set_userdata('user_name', $result['user_name']);
            }else {
                $result = $this->Web_users_model->client_login($session_data);
                $this->session->set_userdata('user_id', $result['id']);
                $this->session->set_userdata('user_email', $result['email']);
                $this->session->set_userdata('user_name', $result['user_name']);
            }
            $this->output->set_output(json_encode(['result' => 1]));
            return FALSE;
        }
    
    
    
    public function chatInsert(){
        $this->output->set_content_type('application/json');
        $user_id = $this->getUserById()['id'];
        $msg = $this->input->post('msg');
        $check = $this->Web_users_model->checkChatInsert($user_id);
        if($check){
            $result = $this->Web_users_model->updateMessage($user_id,$msg);
            if($result){
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Inserted', 'url' => $_SERVER['HTTP_REFERER']]));
                return true;
            }
        }else{
            $result = $this->Web_users_model->chatInsert($user_id,$msg);
            if($result){
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Inserted', 'url' => $_SERVER['HTTP_REFERER']]));
                    return true;
            }
            
        }
        
    }
}