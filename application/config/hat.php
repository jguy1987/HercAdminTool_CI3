<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Hercules Admin Tool main configuration file.
 Here is where most of the user settable settings reside. 
 You will probably have to change everything here. */

/* Basic settings. Set things such as names, standard server rates, and some behavior settings here */

// Panel name. Default: "HercAdminTool". You can change this to anything.
$config['panelname'] = "HercAdminTool";

// Server Name. 
$config['servername'] = "YourRO";

// Email From. The email address from where mail will originate.
$config['emailfrom'] = "adminpanel@yourdomain.com";

// Time to inactive. How long in minutes before we render an admin "inactive" and remove him from the active admin list (default 15 (minutes))
$config['inactive_time'] = 15;

// Full path to the root of your HAT installation (where the application, system and assets folders live). Include forward AND trailing slash! 
$config['hat_path'] = "/var/www/hat/"; 

// Server Setup. Follow the UserGuide!

// Allow HAT to try and connect to your SSH server and issue commands. 0 is disable (no SSH), 1 is enable. If you disable this then you cannot:
// * Issue commands against the running Hercules Server (broadcast, all atcommands, reloadbattleconf, reloadscripts, etc) will not be possible.
// * Start, stop and restart the Hercules server from the panel.
// * Issue git sync or svn up commands, or recompile the server from the panel.
$config['ssh_conn'] = 1;

$config['login_servers'] = array(
	'1' => array(		// Group ID of login servers. 
		'login_database_group'		=> "ragnarok",			// Connection group in database.php that holds the connection information for this login server.
		'login_ip'						=> "127.0.0.1",			// IP that the login server is listening on
		'login_port'					=> 6900,				// Port for this login server
		'login_ssh_ip'						=> "127.0.0.1",			// IP for SSH login
		'login_ssh_port'				=> 22,					// Port # for SSH connections to this server.
		'login_ssh_method'				=> "key",				// How to auth to the server? key = pub/private key, plain = plaintext user/pass
		'login_ssh_user'				=> "ragnarok",			// Username to connect to the SSH for the login server
		'login_ssh_pass'				=> "password",			// Password to connect to the SSH server if method = plain
		'login_ssh_pubkeyfile'			=> "/home/user/.ssh/id_rsa.pub",		// Your public SSH key path in your HAT installation for your remote server. NOTE this should NOT be in your web directory where hat is located!
		'login_ssh_prikeyfile'			=> "/home/user/.ssh/id_rsa", // Your private key path in your HAT installation for your remote server. NOTE this should NOT be in your web directory where hat is located!
		'login_server_path'				=> "/home/ragnarok",	// Path to the login server exec and files
		'login_server_exec'				=> "login-server",		// Login Server Executable
		'last_mac_addon'				=> "yes",				// Does your login table have a last_mac column (yes or no)?
		'login_update_method'			=> "disabled",			// Login server update method. 'disabled' = Disabled through CP, 'svn' = "Subversion Version control", 'git' = GIT Repository
	),
	/*'2' => array(		// Group ID of login servers. 
		'login_database_group'		=> "ragnarok_2",			// Connection group in database.php that holds the connection information for this login server.
		'login_ip'						=> "127.0.0.1",			// IP that the login server is listening on
		'login_port'					=> 6900,				// Port for this login server
		'login_ssh_ip'						=> "127.0.0.1",			// IP for SSH login
		'login_ssh_port'				=> 22,					// Port # for SSH connections to this server.
		'login_ssh_method'				=> "key",				// How to auth to the server? key = pub/private key, plain = plaintext user/pass
		'login_ssh_user'				=> "ragnarok",			// Username to connect to the SSH for the login server
		'login_ssh_pass'				=> "password",			// Password to connect to the SSH server if method = plain
		'login_ssh_pubkeyfile'			=> "/home/user/.ssh/id_rsa.pub",		// Your public SSH key path in your HAT installation for your remote server. NOTE this should NOT be in your web directory where hat is located!
		'login_ssh_prikeyfile'			=> "/home/user/.ssh/id_rsa", // Your private key path in your HAT installation for your remote server. NOTE this should NOT be in your web directory where hat is located!
		'login_server_path'				=> "/home/ragnarok",	// Path to the login server exec and files
		'login_server_exec'				=> "login-server",		// Login Server Executable
		'last_mac_addon'				=> "yes",				// Does your login table have a last_mac column (yes or no)?
		'login_update_method'			=> "disabled",			// Login server update method. 'disabled' = Disabled through CP, 'svn' = "Subversion Version control", 'git' = GIT Repository
	),*/
);
// Default server ID to direct logged in users to
$config['default_server_id'] = 1;

$config['ragnarok_servers'] = array(
	'1'	=> array(
		'servername'			=> "Server1",  		// Human readable server name. Will be selectable by the user.
		'map_servername'		=> "s1",					// The servername as in the login table and what you set in char_server.conf and map_server.conf
		'main_database_group'		=> "ragnarok",			// The database group in database.php config file that holds this database connection info for all char/map databases (less logs)
		'log_database_group'	=> "ragnarok_log",	// the database group that holds the log tables for this server.
		'server_ip'						=> "127.0.0.1",		// IP that the server is listening on
		'login_server_group'	=> 1,				// Login server group that this server listens for connections on.
		'char_port'				=> 6121,					// Character Server Port number for this server
		'map_port'				=> 5121,					// Map Server Port number for this server
		'server_ssh_ip'						=> "127.0.0.1",			// IP that the login server is listening on (also how we connect via SSH)
		'server_ssh_port'				=> 22,					// Port # for SSH connections to this server.
		'server_ssh_method'				=> "key",				// How to auth to the server? key = pub/private key, plain = plaintext user/pass
		'server_ssh_user'				=> "ragnarok",			// Username to connect to the SSH for the login server
		'server_ssh_pass'				=> "password",			// Password to connect to the SSH server if method = plain
		'server_ssh_pubkeyfile'			=> "/home/user/.ssh/id_rsa.pub",		// Your public SSH key path in your HAT installation for your remote server. NOTE this should NOT be in your web directory where hat is located!
		'server_ssh_prikeyfile'			=> "/home/user/.ssh/id_rsa", // Your private key path in your HAT installation for your remote server. NOTE this should NOT be in your web directory where hat is located!
		'server_path'			=> "/home/ragnarok/",	// Path to server files.
		'char_server_exec'	=> "char-server",		// Char server executable
		'map_server_exec'		=> "map-server",		// Map server executable
		'reset_map'				=> "prontera", 		// Map name to reset players to
		'reset_x'				=> "142",				// X coordinate to reset players to
		'reset_y'				=> "241",				// Y coordinate to reset players to
		'use_bugtracker'		=> "yes",			// Use the bugtracker for this server, yes or no?
		'showsysinfo'			=> "yes",				// Show system performance information on Dashboard (yes or no)? Note: Installation of some third party libraries required on server running Hercules. Consult the user guide.
		'charmap_update_method'	=> "disabled",			// Char/Map server update method. 'disabled' = Disabled through CP, 'svn' = "Subversion Version control", 'git' = GIT Repository
	),
	/*'2'	=> array(
		'servername'			=> "Server2",  		// Human readable server name. Will be selectable by the user.
		'map_servername'		=> "s2",					// The servername as in the login table and what you set in char_server.conf and map_server.conf
		'main_database_group'		=> "ragnarok2",		// The database group in database.php config file that holds this database connection info.
		'log_database_group'	=> "ragnarok_log",	// the database group that holds the log tables for this server.
		'server_ip'						=> "127.0.0.1",		// IP that the server is listening on
		'login_server_group'	=> 1,				// Login server group that this server listens for connections on.
		'char_port'				=> 6121,					// Character Port number for this server
		'map_port'				=> 5121,					// Map Port number for this server
		'server_ssh_ip'						=> "127.0.0.1",			// IP that the login server is listening on (also how we connect via SSH)
		'server_ssh_port'				=> 22,					// Port # for SSH connections to this server.
		'server_ssh_method'				=> "key",				// How to auth to the server? key = pub/private key, plain = plaintext user/pass
		'server_ssh_user'				=> "ragnarok",			// Username to connect to the SSH for the login server
		'server_ssh_pass'				=> "password",			// Password to connect to the SSH server if method = plain
		'server_ssh_pubkeyfile'			=> "/home/user/.ssh/id_rsa.pub",		// Your public SSH key path in your HAT installation for your remote server. NOTE this should NOT be in your web directory where hat is located!
		'server_ssh_prikeyfile'			=> "/home/user/.ssh/id_rsa", // Your private key path in your HAT installation for your remote server. NOTE this should NOT be in your web directory where hat is located!
		'server_path'			=> "/home/ragnarok/",	// Path to server files.
		'login_server_exec'	=> "login-server",	// Login server executable 
		'char_server_exec'	=> "char-server",		// Char server executable
		'map_server_exec'		=> "map-server",		// Map server executable
		'reset_map'				=> "prontera", 		// Map name to reset players to
		'reset_x'				=> "142",				// X coordinate to reset players to
		'reset_y'				=> "241",				// Y coordinate to reset players to
		'use_bugtracker'		=> "yes",			// Use the bugtracker for this server, yes or no?
		'showsysinfo'			=> "yes",				// Show system performance information on Dashboard (yes or no)? Note: Installation of some third party libraries required on server running Hercules. Consult the user guide.
		'charmap_update_method'	=> "disabled",			// Char/Map server update method. 'disabled' = Disabled through CP, 'svn' = "Subversion Version control", 'git' = GIT Repository
	),*/
);
			
/* An array of block reasons. You can add more by adding a key of the next number and a reason in quotes. */
$config["ban_reasons"] = array(
	0		=> "Botting",
	1		=> "Cheating",
	2		=> "Exploiting",
	3		=> "Hacking",
	4		=> "Insult/Harassment",
	5		=>	"Real Money Trading",
	6		=>	"Security Ban",
);
/* Class settings. Grab list of class ID's and their classes */
/* NOTE: You will not need to change much under here unless you've customised either Hercules or HAT, or both */

$config["jobs"] = array(
	0		=> "Novice",
	1 		=> "Swordsman",
	2		=> "Mage",
	3 		=> "Archer",
	4		=> "Acolyte",
	5		=> "Merchant",
	6		=> "Thief",
	7		=> "Knight",
	8		=> "Priest",
	9		=> "Wizard",
	10		=> "Blacksmith",
	11		=> "Hunter",
	12		=> "Assassin",
	13		=> "Knight",
	14		=> "Crusader",
	15		=> "Monk",
	16		=> "Sage",
	17		=> "Rogue",
	18		=> "Alchemist",
	19		=> "Bard",
	20		=> "Dancer",
	21		=> "Crusader",
	23		=> "Super Novice",
	24		=> "Gunslinger",
	25		=> "Ninja",
	
	4001	=> "Novice High",
	4002	=> "Swordman High",
	4003	=> "Mage High",
	4004	=> "Archer High",
	4005	=> "Acolyte High",
	4006	=> "Merchant High",
	4007	=> "Thief High",
	4008	=> "Lord Knight",
	4009	=> "High Priest",
	4010	=> "High Wizard",
	4011	=> "Whitesmith",
	4012	=> "Sniper",
	4013	=> "Assassin Cross",
	4014	=> "Lord Knight",
	4015	=> "Paladin",
	4016	=> "Champion",
	4017	=> "Professor",
	4018	=> "Stalker",
	4019	=> "Creator",
	4020	=> "Clown",
	4021	=> "Gypsy",
	4022	=> "Paladin",

	4023	=> "Baby",
	4024	=> "Baby Swordman",
	4025	=> "Baby Mage",
	4026	=> "Baby Archer",
	4027	=> "Baby Acolyte",
	4028	=> "Baby Marchant",
	4029	=> "Baby Thief",
	4030	=> "Baby Knight",
	4031	=> "Baby Priest",
	4032	=> "Baby Wizard",
	4033	=> "Baby Blacksmith",
	4034	=> "Baby Hunter",
	4035	=> "Baby Assassin",
	4036	=> "Baby Knight",
	4037	=> "Baby Crusader",
	4038	=> "Baby Monk",
	4039	=> "Baby Sage",
	4040	=> "Baby Rogue",
	4041	=> "Baby Alchemist",
	4042	=> "Baby Bard",
	4043	=> "Baby Dancer",
	4044	=> "Baby Crusader",
	4045	=> "Super Baby",

	4046	=> "Taekwon",
	4047	=> "Star Gladiator",
	4048	=> "Star Gladiator",
	4049	=> "Soul Linker",
	
	4050	=> "Gangsi",
	4051	=> "Death Knight",
	4052	=> "Dark Collector",
	
	4054	=> "Rune Knight",
	4055	=> "Warlock",
	4056	=> "Ranger",
	4057	=> "Arch Bishop",
	4058	=> "Mechanic",
	4059	=> "Guillotine Cross",

	4060	=> "Rune Knight",
	4061	=> "Warlock",
	4062	=> "Ranger",
	4063	=> "Arch Bishop",
	4064	=> "Mechanic",
	4065	=> "Guillotine Cross",
	
	4066	=> "Royal Guard",
	4067	=> "Sorcerer",
	4068	=> "Minstrel",
	4069	=> "Wanderer",
	4070	=> "Sura",
	4071	=> "Genetic",
	4072	=> "Shadow Chaser",
	
	4073	=> "Royal Guard",
	4074	=> "Sorcerer",
	4075	=> "Minstrel",
	4076	=> "Wanderer",
	4077	=> "Sura",
	4078	=> "Genetic",
	4079	=> "Shadow Chaser",
	
	4080	=> "Rune Knight",
	4081	=> "Rune Knight",
	4082	=> "Royal Guard",
	4083	=> "Royal Guard",
	4084	=> "Ranger",
	4085	=> "Ranger",
	4086	=> "Mechanic",
	4087	=> "Mechanic",
	
	4096	=> "Baby Rune",
	4097	=> "Baby Warlock",
	4098	=> "Baby Ranger",
	4099	=> "Baby Bishop",
	4100	=> "Baby Mechanic",
	4101	=> "Baby Cross",
	4102	=> "Baby Guard",
	4103	=> "Baby Sorcerer",
	4104	=> "Baby Minstrel",
	4105	=> "Baby Wanderer",
	4106	=> "Baby Sura",
	4107	=> "Baby Generic",
	4108	=> "Baby Chaser",

	4109	=> "Baby Rune",
	4110	=> "Baby Guard",
	4111	=> "Baby Ranger",
	4112	=> "Baby Mechanic",
);

/* Array for Equip locations. */
$config['equipLocations'] = array(
	1			=> "Lower Headgear",
	2			=> "Weapon",
	4			=> "Garment",
	8			=> "Accessory 1",
	16			=> "Armor",
	32			=> "Shield",
	64			=> "Footgear",
	128		=> "Accessory 2",
	256		=> "Upper Headgear",
	512		=> "Middle Headgear",
	1024		=> "Costume Top Headgear",
	2048		=> "Costume Mid Headgear",
	4096		=> "Costume Low Headgear",
	8192		=> "Costume Garment/Robe",
	65536		=> "Shadow Armor",
	131072 	=> "Shadow Weapon",
	262144 	=> "Shadow Shield",
	524288 	=> "Shadow Shoes",
	1048576 	=> "Shadow Accessory 2",
	2097152 	=> "Shadow Accessory 1",
);

/* Array for item types. */
$config['itemTypes'] = array(
	0	=> "Healing",
	2	=> "Usable",
	3	=> "Etc",
	4	=> "Weapon",
	5	=> "Armor",
	6	=> "Card",
	7	=> "Pet Egg",
	8	=> "Pet Armor",
	10	=> "Ammunition",
	11 => "Delay Consume",
	12	=> "Cash",
);

/* Array for picklog types. */
$config['pickTypes'] = array(
	"M" => "Monster Drop",
	"P" => "Player Drop",
	"L" => "Mob Loot Drop/Take",
	"T" => "Player Trade",
	"V" => "Player Vend/Take",
	"S" => "Shop Sell/Take",
	"N" => "NPC Give/Take",
	"C" => "Consumed Items",
	"A" => "GM Give/Take",
	"R" => "Storage Put/Take",
	"G" => "Guild Storage Put/Take",
	"E" => "Mail Attachment",
	"B" => "Buying Store",
	"O" => "Produced Items/Ingredients",
	"I" => "Auctioned Items",
	"D" => "Stolen from Monster",
	"U" => "MVP Prizes",
	"X" => "Other",
);

$config["permissions"] = array(
	'account'		=> array( // Permissions related to account management
		'viewaccounts'		=> "View Accounts",
		'viewemail'			=> "View Email Address",
		'editacctemail' 	=> "Edit Account Email Address",
		'resetacctpass' 	=> "Reset Account Password",
		'editgender' 		=> "Edit Account Gender",
		'addaccount'		=> "Add Game Account",
		'editacctgroup'		=> "Edit game account group ID",
		'acctgroupmax'		=> "Max group level in game account able to edit", // This determines if the user can edit any GM in-game accounts by their Group ID. Even if they have permissions to edit the email, if the group ID of the account is higher than this, they can't edit it.
		'editacctbd'		=> "Edit Account Birthdate",
		'editacctslots'		=> "Edit Account Reserved Slots",
		'usepurge'			=> "Purge Inactive Accounts",
		'banaccount'		=> "Ban Account",
		'unbanaccount'		=> "Unban Account",
		'edittrust'			=> "Edit Account Trust",
		'editstorageitem'	=> "Edit Item in Account Storage",
	),
	'character'		=> array( // Permissions related to Character Management
		'viewchars'			=> "View Characters",
		'whosonline'		=> "View Who's Online",
		'editcharname'		=> "Edit Character Name",
		'editcharslot'		=> "Edit Character Slot",
		'editcharzeny'		=> "Edit Character Zeny",
		'editcharlv'		=> "Edit Character Levels",
		'editcharstats'		=> "Edit Character Stats",
		'editcharjob'		=> "Change Character Job",
		'editcharlook'		=> "Change Character Look",
		'delcharitem'		=> "Delete Any Character Item",
		'editcharitem'		=> "Edit Any Character Item",
		'senditem'			=> "Send Item via Mail",
		'kickchar'			=> "Kick Character from Server",
		'delcharacter'		=> "Delete Individual Character",
		'restoredelchar'	=> "Restore Deleted Character",
		'changeposition'	=> "Reset Character Position",
	),
	'admin'			=> array( // Permissions related to panel management
		'addgroup'			=> "Add Admin Group",
		'editgroups'		=> "Edit Admin Groups",
		'addadmin'			=> "Add Admin",
		'editadmin'			=> "Edit Admin",
		'deladmin'			=> "Remove Admin",
		'deladmingroup'		=> "Remove Admin Group",
		'hatconfig'			=> "AdminTool Configuration Access",
		'editadminnews'		=> "Edit Admin Announcements",
		'viewadminlogs'		=> "View Admin Logs",
	),
	'guild'			=> array( // Permissions related to guild management
		'viewguilds'		=> "View guilds",
		'editguildname'		=> "Edit Guild Name",
		'editguildlv'		=> "Edit Guild Level/XP",
		'delguild'			=> "Delete Guild",
		'changeleader'		=> "Change Guild Leader",
		'managecastles'		=> "Manage Guild Castles",
	),
	'ticket'			=> array( // Permissions related to ticket management
		'viewtickets'		=> "View Tickets",
		'editcategory'		=> "Manage Ticket Categories",
		'editpredef'		=> "Manage Community Pre-defined Replies",
		'levellock'			=> "Level Lock Tickets",
		'assigngm'			=> "Assign GM to Ticket",
		'canreopen'			=> "Reopen Tickets",
	),
	'server'			=> array( // Permissions related to server management
		'serverstats'		=> "View Server Performance",
		'announcement'		=> "Manage System Broadcasts",
		'items'				=> "Manage server items",
		'itemshop'			=> "Manage Item Shop",
		'mobs'				=> "Manage server mobs",
		'servermaint'		=> "Start/Stop/Restart server",
		'backupdb'			=> "Backup Database",
		'sftp'				=> "Server SFTP Access",
		'serverconfig'		=> "Server Configuration Access (View/Edit)",
		'sqlquery'			=> "Issue query directly to SQL Server",				
	),
	'analysis'		=> array( // Permissions related to viewing server analysis.
		'itemcount'			=> "View Item Count by Character",
		'level1zeny'		=> "View Lv1 Chars with more than 1m zeny",
		'nocharaccts'		=> "View Accounts with no characters",
		'top100'			=> "View Top 100 characters by any parameter",
		'mvpkill'			=> "View MVP Kills by MVP",
		'delcharsaccts'		=> "View accounts with deleted characters",
	),
	'log'				=> array( // Permissions related to log management
		'atcmdlog'			=> "View @command logs",
		'branchlog'			=> "View Branch logs",
		'chatlog'			=> "View Chat Logs",
		'loginlog'			=> "View Login Logs",
		'mvplog'			=> "View MVP Logs",
		'npclog'			=> "View NPC Logs",
		'picklog'			=> "View Item Pick Logs",
		'zenylog'			=> "View Zeny Transaction Logs",
	),
	'bugtracker'		=> array( // Permissions related to bugtracker management
		'viewbugs'			=> "View bugs",
		'openbugs'			=> "Open a new bug",
		'changestatus'		=> "Change the Status of bugs",
		'makeprivate'		=> "Make a bug private",
		'assignbug'			=> "Assign a bug",
		'editbugs'			=> "Edit bugs",
		'isdev'				=> "Is Developer (can be assigned bugs)?",
		'viewprivate'		=> "View Private bugs",
	),
);