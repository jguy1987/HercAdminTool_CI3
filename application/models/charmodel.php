<?php
Class Charmodel extends CI_Model {
	
	function list_online() {
		$this->db_ragnarok->select('char.char_id,char.account_id,char.char_num,char.name,char.class,char.base_level,char.job_level,char.zeny,char.last_map,char.last_x,char.last_y,char.job_level,char.guild_id AS char_guid,char.online,guild.guild_id,guild.name AS guild_name');
		$this->db_ragnarok->from('char')->order_by('char.char_id','asc');
		$this->db_ragnarok->where('char.online', '1');
		$this->db_ragnarok->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$query = $this->db_ragnarok->get();
		return $query->result_array();
	}
	
	function get_char_list() {
		$this->db_ragnarok->select('char.*,guild.guild_id,guild.name AS guild_name,party.party_id,party.name AS party_name');
		$this->db_ragnarok->from('char');
		$this->db_ragnarok->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$this->db_ragnarok->join('party', 'char.party_id = party.party_id', 'left');
		$q = $this->db_ragnarok->get();
		return $q->result_array();
	}
	
	function get_char_info($cid) {
		$this->db_ragnarok->select('char.*,guild.guild_id,guild.name AS guild_name,party.party_id,party.name AS party_name,charlog1.time AS create_time,charlog2.time AS lastlogin_time');
		$this->db_ragnarok->from('char');
		$this->db_ragnarok->where('char.char_id', $cid);
		$this->db_ragnarok->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$this->db_ragnarok->join('party', 'char.party_id = party.party_id', 'left');
		$this->db_ragnarok->join('charlog AS charlog1', 'char.char_id = charlog1.char_id AND charlog1.char_msg = "make new char"', 'left');
		$this->db_ragnarok->join('charlog AS charlog2', "char.char_id = charlog2.char_id AND charlog2.time = (SELECT MAX(charlog.time) FROM charlog WHERE char_msg = 'char select' AND char_id = '".$cid."')", 'left');
		$query = $this->db_ragnarok->get();
		return $query->row();
	}
	
	function get_char_items($cid) {
		$this->db_ragnarok->select('inventory.*,item_db.id AS item_id,item_db.name_japanese,item_db.type');
		$this->db_ragnarok->from('inventory')->order_by('inventory.equip', 'asc')->order_by('item_db.id', 'asc');
		$this->db_ragnarok->where('inventory.char_id', $cid);
		$this->db_ragnarok->join('item_db', 'inventory.nameid = item_db.id', 'left');
		$q = $this->db_ragnarok->get();
		return $q->result_array();
	}
	
	function get_cart_items($cid) {
		$this->db_ragnarok->select('cart_inventory.*,item_db.id AS item_id,item_db.name_japanese,item_db.type');
		$this->db_ragnarok->from('cart_inventory')->order_by('item_db.id', 'asc');
		$this->db_ragnarok->where('cart_inventory.char_id', $cid);
		$this->db_ragnarok->join('item_db', 'cart_inventory.nameid = item_db.id', 'left');
		$q = $this->db_ragnarok->get();
		return $q->result_array();
	}
	
	function get_friend_list($cid) {
		$this->db_ragnarok->select('friends.*, char.char_id, char.name');
		$this->db_ragnarok->from('friends')->order_by('friends.friend_id', 'asc');
		$this->db_ragnarok->where('friends.char_id', $cid);
		$this->db_ragnarok->join('char', 'friends.friend_id = char.char_id', 'left');
		$q = $this->db_ragnarok->get();
		return $q->result_array();
	}
	
	function get_charlog($cid) {
		$this->db_ragnarok->order_by('time','desc');
		$q = $this->db_ragnarok->get_where('charlog', array('char_id' => $cid));
		return $q->result_array();
	}
	
	function get_char_hist($cid) {
		$this->db_ragnarok->select('hat_chareditlog.*,hat_users.username,hat_users.id');
		$this->db_ragnarok->from('hat_chareditlog')->order_by('hat_chareditlog.datetime','desc');
		$this->db_ragnarok->where('hat_chareditlog.char_id', $cid);
		$this->db_ragnarok->join('hat_users','hat_chareditlog.user = hat_users.id');
		$query = $this->db_ragnarok->get();
		return $query->result_array();
	}
	
	function search_chars($charSearch) {
		$this->db_ragnarok->select('char.*,guild.guild_id,guild.name AS guild_name,party.party_id,party.name AS party_name');
		$this->db_ragnarok->from('char');
		if (empty($charSearch['char_id']) == false) {
			$this->db_ragnarok->like('char.char_id', $charSearch['char_id']);
		}
		if (empty($charSearch['char_name']) == false) {
			$this->db_ragnarok->like('char.name', $charSearch['char_name']);
		}
		if (empty($charSearch['gender']) == false) {
			$this->db_ragnarok->where('char.sex', $charSearch['gender']);
		}
		if (empty($charSearch['class']) == false) {
			$this->db_ragnarok->where('char.class', $charSearch['class']);
		}
		if (empty($charSearch['bLevelgt']) == false) {
			$this->db_ragnarok->where('char.base_level >=', $charSearch['bLevelgt']);
		}
		if (empty($charSearch['bLevellt']) == false) {
			$this->db_ragnarok->where('char.base_level <=', $charSearch['bLevellt']);
		}
		if (empty($charSearch['jLevelgt']) == false) {
			$this->db_ragnarok->where('char.job_level >=', $charSearch['jLevelgt']);
		}
		if (empty($charSearch['jLevellt']) == false) {
			$this->db_ragnarok->like('char.job_level <=', $charSearch['jLevellt']);
		}
		$this->db_ragnarok->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$this->db_ragnarok->join('party', 'char.party_id = party.party_id', 'left');
		$q = $this->db_ragnarok->get();
		return $q->result_array();
	}
	
	function edit_char_details($chgChar) {
		$timeNow = date("Y-m-d H:i:s");
		
		$this->db_ragnarok->select('*');
		$q = $this->db_ragnarok->get_where('char', array('char_id' => $chgChar['charid']));
		$chgRec = $q->row();
		
		$this->db_ragnarok->set('datetime', $timeNow);
		$this->db_ragnarok->set('user', $chgChar['user']);
		$this->db_ragnarok->set('char_id', $chgChar['charid']);

		foreach ($chgChar as $k=>$v) {
			if ($k == "user" || $k == "charid") {
			}
			else {
				if ($chgRec->$k != $v) {
					$this->db_ragnarok->set('chg_attr', $k);
					$this->db_ragnarok->set('old_value', $chgRec->$k);
					$this->db_ragnarok->set('new_value', $v);
					$this->db_ragnarok->insert('hat_chareditlog');
				}
			}
		}
		$this->db->flush_cache();
		$this->db_ragnarok->where('char_id', $chgChar['charid']);
		unset($chgChar['user'], $chgChar['charid']);
		$this->db_ragnarok->set($chgChar);
		$this->db_ragnarok->update('char');
	}
	
	function reset_char_pos($cid, $user) {
		$timeNow = date("Y-m-d H:i:s");
		
		$this->db_ragnarok->select('last_map, last_x, last_y');
		$q = $this->db_ragnarok->get_where('char', array('char_id' => $cid));
		$query = $q->row();
		$lastPos = $query->last_map."&nbsp;".$query->last_x.",&nbsp;".$query->last_y;
		
		// Log the change...
		$this->db_ragnarok->set('user', $user);
		$this->db_ragnarok->set('datetime', $timeNow);
		$this->db_ragnarok->set('char_id', $cid);
		$this->db_ragnarok->set('chg_attr', "last_pos");
		$this->db_ragnarok->set('old_value', $lastPos);
		$this->db_ragnarok->insert('hat_chareditlog');
		
		// Then change the database...
		$this->db_ragnarok->set('last_map', $this->config->item('reset_map'));
		$this->db_ragnarok->set('last_x', $this->config->item('reset_x'));
		$this->db_ragnarok->set('last_y', $this->config->item('reset_y'));
		$this->db_ragnarok->where('char_id', $cid);
		$this->db_ragnarok->update('char');
	}
	
	function edit_char_item($itemEdit, $itemLoc) {
		$this->db_ragnarok->where('id', $itemEdit['id']);
		unset($itemEdit['id']);
		$this->db_ragnarok->set($itemEdit);
		if ($itemLoc == "inventory") {
			$this->db_ragnarok->update('inventory');
		}
		elseif ($itemLoc == "cart") {
			$this->db_ragnarok->update('cart_inventory');
		}
	}
	
	function check_if_card($cardid) {
		$this->db_ragnarok->select('*');
		$this->db_ragnarok->where('id', $cardid);
		$this->db_ragnarok->where('type', 6);
		$q = $this->db_ragnarok->get('item_db');
		$q_count = $q->num_rows();
		/*
		$this->db_ragnarok->select('*');
		$this->db_ragnarok->where('id', $cardid);
		$this->db_ragnarok->where('type', 6);
		$q2 = $this->db_ragnarok->get('item_db2');
		$q2_count = $q2->num_rows(); */
		$q2_count = 0;
		
		if ($q_count == 0 && $q2_count == 0) {
			return false;
		}
		else {
			return true;
		}
	}
	
}