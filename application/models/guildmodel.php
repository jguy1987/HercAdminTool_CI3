<?php
Class Guildmodel extends CI_Model {

	function list_guilds() {
		$this->db_ragnarok->select('guild.*, COUNT(char.char_id) AS member_cnt');
		$this->db_ragnarok->from('guild')->order_by('guild.guild_id', 'desc');
		$this->db_ragnarok->join('char', 'guild.guild_id = char.guild_id', 'left');
		$q = $this->db_ragnarok->get();
		return $q->result_array();
	}
	
}