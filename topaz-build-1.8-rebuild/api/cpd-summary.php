<?php define('TOPAZ', true);
error_reporting(E_ERROR | E_WARNING | E_PARSE); ini_set("display_errors", 1);
session_start(); $sid = session_id();
include('../_constants/constants.php'); include('../_constants/db.php'); include('../_functions/strings.php'); include('../_functions/requests.php');
$uid = cleanNumber($_GET['uid']); $start_d = cleanNumber($_GET['s']); $end_d = cleanNumber($_GET['d']); 

if(!$uid || !$start_d || !$end_d) { echo "<p>Un-authorise access detected. Script has been terminated.</p>"; } else {
$log_user = userID($sid);
	if(!($log_user == $uid)) { echo "<p>Un-authorise access detected. Script has been terminated.</p>"; } else {
		$q_usr = sql("SELECT `fname`, `lname` FROM `user_ext` WHERE `uid` = '".$uid."'"); $r_usr = mysqli_fetch_assoc($q_usr);
		$user = $r_usr['fname'].' '.$r_usr['lname']; $userTitle = $r_usr['fname'].$r_usr['lname'];
		
		$q_cpe = sql("SELECT u.id, u.ins_date_id, u.conf_date_id, u.rating, u.feedback, uee.name AS act_name, uee.date_start, uee.date_end, uee.credits AS act_credits, uee.certificate, uee.q1, uee.q2, uee.q3, uee.q4, uee.q5, e.name, e.credits, e.mandatory, e.text, ins.start, ins.end, ins.presenter, ue.fname, ue.lname, conf.start AS conf_start, conf.end AS conf_end, conf.loc, ec.name AS conf_name, ec.text AS conf_text FROM user_education u LEFT JOIN user_education_ext uee ON u.id=uee.ueid LEFT JOIN education_ins ins ON ins.id=u.ins_date_id LEFT JOIN education_conf conf ON conf.id=u.conf_date_id LEFT JOIN education e ON ins.eid=e.id LEFT JOIN education ec ON conf.eid=ec.id LEFT JOIN user_ext ue ON ins.pid=ue.uid WHERE u.uid = '".$uid."' ORDER BY u.id DESC");
					$c_cpe = mysqli_num_rows($q_cpe);
					if(!$c_cpe) { $error = 'There are no records available for the date range.'; } else {
					//Get cpe details
						while($r_cpe = mysqli_fetch_assoc($q_cpe)) {
							
							if($r_cpe['mandatory']) { $mand = '<p>Yes</p>'; } else { $mand = '<p>No</p>'; }
							if($r_cpe['presenter']) { $presenter = $r_cpe['presenter']; } else { $presenter = $r_cpe['fname'].' '.$r_cpe['lname']; }
							if($r_cpe['text']) { $summary = $r_cpe['text']; } else { $summary = '<p>There is no summary for this event.</p>'; }
							if($r_cpe['conf_text']) { $conf_summary = $r_cpe['conf_text']; } else { $conf_summary = '<p>There is no summary for this event.</p>'; }
							
			//get Inservice details
			if($r_cpe['ins_date_id']) {
				$time_to_compare = strtotime($r_cpe['start']);
				if(($time_to_compare >= $start_d) && ($time_to_compare <= $end_d)) {
					
					$now = new DateTime($r_cpe['start']);
					$ref = new DateTime($r_cpe['end']);
					$diff = $now->diff($ref);
					$hours = $diff->h; $mins = $diff->i;
					$time = $hours.' hour(s) '.$mins.' minute(s)';
					
					$total_cpe_hours = $total_cpe_hours + $hours;
					$total_cpe_mins = $total_cpe_mins + $mins;
					
					$builder .= '
					<h1>'.$r_cpe['name'].' (In-service)</h1>
					<table>
					<tr class="header"><td colspan="2">Event Details</td></tr>
					<tr><td width="300">Scheduled start</td><td width="600">'.dateConvert($r_cpe['start'], 1).'</td></tr>
					<tr class="odd"><td>Scheduled end</td><td>'.dateConvert($r_cpe['end'], 1).'</td></tr>
					<tr><td>Credit Points</td><td>'.$r_cpe['credits'].'</td></tr>
					<tr><td>Time</td><td>'.$time.'</td></tr>
					<tr class="odd"><td>Mandatory Attendance</td><td><p>'.$mand.'</p></td></tr>
					<tr><td>Presented by</td><td><p>'.$presenter.'</p></td></tr>
					<tr class="odd"><td>Summary</td><td><p>'.$summary.'</p></td></tr>
					<tr class="odd"><td colspan="2">&nbsp;</td></tr>
					<tr class="header"><td colspan="2">Event Record</td></tr>
					<tr><td>Your rating for this presentation (x/5)</td><td>'.$r_cpe['rating'].'</td></tr>
					<tr class="odd"><td>Your feedback to the presenter</td><td><p>'.$r_cpe['feedback'].'</p></td></tr>
					<tr><td>What were the three main things you learnt from the event?</td><td>'.$r_cpe['q1'].'</td></tr>
					<tr class="odd"><td>Does this differ from your previous knowledge of these areas?</td><td>'.$r_cpe['q2'].'</td></tr>
					<tr><td>Do you see any value in the knowledge gained, is it accurate and why?</td><td>'.$r_cpe['q3'].'</td></tr>
					<tr class="odd"><td>Will this new knowledge change your practice?</td><td>'.$r_cpe['q4'].'</td></tr>
					</table>								
					<div class="clear"></div>';
				}
			
			} elseif($r_cpe['conf_date_id']) { 
				$time_to_compare = strtotime($r_cpe['conf_start']);
				if(($time_to_compare >= $start_d) && ($time_to_compare <= $end_d)) {
					//get conference details
					
					$builder .= '
					<h1>'.$r_cpe['conf_name'].'</h1>
					<table>
					<tr class="header"><td colspan="2">Event Details</td></tr>
					<tr><td width="300">Scheduled start</td><td width="600">'.dateConvert($r_cpe['conf_start'], 1).'</td></tr>
					<tr class="odd"><td>Scheduled end</td><td>'.dateConvert($r_cpe['conf_end'], 1).'</td></tr>
					<tr><td>Summary</td><td><p>'.$conf_summary.'</p></td></tr>
					<tr class="odd"><td colspan="2">&nbsp;</td></tr>
					<tr class="header"><td colspan="2">Event Record</td></tr>
					<tr><td>What were the three main things you learnt from the event?</td><td>'.$r_cpe['q1'].'</td></tr>
					<tr class="odd"><td>Does this differ from your previous knowledge of these areas?</td><td>'.$r_cpe['q2'].'</td></tr>
					<tr><td>Do you see any value in the knowledge gained, is it accurate and why?</td><td>'.$r_cpe['q3'].'</td></tr>
					<tr class="odd"><td>Will this new knowledge change your practice?</td><td>'.$r_cpe['q4'].'</td></tr>
					</table>								
					<div class="clear"></div>';
					
				}
			
			} else {
			//get self registered details	
				$time_to_compare = strtotime($r_cpe['date_start']);
				if(($time_to_compare >= $start_d) && ($time_to_compare <= $end_d)) {
				
				$now = new DateTime($r_cpe['date_start']);
				$ref = new DateTime($r_cpe['date_end']);
				$diff = $now->diff($ref);
				$hours = $diff->h; $mins = $diff->i;
				$time = $hours.' hour(s) '.$mins.' minute(s)';
				
				$total_self_hours = $total_self_hours + $hours;
				$total_self_mins = $total_self_mins + $mins;
				
				$builder .= '
					<h1>'.$r_cpe['act_name'].'</h1>
					<table>
					<tr class="header"><td colspan="2">Event Details</td></tr>
					<tr><td width="300">Start Date</td><td width="600">'.dateConvert($r_cpe['date_start'], 1).'</td></tr>
					<tr class="odd"><td>End Date</td><td>'.dateConvert($r_cpe['date_end'], 1).'</td></tr>
					<tr><td>Credit Points</td><td>'.$r_cpe['act_credits'].'</td></tr>
					<tr><td>Time</td><td>'.$time.'</td></tr>
					<tr class="odd"><td colspan="2">&nbsp;</td></tr>
					<tr class="header"><td colspan="2">Event Record</td></tr>
					<tr><td>What were the three main things you learnt from the event?</td><td>'.$r_cpe['q1'].'</td></tr>
					<tr class="odd"><td>Does this differ from your previous knowledge of these areas?</td><td>'.$r_cpe['q2'].'</td></tr>
					<tr><td>Do you see any value in the knowledge gained, is it accurate and why?</td><td>'.$r_cpe['q3'].'</td></tr>
					<tr class="odd"><td>Will this new knowledge change your practice?</td><td>'.$r_cpe['q4'].'</td></tr>
					<tr><td>Who facilitated the course or workshop and what was the subject area?</td><td>'.$r_cpe['q5'].'</td></tr>
					</table>								
					<div class="clear"></div>';
								
				}
			} //$r_cpe['ins_date_id']	
		} //while $r_cpe
		
		
			$q_cpe_pres = sql("SELECT e.id, e.name, e.credits, e.mandatory, ei.id AS ins_date_id, ei.start, ei.end, ue.fname, ue.lname, e.text FROM education_ins ei LEFT JOIN education e ON ei.eid=e.id LEFT JOIN user_ext ue ON ue.uid = ei.pid WHERE ei.pid = '".$uid."' ORDER BY ei.start DESC");	
			$c_cpe_pres = mysqli_num_rows($q_cpe_pres);
			if(!$c_cpe_pres) { $error_pres = 'There are no presentation records available for the date range.'; } else {

				while($r_cpe_pres = mysqli_fetch_assoc($q_cpe_pres)) {
					if($r_cpe_pres['mandatory']) { $man = 'Yes'; } else { $man = 'No'; }
					$presenter = $r_cpe_pres['fname'].' '.$r_cpe_pres['lname'];
					if($r_cpe_pres['text']) { $summary = $r_cpe_pres['text']; } else { $summary = '<p>There is no summary for this event.</p>'; }
				
					$time_to_compare = strtotime($r_cpe_pres['start']);
					if(($time_to_compare >= $start_d) && ($time_to_compare <= $end_d)) {
							
							$now = new DateTime($r_cpe_pres['start']);
							$ref = new DateTime($r_cpe_pres['end']);
							$diff = $now->diff($ref);
							$hours = $diff->h; $mins = $diff->i;
							$time = $hours.' hour(s) '.$mins.' minute(s)';
							
							$total_pres_hours = $total_pres_hours + $hours;
							$total_pres_mins = $total_pres_mins + $mins;
							
							$builder_pres .= '
							<h1>'.$r_cpe_pres['name'].' (In-service)</h1>
							<table>
							<tr class="header"><td colspan="2">Event Details</td></tr>
							<tr><td width="300">Scheduled start</td><td width="600">'.dateConvert($r_cpe_pres['start'], 1).'</td></tr>
							<tr class="odd"><td>Scheduled end</td><td>'.dateConvert($r_cpe_pres['end'], 1).'</td></tr>
							<tr><td>Credit Points</td><td>'.$r_cpe_pres['credits'].'</td></tr>
							<tr><td>Time</td><td>'.$time.'</td></tr>
							<tr class="odd"><td>Mandatory Attendance</td><td><p>'.$mand.'</p></td></tr>
							<tr><td>Presented by</td><td><p>'.$presenter.'</p></td></tr>
							<tr class="odd"><td>Summary</td><td><p>'.$summary.'</p></td></tr>
							</table>								
							<div class="clear"></div>';
						
					} //if time
				
				} //while
			} //$c_cpe_pres
		if(!$builder) { $error = 'There are no records available for the date range.'; }			
		if(!$builder_pres) { $error_pres = 'There are no records available for the date range.'; }
					
	} //$c_cpe					
	
	//do hour totals
	$total_cpe_time = $total_cpe_hours + ($total_cpe_mins / 60);
	$total_self_time = $total_self_hours + ($total_self_mins / 60);
	$total_pres_time = $total_pres_hours + ($total_pres_mins / 60);
		
	$html = '<html><head></head><body>
	<style type="text/css">
	body { font-size: 12px; }
	tr.header td { background: #FFFFFF; border-bottom: 1px solid #CCC; padding: 4px 4px; font-weight: bold; }
	tr td { padding: 4px 4px; background: #E6F7FF;	vertical-align: middle; }
	tr.odd td { background: none; }
	.clear { clear:both; height: 20px; }
	</style>
	
	<!--mpdf
	<htmlpagefooter name="myfooter">
	<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
	Page {PAGENO} of {nb}
	</div>
	</htmlpagefooter>
	<sethtmlpagefooter name="myfooter" value="on" />
	mpdf-->
	
	<img src="../_images/_layout/site-logo.png">
	<h1><i>CPD Summary</i></h1>
	<p><strong>Report for:</strong> '.$user.'</p>
	<p><strong>Generated on:</strong> '.date("d/m/Y H:i", time()).'</p>
	<p><strong>Date range of report:</strong> '.date("d/m/Y", $start_d).' to '.date("d/m/Y", $end_d).'</p>
	<h1><i>Attendance Summary</i></h1>
	<p><strong>Total attendance time (excluding conferences):</strong> '.round($total_cpe_time, 2).' hour(s)</p>
	<p><strong>Total self directed learning:</strong> '.round($total_self_time, 2).' hour(s)</p>
	'.$error.$builder.'
	<p></p>
	<p></p>	
	<h1><i>Presentation Summary</i></h1>
	<p><strong>Total presentation time:</strong> '.round($total_pres_time, 2).' hour(s)</p>
	'.$error_pres.$builder_pres.'
	<p></p>
	<p></p>	
	<p>This report has been verified.<br />
	Report generated on '.date("d/m/Y H:i", time()).'.</p>
	</body></html>';
			
	include("mpdf/mpdf.php");
	$mpdf=new mPDF('utf-8 s', 'A4'); 
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->SetTitle($userTitle."-CPD-Summary-".date("d-m-Y", time()));
	$mpdf->WriteHTML($html);
	$mpdf->Output(); 
	exit;
		
	}
}
?>