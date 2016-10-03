<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* An array of versions. Add more if you need. Make sure the versions are comma space seperated and the list ends with a comma. Make sure each version is wrapped in double quotes ("X"). */
$config["bug_versions"] = array(
	"1.0", "1.1", "1.1.2",
);

/* An array of bug priorities. If you need anymore, you can put them here. */
$config["bug_priority"] = array(
	1	=> "None",
	2	=> "Low",
	3	=> "Medium",
	4	=> "High",
	5	=> "Urgent",
	6	=> "Immediate",
);

/* An array of bug categories. Add new or change as you see fit. */
$config["bug_categories"] = array(
	10	=> "Bug > Skill",
	11	=> "Bug > Quest",
	12	=> "Bug > World",
	13	=> "Bug > Item",
	14	=> "Bug > Mob",
	15	=> "Bug > NPC",
	16	=> "Bug > Balancing",
	17	=> "Suggestion > World",
	18	=> "Suggestion > Balancing",
	19	=> "Suggestion > Item",
	20 	=> "Suggestion > Mob",
	21	=> "Suggestion > NPC",
	22 	=> "Suggestion > Quest",
	23	=> "Suggestion > Skill",
	24 	=> "Suggestion > Client",
	25	=> "Bug > Client",
);

/**** Under normal circumstances, the below settings you should never need to change. ****/

/* An array of bug statuses. If you need anymore, you can put them here. Note all bugs are automatically assigned a status of 1 and the Resolved bugs should be given a status of 19.. Don't recommend you change this. */
$config["bug_status"] = array(
	1	=> "Unconfirmed", // This is what all new bugs will be set to. Don't recommend you change this.
	2	=> "New",
	3	=> "Reopened",
	18	=> "Assigned", // This is the "Assigned" status, and where a developer can be assigned to a bug. This must exist as ID 18 for bugs to be assignable. Do not change the ID of this.
	19	=> "Resolved", // This is the "Resolved" status, and where the resolutions below will be selectable. This must exist as ID 19 for bugs to be truly "resolved". Do not change the ID of this.
);

/* An array of Bug Resolutions. If you need anymore, you can put them here. Note that these will only be selectable if the bug is "resolved", using the ID in the setting above. Don't recommend you change this */
$config["bug_resolutions"] = array(
	0	=> "-", // Do not change this entry from 0 => "-"
	1	=> "Fixed",
	2	=> "Invalid",
	3	=> "Wontfix",
	4	=> "Duplicate",
	5	=> "Worksforme",
	6	=> "Incomplete",
);

/* Do not change the below. Let the panel know what action types there are. */
$config["action_types"] = array(
	0	=> "Opened",
	1	=> "Changed Status",
	2	=> "Changed Assigned",
	3	=> "Changed Priority",
	4	=> "Changed Category",
	5	=> "Changed Resolution",
	6	=> "Changed Subject",
);