<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
//set options
$uid = userID($sid); $id = cleanNumber($_GET['id']); $dataid = cleanNumber($_GET['dataid']); $datavid = cleanNumber($_GET['datavid']); $s_date = cleanInput($_GET['s_date']); $e_date = cleanInput($_GET['e_date']); $norecord = cleanNumber($_GET['norecord']); $run = cleanNumber($_GET['run']);

$sec_opts = array("View Reports" => "reports");
$o = cleanInput($_GET['o']); if(!$o) { $o = 'reports'; } //set default

//update preferences if available
if(cleanString($_GET['upactive']) == 'yes') {
	updUserPreference($uid, 'view-active-reports', 1);
}
if(cleanString($_GET['upactive']) == 'no') {
	updUserPreference($uid, 'view-active-reports', 0);
}
//get user preferences
$usr_p = userPreference($uid,'view-active-reports');
if(!$usr_p) {
	$active = " WHERE f.status != 0";
	$activea = " AND c.status != 0";
	$templateArray['{checked}'] = '';
} else {
	$active = "";
	$activea = "";
	$templateArray['{checked}'] = 'checked';
}

if($o == "reports") {
	if(!userSystemRights($uid, "view_reports")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
	if(!$err) {
		$q_data = sql("SELECT * FROM `reports` WHERE `active` = '1' ORDER BY `name` ASC");
		$c_data = mysqli_num_rows($q_data);
		if(!$c_data) { $templateArray['{reports_data}'] = sysMsg(19); } else { $i=2;
			while($r_data = mysqli_fetch_assoc($q_data)) {
				$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
				$tbls .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=view-report&id='.$r_data['id'].'">'.$r_data['name'].'</a></td></tr>'; $i++;
			}
			$templateArray['{reports_data}'] = '<table class="tablesorter" id="reports"><thead><tr><th>Report Name</th></tr></thead><tbody>'.$tbls.'</tbody></table>';
		}
	} //!$err
}

if($o == "view-report") {
	$sect_nav_rt = '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=reports"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
	if(!userSystemRights($uid, "view_reports")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
	if(!$err) {
		$q_chk = sql("SELECT * FROM `reports` WHERE `id` = '".$id."'"); $c_chk = mysqli_num_rows($q_chk);
		if(!$c_chk) { $err[] = sysMsg(4); $templateArray['{system-rights}'] = "none";  } else {
			$r_chk = mysqli_fetch_assoc($q_chk); $templateArray['{sect_head_ext}'] = ': View Report ('.$r_chk['name'].')';
			//do configuration
			if($r_chk['configure']) {
				$templateArray['{view-report}'] = "none"; $templateArray['{view-configure}'] = "block";
				include(SERVER_PATH.'console/reports/'.$r_chk['link']);
			} else {
			
			//do execute direct report
			$templateArray['{view-report}'] = "block"; $templateArray['{view-configure}'] = "none";
			if($run) { 
				$date_now = new DateTime('now'); $date_now = $date_now->format('Y-m-d H:i:s');
				$q_exec = sql("INSERT INTO `reports_ext` (`rid`, `uid`, `date`) VALUES ('".$id."', '".$uid."', '".$date_now."')");
				include(SERVER_PATH.'console/reports/'.$r_chk['link']);
			}
			
			$templateArray['{execute}'] = '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=view-report&id='.$r_chk['id'].'&run=1" class="text-submit">Execute Report</a>';
			
			$q_his = sql("SELECT ue.fname, ue.lname, re.date FROM reports_ext re LEFT JOIN user_ext ue ON re.uid=ue.uid WHERE re.rid = '".$id."' ORDER BY re.date DESC"); $c_his = mysqli_num_rows($q_his);
			if(!$c_his) { $templateArray['{history}'] = '<p>'.sysMsg(19).'</p>';  } else { $i=2;
				while($r_his = mysqli_fetch_assoc($q_his)) {
					$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
					$his .= '<tr '.$tr_style.'><td>'.$r_his['date'].'</td><td>'.$r_his['fname'].' '.$r_his['lname'].'</td></tr>'; $i++;
				}
				$templateArray['{history}'] = '<table class="tablesorter" id="report-history"><thead><tr><th>Date</th><th>Executed by</th></tr></thead><tbody>'.$his.'</tbody></table>';
			}
			}
		} //$c_data
	} //!$err
}

//Nav
foreach($sec_opts as $k => $v) { if($v == $o) { $c = "sect_nav_c"; $disp = "block"; $templateArray['{sect_head_ext}'] = ": ".$k; } else { $c = "sect_nav"; $disp = "none"; }
$templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$v.'&id='.$id.'" class="'.$c.'">'.$k.'</a>'; $templateArray['{'.$v.'}'] = $disp; }
if(!$templateArray['{sect_head_rt}']) { $templateArray['{sect_head_rt}'] = $sect_nav_rt; }
if(!$templateArray['{sect_head_ext}']) { $templateArray['{sect_head_ext}'] = $sect_nav_ext; }
if(!$templateArray['{success}']) { $templateArray['{success}'] = writeMsgs($success, "success"); }
if(!$templateArray['{warning}']) { $templateArray['{warning}'] = writeMsgs($warning, "warning"); }
if(!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($err); }
if(!$templateArray['{view-report}']) { $templateArray['{view-report}'] = 'none'; }
if(!$templateArray['{view-configure}']) { $templateArray['{view-configure}'] = 'none'; }
if(!$templateArray['{history}']) { $templateArray['{history}'] = ''; }
if(!$templateArray['{execute}']) { $templateArray['{execute}'] = ''; }
if(!$templateArray['{execute-audit}']) { $templateArray['{execute-audit}'] = ''; }
if(!$templateArray['{checklists}']) { $templateArray['{checklists}'] = ''; }
if(!$templateArray['{data-fields}']) { $templateArray['{data-fields}'] = ''; }
if($form_exec) { list($fhead, $fend) = drawFormTags('p', $form_exec); }
$templateArray['{fhead}'] = $fhead; $templateArray['{fend}'] = $fend;

$templateArray['{checkedurl}'] = WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$o.'&id='.$id.'&upactive=yes';
$templateArray['{checkedurlfalse}'] = WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$o.'&id='.$id.'&upactive=no';
if($dataid || $datavid) {
	$templateArray['{view-configure-data}'] = 'none';
} else {
	$templateArray['{view-configure-data}'] = 'block';
}

?>