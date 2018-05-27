<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tickets extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$this->vacation = $this->usermodel->check_vacation_mode($this->session_data['id']);
		$this->load->view('topnav', $data);
		$this->load->view('sidebar', $data);
	}


	public function ticketlist {
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->view('sidebar');
		$this->load->view('tickets/ticketlist');
		$this->load->view('datatables-scripts');
		$this->load->view('footer');
	}