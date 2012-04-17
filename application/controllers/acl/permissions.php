<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include BASEPATH . '../application/core/MY_RestrictController.php';

class Permissions extends MY_RestrictController { 

	/**
	 * Construtor
	 */
	public function __construct(){
		parent::__construct();

		$this->idRecordSet = 'id';
		$this->linkBase = '/acl/permissions';
		$this->load->model('ACL_Model', 'AclModel');
        $this->load->model('Permission_Model', 'permModel');
	}

	public function index() { 

		$data = $this->permModel->getAllPermissions();

		$listHead =  array(
            'id' => array(
                'title' =>  'ID',
                'width' =>  '',
                'type'  =>  ''
            ),               
            'parentName' => array(
                'title' =>  'Parent',
                'width' =>  '',
                'type'  =>  ''
            ),
            'permName' => array(
                'title' =>  'Name',
                'width' =>  '',
                'type'  =>  ''
            ),
            'permKey' => array(
                'title' =>  'Key',
                'width' =>  '',
                'type'  =>  ''
            ),
          	'isMenu' => array(
                'title' =>  'is Menu?',
                'width' =>  '',
                'type'  =>  '',
                'labelFunction' => function($v){
                    return ($v==0)?'No':'Yes';
                }
            ),          
        );  

 		$this->assign('listHead', 	$listHead);
 		$this->assign('list', 		$data);
		$this->assign('title', 		'List Permissions');
		$this->display('listBase');
	}

	public function add() { 

        $parendData = $this->permModel->getAllPermissions();

		$formInfo = array( 
          	'permKey' => array(
                'label' => 'Key',
                'type'  => 'text',
                'required' => 'true'
            ),
            'permName' => array(
                'label' => 'Name',
                'type'  => 'text',
                'required' => 'true'
            ),
          	'parentID' => array(
                'label' => 'Parent',
                'type'  => 'combo',
                'required' => 'true',
                'comboAttr' => array(
                    'dataField'     => "id",
                    'labelField'    => "permName",
                    'selectedValue' => '',
                    'dataProvider'  => $parendData
                )              
            ),
            'order' => array(
                'label' => 'Order',
                'type'  => 'text',
                'required' => 'true',
            ),
            'isMenu' => array(
                'label' => 'Show in the Menu?',
                'type'  => 'checkbox',
                'required' => 'true'
            )
		); 

		$this->assign('formInfo', 	$formInfo);
		$this->assign('title', 		'Add Permission');
		$this->display('formBase');
	}

	public function edit($id) { 
		
		$rs = $this->permModel->getPermission($id);
        $parendData = $this->permModel->getAllPermissions();

		$formInfo = array(
          	'id' => array(
                'label' => '',
                'type'  => 'hidden',
                'required' => 'true'
            ),
          	'permKey' => array(
                'label' => 'Key',
                'type'  => 'text',
                'required' => 'true'
            ),
          	'permName' => array(
                'label' => 'Name',
                'type'  => 'text',
                'required' => 'true'
            ),
            'parentID' => array(
                'label' => 'Parent',
                'type'  => 'combo',
                'required' => 'true',
                'comboAttr' => array(
                    'dataField'     => "id",
                    'labelField'    => "permName",
                    'selectedValue' => $rs[0]->parentID,
                    'dataProvider'  => $parendData
                )              
            ), 
            'order' => array(
                'label' => 'Order',
                'type'  => 'text',
                'required' => 'true',
            ),
            'isMenu' => array(
                'label' => 'Show in the Menu?',
                'type'  => 'checkbox',
                'required' => 'true'
            )
		); 

		$this->assign('formInfo', 		$formInfo);
		$this->assign('recordSet', 		$rs[0]);
		$this->assign('title', 'Edit Permission: ' . $rs[0]->permName);
		$this->display('formBase');

	}

	public function remove($id) { 

		$result = $this->permModel->removePermission($id);

        if($result == 1){
            $this->redirectAndShowMsg('Permissão removido com sucesso', 'success', $this->linkBase);
        }else{
            $this->redirectAndShowMsg('Erro ao remover Permissão', 'error', $this->linkBase);           
        }		 
	}

	public function save() { 

		$result = $this->permModel->savePermission($_POST);
        
        if($result == 1){
            if(isset($_POST[$this->idRecordSet])){//is Edit?
                $this->redirectAndShowMsg('Permissão alterada com sucesso', 'success', $this->linkBase);
            }else{
                $this->redirectAndShowMsg('Permissão incluida com sucesso', 'success', $this->linkBase);
            }
        }else{
            $this->redirectAndShowMsg('Erro na operação, Tente novamente', 'error', $this->linkBase);           
        }
    }   
 	
}