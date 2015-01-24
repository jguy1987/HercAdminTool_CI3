<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User extends MY_Controller {
 
	function __construct() {
		parent::__construct();
	}

	function login() {
		$this->load->helper(array('form'));
		$this->load->view('user/login');
	}
	
	public function settings() {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			$this->load->helper(array('form'));
			$this->load->view('header', $data);
			$this->load->model('usermodel');
			$data['perm_list'] = $this->config->item('permissions');
			$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
			$this->load->view('sidebar', $data);
			$this->usermodel->update_user_active($session_data['id'],"user/settings");
			$this->load->view('user/settings');
			$this->load->view('footer-nocharts');
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	function logout() {
		if ($this->session->userdata('loggedin')) {
			$this->usermodel->update_user_active($session_data['id'],"user/logout");
			$session_data = $this->session->userdata('loggedin');
			$this->session->unset_userdata('loggedin');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('groupid');
			$this->session->sess_destroy();
			$this->load->view('user/logout');

		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
}
?>