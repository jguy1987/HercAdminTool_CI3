<?php namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model {

  public function listUsers() {
    $dbConn = \Config\Database::connect('hat');
    $db = $dbConn->table('users');
    $db->select('userID,userName,userEmail,userLastLogin,userDisableLogin');
    $sql = $db->get();
    return $sql->getResultArray();
  }

  public function listGroups() {
    $dbConn = \Config\Database::connect('hat');
    $db = $dbConn->table('groups');
    $db->select('groupID,groupName');
    $sql = $db->get();
    return $sql->getResultArray();
  }

  public function addAdmin($data) {
    $dbConn = \Config\Database::connect('hat');
    $db = $dbConn->table('users');
    // Secure new password.
    $newPass = password_hash($data['newPass'], PASSWORD_DEFAULT);
    $data['userPass'] = $newPass;
    unset($data['newPass']);
    if ($db->insert($data)) {
      return True;
    } else {
      return False;
    }
  }
}
