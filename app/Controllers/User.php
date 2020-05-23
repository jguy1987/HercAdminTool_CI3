<?php namespace App\Controllers;

class User extends BaseController {

	public function settings() {

  }

  public function login() {
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
}
