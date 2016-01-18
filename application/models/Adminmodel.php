<?php
Class Adminmodel extends CI_Model {
	function list_admins() {
		$this->db_login->select('*, hat_groups.name AS group_name, hat_users.id AS userid');
		$this->db_login->from('hat_users')->order_by('hat_users.id','asc');
		$this->db_login->join('hat_groups', 'hat_users.groupid = hat_groups.id');
		$query = $this->db_login->get();
		return $query->result();
	}
	
	function list_groups() {
		$this->db_login->select('id, name');
		$this->db_login->from('hat_groups')->order_by('id','asc');
		$query = $this->db_login->get();
		return $query->result_array();
	}
	
	function list_users_in_group($groupid) {
		$this->db_login->select('hat_users.username, hat_users.id, hat_users.groupid');
		$this->db_login->from('hat_users')->order_by('hat_users.username','asc');
		$this->db_login->where('hat_users.groupid', $groupid);
		$query = $this->db_login->get();
		return $query->result_array();
	}
	
	function get_user_data($userid) {
		$query = $this->db_login->get_where('hat_users', array('id' => $userid));
		return $query->row();
	}
	
	function get_group_data($gid) {
		$query = $this->db_login->get_where('hat_groups', array('id' => $gid));
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
			$this->db_login->where('id', $data['id']);
			$this->db_login->update('hat_users',array('passwd' => $newPassMD5));
		}
		// Update the data:
		unset($data['genpass']);
		$this->db_login->where('id', $data['id']);
		$this->db_login->update('hat_users', $data);
		if (isset($newPass)) {
			return $newPass;
		}
	}
	
	function get_loginlog($uid) {
		$this->db_login->select('datetime,ip');
		$query = $this->db_login->get_where('hat_loginlog', array('userid' => $uid));
		return $query->result_array();
	}
	
	function users_login_status($userid, $do) {
		// This function will lock or unlock all hat_users except the one who initiated the command.
		switch( $do ) {
			case "lock": // Lock all hat_users
				$query = array(
					'disablelogin' => 1);
				$this->db_login->where('id <>', $userid);
				$this->db_login->update('hat_users', $query);
				break;
			case "unlock": // Unlock all hat_users
				$query = array(
					'disablelogin' => 0);
				$this->db_login->update('hat_users', $query);
				break;
		}
	}
		
	function addgroup($data) {
		// First get the list of permissions we need to insert into the database and set all those values to 1 so that we can insert them
		array_fill_keys($data['perms'], 1);
		$this->db_login->set('id', $data['id']);
		$this->db_login->set('name', $data['name']);
		$this->db_login->set($data['perms']);
		$this->db_login->insert('hat_groups');
	}
	
	function editgroup($data) {
		array_fill_keys($data['perms'], 1);
		$this->db_login->where('id', $data['id']);
		$this->db_login->set('name', $data['name']);
		$this->db_login->set($data['perms']);
		$this->db_login->update('hat_groups');
	}
		
	function addadminuser($data) {
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
		$newPass = '';
		for ($i = 0; $i < 15; $i++) {
			$newPass .= $chars[rand(0, strlen($chars) - 1)];
		}
		$newPassMD5 = md5($newPass);
		
		$this->db_login->set('username', $data['username']);
		$this->db_login->set('pemail', $data['pemail']);
		$this->db_login->set('groupid', $data['groupid']);
		if (isset($data['gameacctid'])) {
			$this->db_login->set('gameacctid', $data['gameacctid']);
		}
		$this->db_login->set('passwd', $newPassMD5);
		$this->db_login->set('disablelogin', '1');
		$this->db_login->set('createdate', 'NOW()', FALSE);
		$this->db_login->insert('hat_users');
		return $newPass;
	}
	
	function resetallpwd() {
		$this->db_login->select('id, username, pemail');
		$this->db_login->where('groupid <', $this->session_data['group']);
		$q = $this->db_login->get('hat_users');
		$passwd = array();
		foreach ($q->result_array() as $r) {
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
			$newPass = '';
			for ($i = 0; $i < 15; $i++) {
				$newPass .= $chars[rand(0, strlen($chars) - 1)];
			}
			$newPassMD5 = md5($newPass);
			
			$this->db_login->where('id', $r['id']);
			$this->db_login->update('hat_users', array('passwd' => $newPassMD5));
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
	
	function delete_group($gid) {
		// First, check to make sure we're not trying to delete the admin group...
		if ($gid == 99) {
			return "group99";
		}
		
		// Then make sure there are no admins in this group...
		$this->db_login->select('*');
		$q = $this->db_login->get_where('hat_users', array('groupid' => $gid));
		$q_count = $q->num_rows();
		if ($q_count > 0) {
			return "groupfull";
		}
		
		// Then, delete the group..
		$this->db_login->where('id', $gid);
		$this->db_login->delete('hat_groups');
		return "ok";
	}
	
	function check_perm($sdata,$perm) {
		$this->db_login->select($perm);
		$query = $this->db_login->get_where('hat_groups', array('id' => $sdata));
		$perm_lv = $query->row();
		if ($perm_lv->$perm == 1) {
			return True;
		}
		elseif ($perm_lv->$perm == 0) {
			return False;
		}
	}
}