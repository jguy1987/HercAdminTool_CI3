<?php
Class Dashboardmodel extends CI_Model {
	function get_acct_reg_by_date() {
		$dates = array();
		for ($i=0; $i < 7; $i++) {
			$dates[] = date("Y-m-d", strtotime('-'. $i .' days'));
		}
		$data = array();
		foreach ($dates as $k) {
			$this->db_login->select('userid');
			$this->db_login->where('createdate',$k);
			$q = $this->db_login->get('login');
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

		$this->db_login->select('username, lastactive, lastmodule');
		$this->db_login->from('hat_users');
		$this->db_login->where('lastactive >=', $timeSelect);
		$this->db_login->where('lastmodule !=', "user/logout");
		$query = $this->db_login->get();
		return $query->result_array();
	}
	
	function get_admin_news() {
		$this->db_login->select('hat_adminnews.*,hat_users.username');
		$this->db_login->from('hat_adminnews')->order_by('hat_adminnews.id','desc');
		$this->db_login->where('hat_adminnews.active', 1);
		$this->db_login->join('hat_users', 'hat_adminnews.user = hat_users.id');
		$query = $this->db_login->get();
		return $query->result_array();
	}
}