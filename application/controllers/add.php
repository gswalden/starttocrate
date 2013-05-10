<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends CI_Controller {

	public function index()
	{
		$score = trim($this->input->post('score'));
		$id = trim($this->input->post('id'));
		$query = $this->db->get_where('games', array('id' => $id));
		$this->db->trans_start();
		if ($query->num_rows() == 0)
		{
			$this->load->library('GiantBomb');
			$response = $this->giantbomb->get_game($id);
			$this->game_model->add_game($response);
		}
		else
			$response = $query->row();
		$this->game_model->add_score(array('id' => $response->id, 'score' => $score));
		$this->db->trans_complete();
		$response->score = $score;
		$data['games'] = $response;
		$this->load->view('home', $data);
	}
}