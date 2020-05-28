<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

  protected $DBGroup = 'hat';

  public function verifyLogin($data) {
    $sql = $this->db->table('users');
    $query = $sql->select('*')->getWhere(['userName' => $data['userName']]);
    $result = $query->getRowArray();
    if ($sql->countAllResults() > 0) {
      $pwMatch = password_verify($data['userPass'], $result['userPass']);
      if ($pwMatch == True) {
        if ($result['userDisableLogin'] == 0) {
          return $result;
        }
        else {
          return 2;
        }
      }
      else {
        return 3;
      }
    }
    else {
      return 3;
    }
  }

  public function logout($sessionData) {
    // Do nothing for now
  }

  public function getSettings($userID) {
    // Retrieve user information and return an array.
    $sql = $this->db->table('users');
    $query = $sql->select('userID,userName,userEmail,userAcctID,userGroupID')->getWhere(['userID' => $userID]);
    return $query->getRowArray();
  }

  public function getGroupName($gID) {
    // Translates Group ID into Group name
    $sql = $this->db->table('groups');
    $query = $sql->select('groupName')->getWhere(['groupID' => $gID]);
    return $query->getRowArray()['groupName'];
  }

  public function changeSettings($data) {
    // Changes the user settings based on the submitted data.
    $sql = $this->db->table('users');
    if (!empty($data['newUserPass'])) {
      $data['userPass'] = password_hash($data['newUserPass'], PASSWORD_DEFAULT);
    }
    unset($data['newUserPass']);
    $sql->set($data);
    $sql->where('userID', $data['userID']);
    $sql->update();
    return True;
  }

  public function updateLastLogin($userID) {
    $sql = $this->db->table('users');
    $lastLogin = date("Y-m-d");
    $sql->set('userLastLogin', $lastLogin);
    $sql->where('userID', $userID);
    $sql->update();
  }

  public function updateLoginLog($userID, $loginIP) {
    $sql = $this->db->table('loginlog');
    $lastLogin = date("Y-m-d H:i:s");
    $sql->set('loginTime', $lastLogin);
    $sql->set('loginIP', $loginIP);
    $sql->set('userID', $userID);
    $sql->insert();
  }
}
