<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function create() {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			
			$this->load->view('header', $data);
			$this->load->view('sidebar');
			$this->load->helper(array('form'));
			$this->load->view('accounts/create');
			$this->load->view('footer-nocharts');
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
	public function list() {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			
			$this->load->view('header', $data);
			$this->load->view('sidebar');
			$this->load->view('accounts/list');
			#this->load->view('footer-nocharts');
		{
		else {
			redirect('user/login', 'refresh');
		}
	}
}