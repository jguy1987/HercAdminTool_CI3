<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$this->load->model('dashboardmodel');
		$this->load->model('servermodel');
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->model('usermodel');
		$data['perm_list'] = $this->config->item('permissions');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$this->load->view('sidebar', $data);
	}

	public function index() {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($session_data['id'],"dashboard");
		$data['acct_regs'] = $this->dashboardmodel->get_acct_reg_by_date();
		$data2['server_stats'] = $this->servermodel->get_herc_stats();
		$data2['active_admins']	= $this->dashboardmodel->get_active_admins();
		$data2['admin_news'] = $this->dashboardmodel->get_admin_news();
		$this->load->view('index',$data2);
		$this->load->view('footer-nocharts',$data);
	}
}