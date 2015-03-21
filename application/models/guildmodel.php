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
}