<?php
Class Gamelogmodel extends CI_Model {

	function get_atcmd_log() {
		$this->db_charmaplog->select('*');
		$this->db_charmaplog->order_by('atcommand_date', 'desc');
		$q = $this->db_charmaplog->get('atcommandlog');
		return $q->result_array();
	}
	
	function get_atcmd_search($atcmdSearch) {
		$this->db_charmaplog->select('*');
		$this->db_charmaplog->order_by('atcommand_date', 'desc');
		if (empty($atcmdSearch['char_name']) == false) {
			$this->db_charmaplog->like('char_name', $atcmdSearch['char_name']);
		}
		if (empty($atcmdSearch['atcmd']) == false) {
			$this->db_charmaplog->like('command', $atcmdSearch['atcmd']);
		}
		if (empty($atcmdSearch['map']) == false) {
			$this->db_charmaplog->like('map', $atcmdSearch['map']);
		}
		if (empty($atcmdSearch['date_start']) == false) {
			$this->db_charmaplog->where('atcommand_date >=', $atcmdSearch['date_start']);
		}
		if (empty($atcmdSearch['date_end']) == false) {
			$this->db_charmaplog->where('atcommand_date <=', $atcmdSearch['date_end']);
		}
		$q = $this->db_charmaplog->get('atcommandlog');
		return $q->result_array();
	}
}