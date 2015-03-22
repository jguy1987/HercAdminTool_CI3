<?php
Class Servermodel extends CI_Model {

	function get_herc_stats() {
		// Get total amount of accounts
		$this->db_login->select('account_id');
		$this->db_login->from('login');
		$this->db_login->where('sex !=', 'S');
		$q = $this->db_login->get();
		// Get total amount of characters
		$q2 = $this->db_charmap->count_all('char');
		//Get total amount of guilds
		$q3 = $this->db_charmap->count_all('guild');
		// Get total amount of characters in a guild
		$this->db_charmap->select('char_id');
		$this->db_charmap->from('char');
		$this->db_charmap->where('guild_id IS NOT NULL');
		$q4 = $this->db_charmap->get();		
		// Get total amount of zeny on all characters
		$this->db_charmap->select_sum('zeny');
		$q5 = $this->db_charmap->get('char');
		$zeny = $q5->row();
		// Get server uptime
		$this->db_login->select('lastlogin');
		$this->db_login->from('login');
		$servers = $this->config->item('ragnarok_servers');
		$servername = $servers[$this->session->userdata('server_select')]['map_servername'];
		$this->db_login->where('userid', $servername);
		$q6 = $this->db_login->get();
		$laststartdate = $q6->row();
		$serverstart = new DateTime($laststartdate->lastlogin);
		$now = date('Y-m-d H:i:s');
		$sinceStart = $serverstart->diff(new DateTime($now));
		$sinceStartf = $sinceStart->d."d&nbsp;".$sinceStart->h."h&nbsp;".$sinceStart->i."m&nbsp;".$sinceStart->s."s&nbsp;";
		// Get users online
		$q7 = $this->db_charmap->get_where('char', array('online' => 1));

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
	
	function get_mysql_stats() {
		$stats = mysqli_stat($this->db_login->conn_id);
		$mySQLstats = array();
		foreach (explode("  ", $stats) as $k) {
			$ret = explode(': ', $k);
			$mySQLstats[$ret[0]] = $ret[1];
		}
		return $mySQLstats;
	}
	
	function get_server_stats($json_url) {
		$json = file_get_contents($json_url);
		$serverData = json_decode($json, true);
		
		// Fix some of the formats to be more human readable...
		$RAMused = $serverData['RAM']['total'] - $serverData['RAM']['free'];
		$swapused = $serverData['RAM']['swapTotal'] - $serverData['RAM']['swapFree'];
		$serverData['RAM']['used_pct'] = round($RAMused / $serverData['RAM']['total'] * 100, 2);
		$serverData['RAM']['swapUsed_pct'] = round($swapused / $serverData['RAM']['swapTotal'] * 100, 2);
		$serverData['RAM']['total'] = $this->format_bytes($serverData['RAM']['total']);
		$serverData['RAM']['free'] = $this->format_bytes($serverData['RAM']['free']);
		$serverData['RAM']['swapTotal'] = $this->format_bytes($serverData['RAM']['swapTotal']);
		$serverData['RAM']['swapFree'] = $this->format_bytes($serverData['RAM']['swapFree']);
		$serverData['RAM']['used'] = $this->format_bytes($RAMused);
		$serverData['RAM']['swapUsed'] = $this->format_bytes($swapused);
		foreach ($serverData['Network Devices'] as $dev=>$v) {
			$serverData['Network Devices'][$dev]['received_f'] = $this->format_bytes($serverData['Network Devices'][$dev]['recieved']['bytes']);
			$serverData['Network Devices'][$dev]['sent_f'] = $this->format_bytes($serverData['Network Devices'][$dev]['sent']['bytes']);
		}
		foreach ($serverData['Mounts'] as $mid=>$vid) {
			$serverData['Mounts'][$mid]['size'] = $this->format_bytes($serverData['Mounts'][$mid]['size']);
			$serverData['Mounts'][$mid]['used'] = $this->format_bytes($serverData['Mounts'][$mid]['used']);
			$serverData['Mounts'][$mid]['free'] = $this->format_bytes($serverData['Mounts'][$mid]['free']);
		}
		return $serverData;
	}
	
	function server_online_check($sid) {
		// 0 = server not online
		$servers = $this->config->item('ragnarok_servers');
		$map_server = @fsockopen($servers[$sid]['ip'], $servers[$sid]['map_port'], $errno, $errstr, 3);
		if (!$map_server) {
			return 0;
		}
		else {
			return 1;
		}
	}
	
	function format_bytes($bytes) {
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 
		
		$bytes /= pow(1024, $pow);
		return round($bytes, 2) . ' ' . $units[$pow]; 
	}
}