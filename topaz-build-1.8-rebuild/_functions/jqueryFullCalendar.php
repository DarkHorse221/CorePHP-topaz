<?php define('TOPAZ', true);
	include('../_constants/constants.php'); include('../_constants/db.php'); include('strings.php'); include('requests.php');
	if($_GET['uid']) { $uid = cleanNumber($_GET['uid']); }
	if($_GET['start']) { $start_time = strtotime($_GET['start']); $start = date("Y-m-d", $start_time);}
	if($_GET['end']) { $end_time = strtotime($_GET['end']); $end = date("Y-m-d", $end_time);}

	//get user groups
	if($uid) { $q_ur = sql("SELECT `rid` FROM `user_groups` WHERE `uid` = '".$uid."'"); while($r_ur = mysqli_fetch_assoc($q_ur)) { $u_rights[] = $r_ur['rid']; }}
	
	$q_ins = sql("SELECT e.id, e.name, e.groups, e.credits, e.mandatory, ei.start, ei.end, t.custom FROM education e LEFT JOIN education_ins ei ON e.id=ei.eid LEFT JOIN type_list t ON t.id=e.edu_type WHERE e.tid='32' AND ei.start >= '".$start."' AND ei.end <= '".$end."'  ORDER BY ei.start DESC"); $c_ins = mysqli_num_rows($q_ins);
	
	$events = array();
	
	if($c_ins) {
	
		$i = 0;
		while($r_ins = mysqli_fetch_assoc($q_ins)) {
			$add_event = false;
			if($r_ins['groups'] && $uid) { $grps = '';	$grps = explode(';', $r_ins['groups']);	foreach($u_rights as $k=>$v) {if(in_array($v, $grps)) { $add_event = true; } }
			} else { $add_event = true; }
			
			if($add_event) {
				$dates = array();
				$dates['id'] = $r_ins['id'];
				$dates['title'] = ' '.$r_ins['name'];
				$dates['start'] = $r_ins['start'];
				$dates['end'] = $r_ins['end'];
				$dates['url'] = WEBSITE_REF.'?p=learning-and-education&o=events&v='.$r_ins['id'];
				$dates['allDay'] = false;
				if($r_ins['mandatory']) { $color = '#FF6666'; } else { 
					if($r_ins['custom']) {
						$color = '#'.$r_ins['custom'];
					} else {
						$color = '#66CCFF';
					}
				}
				$dates['color'] = $color;
				$i++; $events[] = $dates;
			}
		}
	} //$c_ins
	
	$q_conf = sql("SELECT e.id, e.name, e.groups, ec.start, ec.end, ec.loc FROM education e LEFT JOIN education_conf ec ON e.id=ec.eid WHERE e.tid='41' AND ec.start >= '".$start."' AND ec.end <= '".$end."' ORDER BY ec.start DESC"); $c_conf = mysqli_num_rows($q_conf);
	if($c_conf) {
	
		$i = 0;
		while($r_conf = mysqli_fetch_assoc($q_conf)) {
			$add_event = false;
			if($r_conf['groups'] && $uid) { $grps = '';	$grps = explode(';', $r_conf['groups']); foreach($u_rights as $k=>$v) {if(in_array($v, $grps)) { $add_event = true; } }
			} else { $add_event = true; }
			if($add_event) {
				$dates = array();
				$dates['id'] = $r_conf['id'];
				if($r_conf['loc']) { $loc = "\nVenue:".$r_conf['loc']; } else { $loc = ''; }
				$dates['title'] = ' '.$r_conf['name'].$loc;
				$dates['start'] = $r_conf['start'];
				$dates['end'] = $r_conf['end'];
				$dates['url'] = WEBSITE_REF.'?p=learning-and-education&o=events&v='.$r_conf['id'];
				$dates['allDay'] = true;
				$dates['color'] = '#66CC00';
				$i++;
				$events[] = $dates;
			}
		}
	} //$c_ins
	echo json_encode($events);
?>
