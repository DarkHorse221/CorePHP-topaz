<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
include('_modules/standard_arrays.php');
	
	if($_POST['change-password']) { 
		if($_POST['auth'] == 'Black!_Ducks') {
		if($_POST['pass1'] || $_POST['pass2']) {
			if(validateInput($_POST['pass1']) && validateInput($_POST['pass2'])) { 
				$pass1 = cleanInput($_POST['pass1']); $pass2 = cleanInput($_POST['pass2']); $usr = cleanInput($_POST['usr']);
				if(($pass1 == $pass2) && $usr) {	
					if(strlen($pass1) < 73) { $hasher = new PasswordHash(9, false); $hash = $hasher->HashPassword($pass1);	
						if (strlen($hash) >= 20) {
							$q_cp = sql("UPDATE `user` SET `pass` = '".$hash."' WHERE `uname` = '".$usr."'");
							if($q_cp) { $success[] = sysMsg(44); } else { $errs[] = sysMsg(8); }
						} else { $errs[] = "Passwords: Error hashing password"; }	
					} else { $errs[] = "Passwords: Length must be less than 72 characters"; }
				} else { $errs[] = "Passwords: Values entered do not match."; }
			} else { $errs[] = "Passwords: ".sysMsg(6); }
		} else { $errs[] = "Passwords: ".sysMsg(6); }
		} else { $errs[] = "Authorisation code is not valid"; }	
	}//post pass

	$templateArray['{mid}'] = '<p>'.drawFld("text","usr","","User").'</p><p>'.drawFld("password","pass1","","Password").'</p>
	<p>'.drawFld("password","pass2","","Confirm Password").'</p>
	<p>'.drawFld("password","auth","","Authentication Code").'</p>
	<p>'.drawFld("submit","change-password","Change Password","&nbsp;","submit").'</p>';
		
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'?p'.$lvl1); $templateArray['{fhead}'] = $fhead;	$templateArray['{fend}'] = $fend;
if(!$templateArray['{success}']) { $templateArray['{success}'] = writeMsgs($success, "success"); } if(!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($errs); }
?>