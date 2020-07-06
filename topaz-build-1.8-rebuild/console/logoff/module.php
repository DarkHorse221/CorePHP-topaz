<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
$uid = userID($sid);
logOff($uid, $sid);
$templateArray['{message}'] = "You are now being logged off<br /><br />Please wait...";
$templateForward = "home";
?>