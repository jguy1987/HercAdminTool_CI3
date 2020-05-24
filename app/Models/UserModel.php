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

  public function logout($sessionData) {
    // Do nothing for now
  }

  public function getSettings($userID) {
    // Retrieve user information and return an array.
    $dbConn = \Config\Database::connect('hat');
    $db = $dbConn->table('users');
    $sql = $db->select('userID,userName,userEmail,userAcctID,userGroupID')->getWhere(['userID' => $userID]);
    return $sql->getRowArray();
  }

  public function getGroupName($gID) {
    // Translates Group ID into Group name
    $dbConn = \Config\Database::connect('hat');
    $db = $dbConn->table('groups');
    $sql = $db->select('groupName')->getWhere(['groupID' => $gID]);
    return $sql->getRowArray()['groupName'];
  }

  public function changeSettings($data) {
    // Changes the user settings based on the submitted data.
    $dbConn = \Config\Database::connect('hat');
    $db = $dbConn->table('users');
    if (!empty($data['newUserPass'])) {
      $data['userPass'] = password_hash($data['newUserPass'], PASSWORD_DEFAULT);
    }
    unset($data['newUserPass']);
    $db->set($data);
    $db->where('userID', $data['userID']);
    $db->update();
    return True;
  }
}
