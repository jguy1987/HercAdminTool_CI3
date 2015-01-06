<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
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
	public function list() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$this->load->view('accounts/list');
		#this->load->view('footer-nocharts');
	}
}