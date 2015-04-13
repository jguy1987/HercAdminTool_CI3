<?php
Class Usermodel extends CI_Model {
	function login($username, $passwd) {
		$this->db_login->select('id, username, passwd, groupid, lastactive, disablelogin');
		$this->db_login->from('hat_users');
		$this->db_login->where('username', $username);
		$this->db_login->where('passwd', MD5($passwd));
		$this->db_login->limit(1);
	 
		$query = $this->db_login->get();
	 
		if($query->num_rows() == 1) {
		  return $query->result();
		}
		else {
		  return false;
		}
	}
	
	function update_user_active($userid,$module) {
		$this->db_login->where('id', $userid);
		$this->db_login->set('lastmodule', $module);
		$this->db_login->set('lastactive', 'NOW()', FALSE);
		$this->db_login->update('hat_users');
	}

	function get_perms($gid,$perms) {
		$perm_list = array();
		$mergedPerms = array();
		foreach ($perms as $k) {
			$mergedPerms += array_merge($k);
		}
		foreach ($mergedPerms as $k=>$v) {
			$this->db_login->select($k);
			$this->db_login->where('id', $gid);
			$query = $this->db_login->get('hat_groups');
			$q2 = $query->row();
			$perm_list += array(
				$k => $q2->{$k},
			);
		}
		return $perm_list;
	}
	
	function update_loginlog($uid,$ip) {
		// Get current date
		$this->db_login->set('datetime', 'NOW()', FALSE);
		$this->db_login->set('userid', $uid);
		$this->db_login->set('ip', $ip);
		$this->db_login->insert('hat_loginlog');
	}
}
?>