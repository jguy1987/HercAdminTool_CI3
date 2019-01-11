<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$data['username'] = $this->session_data['username'];
		$data['check_perm'] = $this->check_perm;
		$this->vacation = $this->usermodel->check_vacation_mode($this->session_data['id']);
		$data['vacation'] = $this->usermodel->check_vacation_mode($this->session_data['id']);
		$data['ssh_conn'] = $this->config->item('ssh_conn');
		$this->load->view('topnav', $data);
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
		#$this->load->view('server/footer');
	}
	
	public function hercules() {
		$servers = $this->config->item('ragnarok_servers');
		$serverTypes = array("login", "char", "map");
		foreach ($serverTypes as $svr){
			$data['server_log'][$svr] = $this->servermodel->return_console($this->session->userdata('server_select'), $svr, 15);
		}
		$data['serverName'] = $servers[$this->session->userdata('server_select')]['servername'];
		$data['online_status']['login'] = $this->servermodel->server_online_check($this->session->userdata('server_select'), "login");
		$data['online_status']['char'] = $this->servermodel->server_online_check($this->session->userdata('server_select'), "char");
		$data['online_status']['map'] = $this->servermodel->server_online_check($this->session->userdata('server_select'), "map");
		$data['herc_stats'] = $this->servermodel->get_herc_stats(1);
		$this->load->view('server/hercinfo', $data);
		$this->load->view('footer');
		#$this->load->view('server/footer');
	}
	
	public function maintenance($action) {
		// Start/stop/restart server.
		$servers = $this->config->item('ragnarok_servers');
		$serverName = $servers[$this->session->userdata('server_select')]['map_servername'];
		switch( $action ) {
			case "start":
				// Start the server
				$data['maintresult'] = $this->servermodel->all_server_toggle($this->session->userdata('server_select'), "start");
				$this->load->view('server/maintresult', $data);
				break;
			case "stop":
				$data['maintresult'] = $this->servermodel->all_server_toggle($this->session->userdata('server_select'), "stop");
				$this->load->view('server/maintresult', $data);
				break;
			case "restart":
				$stopInfo = $this->servermodel->all_server_toggle($this->session->userdata('server_select'), "stop");
				if ($stopInfo == "stop") {
					$data['maintresult'] = $this->servermodel->all_server_toggle($this->session->userdata('server_select'), "start");
					$this->load->view('server/maintresult', $data);
				}
				else if ($stopInfo == "stopfail") {
					$data['maintresult'] = $stopInfo;
					$this->load->view('server/maintresult', $data);
				}
				break;
			case "toggle":
				$server = $this->uri->segment(4);
				if ($server === FALSE) {
					$data['maintresult'] = "toggleservermissing";
					$this->load->view('server/maintresult', $data);
				}
				else {
					$toggleresult = $this->servermodel->server_toggle($this->session->userdata('server_select'), $server);
					if ($toggleresult == "startfail") { // Server did not start.
						$data['maintresult'] = "toggleserverfailed";
						$this->load->view('server/maintresult', $data);
					}
					elseif ($toggleresult == "stop") { // Server was stopped
						$data['maintresult'] = "toggleserverstopsuccess";
						$this->load->view('server/maintresult', $data);
					}
					elseif ($toggleresult == "start") { // Server started.
						$data['maintresult'] = "toggleserverstartsuccess";
						$this->load->view('server/maintresult', $data);
					}
					else if ($toggleresult == "stopfail") {
						$data['maintresult'] = $toggleresult;
						$this->load->view('server/maintresult', $data);
					}
				}
				break;
			case "screen_wipe":
				exec("screen -wipe");
				$data['maintresult'] = "screenwipe";
				$this->load->view('server/maintresult', $data);
				break;
			case "reloadscript":
				$this->servermodel->send_maint_cmd($this->session->userdata('server_select'), $action);
				$data['cmd_used'] = $action;
				$data['maintresult'] = "cmdsent";
				$this->load->view('server/maintresult', $data);
				break;
			case "reloadbattleconf":
				$this->servermodel->send_maint_cmd($this->session->userdata('server_select'), $action);
				$data['cmd_used'] = $action;
				$data['maintresult'] = "cmdsent";
				$this->load->view('server/maintresult', $data);
				break;
			case "reloadatcommand":
				$this->servermodel->send_maint_cmd($this->session->userdata('server_select'), $action);
				$data['cmd_used'] = $action;
				$data['maintresult'] = "cmdsent";
				$this->load->view('server/maintresult', $data);
				break;
			case "updatefiles":
				$data['update_result'] = $this->servermodel->update_files($this->session->userdata('server_select'));
				$data['maintresult'] = "updatefiles";
				$this->load->view('server/maintresult', $data);
		}
		$this->load->view('footer');
		#$this->load->view('server/footer');
	}
	
	public function console($server) {
		$data['server_log'] = $this->servermodel->return_console($this->session->userdata('server_select'), $server, 1000);
		$data['server'] = $server;
		$this->load->view('server/console', $data);
		$this->load->view('footer');
		#$this->load->view('server/footer');
	}
	
	public function broadcast() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'announcement') == True) {
			$this->usermodel->update_user_active($this->session_data['id'],"server/broadcast");
			$data['broadcasts'] = $this->servermodel->get_broadcast_list();
			foreach ($data['broadcasts'] as $id=>$v) {
				$data['broadcasts'][$id]['username'] = $this->adminmodel->get_admin_name($v['userid']);
			}
			$this->load->view('server/broadcast', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		#$this->load->view('server/footer');
	}
}