<?php namespace App\Controllers;

class Admin extends BaseController {

	public function users() {
    $headData = array(
      'pageTitle'		=> 'HercAdminTool :: List Admins',
      'panelName'		=> 'HercAdminTool',
      'userName'		=> $this->session->get('userName'),
    );
    $pageData = array();
    echo view('head', $headData);
    echo view('sidenav', $headData);
    if ($this->hatPerms->viewAdmins == True) {
      // Load Models
  		$adminModel = new \App\Models\AdminModel();
			$pageData['addAdmin'] = $this->hatPerms->addAdmin;
      // Get the list of users.
      $pageData['users'] = $adminModel->listUsers();
  		echo view('admin/listusers', $pageData);
    }
    else {
      $pageData['page'] = "permFail";
      echo view('error',$pageData);
    }
		echo view('footer');
	}

  public function addadmin() {
    $headData = array(
      'pageTitle'		=> 'HercAdminTool :: Add Admin',
      'panelName'		=> 'HercAdminTool',
      'userName'		=> $this->session->get('userName'),
    );
    $pageData = array();
    echo view('head', $headData);
    echo view('sidenav', $headData);
    // Check user permissions
    if ($this->hatPerms->addAdmin == True) {
      // Load Models
  		$adminModel = new \App\Models\AdminModel();
      $pageData['groupList'] = $adminModel->listGroups();
  		echo view('admin/addadmin', $pageData);
    }
    else {
      $pageData['page'] = "permFail";
      echo view('error',$pageData);
    }
		echo view('footer');
  }

  public function verifyaddadmin() {
    // Load Models
    $adminModel = new \App\Models\AdminModel();
    $hatModel = new \App\Models\HatModel();
    $userModel = new \App\Models\UserModel();
    $newEmail = \Config\Services::email();
    $emailConfig = config('Email');
    //$hatConfig = config('Hat');
    $appConfig = config('App');

    $headData = array(
      'pageTitle'		=> 'HercAdminTool :: Add Admin',
      'panelName'		=> 'HercAdminTool',
      'userName'		=> $this->session->get('userName'),
    );
    $pageData = array();
    echo view('head', $headData);
    echo view('sidenav', $headData);
    // Verify all fields were completed
    $val = $this->validate([
      'userName'   => 'required',
      'userEmail'  => 'required|valid_email',
    ]);
    if (!$val) {
      $pageData += array(
        'pageTitle' => 'HercAdminTool :: Add Admin',
        'validation' => $this->validator,
      );
      echo view('admin/addadmin', $pageData);
    }
    else {
      // Generate a new password for the user.
      $modelData = array(
        'userName' => $this->request->getVar('userName'),
        'userEmail' => $this->request->getVar('userEmail'),
        'userGroupID' => $this->request->getVar('selectGroup'),
        'userDisableLogin' => 1,
      );
      $modelData['newPass'] = $hatModel->randString($hatModel->getSetting("newUserPassLength"),"pwd");
      // Add user.
      if ($adminModel->addAdmin($modelData) == False) {
        $pageData['page'] = "addadmindb";
        echo view('fail',$pageData);
      }
      else {
        $groupName = $userModel->getGroupName($modelData['userGroupID']);
        // Prepare to send the email to the new user.
        $newEmail->setFrom($emailConfig->fromEmail, $this->hatConfig->panelName);
        $newEmail->setTo($modelData['userEmail']);
        $newEmail->setSubject('Welcome to '.$this->hatConfig->panelName.' on '.$this->hatConfig->serverName);
        $body = "<html><body>
        Welcome to ".$this->hatConfig->panelName." on ".$this->hatConfig->serverName.", ".$modelData['userName']."!
        <br />
        You have been added as a new user of the administration panel. This gives you access to perform your job as a ".$groupName." of this server.
        <br />
        Your login details are below:<br />
        <strong>Username:</strong>&nbsp;".$modelData['userName']."<br />
        <strong>Password:</strong>&nbsp;".$modelData['newPass']."<br />
        <br />
        You may use the following link to access the administration panel: ".$appConfig->baseURL."<br />
        <br />
        Thanks,<br />
        The administration team on ".$this->hatConfig->serverName."</body></html>";
        $newEmail->setMessage($body);
        // Send the email
        if ($newEmail->send() == FALSE) {
          $pageData['page'] = "addadminemail";
          echo view('error',$pageData);
        }
        else {
          // Display a confirmation page to the user.
          $pageData['page'] = "addadmin";
          echo view('confirm',$pageData);
        }
      }
    }
    echo view('footer');
  }

	public function user($userID) {
		$headData = array(
      'pageTitle'		=> 'HercAdminTool :: Admin Details',
      'panelName'		=> 'HercAdminTool',
      'userName'		=> $this->session->get('userName'),
    );
    $pageData = array();
    echo view('head', $headData);
    echo view('sidenav', $headData);
    // Check user permissions
    if ($this->hatPerms->viewAdmins == True) {
			$adminModel = new \App\Models\AdminModel();
			$pageData['groupList'] = $adminModel->listGroups();
			if ($this->request->getVar('submit') == True) {
				// User wants to change something.
				$pageData += $adminModel->loadAdmin($userID);

				echo view('admin/user', $pageData);
			}
			else {
				$pageData += $adminModel->loadAdmin($userID);
				if ($pageData['userGroupID'] >= $this->session->get('userGroupID')) {
					$pageData['page'] = "editSameGroup";
					echo view('error', $pageData);
				}
				else {
					$pageData['loginLog'] = $adminModel->loadLoginLog($userID);
					echo view('admin/user', $pageData);
				}
			}
		}
		else {
			$pageData['page'] = "permFail";
      echo view('error',$pageData);
		}
		echo view('footer');
	}

	public function groups() {
		$headData = array(
      'pageTitle'		=> 'HercAdminTool :: List Groups',
      'panelName'		=> 'HercAdminTool',
      'userName'		=> $this->session->get('userName'),
    );
    $pageData = array();
    echo view('head', $headData);
    echo view('sidenav', $headData);
    if ($this->hatPerms->viewGroups == True) {
			// Load Models
  		$adminModel = new \App\Models\AdminModel();
			$pageData['addGroup'] = $this->hatPerms->addGroup;
      // Get the list of users.
      $pageData['groups'] = $adminModel->listGroups();
  		echo view('admin/listgroups', $pageData);
    }
    else {
      $pageData['page'] = "permFail";
      echo view('error',$pageData);
    }
		echo view('footer');
	}

	public function group($groupID) {
		$headData = array(
      'pageTitle'		=> 'HercAdminTool :: Group Details',
      'panelName'		=> 'HercAdminTool',
      'userName'		=> $this->session->get('userName'),
    );
    $pageData = array();
    echo view('head', $headData);
    echo view('sidenav', $headData);
    // Check user permissions
    if ($this->hatPerms->viewGroups == True) {
			$adminModel = new \App\Models\AdminModel();
			$hatModel = new \App\Models\HatModel();
			$pageData['userGroupID'] = $this->session->get('userGroupID');
			$pageData['editGroup'] = $this->hatPerms->editGroup;
			if ($this->request->getVar('submit') == True) {
				// User wants to change something.
				$val = $this->validate([
		      'groupName'   => 'required',
		      'groupID'  => 'required|is_numeric',
		    ]);
				if (!$val) {
		      $pageData += array(
		        'validation' => $this->validator,
		      );
		      echo view('admin/group', $pageData);
		    }
		    else {
					$modelData = array(
						'groupName' => $this->request->getVar('groupName'),
						'groupID' 	=> $this->request->getVar('groupID'),
						'perms'			=> $this->request->getVar('perm'),
					);
					$adminModel->editGroup($modelData);
					$pageData['changeConfirm'] = TRUE;
					$pageData['grpInfo'] = $adminModel->loadGroup($groupID);
					$pageData['perms'] = $hatModel->loadPerms();
					echo view('admin/group', $pageData);
				}
			}
			else {
				$pageData['grpInfo'] = $adminModel->loadGroup($groupID);
				$pageData['perms'] = $hatModel->loadPerms();
				echo view('admin/group', $pageData);
			}
		}
		else {
			$pageData['page'] = "permFail";
      echo view('error',$pageData);
		}
		echo view('footer');
	}
}
