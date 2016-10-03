<?php
Class Bugmodel extends CI_Model {	
	
	function list_bugs() {
		$this->db_hat->select('*, hat_users.username AS starter_name, hat_users.id AS userid');
		$this->db_hat->from('hat_bugs')->order_by('hat_bugs.bug_id','asc');
		$this->db_hat->join('hat_users', 'hat_bugs.starter = hat_users.id');
		$query = $this->db_hat->get();
		return $query->result_array();
	}
	
	function newbug_add($newBug) {
		// Get current date/time
		$timeNow = date("Y-m-d H:i:s");
		
		$this->db_hat->set($newBug);
		$this->db_hat->set('startdate', $timeNow);
		$this->db_hat->set('starter', $this->session_data['id']);
		$this->db_hat->insert('hat_bugs');
		
		// Get the last entry so we can insert logs.
		$this->db_hat->select('*');
		$this->db_hat->where('startdate', $timeNow);
		$this->db_hat->where('title', $newBug['title']);
		$log_query = $this->db_hat->get('hat_bugs');
		
		foreach ($log_query->result() as $result) {
			$bugid = $result->bug_id;
		}
		
		// Insert logs
		$this->db_hat->set('bug_id', $bugid);
		$this->db_hat->set('datetime', $timeNow);
		$this->db_hat->set('action_type', "Open Bug");
		$this->db_hat->set('userid', $this->session_data['id']);
		$this->db_hat->insert('hat_bughistory');
	}
	
	function get_bug_details($bid) {
		$this->db_hat->select('hat_bugs.*, hat_users.username AS starter_name, hat_users.id AS userid');
		$this->db_hat->from('hat_bugs');
		$this->db_hat->where('hat_bugs.bug_id', $bid);
		$this->db_hat->join('hat_users', 'hat_bugs.starter = hat_users.id');
		$query = $this->db_hat->get();
		return $query->row();
	}
	
	function get_bug_history($bid) {
		$query = $this->db_hat->get_where('hat_bughistory', array('bug_id' => $bid));
		return $query->result_array();
	}
	
	function get_bug_comments($bid) {
		$query = $this->db_hat->get_where('hat_bugcomments', array('bug_id' => $bid));
		return $query->result_array();
	}
	
	function sort_hist_comments($h, $c) {
		$field = "datetime";
		// Tell each associative array what they coorespond to (either comment or history entry) by appending to each array.
		foreach ($h as $kh=>$vh) {
			$h[$kh]['type'] = "history";
		}
		foreach ($c as $kc=>$vc) {
			$c[$kc]['type'] = "comment";
		}
		// Join the two arrays.
		$arr = array();
		$arr = array_merge($h, $c);
		
		// Sort the new array
		usort($arr, array($this, "date_compare"));
		return $arr;
	}
	
	function date_compare($a, $b) {
		$t1 = strtotime($a['datetime']);
		$t2 = strtotime($b['datetime']);
		return $t1 - $t2;
	}
	
	function add_bug_comment($newComment) {
		// Get current date/time
		$timeNow = date("Y-m-d H:i:s");
		
		$this->db_hat->set($newComment);
		$this->db_hat->set('datetime', $timeNow);
		$this->db_hat->insert('hat_bugcomments');
	}
	
	function edit_bug($chgBug) {
		// Get current date/time
		$timeNow = date("Y-m-d H:i:s");
		
		// First, get the current bug info.
		$this->db_hat->select('*');
		$q = $this->db_hat->get_where('hat_bugs', array('bug_id' => $chgBug['bug_id']));
		$chgRec = $q->row();
		
		foreach ($chgBug as $k=>$v) {
			if ($k == "userid" || $k == "bug_id") {
			}
			else {
				if ($chgRec->$k != $v) {
					switch ($k) {
						case "status":
							$action_id = 1;
							break;
						case "assigned":
							$action_id = 2;
							break;
						case "priority":
							$action_id = 3;
							break;
						case "category":
							$action_id = 4;
							break;
						case "resolution":
							$action_id = 5;
							break;
						case "title":
							$action_id = 6;
							break;
					}
					$this->db_hat->set('datetime', $timeNow);
					$this->db_hat->set('userid', $chgBug['userid']);
					$this->db_hat->set('bug_id', $chgBug['bug_id']);
					$this->db_hat->set('action_type', $action_id);
					$this->db_hat->set('old_value', $chgRec->$k);
					$this->db_hat->set('new_value', $v);
					$this->db_hat->insert('hat_bughistory');
					$this->db->flush_cache();
				}
			}
		}
		//$this->db->flush_cache();
		$this->db_hat->where('bug_id', $chgBug['bug_id']);
		unset($chgBug['userid'], $chgBug['bug_id']);
		$this->db_hat->set($chgBug);
		$this->db_hat->update('hat_bugs');
	}
}