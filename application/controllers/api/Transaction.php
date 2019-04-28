<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Transaction extends REST_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Transaction_model');
    }

    // GET METHOD
    public function index_get(){
        $id = $this->get('id');
        if ($id === NULL){
            $Transaction = $this->Transaction_model->getTransaction();
        }else{
            $Transaction = $this->Transaction_model->getTransaction($id);
        }
        if ($Transaction){
            $this->response($Transaction, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No Transaction were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // DELETE METHOD
    public function index_delete(){
        $id = $this->delete('id');
        if ($id === NULL){
                        $this->response([
                            'status' => FALSE,
                            'message' => 'need id'
                        ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if($this->Transaction_model->deleteTransaction($id) > 0){
                $this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'messages' => 'Transaction delete'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                        $this->response([
                            'status' => FALSE,
                            'message' => 'id not found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    // POST METHOD
    public function index_post(){
        $data = [
            'date' => $this->post('date'),
            'id_location' => $this->post('id_location'),
            'id_product' => $this->post('id_product'),
            'id_pricing' => $this->post('id_pricing'),
            'qty' => $this->post('qty'),
            'description' => $this->post('description')
        ];
        if($this->Transaction_model->createTransaction($data) > 0){
            $this->response([
                'status' => TRUE,
                'messages' => 'Transaction add'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to create new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    // PUT METHOD
    public function index_put(){
        $id = $this->put('id');
        $data = [
            'date' => $this->put('date'),
            'id_location' => $this->put('id_location'),
            'id_product' => $this->put('id_product'),
            'id_pricing' => $this->put('id_pricing'),
            'qty' => $this->put('qty'),
            'description' => $this->put('description')
        ];
        if($this->Transaction_model->updateTransaction($data, $id) > 0){
            $this->response([
                'status' => TRUE,
                'messages' => 'Transaction update'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}