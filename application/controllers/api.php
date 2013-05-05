<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "libraries/REST_Controller.php";

class API extends REST_Controller {

	public function index_get()
	{
		$query = $this->get('query');
		$this->load->library('GiantBomb');
		$response = $this->giantbomb->search($query);
		if ( ! $response)
			$this->_send_response();

		foreach ($response as &$res)
		{
			$query = $this->db->get_where('games', array('id' => $res->id));
			if ($query->num_rows() == 0)
				$res->type = 'giantbomb';
			else
			{
				$res->type = 'local';
				$res->scores = $this->db->get_where('scores', array('id' => $res->id))->result();
			}
		}
		unset($res);
		$this->_send_response($response);
	}

	public function index_post()
	{
		
	}

	public function game_get()
	{
		$id = $this->get('id');
		$query = $this->db->get_where('games', array('id' => $id));
		if ($query->num_rows() == 0)
			$this->_send_response();

		$this->_send_response($query->result());
	}

	private function _send_response($data = NULL)
	{
		if ($data)
			$this->response($data, 200);
		else
			$this->response(NULL, 404);
	}
}