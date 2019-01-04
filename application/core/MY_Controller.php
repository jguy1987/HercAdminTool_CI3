<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $session_data  = array();
	public $check_perm = array();
	public $db_login;
	public $db_charmap;
	public $db_charmaplog;
	public $db_hat;
	public $ssh2_lib;
	public $global_data;
	public function __construct() {
		parent::__construct();
		$this->load->dbutil();
		// Check to make sure the base_url is set.
		if ($this->config->item('base_url') == "http://example.com/") {
			$error['errtype'] = "nobaseurl";
			die($this->load->view('errdisplay', $error, TRUE));
		}
		// Check to make sure the encryption key is set.
		if ($this->config->item('encryption_key') == "changeme!") {
			$error['errtype'] = "noenckey";
			die($this->load->view('errdisplay', $error, TRUE));
		}
		// Check HAT Database connection
		$check_hat_db = @$this->load->database('hat', TRUE);
		//var_dump($check_hat_db);
		if (!is_null($check_hat_db->call_function("connect_error"))) {
			$error['errtype'] = "hatdbconn";
			die($this->load->view('errdisplay', $error, TRUE));
		}
		else {
			$this->load->library('session');
			$this->db_hat = $this->load->database('hat', TRUE, TRUE);
			// Test database to ensure all tables are present.
			if (!$this->db_hat->table_exists('hat_adminnews') || !$this->db_hat->table_exists('hat_bughistory') || !$this->db_hat->table_exists('hat_bugs') || !$this->db_hat->table_exists('hat_bugcomments') || !$this->db_hat->table_exists('hat_groups') || !$this->db_hat->table_exists('hat_loginlog') || !$this->db_hat->table_exists('hat_sessions') || !$this->db_hat->table_exists('hat_tktfolders') || !$this->db_hat->table_exists('hat_tktlog') || !$this->db_hat->table_exists('hat_tktmain') || !$this->db_hat->table_exists('hat_tktreplies') || !$this->db_hat->table_exists('hat_users')) {
				$error['errtype'] = "hattables";
				die($this->load->view('errdisplay', $error, TRUE));
			
			}
			$this->load->view('head');
			//$this->output->enable_profiler(TRUE);
			if ($this->session->userdata('loggedin')) {
				// Load models
				$this->load->model('accountmodel');
				$this->load->model('adminmodel');
				$this->load->model('analysismodel');
				$this->load->model('itemmodel');
				$this->load->model('dashboardmodel');
				$this->load->model('servermodel');
				$this->load->model('gamelogmodel');
				$this->load->model('charmodel');
				$this->load->model('guildmodel');
				$this->load->model('bugmodel');
				$this->load->model('usermodel');
				$servers = $this->config->item('ragnarok_servers');
				$login_servers = $this->config->item('login_servers');
				$login_srv_id = $servers[$this->session->userdata('server_select')]['login_server_group'];
				$login_srv = $login_servers[$login_srv_id]['login_database_group'];
				$check_login_db = @$this->load->database($login_srv, TRUE);
				if ($check_login_db->call_function("connect_error")) {
					$error['errtype'] = "logindbconn";
					$error['logindbname'] = $login_srv;
					die($this->load->view('errdisplay', $error, TRUE));
				}
				$this->db_login = $this->load->database($login_srv, TRUE, TRUE);
				// Load Session data.
				$this->session_data = $this->session->userdata('loggedin');
				// Load permission lists and put all permissions into an array for easy retrieval
				$perm_list = $this->config->item('permissions');
				$this->check_perm = $this->usermodel->get_perms($this->session_data['group'],$perm_list);
				$this->maindatabase = $servers[$this->session->userdata('server_select')]['main_database_group'];
				$check_charmap_db = @$this->load->database($this->maindatabase, TRUE);
				if ($check_charmap_db->call_function("connect_error")) {
					$error['errtype'] = "charmapdbconn";
					$error['charmapdbname'] = $this->maindatabase;
					die($this->load->view('errdisplay', $error, TRUE));
				}
				$this->db_charmap = $this->load->database($this->maindatabase, TRUE, TRUE);
				$this->logdatabase = $servers[$this->session->userdata('server_select')]['log_database_group'];
				$check_log_db = @$this->load->database($this->logdatabase, TRUE);
				if ($check_log_db->call_function("connect_error")) {
					$error['errtype'] = "logdbconn";
					$error['logdbname'] = $this->logdatabase;
					die($this->load->view('errdisplay', $error, TRUE));
				}
				$this->db_charmaplog = $this->load->database($this->logdatabase, TRUE, TRUE);
				$this->playersonline = $this->charmodel->get_online_count();
				// Get list of groups with ID's so that we can display on header.
				//$this->global_data['group_list'] = $this->adminmodel->list_groups_by_name();
				$this->load->vars($this->global_data);
			}
		}
   }
}