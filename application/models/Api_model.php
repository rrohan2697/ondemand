<?php
/**
 * Description of Api_model
 *
 * @author Varun Negi
 */

class Api_model extends CI_Model {

    public function __construct() {
        
        parent::__construct();
        $this->db->reconnect();
    }

    public function check_useraccount($email){
        $this->db->select('u.id as user_id ,u.user_name as full_name,u.email,u.country_code,u.phone_number as mobile_no,u.status,u.profile_url as profile_image,u.source');
        $this->db->from('od_users u');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function user_register(){
        $user_data = array(
            'user_name' => $this->security->xss_clean($this->input->post('full_name')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password'))),
            'phone_number' => $this->security->xss_clean($this->input->post('mobile_no')),
            'country_code' => $this->security->xss_clean($this->input->post('country_code')),
            'source' => $this->security->xss_clean($this->input->post('source')),
            'term' => $this->security->xss_clean($this->input->post('term')),
        );
        $this->db->insert('od_users', $user_data);
        $user_id = $this->db->insert_id();
        $this->db->select('u.id as user_id,u.user_name as full_name,u.email,u.country_code,u.phone_number as mobile_no,u.status,u.profile_url as profile_image');
        $this->db->from('od_users u');
        $this->db->where(['u.id' => $user_id, 'status' => 'Active']);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_userdata($user_id){
      $this->db->select('*');
      $this->db->from('od_users u');
      $this->db->where(['u.id' => $user_id, 'status' => 'Active']);
      $query = $this->db->get();
      return $query->row_array();
  }

    // public function insert_location($user_id,$location){
    //  $location = array(
    //     'user_id' =>$user_id,
    //     'location' =>$location
    //     );
    //     $this->db->insert('od_location', $location);
    //  return $this->db->insert_id();

    // }

  public function check_tokenexist($user_id,$tokenid){
    $query = $this->db->get_where('od_firebase_token',['user_id' =>$user_id, 'token_id' =>$tokenid]);
    return $query->row_array();
}
public function update_tokenid($id, $token_info){
    $this->db->update('od_firebase_token', $token_info, ['id' => $id]);
    return $this->db->affected_rows();
}
public function insert_tokenid($token_info){
    $this->db->insert('od_firebase_token', $token_info);
    return $this->db->insert_id();
}

public function login($email, $password) {
    $this->db->select('u.id as user_id,u.user_name as full_name,u.email,u.country_code,u.phone_number as mobile_no,u.status,u.profile_url as profile_image');
    $this->db->from('od_users u');
    $this->db->where([ 'password' => $password, 'status' => 'Active']);
    $this->db->where("(email = '$email' OR phone_number = '$email')");
    $query = $this->db->get();
    return $query->row_array();
}

public function check_oldpassword(){
    $user_id = $this->security->xss_clean($this->input->post('user_id'));
    $current_password = $this->security->xss_clean(hash('sha256', $this->input->post('current_password')));
    $query = $this->db->get_where('od_users', ['id' => $user_id, 'password' => $current_password, 'status' => 'Active']);
    return $query->row_array();
}

public function change_password($user_id){
   $password = $this->security->xss_clean(hash('sha256', $this->input->post('password')));
   $this->db->update('od_users', ['password' => $password], ['id' => $user_id, 'status' => 'Active']);
   return $this->db->affected_rows();
}

public function check_email($email){
    $this->db->select('*');
    $this->db->from('od_users');
    $this->db->where(['email' => $email, 'status' => 'Active']);
    $query = $this->db->get();
    return $query->row_array();
}
public function insert_user_activationcode($user_id){
    $this->db->update('od_users', ['is_forgot' => 'Active'], ['id' => $user_id]);
    return $this->db->affected_rows();
}
public function insert_user_activation($user_id){
    $this->db->update('od_users', ['is_forgot' => 'Inactive'], ['id' => $user_id]);
    return $this->db->affected_rows();
}

public function check_forgate($user_id){
     $query = $this->db->get_where('od_users',['id' =>$user_id, 'is_forgot' =>'Active']);
    return $query->row_array();
}

public function do_reset_passowrd($user_id){
    $reset_data = array(
        'password' => $this->security->xss_clean(hash('sha256', $this->input->post('newpassword')))
    );
    $this->db->update('od_users', $reset_data, ['id' => $user_id, 'is_forgot' => 'Active']);
    $this->db->update('od_users', ['is_forgot' => 'Inactive'], ['id' => $user_id]);
    return $this->db->affected_rows();
}

public function edit_profile($user_id,$image_url){
    $user_info = array(
        'user_name' => $this->security->xss_clean($this->input->post('full_name')),
        'email' => $this->security->xss_clean($this->input->post('email')),
        'country_code' => $this->security->xss_clean($this->input->post('country_code')),
        'phone_number' => $this->security->xss_clean($this->input->post('mobile_no')),
        'profile_url' => $image_url,
    );
    $this->db->update('od_users', $user_info, ['id' => $user_id]);
    $this->db->affected_rows();
    $this->db->select('u.id as user_id,u.user_name as full_name,u.email,u.country_code,u.phone_number as mobile_no,u.profile_url as profile_image');
    $query = $this->db->get_where('od_users u', ['id' => $user_id]);
    return $query->row_array();
}


public function get_faqs(){
    $this->db->select('id,title,description');
    $query = $this->db->get_where('od_faqs',['status' => 'Active']);
    return $query->result_array();
}

   /* public function get_about(){
        $this->db->select('content_name,content_title,content_description');
        $query = $this->db->get_where('od_settings',['content_name' => 'About-us']);
        return $query->result_array();
    }*/

    public function get_term($key){
        if($key == 1){
            $this->db->select('content_name,content_title,content_description');
            $query = $this->db->get_where('od_settings',['content_name' => 'Terms and Conditions']);
            return $query->result_array();
        }
        if($key == 2){
           $this->db->select('content_name,content_title,content_description');
           $query = $this->db->get_where('od_settings',['content_name' => 'About-us']);
           return $query->result_array();
           
       }
   }

   public function logout($user_id){
    $data = array(
        'status' => 'Inactive'
    );
    $this->db->update('od_firebase_token', $data, ['user_id' => $user_id]);
    return $this->db->affected_rows();
}

public function banner_image(){
 $this->db->select('id,image_url');
 $query = $this->db->get_where('od_banner_images',['status' => 'Active']);
 return $query->result_array();
}

public function category(){
 $this->db->select('id,category_name,icon_url');
 $query = $this->db->get_where('od_category',['status' => 'Active']);
 return $query->result_array();
}
public function get_category_banner($category_id){
    $this->db->select('image_url,category_id');
    $query = $this->db->get_where('od_category_banner',['category_id' => $category_id]);
    return $query->result_array();
}

public function sub_category($category_id){
 $this->db->select('id,category_id,subcategory_name,icon_url');
 $query = $this->db->get_where('od_subcategory',['status' => 'Active', 'category_id' => $category_id]);
 return $query->result_array();
}


public function addReview(){
    $data = array(
        'service_id' => $this->input->post('service_id'),
        'user_id'    => $this->input->post('user_id'),
        'review'     => $this->security->xss_clean($this->input->post('review')),
        'rating'     => $this->security->xss_clean($this->input->post('rating'))
    );

    $this->db->insert('od_review',$data);
    return $this->db->insert_id();
}
public function check_address($user_id,$address_id,$type){
    $query = $this->db->get_where('od_address',['user_id' =>$user_id, 'address_id'=>$address_id, 'type'=>$type]);
    return $query->row_array();
}
public function addNewAddress($user_id) {
   
    $data = array(
        'user_id' => $user_id,
        'user_name' => $this->security->xss_clean($this->input->post('user_name')),
        'address_line_1' => $this->security->xss_clean($this->input->post('address_line_1')),
        'address_line_2' => $this->security->xss_clean($this->input->post('address_line_2')),
        'state' => $this->security->xss_clean($this->input->post('state')),
        'city' => $this->security->xss_clean($this->input->post('city')),
        'type' => $this->security->xss_clean($this->input->post('type')),
        'lat' => $this->security->xss_clean($this->input->post('lat')),
        'long' => $this->security->xss_clean($this->input->post('long'))
    );
        //print_r($data);die;
    $this->db->insert('od_address', $data);
    $address_id = $this->db->insert_id();
    $this->db->select('*');
    $this->db->from('od_address');
    $this->db->where('address_id',$address_id);
    $query = $this->db->get();
    return $query->row_array();
}

public function updateAddress($user_id,$address_id) {
    $data = array(
        'user_name' => $this->security->xss_clean($this->input->post('user_name')),
            // 'zipcode' => $this->security->xss_clean($this->input->post('zipcode')),
        'address_line_1' => $this->security->xss_clean($this->input->post('address_line_1')),
        'address_line_2' => $this->security->xss_clean($this->input->post('address_line_2')),
        'state' => $this->security->xss_clean($this->input->post('state')),
        'city' => $this->security->xss_clean($this->input->post('city')),
        'type' => $this->security->xss_clean($this->input->post('type')),
        'lat' => $this->security->xss_clean($this->input->post('lat')),
        'long' => $this->security->xss_clean($this->input->post('long'))
    );
    $this->db->update('od_address', $data, ['user_id' => $user_id, 'address_id' =>$address_id]);
          //return $this->db->affected_rows();
    if($this->db->affected_rows() > 0){
     $this->db->select('*');
     $this->db->from('od_address');
     $this->db->where('address_id',$address_id); 
     $query = $this->db->get();
     return $query->row_array();
 } else {
  return false;
}
}

public function addressList($user_id) {
    $query = $this->db->get_where('od_address',['user_id' => $user_id]);
    return $query->result_array();
} 


public function deleteAddress($user_id,$address_id) {
    $this->db->delete('od_address', ['address_id' => $address_id,'user_id' => $user_id]);
    return $this->db->affected_rows();
}

public function service_charge() {
    $this->db->select('delivery_charge as convenince_charge,tax_charge as service_tax');
    $this->db->from('od_service_charges');
    $query = $this->db->get();
    return $query->result_array();
}
public function time_slot() {
    $this->db->select('start_time');
    $this->db->from('od_time_slot');
    $this->db->where('status','Active');
    $this->db->order_by('start_time','ASC');
    $query = $this->db->get();
    return $query->result_array();
}


public function getAllNotification($user_id) {
    $query = $this->db->get_where('od_notification', ['user_id' => $user_id]);
    return $query->result_array();
}

public function getServices($subcategory_id){
 $this->db->select('id as service_id,category_id,subcategory_id,service_title,price,icon_url');
 $query = $this->db->get_where('od_services',['status' => 'Active', 'category_id' => $subcategory_id]);
 return $query->result_array();
}

public function get_service_banner($service_id){
   $this->db->select('service_id,image_url');
   $query = $this->db->get_where('od_service_banner',['service_id' => $service_id]);
   return $query->result_array();
   
}

public function service_data($service_id){
 $this->db->select('id as service_id,category_id,subcategory_id,service_title,price,time,description,icon_url');
 $query = $this->db->get_where('od_services',['status' => 'Active', 'id' => $service_id]);
 return $query->result_array();
}

public function recommended(){
 $this->db->select('id as service_id,category_id,subcategory_id,service_title,description,icon_url');
 $query = $this->db->get_where('od_services',['status' => 'Active', 'recommended' => '1']);
 return $query->result_array();
}

public function getAverageRating($service_id) {
    $this->db->select('AVG(rating) as rating');
    $this->db->from('od_review or');
    $this->db->where('service_id', $service_id);
    $this->db->group_by('or.user_id');
    $query = $this->db->get();
    return $query->row_array();
}
public function totalRating($service_id) {
    $this->db->select('*');
    $this->db->from('od_review');
    $this->db->where('service_id', $service_id);
    $query = $this->db->get();
    return $query->num_rows();
}

public function getReview($service_id) {
    $this->db->select('or.service_id,or.user_id,or.review,or.rating,or.created_at,u.user_name,u.profile_url');
    $this->db->from('od_review or');
    $this->db->join('od_users u','u.id = or.user_id');
    $this->db->where('service_id', $service_id);
    $query = $this->db->get();
    return $query->result_array();
}
public function cart_details($service_id){
   $this->db->select('id as service_id,service_title,price,description,icon_url');
   $query = $this->db->get_where('od_services',['status' => 'Active', 'id' => $service_id]);
   return $query->row_array();

}


public function booking($order_unique_id){
      $time = $this->input->post('service_time');
     $service_time  = date("H:i", strtotime("$time"));

  $status = 'Ongoing';
  $order = array(
    'booking_id' =>$order_unique_id,
    'transaction_id' => $this->security->xss_clean($this->input->post('txn_id')),
    'user_id' => $this->security->xss_clean($this->input->post('user_id')),
    'address_id' => $this->security->xss_clean($this->input->post('address_id')),
    'total_amount' => $this->security->xss_clean($this->input->post('total_amount')),
    'payable_amount' => $this->security->xss_clean($this->input->post('payable_amount')),
    'service_tax' => $this->security->xss_clean($this->input->post('service_tax')),
    'convenience_charge' => $this->security->xss_clean($this->input->post('convenience_charge')),
    'order_type' => $this->security->xss_clean($this->input->post('order_type')),
    'status' =>$status,
    'service_time' => $service_time,
    'service_date' => $this->security->xss_clean($this->input->post('service_date')),
);
  $this->db->insert('od_orders', $order);
  $id = $this->db->insert_id();
  $this->db->select('*');
  $this->db->from('od_orders');
  $this->db->where('order_id',$id);
  $query = $this->db->get();
  return $query->row_array();
}
public function getServicePrice($service_id){
    $this->db->select('id as service_id,price,service_title,icon_url');
    $query = $this->db->get_where('od_services',['id' => $service_id]);
    return $query->row_array();

}


public function addBooking($service_id,$quantity,$price,$order_number){
    $status = 'Ongoing';
 $order = array(
    'booking_id' => $order_number,
    'service_id' => $service_id,
    'quantity' => $quantity,
    'price' => $price,
    'service_status'=>$status
);
 $this->db->insert('od_order_details', $order);
 return $this->db->insert_id();
}

public function checkService($user_id,$booking_id){
    $this->db->select('service_time,service_date');
    $this->db->from('od_orders');
    $this->db->where('user_id',$user_id);
    $this->db->where('booking_id',$booking_id);
    $query = $this->db->get();
    return $query->row_array();
    
    
}
public function Bookingreschdule($booking_id,$user_id){
    $this->db->select('booking_id,payable_amount');
    $this->db->from('od_orders');
    $this->db->where('user_id',$user_id);
    $this->db->where('booking_id',$booking_id);
    $query = $this->db->get();
    return $query->row_array();
}

public function changeAllOrderStatus($booking_id){
        $this->db->where('booking_id',$booking_id);
       $this->db->update('od_order_details',['service_status'=>'Cancelled']);
       return $this->db->affected_rows();
   }

public function cancelFullOrder($user_id,$booking_id) {
    $this->db->update('od_orders', ['status' => 'Cancelled'], ['user_id'=> $user_id, 'booking_id' => $booking_id]);
    return $this->db->affected_rows();
}


public function servicesdata($service_id){
   $this->db->select('id as service_id,category_id,subcategory_id,service_title,price,time,description,icon_url');
   $query = $this->db->get_where('od_services',['status' => 'Active', 'id' => $service_id]);
   return $query->row_array();
}

public function ongoingService($user_id){
    $this->db->select('or.booking_id,or.service_time,or.service_date,or.status,od.service_id');
    $this->db->from('od_orders or');
    $this->db->join('od_order_details od','od.booking_id = or.booking_id');
    $this->db->where('or.user_id',$user_id);
    $this->db->where("(or.status = 'Ongoing' OR or.status = 'Processing')");
    $this->db->group_by('or.booking_id');
    $query = $this->db->get();
     //echo $this->db->last_query();die;
    return $query->result_array();

}

public function rescheduleService($user_id){
    $this->db->select('or.booking_id,or.service_time,or.service_date,or.status,od.service_id');
    $this->db->from('od_orders or');
    $this->db->join('od_order_details od','od.booking_id = or.booking_id');
    $this->db->where('or.user_id',$user_id);
    $this->db->where("(or.status = 'Cancelled' OR or.status = 'Completed')");
    $this->db->group_by('or.booking_id');
    $query = $this->db->get();
    return $query->result_array();

}
public function getSubcategoryImg($service_id){
  $this->db->select('ods.icon_url');
  $this->db->from('od_subcategory ods');
  $this->db->join('od_services os', 'os.subcategory_id = ods.id');
  $this->db->where('os.id',$service_id);
  $query = $this->db->get();
  return $query->row_array();

}

public function getServicedata($booking_id){
    $this->db->select('service_id');
    $query = $this->db->get_where('od_order_details',['booking_id' => $booking_id]);
    return $query->result_array();

}
public function getCategoryName($service_id){
  $this->db->select('ods.category_name');
  $this->db->from('od_category ods');
  $this->db->join('od_services os', 'os.category_id = ods.id');
  $this->db->where('os.id',$service_id);
  $query = $this->db->get();
  return $query->row_array();

}

public function getServiceBookingDetailByBookingId($user_id,$booking_id){
    $this->db->select('od.id as servicebooking_id,od.service_id,od.quantity,od.price,od.service_status,or.address_id');
    $this->db->from('od_orders or');
    $this->db->join('od_order_details od','od.booking_id = or.booking_id');
    $this->db->where('or.user_id',$user_id);
    $this->db->where('or.booking_id',$booking_id);
    $query = $this->db->get();
    return $query->result_array();
    
}
public function getbookingdata($user_id,$booking_id){
    $this->db->select('or.order_id,or.total_amount,or.payable_amount,or.service_tax,or.convenience_charge,or.status');
    $this->db->from('od_orders or');
    $this->db->where('or.user_id',$user_id);
    $this->db->where('or.booking_id',$booking_id);
    $query = $this->db->get();
    return $query->row_array();

}
public function getbookingdataTime($user_id,$booking_id){
    $this->db->select('or.service_time,or.service_date,or.booking_id');
    $this->db->from('od_orders or');
    $this->db->where('or.user_id',$user_id);
    $this->db->where('or.booking_id',$booking_id);
    $query = $this->db->get();
    return $query->result_array();

}

public function getAddress($address_id){
    $query = $this->db->get_where('od_address',['address_id' =>$address_id]);
    return $query->row_array();
}

public function checkSenderToReceiver($sender_id, $reciever_id) {
    $query = $this->db->get_where('chat', (['sender_id' => $sender_id, 'reciever_id' => $reciever_id]));
    return $query->row_array();
}

public function checkReceiverToSender($sender_id, $reciever_id) {
    $query = $this->db->get_where('chat', (['sender_id' => $reciever_id, 'reciever_id' => $sender_id]));
    return $query->row_array();
}

public function updatechatlist($post_id, $message, $time, $date) {
    $this->db->where('id', $post_id);
    $q = $this->db->update('chat', ['message' => $message, 'time' => $time, 'date' => $date]);
    return $this->db->affected_rows();
}

public function insertchatList($sender_id, $reciever_id, $message, $time, $date) {
    $data = array(
        'sender_id' => $sender_id,
        'reciever_id' => $reciever_id,
        'message' => $message,
        'time' => $time,
        'date' => $date
    );
    $this->db->insert('chat', $data);
    return $this->db->insert_id();
}
public function chatList($user_id) {
    $this->db->select('c.*,CONCAT(d.username) AS Admin');
    $this->db->from('chat c');
    $this->db->join('od_admin d','c.reciever_id = d.id OR c.sender_id = d.id', 'left');
    $this->db->where('c.sender_id', $user_id);
    $this->db->or_where('c.reciever_id', $user_id);
    $this->db->order_by('c.id','desc');
    $this->db->order_by('c.date','desc');
    $this->db->order_by('c.time','desc');
    $query = $this->db->get();
    return $query->result_array();
}

public function rebooking($user_id,$booking_id){
    $this->db->select('transaction_id,user_id,address_id,total_amount,service_tax,payable_amount,convenience_charge,order_type,service_time,service_date');
    $this->db->from('od_orders');
    $this->db->where('user_id',$user_id);
    $this->db->where('booking_id',$booking_id);
    $query = $this->db->get();
    return $query->result_array();

}

public function insertBooking($booking,$order_unique_id){ 
      $status = 'Ongoing';
    $time = $booking[0]['service_time'];
     $service_time  = date("H:i", strtotime("$time"));

    $order = array(
        'booking_id'         =>$order_unique_id,
        'transaction_id'            =>$booking[0]['transaction_id'],
        'user_id'            =>$booking[0]['user_id'],
        'address_id'         =>$booking[0]['address_id'],
        'total_amount'       => $booking[0]['total_amount'],
        'payable_amount'      => $booking[0]['payable_amount'],
        'service_tax'        =>$booking[0]['service_tax'],
        'convenience_charge' =>$booking[0]['convenience_charge'],
        'order_type'         =>$booking[0]['order_type'] ,
        'status'             =>$status,
        'service_time'       =>$service_time,
        'service_date'       =>$booking[0]['service_date'],
    );
    $this->db->insert('od_orders', $order);
    $id = $this->db->insert_id();
    $this->db->select('*');
    $this->db->from('od_orders');
    $this->db->where('order_id',$id);
    $query = $this->db->get();
    return $query->row_array();
}

public function getbookingdataById($booking_id){
   $this->db->select('service_id,quantity,price');
   $this->db->from('od_order_details');
   $this->db->where('booking_id',$booking_id);
   $query = $this->db->get();
   return $query->result_array();

}

public function insertrebookingData($service_id,$quantity,$price,$booking_id){
    $status = 'Ongoing';
    $data =array(
        'booking_id' => $booking_id,
        'service_id' => $service_id,
        'quantity' => $quantity,
        'price' => $price,
        'service_status'=>$status
    );
    $this->db->insert('od_order_details', $data);
    return $this->db->insert_id();
}

public function sociallogin() {
    $user_name = $this->input->post('user_name');
    $email = $this->input->post('email');
    $source = $this->input->post('source');
    $this->db->select('id as user_id,user_name as full_name,email,country_code, phone_number as mobile_no,status,profile_url as profile_image');
    $query = $this->db->get_where('od_users', ['email' => $email, 'source' =>  $source]);
    if ($query->num_rows() > 0) {
        return $query->row_array();
    } else {
        $data = array(
            'user_name' => $user_name,
            'email' => $email,
            'source' => $source
        );
        $insert_id = $this->db->insert('od_users', $data);
        $id = $this->db->insert_id();
        $this->db->select('id as user_id,user_name as full_name,email,country_code, phone_number as mobile_no,status,profile_url as profile_image');
        $query = $this->db->get_where('od_users', ['id' => $id]);
        return $query->row_array();
    }
}

public function doSearchServices($search) {
    $this->db->select('id as service_id,service_title,price,time,description,icon_url');
    $this->db->from('od_services');
    $this->db->where('status', 'Active');
    $this->db->like('service_title', $search, 'both');
        // $this->db->limit(30);
    $this->db->group_by('id');
    $query = $this->db->get();
         //echo $this->db->last_query();die;
    return $query->result_array();
}
 public function getServiceProvider($booking_id){
    $this->db->select('os.service_provider_id,ods.service_title as servicename');
    $this->db->from('od_order_details os');
    $this->db->join('od_services ods','ods.id = os.service_id');
    $this->db->where('os.service_status !=','Cancelled');
    $this->db->where('os.booking_id',$booking_id);
    $this->db->where('os.service_provider_id is NOT NULL', NULL, FALSE);
    $query = $this->db->get();
    return $query->result_array();
     
 }
 public function getserviceproviderdetail($serviceprovider_id){
    $this->db->select('name,email,phone_number,profile_url');
    $this->db->from('od_services_provider');
    $this->db->where('id',$serviceprovider_id);
    $query = $this->db->get();
    return $query->row_array();
     
 }
 public function changeServiceStatus($id,$status){
       $this->db->where('id',$id);
       $this->db->update('od_order_details',['service_status'=>$status]);
        $this->db->select('booking_id');
        $this->db->from('od_order_details');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $booking_id = $query->row_array()['booking_id'];
        $query1 = $this->db->where_not_in('service_status',$status);

        $query1 = $this->db->get_where('od_order_details', ['booking_id' => $booking_id]);
       if (empty($query1->num_rows())) {
                $this->db->update('od_orders', ['status' =>$status], ['booking_id' => $booking_id]);

        }
        return $this->db->affected_rows();
   }
 
 
 
 

}
