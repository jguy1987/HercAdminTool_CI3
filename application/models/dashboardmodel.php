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
	
	function get_server_stats() {
		$this->db_ragnarok->select('account_id');
		$this->db_ragnarok->from('login');
		$this->db_ragnarok->where('sex !=', 'S');
		$q = $this->db_ragnarok->get();
		$q2 = $this->db_ragnarok->count_all('char');
		$q3 = $this->db_ragnarok->count_all('guild');
		$this->db_ragnarok->select('char_id');
		$this->db_ragnarok->from('char');
		$this->db_ragnarok->where('guild_id IS NOT NULL');
		$q4 = $this->db_ragnarok->get();		
		$this->db_ragnarok->select_sum('zeny');
		$q5 = $this->db_ragnarok->get('char');
		$zeny = $q5->row();
		$this->db_ragnarok->select('createdate');
		$this->db_ragnarok->order_by('account_id','desc');
		$this->db_ragnarok->limit(1);
		$this->db_ragnarok->from('login');
		$q6 = $this->db_ragnarok->get();
		$lastCreateDate = $q5->row();
		$datediff = 
		$data = array(
			'Accounts Registered'		=> $q->num_rows(),
			'Characters Created'			=> $q2,
			'Guilds Established'			=> $q3,
			'Characters in guilds'		=> $q4->num_rows(),
			'Zeny in Circulation'		=> $zeny->zeny,
		);
		return $data;
	}
}