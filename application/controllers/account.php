<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('loggedin')) {
			redirect('user/login', 'refresh');
		}
		$this->load->model('accountmodel');
		$this->load->model('adminmodel');
		$session_data = $this->session->userdata('loggedin');
		$data['username'] = $session_data['username'];
		
		$this->load->view('header', $data);
		$this->load->model('usermodel');
		$data['perm_list'] = $this->config->item('permissions');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$this->load->view('sidebar', $data);
		$this->load->library('form_validation');
	}

	public function create() {
		$this->load->view('account/create');
		$this->load->view('footer-nocharts');
	}
	
	public function details($aid) {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($session_data['id'],"accounts/details");
		$data['acct_data'] = $this->accountmodel->get_acct_details($aid);
		$data['char_list'] = $this->accountmodel->get_char_list($aid);
		$data['class_list'] = $this->config->item('jobs');
		$data['acct_notes'] = $this->accountmodel->get_acct_notes($aid);
		$data['block_list'] = $this->accountmodel->get_block_hist($aid);
		$data['perm_list'] = $this->config->item('permissions');
		$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
		$data['num_key_list'] = $this->accountmodel->get_num_key_list($aid);
		$data['chg_acct_list'] = $this->accountmodel->get_acct_changes($aid);
		$this->load->view('account/details',$data);
		$this->load->view('footer-nocharts');
	}
	
	public function listaccts() {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($session_data['id'],"accounts/listaccts");
		$data['accts'] = $this->accountmodel->list_accounts();
		$this->load->view('account/listaccts', $data);
		$this->load->view('footer-nocharts');
	}
	
	public function search() {
		$session_data = $this->session->userdata('loggedin');
		$this->usermodel->update_user_active($session_data['id'],"accounts/search");
		$searchTerms = array(
			'acct_id'	=> $this->input->post('acct_id'),
			'acct_name'	=> $this->input->post('acct_name'),
			'email'		=> $this->input->post('email'),
			'gender'		=> $this->input->post('gender'),
			'isGM'		=> $this->input->post('isGM'),
			'isBanned'	=> $this->input->post('isBanned'),
		);
		$data['search_results'] = $this->accountmodel->search_accts($searchTerms);
		$this->load->view('account/search', $data);
		$this->load->view('footer-nocharts');
	}
	
	public function verifycreate() {
		$this->form_validation->set_rules('acctname', 'Username', 'trim|required|min_length[4]|max_length[25]|xss_clean|is_unique[login.userid]');
		$this->form_validation->set_rules('email', 'Email Address','trim|required|valid_email');
		$this->form_validation->set_rules('gender', "Gender", 'required');		
		$this->form_validation->set_rules('groupid', "Group ID", 'callback_check_groupid_perm');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('account/create');
		}
		else {
			$newAcct = array(
				'userid'			=> $this->input->post('acctname'),
				'email'				=> $this->input->post('email'),
				'sex'					=> $this->input->post('gender'),
				'group_id'			=> $this->input->post('groupid'),
				'birthdate'			=> $this->input->post('birthdate'),
				'character_slots'	=> $this->input->post('slots')
			);
			$data = $this->accountmodel->add_account($newAcct);
			$this->send_acct_email($data,$newAcct,'newacct');
			$data['referpage'] = "acctadd";
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function addnote() {
		$this->form_validation->set_rules('note', 'Note','trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->usermodel->update_user_active($session_data['id'],"accounts/listaccts");
			$data['accts'] = $this->accountmodel->list_accounts();
			$this->load->view('account/listaccts', $data);
		}
		else {
			$session_data = $this->session->userdata('loggedin');
			$newNote = array(
				'acct_id'		=> $this->input->post('acct_id'),
				'userid'				=> $session_data['id'],
				'note'			=> nl2br($this->input->post('note'))
			);
			$this->accountmodel->add_note($newNote);
			$data['referpage'] = "acctnoteadd";
			$data['acct_id'] = $newNote['acct_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function addblock() {
		$session_data = $this->session->userdata('loggedin');
		if ($this->input->post('banType') == "temp") {
			$this->form_validation->set_rules('banEnd', 'Expiry Date', 'trim|xss_clean|required|callback_datetime_check');
		}
		$this->form_validation->set_rules('banComments', 'Ban Comments', 'trim|xss_clean|required');
		if ($this->form_validation->run() == FALSE) {
			$this->usermodel->update_user_active($session_data['id'],"accounts/listaccts");
			$data['accts'] = $this->accountmodel->list_accounts();
			$this->load->view('account/listaccts', $data);
		}
		else {
			$newBan = array(
				'account_id'	=> $this->input->post('acct_id'),
				'unban_date'	=> $this->input->post('banEnd'),
				'reason'			=> $this->input->post('reason'),
				'comments'		=> nl2br($this->input->post('banComments')),
				'type'			=> $this->input->post('banType'),
				'userid'			=> $session_data['id'],
			);
			$this->accountmodel->apply_acct_ban($newBan);
			$data['referpage'] = "newban";
			$data['acct_id'] = $newBan['account_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function delblock() {
		$session_data = $this->session->userdata('loggedin');
		$this->form_validation->set_rules('unbanComments', 'Un-Ban Comments', 'trim|xss_clean|required');
		if ($this->form_validation->run() == FALSE) {
			$this->usermodel->update_user_active($session_data['id'],"accounts/listaccts");
			$data['accts'] = $this->accountmodel->list_accounts();
			$this->load->view('account/listaccts', $data);
		}
		else {
			$remBan = array(
				'acct_id'				=> $this->input->post('acct_id'),
				'blockid'				=> $this->input->post('blockidval'),
				'unblock_comment'		=> nl2br($this->input->post('unbanComments')),
				'unblock_user'			=> $session_data['id'],
			);
			$this->accountmodel->apply_acct_unban($remBan);
			$data['referpage'] = "remban";
			$data['acct_id'] = $remBan['acct_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function verifyedit() {
		$session_data = $this->session->userdata('loggedin');
		$this->form_validation->set_rules('email',"Email",'trim|required|valid_email');
		$this->form_validation->set_rules('groupid',"Group ID",'trim|required|greater_than[-1]|less_than[100]');
		$this->form_validation->set_rules('birthdate',"Birth Date",'trim|required|callback_date_check');
		$this->form_validation->set_rules('charslots',"Character Slots",'trim|required|greater_than[-1]|less_than[10]');
		$this->form_validation->set_rules('groupid', "Group ID", 'callback_check_groupid_perm');
		if ($this->form_validation->run() == FALSE) {
			$this->usermodel->update_user_active($session_data['id'],"accounts/details");
			$aid = $this->input->post('account_id');
			$data['acct_data'] = $this->accountmodel->get_acct_details($aid);
			$data['char_list'] = $this->accountmodel->get_char_list($aid);
			$data['class_list'] = $this->config->item('jobs');
			$data['acct_notes'] = $this->accountmodel->get_acct_notes($aid);
			$data['block_list'] = $this->accountmodel->get_block_hist($aid);
			$data['perm_list'] = $this->config->item('permissions');
			$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
			$data['num_key_list'] = $this->accountmodel->get_num_key_list($aid);
			$data['chg_acct_list'] = $this->accountmodel->get_acct_changes($aid);
			$this->load->view('account/details',$data);
		}
		else {
			$chgAcct = array(
				'user'				=> $session_data['id'],
				'account_id'		=> $this->input->post('account_id'),
				'email'				=> $this->input->post('email'),
				'sex'					=> $this->input->post('gender'),
				'group_id'			=> $this->input->post('groupid'),
				'character_slots'	=> $this->input->post('charslots'),
				'birthdate'			=> $this->input->post('birthdate'),
			);
			$chgResult = $this->accountmodel->edit_acct_details($chgAcct);
			if ($chgResult == true) {
				$data['referpage'] = "editaccount";
				$data['acct_id'] = $chgAcct['account_id'];
				$this->load->view('formsuccess', $data);
			}
			else {
				$this->form_validation->set_message("You didn't actually change anything!");
				$this->usermodel->update_user_active($session_data['id'],"accounts/details");
				$aid = $this->input->post('account_id');
				$data['acct_data'] = $this->accountmodel->get_acct_details($aid);
				$data['char_list'] = $this->accountmodel->get_char_list($aid);
				$data['class_list'] = $this->config->item('jobs');
				$data['acct_notes'] = $this->accountmodel->get_acct_notes($aid);
				$data['block_list'] = $this->accountmodel->get_block_hist($aid);
				$data['perm_list'] = $this->config->item('permissions');
				$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
				$data['num_key_list'] = $this->accountmodel->get_num_key_list($aid);
				$data['chg_acct_list'] = $this->accountmodel->get_acct_changes($aid);
				$this->load->view('account/details',$data);
			}
		}
		$this->load->view('footer-nocharts');
	}
	
	public function resetpass($aid) {
		$session_data = $this->session->userdata('loggedin');
		// Check to make sure admin has permissions to reset password
		if ($this->adminmodel->check_perm($session_data['group'],'resetacctpass') == True) {
			$chgPass = $this->accountmodel->reset_pass($aid, $session_data['id']);
			$this->send_acct_email($chgPass,$chgPass,"chgpass");
			$data['referpage'] = "resetpass";
			$data['acct_id'] = $aid;
			$this->load->view('formsuccess', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer-nocharts');
	}
	
	public function addnumflag() {
		$session_data = $this->session->userdata('loggedin');
		$this->form_validation->set_rules('key',"Key",'trim|required|is_unique[acc_reg_num_db.key]');
		$this->form_validation->set_rules('value',"Value",'trim|required|is_number');
		if ($this->form_validation->run() == FALSE) {
			$this->usermodel->update_user_active($session_data['id'],"accounts/details");
			$aid = $this->input->post('acct_id');
			$data['acct_data'] = $this->accountmodel->get_acct_details($aid);
			$data['char_list'] = $this->accountmodel->get_char_list($aid);
			$data['class_list'] = $this->config->item('jobs');
			$data['acct_notes'] = $this->accountmodel->get_acct_notes($aid);
			$data['block_list'] = $this->accountmodel->get_block_hist($aid);
			$data['perm_list'] = $this->config->item('permissions');
			$data['check_perm'] = $this->usermodel->get_perms($session_data['group'],$data['perm_list']);
			$data['num_key_list'] = $this->accountmodel->get_num_key_list($aid);
			$data['chg_acct_list'] = $this->accountmodel->get_acct_changes($aid);
			$this->load->view('account/details',$data);
		}
		else {
			$addFlag = array(
				'user'		=> $session_data['id'],
				'acct_id'	=> $this->input->post('acct_id'),
				'key'			=> $this->input->post('key'),
				'index'		=> $this->input->post('index'),
				'value'		=> $this->input->post('value'),
			);
			$this->accountmodel->add_num_flag($addFlag);
			$data['referpage'] = "addnumflag";
			$data['acct_id'] = $addFlag['acct_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer-nocharts');
	}
	
	function send_acct_email($data,$newAcct,$type) {
		$this->email->from($this->config->item('emailfrom'), $this->config->item('servername'));
		$this->email->to($newAcct['email']);
		switch( $type ) {
			case "newacct":
				$this->email->subject("Your game account for {$this->config->item('servername')} has been created.");
				$this->email->message("Hello {$newAcct['userid']},
Your game account for {$this->config->item('servername')} has been created. You may use these details to immediately login to the game and start playing!

Username: {$newAcct['userid']}
Password: {$data['passwd']}
Pincode: {$data['pincode']}

Thank you.");
				$this->email->send();
				return $this->email->print_debugger();
				break;
			case "chgpass":
				$this->email->subject("Your password for {$this->config->item('servername')} has been reset.");
				$this->email->message("Hello {$newAcct['userid']},
Your password for {$this->config->item('servername')} has been reset. You will immediately use this password to login to the game and start playing!

Password: {$data['pass']}

Thank you.");
				$this->email->send();
				break;
		}
	}
	
	function datetime_check($date) {
		if (date('Y-m-d H:i:s', strtotime($date)) == $date) {
			return true;
		}
		else {
			$this->form_validation->set_message('datetime_check', 'The datetime given is not in the proper format.');
			return false;
		}
	}
	
	function date_check($date) {
		if (date('Y-m-d', strtotime($date)) == $date) {
			return true;
		}
		else {
			$this->form_validation->set_message('date_check', 'The date given is not in the proper format.');
			return false;
		}
	}
	
	function check_groupid_perm($groupid) {
		$session_data = $this->session->userdata('loggedin');
		$this->db_ragnarok->select('acctgroupmax');
		$query = $this->db_ragnarok->get_where('hat_groups', array('id' => $session_data['group']));
		$queryResult = $query->row();
		if ($queryResult->acctgroupmax >= $groupid) {
			return True;
		}
		else {
			$this->form_validation->set_message('check_groupid_perm', "You may not create or edit a game account to have a higher group ID than {$queryResult->acctgroupmax}");
			return False;
		}
	}
}