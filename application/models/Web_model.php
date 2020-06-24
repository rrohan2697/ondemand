<?php
/**
 * Description of Web_model Model
 *
 * @author Mukesh Yadav
 */
class Web_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->reconnect();
    }
 
    public function get_setting_data($type){
        $query = $this->db->get_where('od_settings', ['id'=>$type]);
        return $query->row_array();
    }

    public function get_banners_images(){
        $this->db->select('id, image_url');
        $query = $this->db->get_where('od_banner_images', ['status'=>'Active']);
        return $query->result_array();
    }

    public function get_faqs(){
        $this->db->select('id, title, description');
        $query = $this->db->get_where('od_faqs', ['status'=>'Active']);
        return $query->result_array();
    }
    
    

    public function get_categorys(){
        $this->db->select('id, category_url,category_name, icon_url');
        $query = $this->db->get_where('od_category', ['status'=>'Active']);
        return $query->result_array();
    }

    public function get_category_byurl($category_url){
        $query = $this->db->get_where('od_category', ['category_url' => $category_url]);
        return $query->row_array();
    }

    public function get_subcategorys($category_id){
        $this->db->select('subcategory_url,subcategory_name,icon_url,id');
        $query = $this->db->get_where('od_subcategory', ['category_id'=>$category_id]);
        return $query->result_array();
    }

    public function get_categorys_banners($category_id){
        $this->db->select('id,image_url');
        $query = $this->db->get_where('od_category_banner', ['category_id'=>$category_id]);
        return $query->result_array();
    }
    
    public function getServicesBySubcategoryId($id){
        $sel = $this->db->get_where('od_services',['subcategory_id'=>$id]);
        return $sel->result_array();
    }
    
    public function doAddAddress($user_id){
        $data = array(
        'user_id'=>$user_id,
         'user_name'=>$this->input->post('name'),
         'address_line_1'=>$this->input->post('add1'),
         'address_line_2'=>$this->input->post('add2'),
         'city'=>$this->input->post('city'),
         'state'=>$this->input->post('locality'),
         'zipcode'=>$this->input->post('pincode'),
         'type'=>$this->input->post('type'),
            
        );
        $this->db->insert('od_address',$data);
        $id =  $this->db->insert_id();
        $this->db->select('*');
        $this->db->from('od_address');
        $this->db->where('address_id',$id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function doEditAddress($id){
        $data = array(
        
         'user_name'=>$this->input->post('edit_name'),
         'address_line_1'=>$this->input->post('edit_add1'),
         'address_line_2'=>$this->input->post('edit_add2'),
         'city'=>$this->input->post('edit_city'),
         'state'=>$this->input->post('edit_locality'),
         'zipcode'=>$this->input->post('edit_pincode'),
         'type'=>$this->input->post('type'),
         );
         $this->db->where('address_id',$id);
         $this->db->update('od_address',$data);
         return $this->db->affected_rows();
        
    }
    
    public function updateLatLong($latitude,$longitude,$address_id){
        $this->db->where('address_id',$address_id);
        $this->db->update('od_address',['lat'=>$latitude,'long'=>$longitude]);
        $this->db->affected_rows();
    }
    
    public function getAddress($user_id){
        $sel = $this->db->get_where('od_address',['user_id'=>$user_id]);
        return $sel->result_array();
    }
    
    public function getServiceCharges(){
        $this->db->select('*');
        $this->db->from('od_service_charges');
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function order($data){
       $this->db->insert('od_orders',$data);
       return $this->db->insert_id();

    }
    
    public function orderDetails($orderDetails){
        $this->db->insert_batch('od_order_details',$orderDetails);
        return $this->db->insert_id();
        
    }
    
    public function updateOrderType($result,$type){
        $this->db->where('order_id',$result);
        $this->db->update('od_orders',['order_type'=>$type]);
        return $this->db->affected_rows();
    }
    
    public function removeAddress($id){
        $this->db->where('address_id',$id);
        $this->db->delete('od_address');
        return $this->db->affected_rows();
    }
    
    public function bookingDetails($id){
        $this->db->select('od_orders.*,od_order_details.*,od_address.*');
        $this->db->from('od_orders');
        $this->db->join('od_order_details','od_order_details.booking_id=od_orders.booking_id');
        $this->db->join('od_address','od_address.address_id=od_orders.address_id');
//        $this->db->join('od_services','od_services.id=od_order_details.service_id');
        $this->db->where('od_orders.order_id',$id);
        $sel = $this->db->get();
        return $sel->row_array();
        
    }
    
    public function bookingDetailsByBookingId($id){
       $this->db->select('od_orders.*,od_order_details.*,od_address.*');
        $this->db->from('od_orders');
        $this->db->join('od_order_details','od_order_details.booking_id=od_orders.booking_id');
        $this->db->join('od_address','od_address.address_id=od_orders.address_id');
        $this->db->where('od_orders.booking_id',$id);
        $sel = $this->db->get();
        return $sel->row_array(); 
    }
    
    public function getAllServicesByBookingid($booking_id){
        $this->db->select('od_order_details.*,od_services.*');
        $this->db->from('od_order_details');
        $this->db->join('od_services','od_services.id=od_order_details.service_id');
        $this->db->where('od_order_details.booking_id',$booking_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function getAllOngoingServices($booking_id){
        $this->db->select('od.id as orderId,od.service_id,od.price,od.quantity,od.service_status,od.service_provider_id,od_services.*');
        $this->db->from('od_order_details od');
        $this->db->join('od_services','od_services.id=od.service_id');
        $this->db->where('od.booking_id',$booking_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function insertCartDetails($user_id){
        $data = array(
        'card_no'=>$this->input->post('number'),
        'name'=>$this->input->post('name'),
        'expiry'=>$this->input->post('expiry'), 
        'user_id'=>$user_id 
        );
        $this->db->insert('od_card',$data);
        return $this->db->insert_id();
    }
   
    
    public function getServiceDetails($service_id){
        $this->db->select('od_services.*,od_category.category_name,od_category.category_url,od_subcategory.subcategory_name');
        $this->db->from('od_services');
        $this->db->join('od_category','od_category.id=od_services.category_id');
        $this->db->join('od_subcategory','od_subcategory.id=od_services.subcategory_id');
        $this->db->where('od_services.id',$service_id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function getServiceBanner($service_id){
        $sel = $this->db->get_where('od_service_banner',['service_id'=>$service_id]);
        return $sel->result_array();
    }
    
    public function getBookings($user_id){
        $this->db->select('od_orders.*');
        $this->db->from('od_orders');
        $this->db->where('od_orders.user_id',$user_id);
        $this->db->where('od_orders.status','Ongoing');
        $this->db->order_by('order_id','desc');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function getCancelledBooking($user_id){
       $this->db->select('od_orders.*');
        $this->db->from('od_orders');
        $this->db->where('od_orders.user_id',$user_id);
        $this->db->where('od_orders.status','Cancelled');
        $this->db->or_where('od_orders.status','Completed');
        $this->db->order_by('order_id','desc');
        $sel = $this->db->get();
        return $sel->result_array(); 
    }
    
    public function getAllSlots(){
        $this->db->select('*');
        $this->db->from('od_time_slot');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function cancelBooking($id){
        $this->db->where('order_id',$id);
        $this->db->update('od_orders',['status'=>'Cancelled']);
        return $this->db->affected_rows();
    }
    
    public function doAddReviews($service_id,$user_id){
        $data = array(
            'service_id'=>$service_id,
            'user_id'=>$user_id,
            'review'=>$this->input->post('review'),
            'rating'=>$this->input->post('rating')
            
        );
        $this->db->insert('od_review',$data);
        return $this->db->insert_id();
    }
    
    
    public function getAllNotifications($user_id){
        $sel = $this->db->get_where('od_notification',['user_id'=>$user_id]);
        return $sel->result_array();
    }
    
    public function getAllReviews($service_id){
        $this->db->select('od_review.*,od_users.user_name,od_users.profile_url');
        $this->db->from('od_review');
        $this->db->join('od_users','od_users.id=od_review.user_id');
        $this->db->where('od_review.service_id',$service_id);
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function totalReview($service_id){
        $this->db->select('od_review.*,od_users.user_name,od_users.profile_url');
        $this->db->from('od_review');
        $this->db->join('od_users','od_users.id=od_review.user_id');
        $this->db->where('od_review.service_id',$service_id);
        $sel = $this->db->get();
        return $sel->num_rows();
    }
    
    public function averageRating($service_id){
        $this->db->select('AVG(rating)');
        $this->db->from('od_review');
        $this->db->where('od_review.service_id',$service_id);
        $sel = $this->db->get();
        return $sel->row_array();
    }
    
    public function getRandomServices(){
        $this->db->select('*');
        $this->db->from('od_services');
        $this->db->order_by('rand()');
        $this->db->limit('10');
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function getServiceById($id){
        $sel = $this->db->get_where('od_services',['id'=>$id]);
        return $sel->row_array();
    }
    
    public function getSearchedServices($search){
        $this->db->select('*');
        $this->db->from('od_services');
        $this->db->where("service_title LIKE '%$search%'");  
        $sel = $this->db->get();
        return $sel->result_array();
    }
    
    public function addressById($id){
        $sel = $this->db->get_where('od_address',['address_id'=>$id]);
        return $sel->row_array();
    }
    
    public function docontactus(){
        $data = array(
        'name' => $this->input->post('name'),   
        'email' => $this->input->post('email'),   
        'phone' => $this->input->post('phone'),   
        'text' => $this->input->post('text'),   
        );
        
        $this->db->insert('od_contactus',$data);
        return $this->db->insert_id();
    }
    
    public function getServiceprovider($service_provider_id){
        $sel = $this->db->get_where('od_services_provider',['id'=>$service_provider_id]);
        return $sel->row_array();
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
   
   public function getSocialLinks(){
       $this->db->select('*');
       $this->db->from('od_social');
       $sel = $this->db->get();
       return $sel->result_array();
       
   }
    
    
}
