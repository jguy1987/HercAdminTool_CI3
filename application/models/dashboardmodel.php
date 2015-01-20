<?php
Class Dashboardmodel extends CI_Model {
	function get_acct_reg_by_date() {
		$dates = array();
		for ($i=0; $i < 7; $i++) {
			$dates[] = date("Y-m-d", strtotime('-'. $i .' days'));
		}
		$data = array();
		foreach ($dates as $k) {
			$this->db_ragnarok->select('userid');
			$this->db_ragnarok->where('createdate',$k);
			$q = $this->db_ragnarok->get('login');
			$data += array(
				$k => $q->num_rows(),
			);
		};
		return $data;
	}
}