<?php
Class Adminmodel extends CI_Model {
	function list_admins() {
		$this->db->select('*, groups.name AS group_name, users.id AS userid');
		$this->db->from('users')->order_by('users.id','asc');
		$this->db->join('groups', 'users.groupid = groups.id');
		$query = $this->db->get();
		return $query->result();
	}
	
	function list_groups() {
		$this->db->select('id, name');
		$this->db->from('groups')->order_by('id','asc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function list_users_in_group($groupid) {
		$this->db->select('users.username, users.id, users.groupid');
		$this->db->from('users')->order_by('users.username','asc');
		$this->db->where('users.groupid', $groupid);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_user_data($userid) {
		$query = $this->db->get_where('users', array('id' => $userid));
		return $query->row();
	}
	
	/*function check_user_if_exists($username) {
		$query = $this->db->get_where('users', array('name' => $username));
		if ($query->num_rows() > 0) {
			return True; //Username exists already
		}
		else {
			return False; // Username does not exist
		}
	}*/
	
	function editadminuser($data) {
		$this->db->where('id', $data['id']);
		// First, check to see if we need to generate a new pass:
		if ($data['genpass'] == True) {
			// Generate new 15 char password, convert to MD5 and store it for email
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 15; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$newPass = md5($randomString);
			$this->db->update('users',array('passwd' => $newPass));
		}
		// Update the data:
		unset($data['genpass']);
		$this->db->update('users', $data);
	}
}