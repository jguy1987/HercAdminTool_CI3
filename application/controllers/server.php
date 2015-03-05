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
			$data['herc_stats'] = $this->servermodel->get_herc_stats();
			$data['mysql_stats'] = $this->servermodel->get_mysql_stats();
			$this->load->view('server/stats.php', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer-nocharts.php');
	}
}