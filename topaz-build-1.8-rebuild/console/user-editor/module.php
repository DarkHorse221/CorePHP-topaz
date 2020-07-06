<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
//set options
$uid = userID($sid);
$o = cleanInput($_GET['o']); $id = cleanNumber($_GET['id']); $cid = cleanNumber($_GET['cid']);
$del_id = cleanNumber($_GET['did']); $confirm = cleanNumber($_GET['confirm']);
if(!$id) { $err[] = sysMsg('4'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }

$q_uex = sql("SELECT `fname`, `lname` FROM `user_ext` WHERE `uid` = '".$id."'");
$r_uex = mysqli_fetch_assoc($q_uex);
//edit user
$sect_head = "User Editor (".$r_uex['fname']." ".$r_uex['lname'].")";
$sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=users"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
$sec_opts = array("User Details" => "user","Groups" => "view-user-groups","Managers" => "view-user-managers","Comments" => "view-user-comments");
if(userSystemRights($id, "radiation")) { $sec_opts["Radiation Dose Record"] = "view-user-radiation"; }
if(userSystemRights($id, "add_credentials")) { $sec_opts["Credentials"] = "view-user-credentials"; }
$fext = "&id=".$id;

if($o == "user") { 
	if(!userSystemRights($uid, "edit_user")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
	
	if($_POST['edit-user']) {
		$act = cleanNumber($_POST['act']); $ext = cleanNumber($_POST['ext']); $mob = cleanNumber($_POST['mob']); $unit = cleanNumber($_POST['unit']);
		//error checking
		if(validateInput($_POST['fn'])) { $fn = cleanInput($_POST['fn']); } else { $fn = $_POST['fn']; $err[] = "First name: ".sysMsg(6); }
		if(validateInput($_POST['ln'])) { $ln = cleanInput($_POST['ln']); } else { $ln = $_POST['ln']; $err[] = "Last name: ".sysMsg(6); }
		$usr = cleanInput($_POST['usr']);
		if(validateEmail($_POST['e'])) { $e = cleanEmail($_POST['e']); $q_echk = sql("SELECT `id` FROM `user` WHERE `email` = '".$e."' AND `id` != '".$id."'");
		$c_echk = mysqli_num_rows($q_echk);
		if($c_echk) { $warning[] = "Email address is already registered."; } } else { $e = $_POST['e']; $err[] = "Email: ".sysMsg(6); }
		if(validateInput($_POST['title'])) { $title = cleanInput($_POST['title']); } else { $title = $_POST['title']; $err[] = "Job Title: ".sysMsg(6); }
		$tapandlearn = cleanInput($_POST['tapandlearn']);
		if($_POST['pass1'] || $_POST['pass2']) {
		if(validateInput($_POST['pass1']) && validateInput($_POST['pass2'])) { 
			$pass1 = cleanInput($_POST['pass1']); $pass2 = cleanInput($_POST['pass2']);
			if($pass1 == $pass2) {
				if(strlen($pass1) < 73) {
					$hasher = new PasswordHash(9, false);
					$hash = $hasher->HashPassword($pass1);
					if (strlen($hash) >= 20) {	$sql_pass = ", `pass` = '".$hash."'"; } else { $err[] = "Passwords: Error hashing password"; }
				} else { $err[] = "Passwords: Length must be less than 72 characters"; }
				} else { $err[] = "Passwords: Values entered do not match."; }
				} else { $err[] = "Passwords: ".sysMsg(6); }	
		} //post pass
		if(!$err) {
			$q_u = sql("UPDATE `user` SET `email` = '".$e."', `active` = '".$act."' ".$sql_pass." WHERE `id` = '".$id."'");
			$q_ue = sql("UPDATE `user_ext` SET `fname` = '".$fn."', `lname` = '".$ln."', `title` = '".$title."', `phone` = '".$ext."', `mobile` = '".$mob."', `unit` = '".$unit."', `tapandlearn` = '".$tapandlearn."' WHERE `uid` = '".$id."'");
			if($q_u && $q_ue) { $success[] = sysMsg(9); } else { $err[] = sysMsg(8); }
		}	
	}
	if(!$err) { 
		$q_chk = sql("SELECT u.id, u.uname, u.email, u.active, ue.fname, ue.lname, ue.title, ue.phone, ue.mobile, ue.tapandlearn, ue.unit FROM user u, user_ext ue WHERE u.id=ue.uid AND u.id = '".$id."'");
		$c_chk = mysqli_num_rows($q_chk);
		if(!$c_chk) { 
			$templateArray['{system-rights}'] = "none"; $err[] = sysMsg('4');
		} else {
			$r_chk = mysqli_fetch_assoc($q_chk); 
			$usr = $r_chk['uname']; $e = $r_chk['email']; $act = $r_chk['active']; $fn = $r_chk['fname']; $ln = $r_chk['lname']; $ext = $r_chk['phone']; $mob = $r_chk['mobile']; $title = $r_chk['title']; $tapandlearn = $r_chk['tapandlearn']; $unit = $r_chk['unit'];
			mkdir_chmod(SERVER_PATH.FILES_DIR.$r_chk['id'].'/');
		} //if !chk
	} //!err
} //user


if($o == "view-user-groups") { 
	if(!userSystemRights($uid, "edit_user")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
	
	if($_POST['edit-groups']) {
		$q_del = sql("DELETE FROM `user_groups` WHERE `uid` = '".$id."'");
		if($q_del) {foreach($_POST as $k => $v) { if(cleanNumber(is_int($k))) { $q_ins = sql("INSERT INTO `user_groups` (`rid`, `uid`) VALUES ('".$k."','".$id."')"); }}}
		if($q_del && ($id == '1')) { $q_ins_sys_admin = sql("INSERT INTO `user_groups` (`rid`, `uid`) VALUES ('1','1')"); }
		if($q_ins || $q_del || $q_ins_sys_admin) { $success[] = sysMsg(9); } else { $err[] = sysMsg(8); }
	}
	if(!$err) { 
		$q_chk = sql("SELECT id FROM user WHERE id = '".$id."'");
		$c_chk = mysqli_num_rows($q_chk);
		if(!$c_chk) { 
			$templateArray['{system-rights}'] = "none"; $err[] = sysMsg('4');
		} else {
			$q_grp = sql("SELECT `id`, `name` FROM `user_rights` WHERE `tid` ='4' ORDER BY `id` ASC");
			while($r_grp = mysqli_fetch_assoc($q_grp)) {
				$q_usr = sql("SELECT `id`, `uid` FROM `user_groups` WHERE `uid` = '".$id."' AND `rid` = '".$r_grp['id']."'");
				$r_usr = mysqli_fetch_assoc($q_usr);
				$c_usr = mysqli_num_rows($q_usr);
				if($c_usr) { $chk = 'checked=checked'; } else { $chk = ""; }
				if(($r_grp['id'] == '1') && ($r_usr['uid'] == '1') ) { $dis = 'disabled=disabled'; } else { $dis = ""; }
				$templateArray['{group-data}'] .= '<p><label class="label">'.$r_grp['name'].'</label><input name="'.$r_grp['id'].'" type="checkbox" class="chk" value="1" '.$chk.' '.$dis.' /></p>';
			}
			
			$q_grpm = sql("SELECT `id`, `name` FROM `user_rights` WHERE `tid` ='5' ORDER BY `id` ASC");
			while($r_grpm = mysqli_fetch_assoc($q_grpm)) {
				$q_usrm = sql("SELECT `id`, `uid` FROM `user_groups` WHERE `uid` = '".$id."' AND `rid` = '".$r_grpm['id']."'");
				$r_usrm = mysqli_fetch_assoc($q_usrm);
				$c_usrm = mysqli_num_rows($q_usrm);
				if($c_usrm) { $chkm = 'checked=checked'; } else { $chkm = ""; }
				$templateArray['{group-mail-data}'] .= '<p><label class="label">'.$r_grpm['name'].'</label><input name="'.$r_grpm['id'].'" type="checkbox" class="chk" value="1" '.$chkm.' /></p>';
			}
			
		} //if !chk
	} //!err
} //user

if($o == "view-user-managers") { 
	if(!userSystemRights($uid, "edit_user")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
	
	if($_POST['edit-managers']) {
		$q_del = sql("DELETE FROM `user_managers` WHERE `uid` = '".$id."'");
		if($q_del) { if($_POST['sm']) { foreach($_POST['sm'] as $k => $v) { $q_ins = sql("INSERT INTO `user_managers` (`mid`, `uid`) VALUES ('".$v."','".$id."')"); }}}
		if($q_del || $q_ins) { $success[] = sysMsg(9); } else { $err[] = sysMsg(8); }
	}
	
	$q_cman = sql("SELECT `mid` FROM `user_managers` WHERE `uid` = '".$id."'");
	while($r_cman = mysqli_fetch_assoc($q_cman)) { $man_arr[] = $r_cman['mid']; }
	$q_man = sql("SELECT u.id, ue.fname, ue.lname FROM user u, user_ext ue WHERE u.id=ue.uid AND u.active = '1' AND u.id != '".$id."' AND u.id != '1' ORDER BY ue.fname ASC");
	while($r_man = mysqli_fetch_assoc($q_man)) {
		if(userSystemRights($r_man['id'], "approve_credentials")) {
			if($man_arr && in_array($r_man['id'], $man_arr)) {
				$sm .= '<option value="'.$r_man['id'].'">'.$r_man['fname'].' '.$r_man['lname'].'</option>';
			} else {
				$lom .= '<option value="'.$r_man['id'].'">'.$r_man['fname'].' '.$r_man['lname'].'</option>';
			}
		}
	}
	
	$templateArray['{lom}'] = '<select name="lom[]" multiple id="lom" class="multiple-select">'.$lom.'</select>';
	$templateArray['{sm}'] = '<select name="sm[]" multiple id="sm" class="multiple-select">'.$sm.'</select>';
	
} //user

if($o == "view-user-comments") { 
	if(!userSystemRights($uid, "edit_user")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
		$sect_nav_ext .= '<a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o=add-user-comments&id='.$id.'"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
		$q_chk = sql("SELECT ue.fname, ue.lname, uc.id, uc.date, uc.comment, uc.resolution FROM user_ext ue, user_comments uc WHERE ue.uid=uc.cuid AND uc.uid = '".$id."' ORDER BY uc.date DESC");
		$c_chk = mysqli_num_rows($q_chk);
		if(!$c_chk) { $templateArray['{comments-table}'] = "<p>There are no comments for this user.</p>";
		} else {
			while($r_chk = mysqli_fetch_assoc($q_chk)) {
				$data .= '<tr><td><a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o=edit-user-comments&id='.$id.'&cid='.$r_chk['id'].'">'.dateConvert($r_chk['date'],1).'</a></td><td>'.$r_chk['comment'].'</td><td>'.$r_chk['fname'].' '.$r_chk['lname'].'</td></tr>';
			}
			$templateArray['{comments-table}'] = '<table id="comments" class="tablesorter"><thead><tr><th>Date</th><th>Comment</th><th>Comment By</th></thead><tbody>'.$data.'</tbody></table>';
		} //if !chk

} //user

if($o == "add-user-comments") { 
	if(!userSystemRights($uid, "edit_user")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
		$sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o=view-user-comments&id='.$id.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
		$templateArray['{sect_head_ext}'] = ": Add Comment";
		if(!D4600135D233F_LOCKOUT) { $templateArray['{add-user-comments}'] = 'block';
			if($_POST['add-user-comment']) {
				if($_POST['comments-text']) { $comments_text = $_POST['comments-text']; } else { $err[] = 'No text submitted'; }
				$date = new DateTime('now'); $date = $date->format('Y-m-d H:i:s');
				if(!$err) {
					$q_ins = sql("INSERT INTO `user_comments` (`uid`, `date`, `cuid`, `comment`, `resolution`) VALUES ('".$id."','".$date."','".$uid."','".$comments_text."','')");
					if($q_ins) { $templateArray['{message}'] = "Adding comments now..."; $templateForward = "console/index.php?t=user-editor&o=view-user-comments&id=".$id.""; } else { $err[] = sysMsg(8); }
				}
			}
		} else { $err[] = sysMsg('57'); $templateArray['{system-rights}'] = "none"; }//lockout mode
} //user

if($o == "edit-user-comments") { 
	if(!userSystemRights($uid, "edit_user")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
		$sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o=view-user-comments&id='.$id.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
		$templateArray['{sect_head_ext}'] = ": Edit Comment"; $fext = '&id='.$id.'&cid='.$cid;
		$templateArray['{edit-user-comments}'] = 'block';
			if($_POST['edit-user-comment']) {
				if($_POST['edit-comments-text']) { $edit_comments_text = $_POST['edit-comments-text']; } else { $err[] = 'No text submitted'; }
				$date = new DateTime('now'); $date = $date->format('Y-m-d H:i:s');
				if(!$err) {
					$q_ue = sql("SELECT `fname`, `lname` FROM `user_ext` WHERE `uid` = '".$uid."'"); $r_ue = mysqli_fetch_assoc($q_ue);
					$q_res = sql("SELECT `resolution` FROM `user_comments` WHERE `id` = '".$cid."'"); $r_res = mysqli_fetch_assoc($q_res);
					$builder = '<p>'.dateConvert($date,1).': '.$r_ue['fname'].' '.$r_ue['lname'].'</p>'.$edit_comments_text.'<hr />'.$r_res['resolution'];
					$q_upd = sql("UPDATE `user_comments` SET `resolution` = '".$builder."' WHERE `id` = '".$cid."'");
					if($q_upd) { $success[] = sysMsg(9); } else { $err[] = sysMsg(8); }
				}
			}
		$q_chk = sql("SELECT uc.date,uc.comment, uc.resolution, ue.fname, ue.lname FROM user_comments uc, user_ext ue WHERE uc.cuid=ue.uid AND uc.id = '".$cid."'"); $c_chk = mysqli_num_rows($q_chk);
		if(!$c_chk) { $templateArray['{system-rights}'] = "none"; $err[] = sysMsg('4'); } else { $r_chk = mysqli_fetch_assoc($q_chk);
			if($r_chk['resolution']) { $templateArray['{original-comments-text}'] .= $r_chk['resolution']; } 
			$templateArray['{original-comments-text}'] .= '<p>'.dateConvert($r_chk['date'],1).': '.$r_chk['fname'].' '.$r_chk['lname'].'</p>'.$r_chk['comment'];
			
		}
} //user

if($o == "view-user-radiation") { 
	if(!userSystemRights($uid, "view_radiation")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
		$templateArray['{lifetime}'] = 'block';
		
		if($del_id) {
			if($confirm) { $q_del = sql("DELETE FROM `radiation_manager` WHERE `id` = '".$del_id."'");
			if($q_del) { $success[] = sysMsg(13); } else { $err[] = sysMsg(14); }
			} else { $warning[] = sysMsg(15).'<a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o='.$o.'&id='.$id.'&did='.$del_id.'&confirm=1">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o='.$o.'&id='.$id.'">Cancel</a>.'; }
		}
		$q_chk = sql("SELECT `id` FROM `user` WHERE id = '".$id."'");
		$c_chk = mysqli_num_rows($q_chk);
		if(!$c_chk) { $templateArray['{system-rights}'] = "none"; $err[] = sysMsg('4'); } else {
			$q_rads = sql("SELECT `id`, `dose`, `date`, YEAR(date) AS `year` FROM `radiation_manager` WHERE `uid` ='".$id."' ORDER BY `date` DESC");
			$c_rads = mysqli_num_rows($q_rads);
			if($c_rads) {
				$num_limit = DISP_ROWS;
				if($c_rads > $num_limit) { //apply limits to query
				if(!$_GET['pg']) { $limit = " LIMIT 0, ".$num_limit.""; } else { $multi = cleanNumber($_GET['pg']); $row = ($multi * $num_limit) - $num_limit; $limit = " LIMIT ".$row.", ".$num_limit.""; }
				$q_rads = sql("SELECT `id`, `dose`, `date`, YEAR(date) AS `year` FROM `radiation_manager` WHERE `uid` ='".$id."' ORDER BY `date` DESC ".$limit."");
				$x = ceil($c_rads/$num_limit); $i = 1;
				while($i <= $x) { if($i == cleanNumber($_GET['pg'])) { $class = 'pagination_current'; } else { $class = 'pagination'; }
				$pagination .= '<a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o=view-user-radiation&id='.$id.'&pg='.$i.'" class="'.$class.'">'.$i.'</a>'; $i++; } }
				$i = 2;
				while($r_rads = mysqli_fetch_assoc($q_rads)) {
				$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
				if(!$max_date) { $max_date = $r_rads['date']; }
				$min_date = $r_rads['date'];
				if(is_numeric($r_rads['dose'])) { $total += $r_rads['dose']; $unit = " mSv"; } else { $unit = ""; }
				$rad_tbl .= '<tr '.$tr_style.'><td>'.$r_rads['date'].'</td><td>'.$r_rads['dose'].$unit.'</td>';
				if(userSystemRights($uid, "delete_radiation")) {
				$rad_tbl .= '<td><a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o='.$o.$fext.'&did='.$r_rads['id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a></td>'; } else { $rad_tbl.= '<td>&nbsp;</td>'; }
				$rad_tbl .= '</tr>';
				$i++;
				}
			$templateArray['{user-radiation}'] = '<table id="radiation" class="tablesorter"><thead><tr><th>Date</th><th>Dose (mSv)</th><th></th></thead><tbody>'.$rad_tbl.'</tbody></table>';
			$templateArray['{date_range}'] = $min_date.' - '.$max_date;
			if(!$total) { $total = "MIN"; }
			$templateArray['{total}'] = $total.' mSv';
			} else { $templateArray['{user-radiation}'] = "No Radiation Events have been recorded for this user."; $templateArray['{lifetime}'] = 'none'; }	
			
		} //if !chk
} //user


if($o == "view-user-credentials") { 
	if(!userSystemRights($uid, "view_credentials")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
		$q_chk = sql("SELECT `id` FROM `user` WHERE id = '".$id."'");
		$c_chk = mysqli_num_rows($q_chk);
		if(!$c_chk) { 
			$templateArray['{system-rights}'] = "none"; $err[] = sysMsg('4');
		} else {
		
		if($_POST['approve-cred']) {
			if(!userSystemRights($uid, "approve_credentials")) { $err[] = sysMsg('18'); } else {
				if(cleanNumber($_POST['cred_id'])) { $n = cleanNumber($_POST['cred_id']); } else { $n = $_POST['cred_id']; $err[] = sysMsg(4); }
				$date = new DateTime('now'); $date_ins = $date->format('Y-m-d H:i:s');
				if(!$err) { $q_upd_cred = sql("UPDATE `user_credentials` SET `app` = '', `app_uid` = '".$uid."', `app_date` = '".$date_ins."' WHERE `id` = '".$n."'"); if($q_upd_cred) { 
					$q_cred_name = sql("SELECT `name`, `tid` FROM `user_credentials` WHERE `id` = '".$n."'"); $r_cred_name = mysqli_fetch_assoc($q_cred_name);
					if($r_cred_name['tid']) { 
						$q_cred_name = sql("SELECT `name` FROM `type_list` WHERE `id` = '".$r_cred_name['tid']."'"); $r_cred_name = mysqli_fetch_assoc($q_cred_name);
					}
					include('../_functions/mailout.php');
					$tmp = sysMsg(35); $t_arr['{cred_name}'] = $r_cred_name['name']; $t_arr['{year}'] = date("Y", time()); $t_arr['{company}'] = EMAIL_COMPANY;
					foreach($t_arr as $k=>$v) { $ks[] = $k; $vs[] = $v; } $html = str_replace($ks, $vs, $tmp);
					$date_now = new DateTime('now'); $date_now = $date_now->format('Y-m-d');
					$q_email = sql("SELECT `email` FROM `user` WHERE `id` = '".$id."'");
					while($r_email = mysqli_fetch_assoc($q_email)) { $to[] = $r_email['email']; } $to_list = implode(",", $to);
						q_smtpmailer($to_list, NO_REPLY_EMAIL, WEBSITE_OWNER, 'Credential Approval Notification', $html, $date_now, MAIL_SEND_CODE);
					}			
				$success[] = sysMsg(9); } else { $err[] = sysMsg(8); }
			} //rights
		} //post
		
			$q_cred = sql("SELECT c.id, c.tid, c.date, c.name, c.app, c.link, c.archive, c.app_uid, c.app_date, ue.fname, ue.lname FROM user_credentials c LEFT JOIN user_ext ue ON c.app_uid=ue.uid WHERE c.uid = '".$id."'"); $i = 2;
			while($r_cred = mysqli_fetch_assoc($q_cred)) {
				if($r_cred['tid']) {
					$q_typ = sql("SELECT `name` FROM `type_list` WHERE `id` = '".$r_cred['tid']."'"); $r_typ = mysqli_fetch_assoc($q_typ); $name = $r_typ['name'];
				} else { $name = $r_cred['name']; }
				if($r_cred['archive']) { $status = "Archived"; 
				} elseif($r_cred['app']) { $status = "Not Approved";
					if(userSystemRights($uid, "approve_credentials")) {
						list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=user-editor&o='.$o.$fext);
						$status = $fhead.drawFld("hidden","cred_id",$r_cred['id']).drawFld("submit","approve-cred","Approve","","submit_sm").$fend; }
				} else { $status = "Approved"; }
				$date_now = new DateTime('now'); $date_now = $date_now->format('Y-m-d');
				if($r_cred['date'] < $date_now) { $date = '<span class="due_for_renewal">'.dateConvert($r_cred['date']).'</span>'; $status = "Expired"; } else { $date = dateConvert($r_cred['date']); }
				if(is_file(SERVER_PATH.FILES_DIR.$id.'/'.$r_cred['link'])) { $file = '<a href="'.WEBSITE_LOC.FILES_DIR.$id.'/'.$r_cred['link'].'" target="_blank">View</a>'; } else { $file = 'File not found'; }
				if($r_cred['app_date'] == '0000-00-00 00:00:00') { $date_app = 'Not recorded'; } else { $date_app = dateConvert($r_cred['app_date'],1); }
				$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
				$cred_tbl .= '<tr '.$tr_style.'><td>'.$name.'</td><td>'.$date.'</td><td>'.$file.'</td><td>'.$r_cred['fname'].' '.$r_cred['lname'].'</td><td>'.$date_app.'</td><td>'.$status.'</td></tr>'; $i++;
			}
			if(!$cred_tbl) { $cred_tbl = '<tr><td colspan="4">'.sysMsg('19').'</td></tr>'; }
		$templateArray['{user-cred}'] = '<table id="user_cred" class="tablesorter"><thead><tr><th>Credential Name</th><th>Date of Expiry</th><th>Document</th><th>Approved by</th><th>Date Approved</th><th>Status</th></thead><tbody>'.$cred_tbl.'</tbody></table>';
		} //if !chk
} //user

//Nav
foreach($sec_opts as $k => $v) { if($v == $o) { $c = "sect_nav_c"; $disp = "block"; $templateArray['{sect_head_ext}'] = ": ".$k; } else { $c = "sect_nav"; $disp = "none"; }
$templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o='.$v.'&id='.$id.'" class="'.$c.'">'.$k.'</a>'; $templateArray['{'.$v.'}'] = $disp; }

if(!$templateArray['{section_nav}']) { $templateArray['{section_nav}'] = ""; }

if(!$sect_head) { $sect_head = "Error"; }
if(!$templateArray['{sect_head}']) { $templateArray['{sect_head}'] = $sect_head; }
if(!$templateArray['{sect_head_ext}']) { $templateArray['{sect_head_ext}'] = ""; }
if(!$templateArray['{sect_head_rt}']) { $templateArray['{sect_head_rt}'] = $sect_nav_ext; }

if(!$templateArray['{success}']) { $templateArray['{success}'] = writeMsgs($success, "success"); }
if(!$templateArray['{warning}']) { $templateArray['{warning}'] = writeMsgs($warning, "warning"); }
if(!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($err); }
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=user-editor&o='.$o.$fext);

//for user add
$templateArray['{fhead-user}'] = $fhead; $templateArray['{fend-user}'] = $fend;
$templateArray['{fn}'] = drawFld("text","fn",$fn,"First Name");
$templateArray['{ln}'] = drawFld("text","ln",$ln,"Last Name");
$templateArray['{usr}'] = drawFld("text","usr",$usr,"Username","","",1);
$templateArray['{e}'] = drawFld("text","e",$e,"Email");
$templateArray['{title}'] = drawFld("text","title",$title,"Job Title");
$templateArray['{pass1}'] = drawFld("password","pass1","","Password");
$templateArray['{pass2}'] = drawFld("password","pass2","","Confirm Password");
$templateArray['{ext}'] = drawFld("text","ext",$ext,"Extension");
$templateArray['{mob}'] = drawFld("text","mob",$mob,"Mobile");
if(checkModule('tap-and-learn')) { $templateArray['{tapandlearn}'] = '<p>'.drawFld("text","tapandlearn",$tapandlearn,"Tap & Learn ID").'</p>';
} else { $templateArray['{tapandlearn}'] = ''; }
$act_arr = array("0" => "Disabled","1" => "Active"); if(!$act) { $act = "0"; }
$templateArray['{act}'] = drawSelect("act",$act_arr ,$act,"Status");

$q_unit = sql("SELECT * FROM `type_list` WHERE `group` = 'units' ORDER BY `name` ASC");
$unit_arr[0] = 'All Units';
while($r_unit = mysqli_fetch_assoc($q_unit)) { $unit_arr[$r_unit['id']] = $r_unit['name']; }
$templateArray['{unit}'] = drawSelect("unit",$unit_arr,$unit,"Unit");

$templateArray['{submit-user}'] = drawFld("submit","edit-user","Update User","&nbsp;","submit");
//for groups
$templateArray['{fhead-group}'] = $fhead; $templateArray['{fend-group}'] = $fend;
if(!$templateArray['{group-mail-data}']) { $templateArray['{group-mail-data}'] = "There are no mail groups currently defined."; }
$templateArray['{submit-group}'] = drawFld("submit","edit-groups","Update Groups","","submit");

$templateArray['{fhead-managers}'] = '<form method="post" action="'.WEBSITE_LOC.'console/index.php?t=user-editor&o='.$o.$fext.'" id="managers" onsubmit="selectAllOptions(\'sm\');" >';$templateArray['{fend-managers}'] = '</form>';
$templateArray['{submit-managers}'] = drawFld("submit","edit-managers","Update Managers","","submit");

if(!$templateArray['{add-user-comments}']) { $templateArray['{add-user-comments}'] = 'none'; }
$templateArray['{fhead-add-user}'] = $fhead; $templateArray['{fend-add-user}'] = $fend;
$templateArray['{submit-add-user-comment}'] = drawFld("submit","add-user-comment","Add comment","","submit");
$templateArray['{comments-text}'] = drawTxtBox("comments-text",$comments_text);

if(!$templateArray['{edit-user-comments}']) { $templateArray['{edit-user-comments}'] = 'none'; }
$templateArray['{fhead-edit-user}'] = $fhead; $templateArray['{fend-edit-user}'] = $fend;
$templateArray['{submit-edit-user-comment}'] = drawFld("submit","edit-user-comment","Update comments","","submit");
$templateArray['{edit-comments-text}'] = drawTxtBox("edit-comments-text",$edi_comments_text);


if(!$templateArray['{pagination}']) { $templateArray['{pagination}'] = '<p>'.$pagination.'</p>'; }
if(!$templateArray['{lifetime}']) { $templateArray['{lifetime}'] = 'none'; }
if(!$templateArray['{user-radiation}']) { $templateArray['{user-radiation}'] = ''; }
if(!$templateArray['{view-user-credentials}']) { $templateArray['{view-user-credentials}'] = 'none'; }
?>