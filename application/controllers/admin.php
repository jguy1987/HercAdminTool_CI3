<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$this->load->model('adminmodel');
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->model('usermodel');
		$data['perm_list'] = $this->config->item('permissions');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$this->load->view('sidebar', $data);
		$this->load->library('form_validation');
	}
	
	public function users() {
		$session_data = $this->session->userdata('loggedin');
		
		if ($this->adminmodel->check_perm($session_data['group'],'editadmin') == True) {
			$this->usermodel->update_user_module($session_data['id'],"admin/users");
			$data['admin_results'] = $this->adminmodel->list_admins();
			$this->load->view('admin/users', $data);
			$this->load->view('footer-nocharts');
		}
		else {
			$this->load->view('accessdenied');
		}
		$this->load->view('footer-nocharts');
	}
	
	public function groups() {
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'editgroups') == True) {
			$this->usermodel->update_user_module($session_data['id'],"admin/groups");
			$data['group_results'] = $this->adminmodel->list_groups();
			foreach ($data['group_results'] as $group_results) {
				$data['name_results'][$group_results['id']] = $this->adminmodel->list_users_in_group($group_results['id']);
			}
			$this->load->view('admin/groups', $data);	
		}
		else {
			$this->load->view('accessdenied');
		}
		$this->load->view('footer-nocharts');
	}
	
	public function adduser() {
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'addadmin') == True) {
			$this->usermodel->update_user_module($session_data['id'],"admin/adduser");
			$data['grouplist'] = $this->adminmodel->list_groups();
			$this->load->view('admin/adduser', $data);
		}
		else {
			$this->load->view('accessdenied');
		}
		$this->load->view('footer-nocharts');
	}
	
	public function edituser($userid) {
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'editadmin') == True) {
			$data['userinfo'] = $this->adminmodel->get_user_data($userid);
			if ($data['userinfo']->groupid >= $session_data['group']) {
				$data['referpage'] = "groupdeny";
				$this->load->view('accessdenied',$data);
			}
			$this->usermodel->update_user_module($session_data['id'],"admin/edituser");
			$data['grouplist'] = $this->adminmodel->list_groups();
			$this->load->view('admin/edituser', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
			$this->load->view('footer-nocharts');
	}
	
	public function verifyuser() {
		$data['userinfo'] = $this->adminmodel->get_user_data($this->input->post('userid'));
		// Validate input on form.
		if ($data['userinfo']->username != $this->input->post('username')) {
			$userRules = "trim|required|min_length[4]|max_length[25]|xss_clean|is_unique[hat_users.username]";
		}
		else {
			$userRules = "trim|required|min_length[4]|max_length[25]|xss_clean";
		}
		$this->form_validation->set_rules('username', 'Username', $userRules);
		$this->form_validation->set_rules('pemail', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$data['grouplist'] = $this->adminmodel->list_groups();
			$this->load->view('admin/edituser', $data);
		}
		else {
			$data = array(
				'id'			=> $this->input->post('userid'),
				'username'	=> $this->input->post('username'),
				'pemail'		=> $this->input->post('pemail'),
				'gameacctid'	=> $this->input->post('gameacctid'),
				'groupid'		=> $this->input->post('group-select'),
				'disablelogin'	=> $this->input->post('active'),
				'genpass'		=> $this->input->post('genpass')
			);
			$newPass = $this->adminmodel->editadminuser($data);
			if (isset($newPass)) {
				$email_data = array(
					'passwd' => $newPass,
					'username'	=> $this->input->post('username'),
					'pemail' => $this->input->post('pemail'),
					'type'	=> "useredit"
				);
				$this->send_admin_email($email_data,"useredit");
			}
			$data['referpage'] = "useredit";
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function verifyadduser() {
		// Validate input on form.
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[25]|xss_clean|is_unique[hat_users.username]');
		$this->form_validation->set_rules('pemail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('gameacctid', 'Game Account ID', 'trim|min_length[2000000]|xss_clean|is_unique[hat_users.gameacctid]');
		if ($this->form_validation->run() == FALSE) {
			$data['grouplist'] = $this->adminmodel->list_groups();
			$this->load->view('admin/adduser', $data);
		}
		else {
			$data = array(
				'username' 		=> $this->input->post('username'),
				'pemail'		=> $this->input->post('pemail'),
				'groupid'		=> $this->input->post('group-select'),
				'gameacctid'	=> $this->input->post('gameacctid')
			);
			$newPass = $this->adminmodel->addadminuser($data);
			$email_data = array(
				'passwd' => $newPass,
				'username'	=> $this->input->post('username'),
				'pemail' => $this->input->post('pemail'),
				'type'	=> "useradd"
			);
			$this->send_admin_email($email_data,"useradd");
			$data['referpage'] = "useradd";
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function resetusers() {
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'editadmin') == True) {
			$passwds = $this->adminmodel->resetallpwd();
			foreach($passwds as $email_data) {
				$this->send_admin_email($email_data,"useredit");
			}
			$data['referpage'] = "resetallpw";
			$this->load->view('formsuccess', $data);
		}
		else {
			$this->load->view('accessdenied');
		}
		$this->load->view('footer-nocharts');
	}
	
	public function addgroup() {
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'editgroups') == True) {
			$data['permissions'] = $this->config->item('permissions');
			$this->usermodel->update_user_module($session_data['id'],"admin/addgroup");
			$this->load->view('admin/addgroup', $data);
		}
		else {
			$this->load->view('accessdenied');
		}
		$this->load->view('footer-nocharts');
	}
	
	public function editgroup() {
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'editgroups') == True) {
			$data['permissions'] = $this->config->item('permissions');
			$this->usermodel->update_user_module($session_data['id'],"admin/editgroup");
			$this->load->view('admin/editgroup', $data);
			$this->load->view('footer-nocharts');
		}
		else {
			$this->load->view('accessdenied');
		}
		$this->load->view('footer-nocharts');
	}
	
	public function verifygroupadd() {
		// Validate input on form.
		$this->form_validation->set_rules('grpname', 'Group Name', 'trim|required|min_length[4]|max_length[25]|xss_clean|is_unique[hat_groups.name]');
		$this->form_validation->set_rules('groupid', 'Group ID', 'trim|required|greater_than[0]|less_than[100]|numeric|is_unique[hat_groups.id]');
		if ($this->form_validation->run() == FALSE) {
			$data['permissions'] = $this->config->item('permissions');
			$this->load->view('admin/addgroup', $data);
		}
		else {
			$data = array(
				'id'			=> $this->input->post('groupid'),
				'name' 			=> $this->input->post('grpname'),
				'perms'			=> $this->input->post('perm')
			);
			$this->adminmodel->addgroup($data);
			$data['referpage'] = "groupadd";
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	function lockusers() {		
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'editadmin') == True) {
			$this->adminmodel->users_login_status($session_data['id'], 'lock');
			$data['referpage'] = "lockusers";
			$this->load->view('formsuccess', $data);
			$this->load->view('footer-nocharts');
		}
		else {
			$this->load->view('accessdenied');
		}
		$this->load->view('footer-nocharts');		
	}
		
	function unlockusers() {
		$session_data = $this->session->userdata('loggedin');
		if ($this->adminmodel->check_perm($session_data['group'],'editadmin') == True) {
			$this->adminmodel->users_login_status($session_data['id'], 'unlock');
			$data['referpage'] = "unlockusers";
			$this->load->view('formsuccess', $data);
			$this->load->view('footer-nocharts');
		}
		else {
			$this->load->view('accessdenied');
		}
		$this->load->view('footer-nocharts');		
	}
	
	function send_admin_email($email_data,$type) {
		$this->email->from($this->config->item('emailfrom'), $this->config->item('panelname'));
		$this->email->to($email_data['pemail']); 
		if ($type == "useredit") {
			$this->email->subject('Your admin account has been updated.');
			$this->email->message("Hello {$email_data['username']},
Your administration password for {$this->config->item('panelname')} has been updated. Your new password is {$email_data['passwd']}. Effective immediately you will use this new password to login.

Thank you.");
		}
		elseif ($type == "useradd") {
			$this->email->subject('Your admin account has been created.');
			$this->email->message("Hello {$email_data['username']},
Your administration account has been created for the admin panel on {$this->config->item('servername')}. You will use the following information to login:
			
URL: {$this->config->item('base_url')}
Username: {$email_data['username']}
Password: {$email_data['passwd']}
			
Thank you.");
		}
		$this->email->send();
		return $this->email->print_debugger();
	}
}