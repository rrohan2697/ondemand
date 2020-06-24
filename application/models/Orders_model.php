<?php
/**
 * Description of Orders_model Model
 *
 * @author Varun Negi
 */
class Orders_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->reconnect();
    }
    
    public function get_orders(){
    	$this->db->select('or.order_id,or.booking_id,or.status,or.order_type,u.user_name');
    	$this->db->from('od_orders or');
    	$this->db->join('od_users u','u.id = or.user_id');
    	$this->db->order_by("or.order_id", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAdminOrderDetailByOrderBookingId($booking_id) {
        $this->db->select('or.*,u.user_name,u.email,u.country_code,u.phone_number');
        $this->db->from('od_orders or');
        $this->db->join('od_users u', 'or.user_id=u.id');
        $this->db->where('or.booking_id', $booking_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getAddressByAddressId($address_id) {
        $query = $this->db->get_where('od_address', ['address_id' => $address_id]);
        return $query->row_array();
    }
     public function getAdminOrderByOrderBookingId($booking_id) {
        $this->db->select('od.*,s.service_title,s.price,s.icon_url');
        $this->db->from('od_order_details od');
        $this->db->join('od_services s', 's.id = od.service_id');
        $this->db->where('od.booking_id', $booking_id);
        $query = $this->db->get();
        return $query->result_array();
    }
     public function changeOrderStatus($order_id) {
       $this->db->update('od_orders', ['status' => $this->input->post('status')], ['order_id' => $order_id]);
        return $this->db->affected_rows();
}
   public function getuserdata($order_id){
       $this->db->select('o.booking_id,u.user_name,u.email,u.country_code,u.phone_number');
       $this->db->from('o.od_orders');
       $this->db->join('u.od_users','o.user_id = u.id');
       $this->db->where('o.booking_id', $booking_id);
       $query = $this->db->get();
        return $query->result_array();
       
   }
   
   public function getOrderServicesId($booking_id){
    $this->db->select('od.service_id');
        $this->db->from('od_order_details od');
        $this->db->where('od.booking_id', $booking_id);
        $query = $this->db->get();
        return $query->result_array();


   }
   
    public function getserviceprovider($service_id){
     $this->db->select('osp.id,osp.name');
     $this->db->from('od_services os');
     $this->db->join('od_services_provider osp','osp.category_id = os.category_id');
     $this->db->where('os.id',$service_id);
     $query = $this->db->get();
    return $query->row_array();

   }
   
   public function assignServiceProvider($id,$provider_id){
       $this->db->where('id',$id);
       $this->db->update('od_order_details',['service_provider_id'=>$provider_id]);
       return $this->db->affected_rows();
       
       
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
           //echo $this->db->last_query();die;
       if (empty($query1->num_rows())) {
                $this->db->update('od_orders', ['status' =>$status], ['booking_id' => $booking_id]);

        }
        //$this->db->update('od_order_details', ['status' => $this->input->post('status')], ['id' => $id]);
        return $this->db->affected_rows();
   }
    public function changeAllOrderStatus($booking_id,$status){
        $this->db->where('booking_id',$booking_id);
       $this->db->update('od_order_details',['service_status'=>$status]); 
       return $this->db->affected_rows();
   }
   public function pushnotificationuser($booking_id){
     $this->db->select('od.booking_id,od.user_id,u.user_name');
     $this->db->from('od_orders od');
     $this->db->join('od_users u','u.id = od.user_id');
     $this->db->where('od.booking_id', $booking_id);
     $query = $this->db->get();
     return $query->row_array();
   } 
   public function gettoken($user_id){
     $this->db->select('token_id');
     $this->db->from('od_firebase_token');
     $this->db->where('user_id', $user_id);
     $query = $this->db->get();
     return $query->result_array();
   }
   
   public function servicespushnotificationuser($id){
      $this->db->select('ods.booking_id,u.service_title');
      $this->db->from('od_order_details ods');
      $this->db->join('od_services u','u.id = ods.service_id');
      $this->db->where('ods.id', $id);
      $query = $this->db->get();
      return $query->row_array();
  }
  public function bookingOrders($booking_id){
     $this->db->select('service_id,quantity,price');
     $this->db->from('od_order_details');
     $this->db->where('booking_id', $booking_id);
     $query = $this->db->get();
     return $query->result_array();

}
public function Bookingdata($booking_id){
  $this->db->select('*');
  $this->db->from('od_orders');
  $this->db->where('booking_id',$booking_id);
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
public function getServicePrice($service_id){
  $this->db->select('id as service_id,price,service_title,icon_url');
  $query = $this->db->get_where('od_services',['id' => $service_id]);
  return $query->row_array();

}
}
