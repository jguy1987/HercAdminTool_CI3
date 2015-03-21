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
	
	function search() {
		$this->usermodel->update_user_active($this->session_data['id'],"guild/search");
		$guildSearch = array(
			'guild_id'		=> $this->input->post('guild_id'),
			'guild_name'	=> $this->input->post('guild_name'),
			'leader_name'	=> $this->input->post('leader_name'),
			'gtLevel'		=> $this->input->post('gtLevel'),
			'ltLevel'		=> $this->input->post('ltLevel'),
		);
		$data['guild_list'] = $this->guildmodel->list_search($guildSearch);
		$this->load->view('guild/list', $data);
		$this->load->view('footer-nocharts');
	}
	
	function details($gid) {
		$this->usermodel->update_user_active($this->session_data['id'],"guild/details");
		$data = array();
		$data += $this->load_guild_data($gid);
		$this->load->view('guild/details', $data);
		$this->load->view('footer-nocharts');
	}
	
	
	function load_guild_data($gid) {
		$data['guildinfo'] = $this->guildmodel->get_details($gid);
		//$data['guildMembers'] = $this->guildmodel->get_guild_members($gid);
		//$data['guildPositions'] = $this->guildmodel->get_guild_position($gid);
		//$data['guildCastles'] = $this->guildmodel->get_guild_castles($gid);
		//$data['guildStorage'] = $this->guildmodel->get_guild_storage($gid);
		//$data['guildAliiance'] = $this->guildmodel->get_guild_alliances($gid);
		return $data;
	}
}