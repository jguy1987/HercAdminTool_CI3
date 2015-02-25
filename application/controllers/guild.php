<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guild extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$this->load->model('guildmodel');	
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->model('usermodel');
		$this->load->model('adminmodel');
		$data['perm_list'] = $this->config->item('permissions');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$this->load->view('sidebar', $data);
		$this->load->library('form_validation');
	}
	
	function listguilds() {
		$data['guild_list'] = $this->guildmodel->list_guilds();
		$this->load->view('guild/list', $data);
		$this->load->view('footer-nocharts');
	}
}