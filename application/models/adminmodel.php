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
	
	function editadminuser($data) {
		// First, check to see if we need to generate a new pass:
		if ($data['genpass'] == true) {
			// Generate new 15 char password, convert to MD5 and store it for email
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
			$string = '';
			for ($i = 0; $i < 15; $i++) {
				$string .= $chars[rand(0, strlen($chars) - 1)];
			}
			$newPass = md5($string);
			unset($data['genpass']);
			$this->db->where('id', $data['id']);
			$this->db->update('users',array('passwd' => $newPass));
		}
		// Update the data:
		unset($data['genpass']);
		$this->db->where('id', $data['id']);
		$this->db->update('users', $data);
	}
	
	/*function addgroup($data) {
		// First get the list of permissions we need to insert into the database and set all those values to 1 so that we can insert them
		array_fill_keys($data['perms'], 1);
		foreach($data['perms'] as $data) {
		// Then, insert them.
		
		$this->db->insert
		}*/
		
	function addadminuser($data) {
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
		$string = '';
		for ($i = 0; $i < 15; $i++) {
			$string .= $chars[rand(0, strlen($chars) - 1)];
		}
		$newPass = md5($string);
		
		$this->db->set('username', $data['username']);
		$this->db->set('pemail', $data['pemail']);
		$this->db->set('groupid', $data['groupid']);
		if (isset($data['gameacctid'])) {
			$this->db->set('gameacctid', $data['gameacctid']);
		}
		$this->db->set('passwd', $newPass);
		$this->db->set('disablelogin', '1');
		$this->db->set('createdate', 'NOW()', FALSE);
		$this->db->insert('users');
	}
}