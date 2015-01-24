<?php
Class Accountmodel extends CI_Model {
	
	function list_accounts() {
		$this->db_ragnarok->where('sex !=', 'S');
		$this->db_ragnarok->order_by('account_id','asc');
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
			'pincode'	=> $pincode,
		);	
		$this->db_ragnarok->set('user_pass', $newPassMD5);
		$this->db_ragnarok->set('pincode', $pincode);
		$this->db_ragnarok->set('createdate', 'NOW()', FALSE);
		$this->db_ragnarok->set('register_ip', '127.0.0.1', TRUE);
		$this->db_ragnarok->set('auth_ip', '127.0.0.1', TRUE);
		$this->db_ragnarok->insert('login', $data);
		return $newAcct;
	}
	
	function get_char_list($aid) {
		$this->db_ragnarok->select('char.char_id,char.account_id,char.char_num,char.name,char.class,char.base_level,char.job_level,char.guild_id AS char_guid,char.online,char.sex,guild.guild_id,guild.name AS guild_name');
		$this->db_ragnarok->from('char')->order_by('char.char_num','asc');
		$this->db_ragnarok->where('char.account_id',$aid);
		$this->db_ragnarok->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$query = $this->db_ragnarok->get();
		return $query->result_array();
	}
	
	function get_acct_notes($aid) {
		$this->db_ragnarok->select('hat_acctnotes.acct_id,hat_acctnotes.datetime,hat_acctnotes.userid,hat_acctnotes.note,hat_users.id,hat_users.username');
		$this->db_ragnarok->from('hat_acctnotes')->order_by('hat_acctnotes.note_id','desc');
		$this->db_ragnarok->where('hat_acctnotes.acct_id',$aid);
		$this->db_ragnarok->join('hat_users', 'hat_acctnotes.userid = hat_users.id');
		$q = $this->db_ragnarok->get();
		return $q->result_array();
	}
	
	function get_block_hist($aid) {
		$this->db_ragnarok->select('hat_blockinfo.*,p1.username AS blockname,p2.username AS ublockname');
		$this->db_ragnarok->from('hat_blockinfo')->order_by('hat_blockinfo.blockid','desc');
		$this->db_ragnarok->join('hat_users AS p1', 'hat_blockinfo.block_user = p1.id','left');
		$this->db_ragnarok->join('hat_users AS p2', 'hat_blockinfo.unblock_user = p2.id','left');
		$this->db_ragnarok->where('hat_blockinfo.acct_id',$aid);
		$q = $this->db_ragnarok->get();
		return $q->result_array();
	}
	
	function add_note($newNote) {
		$newNote['datetime'] = date("Y-m-d H:i:s");
		$this->db_ragnarok->insert('hat_acctnotes', $newNote);
	}
}