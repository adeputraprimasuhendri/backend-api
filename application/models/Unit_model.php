<?php
    class Unit_model extends CI_Model {
        public function getUnit($id = null){
            if($id == null){
                return $this->db->get('units')->result_array();
            }else{
                return $this->db->get_where('units', ['id'=> $id])->result_array();
            }
        }
        public function deleteUnit($id){
            $this->db->delete('units', ['id' => $id]);
            return $this->db->affected_rows(); 
        }
        public function createUnit($data){
            $this->db->insert('units', $data);
            return $this->db->affected_rows();  
        }
        public function updateUnit($data, $id){
            $this->db->update('units', $data, ['id' => $id]);
            return $this->db->affected_rows();  
        }
    }
?>