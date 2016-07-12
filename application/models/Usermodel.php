<?php
Class Usermodel extends CI_Model {
	function login($username, $passwd) {
		$this->db_hat->select('id, username, passwd, groupid, lastactive, disablelogin');
		$this->db_hat->from('hat_users');
		$this->db_hat->where('username', $username);
		$this->db_hat->where('passwd', MD5($passwd));
	 
		$query = $this->db_hat->get();
	 
		if($query->num_rows() == 1) {
		  return $query->result();
		}
		else {
		  return false;
		}
	}
	
	function update_user_active($userid,$module) {
		$this->db_hat->where('id', $userid);
		$this->db_hat->set('lastmodule', $module);
		$this->db_hat->set('lastactive', 'NOW()', FALSE);
		$this->db_hat->update('hat_users');
	}

	function get_perms($gid,$perms) {
		$perm_list = array();
		$mergedPerms = array();
		foreach ($perms as $k) {
			$mergedPerms += array_merge($k);
		}
		foreach ($mergedPerms as $k=>$v) {
			$this->db_hat->select($k);
			$this->db_hat->where('id', $gid);
			$query = $this->db_hat->get('hat_groups');
			$q2 = $query->row();
			$perm_list += array(
				$k => $q2->{$k},
			);
		}
		return $perm_list;
	}
	
	function update_loginlog($uid,$ip) {
		// Get current date
		$this->db_hat->set('datetime', 'NOW()', FALSE);
		$this->db_hat->set('userid', $uid);
		$this->db_hat->set('ip', $ip);
		$this->db_hat->insert('hat_loginlog');
	}
	
	function get_user_settings($uid) {
		$this->db_hat->select('hat_users.*,hat_groups.name AS groupname');
		$this->db_hat->from('hat_users');
		$this->db_hat->where('hat_users.id', $uid);
		$this->db_hat->join('hat_groups', 'hat_users.groupid = hat_groups.id');
		$q = $this->db_hat->get();
		return $q->row();
	}
	
	function get_user_logins($uid) {
		$q = $this->db_hat->get_where('hat_loginlog', array('userid' => $uid));
		return $q->result_array($q);
	}
	
	function get_user_permissions($gid) {
		$q = $this->db_hat->get_where('hat_groups', array('id' => $gid));
		$q_result = $q->result_array();
		$perms = array();
		$hat_perms2 = array();
		$hat_perms = $this->config->item('permissions');
		foreach($hat_perms as $value) {
			$hat_perms2 += $value;
		}
		foreach($q_result as $k=>$v) {
			if ($v == 1) {
				$perms += array($hat_perms2[$k]);
			}
		}
		return $perms;
	}
}
?>