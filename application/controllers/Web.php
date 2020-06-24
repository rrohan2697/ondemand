<?php 
/**
 * Description of Web Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') OR die('Not Allowed');

class Web extends CI_Controller {

    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        
        parent::__construct();
        $this->load->model(['Web_model']);
        $this->load->model(['Web_users_model']);
        date_default_timezone_set('Asia/Kolkata');
    }
    
    public function getUserById(){
        if (!empty($this->session->userdata('user_id'))) {
                $id = $this->session->userdata('user_id');
//              echo $id;die;
                $data = $this->Web_users_model->getDataById($id);
//            print_r($data);die;
                return $data;
            }
        
    }
    
    public function index(){
        $data['title'] = 'Home';
        $data['banners'] = $this->Web_model->get_banners_images();
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['user'] = $this->getUserById();
        $user_id = $data['user']['id'];
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['getRandomServices'] = $this->Web_model->getRandomServices();
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        // print_r($data['socialLinks']);die;
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/index');
        $this->load->view('web/common-pages/footer');
    }
    
    public function getDateData(){
        $cur_date = date('Ymd');
        $date = $this->input->post('date');
        $date = date('Ymd', strtotime($date));
        // echo $date;
        // echo $cur_date;die;
        if($cur_date == $date){
            echo "true";
        }
    }

    public function about_us(){
        $data['title'] = 'About-us';
        $type = 1;
        $data['user'] = $this->getUserById();
        $user_id = $data['user']['id'];
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['about'] = $this->Web_model->get_setting_data($type);
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/about-us');
        $this->load->view('web/common-pages/footer');
    }

    public function terms_and_conditions(){
        $data['title'] = 'Terms and Conditions';
        $type = 2;
        $data['user'] = $this->getUserById();
        $user_id = $data['user']['id'];
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['terms'] = $this->Web_model->get_setting_data($type);
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/terms-conditions');
        $this->load->view('web/common-pages/footer');
    }

    public function faqs(){
        $data['title'] = 'FAQ\'s';
        $data['user'] = $this->getUserById();
        $user_id = $data['user']['id'];
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['faqs'] = $this->Web_model->get_faqs();
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/faqs');
        $this->load->view('web/common-pages/footer');
    }
    
    public function privacy(){
       $data['title'] = 'Privacy Policy';
       $type = 3;
        $data['user'] = $this->getUserById();
        $user_id = $data['user']['id'];
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['privacy'] = $this->Web_model->get_setting_data($type);
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/privacy');
        $this->load->view('web/common-pages/footer'); 
        
    }
    
    public function contactUs(){
         $data['title'] = 'Contact Us';
        $data['user'] = $this->getUserById();
        $user_id = $data['user']['id'];
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/contact_us');
        $this->load->view('web/common-pages/footer');
        
    }
    
    public function doAddContactUs(){
        $this->output->set_content_type('application/json');
      $this->form_validation->set_rules('name', ' Name', 'trim|required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('phone', 'Phone Number', 'required');
      $this->form_validation->set_rules('text', 'Message', 'required');
      
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $result = $this->Web_model->docontactus();
        if($result){
             $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Your Message Sent Succesfully', 'url' =>base_url('/')]));
            return true;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong', 'data' => 'Something Went Wrong']));
            return false; 
        }
    }
    
    public function otp(){
        $mobile = $this->input->post('phone2');
        if (!$mobile) {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Please Enter Mobile Number First']));
            return FALSE;
        } 
    }
    
    public function sendEmail(){
     $this->output->set_content_type('application/json');
      $this->form_validation->set_rules('email', ' Email', 'trim|required');
      if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $emailid = $this->input->post('email');
        $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from('info@ondemand.com');
            $this->email->to($emailid);
            $this->email->subject('Application Link');
            $htmlContent = "<div style='padding-top:8px;'>Hi , <br><br>Thankyou for choosing us!</div>";
            $htmlContent .= "<a href=''>Click Here</a>";
            $this->email->message($htmlContent);
            $send = $this->email->send();
            if ($send) {
                $this->output->set_output(json_encode(['result' => 2, 'url' => base_url('/'), 'msg' => 'Link Sent Successfully']));
                return true;
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Failed to send']));
                return false;
            }
    }
    
    public function sendSms(){
      $this->output->set_content_type('application/json');
      $this->form_validation->set_rules('phone2', ' Phone Number', 'required');
      if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        // // Account details
        $apiKey = urlencode('Sppib4JxAI4-GCBHZg4w0tTuPFmnY0g3P8rDeDsQPR');
        // Message details
        $numbers = $this->input->post('phone2');
        $sender = urlencode('TXTLCL');
        $message = rawurlencode('Welcome to Hammer and Spanner');
        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        // Process your response here
        // echo $response;
        $this->output->set_output(json_encode(['result' => 2, 'url' => base_url('/'), 'msg' => 'Link Sent Successfully']));
        return false;
    }
    
}