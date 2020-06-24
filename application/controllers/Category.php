<?php
/**
 * Description of Category Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Category extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        parent::__construct();
        $this->load->model(['Category_model','Admin_model']);
    }

    /**
     * index function listing of category 
     *
     * @return void
     */
    public function index(){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Categorys Management';
        $data['datatable'] = 1;
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['notications'] = $this->Admin_model->countnotification();
        $data['categorys'] = $this->Category_model->get_category(); 
         $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/category/category-list');
        $this->load->view('admin/common-pages/footer');
    }
    
    /**
     * add category add and edit view 
     *
     * @param  mixed $id
     * @return void
     */
    public function add($id = NULL){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        if(!empty($id)){
            $data['title'] = 'Edit Category';  
            $data['category'] = $this->Category_model->get_categorys_byid($id);  
        }else{
            $data['title'] = 'Add Category';
        }
        $data['datatable'] = 1;
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['notications'] = $this->Admin_model->countnotification();
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/category/category-add');
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
        $data['images'] = $this->Category_model->get_banners_byid($id);
        $data['category']=1;
        $content_wrapper = $this->load->view('admin/category/banner-image-warpper',$data, true);
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
        $results = $this->Category_model->get_banner_images_byid($id);
        $category_id = $results['category_id'];
        if(!empty($results['image_url'])){
            unlink('./uploads/category-banner-images/'.$results['image_url']);
        }
        $results = $this->Category_model->banner_images_delete($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Deleted successful.', 'url' => base_url('category/add/'.$category_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Deleted not successfully.']));
            return FALSE;
        }
    }

    /**
     * do_add_category add category here
     *
     * @return void
     */
    public function do_add_category(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|is_unique[od_category.category_name]');
         $this->form_validation->set_rules('category_url', 'Category Url', 'trim|required');
        $this->form_validation->set_rules('Category_banner_name', 'Category Banner Name', 'trim|required');
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

        $results = $this->Category_model->do_add_category($icon_url, $image_url);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Added Successfully.', 'url' => base_url('category')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Added.']));
            return FALSE;
        }
    }
    
    /**
     * do_edit_category edit category here
     *
     * @param  mixed $id
     * @return void
     */
    public function do_edit_category($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('category_url', 'Category Url', 'trim|required');
        $this->form_validation->set_rules('Category_banner_name', 'Category Banner Name', 'trim|required');
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
            $result =$this->Category_model->get_categorys_byid($id);
            $icon_url = $result['icon_url'];
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
            $image_url = '';
        }

        $results = $this->Category_model->do_edit_category($icon_url, $id, $image_url);
        if (!empty($results || $banner_results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Updated Successfully.', 'url' => base_url('category')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Not Updated.']));
            return FALSE;
        }
    }
    
      public function view($id){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Category Detail';  
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
         $data['category'] = $this->Category_model->getcategorydata($id);
        $data['banner'] = $this->Category_model->getBannerImg($data['category']['id']);
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/category/categorydetail');
        $this->load->view('admin/common-pages/footer');
    }

    public function do_delete_category($id){
        $this->output->set_content_type('application/json');
        $category = $this->Category_model->get_categorys_byid($id);
        if(!empty($category)){
            unlink("./uploads/category-icon/".$category['icon_url']);
            
            $bannerImages = $this->Category_model->get_category_banner($category['id']);
            if(!empty($bannerImages)){
                foreach($bannerImages as $bannerImage){
                    unlink("./uploads/category-banner-images/".$bannerImage['image_url']);
                }
            }
            $subcategorys = $this->Category_model->get_subcategorys_byid($category['id']);
            if(!empty($subcategorys)){
                foreach($subcategorys as $subcategory){
                    unlink("./uploads/sub-category-icon/".$subcategory['icon_url']);
                }
            }
        }
        
        $results = $this->Category_model->do_delete_category($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Category Deleted Successfully.', 'url' => base_url('category')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Deleted not successfully.']));
            return FALSE;
        }
    }

    /**
     * change_status change category status here
     *
     * @param  mixed $category_id
     * @return void
     */
    public function change_status($category_id){
        $this->output->set_content_type('application/json');
        if (empty($this->session->userdata('admin_emailid'))) {
            redirect(base_url('admin/login'));
        }
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $category_status = $this->input->post('selt');
        $changed = $this->Category_model->chnage_status($category_id, $category_status);
        if (!empty($changed)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('users'), 'msg' => 'Status successfully updated.!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Status not successfully  updated.!']));
            return FALSE;
        }
    }
    
    /**
     * doUploadImg upload category icon 
     *
     * @return void
     */
    function doUploadImg(){
        $config = array(
            'upload_path' => "./uploads/category-icon/",
            'allowed_types' => 'jpeg|jpg|png',
            'remove_spaces' => TRUE,
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
     * doUploadBannerImage upload muliple category banner images 
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
                    move_uploaded_file($value['tmp_name'][$s], './uploads/category-banner-images/'. $file_name);
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
    // public function doUploadBannerImage() {
    //     $this->load->library('upload');
    //     $files = $_FILES;
    //     $count = count($_FILES['images_url']['name']);
    //     for($i=0; $i<$count; $i++)
    //     {
    //         $_FILES['images_url']['name']= $files['images_url']['name'][$i];
    //         $_FILES['images_url']['type']= $files['images_url']['type'][$i];
    //         $_FILES['images_url']['tmp_name']= $files['images_url']['tmp_name'][$i];
    //         $_FILES['images_url']['error']= $files['images_url']['error'][$i];
    //         $_FILES['images_url']['size']= $files['images_url']['size'][$i];
    //         $this->upload->initialize($this->set_upload_options());//function defination below
    //         $this->upload->do_upload('images_url');
    //         $upload_data = $this->upload->data();
    //         $name_array[] = $upload_data['file_name'];
    //         $fileName = $upload_data['file_name'];
    //         $images[] = $fileName;
    //     }
    //     return $fileName = $images;
    // }

    // function set_upload_options()
    // { 
    //     $config = array();
    //     $config['upload_path'] = './uploads/category-banner-images'; //give the path to upload the image in folder
    //     $config['remove_spaces']=TRUE;
    //     $config['encrypt_name'] = TRUE; // for encrypting the name
    //     $config['allowed_types'] = 'jpeg|jpg|png';
    //     $config['max_size'] = '2048';
    //     $config['overwrite'] = FALSE;
    //     return $config;
    // }
}
