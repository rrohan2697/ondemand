<?php
/**
 * Description of Web_booking Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Web_booking extends CI_Controller
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
        if (!empty($this->session->userdata('user_id'))) {
                $id = $this->session->userdata('user_id');
//            echo $id;die;
                $data = $this->Web_users_model->getDataById($id);
                return $data;
            }
        
    }
    
     public function uniqueId() {
        $str = '123456789';
        $nstr = str_shuffle($str);
        $unique_id = substr($nstr, 0, 8);
        return $unique_id;
    }

    public function index(){
        $data['title'] = 'Bookings';
        $data['user'] = $this->getUserById();
        $user_id =$data['user']['id'];
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['getBookings'] = $this->Web_model->getBookings($user_id);
        // print_r($data['getBookings']);die;
        $data['getCancelledBooking'] = $this->Web_model->getCancelledBooking($user_id);
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/booking-list');
        $this->load->view('web/common-pages/footer');
    }

    public function ongoing($id){
        $data['title'] = 'Bookings';
        $data['user'] = $this->getUserById();
        $user_id =$data['user']['id'];
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['bookingDetails'] = $this->Web_model->bookingDetails($id);
        $booking_id = $data['bookingDetails']['booking_id'];
        $data['services'] = $this->Web_model->getAllOngoingServices($booking_id);
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        // echo '<pre>';print_r($data['services']);die;
        $i=0;
        foreach($data['services'] as $ser){
            if(!empty($ser['service_provider_id'])){
                $provider = $this->Web_model->getServiceprovider($ser['service_provider_id']);
                if(!empty($provider)){
                    $data['services'][$i]['provider_name'] = $provider['name']; 
                    $data['services'][$i]['provider_no'] = $provider['phone_number']; 
                    $data['services'][$i]['provider_image'] = $provider['profile_url']; 
                }
            }
            $i++;
        }
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/ongoing-booking');
        $this->load->view('web/common-pages/footer');
    }
    
    public function cancelService($id){
        
        $this->output->set_content_type('application/json');
        $status = 'Cancelled';
        $result = $this->Web_model->changeServiceStatus($id,$status);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service status changed.', 'url' =>base_url('Web_booking')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Try Again']));
            return FALSE;
        }
        
    }

    public function shedule(){
        $data['title'] = 'Bookings';
        $data['user'] = $this->getUserById();
        $user_id =$data['user']['id'];
        $data['categorys'] = $this->Web_model->get_categorys();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/shedule-booking');
        $this->load->view('web/common-pages/footer');
    }

    public function reshedule($id){
        $data['title'] = 'Bookings';
        $data['user'] = $this->getUserById();
        $user_id =$data['user']['id'];
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['bookingDetails'] = $this->Web_model->bookingDetails($id);
        $booking_id = $data['bookingDetails']['booking_id'];
        $data['services'] = $this->Web_model->getAllServicesByBookingid($booking_id);
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        // echo '<pre>';print_r($data['services']);die;
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/reshedule-booking');
        $this->load->view('web/common-pages/footer');
    }
    
    public function cancelBooking($id){
      $this->output->set_content_type('application/json');
      $result = $this->Web_model->cancelBooking($id);
      if($result){
          $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Booking Cancelled', 'url' =>base_url('Web_booking')]));
      }else{
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong', 'data' => 'Something Went Wrong']));
            return false;  
      }    
    }
    
    public function addToCart($service_id,$service_name,$price,$image){
        $this->output->set_content_type('application/json');
        $data = array(
            'id' => $service_id,
            'name' => str_replace('%20', '-', $service_name),
            'qty' => '1',
            'price' => $price, 
            'image'=>$image
        );
        $cart = $this->cart->insert($data);               
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
    }
    
    public function cartReschedule($booking_id){
       $this->output->set_content_type('application/json');
       $reschedule = $this->Web_model->getAllServicesByBookingid($booking_id);
    //   echo '<pre>';print_r($reschedule);die;
        $i=0;
      foreach($reschedule as $res){
          $data[$i] = array(
             'id' => $res['id'],
            'name' => str_replace('%20', '-', $res['service_title']),
            'qty' => $res['quantity'],
            'price' => $res['price'], 
            'image'=>$res['icon_url'] 
             );
          $i++; 
      }
    
       $cart = $this->cart->insert($data);               
       if($cart){
           return redirect('Web_category/cart_show');
       }    
      }
    
    public function address(){
        $data['title'] = 'Add Address';
        $data['user'] = $this->getUserById();
        $user_id =$data['user']['id']; 
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['address'] = $this->Web_model->getAddress($user_id);
        // $data['addressById'] = $this->Web_model->addressById($id);
        // print_r($data['addressById']);die;
        $data['service_charges'] = $this->Web_model->getServiceCharges();
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/address');
        $this->load->view('web/common-pages/footer');  
    }
    
    public function addressWrapper($id){
        $this->output->set_content_type('application/json');
		$data['address'] = $this->Web_model->addressById($id);
        $content_wrapper = $this->load->view('web/include/address_wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function doAddAddress(){
        $this->output->set_content_type('application/json');
      $this->form_validation->set_rules('name', 'Name', 'trim|required');
      $this->form_validation->set_rules('pincode', 'Pincode', 'required|min_length[6]');
      $this->form_validation->set_rules('city', 'City', 'required');
      $this->form_validation->set_rules('locality', 'Locality', 'required');
      $this->form_validation->set_rules('add1', 'Address Line1', 'required');
      $this->form_validation->set_rules('add2', 'Address Line2', 'required');
      $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $user_id = $this->getUserById()['id'];
        $result = $this->Web_model->doAddAddress($user_id);
        if($result){
            //Finding Lat & Long
            $address = $result['address_line_1'];
            $apiKey = 'AIzaSyBtrnsDJVL7GGGEO0HWX8YEYhdVWTXS0XI';
            $url = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address).'&sensor=false&key='.$apiKey;
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
            $responseJson = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($responseJson);
            if ($response->status == 'OK') {
                $latitude = $response->results[0]->geometry->location->lat;
                $longitude = $response->results[0]->geometry->location->lng;
                $this->Web_model->updateLatLong($latitude,$longitude,$result['address_id']);
            } else {
                echo $response->status;
                var_dump($response);
            } 
            //Finding Lat & Long
             $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Address Added', 'url' =>$_SERVER['HTTP_REFERER']]));
             return true;  
        }else{
           $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong', 'data' => 'Something Went Wrong']));
            return false;
 
        }
        
     }
     
     public function doEditAddress($id){
         $this->output->set_content_type('application/json');
      $this->form_validation->set_rules('edit_name', 'Name', 'trim|required');
      $this->form_validation->set_rules('edit_pincode', 'Pincode', 'required');
      $this->form_validation->set_rules('edit_city', 'City', 'required');
      $this->form_validation->set_rules('edit_locality', 'Locality', 'required');
      $this->form_validation->set_rules('edit_add1', 'Address Line1', 'required');
      $this->form_validation->set_rules('edit_add2', 'Address Line2', 'required');
      $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $result = $this->Web_model->doEditAddress($id);
        if($result){
             $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Address Added', 'url' =>$_SERVER['HTTP_REFERER']]));
            return true;
        }else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong', 'data' => 'Something Went Wrong']));
            return false; 
        }
         
     }
    
    public function removeAddress($id){
      $this->output->set_content_type('application/json');
        $result = $this->Web_model->removeAddress($id);
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Address Added', 'url' =>$_SERVER['HTTP_REFERER']]));
            return true;  
        }else{
           $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong', 'data' => 'Something Went Wrong']));
            return false; 
        }
    }
    
    public function payment($total){
        if(empty($this->session->userdata('booking'))){
            return redirect('/');
        }
       $data['title'] = 'Payment';
        $data['user'] = $this->getUserById();
        $user_id =$data['user']['id']; 
        $data['total'] = $total;
        // print_r($data['total']);die;
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['service_charges'] = $this->Web_model->getServiceCharges();
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/payment');
        $this->load->view('web/common-pages/footer');  
    }
    
    public function razorpay($booking_id){
        $data['booking_id'] = $booking_id;
        $this->load->view('web/razorpay',$data);
    }
    
    public function booking($id = null){
      $this->output->set_content_type('application/json');
      $this->form_validation->set_rules('datepicker', 'Date', 'trim|required');
      $this->form_validation->set_rules('timeOptn', 'Time', 'required');
      $this->form_validation->set_rules('addressid', 'Address', 'required');
      if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $booking_id = $this->uniqueId();
        $date = $this->input->post('datepicker');
        $time = $this->input->post('timeOptn');
        $address_id = $this->input->post('addressid');
        $payble_amt = $this->input->post('total');
        $user_id = $this->getUserById()['id'];
        $service_tax = $this->input->post('service_tax');
        $convenience = $this->input->post('charges');
        $services = $this->input->post('service');
        $prices = $this->input->post('prices');
        $quantity = $this->input->post('quantities');
        if(!empty($id)){
           $total = $this->input->post('total_amount'); 
        }else{
          $total = $this->cart->total();  
        }
        $data = array(
            'booking_id'=>$booking_id,
            'user_id'=>$user_id,
            'address_id'=>$address_id,
            'total_amount'=>$total,
            'service_tax'=>$service_tax,
            'convenience_charge'=>$convenience,
            'status'=>'Ongoing',
            'service_date'=>$date,
            'service_time'=>date('H:i', strtotime($time)),
            'payable_amount'=>$payble_amt
        );
        
        $this->session->set_userdata('order',$data);
            $i=0;
            foreach($services as $service){
              $price = $prices[$i];
              $quan = $quantity[$i];
                $dataOrder[] = array(
                'booking_id'=>$booking_id,    
                'service_id'=>$service,
                'quantity'=>$quan,
                'price'=>$price,
                );   
            $i++;   
            }
        
         
        $this->session->set_userdata('orderDetails',$dataOrder);
        $this->session->set_userdata('booking','booking');
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'ThankYou for Confirmation', 'url' =>base_url('Web_booking/payment/'.$payble_amt)]));
 
     }
    
    
    
    public function doPayment($type){
        
        $data['user'] = $this->getUserById();
        $user_id =$data['user']['id'];
        
        //data insertion
        $result = $this->Web_model->order($this->session->userdata('order'));
        $this->Web_model->orderDetails($this->session->userdata('orderDetails'));
        $this->Web_model->updateOrderType($result,$type);
        //all session destroy
        $this->cart->destroy();
        $this->session->unset_userdata('order');
        $this->session->unset_userdata('orderDetails');
        $this->session->unset_userdata('booking');
        //all session destroy
        $data['title'] = 'Booking Confirmed';
        $data['bookingDetails'] = $this->Web_model->bookingDetails($result);
        // print_r($data['bookingDetails']);
        $booking_id = $data['bookingDetails']['booking_id'];
        $data['services'] = $this->Web_model->getAllServicesByBookingid($booking_id);
        $this->sendOrderMail($result);
        $data['categorys'] = $this->Web_model->get_categorys();
        $data['notifications'] = $this->Web_model->getAllNotifications($user_id);
        $data['socialLinks'] = $this->Web_model->getSocialLinks();
        $this->load->view('web/common-pages/header', $data);
        $this->load->view('web/confirm');
        $this->load->view('web/common-pages/footer');  
  
        
    }
    
    public function sendOrderMail($result) {
        $this->load->library('email');
        $data['user'] = $this->getUserById();
        // $user_id =$data['user']['id'];
        $data['bookingDetails'] = $this->Web_model->bookingDetails($result);
        $booking_id = $data['bookingDetails']['booking_id'];
        // print_r($data['bookingDetails']);die;
        $data['services'] = $this->Web_model->getAllServicesByBookingid($booking_id);
        $htmlContent = $this->load->view('web/email/confirmation', $data, TRUE);
        $from = "info@ondemand.com";
        $to = $data['user']['email'];
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . $from . "\r\n";
        $subject = "Order Placed Sucessfully.";
        mail($to, $subject, $htmlContent, $headers);
        return true;
    }
    
    public function invoice($id){
        $this->load->helper('pdf_helper');
        $data['bookingDetails'] = $this->Web_model->bookingDetailsByBookingId($id);
        $data['user'] = $this->getUserById();
        $data['services'] = $this->Web_model->getAllServicesByBookingid($id);
        $this->load->view('web/include/invoice', $data);
    }
    
    public function doAddReviews($service_id){
      $this->output->set_content_type('application/json');
      $this->form_validation->set_rules('review', 'Review', 'trim|required');
      $this->form_validation->set_rules('rating', 'Rating', 'trim|required');
     if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $data['user'] = $this->getUserById();
        $user_id =$data['user']['id'];
        $result = $this->Web_model->doAddReviews($service_id,$user_id);
    if($result){
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Review Added', 'url' => base_url('/')]));
            return true;  
        }else{
           $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Something Went Wrong', 'data' => 'Something Went Wrong']));
            return false; 
        }    
        
    }
    
    public function cart_wrapper($id = null){
        $this->output->set_content_type('application/json');        
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
        $content_wrapper = $this->load->view('web/include/cart_wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    public function addQuantity($id){
        $this->output->set_content_type('application/json');
        $data = array(
            'rowid' => $id,
            'qty' => $this->input->post('qty'),

        );
        $cart = $this->cart->update($data);               
        $this->output->set_output(json_encode(['result' => 1]));
        return FALSE;
        
    }
    
    
    
    
}