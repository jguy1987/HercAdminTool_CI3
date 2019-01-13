<?php
Class Dashboardmodel extends CI_Model {
	function get_acct_reg_by_date() {
		$dates = array();
		for ($i=0; $i < 14; $i++) {
			$dates[] = date("Y-m-d", strtotime('-'. $i .' days'));
		}
		$datesRev = array_reverse($dates);
		$data = array();
		foreach ($datesRev as $k) {
			$this->db_login->select('account_id');
			$this->db_login->where('createdate',$k);
			$q = $this->db_login->get('hat_herc_login');
			$data += array(
				$k => $q->num_rows(),
			);
		};
		return $data;
	}
	
	function get_active_admins() {
		// Get the time we need to select.
		$timeNow = date("Y-m-d H:i:s");
		$time = strtotime($timeNow);
		$time = $time - ($this->config->item('inactive_time') * 60);
		$timeSelect = date("Y-m-d H:i:s", $time);

		$this->db_hat->select('username, lastactive, lastmodule');
		$this->db_hat->from('hat_users');
		$this->db_hat->where('lastactive >=', $timeSelect);
		$this->db_hat->where('lastmodule !=', "user/logout");
		$query = $this->db_hat->get();
		return $query->result_array();
	}
}