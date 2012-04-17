<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include BASEPATH . '../application/core/MY_RestrictController.php';

class Groups extends MY_RestrictController { 


	/**
	 * Construtor
	 */
	public function __construct(){
		parent::__construct();

		$this->idRecordSet = 'id';
		$this->linkBase = '/acl/groups';
		$this->load->model('ACL_Model', 'AclModel');
		$this->load->model('Group_Model', 'groupModel');
		$this->load->model('Permission_Model', 'permModel');
	}

	public function index() { 		

		$data = $this->groupModel->getAllGroups();

		$listHead =  array(
			'id' => array(
                'title' =>  'ID',
                'width' =>  '32',
                'type'  =>  ''
            ),
          	'groupName' => array(
                'title' =>  'Name',
                'width' =>  '',
                'type'  =>  ''
            )
                    
        ); 
 
 		$this->assign('listHead', $listHead);
 		$this->assign('list', 	  $data);
		$this->assign('title',    'List Groups');
		$this->display('listBase');
	}

	public function add() { 

		$permData = $this->permModel->getAllPermissions();

		$formInfo = array(
          	'groupName' => array(
                'label' => 'Name',
                'type'  => 'text',
                'required' => 'true'
            ),
            'group_permission' => array(
                'label' => 'Permissions',
                'type'  => 'arrayCheckbox',
                'arrayAttr' => array(
                    'dataField'      => "id",
                    'labelField'     => "permName",
                    'selectedValues' => array(),
                    'dataProvider'   => $permData
                )              
            ) 
		); 

		$this->assign('formInfo',	$formInfo);	
		$this->assign('title', 		'Add Group');
		$this->display('formBase');
	}

	public function edit($id) { 
		
		$rs = $this->groupModel->getGroup($id);		
		$permData = $this->permModel->getAllPermissions();
		$permEdit = $this->AclModel->getPermsByGroup($id);

		$valuesPerm = array();
		foreach ($permEdit as $key => $row) {
			if($row->value == '1')
				$valuesPerm[] = $row->permID;
		}

		$formInfo = array(
          	'id' => array(
                'label' => '',
                'type'  => 'hidden',
                'required' => 'true'
            ),
          	'groupName' => array(
                'label' => 'Name',
                'type'  => 'text',
                'required' => 'true'
            ),
            'group_permission' => array(
                'label' => 'Permissions',
                'type'  => 'arrayCheckbox',
                'arrayAttr' => array(
                    'dataField'      => "id",
                    'labelField'     => "permName",
                    'selectedValues' => $valuesPerm,
                    'dataProvider'   => $permData
                )              
            ) 
		); 

		$this->assign('formInfo', 	$formInfo);
		$this->assign('recordSet', 	$rs[0]);
		$this->assign('title', 		'Edit Group');
		$this->display('formBase');
	}



	public function remove($id) { 

		$result = $this->groupModel->removeGroup($id);

		if($result == 1){
			$this->redirectAndShowMsg('Group successfully removed', 'success', $this->linkBase);
		}else{
			$this->redirectAndShowMsg('Error in operation, cannot remove this Group', 'error', $this->linkBase);			
		}
	}

	public function save() { 

		$result = $this->groupModel->saveGroup($_POST);
		
		if($result == 1){
			if(isset($_POST[$this->idRecordSet])){//is Edit?
				$this->redirectAndShowMsg('Group successfully edited', 'success', $this->linkBase);
			}else{
				$this->redirectAndShowMsg('Group successfully inserted', 'success', $this->linkBase);
			}
		}else{
			$this->redirectAndShowMsg('Error in operation, try again', 'error', $this->linkBase);			
		}
	}	
}