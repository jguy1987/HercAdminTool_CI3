<?php
Class Dashboardmodel extends CI_Model {
	function get_acct_reg_by_date() {
		$dates = array();
		for ($i=0; $i < 6; $i++) {
			$dates[] = date("Y-m-d", strtotime('-'. $i .' days'));
		}
		$dates = array_flip($dates);
		return $dates;
	}
}