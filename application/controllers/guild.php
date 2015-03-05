<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guild extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}	
		$data['username'] = $this->session_data['username'];
		
		$this->load->view('header', $data);
		$data['check_perm'] = $this->check_perm;
		$this->load->view('sidebar', $data);
		$this->load->library('form_validation');
	}
	
	function listguilds() {
		$data['guild_list'] = $this->guildmodel->list_guilds();
		$this->load->view('guild/list', $data);
		$this->load->view('footer-nocharts');
	}
}