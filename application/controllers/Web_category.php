<?php
/**
 * Description of Web_category Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Web_category extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        parent::__construct();
        $this->load->model(['Web_model']);
        $this->load->model(['Web_users_model']);
        // $this->load->model(['Users_model','Admin_model']);
        date_default_timezone_set('Asia/Kolkata');
    }
    
    public function getUserById(){
//        echo 'hi';
//        echo $this->session->userdata('user_id');die;
        
        if (!empty($this->session->userdata('user_id'))) {
                $id = $this->session->userdata('user_id');
                $data = $this->Web_users_model->getDataById($id);
//            print_r($data);die;
                return $data;
            }
        
    }
        
    public function show($category_url){
        $data['title'] = 'Category';
        $data['user'] = $this->getUserById();
        $user_id = $data['user']['id'];
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['category'] = $category = $this->Web_model->get_category_byurl($category_url);
        // print_r($data['category']);die;
        $data['sub_categorys'] = $this->Web_model->get_subcategorys($category['id']);
        $data['categorys_banners'] = $this->Web_model->get_categorys_banners($category['id']);
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/category');
        $this->load->view('web/common-pages/footer');
    }

    public function cart_show($id = null){
        $data['title'] = 'Category';
        if(!empty($id)){
            $data['id'] = $id;
            $data['bookingDetails'] = $this->Web_model->bookingDetails($id);
           $booking_id = $data['bookingDetails']['booking_id'];
           $data['services'] = $this->Web_model->getAllServicesByBookingid($booking_id);
   
        }
        $data['user'] = $this->getUserById();
        $user_id =$data['user']['id'];
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['address'] = $this->Web_model->getAddress($user_id);
        $data['service_charges'] = $this->Web_model->getServiceCharges();
        $data['slots'] = $this->Web_model->getAllSlots();
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/cart-list');
        $this->load->view('web/common-pages/footer');
    }
    
    public function doCategoryFilter($id){
        $this->output->set_content_type('application/json');        
        $data['getServices'] = $this->Web_model->getServicesBySubcategoryId($id);
        $content_wrapper = $this->load->view('web/include/category_wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function serviceDetail($service_id){
       $data['title'] = 'Service Detail';
        $data['user'] = $this->getUserById();
        $user_id = $data['user']['id'];
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['service'] = $this->Web_model->getServiceDetails($service_id);
        // print_r($data['service']);die;
        $data['serviceBanner'] = $this->Web_model->getServiceBanner($service_id);
        $data['getAllReviews'] = $this->Web_model->getAllReviews($service_id);
        // print_r($data['getAllReviews']);die;
        $data['totalReview'] = $this->Web_model->totalReview($service_id);
        $data['averageRating'] = $this->Web_model->averageRating($service_id);
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/service-detail');
        $this->load->view('web/common-pages/footer'); 
    }
    
    public function search(){
        $search = $this->input->post('search');
        $data['search'] = $this->Web_model->getSearchedServices($search);
        $data['title'] = 'Search Results';
        $data['user'] = $this->getUserById();
        $user_id = $data['user']['id'];
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/search');
        $this->load->view('web/common-pages/footer'); 
        
    }
    
    

    
}