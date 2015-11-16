<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $session_data  = array();
	public $check_perm = array();
	public $db_login;
	public $db_charmap;
	public $db_charmaplog;
	public function __construct() {
		parent::__construct();
		$this->db_login = $this->load->database($this->config->item('login_server'), TRUE, TRUE);
		$this->load->model('accountmodel');
		$this->load->model('adminmodel');
		$this->load->model('analysismodel');
		$this->load->model('itemmodel');
		$this->load->model('usermodel');
		$this->load->model('dashboardmodel');
		$this->load->model('servermodel');
		$this->load->model('gamelogmodel');
		$this->load->model('charmodel');
		$this->load->model('guildmodel');
		//$this->output->enable_profiler(TRUE);
		if ($this->session->userdata('loggedin')) {
			// Load Session data.
			$this->session_data = $this->session->userdata('loggedin');
			// Load permission lists and put all permissions into an array for easy retrieval
			$perm_list = $this->config->item('permissions');
			$this->check_perm = $this->usermodel->get_perms($this->session_data['group'],$perm_list);
			$servers = $this->config->item('ragnarok_servers');
			$this->maindatabase = $servers[$this->session->userdata('server_select')]['main_database_group'];
			$this->db_charmap = $this->load->database($this->maindatabase, TRUE, TRUE);
			$this->logdatabase = $servers[$this->session->userdata('server_select')]['log_database_group'];
			$this->db_charmaplog = $this->load->database($this->logdatabase, TRUE, TRUE);
		}				
   }
}