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
                'title' =>  'Codigo',
                'width' =>  '',
                'type'  =>  ''
            ),               
            'parentName' => array(
                'title' =>  'Pai',
                'width' =>  '',
                'type'  =>  ''
            ),
            'permName' => array(
                'title' =>  'Nome',
                'width' =>  '',
                'type'  =>  ''
            ),
            'permKey' => array(
                'title' =>  'Chave',
                'width' =>  '',
                'type'  =>  ''
            ),
          	'isMenu' => array(
                'title' =>  'Menu?',
                'width' =>  '',
                'type'  =>  '',
                'labelFunction' => function($v){
                    return ($v==0)?'Não':'Sim';
                }
            ),          
        );  

 		$this->assign('listHead', 	$listHead);
 		$this->assign('list', 		$data);
		$this->assign('title', 		'Listar Permissões');
		$this->display('listBase');
	}

	public function add() { 

        $parendData = $this->permModel->getAllPermissions();

		$formInfo = array( 
          	'permKey' => array(
                'label' => 'Chave',
                'type'  => 'text',
                'required' => 'true'
            ),
            'permName' => array(
                'label' => 'Nome',
                'type'  => 'text',
                'required' => 'true'
            ),
          	'parentID' => array(
                'label' => 'Nó Pai',
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
                'label' => 'Ordem',
                'type'  => 'text',
                'required' => 'true',
            ),
            'isMenu' => array(
                'label' => 'Exibir no Menu?',
                'type'  => 'checkbox',
                'required' => 'true'
            )
		); 

		$this->assign('formInfo', 	$formInfo);
		$this->assign('title', 		'Adicionar Permissão');
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
                'label' => 'Chave',
                'type'  => 'text',
                'required' => 'true'
            ),
          	'permName' => array(
                'label' => 'Nome',
                'type'  => 'text',
                'required' => 'true'
            ),
            'parentID' => array(
                'label' => 'Nó Pai',
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
                'label' => 'Ordem',
                'type'  => 'text',
                'required' => 'true',
            ),
            'isMenu' => array(
                'label' => 'Exibir no Menu?',
                'type'  => 'checkbox',
                'required' => 'true'
            )
		); 

		$this->assign('formInfo', 		$formInfo);
		$this->assign('recordSet', 		$rs[0]);
		$this->assign('title', 'Editar Permissão: ' . $rs[0]->permName);
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