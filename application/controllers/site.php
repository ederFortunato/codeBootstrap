<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MY_Controller
{
	/**
	 * Construtor
	 */
	public function __construct($layoutFile = null){
		parent::__construct();
		
		$this->load->library('tank_auth');
		$this->layoutFile = 'templates/site_template.php';
	}

	function index()
	{
		if ($this->tank_auth->is_logged_in()) {
			redirect('/admin');
		} else {
			$this->assign('title', 'site');
			$this->display('home');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */