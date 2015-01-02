<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class VerifyLogin extends CI_Controller {
 
	function __construct() {
		parent::__construct();
		$this->load->model('user','',TRUE);
	}
	 
	function index() {
		//This method will have the credentials validation
		$this->load->library('form_validation');
	 
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('passwd', 'Password', 'trim|required|xss_clean|callback_check_database');
	 
		if($this->form_validation->run() == FALSE) {
		  //Field validation failed.  User redirected to login page
		  $this->load->view('login');
		}
		else {
		  //Go to private area
		  redirect('/', 'refresh');
		}
	 
	}
	 
	function check_database($passwd) {
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');
	 
		//query the database
		$result = $this->user->login($username, $passwd);
	 
		if($result) {
		  $sess_array = array();
		  foreach($result as $row) {
			 $sess_array = array(
				'id' => $row->id,
				'username' => $row->username,
				'group' => $row->groupid
			 );
			 $this->session->set_userdata('loggedin', $sess_array);
		  }
		  return true;
		}
		else {
		  $this->form_validation->set_message('check_database', 'Invalid username or password');
		  return false;
		}
	}
}
?>