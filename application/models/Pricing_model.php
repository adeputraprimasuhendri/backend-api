<?php
    class Pricing_model extends CI_Model {
        public function getPricing($id = null){
            if($id == null){
                return $this->db->get('pricing')->result_array();
            }else{
                return $this->db->get_where('pricing', ['id'=> $id])->result_array();
            }
        }
        public function deletePricing($id){
            $this->db->delete('pricing', ['id' => $id]);
            return $this->db->affected_rows(); 
        }
        public function createPricing($data){
            $this->db->insert('pricing', $data);
            return $this->db->affected_rows();  
        }
        public function updatePricing($data, $id){
            $this->db->update('pricing', $data, ['id' => $id]);
            return $this->db->affected_rows();  
        }
    }
?>