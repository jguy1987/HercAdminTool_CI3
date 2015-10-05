<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User extends MY_Controller {
 
	function __construct() {
		parent::__construct();
	}

	function login() {
		$this->load->view('user/login');
	}
	
	public function settings() {
		if ($this->session->userdata('loggedin')) {
			$this->usermodel->update_user_active($this->session_data['id'],"user/settings");
			$data['username'] = $this->session_data['username'];
			$data['check_perm'] = $this->check_perm;
			$this->load->view('header', $data);
			$this->load->view('sidebar', $data);
			$data['user_settings'] = $this->usermodel->get_user_settings($this->session_data['id']);
			$data['user_loginlog'] = $this->usermodel->get_user_logins($this->session_data['id']);
			$data['user_permissions'] = $this->usermodel->get_user_permissions($data['user_settings']->groupid);
			$this->load->view('user/settings', $data);
			$this->load->view('datatables-scripts');
			$this->load->view('footer');
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	function logout() {
		if ($this->session->userdata('loggedin')) {
			$this->usermodel->update_user_active($this->session_data['id'],"user/logout");
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