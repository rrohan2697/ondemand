<?php
/**
 * Description of Services Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Service_provider extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        parent::__construct();
        $this->load->model(['Service_provider_model','Admin_model','Category_model', 'Sub_category_model']);
    }

    /**
     * index function listing of Service provider 
     *
     * @return void
     */
    public function index(){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Service Providers Mgmt';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['service_providers'] = $this->Service_provider_model->get_service_provider(); 
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/service-provider/service-provider-list');
        $this->load->view('admin/common-pages/footer');
    }


    public function add($id = NULL){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        if(!empty($id)){
            $data['title'] = 'Edit Service Provider';  
            $data['service'] = $this->Service_provider_model->get_service_byid($id);  
        }else{
            $data['title'] = 'Add Service Provider';
        }
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['categorys'] = $this->Category_model->get_category();
        $data['subcategorys'] = $this->Sub_category_model->get_sub_category();
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/service-provider/service-provider-add');
        $this->load->view('admin/common-pages/footer');
    }
    
    public function do_add(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('sub_category_name', 'Sub_Category Name', 'trim|required');
        $this->form_validation->set_rules('name', 'Service Provider Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required');
        $this->form_validation->set_rules('addressline1', 'Address Line1', 'trim|required');
        $this->form_validation->set_rules('addressline2', 'Address Line2', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('postcode', 'Post Code', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['profile_url']['name'])) {
        $profile_url = $this->doUploadImg();
            if (!$profile_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
            }
        }else {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => ['profile_url' => 'Image Field required.!']]));
            return FALSE;
        }
        $results = $this->Service_provider_model->do_add_service($profile_url);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service provider Added Successfully.', 'url' => base_url('service-provider')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Service provider Not Added.']));
            return FALSE;
        }
    }

    public function do_edit($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('sub_category_name', 'Sub_Category Name', 'trim|required');
        $this->form_validation->set_rules('name', 'Service Provider Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email');
        $this->form_validation->set_rules('email', 'Phone Number', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['profile_url']['name'])) {
            $profile_url = $this->doUploadImg();
            if (!$profile_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $result =$this->Service_provider_model->get_service_byid($id);
            if(!empty($result['profile_url'])){
               $profile_url = $result['profile_url']; 
            }else{
               $profile_url = '';
            }
        }
        $results = $this->Service_provider_model->do_edit_service($profile_url, $id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Service provider Updated Successfully.', 'url' => base_url('service-provider')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Service provider Not Updated.']));
            return FALSE;
        }
    }
    
    /**
     * doUploadImg upload images form here
     *
     * @return void
     */
    function doUploadImg(){
        $config = array(
            'upload_path' => "./uploads/service-provider-profile/",
            'allowed_types' => 'png|jpg|jpeg',
            'file_name' => rand(11111, 99999),
            'remove_spaces'=>TRUE,
            'encrypt_name' => TRUE,
            'max_size' => "2048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('profile_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['profile_url' => $this->upload->display_errors()]);
            return 0;
        }
    }

    /**
     * change_status change user status here
     *
     * @param  mixed $service_id
     * @return void
     */
    public function change_status($service_id){
        $this->output->set_content_type('application/json');
        if (empty($this->session->userdata('admin_emailid'))) {
            redirect(base_url('admin/login'));
        }
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $user_status = $this->input->post('selt');
        $changed = $this->Service_provider_model->chnage_status($service_id, $user_status);
        if (!empty($changed)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('service-provider'), 'msg' => 'Status successfully updated.!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Status not successfully  updated.!']));
            return FALSE;
        }
    }
    
    /**
     * do_delete delete service provider here
     *
     * @param  mixed $id
     * @return void
     */
    public function do_delete($id){
        $this->output->set_content_type('application/json');
        $result = $this->Service_provider_model->get_service_byid($id);
        if(!empty($result['profile_url'])){
            unlink('./uploads/service-provider-profile/'.$result['profile_url']);
        }
        $results = $this->Service_provider_model->do_delete_service($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Deleted Successfully.', 'url' => base_url('service-provider')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Deleted not successfully.']));
            return FALSE;
        }
    }
    
     public function view($id){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        } 
        $data['title'] = 'Service Providers Mgmt';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
         $data['serviceprovider'] = $this->Service_provider_model->get_service_providerbyid($id);
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/service-provider/service-provider-detail');
        $this->load->view('admin/common-pages/footer');
    }
}
