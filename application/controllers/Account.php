<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	public $data;
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

	public function create() {
		$this->load->view('account/create');
		$this->load->view('footer');
		$this->load->view('account/footer');
	}
	
	public function details($aid) {
		if ($this->adminmodel->check_perm($this->session_data['group'],'viewaccounts') == True && $this->vacation == 0) {
			$this->usermodel->update_user_active($this->session_data['id'],"accounts/details");
			$data['class_list'] = $this->config->item('jobs');
			$data['equipLocation'] = $this->config->item('equipLocations');
			$data['item_types'] = $this->config->item('itemTypes');
			$data += $this->load_acct_data($aid);
			$this->load->view('account/details',$data);
			//$this->load->view('datatables-scripts');
			$this->load->view('footer');
			$this->load->view('account/footer');
		}
	}
	
	public function search() {
		$this->usermodel->update_user_active($this->session_data['id'],"accounts/listaccts");
		$this->load->view('account/search');
		$this->load->view('footer');
	}
	
	public function resultlist() {
		$this->usermodel->update_user_active($this->session_data['id'],"accounts/search");
		$searchTerms = array(
			'acct_id'	=> $this->input->post('acct_id'),
			'acct_name'	=> $this->input->post('acct_name'),
			'email'		=> $this->input->post('email'),
			'gender'		=> $this->input->post('gender'),
			'isGM'		=> $this->input->post('isGM'),
			'isBanned'	=> $this->input->post('isBanned'),
		);
		$data['accts'] = $this->accountmodel->search_accts($searchTerms);
		$this->load->view('account/list', $data);
		$this->load->view('footer');
		$this->load->view('account/footer');
	}
	
	public function verifycreate() {
		$this->form_validation->set_rules('acctname', 'Username', 'trim|required|min_length[4]|max_length[25]|callback_check_is_username_unique');
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
		$this->load->view('footer');
	}
	
	public function addnote() {
		$this->form_validation->set_rules('note', 'Note','trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->resultlist();
		}
		else {
			$newNote = array(
				'acct_id'		=> $this->input->post('acct_id'),
				'userid'				=> $this->session_data['id'],
				'note'			=> nl2br($this->input->post('note'))
			);
			$this->accountmodel->add_note($newNote);
			$data['referpage'] = "acctnoteadd";
			$data['acct_id'] = $newNote['acct_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
	}
	
	public function addblock() {
		if ($this->input->post('banType') == "temp") {
			$this->form_validation->set_rules('banEnd', 'Expiry Date', 'trim|required|callback_datetime_check');
		}
		$this->form_validation->set_rules('banComments', 'Ban Comments', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->resultlist();
		}
		else {
			$newBan = array(
				'account_id'	=> $this->input->post('acct_id'),
				'unban_date'	=> $this->input->post('banEnd'),
				'reason'			=> $this->input->post('reason'),
				'comments'		=> nl2br($this->input->post('banComments')),
				'type'			=> $this->input->post('banType'),
				'userid'			=> $this->session_data['id'],
			);
			$this->accountmodel->apply_acct_ban($newBan);
			$data['referpage'] = "newban";
			$data['acct_id'] = $newBan['account_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
	}
	
	public function delblock() {
		$this->form_validation->set_rules('unbanComments', 'Un-Ban Comments', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->resultlist();
		}
		else {
			$remBan = array(
				'acct_id'				=> $this->input->post('acct_id'),
				'blockid'				=> $this->input->post('blockidval'),
				'unblock_comment'		=> nl2br($this->input->post('unbanComments')),
				'unblock_user'			=> $this->session_data['id'],
			);
			$this->accountmodel->apply_acct_unban($remBan);
			$data['referpage'] = "remban";
			$data['acct_id'] = $remBan['acct_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
	}
	
	public function verifyedit() {
		$this->form_validation->set_rules('email',"Email",'trim|required|valid_email');
		$this->form_validation->set_rules('groupid',"Group ID",'trim|required|greater_than[-1]|less_than[100]');
		$this->form_validation->set_rules('birthdate',"Birth Date",'trim|required|callback_date_check');
		$this->form_validation->set_rules('charslots',"Character Slots",'trim|required|greater_than[-1]|less_than[10]');
		$this->form_validation->set_rules('groupid', "Group ID", 'callback_check_groupid_perm');
		if ($this->form_validation->run() == FALSE) {
			$this->details($this->input->post('account_id'));
		}
		else {
			$chgAcct = array(
				'user'				=> $this->session_data['id'],
				'account_id'		=> $this->input->post('account_id'),
				'email'				=> $this->input->post('email'),
				'sex'					=> $this->input->post('gender'),
				'group_id'			=> $this->input->post('groupid'),
				'character_slots'	=> $this->input->post('charslots'),
				'birthdate'			=> $this->input->post('birthdate'),
			);
			$this->accountmodel->edit_acct_details($chgAcct);
			$data['referpage'] = "editaccount";
			$data['acct_id'] = $chgAcct['account_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
	}
	
	public function resetpass($aid) {
		// Check to make sure admin has permissions to reset password
		if ($this->adminmodel->check_perm($this->session_data['group'],'resetacctpass') == True && $this->vacation == 0) {
			$chgPass = $this->accountmodel->reset_pass($aid, $this->session_data['id']);
			$this->send_acct_email($chgPass,$chgPass,"chgpass");
			$data['referpage'] = "resetpass";
			$data['acct_id'] = $aid;
			$this->load->view('formsuccess', $data);
		}
		else {
			$data['referpage'] = "noperm";
			$this->load->view('accessdenied',$data);
		}
		$this->load->view('footer');
	}
	
	public function addnumflag() {
		$this->form_validation->set_rules('key',"Key",'trim|required|callback_check_num_flag');
		$this->form_validation->set_rules('value',"Value",'trim|required|is_number');
		if ($this->form_validation->run() == FALSE) {
			$this->details($this->input->post('acct_id'));
		}
		else {
			$addFlag = array(
				'user'		=> $this->session_data['id'],
				'acct_id'	=> $this->input->post('acct_id'),
				'key'			=> $this->input->post('key'),
				'index'		=> $this->input->post('index'),
				'value'		=> $this->input->post('value'),
			);
			$this->accountmodel->add_flag($addFlag, "num");
			$data['referpage'] = "addnumflag";
			$data['acct_id'] = $addFlag['acct_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
	}
	
	public function addstrflag() {
		$this->form_validation->set_rules('key',"Key",'trim|required|callback_check_str_flag');
		$this->form_validation->set_rules('value',"Value",'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->details($this->input->post('acct_id'));
		}
		else {
			$addFlag = array(
				'user'		=> $this->session_data['id'],
				'acct_id'	=> $this->input->post('acct_id'),
				'key'			=> $this->input->post('key'),
				'index'		=> $this->input->post('index'),
				'value'		=> $this->input->post('value'),
			);
			$this->accountmodel->add_flag($addFlag, "str");
			$data['referpage'] = "addstrflag";
			$data['acct_id'] = $addFlag['acct_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
	}
	
	public function editnumflag() {
		$this->form_validation->set_rules('value',"Value",'trim|required|is_number');
		if ($this->form_validation->run() == FALSE) {
			$this->details($this->input->post('acct_id'));
		}
		else {
			$editFlag = array(
				'user'		=> $this->session_data['id'],
				'acct_id'	=> $this->input->post('acct_id'),
				'key'			=> $this->input->post('key'),
				'index'		=> $this->input->post('index'),
				'value'		=> $this->input->post('value'),
			);
			$this->accountmodel->edit_flag($editFlag, "num");
			$data['referpage'] = "editnumflag";
			$data['acct_id'] = $editFlag['acct_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
	}
	
	public function editstrflag() {
		$this->form_validation->set_rules('value',"Value",'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->details($this->input->post('acct_id'));
		}
		else {
			$editFlag = array(
				'user'		=> $this->session_data['id'],
				'acct_id'	=> $this->input->post('acct_id'),
				'key'			=> $this->input->post('key'),
				'index'		=> $this->input->post('index'),
				'value'		=> $this->input->post('value'),
			);
			$this->accountmodel->edit_flag($editFlag, "str");
			$data['referpage'] = "editstrflag";
			$data['acct_id'] = $editFlag['acct_id'];
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
	}
	
	function edititem() {
		$this->form_validation->set_rules('refine', "Refine Level", 'trim|required|greater_than[-1]');
		if ($this->input->post('card0') > 0) {
			$this->form_validation->set_rules('card0', "Card 1", 'callback_check_card');
		}
		if ($this->input->post('card1') > 0) {
			$this->form_validation->set_rules('card1', "Card 2", 'callback_check_card');
		}
		if ($this->input->post('card2') > 0) {
			$this->form_validation->set_rules('card2', "Card 3", 'callback_check_card');
		}
		if ($this->input->post('card3') > 0) {
			$this->form_validation->set_rules('card3', "Card 4", 'callback_check_card');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->details($this->input->post('acct_id'));
		}
		else {
			$itemLoc = "storage";
			$itemEdit = array(
				'id'			=> $this->input->post('id'),
				'refine'		=> $this->input->post('refine'),
				'attribute'	=> $this->input->post('attribute'),
				'bound'		=> $this->input->post('bound'),
				'card0'		=> $this->input->post('card0'),
				'card1'		=> $this->input->post('card1'),
				'card2'		=> $this->input->post('card2'),
				'card3'		=> $this->input->post('card3'),
			);
			$this->itemmodel->edit_char_item($itemEdit, $itemLoc);
			$data['referpage'] = "editaccount";
			$data['acct_id'] = $this->input->post('acctid');
			$this->load->view('formsuccess', $data);
		}
		$this->load->view('footer');
	}
	
	function send_acct_email($data,$newAcct,$type) {
		$this->email->from($this->config->item('emailfrom'), $this->config->item('servername'));
		$this->email->to($newAcct['email']);
		switch( $type ) {
			case "newacct":
				$this->email->subject("Your game account for {$this->config->item('servername')} has been created.");
				$this->email->message("Hello {$newAcct['userid']},
Your game account for {$this->config->item('servername')} has been created by a Gamemaster. You may use these details to immediately login to the game and start playing!

Username: {$newAcct['userid']}
Password: {$data['passwd']}
Pincode: {$data['pincode']}

Thank you.

Your {$this->config->item('servername')} team");
				$this->email->send();
				return $this->email->print_debugger();
				break;
			case "chgpass":
				$this->email->subject("Your password for {$this->config->item('servername')} has been reset!.");
				$this->email->message("Hello {$newAcct['userid']},
Your password for {$this->config->item('servername')} has been reset by a Gamemaster. You will immediately use this password to login to the game and start playing!

Password: {$data['pass']}

Thank you.

Your {$this->config->item('servername')} team");
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
		$this->db_hat->select('acctgroupmax');
		$query = $this->db_hat->get_where('hat_groups', array('id' => $session_data['group']));
		$queryResult = $query->row();
		if ($queryResult->acctgroupmax >= $groupid) {
			return True;
		}
		else {
			$this->form_validation->set_message('check_groupid_perm', "You may not create or edit a game account to have a higher group ID than {$queryResult->acctgroupmax}");
			return False;
		}
	}
	
	function check_is_username_unique($username) {
		$this->db_login->select('userid');
		$query = $this->db_login->get_where('login', array('userid' => $username));
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('check_is_username_unique', "This username already exists. Please choose another.");
			return False;
		}
		else {
			return True;
		}
	}
	
	function load_acct_data($aid) {
		// Code cleanup. Move the loading of all account data information to a separate function to condense code.
		$data['acct_data'] = $this->accountmodel->get_acct_details($aid);
		$data['reg_data'] = $this->accountmodel->get_reg_details($aid);
		$data['char_list'] = $this->accountmodel->get_char_list($aid);
		$data['acct_notes'] = $this->accountmodel->get_acct_notes($aid);
		foreach ($data['acct_notes'] as $noteid=>$v) {
			$data['acct_notes'][$noteid]['username'] = $this->adminmodel->get_admin_name($v['userid']);
		}
		$data['block_list'] = $this->accountmodel->get_block_hist($aid);
		foreach ($data['block_list'] as $blockid=>$v2) {
			$data['block_list'][$blockid]['blockname'] = $this->adminmodel->get_admin_name($v2['block_user']);
			if ($v2['unblock_user'] != NULL) {
				$data['block_list'][$blockid]['ublockname'] = $this->adminmodel->get_admin_name($v2['unblock_user']);
			}
			else { 
				$data['block_list'][$blockid]['ublockname'] = "n/a";
			}
		}
		$data['num_key_list'] = $this->accountmodel->get_num_key_list($aid);
		$data['str_key_list'] = $this->accountmodel->get_str_key_list($aid);
		$data['chg_acct_list'] = $this->accountmodel->get_acct_changes($aid);
		foreach ($data['chg_acct_list'] as $chgid=>$v3) {
			$data['chg_acct_list'][$chgid]['username'] = $this->adminmodel->get_admin_name($v3['user']);
		}
		$data['storage_items'] = $this->accountmodel->get_storage_items($aid);
		return $data;
	}
	
	function check_card($cardid) {
		$result = $this->itemmodel->check_if_card($cardid);
		if ($result == false) {
			$this->form_validation->set_message('check_card', "The ID you entered for a card is not a valid ID");
			return false;
		}
		else {
			return true;
		}
	}
	
	function check_str_flag($flagname) {
		$this->db_login->select('key');
		$q = $this->db_login->get_where('acc_reg_str_db', array('key' => $flagname));
		if ($q->num_rows() > 0) {
			$this->form_validation->set_message('check_str_flag', "This key already exists. Please choose another.");
			return False;
		}
		else {
			return True;
		}
	}
	
	function check_num_flag($flagname) {
		$this->db_login->select('key');
		$q = $this->db_login->get_where('acc_reg_num_db', array('key' => $flagname));
		if ($q->num_rows() > 0) {
			$this->form_validation->set_message('check_num_flag', "This key already exists. Please choose another.");
			return False;
		}
		else {
			return True;
		}
	}
}