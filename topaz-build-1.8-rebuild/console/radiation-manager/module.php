<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
//set options
$uid = userID($sid);
$o = cleanInput($_GET['o']); if(!$o) { $o = "view-radiation"; }
$g = cleanInput($_GET['g']); if(!$g) { $g = "multiple"; }

$sec_opts = array("View Radiation" => "view-radiation","Add Radiation Records" => "add-radiation");
$sect_head = "Radiation Manager";

if($o == "add-radiation") {
	if(!userSystemRights($uid, "add_radiation")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
	$grp = "&g=".$g;
	if($g == "single") { $nav_ext = " (Single User)"; } else { $nav_ext = " (Multiple Users)"; }
	$sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=radiation-manager"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a><a href="'.WEBSITE_LOC.'console/index.php?t=radiation-manager&o='.$o.'&g=single"><img src="'.WEBSITE_LOC.'console/_images/single-user.gif" class="img" /></a><a href="'.WEBSITE_LOC.'console/index.php?t=radiation-manager&o='.$o.'&g=multiple"><img src="'.WEBSITE_LOC.'console/_images/multiple-user.gif" class="img" /></a>';
	if(!D4600135D233F_LOCKOUT) {
	
		if($_POST['add-rads']) {
			$new_date = cleanString($_POST['date-single']); $usr = cleanInput($_POST['single-user']); $dose = cleanString($_POST['dose']);
			if(!$usr) { $err[] = "User: You must select a user before inserting."; } if(!$dose) { $err[] = "Radiation Dose: You must enter a value."; } else {
			if(!check_dose_format($dose)) { $err[] = "Radiation Dose: Invalid dose format."; } }
		
			if(!$err) { 
				$dose = check_dose_format($dose);
				$q_dose = sql("INSERT INTO `radiation_manager` (`uid`, `dose`, `date`) VALUES ('".$usr."','".$dose."','".$new_date."')");
				if($q_dose) { $success[] = sysMsg(9); $dose = ""; $new_date= ""; $usr = ""; } else { $err[] = sysMsg(8); }
			} //!err
		}
		
		if($_POST['add-rads-multi']) {
			$new_date = cleanString($_POST['date-single']);
			foreach($_POST as $k=>$v) {
				if(is_numeric($k)) { if($v) { if(!check_dose_format($v)) { $err[] = "Radiation Dose: Invalid dose format."; }
					if(!$err) {	$v = check_dose_format($v);	$q_dose = sql("INSERT INTO `radiation_manager` (`uid`, `dose`, `date`) VALUES ('".$k."','".$v."','".$new_date."')");
						if($q_dose) { $success[] = sysMsg(9); $v = ""; $k = ""; } else { $err[] = sysMsg(8); }}
					}}
			}
			if($success) { unset($_POST); }
		}
	
		//do anyway
		if($g == "single") {
			$u_arr['0'] = "Please select a user";
			$q_user = sql("SELECT u.id, ue.fname, ue.lname FROM user u, user_ext ue WHERE u.id=ue.uid AND u.active = '1' AND u.id !='1' ORDER BY ue.fname ASC");
			while($r_user = mysqli_fetch_assoc($q_user)) {
				if(userSystemRights($r_user['id'], "radiation")) { $u_arr[''.$r_user['id'].''] = $r_user['fname'].' '.$r_user['lname']; }
			} //while
			$select_user = drawSelect("single-user",$u_arr ,$usr,"Select user");
		}
		
		if($g == "multiple") {
			$q_user = sql("SELECT u.id, ue.fname, ue.lname FROM user u, user_ext ue WHERE u.id=ue.uid AND u.active = '1' AND u.id !='1' ORDER BY ue.fname ASC");
			while($r_user = mysqli_fetch_assoc($q_user)) {
				if(userSystemRights($r_user['id'], "radiation")) { 
				
				if($_POST['add-rads-multi']) { if($_POST[''.$r_user['id'].'']) { $val = $_POST[''.$r_user['id'].'']; } else { $val = ""; } }
				
				$multi .= '<tr><td>'.$r_user['fname'].' '.$r_user['lname'].'</td><td>'.drawFld("input",$r_user['id'],$val, "").'</td></tr>'; }
			} //while
			$templateArray['{dose}'] = '<table class="tablesorter" id="radiation"><thead><tr><th>User</th><th>Dose</th></thead><tbody>'.$multi.'</tbody></table>';
			$templateArray['{submit-radiation}'] = drawFld("submit","add-rads-multi","Add Radiation Records", "", "submit");
		}
	} else { $err[] = sysMsg('57'); $templateArray['{system-rights}'] = "none"; }//lockout mode
} //add-radiation

if($o == "view-radiation") {
	if(!userSystemRights($uid, "view_radiation")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
	$sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=radiation-manager&o=add-radiation"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
	$q_users = sql("SELECT ue.fname, ue.lname, u.id FROM user_rights ur INNER JOIN user_groups ug ON ug.rid = ur.id LEFT JOIN user_ext ue ON ue.uid=ug.uid LEFT JOIN user u ON ue.uid=u.id WHERE ur.radiation = '1' AND u.active='1' GROUP BY u.id, ue.fname, ue.lname ORDER BY ue.fname ASC");
	$c_users = mysqli_num_rows($q_users);
	if($c_users) {
		while($r_users = mysqli_fetch_assoc($q_users)) {
			$q_rads = sql("SELECT dose, date FROM radiation_manager WHERE uid = '".$r_users['id']."' ORDER BY `date` DESC");
			$c_rads = mysqli_num_rows($q_rads);
			if($c_rads) {
			$r_rads = mysqli_fetch_assoc($q_rads);
			$usr_tbl .= '<tr><td><a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o=view-user-radiation&id='.$r_users['id'].'">'.$r_users['fname'].' '.$r_users['lname'].'</a></td><td>'.$r_rads['date'].'</td><td>'.$r_rads['dose'].'</td></tr>';
			}
		}
		$templateArray['{view-radiation-data}'] = '<table id="radiation" class="tablesorter"><thead><tr><th>User</th><th>Date</th><th>Dose (mSv)</th></thead><tbody>'.$usr_tbl.'</tbody></table>';
	} else { $templateArray['{view-radiation-data}'] = sysMsg(19); }
	

}


foreach($sec_opts as $k => $v) { if($v == $o) { $c = "sect_nav_c"; $disp = "block"; $templateArray['{sect_head_ext}'] = ": ".$k.$nav_ext; } else { $c = "sect_nav"; $disp = "none"; }
$templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t=radiation-manager&o='.$v.'" class="'.$c.'">'.$k.'</a>'; $templateArray['{'.$v.'}'] = $disp; }

if(!$templateArray['{section_nav}']) { $templateArray['{section_nav}'] = ""; }

if(!$sect_head) { $sect_head = "Error"; }
if(!$templateArray['{sect_head}']) { $templateArray['{sect_head}'] = $sect_head; }
if(!$templateArray['{sect_head_ext}']) { $templateArray['{sect_head_ext}'] = ""; }
if(!$templateArray['{sect_head_rt}']) { $templateArray['{sect_head_rt}'] = $sect_nav_ext; }

if(!$templateArray['{success}']) { $templateArray['{success}'] = writeMsgs($success, "success"); }
if(!$templateArray['{warning}']) { $templateArray['{warning}'] = writeMsgs($warning, "warning"); }
if(!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($err); }
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=radiation-manager&o='.$o.$grp);

//for add radiation
$templateArray['{fhead}'] = $fhead; $templateArray['{fend}'] = $fend;
if(!$templateArray['{submit-radiation}']) { $templateArray['{submit-radiation}'] = drawFld("submit","add-rads","Add Radiation Record", "&nbsp;", "submit"); }

//single user
if(!$templateArray['{select-user}']) { $templateArray['{select-user}'] = "<p>".$select_user."</p>"; }
if(!$new_date) { $date = new DateTime('now'); $new_date = $date->format('Y-m-d'); } //$date->add(new DateInterval('P1Y'));
if(!$templateArray['{date-single}']) { $templateArray['{date-single}'] = $new_date; }
if($g == "single") { $templateArray['{dose}'] = drawFld("input","dose",$dose, "Radiation Dose", "sm"); } 
if(!$templateArray['{dose}']) { $templateArray['{dose}'] = ""; }
?>