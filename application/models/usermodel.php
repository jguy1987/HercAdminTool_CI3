<?php
Class Usermodel extends CI_Model {
	function login($username, $passwd) {
		$this->db_ragnarok->select('id, username, passwd, groupid, lastlogin, disablelogin');
		$this->db_ragnarok->from('hat_users');
		$this->db_ragnarok->where('username', $username);
		$this->db_ragnarok->where('passwd', MD5($passwd));
		$this->db_ragnarok->limit(1);
	 
		$query = $this->db_ragnarok->get();
	 
		if($query->num_rows() == 1) {
		  return $query->result();
		}
		else {
		  return false;
		}
	}
	
	function update_user_module($userid,$module) {
		$this->db_ragnarok->where('id', $userid);
		$this->db_ragnarok->update('hat_users', array('lastmodule' => $module));
	}
	
	function update_active($uid) {
		// Update the active date to now.
		$this->db_ragnarok->where('id', $uid);
		$this->db_ragnarok->set('lastlogin', 'NOW()', FALSE);
		$this->db_ragnarok->set('active', "1");
		$this->db_ragnarok->update('hat_users');
	}
	
	function get_perms($gid,$perms) {
		$perm_list = array();
		foreach ($perms as $k=>$v) {
			$this->db_ragnarok->select($k);
			$this->db_ragnarok->where('id', $gid);
			$query = $this->db_ragnarok->get('hat_groups');
			$q2 = $query->row();
			$perm_list += array(
				$k => $q2->{$k},
			);
		}
		return $perm_list;
	}
}
?>