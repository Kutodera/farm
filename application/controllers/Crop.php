<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('crop_model','crop');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('crop_view');
	}

	public function ajax_list()
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
				'name' => $this->input->post('name'),
				'altitude' => $this->input->post('altitude'),
				'method' => $this->input->post('method'),
				'time' => $this->input->post('time'),
			);
		$insert = $this->crop->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
        $data = array(
            'name' => $this->input->post('name'),
            'altitude' => $this->input->post('altitude'),
            'method' => $this->input->post('method'),
            'time' => $this->input->post('time'),
        );
		$this->crop->update(array('crop_id' => $this->input->post('id')), $data);
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

		if($this->input->post('name') == '')
		{
			$data['inputerror'][] = 'name';
			$data['error_string'][] = 'Crop name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('altitude') == '')
		{
			$data['inputerror'][] = 'altitude';
			$data['error_string'][] = 'Altitude is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('method') == '')
		{
			$data['inputerror'][] = 'method';
			$data['error_string'][] = 'Method is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('time') == '')
		{
			$data['inputerror'][] = 'time';
			$data['error_string'][] = 'Time is required';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
