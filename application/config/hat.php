<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Hercules Admin Tool main configuration file.
 Here is where most of the user settable settings reside. 
 You will probably have to change everything here. */
 

/* Basic settings. Set things such as names, standard server rates, and some behavior settings here */


// Panel name. Default: "HercAdminTool". You can change this to anything.
$config['panelname'] = "HercAdminTool";

// Server Name. 
$config['servername'] = "YourRO";



/* Email Settings. Settings for email here. */

// Email From. The email address from where mail will originate.
$config['emailfrom'] = "adminpanel@yourdomain.com";

// Protocol. The mail sending protocol. Valid options: mail, sendmail, or smtp
$config['protocol'] = 'sendmail';

// Email path. The server path to Sendmail. Only valid when 'protocol' set to 'sendmail'.
$config['mailpath'] = '/usr/sbin/sendmail';

// Email charset. Character set (utf-8, iso-8859-1, etc.). Default utf-8.
$config['charset'] = 'utf-8';

// Email Wordwrap. Wrap text every 'wrapchars' characters. Default is TRUE. Boolean value.
$config['wordwrap'] = TRUE;

// Wrapchars. Wrap emails every X chars. Only valid if above set to "TRUE". Default: 76.
$config['wrapchars'] = 76;

// smtp_host. The hostname for your SMTP server. only valid if protocol is set to 'smtp'.
$config['smtp_host'] = ''; 

// smtp_user. Username to connect to SMTP server. only valid if protocol is set to 'smtp'.
$config['smtp_user'] = '';

// smtp_pass. Password to connect to SMTP server. only valid if protocol is set to 'smtp'.
$config['smtp_pass'] = '';

// smtp_port. Port number to connect to SMTP Server. Default 25. Only valid if protocol is set to 'smtp'.
$config['smtp_port'] = 25;