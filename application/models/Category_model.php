<?php
    class Category_model extends CI_Model {
        public function getCategory($id = null){
            if($id == null){
                return $this->db->get('category')->result_array();
            }else{
                return $this->db->get_where('category', ['id'=> $id])->result_array();
            }
        }
        public function deleteCategory($id){
            $this->db->delete('category', ['id' => $id]);
            return $this->db->affected_rows(); 
        }
        public function createCategory($data){
            $this->db->insert('category', $data);
            return $this->db->affected_rows();  
        }
        public function updateCategory($data, $id){
            $this->db->update('category', $data, ['id' => $id]);
            return $this->db->affected_rows();  
        }
    }
?>