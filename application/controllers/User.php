<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User extends MY_Controller {
 
	function __construct() {
		parent::__construct();
	}

	function login() {
		$this->load->view('head');
		$this->load->view('user/login');
	}
	
	public function settings() {
		if ($this->session->userdata('loggedin')) {
			$this->usermodel->update_user_active($this->session_data['id'],"user/settings");
			$data['username'] = $this->session_data['username'];
			$data['check_perm'] = $this->check_perm;
			$data['permissions'] = $this->config->item('permissions');
			$data['vacation'] = $this->usermodel->check_vacation_mode($this->session_data['id']);
			$data['ssh_conn'] = $this->config->item('ssh_conn');
			$this->load->view('topnav', $data);
			$this->load->view('sidebar', $data);
			$data['user_settings'] = $this->usermodel->get_user_settings($this->session_data['id']);
			$data['user_loginlog'] = $this->usermodel->get_user_logins($this->session_data['id']);
			$data['grpInfo'] = $this->adminmodel->get_group_data($data['user_settings']->groupid);
			$this->load->view('user/settings', $data);
			$this->load->view('footer');
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	public function verifyedit() {
		if ($this->session->userdata('loggedin')) {
			// Must have current password to make any changes:
			$currpass = $this->input->post('currpass');
			if ($this->usermodel->checkpass($currpass, $this->session_data['id']) == FALSE) {
				$this->form_validation->set_rules('currpass', 'Password', 'callback_check_currpass'); // Hack - we need to use form validation to convey current password mismatch.
			}
			$this->form_validation->set_rules('pemail', 'Email', 'trim|required|valid_email');
			if ($this->form_validation->run() == TRUE && $this->usermodel->checkpass($this->input->post('currpass'), $this->session_data['id']) == TRUE) {
				// See if user filled out new password fields...
				$newpass = $this->input->post('newpass');
				$confirmpass = $this->input->post('confirmpass');
				if (empty($newpass) == FALSE && empty($confirmpass) == FALSE) {
					// Does the new and confirm pass match?
					if ($newpass == $confirmpass) {
						// Change the password
						$this->usermodel->change_password($confirmpass, $this->session_data['id']);
					}
				}
				// Update the rest of the settings
				$chgUser = array(
					'id'		=> $this->session_data['id'],
					'pemail'	=> $this->input->post('pemail'),
					'vacation'	=> $this->input->post('vacation'),
				);
				$this->usermodel->update_user($chgUser);
				$this->usermodel->update_user_active($this->session_data['id'],"user/settings");
				$data['username'] = $this->session_data['username'];
				$data['check_perm'] = $this->check_perm;
				$data['permissions'] = $this->config->item('permissions');
				$data['vacation'] = $this->usermodel->check_vacation_mode($this->session_data['id']);
				$data['ssh_conn'] = $this->config->item('ssh_conn');
				$this->load->view('topnav', $data);
				$this->load->view('sidebar', $data);
				$data['referpage'] = "usersettingschange";
				$this->load->view('formsuccess', $data);
			}
			else {
				$this->usermodel->update_user_active($this->session_data['id'],"user/settings");
				$data['username'] = $this->session_data['username'];
				$data['check_perm'] = $this->check_perm;
				$data['permissions'] = $this->config->item('permissions');
				$data['vacation'] = $this->usermodel->check_vacation_mode($this->session_data['id']);
				$data['ssh_conn'] = $this->config->item('ssh_conn');
				$this->load->view('topnav', $data);
				$this->load->view('sidebar', $data);
				$data['user_settings'] = $this->usermodel->get_user_settings($this->session_data['id']);
				$data['user_loginlog'] = $this->usermodel->get_user_logins($this->session_data['id']);
				$data['grpInfo'] = $this->adminmodel->get_group_data($data['user_settings']->groupid);
				$this->load->view('user/settings', $data);
			}
			$this->load->view('footer');
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	public function logout() {
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
	
	public function check_currpass($pass) {
		// Hack. This will always return false.
		$this->form_validation->set_message('check_currpass', 'Your current password does not match!');
		return FALSE;
	}
}
?>