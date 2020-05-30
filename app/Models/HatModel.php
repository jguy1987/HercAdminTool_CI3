<?php namespace App\Models;

use CodeIgniter\Model;

class HatModel extends Model {

// Just a general function collection, password generators, settings catchers and other odds and ends.

  public function randString($length,$type) {
    // type can be:
    // pwd = Typical for a password, numbers, letters, symbols.
    // alphanum = Normal random string, no symbols.
    // alpha = Letters only, caps and no caps
    // caps = Capital letters only.

    $newStr = '';
    switch($type) {
      case "pwd":
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&";
        break;
      case "alphanum":
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        break;
      case "alpha":
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        break;
      case "caps":
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        break;
    }
    for ($i = 0; $i < $length; $i++) {
			$newStr .= $chars[rand(0, strlen($chars) - 1)];
		}
    return $newStr;
  }

  public function getSetting($name) {
    $dbConn = \Config\Database::connect('hat');
    $db = $dbConn->table('settings');
    $sql = $db->select('settingValue')->getWhere(['settingName' => $name]);
    $row = $sql->getRow();
    return $row->settingValue;
  }

  public function checkPerms($groupID) {
    $dbConn = \Config\Database::connect('hat');
    $db = $dbConn->table('groups');
    $sql = $db->select('*')->getWhere(['groupID' => $groupID]);
    return $sql->getRow();
  }

  public function loadPerms() {
    $permReturn = parse_ini_file(ROOTPATH.'/docs/permissions.ini', true);
    return $permReturn;
  }
}
