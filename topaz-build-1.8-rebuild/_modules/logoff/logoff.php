<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
$uid = userID($sid); logOff($uid, $sid);
$templateArray['{message}'] = "<h1>Logoff</h1><p>You are now being logged off</p><p>Please wait...</p>"; $templateForward = "home";
?>