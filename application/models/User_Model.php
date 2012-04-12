<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model
{

	function __construct()
	{
		parent::__construct(); 

		$this->load->library('tank_auth');

		$this->load->model('ACL_Model', 'aclModel');
	}

	function getAllUsers($filters = array()) {
		$data = array();
		$this->db->select('*');
		$this->db->like($filters);
		$sql = $this->db->get('user_profiles');
		$data = $sql->result();
		return $data;
	}

	function saveUser($user) {

		if(isset($user['id']) && $user['id'] != ''){

			$user_profiles = array(
				'nome'	=> $user['nome'],
				'idade'	=> $user['idade']
			);

			$this->db->where('id', $user['id']);
			$ret1 = $this->db->update('user_profiles', $user_profiles); 				

			//set permission
 			$ret2 = $this->aclModel->setUserGroup($user['id'], $user['groupID']);

 			return $ret1 || $ret2;

		}else{

			//create user in auth table
			$data = $this->tank_auth->create_user('', $user['email'], $user['password'], FALSE);

			if($data){	
				$user_profiles = array(
					'nome'	=> $user['nome'],
					'idade'	=> $user['idade']
				);

				//update in profile table
				$this->db->where('auth_id', $data['user_id']);
	 			$this->db->update('user_profiles', $user_profiles); 	

	 			//get 'id' in profile table by auth_id
	 			$this->db->select('id')->where('auth_id', $data['user_id']);
				$dataUser = $this->db->get('user_profiles')->result();

				//set permission
	 			$result = $this->aclModel->setUserGroup($dataUser[0]->id, $user['groupID']);
	 			
	 			return $result;
 			}
		}	
	}

	function removeUser($id) {
		$this->db->where('id', $id);
		return $this->db->delete('user_profiles'); 
	}

	function getUser($id) {
		$data = array();
		$this->db->select('*');
		$this->db->where('id', $id);
		$sql = $this->db->get('user_profiles');
		$data = $sql->result();

		return $data;
	}

}