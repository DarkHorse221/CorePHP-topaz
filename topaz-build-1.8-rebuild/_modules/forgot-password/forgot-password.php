<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
if($_POST['submit']) {
	$e = cleanInput($_POST['uname']);
	$q_usr = sql("SELECT `email` FROM `user` WHERE `uname` != 'sysadmin' AND `uname` = '".$e."'");
	$c_usr = mysqli_num_rows($q_usr);
	if(!$c_usr) { 
		$err[] = "Oops...that user doesn't seem to exist. Please contact your Systems Administrator or try again.";
	} else {
		$tpass = makeTempPassword();
		$hasher = new PasswordHash(9, false);
		$hash = $hasher->HashPassword($tpass);
		if (strlen($hash) >= 20) {
			//update user
			$q_cp = sql("UPDATE `user` SET `pass` = '".$hash."', `changepass` = '1' WHERE `uname` = '".$e."'");
			//send email
			$r_usr = mysqli_fetch_assoc($q_usr);
			$email = $r_usr['email'];
			require_once(SERVER_PATH.'_functions/mailout.php');
			$to[] = $email;	$to_list = implode(",", $to);
			$tpl = sysMsg(65); $tpl_arr['{uname}'] = $e; $tpl_arr['{tpass}'] = $tpass; $tpl_arr['{link}'] = WEBSITE_REF.'?p=login'; $tpl_arr['{year}'] = date("Y", time()); $tpl_arr['{company}'] = EMAIL_COMPANY;
			foreach($tpl_arr as $k=>$v) { $ks[] = $k; $vs[] = $v; } $html = str_replace($ks, $vs, $tpl);
			$date_now = new DateTime('now'); $date_now = $date_now->format('Y-m-d');
			q_smtpmailer($to_list, NO_REPLY_EMAIL, WEBSITE_OWNER, 'Password Reset Notification', $html, $date_now, MAIL_SEND_CODE);
			
			//forward to notification page
			$templateArray['{message}'] = '<h1>Password Reset</h1><p>Your new email has been sent to your registered email address.</p><p>Please allow up to 5 minutes for email delivery.</p><p><a href="'.WEBSITE_REF.'?p=login" style="link">Go to the login page >></a></p>';
			$templateForward = 'static';
		}	
	}	
}
list($fhead, $fend) = drawFormTags('p', WEBSITE_REF.'?p=forgot-password');
$templateArray['{fhead}'] = $fhead; $templateArray['{fend}'] = $fend;
$templateArray['{email}'] = drawFld("text","uname",$input,"Username");

$templateArray['{submit}'] = drawFld("submit","submit","Email new password","&nbsp;","submit");
if(!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($err); }
?>