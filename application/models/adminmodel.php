<?php
Class Adminmodel extends CI_Model {
	function list_admins() {
		$this->db_admin->select('*, hat_groups.name AS group_name, hat_users.id AS userid');
		$this->db_admin->from('hat_users')->order_by('hat_users.id','asc');
		$this->db_admin->join('hat_groups', 'hat_users.groupid = hat_groups.id');
		$query = $this->db_admin->get();
		return $query->result();
	}
	
	function list_groups() {
		$this->db_admin->select('id, name');
		$this->db_admin->from('hat_groups')->order_by('id','asc');
		$query = $this->db_admin->get();
		return $query->result_array();
	}
	
	function list_users_in_group($groupid) {
		$this->db_admin->select('hat_users.username, hat_users.id, hat_users.groupid');
		$this->db_admin->from('hat_users')->order_by('hat_users.username','asc');
		$this->db_admin->where('hat_users.groupid', $groupid);
		$query = $this->db_admin->get();
		return $query->result_array();
	}
	
	function get_user_data($userid) {
		$query = $this->db_admin->get_where('hat_users', array('id' => $userid));
		return $query->row();
	}
	
	function editadminuser($data) {
		// First, check to see if we need to generate a new pass:
		if ($data['genpass'] == true) {
			// Generate new 15 char password, convert to MD5 and store it for email
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
			$newPass = '';
			for ($i = 0; $i < 15; $i++) {
				$newPass .= $chars[rand(0, strlen($chars) - 1)];
			}
			$newPassMD5 = md5($newPass);
			unset($data['genpass']);
			$this->db_admin->where('id', $data['id']);
			$this->db_admin->update('hat_users',array('passwd' => $newPassMD5));
		}
		// Update the data:
		unset($data['genpass']);
		$this->db_admin->where('id', $data['id']);
		$this->db_admin->update('hat_users', $data);
		if (isset($newPass)) {
			return $newPass;
		}
	}
	
	function users_login_status($userid, $do) {
		// This function will lock or unlock all hat_users except the one who initiated the command.
		switch( $do ) {
			case "lock": // Lock all hat_users
				$query = array(
					'disablelogin' => 1);
				$this->db_admin->where('id <>', $userid);
				$this->db_admin->update('hat_users', $query);
				break;
			case "unlock": // Unlock all hat_users
				$query = array(
					'disablelogin' => 0);
				$this->db_admin->update('hat_users', $query);
				break;
		}
	}
		
	function addgroup($data) {
		// First get the list of permissions we need to insert into the database and set all those values to 1 so that we can insert them
		array_fill_keys($data['perms'], 1);
		$this->db_admin->set('id', $data['id']);
		$this->db_admin->set('name', $data['name']);
		$this->db_admin->set($data['perms']);
		$this->db_admin->insert('hat_groups');
	}
		
	function addadminuser($data) {
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
		$newPass = '';
		for ($i = 0; $i < 15; $i++) {
			$newPass .= $chars[rand(0, strlen($chars) - 1)];
		}
		$newPassMD5 = md5($newPass);
		
		$this->db_admin->set('username', $data['username']);
		$this->db_admin->set('pemail', $data['pemail']);
		$this->db_admin->set('groupid', $data['groupid']);
		if (isset($data['gameacctid'])) {
			$this->db_admin->set('gameacctid', $data['gameacctid']);
		}
		$this->db_admin->set('passwd', $newPassMD5);
		$this->db_admin->set('disablelogin', '1');
		$this->db_admin->set('createdate', 'NOW()', FALSE);
		$this->db_admin->insert('hat_users');
		return $newPass;
	}
	
	function resetallpwd() {
		$this->db_admin->select('id, username, pemail');
		$q = $this->db_admin->get('hat_users');
		$passwd = array();
		foreach ($q->result_array() as $r) {
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
			$newPass = '';
			for ($i = 0; $i < 15; $i++) {
				$newPass .= $chars[rand(0, strlen($chars) - 1)];
			}
			$newPassMD5 = md5($newPass);
			
			$this->db_admin->where('id', $r['id']);
			$this->db_admin->update('hat_users', array('passwd' => $newPassMD5));
			$passwd += array(
				$r['id'] => array(
					'username' 	=> $r['username'],
					'passwd'	=> $newPass,
					'pemail'		=> $r['pemail']
				)
			);
		}
		return $passwd;
	}
}