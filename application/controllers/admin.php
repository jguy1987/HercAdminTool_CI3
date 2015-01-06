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
	
	public function verifyuseredit() {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			$this->load->library('form_validation');
			
			$this->load->view('header', $data);
			$this->load->view('sidebar');
			// Validate input on form.
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[25]|xss_clean|callback_username_check');
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
				$this->load->view('admin/formsuccess');
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
	
	// Validation Functions
	public function username_check($username) {
		$query = $this->db->get_where('users', array('username' => $username));
		if ($query->num_rows() > 0) {
			return True; //Username exists already
		}
		else {
			$this->form_validation->set_message('username_check', 'The username %s already exists.');
			return False; // Username does not exist
		}
	}
}