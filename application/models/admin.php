<?php
Class Adminmodel extends CI_Model {
	function list_admins() {
		$query = $this->db->get('users');
		return $query->result();
	}
	function get_group_name($groupid) {
		$this->db->select('id, name');
		$query = $this->db->get_where('groups', array('id' => $groupid));
		return $query->result();
	}
}