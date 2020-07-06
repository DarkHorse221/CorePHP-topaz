<?php define('TOPAZ', true);
include('../_constants/constants.php'); include('../_constants/db.php'); include('strings.php'); include('requests.php');
$search = cleanInput($_POST['queryString']);
$date_id = cleanInput($_POST['date_id']);

$q_usr = sql("SELECT `uid`, `fname`, `lname` FROM `user_ext` WHERE `tapandlearn` = '".$search."'");
$c_usr = mysqli_num_rows($q_usr);

if(!$c_usr) {
	$arr['status'] = 'Failed to record attendance';
	$arr['css'] = 'specialfail';
	$arr['name'] = '';
	$arr['message'] = 'No user ID found';
} else {
	$r_usr = mysqli_fetch_assoc($q_usr);
	
	//check if user attendance already recorded
	$q_chk = sql("SELECT `id` FROM `user_education` WHERE `uid` = '".$r_usr['uid']."' AND `ins_date_id` = '".$date_id."'");
	$r_chk = mysqli_num_rows($q_chk);
	if($r_chk) {
		$arr['status'] = 'Failed to record attendance';
		$arr['css'] = 'specialfail';
		$arr['name'] = '';
		$arr['message'] = 'Your attendance has already been recorded for this event.';
	} else {
		//record attendance
		$q_ins = sql("INSERT INTO `user_education` (`uid`, `ins_date_id`, `rating`, `feedback`) VALUES ('".$r_usr['uid']."', '".$date_id."','','')");
		$last_id  = mysqli_insert_id($conn);
		$q_ins_ue = sql("INSERT INTO `user_education_ext` (`ueid`, `q1`, `q2`, `q3`, `q4`) VALUES ('".$last_id."', '','','','')");
		
		//output data
		$arr['status'] = 'Attendance Recorded Successfully!';
		$arr['css'] = 'special';
		$arr['name'] = $r_usr['fname'].' '.$r_usr['lname'];
		$arr['message'] = '';
	}
}
echo json_encode($arr);
?>