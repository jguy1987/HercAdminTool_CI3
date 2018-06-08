<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bugtracker extends MY_Controller {

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


	public function buglist() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'viewbugs') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'],"bugtracker/list");
			$data = $this->load_bug_data();
			$data['buglist'] = $this->bugmodel->list_bugs();
			$this->load->view('bugtracker/buglist', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('bugtracker/footer');
	}
	
	public function newbug() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'openbugs') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'],"bugtracker/new");
			$data = $this->load_bug_data();
			$this->load->view('bugtracker/newbug', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('bugtracker/footer');
	}
	
	public function newbug_process() {
		$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('priority', 'Priority', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('version', 'Version', 'required');
		$this->form_validation->set_rules('server', 'Server', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data += $this->load_bug_data();
			$this->load->view('bugtracker/newbug', $data);
		}
		else {
			$newBug = array(
				'title' 	=> $this->input->post('title'),
				'priority'	=> $this->input->post('priority'),
				'starter'	=> $this->session_data['id'],
				'category'	=> $this->input->post('category'),
				'version'	=> $this->input->post('version'),
				'private'	=> $this->input->post('private'),
				'status'	=> '1',
				'comment'	=> nl2br($this->input->post('comment')),
				'reproduce'	=> nl2br($this->input->post('reproduce')),
				'server'	=> $this->input->post('server'),
			);
			$this->bugmodel->newbug_add($newBug);
			$data['referpage'] = "newbug";
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
		$this->load->view('bugtracker/footer');
	}
	
	public function details($bid) {
		if ($this->adminmodel->check_perm($this->session_data['group'],'viewbugs') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'],"bugtracker/details");
			$data['bug_details'] = $this->bugmodel->get_bug_details($bid);
			$data['bug_history'] = $this->bugmodel->get_bug_history($bid);
			$data['bug_comments'] = $this->bugmodel->get_bug_comments($bid);
			$data += $this->load_bug_data();
			// Need to sort this to display properly.
			$data['bug_hist_comments'] = $this->bugmodel->sort_hist_comments($data['bug_history'], $data['bug_comments']);
			$this->load->view('bugtracker/details', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('bugtracker/footer');
	}
	
	public function verifyedit() {
		$this->form_validation->set_rules('subject', "Bug Title", 'trim|required');
		if ($this->input->post('status') == 19) {
			$this->form_validation->set_rules('resolution', 'Resolution', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->details($this->input->post('bug_id'));
		}
		else {
			if ($this->input->post('resolution') == 0 || $this->input->post('resolution') == "-") {
				$resolution = 0;
			}
			else {
				$resolution = $this->input->post('resolution');
			}
			if ($this->input->post('assigned') == 0 || $this->input->post('assigned') == " ") {
				$assigned = NULL;
			}
			else {
				$assigned = $this->input->post('assigned');
			}
			$chgBug = array(
				'userid'		=> $this->session_data['id'],
				'bug_id'		=> $this->input->post('bug_id'),
				'title'			=> $this->input->post('subject'),
				'status'		=> $this->input->post('status'),
				'resolution'	=> $resolution,
				'priority'		=> $this->input->post('priority'),
				'assigned'		=> $assigned,
				'category'		=> $this->input->post('category'),
			);
			$this->bugmodel->edit_bug($chgBug);
			$data['bug_id'] = $this->input->post('bug_id');
			$data['referpage'] = "editbug";
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
		$this->load->view('bugtracker/footer');
	}
	
	public function addcomment() {
		$this->form_validation->set_rules('comment', 'Comment', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['bug_details'] = $this->bugmodel->get_bug_details($bid);
			$data['bug_history'] = $this->bugmodel->get_bug_history($bid);
			$data['bug_comments'] = $this->bugmodel->get_bug_comments($bid);
			$data += $this->load_bug_data();
			// Need to sort this to display properly.
			$data['bug_hist_comments'] = $this->bugmodel->sort_hist_comments($data['bug_history'], $data['bug_comments']);
			$this->load->view('bugtracker/details', $data);
		}
		else {
			$newComment = array(
				'bug_id'	=> $this->input->post('bug_id'),
				'comment'	=> nl2br($this->input->post('comment')),
				'userid'	=> $this->session_data['id'],
			);
			$data['bug_id'] = $this->input->post('bug_id');
			$this->bugmodel->add_bug_comment($newComment);
			$data['referpage'] = "newcomment";
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
		$this->load->view('bugtracker/footer');
	}
	
	function load_bug_data() {
		$data['bug_priorities'] = $this->config->item('bug_priority');
		$data['bug_categories'] = $this->config->item('bug_categories');
		$data['bug_versions'] = $this->config->item('bug_versions');
		$data['bug_statuses'] = $this->config->item('bug_status');
		$data['bug_resolutions'] = $this->config->item('bug_resolutions');
		// This function gets a list of developers we can potentially assign bugs to, with their admin ID's.
		$data['developers'] = $this->adminmodel->get_list_devs();
		$data['users'] = $this->adminmodel->list_admins_by_name();
		$data['servers'] = $this->config->item('ragnarok_servers');
		$data['action_types'] = $this->config->item('action_types');
		return $data;
	}
	
}