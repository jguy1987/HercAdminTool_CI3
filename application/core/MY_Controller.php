<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	
	public $session_data  = array();
	public $check_perm = array();
	
	public function __construct() {
		parent::__construct();
		$this->db_ragnarok = $this->load->database('ragnarok',TRUE);
		// Load all models.
		$this->load->model('accountmodel');
		$this->load->model('adminmodel');
		$this->load->model('itemmodel');
		$this->load->model('usermodel');
		$this->load->model('dashboardmodel');
		$this->load->model('servermodel');
		$this->load->model('gamelogmodel');
		$this->load->model('charmodel');
		$this->load->model('guildmodel');	
		
		if ($this->session->userdata('loggedin')) {
			// Load Session data.
			$this->session_data = $this->session->userdata('loggedin');
			
			// Load permission lists and put all permissions into an array for easy retrieval
			$perm_list = $this->config->item('permissions');
			$this->check_perm = $this->usermodel->get_perms($this->session_data['group'],$perm_list);
		}
   }
}