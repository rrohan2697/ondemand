<?php
/**
 * Description of Users Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Users extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        parent::__construct();
        $this->load->model(['Users_model','Admin_model']);
    }

    /**
     * index function listing of users 
     *
     * @return void
     */
    public function index(){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Users Management';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['users'] = $this->Users_model->get_users(); 
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/users/users-list');
        $this->load->view('admin/common-pages/footer');
    }
    
    /**
     * change_status change user status here
     *
     * @param  mixed $user_id
     * @return void
     */
    public function change_status($user_id){
        $this->output->set_content_type('application/json');
        if (empty($this->session->userdata('admin_emailid'))) {
            redirect(base_url('admin/login'));
        }
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $user_status = $this->input->post('selt');
        $changed = $this->Users_model->chnage_status($user_id, $user_status);
        if (!empty($changed)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('users'), 'msg' => 'Status successfully updated.!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Status not successfully  updated.!']));
            return FALSE;
        }
    }
    
    /* view user details */
    
     public function view_user_detail($id){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Users Management';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['usersdetail'] = $this->Users_model->view_user_detail($id);
        $data['user_address'] = $this->Users_model->get_user_address($data['usersdetail']['id']);
        //print_r($data['user_address']);die;
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/users/user-detail');
        $this->load->view('admin/common-pages/footer');
    }
    
     public function contactUs(){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Contact';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['users'] = $this->Users_model->get_contactus(); 
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/contact/contact-list');
        $this->load->view('admin/common-pages/footer');
    }
     public function sociallink($id = NULL){
        if(empty($this->session->userdata('admin_emailid'))){
            redirect(base_url('admin/login'));
        }
        if(!empty($id)){
            $data['social'] = $this->Users_model->social_byid($id);
            //print_r($data['social']);die;
        }
        $data['title'] = 'Social';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/social/social');
        $this->load->view('admin/common-pages/footer');
    }

    public function social_wrapper(){
        $this->output->set_content_type('application/json');
        $data['social'] = $this->Users_model->get_social();

        $content_wrapper = $this->load->view('admin/social/social-wrapper',$data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function do_edit_social($id){
         $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('social_link', 'Social Link', 'trim|required|valid_url');
       
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $results = $this->Users_model->do_edit_time_slot($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Updated successfully.', 'url' => base_url('users/sociallink/')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Updated.']));
            return FALSE;
        }
    }
    
    public function do_add_social(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('social_link', 'Social Link', 'trim|required|valid_url');
       
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $results = $this->Users_model->do_add_social();
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Added Successfull.', 'url' => base_url('users/sociallink/')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Added.']));
            return FALSE;
        }
    }

    public function do_delete_social($id){
        $this->output->set_content_type('application/json');
        $results = $this->Users_model->do_delete_social($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Deleted successful.', 'url' => base_url('users/sociallink/')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Deleted not successfully.']));
            return FALSE;
        }
    }
}
