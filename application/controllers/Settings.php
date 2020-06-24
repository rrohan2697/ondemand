<?php
/**
 * Description of Settings Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Settings extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
        $this->load->model(['Settings_model','Admin_model']);
    }

    public function index(){
        redirect(base_url('admin/login'));
    }
    
    /**
     * terms_conditions function for view term & condtion 
     *
     * @return void
     */
    public function terms_conditions(){
        if($this->session->userdata('admin_emailid') === NULL){
            redirect(base_url('admin/login'));
        }
        $data['editor'] = 1;
        $data['title'] = 'Terms and Conditions';
        $type = 2;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['term_condition'] = $this->Settings_model->get_websettings($type);
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/web-settings/term-and-condition');
        $this->load->view('admin/common-pages/footer');
    }

    /**
     * edit_term_condition function for edit term & condition
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function edit_term_condition($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('content_description', 'Description', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }

        $result = $this->Settings_model->edit_term_condition($id);
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('settings/terms-conditions'), 'msg' => 'Term Condition Updated Successfully']));
            return FALSE;
            
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Updated']));
            return FALSE;
        }
    }

    /**
     * about_us function using view about us 
     *
     * @return void
     */
    public function about_us(){
        if($this->session->userdata('admin_emailid') === NULL){
            redirect(base_url('admin/login'));
        }
        $data['editor'] = 1;
        $data['title'] = 'About-us';
        $type = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['about_us'] = $this->Settings_model->get_websettings($type);
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/web-settings/about-us');
        $this->load->view('admin/common-pages/footer');
    }

    /**
     * edit_about_us function use for edit about use data
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function edit_about_us($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('content_description', 'Description', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Settings_model->edit_term_condition($id);
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('settings/about-us'), 'msg' => 'About Us Updated Successfully']));
            return FALSE;
            
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Updated']));
            return FALSE;
        }
    }

    /**
     * faqs lists
     *
     * @return void
     */
    public function faqs(){
        if(empty($this->session->userdata('admin_emailid'))){
            redirect(base_url('admin/login'));
        }
        $data['title'] = "FAQ's";
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $data['faqs'] = $this->Settings_model->get_faqs();
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/web-settings/faqs-list');
        $this->load->view('admin/common-pages/footer');
    }

    /**
     * add_faq using function Add/Edit FAQ's view
     *
     * @param  mixed $faq_id
     *
     * @return void
     */
    public function faqs_add($faq_id = NULL){
        if(empty($this->session->userdata('admin_emailid'))){
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Add FAQ\'s';

        if(!empty($faq_id)){
            $data['title'] = 'Edit FAQ\'s';
            $data['faqs'] = $this->Settings_model->get_faqs_byid($faq_id);
        }
        $data['editor'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/web-settings/faqs-add');
        $this->load->view('admin/common-pages/footer');
    }
    
    /**
     * do_add_faq using function add FAQ's
     *
     * @return void
     */
    public function do_add_faqs(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('title', 'FAQ\'s Title', 'trim|required|is_unique[od_faqs.title]');
        $this->form_validation->set_rules('description', 'FAQ\'s Description', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Settings_model->do_add_faq();
        
        if (!empty($result)) {

            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('settings/faqs'), 'msg' => 'Faq Added Successfully.']));
            return FALSE;
            
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Added not successful.']));
            return FALSE;
        }
    }
    
    /**
     * do_edit_faq using function update FAQ's by ID
     *
     * @param  mixed $faq_id
     *
     * @return void
     */
    public function do_edit_faqs($faq_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('title', 'FAQ\'s Heading', 'trim|required');
        $this->form_validation->set_rules('description', 'FAQ\'s Description', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Settings_model->do_edit_faq($faq_id);
        
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('settings/faqs'), 'msg' => 'Faq Updated Successfully.']));
            return FALSE;
            
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Updated.']));
            return FALSE;
        }
    }
    
    /**
     * do_delete_faq delete FAQ by ID
     *
     * @param  mixed $faq_id
     *
     * @return void
     */
    public function do_delete_faqs($faq_id){
        $this->output->set_content_type('application/json');
        $result = $this->Settings_model->faq_delete($faq_id);
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('settings/faqs'), 'msg' => 'Faq Deleted Successfully.']));
            return FALSE;
            
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Deleted not successful.']));
            return FALSE;
        }
    }
    
    /**
     * banner_images banner image management here
     *
     * @param  mixed $id
     * @return void
     */
    public function banner_images($id = NULL){
        if(empty($this->session->userdata('admin_emailid'))){
            redirect(base_url('admin/login'));
        }
        if(!empty($id)){
            $data['images'] = $this->Settings_model->get_images_byid($id);
        }
        $data['title'] = 'Banner Images';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/web-settings/banner-images');
        $this->load->view('admin/common-pages/footer');
    }
    
    /**
     * banner_images_wrapper banner image warpper here
     *
     * @return void
     */
    public function banner_images_wrapper(){
        $this->output->set_content_type('application/json');
        $data['images'] = $this->Settings_model->get_banner_images();
        $content_wrapper = $this->load->view('admin/web-settings/banner-images-wrapper',$data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    /**
     * do_edit_banner_images edit banner images here
     *
     * @param  mixed $id
     * @return void
     */
    public function do_edit_banner_images($id){
        $this->output->set_content_type('application/json');
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadImg();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $result =$this->Settings_model->get_images_byid($id);
            $image_url = $result['image_url'];
        }
        $results = $this->Settings_model->do_edit_banner_images($image_url,$id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Updated Successfully.', 'url' => base_url('settings/banner-images')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Updated.']));
            return FALSE;
        }
    }
    
    /**
     * do_add_banner_images banner 
     *
     * @return void
     */
    public function do_add_banner_images(){
        $this->output->set_content_type('application/json');
        if (!empty($_FILES['image_url']['name'])) {
           $image_url = $this->doUploadImg();
            if (!$image_url) {
               $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
               $this->session->unset_userdata('error');
               return FALSE;
            }
        }else {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => ['image_url' => 'Image Field required.!']]));
            return FALSE;
        }
        $results = $this->Settings_model->do_add_banner_images($image_url);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Added Successfully.', 'url' => base_url('settings/banner-images')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Added.']));
            return FALSE;
        }
    }

    public function do_delete_banner_images($id){
        $this->output->set_content_type('application/json');
        $result =$this->Settings_model->get_images_byid($id);
        if(!empty($result['image_url'])){
            unlink('./uploads/main-banner-images/'.$result['image_url']);
        }
        $results = $this->Settings_model->do_delete_banner_images($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Deleted successful.', 'url' => base_url('settings/banner-images')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Deleted not successfully.']));
            return FALSE;
        }
    }

    public function change_status($id,$status){
        $this->output->set_content_type('application/json');
        $results = $this->Settings_model->change_status($id,$status);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Status Change Successfully.', 'url' => base_url('settings/banner-images')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Status not Change Successfully.']));
            return FALSE;
        }
    }

    function doUploadImg(){
       $config = array(
           'upload_path' => "./uploads/main-banner-images/",
           'allowed_types' => 'png|jpg|jpeg',
           'file_name' => rand(11111, 99999),
           'remove_spaces'=>TRUE,
           'encrypt_name' => TRUE,
           'max_size' => "2048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
       );
       $this->load->library('upload', $config);
       if ($this->upload->do_upload('image_url')) {
           $data = $this->upload->data();
           return $data['file_name'];
       } else {
           $this->session->set_userdata('error', ['image_url' => $this->upload->display_errors()]);
           return 0;
       }
    }

    public function service_charges($id = NULL){
        if(empty($this->session->userdata('admin_emailid'))){
            redirect(base_url('admin/login'));
        }
        if(!empty($id)){
            $data['services'] = $this->Settings_model->get_charges_byid($id);
        }
        $data['title'] = 'Service Charges';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $data['charges'] = $this->Settings_model->get_service_charges();
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/web-settings/service-charges');
        $this->load->view('admin/common-pages/footer');
    }

    public function do_edit_service_charges($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('delivery_charge', 'Delivery Charge', 'trim|required');
        $this->form_validation->set_rules('tax_charge', 'Tax Charge', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->Settings_model->do_edit_service_charges($id);
        
        if (!empty($result)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('settings/service-charges'), 'msg' => 'Service Charge Updated Successfully.']));
            return FALSE;
            
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Updated.']));
            return FALSE;
        }
    }

    public function time_slots($id = NULL){
        if(empty($this->session->userdata('admin_emailid'))){
            redirect(base_url('admin/login'));
        }
        if(!empty($id)){
            $data['times'] = $this->Settings_model->time_slot_byid($id);
        }
        $data['title'] = 'Time Slots';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/web-settings/time-slot');
        $this->load->view('admin/common-pages/footer');
    }

    public function time_slot_wrapper(){
        $this->output->set_content_type('application/json');
        $data['times'] = $this->Settings_model->get_time_slot();
        $content_wrapper = $this->load->view('admin/web-settings/time-slot-wrapper',$data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }

    public function do_edit_time_slot($id){
        $this->output->set_content_type('application/json');
        
        $results = $this->Settings_model->do_edit_time_slot($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Time Slot Updated Successfully.', 'url' => base_url('settings/time-slots')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Updated.']));
            return FALSE;
        }
    }
    
    public function do_add_time_slot(){
        $this->output->set_content_type('application/json');
        $results = $this->Settings_model->do_add_time_slot();
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Time Slot Added Successfully.', 'url' => base_url('settings/time-slots')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Added.']));
            return FALSE;
        }
    }

    public function do_delete_time_slot($id){
        $this->output->set_content_type('application/json');
        $results = $this->Settings_model->do_delete_time_slot($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Time Slot Deleted Successfully.', 'url' => base_url('settings/time-slots')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Deleted not Successfully.']));
            return FALSE;
        }
    }
    
    public function change_statustimeslot($id,$status){
        $this->output->set_content_type('application/json');
        $results = $this->Settings_model->change_statustimeslot($id,$status);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Status Change Successfully.', 'url' => base_url('settings/time-slots/')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Status not Change Successfully.']));
            return FALSE;
        }
    }
}
