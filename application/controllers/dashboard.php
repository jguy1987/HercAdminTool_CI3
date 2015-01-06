<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
	}


	public function index() {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$this->load->view('index');
		$this->load->view('footer');
	}
}