<?php namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model {

  protected $DBGroup = 'hat';

  public function listUsers() {
    $sql = $this->db->table('users');
    $sql->select('userID,userName,userEmail,userLastLogin,userDisableLogin');
    $query = $sql->get();
    return $query->getResultArray();
  }

  public function listGroups() {
    $sql = $this->db->table('groups');
    $sql->select('groupID,groupName');
    $query = $sql->get();
    return $query->getResultArray();
  }

  public function addAdmin($data) {
    $sql = $this->db->table('users');
    // Secure new password.
    $newPass = password_hash($data['newPass'], PASSWORD_DEFAULT);
    $data['userPass'] = $newPass;
    unset($data['newPass']);
    if ($sql->insert($data)) {
      return True;
    } else {
      return False;
    }
  }

  public function loadAdmin($userID) {
    $sql = $this->db->table('users');
    $sql->select('*');
    $query = $sql->getWhere(['userID' => $userID]);
    return $query->getRowArray();
  }

  public function loadLoginLog($userID) {
    $sql = $this->db->table('loginlog');
    $sql->select('*');
    $sql->limit(5)->orderBy('loginTime', 'DESC');
    $query = $sql->getWhere(['userID' => $userID]);
    return $query->getResultArray();
  }
}
