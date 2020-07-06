<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }

//get list
if(!$dataid) {

	$q_fl = sql("SELECT f.id,f.name,f.locations,f.status,fex.date_created,fex.fname, fex.lname, tl.name AS type_name, tu.name AS unit
FROM qa_checklist f
LEFT JOIN (
	SELECT fe.cid, MAX(fe.date_created) as date_created, MAX(fe.version) as version, ue.fname, ue.lname
	FROM qa_checklist_ext fe
	INNER JOIN user_ext ue ON fe.uid=ue.uid
	GROUP BY fe.cid, ue.fname, ue.lname
) fex ON f.id=fex.cid
INNER JOIN type_list tl ON f.type_id=tl.id
LEFT JOIN type_list tu ON f.unit=tu.id
".$active."
ORDER BY f.name ASC");
	$c_fl = mysqli_num_rows($q_fl);
	if(!$c_fl) { $data = sysMsg(19); } else {
		$i = 2;
		while($r_fl = mysqli_fetch_assoc($q_fl)) {
			$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
			if($r_fl['status']) { $im = 'active.gif'; } else { $im = 'non-active.gif'; }
			if($r_fl['unit']) { $unit_name = $r_fl['unit']; } else { $unit_name = "All Units"; }
			$data .= '<tr '.$tr_style.'><td>'.$r_fl['name'].'</td><td>'.$r_fl['type_name'].'</td><td>'.$unit_name.'</td><td>'.$r_fl['fname'].' '.$r_fl['lname'].'</td><td>'.$r_fl['date_created'].'</td><td><img src="'.WEBSITE_LOC.'console/_images/'.$im.'" class="img" /></td>
			<td><a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$o.'&id='.$id.'&dataid='.$r_fl['id'].'" class="text-submit">Select</a></td></tr>';
			$i++;
		}
		$data = '<table class="tablesorter" id="data-list"><thead><tr><th>Audit Name</th><th>Type</th><th>Unit</th><th>Authored by</th><th>Date Created</th><th>Status</th><th>Select</th></tr></thead><tbody>'.$data.'</tbody></table>';
	}	
} //get list

if($id && $dataid) {
	
	//get name of list entry
	$q_data = sql("SELECT `name` FROM `qa_checklist` WHERE id = '".$dataid."'");
	$r_data = mysqli_fetch_assoc($q_data); 
	$data = '<p><label>Audit name:</label>'.$r_data['name'].'</p>';
	
	//get version information
	$q_version = sql("SELECT * FROM `qa_checklist_ext` WHERE `cid` = '".$dataid."' ORDER BY `version` DESC");
	$c_version = mysqli_num_rows($q_version);
	$data .= '<p><label>Select version:</label><select id="version" name="version"><option value="">Please Select...</option>';
	if(!$c_version) { $data = sysMsg(19); } else {
		while($r_version = mysqli_fetch_assoc($q_version)) {
			//do status
			if($r_version['status'] == '0') { $status = 'Un-Published'; } elseif($r_version['status'] == '1') { $status = 'Published'; } else { $status = 'Retired'; }
			//check if already selected
			if($datavid == $r_version['id']) { $sel = 'selected'; } else { $sel = ''; }
			//get number of responses per version
				$q_num = sql("SELECT COUNT(id) as count FROM `qa_responses` WHERE `ceid` = '".$r_version['id']."'"); $r_num = mysqli_fetch_assoc($q_num);
				if($r_num['count']) {
					$res = ', '.$r_num['count'].' records';
					$q_date = sql("SELECT `date` FROM `qa_responses` WHERE `ceid` = '".$r_version['id']."' ORDER BY `date` ASC LIMIT 0,1"); $r_date = mysqli_fetch_assoc($q_date);
					$date = new DateTime($r_date['date']); $date = $date->format('Y-m-d'); $date = '&norecord=0&s_date='.$date;
				} else { $res = ''; $date = '&norecord=1'; }
				//echo out options
				$data .= '<option value="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$o.'&id='.$id.'&dataid='.$dataid.'&datavid='.$r_version['id'].$date.'" '.$sel.'>Version '.$r_version['version'].' ('.$status.')'.$res.'</option>';	
		}
		$data .= '</select></p>';
	} //version info	
	
} //$id and $dataid

//do dates
if($id && $dataid && $datavid && ($norecord == '0')) {
	if(!$s_date) { $s_date = new DateTime('now'); $s_date = $s_date->format('Y-m-d'); }
	if(!$e_date) { $e_date = new DateTime('now'); $e_date = $e_date->format('Y-m-d'); }
	$data .= '
		<p><label>Start Date</label><input name="s_date" id="sdate" type="date" value="'.$s_date.'"></p>
		<p><label>End Date</label><input name="e_date" id="edate" type="date" value="'.$e_date.'"><input name="listid" value="'.$dataid.'" type="hidden" /><input name="vid" value="'.$datavid.'" type="hidden" /></p>
		<p><label>&nbsp;</label><input name="submitdata" id="submitdata" type="submit" value="Execute" class="text-submit" />
		';
	$form_exec = WEBSITE_LOC.'api/audit-report-csv.php';
	
} elseif($id && $dataid && $datavid && ($norecord == '1')) {
	$err[] = '<p>There are no records to report on for this version.</p>';
} //#do dates



//do anyway
$sect_nav_rt = '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$o.'&id='.$id.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
$templateArray['{data-fields}'] = $data;

?>