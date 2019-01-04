<?php
Class Charmodel extends CI_Model {
	
	function list_online() {
		$this->db_charmap->select('char.char_id,char.account_id,char.char_num,char.name,char.class,char.base_level,char.job_level,char.zeny,char.last_map,char.last_x,char.last_y,char.job_level,char.guild_id AS char_guid,char.online,guild.guild_id,guild.name AS guild_name');
		$this->db_charmap->from('char')->order_by('char.char_id','asc');
		$this->db_charmap->where('char.online', '1');
		$this->db_charmap->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$query = $this->db_charmap->get();
		return $query->result_array();
	}
	
	function get_online_count() {
		$this->db_charmap->select('char_id');
		$q = $this->db_charmap->get_where('char', array('online' => 1));
		return $q->num_rows();
	}
	
	function get_char_list() {
		$this->db_charmap->select('char.*,guild.guild_id,guild.name AS guild_name,party.party_id,party.name AS party_name');
		$this->db_charmap->from('char');
		$this->db_charmap->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$this->db_charmap->join('party', 'char.party_id = party.party_id', 'left');
		$q = $this->db_charmap->get();
		return $q->result_array();
	}
	
	function get_char_info($cid) {
		$this->db_charmap->select('char.*,guild.guild_id,guild.name AS guild_name,party.party_id,party.name AS party_name,charlog1.time AS create_time,charlog2.time AS lastlogin_time');
		$this->db_charmap->from('char');
		$this->db_charmap->where('char.char_id', $cid);
		$this->db_charmap->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$this->db_charmap->join('party', 'char.party_id = party.party_id', 'left');
		$this->db_charmap->join('charlog AS charlog1', "char.char_id = charlog1.char_id AND charlog1.char_msg = 'make new char'", 'left');
		$this->db_charmap->join('charlog AS charlog2', "char.char_id = charlog2.char_id AND charlog2.time = (SELECT MAX(charlog.time) FROM charlog WHERE char_msg = 'char select' AND char_id = '".$cid."')", 'left');
		$query = $this->db_charmap->get();
		return $query->row();
	}
	
	function get_char_items($cid) {
		$this->db_charmap->select('inventory.*,item_db.id AS item_id,item_db.name_japanese,item_db.type');
		$this->db_charmap->from('inventory')->order_by('inventory.equip', 'asc')->order_by('item_db.id', 'asc');
		$this->db_charmap->where('inventory.char_id', $cid);
		$this->db_charmap->join('item_db', 'inventory.nameid = item_db.id', 'left');
		$q = $this->db_charmap->get();
		if ($q !== FALSE && $q->num_rows() > 0) {
			return $q->result_array();
		}
		else {
			return 0;
		}
	}
	
	function get_cart_items($cid) {
		$this->db_charmap->select('cart_inventory.*,item_db.id AS item_id,item_db.name_japanese,item_db.type');
		$this->db_charmap->from('cart_inventory')->order_by('item_db.id', 'asc');
		$this->db_charmap->where('cart_inventory.char_id', $cid);
		$this->db_charmap->join('item_db', 'cart_inventory.nameid = item_db.id', 'left');
		$q = $this->db_charmap->get();
		if ($q !== FALSE && $q->num_rows() > 0) {
			return $q->result_array();
		}
		else {
			return 0;
		}
	}
	
	function get_friend_list($cid) {
		$this->db_charmap->select('friends.*, char.char_id, char.name');
		$this->db_charmap->from('friends');
		$this->db_charmap->where('friends.char_id', $cid);
		$this->db_charmap->join('char', 'friends.friend_id = char.char_id', 'left');
		$q = $this->db_charmap->get();
		return $q->result_array();
	}
	
	function get_charlog($cid) {
		$q = $this->db_charmap->get_where('charlog', array('char_id' => $cid));
		return $q->result_array();
	}
	
	function get_char_hist($cid) {
		$this->db_charmap->select('*');
		$this->db_charmap->from('hat_chareditlog');
		$this->db_charmap->where('char_id', $cid);
		$query = $this->db_charmap->get();
		return $query->result_array();
	}
	
	function search_chars($charSearch) {
		$this->db_charmap->select('char.*,guild.guild_id,guild.name AS guild_name,party.party_id,party.name AS party_name');
		$this->db_charmap->from('char');
		if (empty($charSearch['char_id']) == false) {
			$this->db_charmap->like('char.char_id', $charSearch['char_id']);
		}
		if (empty($charSearch['char_name']) == false) {
			$this->db_charmap->like('char.name', $charSearch['char_name']);
		}
		if (empty($charSearch['gender']) == false) {
			$this->db_charmap->where('char.sex', $charSearch['gender']);
		}
		if (empty($charSearch['class']) == false) {
			$this->db_charmap->where('char.class', $charSearch['class']);
		}
		if (empty($charSearch['bLevelgt']) == false) {
			$this->db_charmap->where('char.base_level >=', $charSearch['bLevelgt']);
		}
		if (empty($charSearch['bLevellt']) == false) {
			$this->db_charmap->where('char.base_level <=', $charSearch['bLevellt']);
		}
		if (empty($charSearch['jLevelgt']) == false) {
			$this->db_charmap->where('char.job_level >=', $charSearch['jLevelgt']);
		}
		if (empty($charSearch['jLevellt']) == false) {
			$this->db_charmap->like('char.job_level <=', $charSearch['jLevellt']);
		}
		$this->db_charmap->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$this->db_charmap->join('party', 'char.party_id = party.party_id', 'left');
		$q = $this->db_charmap->get();
		return $q->result_array();
	}
	
	function edit_char_details($chgChar) {
		$timeNow = date("Y-m-d H:i:s");
		
		$this->db_charmap->select('*');
		$q = $this->db_charmap->get_where('char', array('char_id' => $chgChar['charid']));
		$chgRec = $q->row();
		
		$this->db_login->set('datetime', $timeNow);
		$this->db_login->set('user', $chgChar['user']);
		$this->db_login->set('char_id', $chgChar['charid']);

		foreach ($chgChar as $k=>$v) {
			if ($k == "user" || $k == "charid") {
			}
			else {
				if ($chgRec->$k != $v) {
					$this->db_login->set('chg_attr', $k);
					$this->db_login->set('old_value', $chgRec->$k);
					$this->db_login->set('new_value', $v);
					$this->db_login->insert('hat_chareditlog');
				}
			}
		}
		$this->db->flush_cache();
		$this->db_charmap->where('char_id', $chgChar['charid']);
		unset($chgChar['user'], $chgChar['charid']);
		$this->db_charmap->set($chgChar);
		$this->db_charmap->update('char');
	}
	
	function reset_char_pos($cid, $user) {
		$timeNow = date("Y-m-d H:i:s");
		
		$this->db_charmap->select('last_map, last_x, last_y');
		$q = $this->db_charmap->get_where('char', array('char_id' => $cid));
		$query = $q->row();
		$lastPos = $query->last_map."&nbsp;".$query->last_x.",&nbsp;".$query->last_y;
		
		// Log the change...
		$this->db_login->set('user', $user);
		$this->db_login->set('datetime', $timeNow);
		$this->db_login->set('char_id', $cid);
		$this->db_login->set('chg_attr', "last_pos");
		$this->db_login->set('old_value', $lastPos);
		$this->db_login->insert('hat_chareditlog');
		
		// Get what map we need to reset position to
		$servers = $this->config->item('ragnarok_servers');
		$mapname = $servers[$this->session->userdata('server_select')]['reset_map'];
		$mapx = $servers[$this->session->userdata('server_select')]['reset_x'];
		$mapy = $servers[$this->session->userdata('server_select')]['reset_y'];
		// Then change the database...
		
		$this->db_charmap->set('last_map', $mapname);
		$this->db_charmap->set('last_x', $mapx);
		$this->db_charmap->set('last_y', $mapy);
		$this->db_charmap->where('char_id', $cid);
		$this->db_charmap->update('char');
	}
}