<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include BASEPATH . '../application/core/MY_RestrictController.php';

class Admin extends MY_RestrictController { 

	public function index() { 
		$this->assign('title', ' Welcome!!!');
		$this->display('admin');
	}
}