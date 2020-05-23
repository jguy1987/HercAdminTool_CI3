<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

  public function verifyLogin($data) {
    $dbConn = \Config\Database::connect('hat');
    $db = $dbConn->table('users');
    $sql = $db->select('*')->getWhere(['userName' => $data['userName']]);
    $result = $sql->getRowArray();
    if ($db->countAllResults() > 0) {
      $pwMatch = password_verify($data['userPass'], $result['userPass']);
      if ($pwMatch == True) {
        return $result;
      }
      else {
        return False;
      }
    }
    else {
      return False;
    }
  }
}
