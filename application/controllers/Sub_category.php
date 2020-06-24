<?php
/**
 * Description of Sub-Category Controller
 *
 * @author Mukesh Yadav
 */
defined('BASEPATH') or die('Not Allowed');

class Sub_category extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        parent::__construct();
        $this->load->model(['Sub_category_model','Admin_model', 'Category_model']);
    }

    /**
     * index function listing of sub category 
     *
     * @return void
     */
    public function index(){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        $data['title'] = 'Sub-Categorys Management';
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['sub_categorys'] = $this->Sub_category_model->get_sub_category(); 
         $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/sub-category/sub-category-list');
        $this->load->view('admin/common-pages/footer');
    }
    
    /**
     * add add sub category view here
     *
     * @param  mixed $id
     * @return void
     */
    public function add($id = NULL){
        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
        if(!empty($id)){
            $data['title'] = 'Edit Sub-Category';  
            $data['sub_category'] = $this->Sub_category_model->get_sub_categorys_byid($id);  
        }else{
            $data['title'] = 'Add Sub-Category';
        }
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $data['categorys'] = $this->Category_model->get_category();
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/sub-category/sub-category-add');
        $this->load->view('admin/common-pages/footer');
    }
        
    /**
     * do_add_sub_category add sub category here
     *
     * @return void
     */
    public function do_add_sub_category(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('sub_category_name', 'Sub_Category Name', 'trim|required|is_unique[od_subcategory.subcategory_name]');
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
        $results = $this->Sub_category_model->do_add_sub_category($icon_url);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Subcategory Added Successfully.', 'url' => base_url('sub-category')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Subcategory Not Added.']));
            return FALSE;
        }
    }
    
    /**
     * do_edit_sub_category update sub category here
     *
     * @param  mixed $id
     * @return void
     */
    public function do_edit_sub_category($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('sub_category_name', 'Sub_Category Name', 'trim|required');
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
            $result =$this->Sub_category_model->get_sub_categorys_byid($id);
            $icon_url = $result['icon_url'];
        }
        $results = $this->Sub_category_model->do_edit_sub_category($icon_url, $id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Subcategory Updated Successfully.', 'url' => base_url('sub-category')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Subcategory Not Updated.']));
            return FALSE;
        }
    }
    
    /** 
     * do_delete_sub_category delete sub category here
     *
     * @param  mixed $id
     * @return void
     */
    public function do_delete_sub_category($id){
        $this->output->set_content_type('application/json');
        $results = $this->Sub_category_model->do_delete_sub_category($id);
        if (!empty($results)) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Subcategory Deleted Successfully.', 'url' => base_url('sub-category')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Deleted not successfully.']));
            return FALSE;
        }
    }
    
    /**
     * change_status change category status here
     *
     * @param  mixed $id
     * @return void
     */
    public function change_status($id){
        $this->output->set_content_type('application/json');
        if (empty($this->session->userdata('admin_emailid'))) {
            redirect(base_url('admin/login'));
        }
        $data['admin_info'] = $this->Admin_model->get_admin($this->session->userdata('admin_emailid'));
        $subcategory_status = $this->input->post('selt');
        $changed = $this->Sub_category_model->chnage_status($id, $subcategory_status);
        if (!empty($changed)) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('users'), 'msg' => 'Status successfully updated.!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Status not successfully  updated.!']));
            return FALSE;
        }
    }
    
    /**
     * doUploadImg upload images here
     *
     * @return void
     */
    function doUploadImg(){
        $config = array(
            'upload_path' => "./uploads/sub-category-icon/",
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
     public function view($id){

        if ($this->session->userdata('admin_emailid') === null) {
            redirect(base_url('admin/login'));
        }
            $data['title'] = 'SubCategory Detail';  
            $data['subcategory'] = $this->Sub_category_model->getsubcategorydata($id); 
           // print_r($data['subcategory']);die;
        
        $data['datatable'] = 1;
        $data['notications'] = $this->Admin_model->countnotification();
        $admin_info = $this->session->userdata('admin_emailid');
        $data['admin_info'] = $this->Admin_model->get_admin($admin_info);
        $this->load->view('admin/common-pages/header', $data);
        $this->load->view('admin/common-pages/sidebar');
        $this->load->view('admin/sub-category/subcategory-detail');
        $this->load->view('admin/common-pages/footer');
    }
}
