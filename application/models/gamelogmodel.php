<?php
Class Gamelogmodel extends CI_Model {

	function get_atcmd_log() {
		$this->db_ragnarok->select('*');
		$this->db_ragnarok->order_by('atcommand_date', 'desc');
		$q = $this->db_ragnarok->get('atcommandlog');
		return $q->result_array();
	}
	
	function get_atcmd_search($atcmdSearch) {
		$this->db_ragnarok->select('*');
		$this->db_ragnarok->order_by('atcommand_date', 'desc');
		if (empty($atcmdSearch['char_name']) == false) {
			$this->db_ragnarok->like('char_name', $atcmdSearch['char_name']);
		}
		if (empty($atcmdSearch['atcmd']) == false) {
			$this->db_ragnarok->like('command', $atcmdSearch['atcmd']);
		}
		if (empty($atcmdSearch['map']) == false) {
			$this->db_ragnarok->like('map', $atcmdSearch['map']);
		}
		if (empty($atcmdSearch['date_start']) == false) {
			$this->db_ragnarok->where('atcommand_date >=', $atcmdSearch['date_start']);
		}
		if (empty($atcmdSearch['date_end']) == false) {
			$this->db_ragnarok->where('atcommand_date <=', $atcmdSearch['date_end']);
		}
		$q = $this->db_ragnarok->get('atcommandlog');
		return $q->result_array();
	}
}