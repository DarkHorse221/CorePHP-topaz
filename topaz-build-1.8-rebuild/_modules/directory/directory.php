<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }

$q_usr = sql("SELECT ue.fname, ue.lname, ue.phone, ue.title FROM user u LEFT JOIN user_ext ue ON u.id=ue.uid WHERE u.active = '1' AND u.id!= '1' ORDER BY ue.fname ASC");
$c_usr = mysqli_num_rows($q_usr);
if($c_usr) { $i = 2;
	while($r_usr = mysqli_fetch_assoc($q_usr)) {
		$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
		$data .= '<tr '.$tr_style.'><td>'.$r_usr['fname'].' '.$r_usr['lname'].'</td><td>'.$r_usr['title'].'</td><td>'.$r_usr['phone'].'</td></tr>';
		$i++;
	}
	$templateArray['{directory-list}'] = '<table class="tablesorter" id="directory"><thead><tr><th>Name</th><th>Title</th><th>Extension</th></thead><tbody>'.$data.'</tbody></table>';
} else { $templateArray['{directory-list}'] = '<p>No registered users are active</p>'; }
?>