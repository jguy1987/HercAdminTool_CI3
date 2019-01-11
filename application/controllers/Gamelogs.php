<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gamelogs extends MY_Controller {

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
		$this->load->library('form_validation');
	}
	
	public function atcmd_search() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'atcmdlog') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'],"gamelog/atcmd");
			$this->load->view('gamelogs/atcmdsearch');
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer');
		$this->load->view('gamelogs/footer');
	}
	
	public function atcmd_results() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'atcmdlog') == True && $this->vacation == 0) {
			$atcmdSearch = array(
				'char_name'		=> $this->input->post('char_name'),
				'atcmd'			=> $this->input->post('atcmd'),
				'date_start'	=> $this->input->post('date_start'),
				'date_end'		=> $this->input->post('date_end'),
				'map'				=> $this->input->post('map'),
			);
			$data['atcmd_log'] = $this->gamelogmodel->get_atcmd_search($atcmdSearch);
			$this->load->view('gamelogs/atcmdlist', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer');
		$this->load->view('gamelogs/footer');
	}
	
	public function pick_search() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'picklog') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'],"gamelog/pick");
			// Get current date/time and back 24 hours.
			$data['curDatetime'] = date('Y-m-d H:i:s');
			$data['Datetime24prev'] = date('Y-m-d H:i:s',strtotime('-24 hours'));
			$data['type_list'] = $this->config->item('pickTypes');
			$this->load->view('gamelogs/picklogsearch', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer');
		$this->load->view('gamelogs/footer');
	}
	
	public function pick_results() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'picklog') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'],"gamelog/pick");
			$pickSearch = array(
				'char_name'		=> $this->input->post('char_name'),
				'char_id'		=> $this->input->post('char_id'),
				'types'			=> $this->input->post('type'),
				'date_start'	=> $this->input->post('date_start'),
				'date_end'		=> $this->input->post('date_end'),
				'map'			=> $this->input->post('map'),
				'card_id'		=> $this->input->post('card_id'),
				'unique_id'		=> $this->input->post('unique_id')
			);
			$data['picklogResults'] = $this->gamelogmodel->get_pick_search($pickSearch);
			$data['type_list'] = $this->config->item('pickTypes');
			$this->load->view('gamelogs/pickloglist', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer');
		$this->load->view('gamelogs/footer');
	}
	
	public function zeny_search() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'zenylog') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'], "gamelog/zeny");
			$data['curDatetime'] = date('Y-m-d H:i:s');
			$data['Datetime24prev'] = date('Y-m-d H:i:s',strtotime('-24 hours'));
			$data['type_list'] = $this->config->item('pickTypes');
			unset($data['type_list']["L"]);
			unset($data['type_list']["R"]);
			unset($data['type_list']["G"]);
			unset($data['type_list']["O"]);
			unset($data['type_list']["U"]);
			unset($data['type_list']["X"]);
			$this->load->view('gamelogs/zenylogsearch', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer');
		$this->load->view('gamelogs/footer');
	}
	
	public function zeny_results() {
		if ($this->adminmodel->check_perm($this->session_data['group'],'zenylog') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'], "gamelog/zeny");
			$zenySearch = array(
				'source_char_name'		=> $this->input->post('source_char_name'),
				'source_char_id'		=> $this->input->post('source_char_id'),
				'dest_char_name'		=> $this->input->post('dest_char_name'),
				'dest_char_id'			=> $this->input->post('dest_char_id'),
				'types'					=> $this->input->post('type'),
				'zeny_min'				=> $this->input->post('zeny_low'),
				'zeny_max'				=> $this->input->post('zeny_high'),
				'date_start'			=> $this->input->post('date_start'),
				'date_end'				=> $this->input->post('date_end'),
				'map'					=> $this->input->post('map')
			);
			$data['zenylogResults'] = $this->gamelogmodel->get_zeny_search($zenySearch);
			$data['type_list'] = $this->config->item('pickTypes');
			$this->load->view('gamelogs/zenyloglist', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied', $data);
		}
		$this->load->view('footer');
		$this->load->view('gamelogs/footer');
	}
	
	function check_datetime($date) {
		if (date('Y-m-d H:i:s', strtotime($date)) == $date) {
			return true;
		}
		else {
			$this->form_validation->set_message('datetime_check', 'The datetime given is not in the proper format.');
			return false;
		}
	}
}