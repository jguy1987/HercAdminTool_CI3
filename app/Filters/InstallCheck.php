<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class InstallCheck implements FilterInterface {

  public function before(RequestInterface $request) {
    if (file_exists(ROOTPATH.'INSTALL'))  {
      // Need to do an inital copy over of the env file so stuff loads properly.
      copy(ROOTPATH."env", ROOTPATH.".env");
      $actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
      return redirect()->to($actualLink.'/install/index');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response) {
    // Do nothing yet
  }
}
