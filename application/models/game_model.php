<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game_model extends CI_Model {

	public function add_game($data)
	{
		$this->db->insert('games', $data);
	}

	public function get_game($id)
	{

	}

	public function get_all_games()
	{

	}

	public function search_games($query)
	{
		
	}	
}