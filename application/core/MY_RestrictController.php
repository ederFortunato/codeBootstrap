<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_RestrictController extends MY_Controller {

	/**
	 * Construtor
	 */
	public function __construct($layoutFile = null){
		parent::__construct();

		$this->layoutFile = 'templates/admin_template';

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('pagination');
		$this->load->model('ACL_Model', 'AclModel');
		$this->load->model('User_Model', 'userModel');

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
			
		} else {

			$config = array('userID' => $this->tank_auth->get_user_id());

			$this->load->library('ACLManager', $config);
			
			$d = ($this->router->directory == '')?'':$this->router->directory;
			$c = $this->router->class;
			$m = $this->router->method;
			$m = ($m == 'index')?'':'/'.$m;

			$acl_test =  $d . $c . $m;
 

			// If the user does not have permission either in 'user_perms' or 'role_perms' redirect to login, or restricted, etc
			if ( !$this->aclmanager->hasPermission($acl_test) ) {

				redirect('/auth/denial/');

			}else{

 				$this->_init();

			}
		}
	}



	private function _init(){

		$idUser = $this->tank_auth->get_user_id();
		$user 	= $this->userModel->getUser($idUser);

		$this->assign('USER_LOGIN_ID',  	$idUser);
		$this->assign('USER_LOGIN_NAME',	$user[0]->nome); 

		$permsMenu = $this->AclModel->getPermsByUser($idUser);
		$this->assign('listMenu',	$permsMenu); 

		$this->assign('USER_LOGIN_NAME',	$user[0]->nome); 


		//list
		$this->assign('showOnlyViewButton', FALSE);
 		$this->assign('showEditButton', TRUE);
 		$this->assign('showRemoveButton', TRUE);


 		$this->assign('searchParans', $this->getAllSearchParans());

		//pagination
		$perPage  = 10; 
		$init_page  = isset($_GET['page'])?$_GET['page']:1;
 		$this->assign('pageNumber', $init_page);
 		$this->assign('perPage', $perPage);

	}


	protected function getSearchParam($t){
		return isset($_GET[$t])?$_GET[$t]:'';
	}
	protected function getAllSearchParans(){
		$g = $_GET;
		unset($g['page']);		
		return $g;
	}
}