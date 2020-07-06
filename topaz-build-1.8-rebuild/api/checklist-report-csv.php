<?php define('TOPAZ', true);
error_reporting(E_ERROR | E_WARNING | E_PARSE); ini_set("display_errors", 1);
include('../_constants/constants.php'); include('../_constants/db.php'); include('../_functions/strings.php'); include('../_functions/requests.php');
	
	$csv_terminated = "\n";
	$csv_separator = ",";
	$csv_enclosed = '"';
	$csv_escaped = "\\";

	session_start(); $sid = session_id(); $uid = userID($sid);
	$s_date_org = cleanInput($_POST['s_date']); $e_date_org = cleanInput($_POST['e_date']);
	$lid = cleanNumber($_POST['listid']); $mid = cleanNumber($_POST['mid']); $vid = cleanNumber($_POST['vid']);
	if(!$s_date_org) { $s_date = new DateTime('now'); } else { $s_date = new DateTime($s_date_org); } $s_date = $s_date->format('d/m/Y');
	if(!$e_date_org) { $e_date = new DateTime('now'); } else { $e_date = new DateTime($e_date_org); } $e_date = $e_date->format('d/m/Y');
	
	$q_usr = sql("SELECT `fname`, `lname` FROM `user_ext` WHERE `uid` = '".$uid."'"); $r_usr = mysqli_fetch_assoc($q_usr);
	$user = $r_usr['fname'].' '.$r_usr['lname'];
	
	if($s_date) { $sn_date = new DateTime($s_date_org); $sn_date = $sn_date->format('Y-m-d 00:00:01'); $q_dates = " AND f.date >= '".$sn_date."'"; }
	if($e_date) { $en_date = new DateTime($e_date_org); $en_date = $en_date->format('Y-m-d 23:59:59'); $q_dates .= " AND f.date <= '".$en_date."'"; }
		
	//first get all columns by getting all the questions and also put the question ids in an array
	$q_ques = sql("SELECT `id`, `question`, `type` FROM `qi_q` WHERE `feid` = '".$vid."' ORDER BY `order` ASC");
	while ($r_ques = mysqli_fetch_assoc($q_ques)) {
		$tbl_header .= $csv_enclosed.str_replace('&#39;','\'',strtolower($r_ques['question'])).$csv_enclosed.$csv_separator;
		$ques_arr[$r_ques['id']] = $r_ques['type'];
	}

	//now query all responses for the version within the date range specified
	$q_rec = sql("SELECT f.id, u.name AS unit_name, m.name AS mach_name, m.manufacturer, m.serial_no, f.date, t.name AS status, f.comments, f.related_faults, ue.fname, ue.lname, f.feid FROM qi_responses f
			LEFT JOIN machines m ON f.mid=m.id
			LEFT JOIN type_list t ON f.status=t.id
			LEFT JOIN user_ext ue ON f.uid=ue.uid
			LEFT JOIN type_list u ON f.unit=u.id
			WHERE f.feid = '".$vid."' ".$q_dates." ORDER BY f.id DESC");
	$c_rec = mysqli_num_rows($q_rec);
	
	if(!$c_rec) { $data_record = sysMsg(19); } else { 
	
	while($r_rec = mysqli_fetch_assoc($q_rec)) {
			//for each record row display fixed response data
				$data .= $csv_enclosed.str_replace('&#39;','\'',$r_rec['id']).$csv_enclosed.$csv_separator;
				if(!$r_rec['unit_name']) { $unit = 'All Units'; } else { $unit = $r_rec['unit_name']; }
				$data .= $csv_enclosed.str_replace('&#39;','\'',$unit).$csv_enclosed.$csv_separator;
				$data .= $csv_enclosed.str_replace('&#39;','\'',$r_rec['mach_name']).$csv_enclosed.$csv_separator;
				$data .= $csv_enclosed.str_replace('&#39;','\'',$r_rec['manufacturer']).$csv_enclosed.$csv_separator;
				$data .= $csv_enclosed.str_replace('&#39;','\'',$r_rec['serial_no']).$csv_enclosed.$csv_separator;
				$data .= $csv_enclosed.str_replace('&#39;','\'',$r_rec['date']).$csv_enclosed.$csv_separator;
				$data .= $csv_enclosed.str_replace('&#39;','\'',$r_rec['status']).$csv_enclosed.$csv_separator;
				$data .= $csv_enclosed.str_replace('&#39;','\'',$r_rec['related_faults']).$csv_enclosed.$csv_separator;
				$data .= $csv_enclosed.str_replace('&#39;','\'',$r_rec['fname'].' '.$r_rec['lname']).$csv_enclosed.$csv_separator;
				
				//remove some unwanted bits from comments
				$comments = str_replace('<p>','',$r_rec['comments']);
				$comments = str_replace('</p>','',$comments);
				$comments = str_replace('<br />','',$comments);
				$comments = str_replace('<br>','',$comments);
				$comments = str_replace(',','',$comments);
				$comments = str_replace('\'','',$comments);
				$data .= $csv_enclosed.str_replace('&#39;','\'',$comments).$csv_enclosed.$csv_separator;
								
			//Now get each row data records for each question based on the question array
			foreach($ques_arr as $k => $v) {
				$q_multi = sql("SELECT answer FROM qi_responses_ext WHERE frid = '".$r_rec['id']."' AND fqid = '".$k."'");
				$c_multi = mysqli_num_rows($q_multi);
				if($c_multi) {
					$r_multi = mysqli_fetch_assoc($q_multi);
					if(($v == 'checkbox') || ($v == 'radio') || ($v == 'singleselect')) {
						$q_opt = sql("SELECT `option` FROM qi_q_ext WHERE id = '".$r_multi['answer']."'");
						$r_opt = mysqli_fetch_assoc($q_opt);
						$resp = $r_opt['option'];
					} else {
						$resp = $r_multi['answer'];
					}
				} else {
						$resp = '';
				}
				$data .= $csv_enclosed.str_replace('&#39;','\'',$resp).$csv_enclosed.$csv_separator;
					
			} //foreach
			
			$data .= $csv_terminated;
			
		} //while
	} //end no records
	
	//do some data santising
	$tbl_header = substr($tbl_header, 0, -1);

	$out .= "Identifier,Unit Name,Machine Name,Manufacturer,Serial Number,Date,Status,Related Faults,Reported By,Comments,".$tbl_header.$csv_terminated;
	$out .= substr($data, 0, -1);
	
	$filename = 'Checklist_Report'."_".date("d-m-Y_H-i-s",time()).".csv";
  	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  	header("Content-Length: " . strlen($out));
   	header("Content-type: text/x-csv");
   	header("Content-Disposition: attachment; filename=$filename");
	echo $out;
	exit;

?>