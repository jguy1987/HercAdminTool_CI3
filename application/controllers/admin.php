<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database('admintool');
		$this->load->model('adminmodel');
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
	}
	
	public function users() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$data['admin_results'] = $this->adminmodel->list_admins();
		$this->load->view('admin/users', $data);
		$this->load->view('footer-nocharts');
	}
	
	public function groups() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$data['group_results'] = $this->adminmodel->list_groups();
		foreach ($data['group_results'] as $group_results) {
			$data['name_results'][$group_results['id']] = $this->adminmodel->list_users_in_group($group_results['id']);
		}
		$this->load->view('admin/groups', $data);
		$this->load->view('footer-nocharts');
	}
	
	public function adduser() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		$this->load->library('form_validation');
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$data['grouplist'] = $this->adminmodel->list_groups();
		$this->load->view('admin/adduser', $data);
		$this->load->view('footer-nocharts');
	}
	
	public function edituser($userid) {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		$this->load->library('form_validation');
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$data['userinfo'] = $this->adminmodel->get_user_data($userid);
		$data['grouplist'] = $this->adminmodel->list_groups();
		$this->load->view('admin/edituser', $data);
		$this->load->view('footer-nocharts');
	}
	
	public function verifyuser() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		$this->load->library('form_validation');
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$data['userinfo'] = $this->adminmodel->get_user_data($this->input->post('userid'));
		// Validate input on form.
		if ($data['userinfo']->username != $this->input->post('username')) {
			$userRules = "trim|required|min_length[4]|max_length[25]|xss_clean|is_unique[users.username]";
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
				$this->send_admin_email($email_data);
			}
			$data['referpage'] = "useredit";
			$this->load->view('admin/formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function verifyadduser() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		$this->load->library('form_validation');
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		// Validate input on form.
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[25]|xss_clean|is_unique[users.username]');
		$this->form_validation->set_rules('pemail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('gameacctid', 'Game Account ID', 'trim|min_length[2000000]|xss_clean|is_unique[users.gameacctid]');
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
			$this->send_admin_email($email_data);
			$data['referpage'] = "useradd";
			$this->load->view('admin/formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function addgroup() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		$this->load->library('form_validation');
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$data['permissions'] = $this->list_permissions();
		$this->load->view('admin/addgroup', $data);
		$this->load->view('footer-nocharts');
	}
	
	public function editgroup() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$this->load->view('admin/editgroup', $data);
		$this->load->view('footer-nocharts');
	}
	
	public function verifygroup() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		$this->load->library('form_validation');
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		// Validate input on form.
		$this->form_validation->set_rules('grpname', 'Group Name', 'trim|required|min_length[4]|max_length[25]|xss_clean|callback_group_check');
		$this->form_validation->set_rules('groupid', 'Group ID', 'trim|required|callback_groupid_check|greater_than[98]|less_than[2]|numeric');
		if ($this->form_validation->run() == FALSE) {
			$data['permissions'] = $this->list_permissions();
			$this->load->view('admin/addgroup', $data);
		}
		else {
			$data = array(
				'id'			=> $this->input->post('groupid'),
				'name' 			=> $this->input->post('grpname'),
				'perms'			=> $this->input->post('perms')
			);
			$this->adminmodel->addgroup($data);
			$data['referpage'] = "groupadd";
			$this->load->view('admin/formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	function lockusers() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		$this->load->library('form_validation');
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		
		$this->adminmodel->users_login_status($session_data['id'], 'lock');
		$data['referpage'] = "lockusers";
		$this->load->view('admin/formsuccess', $data);
		$this->load->view('footer-nocharts');
	}
		
	function unlockusers() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		$this->load->library('form_validation');
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		
		$this->adminmodel->users_login_status($session_data['id'], 'unlock');
		$data['referpage'] = "unlockusers";
		$this->load->view('admin/formsuccess', $data);
		$this->load->view('footer-nocharts');
	}
	
	function group_check($grpname) {
		$q = $this->db->get_where('groups', array('name' => $grpname));
		if ($q->num_rows() < 1) {
			return True; // Group name AND ID are free.
		}
		elseif ($q->num_rows() > 0) { // 
			$this->form_validation->set_message('group_check','The group name already exists.');
			return False;
		}
	}
	
	function groupid_check($groupid) {
		$q = $this->db->get_where('groups', array('id' => $groupid));
		if ($q->num_rows() < 1) {
			return True; // Group name AND ID are free.
		}
		elseif ($q->num_rows() > 0) { // 
			$this->form_validation->set_message('group_check','The group ID already exists.');
			return False;
		}
	}
	
	function send_admin_email($email_data) {
		$this->email->from($this->config->item('emailfrom'), $this->config->item('panelname'));
		$this->email->to($email_data['pemail']); 
		if ($email_data['type'] == "useredit") {
			$this->email->subject('Your admin account has been updated.');
			$this->email->message("Hello {$email_data['username']},
Your administration password for {$this->config->item('panelname')} has been updated. Your new password is {$email_data['passwd']}. Effective immediately you will use this new password to login.

Thank you.");
		}
		elseif ($email_data['type'] == "useradd") {
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
	
	public function list_permissions() {
		$permissions['viewemail'] 		= "View Email Address";
		$permissions['editaccemail'] 	= "Edit Account Email Address";
		$permissions['resetacctpass'] 	= "Reset Account Password";
		$permissions['editgender'] 		= "Edit Account Gender";
		$permissions['addaccount']		= "Add Game Account";
		$permissions['usepurge']			= "Purge Inactive Accounts";
		$permissions['banaccount']		= "Ban Account";
		$permissions['unbanaccount']		= "Unban Account";
		$permissions['edittrust']		= "Edit Account Trust";
		$permissions['editcharzeny']		= "Edit Character Zeny";
		$permissions['editcharlv']		= "Edit Character Levels";
		$permissions['editcharstats']	= "Edit Character Stats";
		$permissions['editcharjob']		= "Change Character Job";
		$permissions['delcharitem']		= "Delete Any Character Item";
		$permissions['senditem']			= "Send Item via Mail";
		$permissions['kickchar']			= "Kick Character from Server";
		$permissions['delcharacter']		= "Delete Individual Character";
		$permissions['restoredelchar']	= "Restore Deleted Character";
		$permissions['changeposition']	= "Reset Character Position";
		$permissions['editgrouplist']	= "Edit Admin Groups";
		$permissions['addadmin']			= "Add Admin";
		$permissions['editadmin']		= "Edit Admin";
		$permissions['deladmin']			= "Remove Admin";
		$permissions['viewtickets']		= "View Tickets";
		$permissions['editcategory']		= "Manage Ticket Categories";
		$permissions['editpredef']		= "Manage Community Pre-defined Replies";
		$permissions['levellock']		= "Level Lock Tickets";
		$permissions['assigngm']			= "Assign GM to Ticket";
		$permissions['assigngm+']		= "Assign Higher GM to Ticket";
		$permissions['canreopen']		= "Reopen Tickets";
		$permissions['announcement']		= "Manage System Broadcasts";
		$permissions['items']			= "Manage server items";
		$permissions['itemshop']			= "Manage Item Shop";
		$permissions['mobs']				= "Manage server mobs";
		$permissions['servermaint']		= "Start/Stop/Restart server";
		$permissions['backupdb']			= "Backup Database";
		$permissions['atcmdlog']			= "View @command logs";
		$permissions['branchlog']		= "View Branch logs";
		$permissions['chatlog']			= "View Chat Logs";
		$permissions['loginlog']			= "View Login Logs";
		$permissions['mvplog']			= "View MVP Logs";
		$permissions['npclog']			= "View NPC Logs";
		$permissions['picklog']			= "View Item Pick Logs";
		$permissions['zenylog']			= "View Zeny Transaction Logs";
		$permissions['sftp']				= "Server SFTP Access";
		$permissions['serverconfig']		= "Server Configuration Access (View/Edit)";
		$permissions['hatconfig']		= "AdminTool Configuration Access";
		return $permissions;
	}
}