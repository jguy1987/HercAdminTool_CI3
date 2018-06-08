<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analysis extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$data['username'] = $this->session_data['username'];
		$data['check_perm'] = $this->check_perm;
		$this->vacation = $this->usermodel->check_vacation_mode($this->session_data['id']);
		$data['vacation'] = $this->usermodel->check_vacation_mode($this->session_data['id']);
		$data['ssh_conn'] = $this->config->item('ssh_conn');
		$this->load->view('topnav', $data);
		$this->load->view('sidebar', $data);
	}
	
	public function itemcount() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'itemcount') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'],"analysis/itemcount");
			$this->load->view('analysis/itemcountsearch');
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('analysis/footer');
	}
	
	public function itemcount_result() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'itemcount') == True && $this->vacation == 0) {
			$inputID = $this->input->post('inputID'); // fix for older PHP versions. Can't pass object through empty.
			if (empty($inputID) == false) {
				$searchResults = $this->analysismodel->get_itemcount($this->input->post('inputID'));
				// Break apart the array:
				$data['itemInfo'] = $searchResults[0];
				$data['inventoryList'] = $searchResults[1];
				$data['storageList'] = $searchResults[2];
				$data['item_types'] = $this->config->item('itemTypes');
				$data['class_list'] = $this->config->item('jobs');
				$this->load->view('/analysis/itemcount', $data);
			}
			else {
				$data['referpage'] = "noIDinput";
				$this->load->view('accessdenied', $data);
			}
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('analysis/footer');
	}
	
	public function level1zeny() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'level1zeny') == True && $this->vacation == 0) {
			$data['zenyResult'] = $this->analysismodel->get_lv1_1mzeny();
			$data['class_list'] = $this->config->item('jobs');
			$this->load->view('/analysis/level1zeny', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('analysis/footer');
	}
	
	public function nocharaccts() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'nocharaccts') == True && $this->vacation == 0) {
			$data['accountresult'] = $this->analysismodel->getnocharaccts();
			$this->load->view('/analysis/nocharaccts', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
		$this->load->view('analysis/footer');
	}
}