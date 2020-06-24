<?php
/**
 * Description of Services_model
 *
 * @author Mukesh Yadav
 */
class Services_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->reconnect();
    }

    public function get_service(){
        $this->db->select('ods.*,odc.id as category_id, odc.category_name');
        $this->db->from('od_services ods');
        $this->db->join('od_category odc','odc.id = ods.category_id');
        $this->db->order_by('ods.id','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_service_byid($id){
        $query = $this->db->get_where('od_services', ['id'=>$id]);
        return $query->row_array();
    }

    public function do_add_service($icon_url, $image_urls){
        $data = array(
            'category_id' => $this->security->xss_clean($this->input->post('category_name')),
            'subcategory_id' => $this->security->xss_clean($this->input->post('sub_category_name')),
            'service_title' => $this->security->xss_clean($this->input->post('service_title')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'time' => $this->security->xss_clean($this->input->post('time')),
            'recommended' => $this->security->xss_clean($this->input->post('recommended')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'icon_url' => $icon_url,
        );
        $this->db->insert('od_services', $data);
        $service_id = $this->db->insert_id();

        if(!empty($service_id)) {
            $result = array(); $i=0;
            if(!empty($image_urls)){
                foreach($image_urls as $image_url){
                    $this->db->insert('od_service_banner', ['service_id'=>$service_id, 'image_url'=>$image_url]);
                    $result[$i] = $this->db->insert_id();
                }
                return $result;
            }else{
                return true;
            }
        }
    }

    public function do_edit_service($icon_url, $id, $image_urls){
        $data = array(
            'category_id' => $this->security->xss_clean($this->input->post('category_name')),
            'subcategory_id' => $this->security->xss_clean($this->input->post('sub_category_name')),
            'service_title' => $this->security->xss_clean($this->input->post('service_title')),
            'price' => $this->security->xss_clean($this->input->post('price')),
            'time' => $this->security->xss_clean($this->input->post('time')),
            'recommended' => $this->security->xss_clean($this->input->post('recommended')),
            'description' => $this->security->xss_clean($this->input->post('description')),
            'icon_url' => $icon_url,
        );
        $this->db->update('od_services', $data, ['id'=>$id]);
        $this->db->affected_rows();
        
        if(!empty($image_urls)){
            $result = array(); $i=0;
            foreach($image_urls as $image_url){
                $this->db->insert('od_service_banner', ['service_id'=>$id, 'image_url'=>$image_url]);
                $result[$i] = $this->db->insert_id();
            }
            return $result;
        }else{
            return true;
        }
    }

    public function chnage_status($user_id, $user_status){
        $this->db->update('od_services', ['status' => $user_status], ['id' => $user_id]);
        return $this->db->affected_rows();
    }

    public function do_delete_service($id){
        $this->db->delete('od_service_banner', ['service_id'=>$id]);
        $this->db->delete('od_services', ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function get_banners_byid($id){
        $this->db->select('id, image_url');
        $query = $this->db->get_where('od_service_banner', ['service_id'=>$id]);
        return $query->result_array();
    }

    public function get_banner_images_byid($id){
        $this->db->select('id, service_id, image_url');
        $query = $this->db->get_where('od_service_banner', ['id'=>$id]);
        return $query->row_array();
    }

    public function banner_images_delete($id){
        $this->db->delete('od_service_banner', ['id'=>$id]);
        return $this->db->affected_rows();
    }
     public function get_servicedetail($id){
        $this->db->select('ods.*,odc.category_name,odsc.subcategory_name');
        $this->db->from('od_services ods');
        $this->db->join('od_category odc','odc.id = ods.category_id');
        $this->db->join('od_subcategory odsc','odsc.id = ods.subcategory_id');
        $this->db->where('ods.id',$id);
        $query = $this->db->get();
        return $query->row_array();

    }
    public function getServiceBannerImg($id){
         $this->db->select('image_url');
        $query = $this->db->get_where('od_service_banner', ['service_id'=>$id]);
        return $query->result_array();
    }
    public function changeSubcategoryData($category_id){
        $this->db->select('c.id,c.subcategory_name');
        $this->db->from('od_subcategory c');
        $this->db->where('c.category_id', $category_id);
        $this->db->order_by('c.id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
}
