#!/usr/bin/php
<?php
/* Example:
 * From: root (Cron Daemon)
 * To: apache
 * Subject: Cron <apache@ashfrcbuild> echo "Apache is Testing Too!"
 * Content-Type: text/plain; charset=UTF-8
 * Auto-Submitted: auto-generated
 * X-Cron-Env: <SHELL=/bin/sh>
 * X-Cron-Env: <HOME=/var/www>
 * X-Cron-Env: <PATH=/usr/bin:/bin>
 * X-Cron-Env: <LOGNAME=apache>
 * X-Cron-Env: <USER=apache>
 *
 * Apache is Testing, Too!
 *
 */

$stdin = fopen('php://stdin', 'r');
$email = array('body'=>"",'subject'=>"","to"=>"","from"=>"");

while ($line=fgets($stdin)) {
	echo $line;
	$lline = strtolower($line);
	if (preg_match("/^(Subject|To|From|Content-Type|CC|BCC|Auto-Submitted|X-Cron-Env): ([a-zA-Z0-9 !@#$%^&*().:;'\"?\/\{\}\[\]|\\,<>_=+-]+)/",$line,$matches)) {
		if (isset($email[strtolower($matches[1])]) && $email[strtolower($matches[1])]!="" && !is_array($email[strtolower($matches[1])]) ) {
			$temp=$email[strtolower($matches[1])];
			$email[strtolower($matches[1])]=array();
			array_push($email[strtolower($matches[1])],$matches[2]);
		} else if (is_array($email[strtolower($matches[1])])) {
			array_push($email[strtolower($matches[1])],$matches[2]);
		} else { 
			$email[strtolower($matches[1])]=$matches[2];
		}	
	} else {
		$email['body'].=$line;//."\n";
	}
}
print_r($email);
?>
