<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			
			$this->load->view('header', $data);
			$this->load->view('sidebar');
			$this->load->view('index');
			$this->load->view('footer');
		}
		else {
			//If no session, redirect to login page
			redirect('user/login', 'refresh');
		}
	}
}