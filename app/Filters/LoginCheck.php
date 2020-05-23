<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginCheck implements FilterInterface {

  public function before(RequestInterface $request) {
    $session = \Config\Services::session();
    if (is_null($session->get('loggedin')))  {
      return redirect()->to(base_url('user/login'));
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response) {
    // Do nothing yet
  }
}
