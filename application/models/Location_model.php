<?php
    class Location_model extends CI_Model {
        public function getLocation($id = null){
            if($id == null){
                return $this->db->get('location')->result_array();
            }else{
                return $this->db->get_where('location', ['id'=> $id])->result_array();
            }
        }
        public function deleteLocation($id){
            $this->db->delete('location', ['id' => $id]);
            return $this->db->affected_rows(); 
        }
        public function createLocation($data){
            $this->db->insert('location', $data);
            return $this->db->affected_rows();  
        }
        public function updateLocation($data, $id){
            $this->db->update('location', $data, ['id' => $id]);
            return $this->db->affected_rows();  
        }
    }
?>