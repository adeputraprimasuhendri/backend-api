<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Location extends REST_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Location_model');
    }

    // GET METHOD
    public function index_get(){
        $id = $this->get('id');
        if ($id === NULL){
            $Location = $this->Location_model->getLocation();
        }else{
            $Location = $this->Location_model->getLocation($id);
        }
        if ($Location){
            $this->response($Location, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No Location were found'
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
            if($this->Location_model->deleteLocation($id) > 0){
                $this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'messages' => 'Location delete'
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
        if($this->Location_model->createLocation($data) > 0){
            $this->response([
                'status' => TRUE,
                'messages' => 'Location add'
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
        if($this->Location_model->updateLocation($data, $id) > 0){
            $this->response([
                'status' => TRUE,
                'messages' => 'Location update'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'failed to update new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}