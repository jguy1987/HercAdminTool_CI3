<?php
Class Servermodel extends CI_Model {
	
	public $servers;
	public $login_servers;
	public $login_srv_id;
	public $login_ssh_conn;
	public $charmap_ssh_conn;
	public function __construct() {
		require_once(APPPATH . '/third_party/vendor/autoload.php');
		$servers = $this->config->item('ragnarok_servers');
		$login_servers = $this->config->item('login_servers');
		$login_srv_id = $servers['1']['login_server_group'];
		
		if ($this->config->item('ssh_conn') == 1) {
			$this->login_ssh_conn = new \phpseclib\Net\SSH2($login_servers[$login_srv_id]['login_ssh_ip'], $login_servers[$login_srv_id]['login_ssh_port']);
			$this->login_sftp = new \phpseclib\Net\SFTP($login_servers[$login_srv_id]['login_ssh_ip'], $login_servers[$login_srv_id]['login_ssh_port']);
			if ($login_servers[$login_srv_id]['login_ssh_method'] == "plain") {
				if (!$this->login_ssh_conn->login($login_servers[$login_srv_id]['login_ssh_user'], $login_servers[$login_srv_id]['login_ssh_pass'])) {
					exit("Not able to make connection with your Login SSH server. Check your IP/Port, SSH Server status and credentials in hat.php.");
				}
				else {
					$this->login_sftp->login($login_servers[$login_srv_id]['login_ssh_user'], $login_servers[$login_srv_id]['login_ssh_pass']);
				}
				}
			else if ($login_servers[$login_srv_id]['login_ssh_method'] == "key") {
				// Not supported yet
			}
			
			$this->charmap_ssh_conn = new \phpseclib\Net\SSH2($servers[$this->session->userdata('server_select')]['server_ssh_ip'], $servers[$this->session->userdata('server_select')]['server_ssh_port']);
			$this->charmap_sftp = new \phpseclib\Net\SFTP($login_servers[$login_srv_id]['login_ssh_ip'], $login_servers[$login_srv_id]['login_ssh_port']);
			if ($servers[$this->session->userdata('server_select')]['server_ssh_method'] == "plain") {
				if (!$this->charmap_ssh_conn->login($servers[$this->session->userdata('server_select')]['server_ssh_user'], $servers[$this->session->userdata('server_select')]['server_ssh_pass'])) {
					exit("Not able to make connection with your Char/Map SSH server. Check your IP/Port, SSH Server status and credentials in hat.php.");
				}
				else {
					$this->charmap_sftp->login($servers[$this->session->userdata('server_select')]['server_ssh_user'], $servers[$this->session->userdata('server_select')]['server_ssh_pass']);
				}
			} 
			else if ($servers[$this->session->userdata('server_select')]['server_ssh_method'] == "key") {
				// Not implemented yet
			}
		}
	}
	
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
			if (!isset($laststartdate)) {
				$data = "servernameinvalid";
				return $data;
			}
			$serverstart = new DateTime($laststartdate->lastlogin);
			$now = date('Y-m-d H:i:s');
			$sinceStart = $serverstart->diff(new DateTime($now));
			//$sinceStartf = $sinceStart->format('%zd&nbsp;%hh&nbsp;%im&nbsp;%ss');
			$sinceStartf = $sinceStart->days."d&nbsp;".$sinceStart->h."h&nbsp;".$sinceStart->i."m&nbsp;".$sinceStart->s."s&nbsp;";
		}
		// Get users online
		$q7 = $this->db_charmap->get_where('char', array('online' => 1));
		
		$whosOnlineLink = "<a href='".base_url('character/whosonline')."'>Players Online</a>";
		$data = array(
			'hercUptime'				=> $sinceStartf,
			'onlineNum'				=> number_format($q7->num_rows()),
			'acctsNum'		=> number_format($q->num_rows()),
			'charsNum'			=> number_format($q2),
			'guildsNum'			=> number_format($q3),
			'guildsCharsNum'		=> number_format($q4->num_rows()),
			'zenyNum'		=> number_format($zeny->zeny),
		);
		if ($t = 1) {
			// Get more stats for the maintenance info page.

		}
		return $data;
	}
	
	function get_mysql_stats() {
		$stats = mysqli_stat($this->db_charmap->conn_id);
		$mySQLstats = array();
		foreach (explode("  ", $stats) as $k) {
			$ret = explode(': ', $k);
			$mySQLstats[$ret[0]] = $ret[1];
		}
		return $mySQLstats;
	}
	
	function get_server_performance($sid) {
		// Check server stats. 
		// Returns either: 
		// $serverData if all was OK.
		// 1 if the module(s) is/are not installed.
		// 2 if the XML file failed to load.
		$dir = $this->config->item('hat_path')."assets/psutil/get_sys_info.py";
		$serverStatXML = $this->config->item('hat_path')."application/logs/serverstat.xml";
		// First, make sure that psutils and lxml is available on the remote server. Script can't run if its not there.
		$psutilOut = $this->charmap_ssh_conn->exec("python -c 'import pkgutil; print(1 if pkgutil.find_loader(\"psutil\") else 0)'");
		$lxmlOut = $this->charmap_ssh_conn->exec("python -c 'import pkgutil; print(1 if pkgutil.find_loader(\"lxml\") else 0)'");
		if ($psutilOut == 1 && $lxmlOut == 1) { // Both modules exist on the remote server, OK to proceed.
			// Copy over the get_sys_info script onto the remote server and run.
			$this->charmap_sftp->put('get_sys_info.py', $dir, 'NET_SFTP_LOCAL_FILE');
			$this->charmap_ssh_conn->exec('python get_sys_info.py');
			// Grab the resulting XML file and copy it back to HAT. Place in logs directory.
			$this->charmap_sftp->get('serverstat.xml', $serverStatXML);
			// Parse the XML for inclusion into script.
			if (file_exists($serverStatXML)) {
				$xml = simplexml_load_file($serverStatXML);
			}
			else {
				return 2;
			}
			
			$serverData['name'] = $xml->basic->name;
			$serverData['OS'] = $xml->basic->os;
			$serverData['boot'] = date('Y-m-d H:i:s', intval($xml->basic->boottime));
			$serverData['loadavg'] = $xml->cpu->loadavg;
			$serverData['proc'] = $xml->cpu->proccount;
			$serverData['RAM']['used'] = $this->format_bytes($xml->mem->virtual->used);
			$serverData['RAM']['free'] = $this->format_bytes($xml->mem->virtual->avail);
			$serverData['RAM']['total'] = $this->format_bytes($xml->mem->virtual->total);
			$serverData['RAM']['used_pct'] = round($xml->mem->virtual->used/$xml->mem->virtual->total*100, 2);
			$serverData['RAM']['swapUsed'] = $this->format_bytes($xml->mem->swap->used);
			$serverData['RAM']['swapFree'] = $this->format_bytes($xml->mem->swap->avail);
			$serverData['RAM']['swapTotal'] = $this->format_bytes($xml->mem->swap->total);
			$serverData['RAM']['swapUsed_pct'] = $xml->mem->swap->pct;
			$serverData['disk']['total'] = $this->format_bytes($xml->disk->total);
			$serverData['disk']['used'] = $this->format_bytes($xml->disk->used);
			$serverData['disk']['free'] = $this->format_bytes($xml->disk->free);
			$serverData['disk']['used_pct'] = round($xml->disk->used / $xml->disk->total * 100, 2);
			return $serverData;
		}
		else {
			return 1;
		}
	}
	
	function server_online_check($sid, $svr) {
		// Checks the server online status. Returns true or false. True = server is online
		// $svr needs to be "login", "char", "map" or "all"
		$servers = $this->config->item('ragnarok_servers');
		$login_servers = $this->config->item('login_servers');
		$login_srv_id = $servers[$sid]['login_server_group'];
		if ($svr == "all") {
			$login_server = @stream_socket_client("tcp://{$login_servers[$login_srv_id]['login_ip']}:{$login_servers[$login_srv_id]['login_port']}", $errno, $errstr, 1);
			$char_server = @stream_socket_client("tcp://{$servers[$sid]['server_ip']}:{$servers[$sid]['char_port']}", $errno, $errstr, 1);
			$map_server = @stream_socket_client("tcp://{$servers[$sid]['server_ip']}:{$servers[$sid]['map_port']}", $errno, $errstr, 1);
			if (!is_resource($map_server) || !is_resource($char_server) || !is_resource($login_server)) { // One of the servers is not running.
				return false;
			}
			else {
				return true;
			}
		}
		else if ($svr == "login") {
			$server = @stream_socket_client("tcp://{$login_servers[$login_srv_id]['login_ip']}:{$login_servers[$login_srv_id]['login_port']}", $errno, $errstr, 1);
			if (!is_resource($server)) { // Server did not start.
				return false;
			}
			else {
				return true;
			}
		}
		else {
			$port = $svr."_port";
			$server = @stream_socket_client("tcp://{$servers[$sid]['server_ip']}:{$servers[$sid][$port]}", $errno, $errstr, 1);
			if (!is_resource($server)) { // Server did not start.
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
			while ($this->server_online_check($sid, $svr) == false && $checks < 7) { // while the server has not started OR we haven't tried more than 5 times...
				sleep(1);
				$checks += 1;
			}
			if ($this->server_online_check($sid, $svr) == false) {
				$cmd = sprintf("screen -S %s-server-%s -X stuff 'exit\n'", $svr, $servers[$sid]['map_servername']);
				if ($svr == "login") {
					$this->login_ssh_conn->exec($cmd); // Kill the server screen.
				}
				else if ($svr == "char" || $svr == "map") {
					$this->charmap_ssh_conn->exec($cmd); // Kill the server screen.
				}
				return "startfail";
			}
			else {
				return "start";
			}
		}
		else if ($status == "true") { // The login server is running, let's stop it
			$cmd = sprintf("screen -S %s-server-%s -X stuff 'server exit\n'", $svr, $servers[$sid]['map_servername']);
			if ($svr == "login") {
				$this->login_ssh_conn->exec($cmd); // Kill the server.
			}
			else if ($svr == "char" || $svr == "map") {
				$this->charmap_ssh_conn->exec($cmd); // Kill the server.
			}
			sleep(3); // Wait a few seconds to let it close.
			// Then make sure it is stopped.
			while ($this->server_online_check($sid, $svr) == true && $checks < 6) {
				sleep(2);
				$checks += 1;
			}
			if ($this->server_online_check($sid, $svr) == false) {
				// Server is stopped. Confirm with user and kill the screen
				$cmd = sprintf("screen -S %s-server-%s -X stuff 'exit\n'", $svr, $servers[$sid]['map_servername']);
				if ($svr == "login") {
					$this->login_ssh_conn->exec($cmd); // Kill the server screen.
				}
				else if ($svr == "char" || $svr == "map") {
					$this->charmap_ssh_conn->exec($cmd); // Kill the server screen.
				}
				return "stop";
			}
			else {
				// server did not stop...notify the user
				return "stopfail";
			}
		}
		$this->charmap_ssh_conn->exec('screen -wipe\n'); 
		$this->login_ssh_conn->exec('screen -wipe\n');// Wipe screens to remove dead.
	}
	
	function server_start($sid, $svr) {
		$servers = $this->config->item('ragnarok_servers');
		$login_servers = $this->config->item('login_servers');
		$login_srv_id = $servers[$sid]['login_server_group'];
		$cmd_screen = sprintf("screen -dmS %s-server-%s'\n'", $svr, $servers[$sid]['map_servername']);
		$charOut = "".$servers[$sid]['server_path']."/log/char-server-".$servers[$sid]['map_servername'].".log"; // Set the file path for the char server console logs
		$mapOut = "".$servers[$sid]['server_path']."/log/map-server-".$servers[$sid]['map_servername'].".log"; // Set the file path for the map server console logs
		$loginOut = "".$login_servers[$login_srv_id]['login_server_path']."/log/login-server-".$servers[$sid]['map_servername'].".log"; // Set the file path for the login server console logs
		$cmd_login = "screen -S login-server-".$servers[$sid]['map_servername']." -X stuff 'cd ".$login_servers[$login_srv_id]['login_server_path']." && ./".$login_servers[$login_srv_id]['login_server_exec']." > ".$loginOut."\n'";
		$cmd_char = "screen -S char-server-".$servers[$sid]['map_servername']." -X stuff 'cd ".$servers[$sid]['server_path']." && ./".$servers[$sid]['char_server_exec']." > ".$charOut."\n'";
		$cmd_map = "screen -S map-server-".$servers[$sid]['map_servername']." -X stuff 'cd ".$servers[$sid]['server_path']." && ./".$servers[$sid]['map_server_exec']." > ".$mapOut."\n'";
		switch ($svr) {
			case "login":
				$this->login_ssh_conn->exec($cmd_screen); // Open a screen for the login server
				$this->login_ssh_conn->exec($cmd_login); // Change directory to the login-server exec
				break;
			case "char":
				$this->charmap_ssh_conn->exec($cmd_screen); // Open a screen for the Char server
				$this->charmap_ssh_conn->exec($cmd_char); // Change directory to the char-server exec
				break;
			case "map":
				$this->charmap_ssh_conn->exec($cmd_screen); // Open a screen for the map server
				$this->charmap_ssh_conn->exec($cmd_map); // Change directory to the map-server exec
				break;
		}
	}
	
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
		$this->charmap_ssh_conn->exec(sprintf("screen -S map-server-%s -X stuff \"gm use @%s\"'\n'", $servers[$sid]['map_servername'], $action)); // Use the specified command.
	}
	
	function return_console($sid, $server, $lines) {
		$servers = $this->config->item('ragnarok_servers');
		$login_servers = $this->config->item('login_servers');
		$login_srv_id = $servers[$sid]['login_server_group'];
		$charOut = "".$servers[$sid]['server_path']."/log/char-server-".$servers[$sid]['map_servername'].".log"; // Set the file path for the char server console logs
		$mapOut = "".$servers[$sid]['server_path']."/log/map-server-".$servers[$sid]['map_servername'].".log"; // Set the file path for the map server console logs
		$loginOut = "".$login_servers[$login_srv_id]['login_server_path']."/log/login-server-".$servers[$sid]['map_servername'].".log"; // Set the file path for the login server console logs
		if ($server == "login") {
			$this->login_sftp->get($loginOut, "".$this->config->item('hat_path')."application/logs/".$server."-server-".$servers[$sid]['map_servername'].".log");
			$filepath = "".$this->config->item('hat_path')."application/logs/".$server."-server-".$servers[$sid]['map_servername'].".log";
		}
		else if ($server == "char") {
			$this->charmap_sftp->get($charOut, "".$this->config->item('hat_path')."application/logs/".$server."-server-".$servers[$sid]['map_servername'].".log");
			$filepath = "".$this->config->item('hat_path')."application/logs/".$server."-server-".$servers[$sid]['map_servername'].".log";
		}
		else if ($server == "map") {
			$this->charmap_sftp->get($mapOut, "".$this->config->item('hat_path')."application/logs/".$server."-server-".$servers[$sid]['map_servername'].".log");
			$filepath = "".$this->config->item('hat_path')."application/logs/".$server."-server-".$servers[$sid]['map_servername'].".log";
		}
		
		$adaptive = true;
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
		$this->charmap_ssh_conn->exec(sprintf("screen -S map-server-%s -X stuff \"gm use @kick %s\"'\n'", $servers[$sid]['map_servername'], $result->name));
	}
	
	function format_bytes($bytes) {
		$bytes = intval($bytes);
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		$bytes = max($bytes, 0);
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 
		
		$bytes /= pow(1024, $pow);
		return round($bytes, 2) . ' ' . $units[$pow]; 
	}
	
	function update_files($sid) {
		// This function runs either svn up or git pull origin master
		$servers = $this->config->item('ragnarok_servers');
		$login_servers = $this->config->item('login_servers');
		$login_srv_id = $servers[$sid]['login_server_group'];
		switch ($login_servers[$login_srv_id]['login_update_method']) {
			case "svn":
				$cmd_login = "cd ".$login_servers[$login_srv_id]['login_server_path']." && svn up\n'";
				break;
			case "git":
				$cmd_login = "cd ".$login_servers[$login_srv_id]['login_server_path']." && git pull origin master'\n'";
				break;
			default:
				return 2;
		}
		switch ($servers[$sid]['charmap_update_method']) {
			case "svn":
				$cmd_charmap = "cd ".$servers[$sid]['server_path']." && svn up'\n'";
				break;
			case "git":
				$cmd_charmap = "cd ".$servers[$sid]['server_path']." && git pull origin master'\n'";
				break;
			default:
				return 2;
		}
		$this->login_ssh_conn->exec($cmd_login);
		$this->charmap_ssh_conn->exec($cmd_charmap);
		return 1;
	}
	
	function get_broadcast_list() {
		$this->db_charmap->select('*');
		$q = $this->db_charmap->get('hat_broadcasts');
		return $q->result_array();
	}
}