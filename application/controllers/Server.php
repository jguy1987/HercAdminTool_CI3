<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$data['username'] = $this->session_data['username'];
		
		$this->load->view('header', $data);
		$data['check_perm'] = $this->check_perm;
		$this->load->view('sidebar', $data);
	}
	
	public function select_server($sid) {
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
		$this->session->set_userdata('server_select', $sid);
		$data['referpage'] = "serverselect";
		$data['refered_from'] = $this->session->userdata('refered_from');
		$data['server_select'] = $sid;
		$this->load->view('formsuccess', $data);
		$this->load->view('footer');
	}
	
	public function hercules() {
		$servers = $this->config->item('ragnarok_servers');
		$serverTypes = array("login", "char", "map");
		foreach ($serverTypes as $svr){
			$data['server_log'][$svr] = $this->servermodel->return_console($this->session->userdata('server_select'), $svr, 15);
		}
		$data['serverName'] = $servers[$this->session->userdata('server_select')]['servername'];
		$data['online_status'] = $this->servermodel->server_online_check($this->session->userdata('server_select'));
		$data['herc_stats'] = $this->servermodel->get_herc_stats(1);
		$this->load->view('server/hercinfo', $data);
		$this->load->view('datatables-scripts');
		$this->load->view('footer');
	}
	
	public function maintenance($action) {
		// Start/stop/restart server.
		$servers = $this->config->item('ragnarok_servers');
		$serverName = $servers[$this->session->userdata('server_select')]['map_servername'];
		switch( $action ) {
			case "start":
				// Start the server
				$startInfo = $this->servermodel->server_start($this->session->userdata('server_select'));
				if ($startInfo['result'] == 0) { // Server failed to start for some reason (will output log)
					$data['maint_result'] = "didnotstart";
					$this->load->view('server/maintresult', $data);
				}
				elseif ($startInfo['result'] == 1) { // A process is already running on one of the ports, server cannot start.
					echo "Servers already running!";
				}
				elseif ($startInfo['result'] == 2) { // Server started.
					$data['action'] = $action;
					//$data['last_10'] = $startInfo['last_10'];
					$data['maint_result'] = "startsuccess";
					$this->load->view('server/maintresult', $data);
				}
				break;
			case "stop":
				$this->servermodel->server_stop($this->session->userdata('server_select'));
				$data['maint_result'] = "stop";
				$this->load->view('server/maintresult', $data);
				break;
			case "restart":
				$this->servermodel->server_stop($this->session->userdata('server_select'));
				$startInfo = $this->servermodel->server_start($this->session->userdata('server_select'));
				if ($startInfo['result'] == 0) { // Server failed to start for some reason (will output log)
					$data['maint_result'] = "didnotstart";
					$this->load->view('server/maintresult', $data);
				}
				elseif ($startInfo['result'] == 1) { // A process is already running on one of the ports, server cannot start.
					echo "Servers already running!";
				}
				elseif ($startInfo['result'] == 2) { // Server started.
					$data['action'] = $action;
					//$data['last_10'] = $startInfo['last_10'];
					$data['maint_result'] = "restartsuccess";
					$this->load->view('server/maintresult', $data);
				}
				break;
			case "toggle":
				$server = $this->uri->segment(4);
				if ($server === FALSE) {
					$data['maint_result'] = "toggleservermissing";
					$this->load->view('server/maintresult', $data);
				}
				else {
					$toggleresult = $this->servermodel->server_toggle($this->session->userdata('server_select'), $server);
					if ($toggleresult == 0) { // Server did not start.
						$data['maint_result'] = "toggleserverfailed";
						$this->load->view('server/maintresult', $data);
					}
					elseif ($toggleresult == 1) { // Server was stopped
						$data['maint_result'] = "toggleserverstopsuccess";
						$this->load->view('server/maintresult', $data);
					}
					elseif ($toggleresult == 2) { // Server started.
						$data['maint_result'] = "toggleserverstartsuccess";
						$this->load->view('server/maintresult', $data);
					}
				}
				break;
			case "screen_wipe":
				exec("screen -wipe");
				$data['maint_result'] = "screenwipe";
				$this->load->view('server/maintresult', $data);
				break;
			case "reloadscript":
				$this->servermodel->send_maint_cmd($this->session->userdata('server_select'), $action);
				$data['cmd_used'] = $action;
				$data['maint_result'] = "cmdsent";
				$this->load->view('server/maintresult', $data);
				break;
			case "reloadbattleconf":
				$this->servermodel->send_maint_cmd($this->session->userdata('server_select'), $action);
				$data['cmd_used'] = $action;
				$data['maint_result'] = "cmdsent";
				$this->load->view('server/maintresult', $data);
				break;
			case "reloadatcommand":
				$this->servermodel->send_maint_cmd($this->session->userdata('server_select'), $action);
				$data['cmd_used'] = $action;
				$data['maint_result'] = "cmdsent";
				$this->load->view('server/maintresult', $data);
				break;
			case "updatefiles":
				$data['update_result'] = $this->servermodel->update_files($this->session->userdata('server_select'));
				$data['maint_result'] = "updatefiles";
				$this->load->view('server/maintresult', $data);
		}
		$this->load->view('datatables-scripts');
		$this->load->view('footer');
	}
	
	public function console($server) {
		$data['server_log'] = $this->servermodel->return_console($this->session->userdata('server_select'), $server, 1000);
		$data['server'] = $server;
		$this->load->view('server/console', $data);
		$this->load->view('datatables-scripts');
		$this->load->view('footer');
	}
}