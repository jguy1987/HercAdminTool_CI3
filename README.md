HercAdminTool
=========

Contents:
---------

* 1 What is HercAdminTool?
* 2 What makes this panel stand out?
* 3 How do I use it? What are the system requirements?
* 4 Installation
* 5 A list of planned features?
* 6 Notes

1. What is HercAdminTool?
---------
HercAdminTool (or HAT) is an online administration panel for your Ragnarok Online server running 
the emulator Hercules. It is written in PHP, Javascript, powered with Codeigniter and Bootstrap 
backends and as hosted on GitHub, it completely open source software, released under the 
Apache license. This gives you the power to modify, redistribute and such, as long as you 
return credits to me.

2. What makes this panel stand out?
---------
It is understandable for someone to ask this question with all the control panels out there. 
HAT is built with security in mind. The panel is built to be completely hidden from your users 
behind an indesript URL. Want part of your RO server hosted on yourdomain.com/fluffybunnies? Perfect!
Hide the panel behind an .htaccess and no one except your GM's will know its there. no longer will
you be exposing your control panel to your users on the front page of your website.

3. How do I use it? What are the system requirements?
---------
HAT is written in PHP, uses MySQL as it's backend and is a web application. Therefore, you will require, 
at the minimum:

* Apache2 server
* PHP5
* MySQL
* git
* sendmail
* An RO Server running Hercules.

The above is tested to function. Ngix, Lighthttpd and the likes are untested, but I would appreciate
the feedback if you got it to work or not.

4. Installation
---------
At the moment there is no point to install the panel as it's just flesh and bones right now, 
no real functionality as far as RO Server Managing is concerned. If you wanted to 
install, though, some simple steps:

* Copy everything to web directory
* Run admintool.sql on your desired database
* Edit /application/config/config.php and /application/config/database.php to your desired settings
* Point your web browser to the correct URL

Coming soon will be an actual install script so that everything is done for you, even the download of the panel.

5. A list of planned features?
---------
The control panel is designed with the user in mind. Here are some of the features we've either completed
or are planning:

* Account interface - View/edit account information. Reset passwords, change gender of account, 
ban/unban account, change email of account, view/delete items in storage, ban/unban IP
* Character interface - View/edit character information. Set any parameter of a character, 
view inventories, delete items, send character mail, remove guild membership information.
* Log interface - View any server log, search by everything in logs
* Statistics interface - View how many items are on the server, where they are and who has 
them in what quantity, delete those items, how many accounts, how many characters, etc.
* Admin Interface - View/Edit GM list, assign/revoke permissions, create/edit/destroy groups, 
change HAT configuration parameters, view HAT logs
* Server Interface - Edit any configuration item on the server (battle.conf, maps.conf, groups.conf, etc) 
with a graphical interface, edit/delete/add items/mobs from /db/ folder or SQL with graphical interface, 
SFTP interface to server to upload/delete files or folders (will require java), download any file to your PC locally, 
backup server files/databases to any other server, the same server or to your local PC
* Sales Interface - View/Edit Cash Shop Items, view sales by item or character, view donation totals
* Ticket Interface - View/Reply to tickets, open new tickets for users, assign tickets to group levels.

6. Notes
---------
As mentioned, the panel is not even close to done yet, and at the moment just has some backend account
management interfaces. I hope to work on this almost full time to create something robust and useful.

For tracking, I will be using Github for all feedback and issue tracking. If you find something
critical, please report it to me there. If you wish to assist, please submit a pull request!

Best wishes for a 2015!