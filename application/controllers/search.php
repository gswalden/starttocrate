<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index()
	{
		$search = trim($this->input->post('search'));
		$this->load->library('GiantBomb');
		$response = $this->giantbomb->search($search);
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
		$data['search'] = $search;
		$this->load->view('home', $data);
	}
}