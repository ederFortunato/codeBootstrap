<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permission_Model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('ACL_Model', 'AclModel');
	}

	function getAllPermissions($filters = array()) {
		$data = array();
		$this->db->select('p.id, p.permKey, p.permName, p.parentID, p.isMenu, p.order, p2.permName as parentName');
		$this->db->join('acl_permissions p2', 'p.parentID = p2.id', 'left outer');
		$this->db->like($filters);
		$sql = $this->db->get('acl_permissions p');
		$data = $sql->result();

		return $data;
	}

	function savePermission($perm) {	
		
		$perm['isMenu'] = (isset($perm['isMenu']))?$perm['isMenu']:'';
		
		if(isset($perm['id']) && $perm['id'] != ''){
			$this->db->where('id', $perm['id']);
			return $this->db->update('acl_permissions', $perm); 			
		}else{
			return $this->db->insert('acl_permissions', $perm); 
		}
	}

	function removePermission($id) {
		$this->db->where('id', $id);
		$ret1 = $this->db->delete('acl_permissions'); 

		$this->db->where('permID',  $id);
		$ret2 = $this->db->delete('acl_group_permission'); 

		return $ret1 || $ret2;

	}

	function getPermission($id) {
		$data = array();
		$this->db->select('id, permKey, permName, parentID, isMenu, order');
		$this->db->where('id', $id);
		$sql = $this->db->get('acl_permissions');
		$data = $sql->result();
		return $data;
	}
}