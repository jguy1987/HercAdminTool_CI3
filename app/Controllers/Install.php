<?php namespace App\Controllers;

class Install extends BaseController {

	public $hatSql;

	public function index() {
    $pageData = array(
      'pageTitle' => 'HercAdminTool :: Install',
    );
    echo view('install/step1', $pageData);
  }

  public function step2() {
    // Process the site basics, then ask for database details.
    $installModel = new \App\Models\InstallModel();
    $val = $this->validate([
      'panelName'   => 'required',
      'serverName'  => 'required',
    ]);
    $pageData = array(
      'pageTitle' => 'HercAdminTool :: Install - Step 2',
    );
    if (!$val) {
      // Validation failed.
      $pageData = array(
        'pageTitle' => 'HercAdminTool :: Install',
        'validation' => $this->validator,
      );
      echo view('install/step1', $pageData);
      die();
    }
    else {
      // Valid data. Process in env file.
      $modelData = array(
        'panelName' => $this->request->getVar('panelName'),
        'serverName' => $this->request->getVar('serverName'),
      );
      $err = FALSE;
      foreach ($modelData as $k => $v) {
        $result = $installModel->addEnv("app", $k, $v);
        if ($result == 0) {
          $err = TRUE;
          break;
        }
      }
      if ($err == TRUE) {
        // One of the file_put_contents failed.
        $pageData = array(
          'fileError' => TRUE,
          'pageTitle' => 'HercAdminTool :: Install',
        );
        echo view('install/step1', $pageData);
      }
      else {
        // The file put was successful, Display the next step.
        echo view('install/step2', $pageData);
      }
    }
  }

  public function step3() {
    // Process database details, then ask for mail details.
    $installModel = new \App\Models\InstallModel();
    $val = $this->validate([
      'sqlHost' => 'required',
      'sqlUser' => 'required',
      'sqlPwd' => 'required',
      'sqlName' => 'required',
      'sqlPort' => 'required|is_numeric',
    ]);
    $pageData = array(
      'pageTitle' => 'HercAdminTool :: Install - Step 3',
    );
    if (!$val) {
      // Data validation failed.
      $pageData = array(
        'pageTitle' => 'HercAdminTool :: Install - Step 2',
        'validation' => $this->validator,
      );
      echo view('install/step2', $pageData);
      die();
    }
    else {
      // Valid data. Process in env file.
      $modelData = array(
        'hostname' => $this->request->getVar('sqlHost'),
        'username' => $this->request->getVar('sqlUser'),
        'password' => $this->request->getVar('sqlPwd'),
        'database' => $this->request->getVar('sqlName'),
        'port' => $this->request->getVar('sqlPort'),
        'DBPrefix' => $this->request->getVar('sqlPrefix'),
				'DBDriver' => 'MySQLi',
      );
      // Try to connect to this database.
      $sql_result = $installModel->tryDB($modelData);
      if ($sql_result == 0) {
        $pageData = array(
          'sqlerror' => TRUE,
        );
        $err = TRUE;
      }
      $err = FALSE;
      foreach ($modelData as $k => $v) {
        $result = $installModel->addEnv("database.hat", $k, $v);
        if ($result == 0) {
          $pageData = array(
            'fileError' => TRUE,
          );
          $err = TRUE;
          break;
        }
      }
			$installModel->addHATTables($modelData);

      if ($err == TRUE) {
        // One of the file put contents failed.
        $pageData = array(
          'pageTitle' => 'HercAdminTool :: Install Step 2',
        );
        echo view('install/step2', $pageData);
        }
      else {
				//$pageData['sql'] = $modelData;
				$session = \Config\Services::session();
				$this->session->set('hatSql', $modelData);
        echo view('install/step3', $pageData);
      }
    }
  }

	public function step4() {
		$installModel = new \App\Models\InstallModel();
		$val = $this->validate([
			'username' => 'required',
			'password' => 'required',
			'email'		 => 'required|valid_email'
		]);
		$pageData = array(
      'pageTitle' => 'HercAdminTool :: Install - Finished',
    );
		if (!$val) {
      // Data validation failed.
      $pageData = array(
        'pageTitle' => 'HercAdminTool :: Install - Step 4',
        'validation' => $this->validator,
      );
      echo view('install/step4', $pageData);
      die();
    }
		else {
			$modelData = array(
				'userName' => $this->request->getVar('username'),
				'userPass' => $this->request->getVar('password'),
				'userEmail'		 => $this->request->getVar('email'),
				'userGroupID'		=> 99,
			);
			$installModel->addUser($modelData, $this->session->get('hatSql'));
			echo view('/install/step4', $pageData);
		}

	}

	public function finish() {
		// Process mail settings, then ask for initial user.
		$installModel = new \App\Models\InstallModel();
    $val = $this->validate([
      'fromEmail' => 'required|valid_email',
      'sendmailPath' => 'required',
      'smtpHost' => 'required',
      //'smtpUser' => 'required', // SMTP User may not always be required.
      //'smtpPass' => 'required', // SMTP Pass may not always be required.
			'smtpPort' => 'required|is_numeric',
    ]);
		$pageData = array(
      'pageTitle' => 'HercAdminTool :: Install - Step 4',
    );
		if (!$val) {
      // Data validation failed.
      $pageData = array(
        'pageTitle' => 'HercAdminTool :: Install - Step 3',
        'validation' => $this->validator,
      );
      echo view('install/step4', $pageData);
      die();
    }
		else {
			// Valid data. Process in env file.
			$modelData = array(
				'fromEmail' => $this->request->getVar('fromEmail'),
				'protocol' => $this->request->getVar('mailProto'),
				'mailpath' => $this->request->getVar('sendmailPath'),
				'SMTPHost' => $this->request->getVar('smtpHost'),
				'SMTPUser' => $this->request->getVar('smtpUser'),
				'SMTPPass' => $this->request->getVar('smtpPass'),
				'SMTPPort' => $this->request->getVar('smtpPort'),
				'mailType' => 'html',
			);
			$err = '';
			foreach ($modelData as $k => $v) {
        $result = $installModel->addEnv("email", $k, $v);
        if ($result == 0) {
          $pageData = array(
            'fileError' => TRUE,
          );
          $err = TRUE;
          break;
        }
      }
			if ($err == TRUE) {
				// One of the file put contents failed.
				$pageData = array(
					'pageTitle' => 'HercAdminTool :: Install Step 3',
				);
				echo view('install/step4', $pageData);
				}
			else {
				echo view('install/finish', $pageData);
				$installModel->finishInstall();
			}
		}
	}
}
