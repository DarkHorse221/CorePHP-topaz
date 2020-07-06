<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
if(userSystemRights($uid, "collaborate")) {
	$coll = true; $status = cleanString($_GET['status']); $chk = false; $user_verify = false;
	$q_status = sql("SELECT `lock` FROM `document_properties` WHERE `did` = '".$id."'"); $r_status = mysqli_fetch_assoc($q_status);
	if($status) { 
		if($r_status['lock'] == $uid) { $chk = true; } elseif(userSystemRights($uid, "sys_admin")) { $chk = true; } else { 
		$q_user = sql("SELECT `fname`, `lname` FROM `user_ext` WHERE `uid` = '".$r_status['lock']."'"); $r_user = mysqli_fetch_assoc($q_user);
		if($r_status['lock']) { $cext = sysMsg(40).$r_user['fname']." ".$r_user['lname']." or by the System Administrator."; } $warning[] = sysMsg(18).$cext; }
	}	
	if(!$err && $chk) {
		if($status == "lock") { $q_upd_status = sql("UPDATE `document_properties` SET `lock` = '".$uid."' WHERE `did` = '".$id."'"); docEvents($id, $uid, 38);
		} elseif($status == "unlock") { $q_upd_status = sql("UPDATE `document_properties` SET `lock` = '0' WHERE `did` = '".$id."'"); docEvents($id, $uid, 39);}
	}
	$q_status = sql("SELECT `lock` FROM `document_properties` WHERE `did` = '".$id."'"); $r_status = mysqli_fetch_assoc($q_status);
	if(($r_status['lock'] == $uid) || ($r_status['lock'] == '0')) { $templateArray['{submit-doc}'] = drawFld("submit","edit-doc","Update Document","&nbsp;","submit"); } else {  $templateArray['{submit-doc}'] = ''; }
	if($r_status['lock']) { $img = 'locked.png'; $st = 'unlock'; } else { $img = 'unlocked.png'; $st = 'lock'; }
	$coll_sect_nav_ext .= '<a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o='.$o.'&id='.$id.'&status='.$st.'"><img src="'.WEBSITE_LOC.'console/_images/'.$img.'" class="img" /></a>';
}
?>