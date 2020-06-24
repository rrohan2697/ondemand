<?php
/**
 * Description of Sub-Category_model
 *
 * @author Mukesh Yadav
 */
class Sub_category_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->reconnect();
    }

    public function get_sub_category(){
        $this->db->select('ods.id, ods.category_id, ods.subcategory_name, ods.icon_url, ods.status, odc.category_name');
        $this->db->from('od_subcategory ods');
        $this->db->join('od_category odc','odc.id = ods.category_id');
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_sub_categorys_byid($id){
        $query = $this->db->get_where('od_subcategory', ['id'=>$id]);
        return $query->row_array();
    }

    public function do_add_sub_category($icon_url){
        $data = array(
            'category_id' => $this->security->xss_clean($this->input->post('category_name')),
            'subcategory_name' => $this->security->xss_clean($this->input->post('sub_category_name')),
            'icon_url' => $icon_url
        );
        $this->db->insert('od_subcategory', $data);
        return $this->db->insert_id();
    }

    public function do_edit_sub_category($icon_url, $id){
        $data = array(
            'category_id' => $this->security->xss_clean($this->input->post('category_name')),
            'subcategory_name' => $this->security->xss_clean($this->input->post('sub_category_name')),
            'icon_url' => $icon_url
        );
        $this->db->update('od_subcategory', $data, ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function do_delete_sub_category($id){
        $this->db->delete('od_subcategory', ['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function chnage_status($id, $subcategory_status){
        $this->db->update('od_subcategory', ['status' => $subcategory_status], ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function getsubcategorydata($id){
         $this->db->select('ods.id, ods.category_id, ods.subcategory_name, ods.icon_url, ods.status, odc.category_name');
        $this->db->from('od_subcategory ods');
        $this->db->join('od_category odc','odc.id = ods.category_id');
        $this->db->where('ods.id',$id);
        $query = $this->db->get();
        return $query->row_array();

    }
}
