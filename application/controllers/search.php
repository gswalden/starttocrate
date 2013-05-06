<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index()
	{
		$query = $this->input->post('query');
		$this->load->library('GiantBomb');
		$response = $this->giantbomb->search($query);
		var_dump($response);
		if ($response !== FALSE)
		{
			foreach ($response as &$res)
			{
				$query = $this->db->get_where('games', array('id' => $res->id));
				if ($query->num_rows() == 0)
				{
					$res->type = 'giantbomb';
					$res->score = NULL;
				} 
				else 
				{
					$res->type = 'local';
					$res->score = $this->db->get_where('scores', array('id' => $res->id))->result();
					$res->score = $res->score[0]->score;
				}
			}
			unset($res);
		}

		$data['games'] = $response;
		$this->load->view('home', $data);
	}
}