<?php
    class Transaction_model extends CI_Model {
        public function getTransaction($id = null){
            if($id == null){
                return $this->db->get('transaction')->result_array();
            }else{
                return $this->db->get_where('transaction', ['id'=> $id])->result_array();
            }
        }
        public function deleteTransaction($id){
            $this->db->delete('transaction', ['id' => $id]);
            return $this->db->affected_rows(); 
        }
        public function createTransaction($data){
            $this->db->insert('transaction', $data);
            return $this->db->affected_rows();  
        }
        public function updateTransaction($data, $id){
            $this->db->update('transaction', $data, ['id' => $id]);
            return $this->db->affected_rows();  
        }
    }
?>