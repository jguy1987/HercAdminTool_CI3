<?php
Class Servermodel extends CI_Model {

	function get_herc_stats($t) {
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
		if ($t = 1) {
			// Get more stats for the maintenance info page.

		}
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
		// 0 = server online
		$servers = $this->config->item('ragnarok_servers');
		$login_server = @fsockopen($servers[$sid]['ip'], $servers[$sid]['login_port'], $errno, $errstr, 3);
		$char_server = @fsockopen($servers[$sid]['ip'], $servers[$sid]['char_port'], $errno, $errstr, 3);
		$map_server = @fsockopen($servers[$sid]['ip'], $servers[$sid]['map_port'], $errno, $errstr, 3);
		if (!$map_server || !$char_server || !$login_server) { // One of the servers is not running.
			$status = 0;
			if (!$login_server) { // the login server is not running.
				$status = $status + 1;
			}
			if (!$char_server) { // char server not running.
				$status = $status + 2;
			}
			if (!$map_server) { // Map server not running.
				$status = $status + 4;
			}
			// In the above, the values are bitmasks. 
			// 1 = login server not running.
			// 2 = char server not running.
			// 4 = map server not running.
			// Example, if the login and map server were not running, we would return 5.
			// If the char and map server were not running, we would return 6.
			return $status;
		}
		else {
			return 0;
		}
	}
	
	function server_start($sid) {
		$servers = $this->config->item('ragnarok_servers');
		// Check to make sure server isn't already running on that port
		$sstatus = $this->server_online_check($sid);
		if ($sstatus == 1) { // Server already running, return result 1
			return array('result' => 1);
		}
		else { // No servers running, proceed.
			$pid = array();
			$login_server = @fsockopen($servers[$sid]['ip'], $servers[$sid]['login_port'], $errno, $errstr, 3);
			if (!$login_server) { //Login server is not running, need to start it.
				exec("screen -dmS login-server");
				
				$loginOut = "".$this->config->item('hat_path')."application/hat_log/login-server.log";
				$loginPid = "".$this->config->item('hat_path')."application/hat_log/login-server.pid";
				exec(sprintf("screen -S login-server -X stuff \"cd %s\"'\n'", $servers[$sid]['server_path']));
				exec(sprintf("screen -S login-server -X stuff \"./%s > %s\"'\n'", $servers[$sid]['login_server_exec'], $loginOut));
				sleep(3);
				$pid['login'] = exec(sprintf("lsof -t -i :%s", $servers[$sid]['login_port']));
			}
			
			$screenChar = "screen -dmS char-server-".$servers[$sid]['map_servername']."";
			exec($screenChar);
			$charOut = "".$this->config->item('hat_path')."application/hat_log/char-server-".$servers[$sid]['map_servername'].".log";
			$charPid = "".$this->config->item('hat_path')."application/hat_log/char-server-".$servers[$sid]['map_servername'].".pid";
			exec(sprintf("screen -S char-server-%s -X stuff \"cd %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['server_path']));
			exec(sprintf("screen -S char-server-%s -X stuff \"./%s > %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['char_server_exec'], $charOut));
			sleep(3);
			$pid['char'] = exec(sprintf("lsof -t -i :%s", $servers[$sid]['char_port']));
			
			$screenMap = "screen -dmS map-server-".$servers[$sid]['map_servername']."";
			exec($screenMap);
			$mapOut = "".$this->config->item('hat_path')."application/hat_log/map-server-".$servers[$sid]['map_servername'].".log";
			$mapPid = "".$this->config->item('hat_path')."application/hat_log/map-server-".$servers[$sid]['map_servername'].".pid";
			exec(sprintf("screen -S map-server-%s -X stuff \"cd %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['server_path']));
			exec(sprintf("screen -S map-server-%s -X stuff \"./%s > %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['map_server_exec'], $mapOut));
			sleep(5);
			$pid['map'] = exec(sprintf("lsof -t -i :%s", $servers[$sid]['map_port']));
			if ($this->server_online_check($sid) > 0) { // One of the servers did not start. killall the processes (don't want to kill the wrong server), destroy the screen, get the full logs of the servers and return 0.
				// TODO replace with function
				exec(sprintf("kill %s", $pid['login']));
				exec(sprintf("kill %s", $pid['char']));
				exec(sprintf("kill %s", $pid['map']));
				sleep(5);
				exec("screen -S login-server -X stuff \"exit\"'\n'"); // Kill the login server screen.
				exec(sprintf("screen -S char-server-%s -X stuff \"exit\"'\n'", $servers[$sid]['map_servername'])); // Kill the char server screen.
				exec(sprintf("screen -S map-server-%s -X stuff \"exit\"'\n'", $servers[$sid]['map_servername'])); // Kill the map server screen.
				exec('screen -wipe'); // Wipe screens to remove dead.
				return array('result' => 0); // Let user know servers did not start.
			}
			else {
				return array('result' => 2); // Servers started successfully.
			}
		}
	}
	
	function server_stop($sid) {
		$servers = $this->config->item('ragnarok_servers');
		exec("screen -S login-server -X stuff \"server exit\"'\n'");
		exec(sprintf("screen -S char-server-%s -X stuff \"server exit\"'\n'", $servers[$sid]['map_servername'])); // Kill the char server
		exec(sprintf("screen -S map-server-%s -X stuff \"server exit\"'\n'", $servers[$sid]['map_servername'])); // Kill the map server.
		sleep(7); // Wait for servers to close.
		exec("screen -S login-server -X stuff \"exit\"'\n'"); // Kill the login server screen.
		exec(sprintf("screen -S char-server-%s -X stuff \"exit\"'\n'", $servers[$sid]['map_servername'])); // Kill the char server screen.
		exec(sprintf("screen -S map-server-%s -X stuff \"exit\"'\n'", $servers[$sid]['map_servername'])); // Kill the map server screen.
	}
	
	function return_console($sid, $server) {
		$servers = $this->config->item('ragnarok_servers');
		if ($server == "login") {
			$filepath = "".$this->config->item('hat_path')."application/hat_log/".$server."-server.log";
		}
		else {
			$filepath = "".$this->config->item('hat_path')."application/hat_log/".$server."-server-".$servers[$sid]['map_servername'].".log";
		}
		$lines = 15;
		$adaptive = true;
		// Open file
		$f = @fopen($filepath, "rb");
		if ($f === false) return false;

		// Sets buffer size
		if (!$adaptive) $buffer = 4096;
		else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));

		// Jump to last character
		fseek($f, -1, SEEK_END);

		// Read it and adjust line number if necessary
		// (Otherwise the result would be wrong if file doesn't end with a blank line)
		if (fread($f, 1) != "\n") $lines -= 1;
		
		// Start reading
		$output = '';
		$chunk = '';

		// While we would like more
		while (ftell($f) > 0 && $lines >= 0) {

			// Figure out how far back we should jump
			$seek = min(ftell($f), $buffer);

			// Do the jump (backwards, relative to where we are)
			fseek($f, -$seek, SEEK_CUR);

			// Read a chunk and prepend it to our output
			$output = ($chunk = fread($f, $seek)) . $output;

			// Jump back to where we started reading
			fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

			// Decrease our line counter
			$lines -= substr_count($chunk, "\n");

		}

		// While we have too many lines
		// (Because of buffer size we might have read too many)
		while ($lines++ < 0) {

			// Find first newline and remove all text before that
			$output = substr($output, strpos($output, "\n") + 1);

		}

		// Close file and return
		fclose($f);
		//return trim($output);
		return $output;
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