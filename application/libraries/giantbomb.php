<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter GiantBomb Class
 *
 * Makes API requests to GiantBomb.com.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Greg Walden
 * @created			05/02/2013
 * @license         
 * @link			http://www.starttocrate.org/
 */

class GiantBomb
{
	protected $CI;

	protected $api_key;
	protected $url = 'http://www.giantbomb.com/api/';
	protected $format = 'json';
	protected $field_list = array(	'site_detail_url', 
									'deck',
									'id',
									'name',
									'original_release_date',
									'image');

	protected $id = NULL;
	protected $query = NULL;

	public function __construct() 
	{
		$this->CI =& get_instance();
		$this->api_key = $this->CI->config->item('giant_bomb_key');
		$this->CI->rest->initialize(array('server' => $this->url));

	}

	public function get_game($id)
	{
		$type = 'game';
		$this->id = $id;
		$this->_call($type);	
	}

	public function search($query)
	{
		$this->query = $query;
		$type = 'search';
		$this->_call($type);
	}

	protected function _call($type)
	{
		$api_resource = "$type";
		$params = array('api_key' => $this->api_key, 
						'format' => $this->format, 
						'field_list' => implode(',', $this->field_list));
		if ($type == 'search')
			$params['query'] = $this->query;
		elseif ($type == 'game')
			 $api_resource .= '/' . $this->id . '/';

		$response = $this->CI->rest->get($api_resource, $params, $this->format);
		log_message('info', "GiantBomb API request made of type $type.");
		if ($response->status_code != 1)
		{
			echo 'We had a bad conversation with Giant Bomb. Error code: ' . $response->status_code;
			mail('givemesnacks@gmail.com', "Start to Crate: Giant Bomb Error: $response->status_code", $response->error . ' | Object: ' . $resource_id);
			return FALSE; 
		}
		return $response->results;
	}
}