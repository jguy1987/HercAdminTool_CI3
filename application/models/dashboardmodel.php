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
		// Get total amount of accounts
		$this->db_ragnarok->select('account_id');
		$this->db_ragnarok->from('login');
		$this->db_ragnarok->where('sex !=', 'S');
		$q = $this->db_ragnarok->get();
		// Get total amount of characters
		$q2 = $this->db_ragnarok->count_all('char');
		//Get total amount of guilds
		$q3 = $this->db_ragnarok->count_all('guild');
		// Get total amount of characters in a guild
		$this->db_ragnarok->select('char_id');
		$this->db_ragnarok->from('char');
		$this->db_ragnarok->where('guild_id IS NOT NULL');
		$q4 = $this->db_ragnarok->get();		
		// Get total amount of zeny on all characters
		$this->db_ragnarok->select_sum('zeny');
		$q5 = $this->db_ragnarok->get('char');
		$zeny = $q5->row();
		// Get server uptime
		$this->db_ragnarok->select('starttime');
		$this->db_ragnarok->order_by('id','desc');
		$this->db_ragnarok->limit(1);
		$this->db_ragnarok->from('hat_sstatus');
		$q6 = $this->db_ragnarok->get();
		$laststartdate = $q6->row();
		$serverstart = new DateTime($laststartdate->starttime);
		$now = date('Y-m-d H:i:s');
		$sinceStart = $serverstart->diff(new DateTime($now));
		$sinceStartf = $sinceStart->d."d&nbsp;".$sinceStart->h."h&nbsp;".$sinceStart->i."m&nbsp;".$sinceStart->s."s&nbsp;";
		// Get users online
		$q7 = $this->db_ragnarok->get_where('char', array('online' => 1));

		$data = array(
			'Server Uptime'				=> $sinceStartf,
			'<a href="/character/whosonline">Players Online</a>'				=> number_format($q7->num_rows()),
			'Accounts Registered'		=> number_format($q->num_rows()),
			'Characters Created'			=> number_format($q2),
			'Guilds Established'			=> number_format($q3),
			'Characters in guilds'		=> number_format($q4->num_rows()),
			'Zeny in Circulation'		=> number_format($zeny->zeny),
		);
		return $data;
	}
	
	function get_active_admins() {
		$this->db_ragnarok->select('username, active, lastmodule');
		$query = $this->db_ragnarok->get_where('hat_users', array('active' => 1));
		return $query->result_array();
	}
}