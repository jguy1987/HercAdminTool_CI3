<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

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
	}
	
	public function users() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'editadmin') == True) {
			$this->usermodel->update_user_active($this->session_data['id'],"admin/users");
			$data['admin_results'] = $this->adminmodel->list_admins();
			$this->load->view('admin/users', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('admin/footer');
	}
	
	public function groups() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'editgroups') == True) {
			$this->usermodel->update_user_active($this->session_data['id'],"admin/groups");
			$data['group_results'] = $this->adminmodel->list_groups();
			foreach ($data['group_results'] as $group_results) {
				$data['name_results'][$group_results['id']] = $this->adminmodel->list_users_in_group($group_results['id']);
			}
			$this->load->view('admin/groups', $data);	
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('admin/footer');
	}
	
	public function adduser() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'addadmin') == True) {
			$this->usermodel->update_user_active($this->session_data['id'],"admin/adduser");
			$data['grouplist'] = $this->adminmodel->list_groups();
			$this->load->view('admin/adduser', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('admin/footer');
	}
	
	public function edituser($userid) {
		if ($this->adminmodel->check_perm($this->session_data['group'],'editadmin') == True) {
			$data['userinfo'] = $this->adminmodel->get_user_data($userid);
			if ($data['userinfo']->groupid >= $this->session_data['group'] && $data['userinfo']->id != $this->session_data['id']) {
				$data['referpage'] = "groupdeny";
				$this->load->view('accessdenied',$data);
			}
			else {
				$this->usermodel->update_user_active($this->session_data['id'],"admin/edituser");
				$data['grouplist'] = $this->adminmodel->list_groups();
				$data['loginlog_results'] = $this->adminmodel->get_loginlog($userid);
				$this->load->view('admin/edituser', $data);
			}
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
			$this->load->view('footer');
			$this->load->view('admin/footer');
	}
	
	public function verifyuser() { // Verify edit.
		$data['userinfo'] = $this->adminmodel->get_user_data($this->input->post('userid'));
		// Validate input on form.
		if ($data['userinfo']->username != $this->input->post('username')) {
			$userRules = "trim|required|min_length[4]|max_length[25]|is_unique[hat_users.username]";
		}
		else {
			$userRules = "trim|required|min_length[4]|max_length[25]";
		}
		$this->form_validation->set_rules('username', 'Username', $userRules);
		$this->form_validation->set_rules('pemail', 'Email', 'trim|required|valid_email');
		if ($data['userinfo']->id != $this->session_data['id']) {
			$this->form_validation->set_rules('group-select', 'Group', 'callback_check_group');
		}
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
				'genpass'		=> $this->input->post('genpass'),
				'vacation'		=> $this->input->post('vacation'),
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
		$this->load->view('footer');
		$this->load->view('admin/footer');
	}
	
	public function verifyadduser() {
		// Validate input on form.
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[25]|is_unique[hat_users.username]');
		$this->form_validation->set_rules('pemail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('gameacctid', 'Game Account ID', 'trim|min_length[2000000]|is_unique[hat_users.gameacctid]');
		$this->form_validation->set_rules('group-select', 'Group', 'callback_check_group');
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
		$this->load->view('footer');
		$this->load->view('admin/footer');
	}
	
	public function resetusers() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'editadmin') == True) {
			$passwds = $this->adminmodel->resetallpwd();
			foreach($passwds as $email_data) {
				$this->send_admin_email($email_data,"useredit");
			}
			$data['referpage'] = "resetallpw";
			$this->load->view('formsuccess', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('admin/footer');
	}
	
	public function addgroup() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'addgroup') == True) {
			$data['permissions'] = $this->config->item('permissions');
			$this->usermodel->update_user_active($this->session_data['id'],"admin/addgroup");
			$this->load->view('admin/addgroup', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer');
		$this->load->view('admin/footer');
	}
	
	public function editgroup($gid) {
		if ($this->adminmodel->check_perm($this->session_data['group'],'editgroups') == True && $gid < $this->session_data['group']) {
			$data['permissions'] = $this->config->item('permissions');
			$this->usermodel->update_user_active($this->session_data['id'],"admin/editgroup");
			$data['grpInfo'] = $this->adminmodel->get_group_data($gid);
			$this->load->view('admin/editgroup', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer');
		$this->load->view('admin/footer');
	}
	
	public function verifygroupadd() {
		// Validate input on form.
		$this->form_validation->set_rules('grpname', 'Group Name', 'trim|required|min_length[4]|max_length[25]|is_unique[hat_groups.name]');
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
		$this->load->view('footer');
		$this->load->view('admin/footer');
	}
	
	public function verifygroupedit() {
		$data['grpInfo'] = $this->adminmodel->get_group_data($this->input->post('grpid'));
		if ($data['grpInfo']->name != $this->input->post('grpname')) {
			$grpRules = "trim|required|min_length[4]|max_length[25]|is_unique[hat_groups.name]";
		}
		else {
			$grpRules = "trim|required|min_length[4]|max_length[25]";
		}
		$this->form_validation->set_rules('grpname', 'Group Name', $grpRules);
		if ($this->form_validation->run() == FALSE) {
			$data['permissions'] = $this->config->item('permissions');
			$this->load->view('admin/editgroup', $data);
		}
		else {
			$data = array(
				'id'		=> $this->input->post('grpid'),
				'name'	=> $this->input->post('grpname'),
				'perms'	=> $this->input->post('perm')
			);
			$this->adminmodel->editgroup($data);
			$data['referpage'] = "groupedit";
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
		$this->load->view('admin/footer');
	}
	
	public function delgroup($gid) {
		if ($this->adminmodel->check_perm($this->session_data['group'], 'deladmingroup') || $gid < $this->session_data['group']) {
			$result = $this->adminmodel->delete_group($gid);
			if ($result == "groupfull") {
				$data['referpage'] = "groupfull";
				$this->load->view('accessdenied', $data);
			} 
			elseif ($result == "group99") {
				$data['referpage'] = "group99";
				$this->load->view("accessdenied", $data);
			}
			elseif ($result == "ok") {
				$data['referpage'] = "groupdel";
				$this->load->view('formsuccess', $data);
			}
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer');
	}
	
	public function news() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'editadminnews') == True) {
			//$data[
			$data['admin_news'] = $this->adminmodel->get_admin_news();
			$this->load->view('admin/news', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer');
	}
	
	public function addnews() {
		if ($this->input->post('active') == 1) { $active = 1; } else { $active = 0; }
		if ($this->input->post('pinned') == 1) { $pinned = 1; } else { $pinned = 0; }
		$data = array(
			'content'			=> $this->input->post('content'),
			'active' 			=> $active,
			'pinned'			=> $pinned,
			'user'			=> $this->session_data['id']
		);
		if ($this->adminmodel->add_admin_news($data) == 1) {
			$data['referpage'] = "addnews";
			$this->load->view('formsuccess', $data);
		}
		else {
			$this->load->view('accessdenied');
		}
	}
	
	public function editnews() {
		if ($this->input->post('active') == 1) { $active = 1; } else { $active = 0; }
		if ($this->input->post('pinned') == 1) { $pinned = 1; } else { $pinned = 0; }
		$data = array(
			'id'					=> $this->input->post('newsid'),
			'content'			=> $this->input->post('content'),
			'active' 			=> $active,
			'pinned'			=> $pinned,
		);
		if ($this->adminmodel->edit_admin_news($data) == 1) {
			$data['referpage'] = "editnews";
			$this->load->view('formsuccess', $data);
		}
		else {
			$this->load->view('accessdenied');
		}
	}
	
	public function deletenews($id) {
		if ($this->adminmodel->delete_admin_news($id) == 1) {
			$data['referpage'] = "deletenews";
			$data['id'] = $id;
			$this->load->view('formsuccess', $data);
		}
		else {
			$this->load->view('accessdenied');
		}
	}
		
	
	function lockusers() {		
		if ($this->adminmodel->check_perm($this->session_data['group'],'editadmin') == True) {
			$this->adminmodel->users_login_status($this->session_data['id'], 'lock');
			$data['referpage'] = "lockusers";
			$this->load->view('formsuccess', $data);
			$this->load->view('footer');
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');		
	}
		
	function unlockusers() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'editadmin') == True) {
			$this->adminmodel->users_login_status($this->session_data['id'], 'unlock');
			$data['referpage'] = "unlockusers";
			$this->load->view('formsuccess', $data);
			$this->load->view('footer');
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');		
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
	
	function check_group($gid) {
		if ($gid >= $this->session_data['group']) {
			$this->form_validation->set_message('check_group', 'You may not create or edit an admin to have a higher group than your own!');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
}