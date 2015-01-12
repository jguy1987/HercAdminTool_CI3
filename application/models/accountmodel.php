<?php
Class Accountmodel extends CI_Model {
	
	function list_accounts() {
		$this->db_ragnarok->where('sex !=', 'S');
		$query = $this->db_ragnarok->get('login');
		return $query->result();
	}
	
	function get_acct_details($aid) {
		$query = $this->db_ragnarok->get_where('login', array('account_id' => $aid));
		return $query->row();
	}
	
	function add_account($data) {
		// First, need to generate new password.
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
		$newPass = '';
		$pincode = '';
		for ($i = 0; $i < 15; $i++) {
			$newPass .= $chars[rand(0, strlen($chars) - 1)];
		}
		$pinchars = '0123456789';
		for ($i = 0; $i < 4; $i++) {
			$pincode .= $pinchars[rand(0, strlen($pinchars) - 1)];
		}
		$newPassMD5 = md5($newPass);
		
		$newAcct = array(
			'passwd'		=> $newPass,
			'pincode'	=> $pincod,
		);	
		$this->db_ragnarok->set('user_pass', $newPassMD5);
		$this->db_ragnarok->set('createdate', 'NOW()', FALSE);
		$this->db_ragnarok->insert('login', $data);
		return $newAcct;
	}
	
	function get_char_list($aid) {
		$this->db_ragnarok->select('char.char_id,char.account_id,char.char_num,char.name,char.class,char.base_level,char.job_level,char.guild_id AS char_guid,char.online,char.sex,guild.guild_id,guild.name AS guild_name');
		$this->db_ragnarok->from('char')->order_by('char.char_num','asc');
		$this->db_ragnarok->where('char.account_id',$aid);
		$this->db_ragnarok->join('guild', 'char.guild_id = guild.guild_id');
		$query = $this->db_ragnarok->get();
		return $query->result_array();
	}
}