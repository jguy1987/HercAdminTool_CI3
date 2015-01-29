<?php
Class Adminmodel extends CI_Model {
	function list_admins() {
		$this->db_ragnarok->select('*, hat_groups.name AS group_name, hat_users.id AS userid');
		$this->db_ragnarok->from('hat_users')->order_by('hat_users.id','asc');
		$this->db_ragnarok->join('hat_groups', 'hat_users.groupid = hat_groups.id');
		$query = $this->db_ragnarok->get();
		return $query->result();
	}
	
	function list_groups() {
		$this->db_ragnarok->select('id, name');
		$this->db_ragnarok->from('hat_groups')->order_by('id','asc');
		$query = $this->db_ragnarok->get();
		return $query->result_array();
	}
	
	function list_users_in_group($groupid) {
		$this->db_ragnarok->select('hat_users.username, hat_users.id, hat_users.groupid');
		$this->db_ragnarok->from('hat_users')->order_by('hat_users.username','asc');
		$this->db_ragnarok->where('hat_users.groupid', $groupid);
		$query = $this->db_ragnarok->get();
		return $query->result_array();
	}
	
	function get_user_data($userid) {
		$query = $this->db_ragnarok->get_where('hat_users', array('id' => $userid));
		return $query->row();
	}
	
	function get_group_data($gid) {
		$query = $this->db_ragnarok->get_where('hat_groups', array('id' => $gid));
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
			$this->db_ragnarok->where('id', $data['id']);
			$this->db_ragnarok->update('hat_users',array('passwd' => $newPassMD5));
		}
		// Update the data:
		unset($data['genpass']);
		$this->db_ragnarok->where('id', $data['id']);
		$this->db_ragnarok->update('hat_users', $data);
		if (isset($newPass)) {
			return $newPass;
		}
	}
	
	function get_loginlog($uid) {
		$this->db_ragnarok->select('datetime,ip');
		$query = $this->db_ragnarok->get_where('hat_loginlog', array('userid' => $uid));
		return $query->result_array();
	}
	
	function users_login_status($userid, $do) {
		// This function will lock or unlock all hat_users except the one who initiated the command.
		switch( $do ) {
			case "lock": // Lock all hat_users
				$query = array(
					'disablelogin' => 1);
				$this->db_ragnarok->where('id <>', $userid);
				$this->db_ragnarok->update('hat_users', $query);
				break;
			case "unlock": // Unlock all hat_users
				$query = array(
					'disablelogin' => 0);
				$this->db_ragnarok->update('hat_users', $query);
				break;
		}
	}
		
	function addgroup($data) {
		// First get the list of permissions we need to insert into the database and set all those values to 1 so that we can insert them
		array_fill_keys($data['perms'], 1);
		$this->db_ragnarok->set('id', $data['id']);
		$this->db_ragnarok->set('name', $data['name']);
		$this->db_ragnarok->set($data['perms']);
		$this->db_ragnarok->insert('hat_groups');
	}
	
	function editgroup($data) {
		array_fill_keys($data['perms'], 1);
		$this->db_ragnarok->where('id', $data['id']);
		$this->db_ragnarok->set('name', $data['name']);
		$this->db_ragnarok->set($data['perms']);
		$this->db_ragnarok->update('hat_groups');
	}
		
	function addadminuser($data) {
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
		$newPass = '';
		for ($i = 0; $i < 15; $i++) {
			$newPass .= $chars[rand(0, strlen($chars) - 1)];
		}
		$newPassMD5 = md5($newPass);
		
		$this->db_ragnarok->set('username', $data['username']);
		$this->db_ragnarok->set('pemail', $data['pemail']);
		$this->db_ragnarok->set('groupid', $data['groupid']);
		if (isset($data['gameacctid'])) {
			$this->db_ragnarok->set('gameacctid', $data['gameacctid']);
		}
		$this->db_ragnarok->set('passwd', $newPassMD5);
		$this->db_ragnarok->set('disablelogin', '1');
		$this->db_ragnarok->set('createdate', 'NOW()', FALSE);
		$this->db_ragnarok->insert('hat_users');
		return $newPass;
	}
	
	function resetallpwd() {
		$this->db_ragnarok->select('id, username, pemail');
		$q = $this->db_ragnarok->get('hat_users');
		$passwd = array();
		foreach ($q->result_array() as $r) {
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
			$newPass = '';
			for ($i = 0; $i < 15; $i++) {
				$newPass .= $chars[rand(0, strlen($chars) - 1)];
			}
			$newPassMD5 = md5($newPass);
			
			$this->db_ragnarok->where('id', $r['id']);
			$this->db_ragnarok->update('hat_users', array('passwd' => $newPassMD5));
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
	
	function check_perm($sdata,$perm) {
		$this->db_ragnarok->select($perm);
		$query = $this->db_ragnarok->get_where('hat_groups', array('id' => $sdata));
		$perm_lv = $query->row();
		if ($perm_lv->$perm == 1) {
			return True;
		}
		elseif ($perm_lv->$perm == 0) {
			return False;
		}
	}
}