<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row h-100 justify-content-center align-items-center">
				<div class="card">
					<div class="card-header">
						Changes Processed!
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<?php switch( $referpage ) {
								case "useredit":
									echo "Admin user edit processed successfully. Return to the <a href='".base_url('admin/users')."'>user management page</a>.";
									break;
								case "groupadd":
									echo "Group Addition processed successfully. Return to the <a href='".base_url('admin/groups')."'>group management page</a>.";
									break;
								case "useradd":
									echo "Admin user added successfully. The user has received an email with their login details. Return to the <a href='".base_url('admin/users')."'>user management page</a>.";
									break;
								case "lockusers":
									echo "All admin user accounts locked from login. Return to the <a href='".base_url('admin/users')."'>user management page</a>.";
									break;
								case "unlockusers":
									echo "All admin user accounts enabled to login. Return to the <a href='".base_url('admin/users')."'>user management page</a>.";
									break;
								case "resetallpw":
									echo "All admin user accounts have had their passwords reset and have received emails with their new passwords. Return to the <a href='".base_url('admin/users')."'>user management page</a>.";
									break;
								case "acctadd":
									echo "User's game account processed successfully. User has received an email with their password and pincode. Return to the <a href='".base_url('account/search')."'>account management page</a>.";
									break;
								case "acctnoteadd":
									echo "Note added successfully. Return to the <a href='".base_url('account/details/'.$acct_id.'#notes')."'>account notes page</a>.";
									break;
								case "newban":
									echo "Ban added to this account. Return to the <a href='".base_url('account/details/'.$acct_id.'#blocks')."'>account blocks page</a>.";
									break;
								case "remban":
									echo "Ban was successfully removed from this account. Return to the <a href='".base_url('account/details/'.$acct_id.'#blocks')."'>account blocks page</a>.";
									break;
								case "groupedit":
									echo "Group edit successful. Return to the <a href='".base_url('admin/groups')."'>group management page</a>.";
									break;
								case "editaccount":
									echo "Account details edited successfully. Return to the <a href='".base_url('account/details/'.$acct_id.'')."'>account details page</a>.";
									break;
								case "resetpass":
									echo "Account password reset successfully. Return to the <a href='".base_url('account/details/'.$acct_id.'')."'>account details page</a>.";
									break;
								case "addnumflag":
									echo "Num Flag added to this account successfully. Return to the <a href='".base_url('account/details/'.$acct_id.'')."'>account details page</a>.";
									break;
								case "addstrflag":
									echo "String Flag added to this account successfully. Return to the <a href='".base_url('account/details/'.$acct_id.'')."'>account details page</a>.";
									break;
								case "editchar":
									echo "Character changes process successfully. Return to the <a href='".base_url('character/details/'.$char_id.'')."'>character details page</a>.";
									break;
								case "resetpos":
									echo "Character position reset! Return to the <a href='".base_url('character/details/'.$char_id.'')."'>character details page</a>.";
									break;
								case "editnumflag":
									echo "Account Num Flag edited successfully. Return to the <a href='".base_url('character/details/'.$char_id.'')."'>account details page</a>.";
									break;
								case "editstrflag":
									echo "Account Str Flag edited successfully. Return to the <a href='".base_url('character/details/'.$char_id.'')."'>account details page</a>.";
									break;
								case "groupdel":
									echo "Group deleted successfully. Return to <a href='".base_url('admin/groups')."'>group management page</a>.";
									break;
								case "serverselect":
									echo "Server selected. Return to the <a href='".$refered_from."'>previous page</a>.";
									break;
								case "assignleader":
									echo "Guild Leader changed. Return to the <a href='".base_url('guild/details/'.$guild_id.'')."'>guild details page</a>.";
									break;
								case "charkick":
									echo "Character kicked! Return to the <a href='".base_url('character/details/'.$char_id.'')."'>character details page</a>.";
									break;
								case "newbug":
									echo "New bug added! Return to the <a href='".base_url('bugtracker/buglist')."'>list of bugs</a>.";
									break;
								case "newcomment":
									echo "New comment added! Return to the <a href='".base_url('bugtracker/details/'.$bug_id.'')."'>bug details page</a>.";
									break;
								case "editbug":
									echo "Edited bug details successfully. Return to the <a href='".base_url('bugtracker/details/'.$bug_id.'')."'>bug details page</a>.";
									break;
								case "usersettingschange":
									echo "Edited your settings successfully! Return to <a href='".base_url('user/settings')."'>settings page</a>";
									break;
								case "addnews":
									echo "Admin news item added successfully. Return to the <a href='".base_url('admin/news')."'>news list</a>";
									break;
								case "editnews":
									echo "Admin news item edited successfully. Return to the <a href='".base_url('admin/news')."'>news list</a>";
									break;
								case "deletenews":
									echo "Admin news item {$id} deleted. Return to the <a href='".base_url('admin/news')."'>news list</a>";
									break;
								default:
									echo "Return to the <a href='".base_url()."'>dashboard</a>.";
									break;
								} ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>