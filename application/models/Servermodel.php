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
		$this->db_charmap->where('guild_id > 0');
		$q4 = $this->db_charmap->get();		
		// Get total amount of zeny on all characters
		$this->db_charmap->select_sum('zeny');
		$q5 = $this->db_charmap->get('char');
		$zeny = $q5->row();
		// Get server uptime
		// First, if the server is offline, don't even check this
		if ($this->server_online_check($this->session->userdata('server_select'), "all") == false) {
			$sinceStartf = "<span style='color:red'>Server Offline</span>";
		}
		else {
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
			//$sinceStartf = $sinceStart->format('%zd&nbsp;%hh&nbsp;%im&nbsp;%ss');
			$sinceStartf = $sinceStart->days."d&nbsp;".$sinceStart->h."h&nbsp;".$sinceStart->i."m&nbsp;".$sinceStart->s."s&nbsp;";
		}
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
	
	function server_online_check($sid, $svr) {
		// Checks the server online status. Returns true or false. True = server is online
		// $svr needs to be "login", "char", "map" or "all"
		$servers = $this->config->item('ragnarok_servers');
		if ($svr == "all") {
			$login_server = @fsockopen($servers[$sid]['ip'], $servers[$sid]['login_port'], $errno, $errstr, 3);
			$char_server = @fsockopen($servers[$sid]['ip'], $servers[$sid]['char_port'], $errno, $errstr, 3);
			$map_server = @fsockopen($servers[$sid]['ip'], $servers[$sid]['map_port'], $errno, $errstr, 3);
			if (!$map_server || !$char_server || !$login_server) { // One of the servers is not running.
				return false;
			}
			else {
				return true;
			}
		}
		else {
			$port = $svr."_port";
			$server = @fsockopen($servers[$sid]['ip'], $servers[$sid][$port], $errno, $errstr, 3);
			if (!$server) { // Server did not start.
				return false;
			}
			else {
				return true;
			}
		}
	}
	
	function server_toggle($sid, $svr) {
		// Starts or stops the server(s). $srv can either be "login", "char", "map".
		// If the server is running on the open port, the function will attempt to stop it.
		// If the server is not running on the port, the function will attempt to start it.
		$servers = $this->config->item('ragnarok_servers');
		$checks = 0;
		$status = $this->server_online_check($sid, $svr);
		if ($status == false) { // This server is not running, start it.
			$this->server_start($sid, $svr);
			while ($this->server_online_check($sid, $svr) == false && $checks < 6) { // while the server has not started OR we haven't tried more than 5 times...
				sleep(2);
				$checks += 1;
			}
			if ($this->server_online_check($sid, $svr) == false) {
				exec(sprintf("screen -S %s-server-%s -X stuff \"exit\"'\n'", $svr, $servers[$sid]['map_servername'])); // Kill the server screen.
				return "startfail";
			}
			else {
				return "start";
			}
		}
		else if ($status == "true") { // The login server is running, let's stop it
			exec(sprintf("screen -S %s-server-%s -X stuff \"server exit\"'\n'", $svr, $servers[$sid]['map_servername'])); // Kill the server screen.
			sleep(3); // Wait a few seconds to let it close.
			// Then make sure it is stopped.
			while ($this->server_online_check($sid, $svr) == true && $checks < 6) {
				sleep(2);
				$checks += 1;
			}
			if ($this->server_online_check($sid, $svr) == false) {
				// Server is stopped. Confirm with user and kill the screen
				exec(sprintf("screen -S %s-server-%s -X stuff \"exit\"'\n'", $svr, $servers[$sid]['map_servername'])); // Kill the server screen.
				return "stop";
			}
			else {
				// server did not stop...notify the user
				return "stopfail";
			}
		}
		exec('screen -wipe'); // Wipe screens to remove dead.
	}
	
	function server_start($sid, $svr) {
		$servers = $this->config->item('ragnarok_servers');
		switch ($svr) {
			case "login":
				$screenLogin = "screen -dmS login-server-".$servers[$sid]['map_servername']."";
				exec($screenLogin); // Open a screen for the login server
				$loginOut = "".$this->config->item('hat_path')."application/hat_log/login-server.log"; // Set the file path for the login server console logs
				exec(sprintf("screen -S login-server-%s -X stuff \"cd %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['server_path'])); // Change directory to the login-server exec
				exec(sprintf("screen -S login-server-%s -X stuff \"./%s > %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['login_server_exec'], $loginOut)); // Run the command to start the login server.
				break;
			case "char":
				$screenChar = "screen -dmS char-server-".$servers[$sid]['map_servername']."";
				exec($screenChar); // Open a screen for the Char server
				$charOut = "".$this->config->item('hat_path')."application/hat_log/char-server-".$servers[$sid]['map_servername'].".log"; // Set the file path for the char server console logs
				exec(sprintf("screen -S char-server-%s -X stuff \"cd %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['server_path'])); // Change directory to the char-server exec
				exec(sprintf("screen -S char-server-%s -X stuff \"./%s > %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['char_server_exec'], $charOut)); // Run the command to start the char server.
				break;
			case "map":
				$screenMap = "screen -dmS map-server-".$servers[$sid]['map_servername']."";
				exec($screenMap); // Open a screen for the map server
				$mapOut = "".$this->config->item('hat_path')."application/hat_log/map-server-".$servers[$sid]['map_servername'].".log"; // Set the file path for the map server console logs
				exec(sprintf("screen -S map-server-%s -X stuff \"cd %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['server_path'])); // Change directort to the map-server exec
				exec(sprintf("screen -S map-server-%s -X stuff \"./%s > %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['map_server_exec'], $mapOut)); // Run the command to start the map server.
				break;
		}
	}
	/* function login_server_start($sid) {
		$servers = $this->config->item('ragnarok_servers');
		exec("screen -dmS login-server"); // Open a screen for the login server
		$loginOut = "".$this->config->item('hat_path')."application/hat_log/login-server.log"; // Set the file path for the login server console logs
		exec(sprintf("screen -S login-server -X stuff \"cd %s\"'\n'", $servers[$sid]['server_path'])); // Change directory to the login-server exec
		exec(sprintf("screen -S login-server -X stuff \"./%s > %s\"'\n'", $servers[$sid]['login_server_exec'], $loginOut)); // Run the command to start the login server.
	}
	
	function char_server_start($sid) {
		$servers = $this->config->item('ragnarok_servers');
		$screenChar = "screen -dmS char-server-".$servers[$sid]['map_servername']."";
		exec($screenChar); // Open a screen for the Char server
		$charOut = "".$this->config->item('hat_path')."application/hat_log/char-server-".$servers[$sid]['map_servername'].".log"; // Set the file path for the char server console logs
		exec(sprintf("screen -S char-server-%s -X stuff \"cd %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['server_path'])); // Change directory to the char-server exec
		exec(sprintf("screen -S char-server-%s -X stuff \"./%s > %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['char_server_exec'], $charOut)); // Run the command to start the char server.
	}
	
	function map_server_start($sid) {
		$servers = $this->config->item('ragnarok_servers');
		$screenMap = "screen -dmS map-server-".$servers[$sid]['map_servername']."";
		exec($screenMap); // Open a screen for the map server
		$mapOut = "".$this->config->item('hat_path')."application/hat_log/map-server-".$servers[$sid]['map_servername'].".log"; // Set the file path for the map server console logs
		exec(sprintf("screen -S map-server-%s -X stuff \"cd %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['server_path'])); // Change directort to the map-server exec
		exec(sprintf("screen -S map-server-%s -X stuff \"./%s > %s\"'\n'", $servers[$sid]['map_servername'], $servers[$sid]['map_server_exec'], $mapOut)); // Run the command to start the map server.
	} */
	
	function all_server_toggle($sid, $cmd) {
		// This function accepts server id ($sid) and command ($cmd)
		// Command can be start or stop. If "start", the function will attempt to start all three servers. If "stop", it will stop all three servers.
		$arr = array();
		switch ($cmd) {
			case "start":
				// Check to see if any of the servers are already started.
				$result['login'] = $this->server_online_check($sid, "login");
				$result['char'] = $this->server_online_check($sid, "char");
				$result['map'] = $this->server_online_check($sid, "map");
				// Attempt to start the missing server(s).
				foreach ($result as $k=>$v) {
					if ($v == false) { // This server hasn't been started
						$result[$k] = $this->server_toggle($sid, $k);
						if ($result[$k] == false) { // This server is still not running
							return "didnotstart";
						}
					}
				}
				return "startsuccess";
				break;
			case "stop":
				// Check to see if any of the servers aren't running.
				$result['login'] = $this->server_online_check($sid, "login");
				$result['char'] = $this->server_online_check($sid, "char");
				$result['map'] = $this->server_online_check($sid, "map");
				// Attempt to stop the running server(s).
				foreach ($result as $k=>$v) {
					if ($v == true) { // This server is running
						$result[$k] = $this->server_toggle($sid, $k);
						if ($result[$k] == "stopfail") { // This server is still running, did not stop.
							return "stopfail";
						}
					}
				}
				return "stop";
				break;
		}
	}
	
	function send_maint_cmd($sid, $action) {
		$servers = $this->config->item('ragnarok_servers');
		exec(sprintf("screen -S map-server-%s -X stuff \"gm use @%s\"'\n'", $servers[$sid]['map_servername'], $action)); // Use the specified command.
	}
	
	function update_files($sid) {
		$servers = $this->config->item('ragnarok_servers');
		switch( $servers[$sid]['update_method'] ) {
			case "svn":
				exec(sprintf("svn update %s", $servers[$sid]['server_path']), $result);
				return $result;
				break;
			case "git":
				exec(sprintf("git --git-dir=%s.git", $servers[$sid]['server_path']), $result);
				return $result;
				break;
			case "off":
				$result = "This feature is disabled.";
				return $result;
				break;
		}
	}
	
	function return_console($sid, $server, $lines) {
		$servers = $this->config->item('ragnarok_servers');
		if ($server == "login") {
			$filepath = "".$this->config->item('hat_path')."application/hat_log/".$server."-server.log";
		}
		else {
			$filepath = "".$this->config->item('hat_path')."application/hat_log/".$server."-server-".$servers[$sid]['map_servername'].".log";
		}
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
	
	function apply_server_kick($cid, $sid) {
		$servers = $this->config->item('ragnarok_servers');
		// Get name from Char_id
		$this->db_charmap->select('name');
		$q = $this->db_charmap->get_where('char', array('char_id' => $cid));
		$result = $q->row();
		exec(sprintf("screen -S map-server-%s -X stuff \"gm use @kick %s\"'\n'", $servers[$sid]['map_servername'], $result->name)); // Kick the user off the server.
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