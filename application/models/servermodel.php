<?php
Class Servermodel extends CI_Model {

	function get_herc_stats() {
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
		$this->db_ragnarok->select('lastlogin');
		$this->db_ragnarok->from('login');
		$this->db_ragnarok->where('userid', $this->config->item('map_servername'));
		$q6 = $this->db_ragnarok->get();
		$laststartdate = $q6->row();
		$serverstart = new DateTime($laststartdate->lastlogin);
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
	
	function get_mysql_stats() {
		
	}
	
	function get_server_stats($xml_url) {
		$xml = simplexml_load_file($xml_url);
		$data = array();
		// Format some of the results and put them into an array for easier retrieval.
		// It's not the best to convert the object into an array in this case...but...
		$data += array(
			'cpu_avg' 		=> $xml->core->load,
			'sys_uptime' 	=> $xml->core->uptime,
			'cpu_threads' 	=> $xml->core->threads,
			'procs'			=> $xml->core->processes,
		);
		
		// Format memory output...
		$data += array(
			'mem_total'			=> $this->format_bytes($xml->memory->Physical->total),
			'mem_free'			=> $this->format_bytes($xml->memory->Physical->free),
			'mem_used'			=> $this->format_bytes($xml->memory->Physical->used),
			'mem_used_pct'		=> round($xml->memory->Physical->used / $xml->memory->Physical->total * 100),
			'swap_total'		=> $this->format_bytes($xml->memory->swap->total),
			'swap_free'			=> $this->format_bytes($xml->memory->swap->free),
			'swap_used'			=> $this->format_bytes($xml->memory->swap->used),
			'swap_used_pct'	=> round($xml->memory->swap->used / $xml->memory->swap->total * 100),
		);
		
		// And network output
		foreach ($xml->net as $net) {
			if ($net->device == "eth0") {
				$data += array(
					'networks'	=> array(
						'etho0' => array(
							'sent'	=> format_bytes($net->sent),
							'recv'	=> format_bytes($net->received),
						),
					),
				);
			}
		}
		
		// And disks....only / and /home are shown.
		foreach ($xml->mounts as $disks) {
			if ($disks->mountpoint == "/") {
				$data += array(
					'disks'	=> array(
						'/'		=> array(
							'total'		=> $this->format_bytes($disks->size),
							'used'		=> $this->format_bytes($disks->used),
							'used_pct'	=> round($disks->used / $disks->size * 100),
							'free'		=> $this->format_bytes($disks->free),
						),
					),
				);
			}
			
			if ($disks->mountpoint == "/home") {
				$data += array(
					'disks'	=> array(
						'/home'	=> array(
							'total'		=> $this->format_bytes($disks->size),
							'used'		=> $this->format_bytes($disks->used),
							'used_pct'	=> round($disks->used / $disks->size * 100),
							'free'		=> $this->format_bytes($disks->free),
						),
					),
				);
			}
		}
		return $data;
	}
	
	function format_bytes($bytes) {
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 

		return round($bytes, 2) . ' ' . $units[$pow]; 
	} 
}