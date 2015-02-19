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
	
	function get_acct_changes($aid) {
		$this->db_ragnarok->select('hat_accteditlog.*,hat_users.username,hat_users.id');
		$this->db_ragnarok->from('hat_accteditlog')->order_by('hat_accteditlog.datetime','desc');
		$this->db_ragnarok->where('hat_accteditlog.acct_id', $aid);
		$this->db_ragnarok->join('hat_users','hat_accteditlog.user = hat_users.id');
		$query = $this->db_ragnarok->get();
		return $query->result_array();
	}
	
	function add_note($newNote) {
		$newNote['datetime'] = date("Y-m-d H:i:s");
		$this->db_ragnarok->insert('hat_acctnotes', $newNote);
	}
	
	function get_num_key_list($aid) {
		$this->db_ragnarok->select('*');
		$query = $this->db_ragnarok->get_where('acc_reg_num_db', array('account_id' => $aid));
		return $query->result_array();
	}
	
	function edit_acct_details($chgAcct) {
		$timeNow = date("Y-m-d H:i:s");
		
		// First, we need to find out what changed...so that we can insert logs
		$this->db_ragnarok->select('account_id,email,sex,group_id,character_slots,birthdate');
		$chgRecq = $this->db_ragnarok->get_where('login', array('account_id' => $chgAcct['account_id']));
		$chgRec = $chgRecq->row();
		if ($chgRec->email != $chgAcct['email'] || $chgRec->sex != $chgAcct['sex'] || $chgRec->group_id != $chgAcct['group_id'] || $chgRec->character_slots != $chgAcct['character_slots'] || $chgRec->birthdate != $chgAcct['birthdate']) {
			$this->db_ragnarok->set('datetime', $timeNow);
			$this->db_ragnarok->set('user', $chgAcct['user']);
			$this->db_ragnarok->set('acct_id', $chgAcct['account_id']);
			if ($chgRec->email != $chgAcct['email']) {
				$this->db_ragnarok->set('chg_attr', 'email');
				$this->db_ragnarok->set('old_value', $chgRec->email);
				$this->db_ragnarok->set('new_value', $chgAcct['email']);
				$this->db_ragnarok->insert('hat_accteditlog');
			}
			if ($chgRec->sex != $chgAcct['sex']) {
				$this->db_ragnarok->set('chg_attr', 'sex');
				$this->db_ragnarok->set('old_value', $chgRec->sex);
				$this->db_ragnarok->set('new_value', $chgAcct['sex']);
				$this->db_ragnarok->insert('hat_accteditlog');
			}
			if ($chgRec->group_id != $chgAcct['group_id']) {
				$this->db_ragnarok->set('chg_attr', 'group_id');
				$this->db_ragnarok->set('old_value', $chgRec->group_id);
				$this->db_ragnarok->set('new_value', $chgAcct['group_id']);
				$this->db_ragnarok->insert('hat_accteditlog');
			}
			if ($chgRec->character_slots != $chgAcct['character_slots']) {
				$this->db_ragnarok->set('chg_attr', 'character_slots');
				$this->db_ragnarok->set('old_value', $chgRec->character_slots);
				$this->db_ragnarok->set('new_value', $chgAcct['character_slots']);
				$this->db_ragnarok->insert('hat_accteditlog');
			}
			if ($chgRec->birthdate != $chgAcct['birthdate']) {
				$this->db_ragnarok->set('chg_attr', 'birthdate');
				$this->db_ragnarok->set('old_value', $chgRec->birthdate);
				$this->db_ragnarok->set('new_value', $chgAcct['birthdate']);
				$this->db_ragnarok->insert('hat_accteditlog');
			}
			
			// Then, change data in the login table
			$this->db_ragnarok->where('account_id', $chgAcct['account_id']);
			$this->db_ragnarok->set('email', $chgAcct['email']);
			$this->db_ragnarok->set('sex', $chgAcct['sex']);
			$this->db_ragnarok->set('group_id', $chgAcct['group_id']);
			$this->db_ragnarok->set('character_slots', $chgAcct['character_slots']);
			$this->db_ragnarok->set('birthdate', $chgAcct['birthdate']);
			$this->db_ragnarok->update('login');
			return true;
		}
		else {
			// The admin didn't change anything!
			return false;
		}
	}
	
	function apply_acct_ban($newBan) {
		// First, get the current time that the ban is being applied
		$timeNow = date("Y-m-d H:i:s");
		$newBanTime = strtotime($newBan['unban_date']);
		
		// Next, add the ban to the hat table
		$this->db_ragnarok->set('blockdate', $timeNow);
		$this->db_ragnarok->set('expiredate', $newBan['unban_date']);
		$this->db_ragnarok->set('block_type', $newBan['type']);
		$this->db_ragnarok->set('acct_id', $newBan['account_id']);
		$this->db_ragnarok->set('block_user', $newBan['userid']);
		$this->db_ragnarok->set('block_comment', $newBan['comments']);
		$this->db_ragnarok->set('reason', $newBan['reason']);
		$this->db_ragnarok->insert('hat_blockinfo');
		
		// We need to figure out if the account already has a permanent ban or 
		// a ban for a longer period of time than the one we're applying.
		$this->db_ragnarok->select('state, unban_time');
		$this->db_ragnarok->where('account_id', $newBan['account_id']);
		$query = $this->db_ragnarok->get('login');
		$q_checkban = $query->row();
		if ($q_checkban->state != 5 && $q_checkban->unban_time < $newBanTime) { // Account is not already permanently banned nor has a ban lasting longer than the ban we're applying
		
			// Then, set the login table accordingly.
			if ($newBan['type'] == "perm") {
				$this->db_ragnarok->set('state', 5);
				$this->db_ragnarok->set('unban_time', 0);
			}
			elseif ($newBan['type'] == "temp") {
				$this->db_ragnarok->set('unban_time', $newBanTime);
			}
			$this->db_ragnarok->where('account_id', $newBan['account_id']); 
			$this->db_ragnarok->update('login');
		} // If the account is already permanently banned or has a ban longer than the ban we're currently setting, do nothing.
	}
	
	function apply_acct_unban($remBan) {
		// First, get the current time that the unban is being applied
		$timeNow = date("Y-m-d H:i:s");
		
		// Add the unban data to the hat table.
		$this->db_ragnarok->where('blockid', $remBan['blockid']);
		$this->db_ragnarok->set('unblock_user', $remBan['unblock_user']);
		$this->db_ragnarok->set('unblock_comment', $remBan['unblock_comment']);
		$this->db_ragnarok->set('unblock_date', $timeNow);
		$this->db_ragnarok->update('hat_blockinfo');
		
		// Then, figure out if the block we're removing is the only active block on that account.
		$this->db_ragnarok->select('blockid');
		$get_where = "acct_id = '{$remBan['acct_id']}' AND expiredate > '{$timeNow}' AND unblock_date IS NULL";
		$this->db_ragnarok->where($get_where);
		$query = $this->db_ragnarok->get('hat_blockinfo');
		$row_q1_cnt = $query->num_rows();
		if ($row_q1_cnt < 1) { // The ban we're removing is the only active block on that account
			// Therefore, we can reset account status.
			$this->db_ragnarok->set('state', 0);
			$this->db_ragnarok->set('unban_time', 0);
			$this->db_ragnarok->update('login');
		} // The account still has a past or future ban that is expiring at a later time, do nothing to the account here.
		elseif ($row_q1_cnt >= 1) { // The ban we're removing is not the only one. We need to check if there is a ban still existing that we need to change the unban_time to instead...
			$this->db_ragnarok->select_max('expiredate');
			$where_unblockdate = "acct_id = '{$remBan['acct_id']}' AND unblock_date IS NULL";
			$this->db_ragnarok->where($where_unblockdate);
			$query2 = $this->db_ragnarok->get('hat_blockinfo');
			$q2_maxban = $query2->row();
			
			$this->db_ragnarok->where('account_id', $remBan['acct_id']);
			$this->db_ragnarok->set('unban_time', strtotime($q2_maxban->expiredate));
			$this->db_ragnarok->update('login');
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
		$this->db_ragnarok->where('account_id', $aid);
		$this->db_ragnarok->set('user_pass', $newPassMD5);
		$this->db_ragnarok->update('login');
		
		// Grab the email address and account name from the database to send an email
		$this->db_ragnarok->select('userid,email');
		$query = $this->db_ragnarok->get_where('login', array('account_id' => $aid));
		$getAcctInfo = $query->row();
		
		// Then update the log to reflect the password being reset.
		$this->db_ragnarok->set('datetime', $timeNow);
		$this->db_ragnarok->set('user', $userid);
		$this->db_ragnarok->set('acct_id', $aid);
		$this->db_ragnarok->set('chg_attr', 'password');
		$this->db_ragnarok->set('old_value', 0);
		$this->db_ragnarok->set('new_value', 0);
		$this->db_ragnarok->insert('hat_accteditlog');
		
		// Finally, put everything in a nice array to return.
		$acctInfo = array(
			'pass'	=> $newPass,
			'userid'	=> $getAcctInfo->userid,
			'email'	=> $getAcctInfo->email
		);
		return $acctInfo;
	}
	
	function search_accts($searchTerms) {
		// First, figure out what we're searching for
		if (empty($searchTerms['acct_id']) == false) {
			$this->db_ragnarok->or_like('account_id', $searchTerms['acct_id']);
		}
		if (empty($searchTerms['acct_name']) == false) {
			$this->db_ragnarok->or_like('userid', $searchTerms['acct_name']);
		}
		if (empty($searchTerms['email']) == false) {
			$this->db_ragnarok->or_like('email', $searchTerms['email']);
		}
		if (empty($searchTerms['gender']) == false) {
			$this->db_ragnarok->or_like('sex', $searchTerms['gender']);
		}
		if ($searchTerms['isGM'] == 1) {
			$this->db_ragnarok->or_where('group_id >', 0);
		}
		if ($searchTerms['isBanned'] == 1) {
			$this->db_ragnarok->or_where('unban_time >', 0);
			$this->db_ragnarok->or_where('state', 5);
		}
		$q = $this->db_ragnarok->get('login');
		return $q->result_array();
	}
}