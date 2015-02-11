<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$this->load->model('servermodel');
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->model('usermodel');
		$data['perm_list'] = $this->config->item('permissions');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$this->load->view('sidebar', $data);
		$this->load->library('form_validation');
	}
	
	public function stats() {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($session_data['id'],"server/stats");
		$xml_url = base_url('assets/linfo/?out=xml');
		$data['server_stats'] = $this->servermodel->get_server_stats($xml_url);
		$data['herc_stats'] = $this->servermodel->get_herc_stats();
		$data['mysql_stats'] = $this->servermodel->get_mysql_stats();
		print_r($data['server_stats']);
		$this->load->view('server/stats.php', $data);
		$this->load->view('footer-nocharts.php');
	}
}