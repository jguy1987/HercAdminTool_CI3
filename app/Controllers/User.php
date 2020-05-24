<?php namespace App\Controllers;

class User extends BaseController {

	public function settings() {
		// Load Models
		$userModel = new \App\Models\UserModel();

		$headData = array(
			'pageTitle'		=> $this->hatConfig->panelName.':: User Settings',
			'panelName'		=> $this->hatConfig->panelName,
			'userName'		=> $this->session->get('userName'),
		);
		$pageData = $userModel->getSettings($this->session->get('userID'));
		$pageData['groupName'] = $userModel->getGroupName($pageData['userGroupID']);
		echo view('head', $headData);
		echo view('sidenav', $headData);
		if ($this->request->getVar('submit') == True) {
			// the user submitted the form to change something
			// Verify that the user filled out the "Password" field correctly.
			$val = $this->validate([
	      'userPass'  => [
					'rules'	=> 'required',
					'errors' => [
						'required' => 'You must enter your current password to make changes on this screen.',
					]
				],
				'userEmail' 	=> [
					'rules' => 'required|valid_email',
					'errors' => [
						'required|valid_email' => 'Your email address must be valid.',
					]
				],
	    ]);
			// If the New password field is filled out, it must match the verify password field.
			$passVerify = True;
			if (empty($this->request->getVar('newUserPass')) == False) {
				if ($this->request->getVar('newUserPass') != $this->request->getVar('newUserPassVerify')) {
					// The new pass and verify pass fields do not match. Error.
					$passVerify = False;
				}
			}
			if (!$val || $passVerify == False) {
	      // Validation failed.
				if (!$val) {
					$pageData['validation'] = $this->validator;
				}
				if ($passVerify == False) {
					$pageData['verifyPass'] = False;
				}
	      echo view('user/settings', $pageData);
	    }
			else {
				// Verify the user's password is correct. We can use existing verifyLogin model function to do this
				// as long as we pass it the userName from the session.
				$modelData = array(
					'userName' => $this->session->get('userName'),
					'userPass' => $this->request->getVar('userPass'),
					'userID'	=> $this->session->get('userID'),
				);
				$result = $userModel->verifyLogin($modelData);
				if ($result == False) {
					// Password is not correct.
					$pageData['pwError'] = True;
					echo view('user/settings', $pageData);
				}
				else {
					// Password correct.
					// Basically send the form's current information to the model to change in the database.
					$modelData['userEmail'] = $this->request->getVar('userEmail');
					if (empty($this->request->getVar('newUserPass')) == False) {
						// User also wants to change their password, send it to the models
						$modelData['newUserPass'] = $this->request->getVar('newUserPass');
					}
					else {
						$modelData['newUserPass'] = $this->request->getVar('userPass');
					}
					if ($userModel->changeSettings($modelData) == TRUE) {
						// Success
						$pageData = $userModel->getSettings($this->session->get('userID'));
						$pageData['changeConfirm'] = TRUE;
						$pageData['groupName'] = $userModel->getGroupName($pageData['userGroupID']);
						echo view('user/settings', $pageData);
					}
					else {
						$pageData['changeConfirm'] = FALSE;
						echo view('user/settings', $pageData);
					}
				}
			}
		}
		else {
			// The user is just here to view.
			// Get the settings for the user.
			echo view('user/settings', $pageData);
		}
		echo view('footer');
  }

  public function login() {
		// Load Models


    if (empty($this->session->get('loggedin')))  {
      // This user is logged in, there's no need for them to access this page.
      // User is logged in, redirect to dashboard.
      $pageData = array(
        'pageTitle' => $this->hatConfig->panelName.' :: Login',
        'siteName'  => $this->hatConfig->panelName,
      );
      echo view('user/login', $pageData);
    }
    else {
      return redirect()->to(base_url('home/index'));
    }
  }

  public function verifylogin() {
		// Load models
		$userModel = new \App\Models\UserModel();

		$pageData = array(
			'pageTitle' => $this->hatConfig->panelName.' :: Login',
			'siteName'  => $this->hatConfig->panelName,
		);
    // Verify the data.
		$val = $this->validate([
      'userName'   => 'required',
      'userPass'  => 'required',
    ]);
    if (!$val) {
      // Validation failed.
      $pageData += array(
        'validation' => $this->validator,
      );
      echo view('user/login', $pageData);
      die();
    }
		else {
			$modelData = array(
				'userName' 	=> $this->request->getVar('userName'),
				'userPass'	=> $this->request->getVar('userPass'),
			);
			$result = $userModel->verifyLogin($modelData);
			if ($result == False) {
				$pageData += array(
					'loginError' => True,
				);
				echo view('user/login', $pageData);
				die();
			}
			else {
				$this->session->set('loggedin', True);
				$this->session->set('userName', $result['userName']);
				$this->session->set('userGroupID', $result['userGroupID']);
				$this->session->set('userID', $result['userID']);
				// User logged in. Direct to a temp page that simply redirects to dashboard.
				echo view('user/verifylogin', $pageData);
			}
		}
  }

	public function logout() {
		// Load models
		$userModel = new \App\Models\UserModel();

		$pageData = array(
			'pageTitle'		=> 'HercAdminTool :: Logout',
			'panelName'		=> 'HercAdminTool',
		);
		$userModel->logout($this->session->get());
		// Destroy the session
		$this->session->destroy();
		echo view('user/logout', $pageData);
	}
}
