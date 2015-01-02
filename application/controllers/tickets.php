<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tickets extends CI_Controller {

	public function ticketlist {
		if ($this->session->userdata('loggedin')) {
			$session_data = $this->session->userdata('loggedin');
			$data['username'] = $session_data['username'];
			
			$this->load->view('header', $data);
			$this->load->view('sidebar');
			$this->load->view('tickets/ticketlist');
			$this->load->view('footer');
		}
		else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}