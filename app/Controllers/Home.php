<?php namespace App\Controllers;

class Home extends BaseController {

	public function index() {
		$headData = array(
			'pageTitle'		=> 'HercAdminTool :: Dashboard',
			'panelName'		=> 'HercAdminTool',
			'userName'		=> 'admin',
		);
		echo view('head', $headData);
		echo view('sidenav', $headData);
		echo view('dashboard/index');
		echo view('footer');
	}

	//--------------------------------------------------------------------

}
