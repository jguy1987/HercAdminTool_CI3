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
		$data['class_list'] = $this->config->item('jobs');
		$data['perm_list'] = $this->config->item('permissions');
		$data['equipLocation'] = $this->config->item('equipLocations');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$this->load->view('character/details', $data);
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
}