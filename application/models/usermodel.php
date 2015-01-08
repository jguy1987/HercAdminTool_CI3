<?php
Class Usermodel extends CI_Model {
	function login($username, $passwd) {
		$this->db_admin->select('id, username, passwd, groupid, lastlogin, disablelogin');
		$this->db_admin->from('users');
		$this->db_admin->where('username', $username);
		$this->db_admin->where('passwd', MD5($passwd));
		$this->db_admin->limit(1);
	 
		$query = $this->db_admin->get();
	 
		if($query->num_rows() == 1) {
		  return $query->result();
		}
		else {
		  return false;
		}
	}
	
	function update_user_module($userid,$module) {
		$this->db_admin->where('id', $userid);
		$this->db_admin->update('users', array('lastmodule' => $module));
	}
	
	function update_active($uid) {
		// Update the active date to now.
		$this->db_admin->where('id', $uid);
		$this->db_admin->set('lastlogin', 'NOW()', FALSE);
		$this->db_admin->update('users');
	}
}
?>