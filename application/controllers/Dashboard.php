<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

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

	public function index() {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($this->session_data['id'],"dashboard");
		$data['acct_regs'] = $this->dashboardmodel->get_acct_reg_by_date();
		$data2['herc_stats'] = $this->servermodel->get_herc_stats(0);
		$data2['active_admins']	= $this->dashboardmodel->get_active_admins();
		if ($this->adminmodel->check_perm($this->session_data['group'],'serverstats') == True) {
			$json_url = base_url('assets/linfo/?out=json');
			$data2['server_stats'] = $this->servermodel->get_server_stats($json_url);
			$data2['mysql_stats'] = $this->servermodel->get_mysql_stats();
			$data2['server_perm'] = True;
		}
		else {
			$data2['server_perm'] = False;
		}
		$data2['admin_news'] = $this->dashboardmodel->get_admin_news();
		$this->load->view('index',$data2);
		$this->load->view('dashboard-scripts', $data);
		$this->load->view('datatables-scripts');
		$this->load->view('footer',$data);
	}
}