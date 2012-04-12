<?php 
class ACLManager
{
	var $perms = array();		//Array : Stores the permissions for the user
	var $userID;				//Integer : Stores the ID of the current user
	var $userGroups = array();	//Array : Stores the roles of the current user
	var $ci;

	function __construct($config=array()) {
		$this->ci = &get_instance();

		$this->userID = floatval($config['userID']);
		$this->userGroups = $this->getUserGroup();
		$this->buildACL();
	}

	function buildACL() {
		//first, get the rules for the user's role
		if (count($this->userGroups) > 0)
		{
			$this->perms = array_merge($this->perms,$this->getGroupsPerms($this->userGroups));
		}
		//then, get the individual user permissions
		//$this->perms = array_merge($this->perms,$this->getUserPerms($this->userID));
	}

	function hasPermission($permKey) {
		$permKey = strtolower($permKey);
		if (array_key_exists($permKey,$this->perms))
		{
			if ($this->perms[$permKey]['value'] === '1' || $this->perms[$permKey]['value'] === true)
			{
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function getPermNameFromID($permID) {

		$this->ci->db->select('permName');
		$this->ci->db->where('id',floatval($permID));
		$sql = $this->ci->db->get('acl_permissions',1);
		$data = $sql->result();
		return $data[0]->permName;
	}

	function getUserGroup() {

		$this->ci->db->where(array('userID'=>floatval($this->userID)));
		$this->ci->db->order_by('addDate','asc');
		$sql = $this->ci->db->get('acl_user_group');
		$data = $sql->result();

		$resp = array();
		foreach( $data as $row )
		{
			$resp[] = $row->groupID;
		}
		return $resp;
	}
	function getGroupsPerms($group) {
		if (is_array($group)){
			$this->ci->db->where_in('groupID',$group);
		} else {
			$this->ci->db->where(array('groupID'=>floatval($group)));
		}

		$this->ci->db->order_by('id','asc');
		$sql = $this->ci->db->get('acl_group_permission');
		$data = $sql->result();
		$perms = array();
		foreach( $data as $row )
		{
			$pK = strtolower($this->getPermKeyFromID($row->permID));
			if ($pK == '') { continue; }
			if ($row->value === '1') {
				$hP = true;
			} else {
				$hP = false;
			}
			$perms[$pK] = array('perm' => $pK,'inheritted' => true,'value' => $hP,'name' => $this->getPermNameFromID($row->permID),'id' => $row->permID);
		}
		return $perms;
	}
	function getPermKeyFromID($permID) {

		$this->ci->db->select('permKey');
		$this->ci->db->where('id',floatval($permID));
		$sql = $this->ci->db->get('acl_permissions',1);
		$data = $sql->result();
		return $data[0]->permKey;
	}
/*
	function getGroupNameFromID($groupID) {

		$this->ci->db->select('groupName');
		$this->ci->db->where('id',floatval($groupID),1);
		$sql = $this->ci->db->get('acl_groups');
		$data = $sql->result();
		return $data[0]->groupName;
	}
*/
/*

*/
/*
	function getAllGroups($format='ids') {
		$format = strtolower($format);

		$this->ci->db->order_by('groupName','asc');
		$sql = $this->ci->db->get('acl_groups');
		$data = $sql->result();

		$resp = array();
		foreach( $data as $row )
		{
			if ($format == 'full')
			{
				$resp[] = array("id" => $row->ID,"name" => $row->groupName);
			} else {
				$resp[] = $row->ID;
			}
		}
		return $resp;
	}
*/
/*	
	function getAllPerms($format='ids') {
		$format = strtolower($format);

		$this->ci->db->order_by('permKey','asc');
		$sql = $this->ci->db->get('acl_permissions');
		$data = $sql->result();

		$resp = array();
		foreach( $data as $row )
		{
			if ($format == 'full')
			{
				$resp[$row->permKey] = array('id' => $row->ID, 'name' => $row->permName, 'key' => $row->permKey);
			} else {
				$resp[] = $row->ID;
			}
		}
		return $resp;
	}
*/

	/*
	function getUserPerms($userID) {
		//$strSQL = "SELECT * FROM `".DB_PREFIX."user_perms` WHERE `userID` = " . floatval($userID) . " ORDER BY `addDate` ASC";

		$this->ci->db->where('userID',floatval($userID));
		$this->ci->db->order_by('addDate','asc');
		$sql = $this->ci->db->get('user_perms');
		$data = $sql->result();

		$perms = array();
		foreach( $data as $row )
		{
			$pK = strtolower($this->getPermKeyFromID($row->permID));
			if ($pK == '') { continue; }
			if ($row->value == '1') {
				$hP = true;
			} else {
				$hP = false;
			}
			$perms[$pK] = array('perm' => $pK,'inheritted' => false,'value' => $hP,'name' => $this->getPermNameFromID($row->permID),'id' => $row->permID);
		}
		return $perms;
	}
	*/
/*	
	function hasGroup($groupID) {
		foreach($this->userGroups as $k => $v)
		{
			if (floatval($v) === floatval($groupID))
			{
				return true;
			}
		}
		return false;
	}
*/	
}