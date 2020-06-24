<?php
/**
 * Description of Services Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Services extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        parent::__construct();
        $this->load->model(['Services_model','Admin_model','Category_model', 'Sub_category_model']);
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
        $data['title'] = 'Services Management';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['services'] = $this->Services_model->get_service(); 
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/services/service-list');
        $this->load->view('admin/common-pages/footer');
    }

    
    /**
     * add Add and Edit service view
     *
     * @param  mixed $id
     * @return void
     */
    public function add($id = NULL){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        if(!empty($id)){
            $data['title'] = 'Edit Service';  
            $data['service'] = $this->Services_model->get_service_byid($id);  
        }else{
            $data['title'] = 'Add Service';
        }
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['categorys'] = $this->Category_model->get_category();
        $data['subcategorys'] = $this->Sub_category_model->get_sub_category();
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/services/services-add');
        $this->load->view('admin/common-pages/footer');
    }
    
    /**
     * banner_image_wrapper banner image wrapper
     *
     * @param  mixed $id
     * @return void
     */
    public function banner_image_wrapper($id){
        $this->output->set_content_type('application/json');
        $data['images'] = $this->Services_model->get_banners_byid($id);
        $content_wrapper = $this->load->view('admin/services/banner-image-warpper',$data, true);
        $this->output->set_output(json_encode(['result' => 1, 'content_wrapper' => $content_wrapper]));
        return FALSE;
    }
    
    /**
     * banner_images_delete delete banner image by id
     *
     * @param  mixed $id
     * @return void
     */
    public function banner_images_delete($id){
        $this->output->set_content_type('application/json');
        $results = $this->Services_model->get_banner_images_byid($id);
        $service_id = $results['service_id'];
        if(!empty($results['image_url'])){
            unlink('./uploads/service-banner-images/'.$results['image_url']);
        }
        $results = $this->Services_model->banner_images_delete($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Deleted successful.', 'url' => base_url('services/add/'.$service_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Deleted not successfully.']));
            return FALSE;
        }
    }
        
    /**
     * do_add add service here
     *
     * @return void
     */
    public function do_add(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('sub_category_name', 'Sub_Category Name', 'trim|required');
        $this->form_validation->set_rules('service_title', 'Service Title', 'trim|required|is_unique[od_services.service_title]');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('time', 'Time', 'trim|required');
        $this->form_validation->set_rules('recommended', 'Recommended', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['icon_url']['name'])) {
        $icon_url = $this->doUploadImg();
            if (!$icon_url) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
            $this->session->unset_userdata('error');
            return FALSE;
            }
        }else {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => ['icon_url' => 'Image Field required.!']]));
            return FALSE;
        }

        if (!empty($_FILES['images_url']['name']['0'])) {
            $image_url = $this->doUploadBannerImage();
            if (!$image_url) {
                $errors = $this->session->userdata('error');
                $this->session->unset_userdata('error');
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $errors]));
                return FALSE;
            }
        } else {
            $errors = ['images_url' => 'Please upload banner image.'];
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $errors]));
            return FALSE;
        }

        $results = $this->Services_model->do_add_service($icon_url, $image_url);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Services Added Successfully.', 'url' => base_url('services')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Services Not Added.']));
            return FALSE;
        }
    }
    
    /**
     * do_edit edit service info
     *
     * @param  mixed $id
     * @return void
     */
    public function do_edit($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('sub_category_name', 'Sub_Category Name', 'trim|required');
        $this->form_validation->set_rules('service_title', 'Service Title', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('time', 'Time', 'trim|required');
        $this->form_validation->set_rules('recommended', 'Recommended', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['icon_url']['name'])) {
            $icon_url = $this->doUploadImg();
            if (!$icon_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $result =$this->Services_model->get_service_byid($id);
            if(!empty($result['icon_url'])){
               $icon_url = $result['icon_url']; 
            }else{
               $icon_url = '';
            }
        }

        if (!empty($_FILES['images_url']['name']['0'])) {
            $image_url = $this->doUploadBannerImage();
            if (!$image_url) {
                $errors = $this->session->userdata('error');
                $this->session->unset_userdata('error');
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $errors]));
                return FALSE;
            }
        } else {
            $image_url='';
        }

        $results = $this->Services_model->do_edit_service($icon_url, $id, $image_url);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Services Updated Successfully.', 'url' => base_url('services')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Services Not Updated.']));
            return FALSE;
        }
    }

    /**
     * change_status change service status here
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
        $changed = $this->Services_model->chnage_status($service_id, $user_status);
        if (!empty($changed)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('services'), 'msg' => 'Status successfully updated.!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Status not successfully  updated.!']));
            return FALSE;
        }
    }
    
    /**
     * do_delete delete service here
     *
     * @param  mixed $id
     * @return void
     */
    public function do_delete($id){
        $this->output->set_content_type('application/json');
        $result = $this->Services_model->get_service_byid($id);

        if(!empty($result['icon_url'])){
            unlink('./uploads/service-icon/'.$result['icon_url']);
        }
        if(!empty($result['id'])){
            $images = $this->Services_model->get_banners_byid($id);
            if(!empty($images)){
                foreach($images as $image){                    
                    if(!empty($image['image_url'])){
                        unlink('./uploads/service-banner-images/'.$image['image_url']);
                    }
                }
            }
        }
        $results = $this->Services_model->do_delete_service($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Services Deleted Successfully.', 'url' => base_url('services')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Deleted not Successfully.']));
            return FALSE;
        }
    }
     public function view($id){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Services Detail';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['servicesdata'] = $this->Services_model->get_servicedetail($id); 
        $data['servicebannerImg'] = $this->Services_model->getServiceBannerImg($data['servicesdata']['id']);
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/services/service-detail');
        $this->load->view('admin/common-pages/footer');
    }
    
    public function changesubcategory(){
        $this->output->set_content_type('application/json');
        $category_id = $this->input->post('category_id');
        $data['subcategorys'] = $this->Services_model->changeSubcategoryData($category_id);
       // print_r($data['subcategorys']);die;
        $contentWrapper = $this->load->view('admin/services/subcategory', $data, true);
        $this->output->set_output(json_encode(['contentWrapper' => $contentWrapper]));
        return FALSE;
    }
        
    /**
     * doUploadImg upload service image form here
     *
     * @return void
     */
    function doUploadImg(){
        $config = array(
            'upload_path' => "./uploads/service-icon/",
            'allowed_types' => 'png|jpg|jpeg',
            'file_name' => rand(11111, 99999),
            'remove_spaces'=>TRUE,
            'encrypt_name' => TRUE,
            'max_size' => "2048" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('icon_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['icon_url' => $this->upload->display_errors()]);
            return 0;
        }
    }
        
    /**
     * doUploadBannerImage upload multiple banner Images
     *
     * @return void
     */
      public function doUploadBannerImage() {
        $this->load->library('upload');
        $count = count($_FILES['images_url']['size']);
        $this->session->unset_userdata('error');
        if(empty($_FILES['images_url']['name'][0])){
            $this->session->set_userdata('error', array('images_url' => 'Please Upload Image'));
            return false;
        }
        $image = [];
        $ext = array('png', 'jpg', 'jpeg');
        $i = 1;
        foreach ($_FILES as $key => $value) {
             if($key == 'images_url'){
            for ($s = 0; $s < $count; $s++) {
                $ext1 = strtolower(pathinfo($value['name'][$s], PATHINFO_EXTENSION));
                if(in_array($ext1, $ext)){
                    $maxsize    = 2097152;
                    if(($value['size'][$s] >= $maxsize) || ($value['size'][$s] == 0)) {
                        $this->session->set_userdata('error', array('images_url' => 'File too large. File must be less than 2 megabytes.'));
                        return false; 
                    }

                    $file_name = rand(1, 99999).".".$ext1;
                    move_uploaded_file($value['tmp_name'][$s], './uploads/service-banner-images/'. $file_name);
                    $image[$s] = $file_name;
                }else{

                   $this->session->set_userdata('error', array('images_url' => 'Invalid file type. Only JPG, JPEG and PNG types are accepted.'));
                   return false; 
                }
            }
        }
        }
        return $image;
    }
}
