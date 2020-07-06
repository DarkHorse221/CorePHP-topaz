<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
if($_POST['submit']) {
	$e = validateEmail($_POST['uname']);
	$p = cleanInput($_POST['pass']);
	if(!$e) { //do some validation
		$u = validateInput($_POST['uname']);
		if(!$u) { $err[] = sysMsg(5);
		} else { $input = cleanInput($_POST['uname']); }
	} else { $input = cleanEmail($_POST['uname']); }
	if($input) { //continue if valid input detected
		if(!loginUser($input,$p,$sid)) {
			$err[] = sysMsg(5);
		} else {
			$templateArray['{message}'] = "You are now being logged in<br /><br />Please wait...";
			$templateForward = "console/index.php?t=launch";
		}
	} 
}

list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=login');
$templateArray['{fhead}'] = $fhead; $templateArray['{fend}'] = $fend;
$templateArray['{uname}'] = drawFld("text","uname",$input,"Username");
$templateArray['{pass}'] = drawFld("password","pass","","Password");
$templateArray['{submit}'] = drawFld("submit","submit","Login","&nbsp;","submit");
if(!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($err); }
?>