<?php
Class Accountmodel extends CI_Model {
	
	function list_accounts() {
		$this->db_login->where('sex !=', 'S');
		$this->db_login->order_by('account_id','asc');
		$query = $this->db_login->get('login');
		return $query->result_array();
	}
	
	function get_acct_details($aid) {
		$query = $this->db_login->get_where('login', array('account_id' => $aid));
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
		$q = array(
			'userid'				=> $data['userid'],
			'user_pass'			=> $newPassMD5,
			'sex'					=> $data['sex'],
			'email'				=> $data['email'],
			'group_id'			=> $data['group_id'],
			'pincode'			=> $pincode,
			'birthdate'			=> $data['birthdate'],
			'character_slots' => $data['character_slots'],
		);
		
		$this->db_login->insert('login', $q);
		$id = $this->db_login->insert_id();
		$this->db_login->reset_query();
		$log = array(
			'account_id'		=> $id,
			'createdate'		=> date("Y-m-d"),
			'register_ip'		=> '127.0.0.1',
			'auth_ip'			=> '127.0.0.1',
		);
		$this->db_login->insert('hat_herc_login', $log);
		return $newAcct;
	}
	
	function get_char_list($aid) {
		$this->db_charmap->select('char.char_id,char.account_id,char.char_num,char.name,char.class,char.base_level,char.job_level,char.delete_date,char.guild_id AS char_guid,char.online,char.sex,guild.guild_id,guild.name AS guild_name');
		$this->db_charmap->from('char')->order_by('char.char_num','asc');
		$this->db_charmap->where('char.account_id',$aid);
		$this->db_charmap->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$query = $this->db_charmap->get();
		return $query->result_array();
	}
	
	function get_acct_notes($aid) {
		$this->db_login->select('*');
		$this->db_login->from('hat_acctnotes')->order_by('note_id','desc');
		$this->db_login->where('acct_id',$aid);
		$q = $this->db_login->get();
		
		return $q->result_array();
	}
	
	function get_block_hist($aid) {
		$this->db_login->select('*');
		$this->db_login->from('hat_blockinfo')->order_by('hat_blockinfo.blockid','desc');
		$this->db_login->where('hat_blockinfo.acct_id',$aid);
		$q = $this->db_login->get();
		return $q->result_array();
	}
	
	function get_acct_changes($aid) {
		$this->db_login->select('*');
		$this->db_login->from('hat_accteditlog')->order_by('datetime','desc');
		$this->db_login->where('acct_id', $aid);
		$query = $this->db_login->get();
		return $query->result_array();
	}
	
	function get_storage_items($aid) {
		$this->db_charmap->select('storage.*,item_db.id AS item_id,item_db.name_japanese,item_db.type');
		$this->db_charmap->from('storage')->order_by('storage.id', 'asc');
		$this->db_charmap->where('storage.account_id', $aid);
		$this->db_charmap->join('item_db', 'storage.nameid = item_db.id', 'left');
		$q = $this->db_charmap->get();
		if ($q !== FALSE && $q->num_rows() > 0) {
			return $q->result_array();
		}
		else {
			return 0;
		}
	}
	
	function add_note($newNote) {
		$newNote['datetime'] = date("Y-m-d H:i:s");
		$this->db_login->insert('hat_acctnotes', $newNote);
	}
	
	function get_num_key_list($aid) {
		$this->db_login->select('*');
		$query = $this->db_login->get_where('acc_reg_num_db', array('account_id' => $aid));
		return $query->result_array();
	}
	
	function get_str_key_list($aid) {
		$this->db_login->select('*');
		$query = $this->db_login->get_where('acc_reg_str_db', array('account_id' => $aid));
		return $query->result_array();
	}
	
	function edit_acct_details($chgAcct) {
		$timeNow = date("Y-m-d H:i:s");
		
		// First, we need to find out what changed...so that we can insert logs
		$this->db_login->select('account_id,email,sex,group_id,character_slots,birthdate');
		$chgRecq = $this->db_login->get_where('login', array('account_id' => $chgAcct['account_id']));
		$chgRec = $chgRecq->row();
		$this->db_login->set('datetime', $timeNow);
		$this->db_login->set('user', $chgAcct['user']);
		$this->db_login->set('acct_id', $chgAcct['account_id']);
		foreach ($chgAcct as $k=>$v) {
			if ($k == "user" || $k == "charid") {
			}
			else {
				if ($chgRec->$k != $v) {
					$this->db_login->set('chg_attr', $k);
					$this->db_login->set('old_value', $chgRec->$k);
					$this->db_login->set('new_value', $v);
					$this->db_login->insert('hat_accteditlog');
				}
			}
		}
		$this->db_login->reset_query();
		// Then, change data in the login table
		$this->db_login->where('account_id', $chgAcct['account_id']);
		unset($chgAcct['user'],$chgAcct['account_id']);
		$this->db_login->set($chgAcct);
		$this->db_login->update('login');
	}
	
	function apply_acct_ban($newBan) {
		// First, get the current time that the ban is being applied
		$timeNow = date("Y-m-d H:i:s");
		$newBanTime = strtotime($newBan['unban_date']);
		
		// Next, add the ban to the hat table
		$this->db_login->set('blockdate', $timeNow);
		$this->db_login->set('expiredate', $newBan['unban_date']);
		$this->db_login->set('block_type', $newBan['type']);
		$this->db_login->set('acct_id', $newBan['account_id']);
		$this->db_login->set('block_user', $newBan['userid']);
		$this->db_login->set('block_comment', $newBan['comments']);
		$this->db_login->set('reason', $newBan['reason']);
		$this->db_login->insert('hat_blockinfo');
		
		// We need to figure out if the account already has a permanent ban or 
		// a ban for a longer period of time than the one we're applying.
		$this->db_login->select('state, unban_time');
		$this->db_login->where('account_id', $newBan['account_id']);
		$query = $this->db_login->get('login');
		$q_checkban = $query->row();
		if ($q_checkban->state != 5 && $q_checkban->unban_time < $newBanTime) { // Account is not already permanently banned nor has a ban lasting longer than the ban we're applying
		
			// Then, set the login table accordingly.
			if ($newBan['type'] == "perm") {
				$this->db_login->set('state', 5);
				$this->db_login->set('unban_time', 0);
			}
			elseif ($newBan['type'] == "temp") {
				$this->db_login->set('unban_time', $newBanTime);
			}
			$this->db_login->where('account_id', $newBan['account_id']); 
			$this->db_login->update('login');
		} // If the account is already permanently banned or has a ban longer than the ban we're currently setting, do nothing.
		
		// Now, find any characters online from this account and kick them off.
		$this->db_charmap->select('char_id');
		$this->db_charmap->where('online', 1);
		$this->db_charmap->where('account_id', $newBan['account_id']);
		$q = $this->db_charmap->get('char');
		$result = $q->row();
		if ($q->num_rows() > 0) { // A character is online
			$this->load->model('servermodel');
			$this->servermodel->apply_server_kick($result->char_id, $this->session->userdata('server_select'));
		} // No character is online.
	}
	
	function apply_acct_unban($remBan) {
		// First, get the current time that the unban is being applied
		$timeNow = date("Y-m-d H:i:s");
		
		// Add the unban data to the hat table.
		$this->db_login->where('blockid', $remBan['blockid']);
		$this->db_login->set('unblock_user', $remBan['unblock_user']);
		$this->db_login->set('unblock_comment', $remBan['unblock_comment']);
		$this->db_login->set('unblock_date', $timeNow);
		$this->db_login->update('hat_blockinfo');
		
		// Then, figure out if the block we're removing is the only active block on that account.
		$this->db_login->select('blockid');
		$get_where = "acct_id = '{$remBan['acct_id']}' AND expiredate > '{$timeNow}' AND unblock_date IS NULL";
		$this->db_login->where($get_where);
		$query = $this->db_login->get('hat_blockinfo');
		$row_q1_cnt = $query->num_rows();
		if ($row_q1_cnt < 1) { // The ban we're removing is the only active block on that account
			// Therefore, we can reset account status.
			$this->db_login->set('state', 0);
			$this->db_login->set('unban_time', 0);
			$this->db_login->update('login');
		} // The account still has a past or future ban that is expiring at a later time, do nothing to the account here.
		elseif ($row_q1_cnt >= 1) { // The ban we're removing is not the only one. We need to check if there is a ban still existing that we need to change the unban_time to instead...
			$this->db_login->select_max('expiredate');
			$where_unblockdate = "acct_id = '{$remBan['acct_id']}' AND unblock_date IS NULL";
			$this->db_login->where($where_unblockdate);
			$query2 = $this->db_login->get('hat_blockinfo');
			$q2_maxban = $query2->row();
			
			$this->db_login->where('account_id', $remBan['acct_id']);
			$this->db_login->set('unban_time', strtotime($q2_maxban->expiredate));
			$this->db_login->update('login');
		}
	}
	
	function reset_pass($aid,$userid) {
		$timeNow = date("Y-m-d H:i:s");
		
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
		
		// Update the password
		$this->db_login->where('account_id', $aid);
		$this->db_login->set('user_pass', $newPassMD5);
		$this->db_login->update('login');
		
		// Grab the email address and account name from the database to send an email
		$this->db_login->select('userid,email');
		$query = $this->db_login->get_where('login', array('account_id' => $aid));
		$getAcctInfo = $query->row();
		
		// Then update the log to reflect the password being reset.
		$this->db_login->set('datetime', $timeNow);
		$this->db_login->set('user', $userid);
		$this->db_login->set('acct_id', $aid);
		$this->db_login->set('chg_attr', 'password');
		$this->db_login->set('old_value', 0);
		$this->db_login->set('new_value', 0);
		$this->db_login->insert('hat_accteditlog');
		
		// Finally, put everything in a nice array to return.
		$acctInfo = array(
			'pass'	=> $newPass,
			'userid'	=> $getAcctInfo->userid,
			'email'	=> $getAcctInfo->email
		);
		return $acctInfo;
	}
	
	function search_accts($searchTerms) {
		$this->db_login->select('login.account_id AS account_id, login.userid AS userid, login.sex AS sex, login.group_id AS group_id, login.email AS email, login.lastlogin AS lastlogin, login.unban_time AS unban_time, login.state AS state, hat_herc_login.createdate AS createdate');
		$this->db_login->from('login');
		$this->db_login->join('hat_herc_login', 'login.account_id = hat_herc_login.account_id', 'left outer');
		// First, figure out what we're searching for
		if (empty($searchTerms['acct_id']) == false) {
			if (substr($searchTerms['acct_id'], 0, 1) == "=") {
				$searchTerms['acct_id'] = substr($searchTerms['acct_id'], 1);
				$this->db_login->where('login.account_id', $searchTerms['acct_id']);
			}
			else {
				$this->db_login->like('login.account_id', $searchTerms['acct_id']);
			}
		}
		if (empty($searchTerms['acct_name']) == false) {
			if (substr($searchTerms['acct_name'], 0, 1) == "=") {
				$searchTerms['acct_name'] = substr($searchTerms['acct_name'], 1);
				$this->db_login->where('login.userid', $searchTerms['acct_name']);
			}
			else {
				$this->db_login->like('login.userid', $searchTerms['acct_name']);
			}
		}
		if (empty($searchTerms['email']) == false) {
			if (substr($searchTerms['email'], 0, 1) == "=") {
				$searchTerms['email'] = substr($searchTerms['email'], 1);
				$this->db_login->where('login.email', $searchTerms['email']);
			}
			else {
				$this->db_login->like('login.email', $searchTerms['email']);
			}
		}
		if (empty($searchTerms['gender']) == false) {
			$this->db_login->like('login.sex', $searchTerms['gender']);
		}
		if ($searchTerms['isGM'] == 1) {
			$this->db_login->where('login.group_id >', 0);
		}
		if ($searchTerms['isBanned'] == 1) {
			$this->db_login->where('login.unban_time >', 0);
			$this->db_login->where('login.state', 5);
		}
		$this->db_login->where('login.sex !=', 'S');
		$q = $this->db_login->get();
		return $q->result_array();
	}
	
	function add_flag($addFlag, $type) {
		$timeNow = date("Y-m-d H:i:s");
		
		$new_value = $addFlag['key'].",&nbsp;".$addFlag['index'].",&nbsp;".$addFlag['value'];
		$this->db_login->set('acct_id', $addFlag['acct_id']);
		$this->db_login->set('user', $addFlag['user']);
		$this->db_login->set('datetime', $timeNow);
		$attr = "add_".$type."_flag";
		$this->db_login->set('chg_attr', $attr);
		$this->db_login->set('new_value', $new_value);
		$this->db_login->insert('hat_accteditlog');
		
		if (empty($addFlag['index']) == false) {
			$this->db_login->set('index', $addFlag['index']);
		}
		$this->db_login->set('account_id', $addFlag['acct_id']);
		$this->db_login->set('key', $addFlag['key']);
		$this->db_login->set('value', $addFlag['value']);
		$insert = "acc_reg_".$type."_db";
		$this->db_login->insert($insert);
	}
	
	function edit_flag($editFlag, $type) {
		$timeNow = date("Y-m-d H:i:s");
		$table = "acc_reg_".$type."_db";
		
		// First get the numflag before it changes
		$this->db_login->select('*');
		$this->db_login->where('key', $editFlag['key']);
		$this->db_login->where('account_id', $editFlag['acct_id']);
		$q = $this->db_login->get($table);
		$q_row = $q->row();
		
		$old_value = $q_row->key.",&nbsp;".$q_row->index.",&nbsp;".$q_row->value;
		$new_value = $editFlag['key'].",&nbsp;".$editFlag['index'].",&nbsp;".$editFlag['value'];
		
		// Log the change
		$this->db_login->set('acct_id', $editFlag['acct_id']);
		$this->db_login->set('user', $editFlag['user']);
		$this->db_login->set('datetime', $timeNow);
		$attr = "edit_".$type."_flag";
		$this->db_login->set('chg_attr', $attr);
		$this->db_login->set('old_value', $old_value);
		$this->db_login->set('new_value', $new_value);
		$this->db_login->insert('hat_accteditlog');
		
		// Then change.
		$this->db_login->set('index', $editFlag['index']);
		$this->db_login->set('value', $editFlag['value']);
		$this->db_login->where('account_id', $editFlag['acct_id']);
		$this->db_login->where('key', $editFlag['key']);
		$this->db_login->update($table);
	}
	
	function get_reg_details($aid) {
		$this->db_login->select('*');
		$q = $this->db_login->get_where('hat_herc_login', array('account_id' => $aid));
		if ($q->num_rows() > 0) {
			return $q->row();
		}
		else {
			$row = new stdClass();
			$row->createdate = "n/a";
			$row->register_ip = "n/a";
			$row->auth_ip = "n/a";
			return $row;
		}
	}
}