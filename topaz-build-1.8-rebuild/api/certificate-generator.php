<?php define('TOPAZ', true);
error_reporting(E_ERROR | E_WARNING | E_PARSE); ini_set("display_errors", 1);
include('../_constants/constants.php'); include('../_constants/db.php'); include('../_functions/strings.php'); include('../_functions/requests.php'); $uid = cleanNumber($_GET['uid']); $eid = cleanNumber($_GET['eid']); $sid = cleanString($_GET['id']);

if(!$uid || !$eid) { echo "<p>Un-authorise access detected. Script has been terminated.</p>"; } else { $log_user = userID($sid);
	if(!($log_user == $uid)) { echo "<p>Un-authorise access detected. Script has been terminated.</p>"; } else {
		$q_temp = sql("SELECT `text` FROM `system_templates` WHERE `id` = '53'"); $r_temp = mysqli_fetch_assoc($q_temp); 
		$q_event = sql("SELECT DATE_FORMAT(ei.start,'%D %M %Y') AS date, e.name, e.credits, uee.fname, uee.lname FROM user_education ue LEFT JOIN education_ins ei ON ue.ins_date_id = ei.id LEFT JOIN education e ON ei.eid=e.id LEFT JOIN user_ext uee ON uee.uid=ue.uid WHERE ue.ins_date_id = '".$eid."' AND ue.uid = '".$uid."'"); $c_event = mysqli_num_rows($q_event);
		if(!$c_event) { echo "<p>Un-authorise tampering detected. Script has been terminated.</p>";
		} else {
			$r_event = mysqli_fetch_assoc($q_event);
			$list['{name}'] = $r_event['fname'].' '.$r_event['lname'];
			$list['{event}'] = $r_event['name']; $list['{date}'] = $r_event['date'];
			$temp = $r_temp['text']; $html = replaceText($list,$temp);
			
			include("mpdf/mpdf.php");
			$mpdf=new mPDF('utf-8 s', 'A4-L'); 
			$mpdf->simpleTables = true;
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->WriteHTML($html);
			$mpdf->Output(); 
			exit;
		}
	}
}
?>