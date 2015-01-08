<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tickets extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
	}


	public function ticketlist {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$this->load->view('tickets/ticketlist');
		$this->load->view('footer');
	}