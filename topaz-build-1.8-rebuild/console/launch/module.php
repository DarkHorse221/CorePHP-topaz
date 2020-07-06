<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
$templateArray['{img_link}'] = WEBSITE_LOC."console/_images/";
if ($_GET['del']) {
    $q_del = sql("DELETE FROM `user_sessions` WHERE `uid` = '".cleanNumber($_GET['del'])."'");
    if ($q_del) {
        $success[] = sysMsg(13);
    } else {
        $err[] = sysMsg(14);
    }
}
$uid = userID($sid);
$q_user = sql("
	SELECT u.id, u.uname, us.session_exp, ue.fname, ue.lname
	FROM user u
	INNER JOIN user_ext ue ON u.id=ue.uid
	INNER JOIN (
		SELECT uid, MAX(session_exp) as session_exp
		FROM `user_sessions` GROUP BY uid
	) us ON u.id=us.uid
	ORDER BY ue.fname ASC
");
$c_user = mysqli_num_rows($q_user);

if (!$c_user) {
    $templateArray['{logged-users}'] = 'There are no logged in users.';
} else {
    $num_limit = DISP_ROWS_LAUNCH;
    if ($c_user > $num_limit) {
        //apply limits to query
        if (!$_GET['pg']) {
            $limit = " LIMIT 0, ".$num_limit."";
        } else {
            $multi = cleanNumber($_GET['pg']);
            $row = ($multi * $num_limit) - $num_limit;
            $limit = " LIMIT ".$row.", ".$num_limit."";
        }
        $q_user = sql("
		SELECT u.id, u.uname, us.session_exp, ue.fname, ue.lname
			FROM user u
			INNER JOIN user_ext ue ON u.id=ue.uid
			INNER JOIN (
				SELECT uid, MAX(session_exp) as session_exp
				FROM `user_sessions` GROUP BY uid
			) us ON u.id=us.uid
			ORDER BY ue.fname ASC
		".$limit."");
        //create
        $x = ceil($c_user/$num_limit);
        $i = 1;
        while ($i <= $x) {
            if ($i == cleanNumber($_GET['pg'])) {
                $class = 'pagination_current';
            } else {
                $class = 'pagination';
            }
            $pagination .= '<a href="'.WEBSITE_LOC.'console/index.php?t=launch&pg='.$i.'" class="'.$class.'">'.$i.'</a>';
            $i++;
        }
    }
    $i = 2;
    while ($r_user = mysqli_fetch_assoc($q_user)) {
        $int = $i/2;
        if (is_int($int)) {
            $tr_style = 'class = "odd"';
        } else {
            $tr_style = '';
        }
        if ($uid == $r_user['id']) {
            $del = '';
        } else {
            $del = '<a href="'.WEBSITE_LOC.'console/index.php?t=launch&del='.$r_user['id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a>';
        }
        $log_u .= '<tr '.$tr_style.'><td>'.$r_user['uname'].'</td><td>'.$r_user['fname'].' '.$r_user['lname'].'</td><td>'.$r_user['session_exp'].'</td><td>'.$del.'</td></tr>';
        $i++;
    }
    $templateArray['{logged-users}'] = '<table class="tablesorter"><tbody>'.$log_u.'</tbody></table>';
}

$launch = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager"><img src="'.WEBSITE_LOC.'console/_images/user-manager.jpg" class="img" /></a>';
if (checkModule('media-manager') && $cmod['media-manager']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=media-manager"><img src="'.WEBSITE_LOC.'console/_images/media-manager.jpg" class="img" /></a>';
}

if (checkModule('radiation-manager') && $cmod['radiation-manager']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=radiation-manager"><img src="'.WEBSITE_LOC.'console/_images/radiation-manager.jpg" class="img" /></a>';
}
if (checkModule('bulletin-board') && $cmod['bulletin-board']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=bulletin-board"><img src="'.WEBSITE_LOC.'console/_images/bulletin-board.jpg" class="img" /></a>';
}
$launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager"><img src="'.WEBSITE_LOC.'console/_images/document-manager.jpg" class="img" /></a>';
if (checkModule('education-tracker') && $cmod['education-tracker']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker"><img src="'.WEBSITE_LOC.'console/_images/education-tracker.jpg" class="img" /></a>';
}
if (checkModule('rt-qa-audits') && $cmod['rt-qa-audits']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=rt-qa-audits"><img src="'.WEBSITE_LOC.'console/_images/rt-qa.jpg" class="img" /></a>';
}
if (checkModule('machine-qa') && $cmod['machine-qa']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa"><img src="'.WEBSITE_LOC.'console/_images/machine-qa.jpg" class="img" /></a>';
}
if (checkModule('faults') && $cmod['faults']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=faults"><img src="'.WEBSITE_LOC.'console/_images/faults.jpg" class="img" /></a>';
}
if (checkModule('quality-improvement') && $cmod['quality-improvement']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=quality-improvement"><img src="'.WEBSITE_LOC.'console/_images/quality-improvement.jpg" class="img" /></a>';
}
if (checkModule('checklist-manager') && $cmod['checklist-manager']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=checklist-manager"><img src="'.WEBSITE_LOC.'console/_images/quality-improvement.jpg" class="img" /></a>';
}
if (checkModule('qa-audits') && $cmod['qa-audits']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits"><img src="'.WEBSITE_LOC.'console/_images/qa-audits.jpg" class="img" /></a>';
}
if (checkModule('reports') && $cmod['reports']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=reports"><img src="'.WEBSITE_LOC.'console/_images/reports.jpg" class="img" /></a>';
}
if (checkModule('system') && $cmod['system']) {
    $launch .= '<a href="'.WEBSITE_LOC.'console/index.php?t=system"><img src="'.WEBSITE_LOC.'console/_images/system.jpg" class="img" /></a>';
}

if (!$templateArray['{launch}']) {
    $templateArray['{launch}'] = $launch;
}

if (!$templateArray['{success}']) {
    $templateArray['{success}'] = writeMsgs($success, "success");
}
if (!$templateArray['{error}']) {
    $templateArray['{error}'] = writeMsgs($err);
}
if (!$templateArray['{pagination}']) {
    $templateArray['{pagination}'] = '<p>'.$pagination.'</p>';
}

//get documents added last week
//where date_end is the latest date
$date_today = date("Y-m-d", time());
//and date start is 7 days prior to date end
$date_7daysago = date('Y-m-d', (strtotime('-7 day', strtotime($date_today))));
    while ($date_today > $date_7daysago) {
        //add a day each time
        $date_7daysago = date('Y-m-d', (strtotime('+1 day', strtotime($date_7daysago))));
        //get document data
        $q_docadds = sql("SELECT DISTINCT DATE(imp_date) as imp_date, COUNT(*) as `count` FROM document_properties WHERE imp_date = '".$date_7daysago."' GROUP BY imp_date");
        $r_docadds = mysqli_fetch_assoc($q_docadds);
        if ($date_7daysago == $r_docadds['imp_date']) {
            $counter .= "".$r_docadds['count'].",";
        } else {
            $counter .= "0,";
        }
        $day_arr .= "'".date('D', strtotime($date_7daysago))."',";
    }
$templateArray['{days-list}'] = substr($day_arr, 0, -1);
$templateArray['{days-list-data}'] = substr($counter, 0, -1);

//get User logins for last week
//where date_end is the latest date
$day_arr = ''; $counter = '';
$date_today = date("Y-m-d", time());
//and date start is 7 days prior to date end
$date_7daysago = date('Y-m-d', (strtotime('-7 day', strtotime($date_today))));
    while ($date_today > $date_7daysago) {
        //add a day each time
        $date_7daysago = date('Y-m-d', (strtotime('+1 day', strtotime($date_7daysago))));
        //get document data
        $q_userlist = sql("SELECT DATE(created_date) as `date`, count(*) as `count` FROM `audit_events` WHERE type = 'userlogin' AND DATE(created_date) = '".$date_7daysago."' GROUP BY DATE(created_date)");
        $r_userlist = mysqli_fetch_assoc($q_userlist);
        if ($date_7daysago == $r_userlist['date']) {
            $counter .= "".$r_userlist['count'].",";
        } else {
            $counter .= "0,";
        }
        $day_arr .= "'".date('D', strtotime($date_7daysago))."',";
    }
$templateArray['{days-user-list}'] = substr($day_arr, 0, -1);
$templateArray['{days-user-data}'] = substr($counter, 0, -1);

//get documents by type
$counter = '';
$q_org_count = sql("SELECT COUNT(*) AS `count` FROM `document_properties` WHERE doc_type != 37"); $r_org_count = mysqli_fetch_assoc($q_org_count);
$q_doc_type = sql("SELECT `id`, `name` FROM type_list WHERE `group` = 'doc_type' AND `id` != 37 ORDER BY `name` ASC");
while ($r_doc_type = mysqli_fetch_assoc($q_doc_type)) {
    $doc_arr .= "'".$r_doc_type['name']."',";
    $q_doc_count = sql("SELECT COUNT(*) AS `count` FROM `document_properties` WHERE doc_type = ".$r_doc_type['id']."");
    $r_doc_count = mysqli_fetch_assoc($q_doc_count);
    if ($r_doc_count['count']) {
        $counter .= "{value:".$r_doc_count['count'].", name:'".$r_doc_type['name']."'},";
    }
}
$templateArray['{doctype-count}'] = $r_org_count['count'];
$templateArray['{doctype-legend}'] = substr($doc_arr, 0, -1);
if ($counter) {
    $templateArray['{doctype-data}'] = substr($counter, 0, -1);
} else {
    $templateArray['{doctype-data}'] = '';
}
