<?php 
/**
 * Description of Orders Controller
 *
 * @author Varun Negi
 */
defined('BASEPATH') OR die('Not Allowed');

class Orders extends CI_Controller {

    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        
        parent::__construct();
        $this->load->model(['Orders_model','Admin_model']);
    }
    
    public function index(){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Orders Management';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['orders'] = $this->Orders_model->get_orders(); 
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/orders/order-list');
        $this->load->view('admin/common-pages/footer');
    }

    public function order_detail($booking_id){
       if ($this->session->userdata('admin_emailid') === null) {
        redirect(base_url('admin/login'));
    }
    $data['title'] = 'Order View';
    $data['notications'] = $this->Admin_model->countnotification();
    $admin_info = $this->session->userdata('admin_emailid');
    $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
    $data['order'] = $ordered = $this->Orders_model->getAdminOrderDetailByOrderBookingId($booking_id);
    $data['addresses'] = $this->Orders_model->getAddressByAddressId($ordered['address_id']);
    $data['booking_order_detail'] = $this->Orders_model->getAdminOrderByOrderBookingId($booking_id);
        // echo '<pre>';print_r($data['booking_order_detail']);die;
    $this->load->view('admin/common-pages/header', $data);
    $this->load->view('admin/common-pages/sidebar');
    $this->load->view('admin/orders/order-invoice');
    $this->load->view('admin/common-pages/footer');

}
public function changeOrderStatus($order_id,$booking_id) {
    $this->output->set_content_type('application/json');
    $status = $this->input->post('status');
    if($status == 'Cancelled'){
        $this->Orders_model->changeAllOrderStatus($booking_id,$status);
        $this->sendpushnotification($booking_id);
        $order = $this->Orders_model->bookingOrders($booking_id);
        $results = $this->Orders_model->Bookingdata($booking_id);
        $this->sendOrderMail($order,$results);
    }
    $result = $this->Orders_model->changeOrderStatus($order_id);
    
    if ($result) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Status updated sucessfully!!', 'url' => base_url('Orders')]));
        return FALSE;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Try Again']));
        return FALSE;
    }
}

public function sendOrderMail($order,$results) {
    $this->load->library('email');
    $bookings = array();
    $i = 0;
    foreach ($order as $booking) {
       $data = $this->Orders_model->getServicePrice($booking['service_id']);
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
$data['user'] = $this->Orders_model->get_userdata($results['user_id']);
$data['services'] = $bookings;
$data['order'] = $results;
$htmlContent = $this->load->view('web/email/order-cancelled', $data, TRUE);
$from = "info@hammerandspanner.in";
$to = $data['user']['email'];
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' . $from . "\r\n";
$subject = "Order Cancelled";
mail($to, $subject, $htmlContent, $headers);
return true;
}

private function sendpushnotification($booking_id){
    $result = $this->Orders_model->pushnotificationuser($booking_id);

    $token = $this->Orders_model->gettoken($result['user_id']);
    
    define('API_ACCESS_KEY','AAAA_qvdRtA:APA91bFfIHjCdy30N-XrAMOvADvMQsh_UOzlSQJNKhJHUL7XpuE-dhpmD3eFYauvOMRTRT-pEdWKykvqn_Okpu0oosO8BzymlH-ntLvMwwSiVvT7kS0SxBZ9a8GsN27OjaFB9rgYlz5y');
    
    $description = 'Hello ' .$result['user_name'] . ',' . ' your Booking Order ' .$result['booking_id'] . ' is cancelled';
    $title = $result['booking_id'] . ' Order cancelled By Admin.';
    foreach ($token as $token_id) {
        $msg = array(
            'title'=>$title,
            'body' => $description,
        );

        $fields = array(
            'to' => $token_id['token_id'],
            'notification' => $msg
        );
        
        $headers = array('Authorization:key = ' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
    }
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Message Send Sucessfully', 'url' => base_url('notification')]));
    return FALSE;

}

public function invoice($booking_id, $order_id) {
    $this->load->helper('pdf_helper');
    $admin_info = $this->session->userdata('admin_emailid');
    $data['order'] = $ordered = $this->Orders_model->getAdminOrderDetailByOrderBookingId($booking_id);
        //print_r($data['order']);die; 
    $data['addresses'] = $this->Orders_model->getAddressByAddressId($ordered['address_id']);
        //print_r($data['addresses']);die;
    $data['booking_order_detail'] = $this->Orders_model->getAdminOrderByOrderBookingId($booking_id);
    $this->load->view('admin/orders/invoice', $data);
}

public function assignOrder($booking_id){
    if ($this->session->userdata('admin_emailid') === null) {
        redirect(base_url('admin/login'));
    }
    $data['title'] = 'Assign order';
    $admin_info = $this->session->userdata('admin_emailid');
    $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
    $data['notications'] = $this->Admin_model->countnotification();
    $data['services'] = $this->Orders_model->getAdminOrderByOrderBookingId($booking_id);
        // echo '<pre>';print_r($data['services']);die;
    $data['serviceprovider'] = $result = $ordered = $this->Orders_model->getOrderServicesId($booking_id);
    $i = 0;
    foreach ($data['serviceprovider'] as $services) {
        $results = $this->Orders_model->getserviceprovider($services['service_id']);
        // print_r($results);die;
        if ($results) {
            $result[$i]['id'] = $results['id'];
            $result[$i]['name'] = $results['name'];
        } else {
            $result[$i]['id'] = "";
        }
        $i++;
    }
    $data['serviceprovider'] = $result;
    $this->load->view('admin/common-pages/header', $data);
    $this->load->view('admin/common-pages/sidebar');
    $this->load->view('admin/orders/assign-order');
    $this->load->view('admin/common-pages/footer');
}

public function assignServiceProvider($id){
    $this->output->set_content_type('application/json');
    $provider_id = $this->input->post('provider_id');
    $result = $this->Orders_model->assignServiceProvider($id,$provider_id);
    if ($result) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service Provider Assigned']));
        return FALSE;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Try Again']));
        return FALSE;
    }
}

public function changeServiceStatus($id){
    $this->output->set_content_type('application/json');
    $status = $this->input->post('status');
    if($status == 'Cancelled'){
        $this->sendservicepushnotification($id,$status);
    }
    $result = $this->Orders_model->changeServiceStatus($id,$status);
    if ($result) {
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service status changed.']));
        return FALSE;
    } else {
        $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Try Again']));
        return FALSE;
    }
}
private function sendservicepushnotification($id,$status){
    $results = $this->Orders_model->servicespushnotificationuser($id);
    $result = $this->Orders_model->pushnotificationuser($results['booking_id']);

    $token = $this->Orders_model->gettoken($result['user_id']);
    
    define('API_ACCESS_KEY','AAAA_qvdRtA:APA91bFfIHjCdy30N-XrAMOvADvMQsh_UOzlSQJNKhJHUL7XpuE-dhpmD3eFYauvOMRTRT-pEdWKykvqn_Okpu0oosO8BzymlH-ntLvMwwSiVvT7kS0SxBZ9a8GsN27OjaFB9rgYlz5y');
    
    $description = 'Hello ' .$result['user_name'] . ',' . 'Your Service ' .$results['service_title'] . ' is cancelled!';
    $title = $result['booking_id'] . ' Order Service ' .$results['service_title'] . ' is cancelled ';
    foreach ($token as $token_id) {
        $msg = array(
            'title'=>$title,
            'body' => $description,
        );

        $fields = array(
            'to' => $token_id['token_id'],
            'notification' => $msg
        );
    
        $headers = array('Authorization:key = ' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        // echo json_encode($headers);die;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        //print_r($result);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
    
        curl_close($ch);
    }
    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Message Send Sucessfully']));
    return FALSE;

}



}