<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database('admin');
		$this->load->model('adminmodel','',TRUE);
		
	}
	
	public function users() {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			
			$this->load->view('header', $data);
			$this->load->view('sidebar');
			$data['admin_results'] = $this->adminmodel->list_admins();
			$this->load->view('admin/users', $data);
			$this->load->view('footer-nocharts');
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	public function groups() {
		if ($this->session->userdata('loggedin')) {
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
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	public function adduser() {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			
			$this->load->view('header', $data);
			$this->load->view('sidebar');
			$this->load->view('admin/adduser', $data);
			$this->load->view('footer-nocharts');
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	public function edituser($userid) {
		if ($this->session->userdata('loggedin')) {
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
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	public function verifyuser() {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			$this->load->library('form_validation');
			
			$this->load->view('header', $data);
			$this->load->view('sidebar');
			// Validate input on form.
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[25]|xss_clean|is_unique[users.username]');
			$this->form_validation->set_rules('pemail', 'Email', 'trim|required|valid_email');
			if ($this->form_validation->run() == FALSE) {
				$data['userinfo'] = $this->adminmodel->get_user_data($this->input->post('userid'));
				$data['grouplist'] = $this->adminmodel->list_groups();
				$this->load->view('admin/edituser', $data);
			}
			else {
				$data = array(
					'id'			=> $this->input->post('userid'),
					'username' 		=> $this->input->post('username'),
					'pemail'		=> $this->input->post('pemail'),
					'groupid'		=> $this->input->post('group-select'),
					'disablelogin'	=> $this->input->post('active'),
					'genpass'		=> $this->input->post('genpass')
				);
				$this->adminmodel->editadminuser($data);
				$data['referpage'] = "useredit";
				$this->load->view('admin/formsuccess', $data);
				$this->load->view('footer-nocharts');
			}
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	//Below not done
	public function addgroup() {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			
			$this->load->view('header', $data);
			$this->load->view('sidebar');
			$data['permissions'] = $this->list_permissions();
			$this->load->view('admin/addgroup', $data);
			$this->load->view('footer-nocharts');
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	public function editgroup() {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			
			$this->load->view('header', $data);
			$this->load->view('sidebar');
			$this->load->view('admin/editgroup', $data);
			$this->load->view('footer-nocharts');
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	public function verifygroup() {
		if ($this->session->userdata('loggedin')) {
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
				$this->load->view('footer-nocharts');
			}
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	
	// Validation Functions
	public function username_check($username) {
		return True;
	}
	
	public function group_check($grpname) {
		$q = $this->db->get_where('groups', array('name' => $grpname));
		if ($q->num_rows() < 1) {
			return True; // Group name AND ID are free.
		}
		elseif ($q->num_rows() > 0) { // 
			$this->form_validation->set_message('group_check','The group name already exists.');
			return False;
		}
	}
	
	public function groupid_check($groupid) {
		$q = $this->db->get_where('groups', array('id' => $groupid));
		if ($q->num_rows() < 1) {
			return True; // Group name AND ID are free.
		}
		elseif ($q->num_rows() > 0) { // 
			$this->form_validation->set_message('group_check','The group ID already exists.');
			return False;
		}
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