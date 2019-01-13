<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

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

	public function index() {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($this->session_data['id'],"dashboard");
		$servers = $this->config->item('ragnarok_servers');
		$data2['servername'] = $servers[$this->session->userdata('server_select')]['servername'];
		$data['acct_regs'] = $this->dashboardmodel->get_acct_reg_by_date();
		$data2['herc_stats'] = $this->servermodel->get_herc_stats(0);
		if ($data2['herc_stats'] == "servernameinvalid") {
			$error['errtype'] = "invalidservername";
			die($this->load->view('errdisplay', $error, TRUE));
		}
		$data2['active_admins']	= $this->dashboardmodel->get_active_admins();
		$data2['vacation_admins'] = $this->adminmodel->get_vacation_admins();
		if ($this->adminmodel->check_perm($this->session_data['group'],'serverstats') == True && $servers[$this->session->userdata('server_select')]['showsysinfo'] == "yes") {
			$data2['server_performance'] = $this->servermodel->get_server_performance($this->session->userdata('server_select'));
			$data2['mysql_stats'] = $this->servermodel->get_mysql_stats();
			$data2['server_perm'] = True;
		}
		else {
			$data2['server_perm'] = False;
		}
		$data2['admin_news'] = $this->adminmodel->get_admin_news();
		$this->load->view('index',$data2);
		$this->load->view('footer');
		$this->load->view('dashboard-footer', $data);
		
	}
}