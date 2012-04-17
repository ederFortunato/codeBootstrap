<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include BASEPATH . '../application/core/MY_RestrictController.php';

class UsersProfile extends MY_RestrictController { 

	/**
	 * Construtor
	 */
	public function __construct(){
		parent::__construct();

		$this->idRecordSet = 'id';
		$this->linkBase = '/acl/UsersProfile';
        $this->load->model('ACL_Model', 'AclModel');
        $this->load->model('User_Model', 'userModel');
		$this->load->model('Group_Model', 'groupModel');
	}

	public function index() { 

        $filters = $this->getAllSearchParans();
        
		$data = $this->userModel->getAllUsers($filters);       

		$listHead =  array(
          	'id' => array(
                'title' =>  'ID',
                'width' =>  '32',
                'type'  =>  ''
            ),
          	'nome' => array(
                'title' =>  'Name',
                'width' =>  '',
                'type'  =>  ''
            ),		                  
          	'idade' => array(
                'title' =>  'Age',
                'width' =>  '50',
                'type'  =>  ''
            )                    
        ); 

        $searchInfo = array(
            'nome' => array(
                'title' =>  'Name',
                'type'  =>  'text',
                'value' =>  $this->getSearchParam('nome') 
            ),
            'idade' => array(
                'title' =>  'Age',
                'type'  =>  'text',
                'value' =>  $this->getSearchParam('idade') 
            )        
        );
 
        $this->assign('listHead',    $listHead);
 		$this->assign('searchInfo',  $searchInfo);
 		$this->assign('list',        $data);
		$this->assign('title',        'List users');
		$this->display('listBase');
	}

	public function add() { 
        
        $groupData = $this->groupModel->getAllGroups();

		$formInfo = array(

          	'nome' => array(
                'label' => 'Name',
                'type'  => 'text',
                'required' => 'true'
            ),
          	'idade' => array(
                'label' => 'Age',
                'type'  => 'text',
                'required' => 'true'
            ),
            'email' => array(
                'label' => 'Email Address',
                'type'  => 'email',
                'required' => 'true'
            ),
            
            '__LINE_HORIZONTAL__' => '',

            'password' => array(
                'label' => 'Password',
                'type'  => 'password',
                'required' => 'true'
            ),
            'confirm_password' => array(
                'label' => 'Confirm Password',
                'type'  => 'password',
                'required' => 'true'
            ),
            'groupID' => array(
                'label' => 'Group',
                'type'  => 'combo',
                'required' => 'true',
                'comboAttr' => array(
                    'dataField'     => "id",
                    'labelField'    => "groupName",
                    'selectedValue' => '',
                    'dataProvider'  => $groupData
                )              
            ) 
		); 

		$this->assign('formInfo', 		$formInfo);
		$this->assign('title', 'Add user');
		$this->display('formBase');
	}

	public function edit($id) { 
		
		$rs = $this->userModel->getUser($id);
        $groupData = $this->groupModel->getAllGroups();        
        $group = $this->AclModel->getGroupByUser($id);

		$formInfo = array(
            'id' => array(
                'label' => '',
                'type'  => 'hidden',
                'required' => 'true'
            ),
            'nome' => array(
                'label' => 'Name',
                'type'  => 'text',
                'required' => 'true'
            ),
          	'idade' => array(
                'label' => 'Age',
                'type'  => 'text',
                'required' => 'true'
            ),
            /*
            'email' => array(
                'label' => 'Email Address',
                'type'  => 'text',
                'required' => 'true'
            ),

            '__LINE_HORIZONTAL__' => '',

            'password' => array(
                'label' => 'Password',
                'type'  => 'password',
                'required' => 'true'
            ),
            'confirm_password' => array(
                'label' => 'Confirm Password',
                'type'  => 'password',
                'required' => 'true'
            ),
            */            
            'groupID' => array(
                'label' => 'Group',
                'type'  => 'combo',
                'required' => 'true',
                'comboAttr' => array(
                    'dataField'     => "id",
                    'labelField'    => "groupName",
                    'selectedValue' => $group->groupID,
                    'dataProvider'  => $groupData
                )              
            ) 
		); 

		$this->assign('formInfo', 	$formInfo);
		$this->assign('recordSet', 	$rs[0]);
		$this->assign('title', 'Edit user: ' . $rs[0]->nome);
		$this->display('formBase');

	}

	public function remove($id) { 

		$result = $this->userModel->removeUser($id);

        if($result == 1){
            $this->redirectAndShowMsg('Usuário removido com sucesso', 'success', $this->linkBase);
        }else{
            $this->redirectAndShowMsg('Erro ao remover Usuário', 'error', $this->linkBase);           
        }		 
	}




    public function save() { 

        $result = $this->userModel->saveUser($_POST);

        if($result == 1){
            if(isset($_POST[$this->idRecordSet])){//is Edit?
                $this->redirectAndShowMsg('Usuário alterado com sucesso', 'success', $this->linkBase);
            }else{
                $this->redirectAndShowMsg('Usuário incluido com sucesso', 'success', $this->linkBase);
            }
        }else{
            $this->redirectAndShowMsg('Erro na operação, Tente novamente', 'error', $this->linkBase);           
        }
    }   

}