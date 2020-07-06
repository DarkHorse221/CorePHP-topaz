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
			$user_id_verify = userAuthOnce($input, $p);
			$templateArray['{message}'] = "<h1>Login</h1><p>You are now being logged in</p><p>Please wait...</p>";
			$templateForward = userHomeScreen($user_id_verify);
		}
	} 
}

list($fhead, $fend) = drawFormTags('p', WEBSITE_REF.'?p=login');
$templateArray['{fhead}'] = $fhead; $templateArray['{fend}'] = $fend;
$templateArray['{uname}'] = drawFld("text","uname",$input,"Username");
$templateArray['{pass}'] = drawFld("password","pass","","Password");
$templateArray['{submit}'] = drawFld("submit","submit","Login","&nbsp;","submit");
if(!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($err); }
$templateArray['{forgot-password}'] = '<a href="'.WEBSITE_REF.'?p=forgot-password">Click here so we can email you a new one.</a>';
?>