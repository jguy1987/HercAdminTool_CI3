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
	
	public function stats() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'serverstats') == True) {
			$this->usermodel->update_user_active($this->session_data['id'],"server/stats");
			$json_url = base_url('assets/linfo/?out=json');
			$data['server_stats'] = $this->servermodel->get_server_stats($json_url);
			$data['herc_stats'] = $this->servermodel->get_herc_stats(1);
			$data['mysql_stats'] = $this->servermodel->get_mysql_stats();
			$data['online_status'] = $this->servermodel->server_online_check($this->session->userdata('server_select'));
			$servers = array("login", "char", "map");
			foreach ($servers as $svr){
				$data['server_log'][$svr] = $this->servermodel->return_console($this->session->userdata('server_select'), $svr);
			}
			$this->load->view('server/stats', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function select_server($sid) {
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
		$this->session->set_userdata('server_select', $sid);
		$data['referpage'] = "serverselect";
		$data['refered_from'] = $this->session->userdata('refered_from');
		$data['server_select'] = $sid;
		$this->load->view('formsuccess', $data);
		$this->load->view('footer-nocharts.');
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
		}
		$this->load->view('footer-nocharts');
	}
}