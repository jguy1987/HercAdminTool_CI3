<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$this->load->model('accountmodel');
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->model('usermodel');
		$data['perm_list'] = $this->config->item('permissions');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$this->load->view('sidebar', $data);
	}

	public function create() {
		$this->load->view('account/create');
		$this->load->view('footer-nocharts');
	}
	
	public function details($aid) {
		$data['acct_data'] = $this->accountmodel->get_acct_details($aid);
		$data['char_list'] = $this->accountmodel->get_char_list($aid);
		$data['class_list'] = $this->config->item('jobs');
		$this->load->view('account/details',$data);
		$this->load->view('footer-nocharts');
	}
	
	public function listaccts() {
		$data['accts'] = $this->accountmodel->list_accounts();
		$this->load->view('account/listaccts', $data);
		$this->load->view('footer-nocharts');
	}
	
	public function verifycreate() {
		$this->form_validation->set_rules('acctname', 'Username', 'trim|required|min_length[4]|max_length[25]|xss_clean|is_unique[login.user_id]');
		$this->form_validation->set_rules('email', 'Email Address','trim|required|valid_email');
		$this->form_validation->set_rules('gender', "Gender", 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('account/create');
		}
		else {
			$newAcct = array(
				'user_id'			=> $this->input->post('acctname'),
				'email'				=> $this->input->post('email'),
				'sex'					=> $this->input->post('gender'),
				'group_id'			=> $this->input->post('groupid'),
				'birthdate'			=> $this->input->post('birthdate'),
				'character_slots'	=> $this->input->post('slots')
			);
			$newAcct = $this->accountmodel->add_account($data);
			$this->send_acct_email($data,$newAcct,'newacct');
			$data['referpage'] = "useradd";
			$this->load->view('account/formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	function send_acct_email($data,$newAcct,$type) {
		$this->email->from($this->config->item('emailfrom'), $this->config->item('servername'));
		$this->email->to($data['email']);
		switch( $type ) {
			case "newacct":
				$this->email->subject("Your game account for {$this->config->item('servername')} has been created.");
				$this->email->message("Hello {$data['user_id']},
Your game account for {$this->config->item('servername')} has been created. You may use these details to immediately login to the game and start playing!

Username: {$data['user_id']}
Password: {$newAcct['passwd']}
Pincode: {$newAcct['pincode']}

Thank you.");
				break;
		}
	}
	
		
}