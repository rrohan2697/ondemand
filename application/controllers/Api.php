<?php

/**
 * Description of Api Controller
 *
 * @author varun negi
 */
defined('BASEPATH') or die('Not Allowed');

class Api extends CI_Controller
{
    /**
    * __construct
    *
    * @return void
    */
    public function __construct(){

        parent::__construct();
        $this->load->model(['Api_model']);
    }

    public function index()
    {
        echo "Hey varun negi!!!!";
        exit;
    }  
    
    public function uniqueId() {
        $str = '123456789';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 8);
        return $unique_id;
    }
     /**
     * login_register This is using for register new users and login throught social media! 
     *
     * @return void
     */
     public function login_registration(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('full_name','Full Name','trim|required');
        $this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
        $this->form_validation->set_rules('country_code', 'Country Code', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required|min_length[10]|max_length[10]');
       // $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('term','Term  Condition','required',array('required' => 'Please Select Terms & Condition'));
        $this->form_validation->set_rules('source', 'Source', 'trim|required');
        $source = $this->input->post('source');
        if($source === "Self"){
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[15]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

        }
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }
        $email = $this->security->xss_clean($this->input->post('email'));
        //$location = $this->security->xss_clean($this->input->post('location'));
        $already_register = $this->Api_model->check_useraccount($email);
        if(!empty($already_register)){
            if (!empty($already_register['source'] !== 'Self')) {
                if (!empty($already_register['status'] === 'Active')) {
                    $users_info = $this->Api_model->get_userdata($already_register['id']);
                    if (!empty($users_info['profile_url'])) {
                        $users_info['image_url'] = base_url('uploads/users-profile/' . $users_info['profile_url']);
                    } else {
                        $users_info['image_url'] = 'NULL';
                    }
                    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login successfully!', 'data' => $users_info]));
                    return true;
                }
                else {
                    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'You are block by admin!']));
                    return false;
                }
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email address is already registered!']));
                return false;
            }
        } else {
            $registered = $this->Api_model->user_register();
            if(!empty($registered)){
                $this->sendMails($registered['full_name'],$registered['email']);
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login successfully!', 'data' => $registered]));
                return true;
            }else{
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Went somthing worng.']));
                return false; 
            }
        }
    }
    
   public function sendMails($user_name,$user_email){
            $this->load->library('email');
            $htmlContent = "<h3>Dear " . $user_name . ",</h3>";
            $htmlContent .= "<div style='padding-top:8px;'>Welcome to Hammer and Spanner! We’re so Happy to have you here.</div>";
            $htmlContent .= "<div style='padding-top:8px;'>Hammer and Spanner Team.</div>";

            $from = "hammerandspanner@hammerandspanne.in";
            $to = $user_email;
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: ' . $from . "\r\n";
            $subject = "Registration Confirmation";
            mail($to, $subject, $htmlContent, $headers);
           return true;
        }
        

    public function setToken(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('user_id','User ID','trim|required');
        $this->form_validation->set_rules('token_id','Token Id','trim|required');
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }
        $user_id = $this->input->post('user_id');
        $token_id = $this->input->post('token_id');
        $already = $this->Api_model->check_tokenexist($user_id,$token_id);
        if(!empty($already > 0)){
            $token_info = array(
                'token_id' => $token_id,
                'status' => 'Active'
            );
            $results = $this->Api_model->update_tokenid($already['id'], $token_info);
            if (!empty($results)) {
             $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Token successfully updated', 'data' => 'Token successfully updated.']));
             return true;
         } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Token did not successfully updated.', 'Token' => 'Data did not successfully updated.']));
            return false;
        }

    }
    else{
       $token_info = array(
           'user_id' => $user_id,
           'token_id' => $token_id,
           'status' => 'Active'
       );
       $results = $this->Api_model->insert_tokenid($token_info);
       if ($results) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Token successfully Added', 'data' => 'Token successfully Added.']));
        return true;
    } else {
       $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Token did not successfully Added.', 'data' => 'Token did not successfully Added.']));
       return false;

   }
}

}

    /**
     * login This is using for Login user! 
     *
     * @return void
     @varun negi
     */
     public function login(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');
        if($this->form_validation->run() === false){
            $this->output->set_output(json_encode(['result' =>0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }

        $email = $this->security->xss_clean($this->input->post('email')); 
        $password = $this->security->xss_clean(hash('sha256', $this->input->post('password')));
        $results = $this->Api_model->login($email,$password);
        if($results){
            if(!empty($results['profile_image'])){
                $results['profile_image'] = base_url('uploads/users-profile/' . $results['profile_image']);

            }
            else{
                $results['profile_image'] = null;
            }
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login successfully!', 'data' => $results]));
            return true;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email address or Password is incorrect!!']));
            return false;

        }
    }


    /**
     * changes_password Using this function user change password!
     *
     * @return void
     */

    public function changes_password(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('user_id','User Id','trim|required');
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        } 
        $checked = $this->Api_model->check_oldpassword();
        if(!empty($checked)){
            //$this->form_validation->set_rules('term','Term  Condition','required',array('required' => 'Please Select Terms & Condition'));
            $this->form_validation->set_message('min_length', 'New password must be of 6 digits');
            $this->form_validation->set_message('matches', 'Password and confirm password must be same');
            $this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[6]|max_length[15]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
            if ($this->form_validation->run() === false) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
                return false;
            }
            $results = $this->Api_model->change_password($checked['id']);
            if ($results) {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password change successfully!']));
                return true;
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'New password should not be same as old password!']));
                return false;
            }
        }
        else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Old and Current password does not match!']));
            return false;
        }
    }

     /**
     * forgot_password change user password here!
     *
     * @return void
     */

     public function forgot_password(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
        if ($this->form_validation->run() === false) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return false;
        }
        $email = $this->security->xss_clean($this->input->post('email'));
        $results = $this->Api_model->check_email($email);
        if (!empty($results)) {
            $this->send_forgot_password_link($results);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'We have sent a link to your registered Email id to recover password!']));
            return true;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Email does not exist']));
            return false;
        }
    }

    public function send_forgot_password_link($results){
        $this->load->library('email');
        $getEmailResponse = $this->Api_model->insert_user_activationcode($results['id']);

        $htmlContent = "<h3>Dear " . $results['user_name'] . ",</h3>";
        $htmlContent .= "<div style='padding-top:8px;'>Please click here to create a new password...</div>";
        $htmlContent .= "<a href='" . base_url('api/reset-password/' . $results['id']) . "'> Click Here!!</a> Set new password!";

        $from = "HammerandSpanner@hammerandspanne.com";
        $to = $results['email'];
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . $from . "\r\n";
        $subject = "Hammer and Spanner password reset link";
        mail($to, $subject, $htmlContent, $headers);
        return true;

    }

      /**
     * reset_password reset password using this function
     *
     * @param  mixed $user_id
     *
     * @return void
     */
      public function reset_password($user_id)
      {
        $data['user_id'] = $user_id;
        $data['title'] = 'Reset Password';
        $result = $this->Api_model->check_forgate($user_id);
        if(!empty($result))
        {
        $this->load->view('admin/users/reset-password', $data);
        }
         else {
         echo "Your password reset link has expired!";
            
        }
    }

     /**
     * do_reset_passowrd reset password using this function
     *
     * @param  mixed $user_id
     *
     * @return void
     */

     public function do_reset_passowrd($user_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_message('min_length', 'New password must be of 6 digits');
        $this->form_validation->set_message('matches', 'Password and confirm password must be same');
        $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|min_length[6]|max_length[15]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[newpassword]');
        if($this->form_validation->run()=== FALSE){
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $results = $this->Api_model->do_reset_passowrd($user_id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password change successfully .!']));
            return TRUE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password did not changed successfully!']));
            return FALSE;
        }
    }

    /**
     * edit profile  using this function
     *
     * @param  mixed $user_id
     *
     * @return void
     */

    public function edit_profile(){
       $this->output->set_content_type('application/json');
       $this->form_validation->set_rules('user_id','User ID','trim|required');
       $this->form_validation->set_rules('full_name','Full Name','trim|required');
       $this->form_validation->set_rules('email','Email Id','trim|required');
       $this->form_validation->set_rules('country_code', 'Country Code', 'trim|required');
       $this->form_validation->set_rules('mobile_no','Phone Number','required|min_length[10]|max_length[10]');
       if ($this->form_validation->run() === false) {
        $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
        return false;
      }
    $user_id = $this->security->xss_clean($this->input->post('user_id'));
    if(!empty($_FILES['image_url']['name'])){
        $image_url = $this->updateProfileImage($user_id);
    }
    else{
       $image = $this->Api_model->get_userdata($user_id);
       $image_url = $image['profile_url'];
   }
   $results = $this->Api_model->edit_profile($user_id,$image_url);
   if ($results) {
    if (!empty($results['profile_image'])) {
        $results['profile_image'] = base_url('uploads/users-profile/' . $results['profile_image']);
    } else {
        $results['profile_image'] = '';
    }
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Profile updated', 'data' => $results]));
    return TRUE;
   } else {
    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong Profile not updated!']));
    return false;
  }

}

     /**
     * updateProfileImage using this function Upload Image!
     *
     * @return void
     */

     public function updateProfileImage($user_id){
       $config = array(
        'upload_path' => './uploads/users-profile/',
        'allowed_types' => 'jpeg|jpg|png',
        'file_name' => 'U-' . $user_id . '@' . rand(1111, 9999),
        'max_size' => "15000"
    );
       $this->load->library('upload', $config);
       $this->upload->initialize($config);
       if ($this->upload->do_upload('image_url')) {
        $data = $this->upload->data();
        return $data['file_name'];
    } else {
        $this->session->set_userdata('error', ['file' => $this->upload->display_errors()]);
        return 0;
    }

}

    /**
     * faqs using this function get faqs list!
     *
     * @return void
     */

    public function faqs(){
        $this->output->set_content_type('application/json');
        $faqs = $this->Api_model->get_faqs();
        $faqsdatas = array();
        $i = 0;
        foreach($faqs as $faqdata){
            $faqsdatas[$i]['id'] = $faqdata['id'];
            $faqsdatas[$i]['title'] = $faqdata['title'];
            $faqsdatas[$i]['description'] = strip_tags($faqdata['description']);
            $i++;
        }

        if(!empty($faqsdatas)){
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data loaded!', 'data' =>$faqsdatas]));
            return true;
        }
        else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' =>'Data Not Found!']));
        }
    }


 /**
     * term_conditions using this function get Term Condition!
     *
     * @return void
     */

 public function settings(){
    $this->output->set_content_type('aplication/json');
    $this->form_validation->set_rules('key','Key','trim|required');
    if ($this->form_validation->run() === false) {
        $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
        return false;
    }
    $key = $this->security->xss_clean($this->input->post('key'));
    
    $term = $this->Api_model->get_term($key);
    $term_conditions = array();
    $i = 0; 
    foreach($term as $termdata){
        $term_conditions[$i]['content_name'] = $termdata['content_name'];
        $term_conditions[$i]['content_title'] = $termdata['content_title'];
        $term_conditions[$i]['content_description'] = strip_tags($termdata['content_description']);
        $i++;
    }
    if(!empty($term_conditions)){
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data loaded!', 'data' =>$term_conditions]));
        return true;
    }
    else{
        $this->output->set_output(json_encode(['result' => -1, 'msg' =>'Data Not Found!']));
    }


}

     /**
     * Logout  using this function logout!
     *
     * @return void
     */

     public function logout(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('user_id','User ID','trim|required');
        if($this->form_validation->run()=== FALSE){
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $user_id = $this->security->xss_clean($this->input->post('user_id'));
        $results = $this->Api_model->logout($user_id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Logout Successfully!','data' => 'Logout Successfully']));
            return TRUE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Logout Not Successfully!']));
            return FALSE;
        }

    }

      /**
     * banner image  using this function Banner Image!
     *
     * @return void
     */
      public function banner_image(){
        $this->output->set_content_type('application/json');
        $results = $this->Api_model->banner_image();

        if (!empty($results)) {
            $result = array();
            $i = 0;
            foreach($results as $bannerdata){
                $result[$i]['id'] = $bannerdata['id'];
                $result[$i]['image_url'] =  base_url('uploads/main-banner-images/' . $bannerdata['image_url']);
                $i++;
            }
            
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Banner Data!', 'data' => $result]));
            return true;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found!', 'data' => 'Data Not Found!']));
            return false;

        }

    }

       /**
     * Category    using this function CAtegory Get!
     *
     * @return void
     */

       public function category(){
        $this->output->set_content_type('application/json');
        $data['category'] = $result = $this->Api_model->category();
        $i =0;
        foreach($data['category'] as $categors){
            $result[$i]['icon_url'] = base_url('uploads/category-icon/' . $categors['icon_url']);
            $i++;
        }
        $data['category'] = $result;
        if (!empty($data['category'])) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Data!', 'data' => $data['category']]));
            return true;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found!!', 'data' => 'Data Not Found!']));
            return false;

        }

    }

       /**
     * Sub Category using this function  Get Sub Category!
     *
     * @return void
     */
       public function sub_category(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_id','Category ID','trim|required');
        if($this->form_validation->run()=== FALSE){
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $category_id = $this->security->xss_clean($this->input->post('category_id'));
        $banner_images = $result = $this->Api_model->get_category_banner($category_id);
        $subcategorys = $this->Api_model->sub_category($category_id);
        //print_r($subcategorys);die;
        if(!empty($banner_images)){
            $i = 0;
            $banners = array();
            foreach($banner_images as $banner_image){
                if(!empty($banner_image['image_url'])){
                    $banners[$i]['image_url'] = base_url('uploads/category-banner-images/' . $banner_image['image_url']);    
                }else{
                    $banners[$i]['image_url'] ='';
                }
                
                $i++;
            }
        }
        $subcategory_list = array();
        if(!empty($subcategorys)){
            $i = 0;
            
            foreach($subcategorys as $subcategory){
                $subcategory_list[$i]['category_id'] = $subcategory['category_id'];
                $subcategory_list[$i]['subcategory_id'] = $subcategory['id'];
                $subcategory_list[$i]['subcategory_name'] = $subcategory['subcategory_name'];
                if(!empty($subcategory['icon_url'])){
                 $subcategory_list[$i]['icon_url'] = base_url('uploads/sub-category-icon/' . $subcategory['icon_url']);
             }else{
                $subcategory_list['icon_url'] = '';
            }
            $i++;
        }
    }
    
    
    if(!empty($subcategory_list || $banners)){
            // $result =array_merge($banners,$subcategory_list);
        $result = array('banners'=>$banners, 'sub_categorys'=>$subcategory_list);
    }
    
    if (!empty($result)) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data loaded!', 'data' => $result]));
        return true;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found!', 'data' => 'Data Not Found!']));
        return false;

    }
    

}

      /**
     * add_review  using this function  Add product Review!
     *
     * @return void
     */

      public function add_review(){
        $this->output->set_content_type('aplication/json');
        $results = $this->Api_model->addReview();
        if ($results) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Thank you so much. Your review have been saved']));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something went wrong! Review did not save.']));
        }
        return FALSE;
    }

 /**
     * add address  using this function  add Address!
     *
     * @return void
     */
 public function addNewAddress() {
    $this->output->set_content_type('application/json');
    $user_id = $this->input->post('user_id');
    $address_id = $this->input->post('address_id');
    $type = $this->input->post('type');
    $address = $this->Api_model->check_address($user_id,$address_id,$type);
    if(!empty($address > 0)){
       $results = $this->Api_model->updateAddress($user_id,$address['address_id'],$type);
       if (!empty($results)) {
           $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Address successfully updated', 'data'=>$results]));
           return true;
       } else {
         $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Address did not successfully updated.']));
         return false;
     }
 }
 else{
     $results = $this->Api_model->addNewAddress($user_id);
     if (!empty($results)) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Address Add Successfully','data' =>$results]));
        return false;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Address not add']));
        return false;
    }
} 
}

   /**
     *  addressList   using this function  det User Address List!
     *
     * @return void
     */
   
   
   public function addressList() {
    $this->output->set_content_type('application/json');
    $user_id = $this->input->post('user_id');
    $result = $this->Api_model->addressList($user_id);
    $address = array();
    $i = 0; 
    foreach($result as $results){
     $address[$i]['address_id']     = $results['address_id'];
     $address[$i]['user_id']        = $results['user_id'];
     $address[$i]['user_name']      = $results['user_name'];
     $address[$i]['address_line_1'] = $results['address_line_1'];
     $address[$i]['address_line_2'] = $results['address_line_2'];
     $address[$i]['state']          = $results['state'];
     $address[$i]['city']           = $results['city'];
     $address[$i]['lat']            = $results['lat'];
     $address[$i]['long']           = $results['long'];
     $address[$i]['type']           = $results['type'];
     $i++;
 }
 if ($address) {
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Address List','data' =>$address]));
    return FALSE;
} else {
    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Address not Found']));
    return FALSE;
}
}


  /**
     *  deleteAddress  using this function  delete Address!
     *
     * @return void
     */

  public function deleteAddress() {
    $this->output->set_content_type('application/json');
    $user_id = $this->input->post('user_id');
    $address_id = $this->input->post('address_id');
    $result = $this->Api_model->deleteAddress($user_id,$address_id);
    if ($result) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Address deleted Successfully!']));
        return FALSE;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Address not deleted']));
        return FALSE;
    }
}

     /**
     * getAllNotifications  using this function  get all user notification!
     *
     * @return void
     */
     public function getAllNotifications() {
        $this->output->set_content_type('application/json');
        $user_id = $this->input->post('user_id');
        $results = $this->Api_model->getAllNotification($user_id);
        if ($results) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'All Notifications', 'data' => $results]));
            return false;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Notification Available']));
            return false;
        }
    }
    
      /**
     * service_charge  using this function  get service charge!
     *
     * @return void
     */

      public function service_charge(){
        $this->output->set_content_type('aplication/json');
        $results = $this->Api_model->service_charge();
        if ($results) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service and Tax charge','data' => $results]));
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something went wrong!Data not Found.']));
        }
        return FALSE;
    }
    
     /**
     * time_slot  using this function  get delivery time!
     *
     * @return void
     */

  public function time_slot(){
        $this->output->set_content_type('aplication/json');
        $curr_date = $this->input->post('selected_date');
        $currentDateTimes = date("Y-m-d");
        if($curr_date == $currentDateTimes){
           date_default_timezone_set('Asia/Kolkata');
           $currentDateTime = date("Y-m-d H:i:s");
           $newDateTime = date('H:i', strtotime($currentDateTime));
           $timestamp = strtotime($newDateTime) + 60*60;
           $times = date('H:i', $timestamp);
           $results = $this->Api_model->time_slot();
           $booking_slot = array();
           foreach($results as $result){
            if($result['start_time'] >= $times)
            {
              $booking_slot[] = $result['start_time'];
             }
           }
      $time = array();
      $i = 0;
      foreach($booking_slot as $result){
        $time[$i]['time'] = date('h:ia', strtotime($result)); 
        $i ++;
           }
        }
     if($curr_date !== $currentDateTimes){
         $results = $this->Api_model->time_slot();
         $time = array();
         $i = 0;
        foreach($results as $result){
        $time[$i]['time'] = date('h:ia', strtotime($result['start_time'])); 
        $i ++;
        }
    }
   if(!empty($time)){
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service Delivery Time','data' => $time]));
    } else {
    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Service Delivery Time slot Found','data'=>'']));
  }
   return FALSE;
}
    
    
     /**
     * getServices    using this function Service Get!
     *
     * @return void
     */

     public function getServices(){
        $this->output->set_content_type('application/json');
        $subcategory_id = $this->input->post('subcategory_id');
        $results = $this->Api_model->getServices($subcategory_id);
        $service = array();
        $i = 0;
        foreach ($results as $services ) {
          $service[$i]['service_id']   = $services['service_id'];
          $service[$i]['category_id']   = $services['category_id'];
          $service[$i]['subcategory_id']   = $services['subcategory_id'];
          $service[$i]['service_title']   = $services['service_title'];
          $service[$i]['price']   = $services['price'];
          $service[$i]['icon_url']   = base_url('uploads/service-icon/' . $services['icon_url']);
          $i ++;
      }

      if (!empty($service)) {
          $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service Data!', 'data' => $service]));
          return true;
      } else {
          $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found!!', 'data' => 'Data Not Found!']));
          return false;

      }

  }
  
       /**
     * ServicesData    using this function Service  all data with banner !
     *
     * @return void
     */
       
       public function service_data(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('service_id','Service ID','trim|required');
        if($this->form_validation->run()=== FALSE){
          $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
          return FALSE;
      }
      $service_id = $this->security->xss_clean($this->input->post('service_id'));
      $banner_images = $this->Api_model->get_service_banner($service_id);
      $services = $this->Api_model->service_data($service_id);
      $ratings = $this->Api_model->getAverageRating($service_id);
      $total_rating = $this->Api_model->totalRating($service_id);
      $rating = round($ratings['rating']);
      if(!empty($banner_images)){
          $i = 0;
          $banners = array();
          foreach($banner_images as $banner_image){
            if(!empty($banner_image['image_url'])){
              $banners[$i]['image_url'] = base_url('uploads/service-banner-images/' . $banner_image['image_url']);    
          }else{
              $banners[$i]['image_url'] = '';
          }

          $i++;
      }
  }

  if(!empty($services)){
   
      $services_list = array();
      $i = 0;
      foreach($services as $service){
        $services_list[$i]['service_id'] = $service['service_id'];
        $services_list[$i]['category_id'] = $service['category_id'];
        $services_list[$i]['subcategory_id'] = $service['subcategory_id'];
        $services_list[$i]['title'] = $service['service_title'];
        $services_list[$i]['price'] = $service['price'];
        $services_list[$i]['time'] = $service['time'];
        $services_list[$i]['description'] = $service['description'];
        if(!empty($service['icon_url'])){
           $services_list[$i]['icon_url'] = base_url('uploads/sub-category-icon/' . $service['icon_url']);
       }else{
        $services_list[$i]['icon_url'] = '';
    }
    $i++;
}
}
if(!empty($services_list || $banners)){
            // $result =array_merge($banners,$subcategory_list);
    $result = array('banners'=>$banners, 'secvices'=>$services_list, 'averageRating'=>$rating, 'totalRating' =>$total_rating);
}
if (!empty($result)) {
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data loaded!', 'data' => $result]));
    return true;
} else {
    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found!', 'data' => 'Data Not Found!']));
    return false;

}
}

/* recommended function use to get recommende service */
public function recommended(){
    $this->output->set_content_type('aplication/json');
    $services = $this->Api_model->recommended();
    $recommended_services = array();
    $i = 0; 
    foreach($services as $service){
        $recommended_services[$i]['service_id'] = $service['service_id'];
        $recommended_services[$i]['category_id'] = $service['category_id'];
        $recommended_services[$i]['subcategory_id'] = $service['subcategory_id'];
        $recommended_services[$i]['title'] = $service['service_title'];
        $recommended_services[$i]['description'] = $service['description'];
        if(!empty($service['icon_url'])){
           $recommended_services[$i]['icon_url'] = base_url('uploads/service-icon/' . $service['icon_url']);
       }else{
        $recommended_services[$i]['icon_url'] = '';
    }
    $i++;
}
if(!empty($recommended_services)){
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data loaded!', 'data' =>$recommended_services]));
    return true;
}
else{
    $this->output->set_output(json_encode(['result' => -1, 'msg' =>'Data Not Found!']));
}
}

/* getReview function used to get total review*/

public function getReview(){
    $this->output->set_content_type('aplication/json');
    $service_id = $this->security->xss_clean($this->input->post('service_id'));
    $services_review = $this->Api_model->getReview($service_id);
    $servicesreview = array();
    $i = 0; 
    foreach($services_review as $review){
        $servicesreview[$i]['service_id'] = $review['service_id'];
        $servicesreview[$i]['review'] = $review['review'];
        $servicesreview[$i]['rating'] = $review['rating'];
            //$servicesreview[$i]['created_at'] = $review['created_at'];;
        $servicesreview[$i]['user_name'] = $review['user_name'];
        if(!empty($review['created_at'])){
            $date = $review['created_at'];
            $servicesreview[$i]['created_at'] = date('d F Y', strtotime($date));
            
        }else{
            $servicesreview[$i]['created_at'] = '';
        }
        if(!empty($review['profile_url'])){
           $servicesreview[$i]['profile_image'] = base_url('uploads/users-profile/' . $review['profile_url']);
       }else{
        $servicesreview[$i]['profile_image'] = '';
    }
    $i++;
}
if(!empty($servicesreview)){
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data loaded!', 'data' =>$servicesreview]));
    return true;
}
else{
    $this->output->set_output(json_encode(['result' => -1, 'msg' =>'Data Not Found!']));
}
}

/* cart_details function use to book services */
public function cart_details(){
    $this->output->set_content_type('application/json');
    $service_tax = $this->input->post('service_tax');
    $convenience_charge = $this->input->post('convenience_charge');
    $service_id = $this->input->post('service_id');
    $sevice = str_replace('[','', $service_id);
    $sevices_id = str_replace(']','', $sevice);

    $service_ids = explode(',', $sevices_id);
    $quantity = $this->input->post('quantity');
    $quantitys = str_replace('[','', $quantity);
    $quantityss = str_replace(']','', $quantitys);
    $quantityes = explode(',', $quantityss);
    $data = array();
    $i = 0;
    foreach ($service_ids as $service) {
        $data[$i] = array(
            'service_id' => $service,
            'quantity' => $quantityes[$i],
        );
        $i++;
    }
    $arr = array();
    $i =0;$total_price =0;
    foreach ($data as $cart){
       $results = $this->Api_model->cart_details($cart['service_id']);
       
       if($results){

        $arr[$i] = $results;
        $arr[$i]['prices'] = $cart['quantity']*$arr[$i]['price'];
        if(!empty($results['icon_url'])){
           $arr[$i]['icon_url'] = base_url('uploads/service-icon/' . $results['icon_url']);
       }else{
        $arr[$i]['icon_url'] = '';
    }
    $total_price += $arr[$i]['prices'];
    $i++;
}
}

$services_tax = round($service_tax*$total_price/100);

$paybel_amount =$total_price +$convenience_charge +$services_tax;

if(!empty($service_tax || $total_price || $arr)){
            // $result =array_merge($banners,$subcategory_list);
    $result = array('convenience_charge'=>$convenience_charge, 'total_amount'=>$total_price,'payable_amount'=>$paybel_amount, 'service_tax'=>$services_tax,'service_data'=>$arr);
}
if (!empty($result)) {
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data loaded!', 'data' => $result]));
    return true;
} else {
    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found!', 'data' => 'Data Not Found!']));
    return false;

}
}


/* order add */
public function Booking(){
    $this->output->set_content_type('application/json');
    $user_id            = $this->input->post('user_id');
    $service_tax        = $this->input->post('service_tax');
    $convenience_charge = $this->input->post('convenience_charge');
    $total_amount = $this->security->xss_clean($this->input->post('total_amount'));
    $paybal_amount =$this->security->xss_clean($this->input->post('paybel_amount'));
    $service_date = $this->input->post('service_date');
    $service_time = $this->input->post('service_time');
    $order_type = $this->input->post('order_type');
    $service_id  = $this->input->post('service_id');
    $sevice = str_replace('[','', $service_id);
    $sevices_id = str_replace(']','', $sevice);
    $service_ids = explode(',', $sevices_id);

    $quantity = $this->input->post('quantity');
    $quantitys = str_replace('[','', $quantity);
    $quantityss = str_replace(']','', $quantitys);
    $quantityes = explode(',', $quantityss);
    $order = array();
    $i = 0;
    foreach ($service_ids as $service) {
        $order[$i] = array(
            'service_id' => $service,
            'quantity' => $quantityes[$i],
        );
        $i++;
    }
    $order_unique_id = $this->uniqueId();
    $results = $this->Api_model->booking($order_unique_id);
    $booking = $this->bookingOrder($order);
    foreach ($booking as $bookingdata) {
        $result = $this->Api_model->addBooking($bookingdata['service_id'],$bookingdata['quantity'],$bookingdata['price'],$results['booking_id']);

        
    }
    if (!empty($result)) {
        $this->sendOrderMail($user_id,$order,$results);
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Order Placed Successfully!', 'data'=>$results['booking_id']]));
        return true;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found!', 'data' => 'Data Not Found!']));
        return false;

    }
    
}
public function bookingOrder($order){
   $bookings = array();
   $i = 0;
   foreach ($order as $booking) {
       $data = $this->Api_model->getServicePrice($booking['service_id']);
       if($data){
         $bookings[$i]['service_id'] = $data['service_id'];
         $bookings[$i]['price'] = $data['price'];
         $bookings[$i]['quantity'] = $booking['quantity'];
     }
     else{
        $bookings[$i]['service_id'] = '';
        $bookings[$i]['price'] = '';
        $bookings[$i]['quantity'] = '';
    }
    $i ++;
}
return $bookings;
}
public function sendOrderMail($user_id,$order,$results) {
    $this->load->library('email');
    $bookings = array();
    $i = 0;
    foreach ($order as $booking) {
       $data = $this->Api_model->getServicePrice($booking['service_id']);
       if($data){
         $bookings[$i]['service_id'] = $data['service_id'];
         $bookings[$i]['service_title'] = $data['service_title'];
         $bookings[$i]['price'] = $data['price'];
         $bookings[$i]['quantity'] = $booking['quantity'];
         $bookings[$i]['icon_url'] = $data['icon_url'];
     }
     else{
        $bookings[$i]['service_id'] = '';
        $bookings[$i]['price'] = '';
        $bookings[$i]['quantity'] = '';
    }
    $i ++;
}
$data['user'] = $this->Api_model->get_userdata($user_id);
$data['services'] = $bookings;
$data['order'] = $results;
//print_r($data['order']);die;


$htmlContent = $this->load->view('web/email/order-confirmation-mail', $data, TRUE);
$from = "info@hammerandspanner.in";
$to = $data['user']['email'];
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' . $from . "\r\n";
$subject = "Order Placed Sucessfully.";
mail($to, $subject, $htmlContent, $headers);
return true;
}
/* booking success details */


public function getServiceBookingData(){
    $this->output->set_content_type('application/json');
    $user_id = $this->input->post('user_id');
    $booking_id = $this->input->post('booking_id');
    $results = $this->Api_model->getbookingdata($user_id,$booking_id);
    $service_time = $this->Api_model->getbookingdataTime($user_id,$booking_id);
     $time = array();
        foreach($service_time as $services){
            
            $time['service_time'] = date('h:ia', strtotime($services['service_time'])); 
            $time['service_date'] = $services['service_date']; 
            $time['booking_id'] = $services['booking_id']; 
        }

    $data['booking_details'] = $result = $this->Api_model->getServiceBookingDetailByBookingId($user_id,$booking_id);
    $i = 0;
    foreach ($data['booking_details'] as $booking) {
        $res = $this->Api_model->servicesdata($booking['service_id']);

        if ($res) {
            $result[$i]['service_title'] = $res['service_title'];
            $result[$i]['icon_url'] = base_url('uploads/service-icon/' . $res['icon_url']);
        } else {
            $result[$i]['teammember'] = "";
        }
        $i++;
    } 
    $data['booking_details'] = $result;
    $address = $this->Api_model->getAddress($data['booking_details'][0]['address_id']);
    $data['service']  = $this->Api_model->getServicedata($booking_id);
    $j = 0;

    foreach($data['service'] as $service){
        $categoryname = $this->Api_model->getCategoryName($service['service_id']);
        if ($categoryname) {
            $category[$j] = $categoryname['category_name'];
        } else {
            $result[$j]['category_name'] = "";
        }
        $j++;
    }
    $data['service'] = $category;
    $category_name = implode(', ' ,array_unique($data['service']));
    $servicecategoryname = "Your ". $category_name .  " service is successfully Schedule";
    $invoice =  base_url('Orders/invoice/' . $booking_id . '/' .$results['order_id']);


    if(!empty($time || $results || $data['booking_details'] || $address || $invoice || $servicecategoryname)){
            // $result =array_merge($banners,$subcategory_list);
        $result = array('service_timing'=>$time, 'total_price'=>$results, 'booking_details'=>$data['booking_details'], 'address'=>$address, 'invoice'=>$invoice, 'bookingsuccess' =>$servicecategoryname);
    }
    if (!empty($result)) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'An Email confirmation has been sent to your account
            !', 'data' => $result]));
        return true;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found!', 'data' => 'Data Not Found!']));
        return false;

    }


}
/* bookingrRschdule function use for reschdule user booking */

public function bookingrRschdule() {
    $this->output->set_content_type('application/json');
    $user_id = $this->input->post('user_id');
    $booking_id = $this->input->post('booking_id');
    $result = $this->Api_model->Bookingreschdule($booking_id,$user_id);
    
    if(!empty($result)) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service Reschdule Scccessfully!', 'data' =>$result]));
        return true;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Service Not Reschdule Scccessfully']));
        return false;

    }
}

/* cancel user order*/

public function cancelOrder() {
    $this->output->set_content_type('application/json');
    $user_id = $this->input->post('user_id');
    $booking_id = $this->input->post('booking_id');
    $this->Api_model->changeAllOrderStatus($booking_id);
    $result = $this->Api_model->cancelFullOrder($user_id,$booking_id);
    if (!empty($result)) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service Cancel Scccessfully!', 'data'=>$result]));
        return true;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Service Not Cancel Scccessfully', 'data' => 'Data Not Found!']));
        return false;

    }
}


/* get user service */
public function userServiceDetails() {
    $this->output->set_content_type('application/json');
    $user_id = $this->input->post('user_id');
    $services = $this->input->post('key');
    if($services == 'ongoing'){
       $data['ongoingService'] = $result = $this->Api_model->ongoingService($user_id);

   }
   if($services == 'past'){ 
       $data['ongoingService'] = $result = $this->Api_model->rescheduleService($user_id);
             //print_r($data['ongoingService']);die;

   }
   $i = 0;
   foreach ($data['ongoingService'] as $service) {
    $result[$i]['service_time'] =date('h:ia', strtotime($service['service_time']));
    
    
    $services = $this->Api_model->getSubcategoryImg($service['service_id']);
    
    if($service){
     $result[$i]['icon_url'] =  base_url('uploads/sub-category-icon/' . $services['icon_url']);
 } 
 else {
    
 }
 $i++;
}
$data['ongoingService'] = $result;
if (!empty($data['ongoingService'])) {
        //$this->sendOrderMail($user_id,$booking,$convenience_charge,$service_tax,$service_time,$service_date);
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Ongoing or Schdule Services!', 'dat'=>$data['ongoingService']]));
    return true;
} else {
    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No service Found', 'data' => 'Data Not Found!']));
    return false;

}
}

public function getServiceBookingDetailByBookingId(){
    $this->output->set_content_type('application/json');
    $user_id = $this->input->post('user_id');
    $booking_id = $this->input->post('booking_id');
    $results = $this->Api_model->getbookingdata($user_id,$booking_id);
    $service_time = $this->Api_model->getbookingdataTime($user_id,$booking_id);
    $time = array();
        foreach($service_time as $services){
            
            $time['service_time'] = date('h:ia', strtotime($services['service_time'])); 
            $time['service_date'] = $services['service_date']; 
            $time['booking_id'] = $services['booking_id']; 
        }

    $data['booking_details'] = $result = $this->Api_model->getServiceBookingDetailByBookingId($user_id,$booking_id);
    $i = 0;
    foreach ($data['booking_details'] as $booking) {
        $res = $this->Api_model->servicesdata($booking['service_id']);

        if ($res) {
            $result[$i]['service_title'] = $res['service_title'];
            $result[$i]['icon_url'] = base_url('uploads/service-icon/' . $res['icon_url']);
        } else {
            $result[$i]['teammember'] = "";
        }
        $i++;
    }
    $data['booking_details'] = $result;
    $address = $this->Api_model->getAddress($data['booking_details'][0]['address_id']);
    $SubcategoryImg = $this->Api_model->getSubcategoryImg($data['booking_details'][0]['service_id']);
    $SubcategoryIcan =  base_url('uploads/sub-category-icon/' . $SubcategoryImg['icon_url']);
    $invoice =  base_url('Orders/invoice/' . $booking_id . '/' .$results['order_id']);


    if(!empty($time || $results || $data['booking_details'] || $address || $SubcategoryIcan ||$invoice)){
            // $result =array_merge($banners,$subcategory_list);
        $result = array('service_timing'=>$time, 'total_price'=>$results, 'booking_details'=>$data['booking_details'], 'address'=>$address, 'Sub_categoryImage'=>$SubcategoryIcan, 'invoice' =>$invoice);
    }
    if (!empty($result)) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Data loaded!', 'data' => $result]));
        return true;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Data Not Found!', 'data' => 'Data Not Found!']));
        return false;

    }


}

/*chat message */

public function insertChat() {
    $this->output->set_content_type('application/json');
    $sender_id = $this->input->post('sender_id');
    $reciever_id = $this->input->post('reciever_id');
    $message = $this->input->post('message');
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    $time  = date('H:i');
    $result_sender = $this->Api_model->checkSenderToReceiver($sender_id, $reciever_id);
    $result_receiver = $this->Api_model->checkReceiverToSender($sender_id, $reciever_id);

    if ($result_sender || $result_receiver) {
        $id = '';
        if (!empty($result_sender)) {
            $id = $result_sender['id'];
        }
        if (!empty($result_receiver)) {
            $id = $result_receiver['id'];
        }
        $result = $this->Api_model->updatechatlist($id, $message, $time, $date);
    } else {
        $result = $this->Api_model->insertchatList($sender_id, $reciever_id, $message, $time, $date);
    }
    if ($result) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Inserted Successfully']));
    } else {
        $this->output->set_output(json_encode(['result' => 0, 'msg' => 'Not Inserted Successfully']));
    }
}

public function chatList() {
    $this->output->set_content_type('application/json');
    $user_id = $this->input->post('user_id');
    $results = $this->Api_model->chatList($user_id);
    if ($results) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Chat List', 'chat_list' => $results]));
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No chat were found']));
    }
    return FALSE;
}

public function rebooking(){
    $this->output->set_content_type('application/json');
    $user_id = $this->input->post('user_id');
    $booking_id = $this->input->post('booking_id');
    $service_time = $this->input->post('service_time');
    $service_date = $this->input->post('service_date');
    $order_type = $this->input->post('order_type');
    $result = $this->Api_model->rebooking($user_id,$booking_id);
    $booking = array();
    $i = 0;
    foreach($result as $bookdata){
        $booking[$i]['transaction_id']           = $bookdata['transaction_id'];
        $booking[$i]['user_id']           = $bookdata['user_id'];
        $booking[$i]['address_id']        = $bookdata['address_id'];
        $booking[$i]['total_amount']      = $bookdata['total_amount'];
        $booking[$i]['payable_amount']      = $bookdata['payable_amount'];
        $booking[$i]['service_tax']        = $bookdata['service_tax'];
        $booking[$i]['convenience_charge'] = $bookdata['convenience_charge'];
        $booking[$i]['order_type']          = $order_type;
        $booking[$i]['service_time']        = $service_time;
        $booking[$i]['service_date']        = $service_date;

    } 
    $order_unique_id = $this->uniqueId();
    $bookings = $this->Api_model->insertBooking($booking,$order_unique_id);
    $bookingdata = $this->Api_model->getbookingdataById($booking_id);
    foreach ($bookingdata as $booking) {
     $result = $this->Api_model->insertrebookingData($booking['service_id'],$booking['quantity'],$booking['price'],$bookings['booking_id']);
 }
 $order =  $this->Api_model->getbookingdataById($bookings['booking_id']); 
 if (!empty($result)) {
     $this->sendreOrderMail($order,$bookings);
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Booking Successfully Placed!','data'=>$bookings['booking_id']]));
    return true;
} else {
    $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong Booking not Placed']));
    return false;
}

}

public function sendreOrderMail($order,$results) {
    $this->load->library('email');
    $bookings = array();
    $i = 0;
    foreach ($order as $booking) {
       $data = $this->Api_model->getServicePrice($booking['service_id']);
       if($data){
         $bookings[$i]['service_id'] = $data['service_id'];
         $bookings[$i]['service_title'] = $data['service_title'];
         $bookings[$i]['price'] = $data['price'];
         $bookings[$i]['quantity'] = $booking['quantity'];
         $bookings[$i]['icon_url'] = $data['icon_url'];
     }
     else{
        $bookings[$i]['service_id'] = '';
        $bookings[$i]['price'] = '';
        $bookings[$i]['quantity'] = '';
    }
    $i ++;
}
$data['user'] = $this->Api_model->get_userdata($results['user_id']);
$data['services'] = $bookings;
$data['order'] = $results;
$htmlContent = $this->load->view('web/email/order-confirmation-mail', $data, TRUE);
$from = "info@hammerandspanner.in";
$to = $data['user']['email'];
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' . $from . "\r\n";
$subject = "Order Placed Sucessfully.";
mail($to, $subject, $htmlContent, $headers);
return true;
}

public function socialLogin() {
    $this->output->set_content_type('application/json');
    $this->form_validation->set_rules('user_name','User Name','trim|required');
    $this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
    $this->form_validation->set_rules('source', 'Source', 'trim|required');
    if ($this->form_validation->run() === false) {
        $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
        return false;
    }
    $results = $this->Api_model->sociallogin();
    if($results){
        if(!empty($results['profile_image'])){
            $results['profile_image'] = base_url('uploads/users-profile/' . $results['profile_image']);

        }
        else{
            $results['profile_image'] = '';
        }
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login successfully!', 'data' => $results]));
        return true;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid credentials!!']));
        return false;

    }
}

/* serch services */
public function search() {
    $this->output->set_content_type('application/json');
    $search = $this->input->post('search_value');
    $resultServices = $this->Api_model->doSearchServices($search);
    $list = [];
    $i = 0;

    foreach ($resultServices as $resultService) {
       $list[$i]['service_id'] = $resultService['service_id'];
       $list[$i]['service_title'] =  $resultService['service_title'];
       $list[$i]['price'] = $resultService['price'];
       $list[$i]['time'] = $resultService['time'];
       $list[$i]['description'] = $resultService['description'];
       $list[$i]['icon_url'] = base_url('uploads/service-icon/' . $resultService['icon_url']);
           // $list[$i] = $this->placeImage($resultService);
       $i++;
       }
       if ($list) {
              $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Search result', 'data' => $list]));
              return FALSE;
           } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Result Not Found']));
             return FALSE;
          } 
    }
    
    public function getServiceProvider() {
    $this->output->set_content_type('application/json');
    $booking_id = $this->input->post('booking_id');
    $data['service'] = $result = $this->Api_model->getServiceProvider($booking_id);
    $i = 0;
    foreach($data['service'] as $resultdata){
         $results = $this->Api_model->getserviceproviderdetail($resultdata['service_provider_id']);
         
         if (!empty($results)) {
                $result[$i]['name'] = $results['name'];
                $result[$i]['email'] = $results['email'];
                $result[$i]['phone_number'] = $results['phone_number'];
                $result[$i]['profile_url'] =  base_url('uploads/service-provider-profile/' . $results['profile_url']);
            } else {
                $result[$i]['name'] = "";
                $result[$i]['email'] = "";
                $result[$i]['phone_number'] = "";
                $result[$i]['profile_url'] = "";
            }
            $i++;
        }
        $data['service'] = $result;
    
    if(!empty($data['service'])) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service Provider Details!', 'data' =>$data['service']]));
        return true;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Service Provider Assing to Services']));
        return false;

    }
   } 
   public function bookingstatuschange(){
    $this->output->set_content_type('application/json');
    $this->form_validation->set_rules('servicebooking_id','Service Booking Id','trim|required');
    $this->form_validation->set_rules('status','Status','trim|required');
    if ($this->form_validation->run() === false) {
        $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
        return false;
    }
    $id = $this->input->post('servicebooking_id');
    $status = $this->input->post('status');
    $result = $this->Api_model->changeServiceStatus($id,$status);
     if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service Cancelled Successfully.']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Service not Cancelled']));
            return FALSE;
        }

}
   } 














