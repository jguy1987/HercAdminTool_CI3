<?php
Class Guildmodel extends CI_Model {

	function list_guilds() {
		$this->db_charmap->select('guild.*, COUNT(*) AS member_cnt');
		$this->db_charmap->from('guild')->order_by('guild.guild_id', 'asc');
		$this->db_charmap->join('char', 'guild.guild_id = char.guild_id', 'left');
		$this->db_charmap->group_by('guild.guild_id');
		$q = $this->db_charmap->get();
		return $q->result_array();
	}
	
	function list_search($guildSearch) {
		$this->db_charmap->select('guild.*, COUNT(*) AS member_cnt');
		$this->db_charmap->from('guild')->order_by('guild.guild_id', 'asc');
		if (empty($guildSearch['guild_id']) == false) {
			$this->db_charmap->like('guild.guild_id', $guildSearch['guild_id']);
		}
		if (empty($guildSearch['guild_name']) == false) {
			$this->db_charmap->like('guild.name', $guildSearch['guild_name']);
		}		
		if (empty($guildSearch['leader_name']) == false) {
			$this->db_charmap->like('guild.master', $guildSearch['leader_name']);
		}		
		if (empty($guildSearch['gtLevel']) == false) {
			$this->db_charmap->where('guild.guild_lv >=', $guildSearch['gtLevel']);
		}		
		if (empty($guildSearch['guild_id']) == false) {
			$this->db_charmap->where('guild.guild_lv <=', $guildSearch['ltLevel']);
		}
		$this->db_charmap->join('char', 'guild.guild_id = char.guild_id', 'left');
		$this->db_charmap->group_by('guild.guild_id');
		$q = $this->db_charmap->get();
		return $q->result_array();
	}
	
	function get_details($gid) {
		$this->db_charmap->select('guild.*, COUNT(*) AS member_cnt');
		$this->db_charmap->from('guild')->order_by('guild.guild_id', 'asc');
		$this->db_charmap->where('guild.guild_id', $gid);
		$this->db_charmap->join('char', 'guild.guild_id = char.guild_id', 'left');
		$this->db_charmap->group_by('guild.guild_id');
		$q = $this->db_charmap->get();
		return $q->row();
	}
	
	function get_guild_members($gid) {
		$this->db_charmap->select('*');
		$this->db_charmap->where('guild_id', $gid);
		$this->db_charmap->order_by('position','asc');
		$this->db_charmap->order_by('name','asc');
		$q = $this->db_charmap->get('guild_member');
		return $q->result_array();
	}
	
	function get_guild_position($gid) {
		$this->db_charmap->select('*');
		$this->db_charmap->where('guild_id', $gid);
		$q = $this->db_charmap->get('guild_position');
		return $q->result_array();
	}
	
	function assign_leader($info) {
		// change leader of guild.
		$this->db_charmap->set('master', $info['new_leader_name']);
		$this->db_charmap->set('char_id', $info['new_leader_id']);
		$this->db_charmap->where('guild_id', $info['guild_id']);
		$this->db_charmap->update('guild');
		
		// change rank.
		$this->db_charmap->set('position', 0);
		$this->db_charmap->where('guild_id', $info['guild_id']);
		$this->db_charmap->where('char_id', $info['new_leader_id']);
		$this->db_charmap->update('guild_member');
	}
}