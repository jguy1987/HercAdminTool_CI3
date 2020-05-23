<?php namespace App\Models;

use CodeIgniter\Model;

class InstallModel extends Model {

  public function addEnv($t, $p, $d) {
    // $t = type (app, database.xxx, etc), $p = Parameter (siteURL, etc), $d = the setting.
    $path = ROOTPATH."env";
    if (!file_put_contents($path, "\r\n$t.$p = '$d'", FILE_APPEND)) {
      return 0; // Fail
    }
    else {
      // Copy to .env so that the installer can use the values immediately.
      return 1;
    }
  }

  public function tryDB($db) {
    // $db = an array of database connection values.
    $conn = new \MySQLi($db['hostname'], $db['username'], $db['password'], $db['database'], $db['port']);
    if ($conn->connect_errno) {
      return 0; // Connect failed.
    }
    else {
      return 1; // Connect success.
    }
  }

  public function addHATTables($db) {
    $dbHat = \Config\Database::connect($db);
    $query = '';
    $dbPrefix = $dbHat->getPrefix();
    $sqlFile = file(ROOTPATH."docs/hat_db.sql");
    $sqlFields = file(ROOTPATH."docs/hatFields.txt",FILE_IGNORE_NEW_LINES);

    foreach ($sqlFile as $line) {
      $startWith = substr(trim($line), 0, 2);
      $endWith = substr(trim($line), -1 ,1);
	    if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
		      continue;
      }
      foreach ($sqlFields as $field) {
        $line = str_replace($field, $dbPrefix.$field, $line);
      }
	    $query = $query . $line;
	    if ($endWith == ';') {
        $dbHat->query($query);
		    //mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
		    $query= '';
	    }
    }
  }

  public function addUser($data, $dbHat) {
    $sqlConn = \Config\Database::connect($dbHat);
    $keyval = substr(str_shuffle("01234567890qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM"), 0, 32);
    $this->addEnv("encryption", "key", $keyval);
    $sql = $sqlConn->table('users');
    // Encrypt and salt the user password.
    $newPass = password_hash($data['userPass'], PASSWORD_DEFAULT);
    $data['userPass'] = $newPass;
    $sql->insert($data);
    return;
  }

  public function finishInstall() {
    // Remove some files, copy over the .env file, make sure there are no errors.
    unlink(ROOTPATH."INSTALL"); // Remove INSTALL file
    $path = ROOTPATH."env";
    $newPath = ROOTPATH.".env";
    $lines = file($path);
    foreach ($lines as $k=>$l) {
      if ($l == "CI_ENVIRONMENT = development") {
        $lines[$k] = "CI_ENVIRONMENT = production";
      }
    }
    $lines = array_unique($lines); // Remove any exact duplicate lines from the env file.
    file_put_contents($path, implode($lines));
    if (!copy($path, $newPath)) {
      // File copy to .env failed.
      return 0;
    }
    else {
      return 1; // success
    }
  }
}
