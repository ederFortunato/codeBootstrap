<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Group_Model extends CI_Model
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('ACL_Model', 'AclModel');
	}

	function getAllGroups() {
		$data = array();
		$this->db->select('*');
		$sql = $this->db->get('acl_groups');
		$data = $sql->result();
		return $data;
	}

	function saveGroup($group) {	
 		

 		$groupPerms = $group['group_permission'];
		unset($group['group_permission']);

		if(isset($group['id']) && $group['id'] != ''){

			$this->db->where('id', $group['id']);
			$return = $this->db->update('acl_groups', $group);

		}else{

			$return = $this->db->insert('acl_groups', $group); 
			$group['id'] = $this->db->insert_id();

		}

		if($return){
			$return = $this->AclModel->setPermsGroup($group['id'], $groupPerms);
			return $return;
		}

		return null;

	}

	function removeGroup($id) {

		$this->db->where('id', $id);
		$ret1 = $this->db->delete('acl_groups'); 

		$this->db->where('groupID',  $id);
		$ret2 = $this->db->delete('acl_group_permission'); 

		return $ret1 || $ret2;
	}

	function getGroup($id) {
		$data = array();
		$this->db->select('*');
		$this->db->where('id', $id);
		$sql = $this->db->get('acl_groups');
		$data = $sql->result();
		return $data;
	}


}