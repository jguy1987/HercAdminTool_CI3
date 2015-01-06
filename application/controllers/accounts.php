<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$this->load->database('ragnarok');
		$this->load->model('accountmodel','',TRUE);
	}

	public function create() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$this->load->helper(array('form'));
		$this->load->view('accounts/create');
		$this->load->view('footer-nocharts');
	}
	
	public function listaccts() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$data['accts'] = $this->accountmodel->list_accounts();
		$this->load->view('accounts/listaccts', $data);
		$this->load->view('footer-nocharts');
	}
}