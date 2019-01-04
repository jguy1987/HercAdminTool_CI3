<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class VerifyLogin extends MY_Controller {
 
	function __construct() {
		parent::__construct();
	}
	 
	function index() {
		//This method will have the credentials validation
	 
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('passwd', 'Password', 'trim|required|callback_check_database');
	 
		if($this->form_validation->run() == FALSE) {
			//Field validation failed.  User redirected to login page
			$this->load->view('user/login');
		}
		else {
			//Go to private area and update database with logged in info
			redirect('/', 'refresh');
		}
	}
	 
	function check_database($passwd) {
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');
	 
		//query the database
		$this->load->model('usermodel');
		$result = $this->usermodel->login($username, $passwd);
	 
		if($result) {
			$sess_array = array();
			foreach($result as $row) {
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->username,
					'group' => $row->groupid,
					'disablelogin' => $row->disablelogin,
				);
				// Update the database with active login
				$this->usermodel->update_user_active($sess_array['id'],"user/login");
				$client  = @$_SERVER['HTTP_CLIENT_IP'];
				$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
				$remote  = $_SERVER['REMOTE_ADDR'];

				if(filter_var($client, FILTER_VALIDATE_IP)) {
					$ip = $client;
				}
				elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
					$ip = $forward;
				}
				else {
					$ip = $remote;
				}

				$this->usermodel->update_loginlog($sess_array['id'],$ip);
				if ($sess_array['disablelogin'] == 1) {
					$this->form_validation->set_message('check_database', 'This user account is not authorized to login. Contact an administrator');
					return false;
				}
			}
			$this->session->set_userdata('loggedin', $sess_array);
			$this->session->set_userdata('server_select', $this->config->item('default_server_id'));
			return true;
		}
		else {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}
}
?>