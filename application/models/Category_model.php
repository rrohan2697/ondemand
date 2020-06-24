<?php
/**
 * Description of Category_model
 *
 * @author Mukesh Yadav
 */
class Category_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->reconnect();
    }

    public function get_category(){
        $this->db->order_by('id','DESC');
        $query = $this->db->get('od_category');
        return $query->result_array();
    }
    
    public function get_categorys_byid($id){
        $query = $this->db->get_where('od_category', ['id'=>$id]);
        return $query->row_array();
    }

    public function do_add_category($icon_url, $image_urls){
        $category_name = $this->security->xss_clean($this->input->post('category_name'));
        $category_url = $this->security->xss_clean($this->input->post('category_url'));
        $category_banner_name = $this->security->xss_clean($this->input->post('Category_banner_name'));
        $this->db->insert('od_category', ['category_name'=>$category_name,'category_url'=>$category_url,'category_banner_name' =>$category_banner_name, 'icon_url'=>$icon_url]);
        $category_id = $this->db->insert_id();
        if(!empty($category_id)) {
            $result = array(); $i=0;
            if(!empty($image_urls)){
                foreach($image_urls as $image_url){
                    $this->db->insert('od_category_banner', ['category_id'=>$category_id, 'image_url'=>$image_url]);
                    $result[$i] = $this->db->insert_id();
                }
                return $result;
            }else{
                return TRUE;
            }
        }
    }

    public function do_edit_category($icon_url, $id, $image_urls){
        $category_name = $this->security->xss_clean($this->input->post('category_name'));
        $category_url = $this->security->xss_clean($this->input->post('category_url'));
        $category_banner_name = $this->security->xss_clean($this->input->post('Category_banner_name'));
        $this->db->update('od_category', ['category_name'=>$category_name,'category_url'=>$category_url,'category_banner_name' =>$category_banner_name,'icon_url'=>$icon_url], ['id'=>$id]);
        $this->db->affected_rows();

        $result = array(); $i=0;
        if(!empty($image_urls)){
            foreach($image_urls as $image_url){
                $this->db->insert('od_category_banner', ['category_id'=>$id, 'image_url'=>$image_url]);
                $result[$i] = $this->db->insert_id();
            }
            return $result;
        }else{
            return TRUE;
        }
    }

    public function do_delete_category($id){
        $this->db->delete('od_category', ['id'=>$id]);
        $this->db->delete('od_subcategory', ['category_id'=>$id]);
        return $this->db->affected_rows();
    }

    public function chnage_status($category_id, $category_status){
        $this->db->update('od_users', ['status' => $category_status], ['id' => $category_id]);
        return $this->db->affected_rows();
    }

    public function get_category_banner($category_id){
        $this->db->select('id, category_id, image_url');
        $query = $this->db->get_where('od_category_banner', ['category_id'=>$category_id]);
        return $query->result_array();
    }

    public function get_subcategorys_byid($category_id){
        $this->db->select('id, category_id, icon_url');
        $query = $this->db->get_where('od_subcategory', ['category_id'=>$category_id]);
        return $query->result_array();
    }

    public function get_banners_byid($category_id){
        $this->db->select('id, category_id, image_url');
        $query =  $this->db->get_where('od_category_banner', ['category_id'=>$category_id]);
        return $query->result_array();
    }

    public function get_banner_images_byid($id){
        $this->db->select('id, category_id, image_url');
        $query =  $this->db->get_where('od_category_banner', ['id'=>$id]);
        return $query->row_array();
    }
    
     public function getcategorydata($id){
        $this->db->select('id,category_name,category_url,category_banner_name,icon_url');
        $this->db->from('od_category');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getBannerImg($id){
         $this->db->select('image_url');
        $query =  $this->db->get_where('od_category_banner', ['category_id'=>$id]);
        return $query->result_array();  
          }

    public function banner_images_delete($id){
        $this->db->delete('od_category_banner', ['id'=>$id]);
        return $this->db->affected_rows();
    }
}
