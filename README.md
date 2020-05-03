# Hercules Admin Tool

## What is it?

Hercules Admin Tool, HercAdminTool or HAT for short, is a PHP based administration panel for your Ragnarok Online Server
running the Hercules emulator.

This branch, specifically, is a complete rewrite of the panel using CodeIgniter4 and the latest version of Bootstrap.

Note: This branch is testing only. Server damage may result. 

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
