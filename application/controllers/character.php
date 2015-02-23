<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Character extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$this->load->model('charmodel');	
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
	
	function listchars() {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($session_data['id'],"character/listchars");
		$data['char_list'] = $this->charmodel->get_char_list();
		$data['class_list'] = $this->config->item('jobs');
		$this->load->view('character/list', $data);
		$this->load->view('footer-nocharts');
	}
	
	function whosonline() {
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'whosonline') == True) {
			$this->usermodel->update_user_active($session_data['id'],"character/whosonline");
			$data['online_list'] = $this->charmodel->list_online();
			$data['class_list'] = $this->config->item('jobs');
			$this->load->view('character/online',$data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	function details($cid) {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($session_data['id'],"character/details");
		$data['charinfo'] = $this->charmodel->get_char_info($cid);
		$data['char_items'] = $this->charmodel->get_char_items($cid);
		$data['char_cartItems'] = $this->charmodel->get_cart_items($cid);
		$data['charlog_data'] = $this->charmodel->get_charlog($cid);
		$data['char_edit_hist'] = $this->charmodel->get_char_hist($cid);
		$data['class_list'] = $this->config->item('jobs');
		$data['perm_list'] = $this->config->item('permissions');
		$data['equipLocation'] = $this->config->item('equipLocations');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$this->load->view('character/details', $data);
		$this->load->view('footer-nocharts');
	}
	
	function verifyedit() {
		$session_data = $this->session->userdata('loggedin');
		$max_blevel = $this->config->item('max_base_level') + 1;
		$max_jlevel = $this->config->item('max_job_level') + 1;
		$data['charinfo'] = $this->charmodel->get_char_info($this->input->post('charid'));
		if ($data['charinfo']->name != $this->input->post('char_name')) {
			$check_charname = "trim|required|min_length[4]|max_length[25]|xss_clean|is_unique[char.name]";
		}
		else {
			$check_charname = "trim|required|min_length[4]|max_length[25]|xss_clean";
		}
		$this->form_validation->set_rules('char_name', "Character Name", $check_charname);
		$this->form_validation->set_rules('char_num', "Character Slot", 'trim|required|greater_than[-1]|less_than[9]');
		$this->form_validation->set_rules('zeny', "Zeny", 'trim|required|greater_than[0]|less_than[2100000000]');
		$this->form_validation->set_rules('base_level', "Base Level", 'trim|required|greater_than[0]|less_than[{$max_blevel}]');
		$this->form_validation->set_rules('job_level', "Job Level", 'trim|required|greater_than[0]|less_than[{$max_jlevel}]');
		$this->form_validation->set_rules('base_exp', "Base Experience", 'trim|required|integer');
		$this->form_validation->set_rules('job_exp', "Job Experience", 'trim|required|integer');
		$this->form_validation->set_rules('status_point', "Status Point", 'trim|required|integer');
		$this->form_validation->set_rules('skill_point', "Skill Point", 'trim|required|integer');
		$this->form_validation->set_rules('str', "STR", 'trim|required|integer');
		$this->form_validation->set_rules('int', "INT", 'trim|required|integer');
		$this->form_validation->set_rules('agi', "AGI", 'trim|required|integer');
		$this->form_validation->set_rules('vit', "VIT", 'trim|required|integer');
		$this->form_validation->set_rules('dex', "DEX", 'trim|required|integer');
		$this->form_validation->set_rules('luk', "LUK", 'trim|required|integer');
		$this->form_validation->set_rules('manner', "Manner", 'trim|required|integer');
		$this->form_validation->set_rules('karma', "Karma", 'trim|required|integer');
		$this->form_validation->set_rules('hair', "Hair Style ID", 'trim|required|integer');
		$this->form_validation->set_rules('hair_color', "Hair Color ID", 'trim|required|integer');
		$this->form_validation->set_rules('clothes_color', "Clothes Color ID", 'trim|required|integer');
		if ($this->form_validation->run() == FALSE) {
			$this->usermodel->update_user_active($session_data['id'],"character/details");
			$data['char_items'] = $this->charmodel->get_char_items($cid);
			$data['char_cartItems'] = $this->charmodel->get_cart_items($cid);
			$data['charlog_data'] = $this->charmodel->get_charlog($cid);
			$data['class_list'] = $this->config->item('jobs');
			$data['perm_list'] = $this->config->item('permissions');
			$data['equipLocation'] = $this->config->item('equipLocations');
			$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
			$this->load->view('character/details', $data);
		}
		else {
			$chgChar = array(
				'user'				=> $session_data['id'],
				'charid'				=> $this->input->post('charid'),
				'name'				=> $this->input->post('char_name'),
				'char_num'			=> $this->input->post('char_num'),
				'zeny'				=> $this->input->post('zeny'),
				'base_level'		=> $this->input->post('base_level'),
				'job_level'			=> $this->input->post('job_level'),
				'base_exp'			=> $this->input->post('base_exp'),
				'job_exp'			=> $this->input->post('job_exp'),
				'status_point'		=> $this->input->post('status_point'),
				'skill_point'		=> $this->input->post('skill_point'),
				'str'					=> $this->input->post('str'),
				'INT'					=> $this->input->post('int'),
				'agi'					=> $this->input->post('agi'),
				'vit'					=> $this->input->post('vit'),
				'dex'					=> $this->input->post('dex'),
				'luk'					=> $this->input->post('luk'),
				'manner'				=> $this->input->post('manner'),
				'karma'				=> $this->input->post('karma'),
				'hair'				=> $this->input->post('hair'),
				'hair_color'		=> $this->input->post('hair_color'),
				'clothes_color'	=> $this->input->post('clothes_color'),
			);
			$this->charmodel->edit_char_details($chgChar);
			$data['referpage'] = "editchar";
			$data['char_id'] = $chgChar['charid'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	function search() {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($session_data['id'],"characters/search");
		$searchTerms = array(
			'charid'		=> $this->input->post('char_id'),
			'char_name'	=> $this->input->post('char_name'),
			'class'		=> $this->input->post('class'),
			'gender'		=> $this->input->post('gender'),
			'bLevelgt'	=> $this->input->post('gtbLevel'),
			'bLevellt'	=> $this->input->post('ltbLevel'),
			'jLevelgt'	=> $this->input->post('gtjLevel'),
			'jLevellt'	=> $this->input->post('ltjLevel'),
		);
		$data['search_results'] = $this->charmodel->search_chars($searchTerms);
		$data['class_list'] = $this->config->item('jobs');
		$this->load->view('character/search', $data);
		$this->load->view('footer-nocharts');
	}
	
	function resetpos($cid) {
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'changeposition') == True) {
			$this->usermodel->update_user_active($session_data['id'],"character/resetpos");
			$this->charmodel->reset_char_pos($cid, $session_data['id']);
			$data['referpage'] = "resetpos";
			$data['char_id'] = $cid;
			$this->load->view('formsuccess', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer-nocharts');
	}
}