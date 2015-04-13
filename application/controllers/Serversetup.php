<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Serversetup extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$data['username'] = $this->session_data['username'];
		
		$this->load->view('header', $data);
		$data['check_perm'] = $this->check_perm;
		$this->load->view('sidebar', $data);
	}
	
	function stats() {
		$this->load->view('server/stats', $data);
		$this->load->view('footer');
	}