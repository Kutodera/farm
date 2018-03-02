<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cropdisease extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crop_disease_model','crop');
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->view('crop_diseases_view');
    }

    public function ajax_list()
    {
        $table='crop_disease';
        $table2='crop';
        $select='*';
        $wheretable1 = 'crop_id';
        $wheretable2 = 'crop_id';
        $order='dis_id';

        $list = $this->crop->select_table_join($table,$table2,$select,$wheretable1,$wheretable2,$order);

        //output to json format
        echo json_encode($list);
    }

    public function crop_list()
    {
        $table='crop';
        $select='*';
        $order='crop_id';
        $list = $this->crop->select_table($table,$select,$order);
        //output to json format
        echo json_encode($list);
    }



    public function ajax_edit($id)
    {
        $data = $this->crop->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
            'crop_id' => $this->input->post('name'),
            'disease_name' => $this->input->post('disease'),
        );
        $insert = $this->crop->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'crop_id' => $this->input->post('name'),
            'disease_name' => $this->input->post('disease'),
        );
        $this->crop->update(array('dis_id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->crop->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('disease') == '')
        {
            $data['inputerror'][] = 'disease';
            $data['error_string'][] = 'Disease name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Crop name is required';
            $data['status'] = FALSE;
        }



        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
