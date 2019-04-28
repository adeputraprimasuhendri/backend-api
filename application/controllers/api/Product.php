<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Product extends REST_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Product_model');
    }

    // GET METHOD
    public function index_get(){
        $id = $this->get('id');
        if ($id === NULL){
            $product = $this->Product_model->getProduct();
        }else{
            $product = $this->Product_model->getProduct($id);
        }
        if ($product){
            $this->response($product, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No product were found'
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
            if($this->Product_model->deleteProduct($id) > 0){
                $this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'messages' => 'Product delete'
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
            'name' => $this->post('name')
        ];
        if($this->Product_model->createProduct($data) > 0){
            $this->response([
                'status' => TRUE,
                'messages' => 'Product add'
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
            'name' => $this->put('name')
        ];
        if($this->Product_model->updateProduct($data, $id) > 0){
            $this->response([
                'status' => TRUE,
                'messages' => 'Product update'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}