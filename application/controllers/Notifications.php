<?php
/**
 * Description of Notifications Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Notifications extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        parent::__construct();
        $this->load->model(['Settings_model','Users_model','Admin_model']);
    }

    /**
     * user_notification using function listing of notification
     *
     * @return void
     */
    public function index(){ 
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['datatable'] = 1;
        $data['title'] = 'Notifications Management';
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['users'] = $this->Users_model->get_users();
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/notifications/notification-list');
        $this->load->view('admin/common-pages/footer');
    }
    
    /**
     * send_notification send notification view
     *
     * @return void
     */
    public function send() {
        $this->output->set_content_type('application/json');
        $user_id = $this->input->post('user_id');
        $data['user_id'] = implode(',', $user_id);
        $list = [];
        $i = 0;
        foreach ($user_id as $user) {
            $users = $this->Users_model->view_user_info($user);
            $list[$i] = $users['user_name'];
            $i++;
        }
        $data['user_name'] = implode(',', $list);

        $content_wrapper = $this->load->view('admin/notifications/send-notification-wrapper', $data, true);
        $this->output->set_output(json_encode(['result' => 1, 'notification_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    /**
     * do_send using function send notification
     *
     * @return void
     */
    public function do_send(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $user_ids = explode(',', $this->input->post('user_id'));
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        
        define('API_ACCESS_KEY','AAAA_qvdRtA:APA91bFfIHjCdy30N-XrAMOvADvMQsh_UOzlSQJNKhJHUL7XpuE-dhpmD3eFYauvOMRTRT-pEdWKykvqn_Okpu0oosO8BzymlH-ntLvMwwSiVvT7kS0SxBZ9a8GsN27OjaFB9rgYlz5y');
        
        $token_arrs = [];
        $i = 0;
        foreach ($user_ids as $user_id) {
            $token = $this->Users_model->get_token_by($user_id);
            $token_arrs[$i]['token_id'] = $token['token_id'];
            $token_arrs[$i]['user_id'] = $user_id;
            $i++;
        }

        foreach ($token_arrs as $tok) {
            $msg = array(
                'title'=>$title,
                'body' => $description,
            );

            $fields = array(
                'to' => $tok['token_id'],
                'notification' => $msg
            );
        
            $this->Users_model->add_commonnotification($title, $description, $tok['user_id']);
            
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
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Message sent successfully', 'url' => base_url('notification')]));
        return FALSE;
    }

    /**
     * view view notification details
     *
     * @param  mixed $user_id
     *
     * @return void
     */
    public function view($user_id){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['datatable'] = 1;
        $data['title'] = 'View Notification';
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['notifications'] = $this->Users_model->get_notification($user_id);
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/notifications/notification-view');
        $this->load->view('admin/common-pages/footer');
    }
}
