<?php define('TOPAZ', true);
	include('../_constants/constants.php'); include('../_constants/db.php'); include('strings.php'); include('requests.php');
	if($_GET['start']) { $start = date( 'Y-m-d', $_GET['start']);	}
	if($_GET['end']) { $end = date( 'Y-m-d', $_GET['end']); }
	//get user groups
	
	$q_ins = sql("SELECT e.id, e.name, e.groups, e.credits, e.mandatory, ei.id AS date_id, ei.start, ei.end, t.custom FROM education e LEFT JOIN education_ins ei ON e.id=ei.eid LEFT JOIN type_list t ON e.edu_type=t.id WHERE e.tid='32' AND ei.start >= '".$start."' AND ei.end <= '".$end."'  ORDER BY ei.start DESC"); $c_ins = mysqli_num_rows($q_ins);
	
	$events = array();
	
	if($c_ins) {
	
		$i = 0;
		while($r_ins = mysqli_fetch_assoc($q_ins)) {

			$dates = array();
			$dates['id'] = $r_ins['id'];
			$dates['title'] = ' '.$r_ins['name'];
			$dates['start'] = $r_ins['start'];
			$dates['end'] = $r_ins['end'];
			$dates['url'] = WEBSITE_REF.'?p=tap-and-learn&o='.$r_ins['id'].'&v='.$r_ins['date_id'];
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
	} //$c_ins
	
	$q_conf = sql("SELECT e.id, e.name, e.groups, ec.start, ec.end, ec.loc FROM education e LEFT JOIN education_conf ec ON e.id=ec.eid WHERE e.tid='41' AND ec.start >= '".$start."' AND ec.end <= '".$end."' ORDER BY ec.start DESC"); $c_conf = mysqli_num_rows($q_conf);
	if($c_conf) {
	
		$i = 0;
		while($r_conf = mysqli_fetch_assoc($q_conf)) {
			
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
	} //$c_ins
	if(!empty($events)) {
		echo json_encode($events);
	}

?>
