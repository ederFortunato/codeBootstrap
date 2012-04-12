<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ACL_Model extends CI_Model
{

	function setUserGroup($userId, $groupId) {

		$this->db->where('userID',  $userId);
		$this->db->delete('acl_user_group'); 

		$data['userID']  = $userId;
		$data['groupID'] = $groupId;
		$data['addDate'] = date('Y-m-d G:i:s');
		return $this->db->insert('acl_user_group', $data); 
	}

	function getGroupByUser($id) {
		$data = array();
		$this->db->select('groupID');
		$this->db->where('userID', $id);
		$sql = $this->db->get('acl_user_group');
		$data = $sql->result();
		return $data[0];
	}

	function getPermsByGroup($id) {
		$data = array();
		$this->db->select('id, groupID, permID, value, addDate');
		$this->db->where('groupID', $id);
		$sql = $this->db->get('acl_group_permission');
		$data = $sql->result();
		return $data;
	}

	function getPermsByUser($id) {

		$group = $this->getGroupByUser($id);


		$data = array();
		$this->db->select('gp.id, groupID, permID, permKey, permName, isMenu, parentID');
		$this->db->join('acl_permissions p', 'gp.permID = p.id' );
		$this->db->where('groupID', $group->groupID);
		$this->db->where('value', '1');
		$this->db->where('isMenu', '1');
		$this->db->order_by('order');
		$this->db->order_by('parentID');
		$this->db->order_by('permName');
		$sql = $this->db->get('acl_group_permission gp');
		$data = $sql->result();
		//echo $this->db->last_query();
		//exit();
		return $data;
	}

	function setPermsGroup($groupId, $perms) {
	 
		$data = array();
		foreach ($perms as $key => $value) {
			$data[] = array(
							'groupID' 	=> $groupId,
							'permID' 	=> $value,
							'value' 	=> 1,
							'addDate' 	=> date('Y-m-d G:i:s')
						);
		}
 
		$this->db->where('groupID',  $groupId);
		$this->db->delete('acl_group_permission'); 


		 $result = 	$this->db->insert_batch('acl_group_permission', $data);
 
		return $result;
	}
}