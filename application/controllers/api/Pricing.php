<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pricing extends REST_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Pricing_model');
    }

    // GET METHOD
    public function index_get(){
        $id = $this->get('id');
        if ($id === NULL){
            $Pricing = $this->Pricing_model->getPricing();
        }else{
            $Pricing = $this->Pricing_model->getPricing($id);
        }
        if ($Pricing){
            $this->response($Pricing, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No Pricing were found'
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
            if($this->Pricing_model->deletePricing($id) > 0){
                $this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'messages' => 'Pricing delete'
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
            'id_product' => $this->post('id_product'),
            'id_location' => $this->post('id_location'),
            'price' => $this->post('price')
        ];
        if($this->Pricing_model->createPricing($data) > 0){
            $this->response([
                'status' => TRUE,
                'messages' => 'Pricing add'
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
            'id_product' => $this->put('id_product'),
            'id_location' => $this->put('id_location'),
            'price' => $this->put('price')
        ];
        if($this->Pricing_model->updatePricing($data, $id) > 0){
            $this->response([
                'status' => TRUE,
                'messages' => 'Pricing update'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}