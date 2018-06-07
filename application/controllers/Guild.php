<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guild extends MY_Controller {

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
		$this->load->library('form_validation');
	}
	
	function listguilds() {
		$data['guild_list'] = $this->guildmodel->list_guilds();
		$this->load->view('guild/list', $data);
		$this->load->view('footer');
		$this->load->view('guild/footer');
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
		$this->load->view('datatables-scripts');
		$this->load->view('footer');
	}
	
	function details($gid) {
		if ($this->adminmodel->check_perm($this->session_data['group'],'viewguilds') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'],"guild/details");
			$data = array();
			$data['class_list'] = $this->config->item('jobs');
			$data += $this->load_guild_data($gid);
			$this->load->view('guild/details', $data);
			$this->load->view('footer');
			$this->load->view('guild/footer');
		}
	}
	
	function leaderassign() {
		$newLeaderInfo = array(
			'guild_id'			=> $this->input->post('guild_id'),
			'new_leader_name'	=> $this->input->post('new_leader_name'),
			'old_leader_id'	=> $this->input->post('old_leader_id'),
			'new_leader_id'	=> $this->input->post('new_leader_id'),
		);
		if ($this->servermodel->server_online_check($this->session->userdata('server_select')) == 0) {
			$this->guildmodel->assign_leader($newLeaderInfo);
			$data['referpage'] = "assignleader";
			$data['guild_id'] = $newLeaderInfo['guild_id'];
			$this->load->view('formsuccess', $data);
		}
		else {
			$data['referpage'] = "serveronline-leaderassign";
			$this->load->view('accessdenied', $data);
		}
	}
	
	function load_guild_data($gid) {
		$data['guildinfo'] = $this->guildmodel->get_details($gid);
		$data['guildMembers'] = $this->guildmodel->get_guild_members($gid);
		$data['guildPositions'] = $this->guildmodel->get_guild_position($gid);
		//$data['guildCastles'] = $this->guildmodel->get_guild_castles($gid);
		//$data['guildStorage'] = $this->guildmodel->get_guild_storage($gid);
		//$data['guildAliiance'] = $this->guildmodel->get_guild_alliances($gid);
		return $data;
	}
	
	
}