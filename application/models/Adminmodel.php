<?php
Class Adminmodel extends CI_Model {
	function list_admins() {
		$this->db_hat->select('*, hat_groups.name AS group_name, hat_users.id AS userid');
		$this->db_hat->from('hat_users')->order_by('hat_users.id','asc');
		$this->db_hat->join('hat_groups', 'hat_users.groupid = hat_groups.id');
		$query = $this->db_hat->get();
		return $query->result();
	}
	
	function list_groups() {
		$this->db_hat->select('id, name');
		$this->db_hat->from('hat_groups')->order_by('id','asc');
		$query = $this->db_hat->get();
		return $query->result_array();
	}
	
	function list_users_in_group($groupid) {
		$this->db_hat->select('hat_users.username, hat_users.id, hat_users.groupid');
		$this->db_hat->from('hat_users')->order_by('hat_users.username','asc');
		$this->db_hat->where('hat_users.groupid', $groupid);
		$query = $this->db_hat->get();
		return $query->result_array();
	}
	
	function get_user_data($userid) {
		$query = $this->db_hat->get_where('hat_users', array('id' => $userid));
		return $query->row();
	}
	
	function get_group_data($gid) {
		$query = $this->db_hat->get_where('hat_groups', array('id' => $gid));
		return $query->row();
	}
	
	function editadminuser($data) {
		if ($data['vacation'] == 1) {
			$data['vacationsince'] = date("Y-m-d H:i:s");
		}
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
			$this->db_hat->where('id', $data['id']);
			$this->db_hat->update('hat_users',array('passwd' => $newPassMD5));
		}
		// Update the data:
		unset($data['genpass']);
		$this->db_hat->where('id', $data['id']);
		$this->db_hat->update('hat_users', $data);
		if (isset($newPass)) {
			return $newPass;
		}
	}
	
	function get_loginlog($uid) {
		$this->db_hat->select('datetime,ip');
		$query = $this->db_hat->get_where('hat_loginlog', array('userid' => $uid));
		return $query->result_array();
	}
	
	function users_login_status($userid, $do) {
		// This function will lock or unlock all hat_users except the one who initiated the command.
		switch( $do ) {
			case "lock": // Lock all hat_users
				$query = array(
					'disablelogin' => 1);
				$this->db_hat->where('id <>', $userid);
				$this->db_hat->update('hat_users', $query);
				break;
			case "unlock": // Unlock all hat_users
				$query = array(
					'disablelogin' => 0);
				$this->db_hat->update('hat_users', $query);
				break;
		}
	}
		
	function addgroup($data) {
		// First get the list of permissions we need to insert into the database and set all those values to 1 so that we can insert them
		array_fill_keys($data['perms'], 1);
		$this->db_hat->set('id', $data['id']);
		$this->db_hat->set('name', $data['name']);
		$this->db_hat->set($data['perms']);
		$this->db_hat->insert('hat_groups');
	}
	
	function editgroup($data) {
		array_fill_keys($data['perms'], 1);
		$this->db_hat->where('id', $data['id']);
		$this->db_hat->set('name', $data['name']);
		$this->db_hat->set($data['perms']);
		$this->db_hat->update('hat_groups');
	}
		
	function addadminuser($data) {
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
		$newPass = '';
		for ($i = 0; $i < 15; $i++) {
			$newPass .= $chars[rand(0, strlen($chars) - 1)];
		}
		$newPassMD5 = md5($newPass);
		
		$this->db_hat->set('username', $data['username']);
		$this->db_hat->set('pemail', $data['pemail']);
		$this->db_hat->set('groupid', $data['groupid']);
		if (isset($data['gameacctid'])) {
			$this->db_hat->set('gameacctid', $data['gameacctid']);
		}
		$this->db_hat->set('passwd', $newPassMD5);
		$this->db_hat->set('disablelogin', '1');
		$this->db_hat->set('createdate', 'NOW()', FALSE);
		$this->db_hat->insert('hat_users');
		return $newPass;
	}
	
	function resetallpwd() {
		$this->db_hat->select('id, username, pemail');
		$this->db_hat->where('groupid <', $this->session_data['group']);
		$q = $this->db_hat->get('hat_users');
		$passwd = array();
		foreach ($q->result_array() as $r) {
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
			$newPass = '';
			for ($i = 0; $i < 15; $i++) {
				$newPass .= $chars[rand(0, strlen($chars) - 1)];
			}
			$newPassMD5 = md5($newPass);
			
			$this->db_hat->where('id', $r['id']);
			$this->db_hat->update('hat_users', array('passwd' => $newPassMD5));
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
		$this->db_hat->select('*');
		$q = $this->db_hat->get_where('hat_users', array('groupid' => $gid));
		$q_count = $q->num_rows();
		if ($q_count > 0) {
			return "groupfull";
		}
		
		// Then, delete the group..
		$this->db_hat->where('id', $gid);
		$this->db_hat->delete('hat_groups');
		return "ok";
	}
	
	function check_perm($sdata,$perm) {
		$this->db_hat->select($perm);
		$query = $this->db_hat->get_where('hat_groups', array('id' => $sdata));
		$perm_lv = $query->row();
		if ($perm_lv->$perm == 1) {
			return True;
		}
		elseif ($perm_lv->$perm == 0) {
			return False;
		}
	}
	
	function get_list_devs() {
		// Get list of groups that are marked "isdev" and not in vacation mode, i.e. can have bugs assigned to them.
		$users = array();
		$this->db_hat->select('hat_users.*, hat_groups.*, hat_users.id AS userid, hat_groups.id AS id');
		$this->db_hat->from('hat_users');
		$this->db_hat->join('hat_groups', 'hat_users.id = hat_groups.id');
		$this->db_hat->where('hat_users.vacation', 0);
		$this->db_hat->where('hat_groups.isdev', 1);
		$q = $this->db_hat->get();
		$q_array = $q->result_array();
		foreach ($q_array as $k=>$v) {
			// Select all users and their user ID's that are part of that group.
			$this->db_hat->select('id,username');
			$this->db_hat->where('groupid', $v['id']);
			$q_users = $this->db_hat->get('hat_users');
			foreach ($q_users->result_array() as $row) {
				$users[$row['id']] = $row['username'];
			}
		}
		return $users;
	}
	
	function list_admins_by_name() {
		// Returns an array with the key being userid, value being name.
		$users = array();
		$q = $this->db_hat->get('hat_users');
		foreach ($q->result_array() as $k=>$v) {
			$users[$v['id']] = $v['username'];
		}
		return $users;
	}
	
	function list_groups_by_name() {
		// Returns an array with the key being groupid, value being name.
		$groups = array();
		$q = $this->db_hat->get('hat_groups');
		foreach ($q->result_array() as $k=>$v) {
			$groups[$v['id']] = $v['name'];
		}
		return $groups;
	}
	
	function get_vacation_admins() {
		$users = array();
		$this->db_hat->select('vacation, vacationsince, username');
		$this->db_hat->where('vacation', 1);
		$q = $this->db_hat->get('hat_users');
		return $q->result_array();
	}
	
	function get_admin_name($id) {
		// Get's the admin name from their ID.
		$this->db_hat->select('username');
		$q = $this->db_hat->get_where('hat_users', array('id' => $id));
		
		if ($q !== FALSE && $q->num_rows() > 0) {
			return $id;
		}
		else {
			#$result = $q->row();
			return $q->row()->username;
		}
	}
	
	function get_admin_news() {
		$this->db_hat->select('hat_adminnews.*,hat_users.username');
		$this->db_hat->from('hat_adminnews')->order_by('hat_adminnews.active','desc');
		$this->db_hat->order_by('hat_adminnews.pinned','desc');
		$this->db_hat->order_by('hat_adminnews.id','desc');
		$this->db_hat->join('hat_users', 'hat_adminnews.user = hat_users.id');
		$q = $this->db_hat->get();
		if ($q !== FALSE && $q->num_rows() > 0) {
			return $q->result_array();
		}
		else {
			return 0;
		}
	}
	
	function add_admin_news($data) {
		// Get current date/time
		$data['date'] = date("Y-m-d H:i:s");
		$this->db_hat->insert('hat_adminnews', $data);
		echo $this->db_hat->last_query();
		return $this->db_hat->affected_rows();
	}
	
	function edit_admin_news($data) {
		$this->db_hat->where('id', $data['id']);
		$this->db_hat->update('hat_adminnews', $data);
		echo $this->db_hat->last_query();
		return $this->db_hat->affected_rows();
	}
	
	function delete_admin_news($id) {
		$this->db_hat->delete('hat_adminnews', array('id' => $id));
		return $this->db_hat->affected_rows();
	}
}