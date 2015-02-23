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
		$this->db_ragnarok->select('char.*,guild.guild_id,guild.name AS guild_name,party.party_id,party.name AS party_name');
		$this->db_ragnarok->from('char');
		$this->db_ragnarok->where('char.char_id', $cid);
		$this->db_ragnarok->join('guild', 'char.guild_id = guild.guild_id', 'left');
		$this->db_ragnarok->join('party', 'char.party_id = party.party_id', 'left');
		$query = $this->db_ragnarok->get();
		return $query->row();
	}
	
	function get_char_items($cid) {
		$this->db_ragnarok->select('inventory.*,item_db.id,item_db.name_japanese,item_db.type');
		$this->db_ragnarok->from('inventory')->order_by('inventory.equip', 'asc')->order_by('item_db.id', 'asc');
		$this->db_ragnarok->where('inventory.char_id', $cid);
		$this->db_ragnarok->join('item_db', 'inventory.nameid = item_db.id', 'left');
		$q = $this->db_ragnarok->get();
		return $q->result_array();
	}
	
	function get_cart_items($cid) {
		$this->db_ragnarok->select('cart_inventory.*,item_db.id,item_db.name_japanese,item_db.type');
		$this->db_ragnarok->from('cart_inventory')->order_by('item_db.id', 'asc');
		$this->db_ragnarok->where('cart_inventory.char_id', $cid);
		$this->db_ragnarok->join('item_db', 'cart_inventory.nameid = item_db.id', 'left');
		$q = $this->db_ragnarok->get();
		return $q->result_array();
	}
	
	function get_charlog($cid) {
		$this->db_ragnarok->order_by('time','desc');
		$q = $this->db_ragnarok->get_where('charlog', array('char_id' => $cid));
		return $q->result_array();
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
}