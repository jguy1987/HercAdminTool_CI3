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
		$data['perm_list'] = $this->config->item('permissions');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$this->load->view('sidebar', $data);
	}
	
	function listchars() {
	
	}
	
	function whosonline() {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($session_data['id'],"character/whosonline");
		$data['online_list'] = $this->charmodel->list_online();
		$data['class_list'] = $this->config->item('jobs');
		$this->load->view('character/online',$data);
		$this->load->view('footer-nocharts');
	}
}