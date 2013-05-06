<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $this->load->library('GiantBomb');
		// $game_info = $this->giantbomb->search('waldeneenenen');
		$this->db->select('*');
		$this->db->from('games');
		$this->db->join('scores', 'scores.id = games.id');
		$query = $this->db->get();

		$data['games'] = $query->result();

		$this->load->view('home', $data);
	}

	public function search()
	{
		$query = $this->input->post('query');
		var_dump($query);
		$this->load->library('GiantBomb');
		$response = $this->giantbomb->search($query);
		// if ( ! $response)
		// 	$this->_send_response();

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
			}
		}
		unset($res);

		$data['games'] = $response;
		var_dump($data);
		$this->load->view('home', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */