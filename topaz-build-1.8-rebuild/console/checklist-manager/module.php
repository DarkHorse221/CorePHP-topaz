<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
//set options
$uid = userID($sid);
$sec_opts = array("Checklist Manager" => "check-list");
$o = cleanInput($_GET['o']); if (!$o) {
    $o = 'check-list';
} //set default
$id = cleanInput($_GET['id']);

if ($o == "add-check-list") {
    if (!userSystemRights($uid, "add_qi")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=check-list"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $templateArray['{sect_head_ext}'] = ': Add Check List';
    $templateArray['{add-check-list}'] = "block";

    if (!D4600135D233F_LOCKOUT) {
        if ($_POST['add-check-list']) {
            if (validateInput($_POST['name'])) {
                $name = cleanInput($_POST['name']);
            } else {
                $name = $_POST['name'];
                $err[] = "List name: ".sysMsg(6);
            }
            $act = cleanNumber($_POST['act']);
            $type_id = cleanInput($_POST['chk-add-type']);
            $unit = cleanNumber($_POST['check-add-unit']);
            $mids = $_POST['mids']; if($mids) { foreach($mids as $k=>$v) { $mid[] = $k; }
            $mach_ids = implode(';', $mid); }
            if (!$err) {
                $date_now = new DateTime('now');
                $date_now = $date_now->format('Y-m-d H:i:s');
                $q_ins = sql("INSERT INTO `qi` (`name`, `mids`, `type_id`, `unit`, `status`) VALUES ('".$name."','".$mach_ids."','".$type_id."','".$unit."','".$act."')");
                $last_id  = mysqli_insert_id($conn);
                $q_ins_ext = sql("INSERT INTO `qi_ext` (`fid`, `uid`, `date_created`, `version`) VALUES ('".$last_id."','".$uid."','".$date_now."', '1')");
                if ($q_ins && $q_ins_ext) {
                    auditEvent("Checklist Added", $name, "checklist", "Name: ".$name."<br />Type ID: ".$type_id."<br />Associated Unit: ".$unit);
                    $templateArray['{message}'] = "Adding new Check List now...";
                    $templateForward = "console/index.php?t=".$t."&o=check-list";
                } else {
                    $err[] = sysMsg(8);
                }
            }
        } //post
        
        //do anyway
        $mach_id = explode(';',$mach_ids); $q_mids = sql("SELECT * FROM `machines` WHERE `active` = '1'");
        $i=1; $lim = 12;
        while($r_mids = mysqli_fetch_assoc($q_mids)) {
        	if($i == 1) { $std_beg = '<span class="std-grp">';} else { $std_beg = ''; }
        	if($i > $lim) { $std_end = '</span>'; $i=1; } else { $i++;  $std_end = ''; }
        	if(in_array($r_mids['id'], $mach_id)) { $sel = 'checked="checked"'; } else { $sel = ''; }
        	$std .= $std_beg.'<p><label class="chk">'.$r_mids['name'].'</label><input type="checkbox" name="mids['.$r_mids['id'].']" value="1" class="chk" '.$sel.' /></p>'.$std_end;
        }
        $templateArray['{mids}'] = $std;
    } else {
        $err[] = sysMsg('57');
        $templateArray['{system-rights}'] = "none";
    }//lockout mode
} //add-check-list


if ($o == "edit-check-list" || $o == "edit-questions" || $o == "edit-resolution") {
    //$sec_opts = array("Edit Check List" => "edit-check-list", "Edit Questions" => "edit-questions", "Edit Resolution" => "edit-resolution");
    $sec_opts = array("Edit Check List" => "edit-check-list", "Edit Questions" => "edit-questions");
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=check-list"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $fext = '&id='.$id;
    $templateArray['{fl_data}'] = '';
}

if ($o == "edit-check-list") {
    if (!userSystemRights($uid, "edit_qi")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=check-list"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $fext='&id='.$id;
    $templateArray['{sect_head_ext}'] = ': Edit Check List';
    $templateArray['{edit-check-list}'] = "block";

    if ($_POST['edit-check-list']) {
        $chk_status_pub = cleanNumber($_POST['chk-edit-status-pub']);
        $act = cleanNumber($_POST['act']);
        $chk_vers = cleanNumber($_POST['chk-edit-vers']);
        $chk_pubs = cleanNumber($_POST['chk-edit-pubs']);
        $vid = cleanNumber($_POST['chk-edit-vid']);
        if (validateInput($_POST['name'])) {
            $name = cleanInput($_POST['name']);
        } else {
            $name = $_POST['name'];
            $err[] = "Check List name: ".sysMsg(6);
        }
        $type_id = cleanInput($_POST['chk-edit-type']);
        $unit = cleanInput($_POST['chk-edit-unit']);
        $mids = $_POST['mids']; if($mids) { foreach($mids as $k=>$v) { $mid[] = $k; }
        $mach_ids = implode(';', $mid); }
        
        if (!$err) {
            $date = new DateTime('now');
            $date = $date->format('Y-m-d H:i:s');
            $v = '';
            //going from unpublished to published
            if (!$chk_pubs && $chk_status_pub) {
                $old_ver = $chk_vers - 1;
                if ($old_ver) { //update publish date and retire previous versions if not original version
                    $q_upd_ext = sql("UPDATE `qi_ext` SET `date_retired` = '".$date."', `status` = '2' WHERE `fid` = '".$id."' AND `version` = '".$old_ver."'");
                }
                
                $q_upd_ext = sql("UPDATE `qi_ext` SET `date_active` = '".$date."', `status` = '1' WHERE `fid` = '".$id."' AND `version` = '".$chk_vers."'");
            }
            //going from published to unpublished
            if ($chk_pubs && !$chk_status_pub) {
                $q_get_q = sql("SELECT * FROM `qi_q` WHERE `feid` = '".$vid."' ORDER BY `order`");
                $c_get_q = mysqli_num_rows($q_get_q);
                if ($c_get_q) {
                    $new_ver = $chk_vers+1;
                    $q_ins_ext = sql("INSERT INTO `qi_ext` (`fid`,`uid`, `date_created`, `version`, `status`) VALUES ('".$id."', '".$uid."', '".$date."', '".$new_ver."', '0')");
                    $last_id  = mysqli_insert_id($conn);
                    
                    //copy question data over
                    while ($r_get_q = mysqli_fetch_array($q_get_q)) {
                        $q_builder = sql("INSERT INTO `qi_q` (`feid`,`question`, `type`, `order`) VALUES ('".$last_id."', '".$r_get_q['question']."', '".$r_get_q['type']."', '".$r_get_q['order']."')");
                        $last_id_ext  = mysqli_insert_id($conn);
                        //copy option data over
                        if (($r_get_q['type'] == 'checkbox') || ($r_get_q['type'] == 'radio') || ($r_get_q['type'] == 'singleselect') || ($r_get_q['type'] == 'multipleselect')) {
                            $feqid = $r_get_q['id'];
                            $q_get_q_ext = sql("SELECT * FROM `qi_q_ext` WHERE `feqid` = '".$r_get_q['id']."'");
                            $c_get_q_ext = mysqli_num_rows($q_get_q_ext);
                            if ($c_get_q_ext) {
                                while ($r_get_q_ext = mysqli_fetch_array($q_get_q_ext)) {
                                    $q_builder_ext = sql("INSERT INTO `qi_q_ext` (`feqid`,`option`) VALUES ('".$last_id_ext."', '".$r_get_q_ext['option']."')");
                                } //while
                            } //$count
                        } //if option data
                    } //while	 question data
                    
                    //copy resolutions data over
                    $q_get_q = sql("SELECT * FROM `qi_resolution_q` WHERE `feid` = '".$vid."' ORDER BY `order`");
                    $c_get_qr = mysqli_num_rows($q_get_q);
                    if ($c_get_qr) {
                        while ($r_get_q = mysqli_fetch_array($q_get_q)) {
                            $r_builder = sql("INSERT INTO `qi_resolution_q` (`feid`,`question`, `type`, `order`) VALUES ('".$last_id."', '".$r_get_q['question']."', '".$r_get_q['type']."', '".$r_get_q['order']."')");
                            $last_id_ext  = mysqli_insert_id($conn);
                            //copy option data over
                            if (($r_get_q['type'] == 'checkbox') || ($r_get_q['type'] == 'radio') || ($r_get_q['type'] == 'singleselect') || ($r_get_q['type'] == 'multipleselect')) {
                                $feqid = $r_get_q['id'];
                                $q_get_q_ext = sql("SELECT * FROM `qi_resolution_q_ext` WHERE `feqid` = '".$r_get_q['id']."'");
                                $c_get_qr_ext = mysqli_num_rows($q_get_q_ext);
                                if ($c_get_qr_ext) {
                                    while ($r_get_q_ext = mysqli_fetch_array($q_get_q_ext)) {
                                        $q_builder_ext = sql("INSERT INTO `qi_resolution_q_ext` (`feqid`,`option`) VALUES ('".$last_id_ext."', '".$r_get_q_ext['option']."')");
                                    } //while
                                } //$count
                            } //if option data
                        } //while	 resolutions data
                    } //c_get_qr
                } //if questions
            } //published to unpublished
            
            $q_upd = sql("UPDATE `qi` SET `name` = '".$name."', `type_id` = '".$type_id."', `unit` = '".$unit."', `mids` = '".$mach_ids."', `status` = '".$act."' WHERE `id` = '".$id."'");
            if ($q_upd) {
                $success[] = sysMsg(9);
            } else {
                $err[] = sysMsg(8);
                auditEvent("Checklist add failed", $name, "checklist", "Name: ".$name."<br />Type ID: ".$type_id."<br />Associated Unit: ".$unit);
            }
        }
    } //post
    
        
    //do anyway
    $q_chk = sql("SELECT * FROM `qi` WHERE `id` = '".$id."'");
    $c_chk = mysqli_num_rows($q_chk);
    if (!$c_chk) {
        $err[] = sysMsg(4);
        $templateArray['{system-rights}'] = "none";
    } else {
        $r_chk = mysqli_fetch_assoc($q_chk);
        $name = $r_chk['name'];
        $chk_status_act = $r_chk['status'];
        $type_id = $r_chk['type_id'];
            //do feedback link
        if($r_chk['type_id'] == '131') {
            $templateArray['{feedback-link}'] = '<a href="'.WEBSITE_LOC.'_feedback/feedback.php?fid='.$r_chk['id'].'" target="_blank">Launch feedback</a>';
        }
        $unit = $r_chk['unit'];
        $mach_ids = $r_chk['mids'];
        
        $q_chk_ext = sql("SELECT * FROM `qi_ext` WHERE `fid` = '".$id."' ORDER BY `version` DESC LIMIT 0,1");
        $c_chk_ext = mysqli_num_rows($q_chk_ext);
        if (!$c_chk_ext) {
            $err[] = sysMsg(4);
            $templateArray['{system-rights}'] = "block";
        } else {
            $r_chk_ext = mysqli_fetch_assoc($q_chk_ext);
            $chk_vid = $r_chk_ext['id'];
            $chk_ver = $r_chk_ext['version'];
            $chk_status_pub = $r_chk_ext['status'];
            if ($chk_status_pub == '0') {
                if ($chk_ver == '1') {
                    $warning[] = 'Checklist is currently un-published.';
                } else {
                    if ($chk_status_act) {
                        $warning[] = 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.';
                    } else {
                        $warning[] = 'Checklist is currently un-published. No previous versions are available for data recording.';
                    }
                }
            }
            if (!$chk_status_act) {
                $err[] = 'Checklist is disabled. No data recording can be completed using this checklist.';
            }
        } //!$c_chk_ext


    //get machine list
    $mach_id = explode(';',$mach_ids); $q_mids = sql("SELECT * FROM `machines` WHERE `active` = '1'");
    $i=1; $lim = 12;
    while($r_mids = mysqli_fetch_assoc($q_mids)) {
        if($i == 1) { $std_beg = '<span class="std-grp">';} else { $std_beg = ''; }
        if($i > $lim) { $std_end = '</span>'; $i=1; } else { $i++;  $std_end = ''; }
        if(in_array($r_mids['id'], $mach_id)) { $sel = 'checked="checked"'; } else { $sel = ''; }
        $std .= $std_beg.'<p><label class="chk">'.$r_mids['name'].'</label><input type="checkbox" name="mids['.$r_mids['id'].']" value="1" class="chk" '.$sel.' /></p>'.$std_end;
    }
    $templateArray['{mids}'] = $std;
	//user notifications
        //get delete of user
        $un_record_id = cleanString($_GET['del']);
        if ($un_record_id) {
            $q_del_un = sql("DELETE FROM user_notifications WHERE id = '".$un_record_id."'");
            $success[] = "User deleted from notifications successfully";
		}
		
		//get add user
        $un_record_add = cleanString($_GET['addun']);
        if ($un_record_add) {
			$q_check_usr = sql("SELECT * FROM user_notifications WHERE uid = '".$un_record_add."' AND `tid` = '".$type_id."' AND `refid` = '".$id."'");
			$c_check_usr = mysqli_num_rows($q_check_usr);
			if(!$c_check_usr) {
				$q_ins_usr = sql("INSERT INTO user_notifications (`uid`, `tid`, `refid`) VALUES ('".$un_record_add."','".$type_id."','".$id."')");
				$success[] = "User added to notifications successfully";
			} else {
				$warning[] = "User is already receiving notifications";
			}
           
		}
		
        //get groups receiving notifications for type list id
        $q_grps = sql("SELECT ur.name FROM user_rights ur
		JOIN user_rights_ext ure ON ur.id=ure.rid
		WHERE ure.tid = '".$type_id."'");
        $c_grps = mysqli_num_rows($q_grps);

        if (!$c_grps) {
            $templateArray['{notification-groups}'] = 'No groups are receiving notifications';
        } else {
            while ($r_grps = mysqli_fetch_assoc($q_grps)) {
                $templateArray['{notification-groups}'] .= $r_grps['name'].'<br />';
            }
        }

        //get individual notification users
        $q_notifications = sql("SELECT u.fname, u.lname, un.id AS un_record_id FROM user_ext u
		JOIN user_notifications un ON un.uid=u.uid
		JOIN qi q ON q.id=un.refid
		WHERE q.id = '".$id."' AND un.tid = '".$type_id."'");
        $c_notifications = mysqli_num_rows($q_notifications);

        if (!$c_notifications) {
            $templateArray['{notification-individuals}'] = 'No individuals have been specified';
        } else {
            $datan = '';
            $i = 2;
            while ($r_notifications = mysqli_fetch_assoc($q_notifications)) {
                $int = $i/2;
                if (is_int($int)) {
                    $tr_style = 'class = "odd"';
                } else {
                    $tr_style = '';
                }
                $datan .= '<tr '.$tr_style.'><td>'.$r_notifications['fname'].' '.$r_notifications['lname'].'</td>
				<td><a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$o.'&id='.$id.'&del='.$r_notifications['un_record_id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a></td></tr>';
                $i++;
            }
            $templateArray['{notification-individuals}'] = '<table class="tablesorter" id="notification_individuals"><thead><tr><th>User</th><th>&nbsp;</th></tr></thead><tbody>'.$datan.'</tbody></table>';
		}	
	//user notifications
    } //system no id
} //edit-check-list


if ($o == "edit-questions") {
    if (!userSystemRights($uid, "edit_qi")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=check-list"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $fext='&id='.$id;
    $templateArray['{sect_head_ext}'] = ': Edit Questions';
    $templateArray['{edit-questions}'] = "block";


    //do anyway

    $q_chk = sql("SELECT * FROM `qi` WHERE `id` = '".$id."'");
    $c_chk = mysqli_num_rows($q_chk);
    if (!$c_chk) {
        $err[] = sysMsg(4);
        $templateArray['{system-rights}'] = "none";
    } else {
        $r_chk = mysqli_fetch_assoc($q_chk);
        $name = $r_chk['name'];
        $chk_status_act = $r_chk['status'];

        $q_chk_ext = sql("SELECT * FROM `qi_ext` WHERE `fid` = '".$id."' ORDER BY `version` DESC LIMIT 0,1");
        $c_chk_ext = mysqli_num_rows($q_chk_ext);
        if (!$c_chk_ext) {
            $err[] = sysMsg(4);
            $templateArray['{system-rights}'] = "block";
        } else {
            $r_chk_ext = mysqli_fetch_assoc($q_chk_ext);
            $chk_vid = $r_chk_ext['id'];
            $chk_ver = $r_chk_ext['version'];
            $chk_status_pub = $r_chk_ext['status'];
            if ($chk_status_pub == '0') {
                if ($chk_ver == '1') {
                    $warning[] = 'Checklist is currently un-published.';
                } else {
                    if ($chk_status_act) {
                        $warning[] = 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.';
                    } else {
                        $warning[] = 'Checklist is currently un-published. No previous versions are available for data recording.';
                    }
                }
            }
            if (!$chk_status_act) {
                $err[] = 'Checklist is disabled. No data recording can be completed using this checklist.';
            }
        } //!$c_chk_ext
        
        //do questions if existing
        $q_ques = sql("SELECT * FROM `qi_q` WHERE `feid` = '".$chk_vid."' ORDER BY `order` ASC");
        $c_ques = mysqli_num_rows($q_ques);
        if ($c_ques) {
            $i = 1;
            while ($r_ques = mysqli_fetch_assoc($q_ques)) {
                if ($r_ques['type'] == 'text') {
                    $label = "Single Line";
                }
                //if($r_ques['type'] == 'textarea') { $label = "Multiple Line"; }
                if ($r_ques['type'] == 'datetime') {
                    $label = "Date & Time";
                }
                if ($r_ques['type'] == 'date') {
                    $label = "Date";
                }
                if ($r_ques['type'] == 'time') {
                    $label = "Time";
                }
                if ($r_ques['type'] == 'sectionbreak') {
                    $label = "Section Header";
                }
                if ($r_ques['type'] == 'checkbox') {
                    $label = "Options";
                    $option_label = "Check boxes";
                    $checkbox = true;
                } else {
                    $checkbox = false;
                }
                if ($r_ques['type'] == 'radio') {
                    $label = "Options";
                    $option_label = "Radio";
                    $radio = true;
                } else {
                    $radio = false;
                }
                if ($r_ques['type'] == 'singleselect') {
                    $label = "Options";
                    $singleselect = true;
                } else {
                    $singleselect = false;
                }
                //if($r_ques['type'] == 'multipleselect') { $label = "Options"; $multipleselect = true; } else { $multipleselect = false; }
                if ($r_ques['type'] == 'upload') {
                    $label = "Upload";
                    $upload = true;
                } else {
                    $upload = false;
                }
                if ($r_ques['type'] == 'image') {
                    $label = "Upload";
                    $image = true;
                } else {
                    $image = false;
                }
                if (($r_ques['type'] == 'smileys-5') || ($r_ques['type'] == 'smileys-3') || ($r_ques['type'] == 'numeric-5') || ($r_ques['type'] == 'numeric-3') || ($r_ques['type'] == 'yes-no')) {
                    $label = "Feedback";
                    if (($r_ques['type'] == 'smileys-5')) {
                        $option_label = "Simley 5 Faces";
                        $smiley5 = true;
                    } else {
                        $smiley5 = false;
                    }
                    if (($r_ques['type'] == 'smileys-3')) {
                        $option_label = "Simley 3 Faces";
                        $smiley3= true;
                    } else {
                        $smiley3 = false;
                    }
                    if (($r_ques['type'] == 'numeric-5')) {
                        $option_label = "Numeric 5";
                        $numeric5 = true;
                    } else {
                        $numeric5 = false;
                    }
                    if (($r_ques['type'] == 'numeric-3')) {
                        $option_label = "Numeric 3";
                        $numeric3 = true;
                    } else {
                        $numeric3 = false;
                    }
                    if (($r_ques['type'] == 'yes-no')) {
                        $option_label = "Yes/No";
                        $yesno = true;
                    } else {
                        $yesno = false;
                    }
                }
                
                //echo out text, textarea, datetime, time, section break
                if (($r_ques['type'] == 'text') || ($r_ques['type'] == 'textarea') || ($r_ques['type'] == 'datetime') || ($r_ques['type'] == 'date') || ($r_ques['type'] == 'time') || ($r_ques['type'] == 'sectionbreak')) {
                    $templateArray['{qlist}'] .= '<div class="buttons" id="'.$i.'"><span class="move">'.$i.'</span><input type="hidden" name="myText['.$i.']" value="'.$r_ques['type'].'"/><label>'.$label.'</label><input type="text" name="myLabel['.$i.']" value="'.$r_ques['question'].'"/>';
                    if (!$chk_status_pub) { //don't do remove if already published
                        $templateArray['{qlist}'] .= '<a href="#" class="remove_field">Remove</a>';
                    }
                    $templateArray['{qlist}'] .= '</div>';
                }
                
                //echo out options
                if (($r_ques['type'] == 'checkbox') || ($r_ques['type'] == 'radio') || ($r_ques['type'] == 'singleselect') || ($r_ques['type'] == 'multipleselect')) {
                    $templateArray['{qlist}'] .= '
					<div class="buttons" id="'.$i.'"><span class="move">'.$i.'</span>
					<label>Options</label><input type="text" name="myLabel['.$i.']" value="'.$r_ques['question'].'"/> <select name="myText['.$i.']"><option value="">Please select</option>';
                    
                    //get selected option and select from options list
                    if ($checkbox) {
                        $templateArray['{qlist}'] .= '<option value="checkbox" selected>Check boxes</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="checkbox">Check boxes</option>';
                    }
                    if ($radio) {
                        $templateArray['{qlist}'] .= '<option value="radio" selected>Radio</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="radio">Radio</option>';
                    }
                    if ($singleselect) {
                        $templateArray['{qlist}'] .= '<option value="singleselect" selected>Dropdown Menu</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="singleselect">Dropdown Menu</option>';
                    }
                    //if($multipleselect) { $templateArray['{qlist}'] .= '<option value="multipleselect" selected>Multiple select</option>'; } else { $templateArray['{qlist}'] .= '<option value="multipleselect">Multiple select</option>'; }
                                        
                    $templateArray['{qlist}'] .= '</select> ';
                    
                    if (!$chk_status_pub) { //don't do remove if already published
                        $templateArray['{qlist}'] .= '<a href="#" class="remove_field">Remove</a>';
                    }
                    
                    if (!$chk_status_pub) { //don't do add more options already published
                        $templateArray['{qlist}'] .= '<br /><a href="#" class="add_options">Add more options</a>';
                    }
                    
                    //get current options values if any and append to options list
                    $q_ques_ext = sql("SELECT * FROM `qi_q_ext` WHERE `feqid` = '".$r_ques['id']."'");
                    $c_ques_ext = mysqli_num_rows($q_ques_ext);
                    
                    if ($c_ques_ext) {
                        //only do if questions available
                        while ($r_ques_ext = mysqli_fetch_assoc($q_ques_ext)) {
                            $templateArray['{qlist}'] .= '<div class="options"><label>&nbsp;</label><span class="move">Option</span><input type="text" name="myOptions['.$i.'][]" value="'.$r_ques_ext['option'].'" />';
                            if (!$chk_status_pub) { //dont do remove if already published
                                $templateArray['{qlist}'] .= '<a href="#" class="remove_field_options">Remove option</a>';
                            }
                            $templateArray['{qlist}'] .= '</div>';
                        }
                    }
                    $templateArray['{qlist}'] .= '</div>';
                } //echo out options
                
                
                //echo out feedback
                if (($r_ques['type'] == 'checkbox') || ($r_ques['type'] == 'radio') || ($r_ques['type'] == 'singleselect') || ($r_ques['type'] == 'multipleselect') || ($r_ques['type'] == 'smileys-5') || ($r_ques['type'] == 'smileys-3') || ($r_ques['type'] == 'numeric-5') || ($r_ques['type'] == 'numeric-3') || ($r_ques['type'] == 'yes-no')) {
                    $templateArray['{qlist}'] .= '
					<div class="buttons" id="'.$i.'"><span class="move">'.$i.'</span>
					<label>'.$label.'</label><input type="text" name="myLabel['.$i.']" value="'.$r_ques['question'].'"/> <select name="myText['.$i.']"><option value="">Please select</option>';
                    
                    //get selected option and select from options list
                    if ($smiley5) {
                        $templateArray['{qlist}'] .= '<option value="smileys-5" selected>Smiley 5 Faces</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="smileys-5">Smiley 5 Faces</option>';
                    }
                    if ($smiley3) {
                        $templateArray['{qlist}'] .= '<option value="smileys-3" selected>Smiley 3 Faces</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="smileys-3">Smiley 3 Faces</option>';
                    }
                    if ($numeric5) {
                        $templateArray['{qlist}'] .= '<option value="numeric-5" selected>Numeric 5</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="numeric-5">Numeric 5</option>';
                    }
                    if ($numeric3) {
                        $templateArray['{qlist}'] .= '<option value="numeric-3" selected>Numeric 3</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="numeric-3">Numeric 3</option>';
                    }
                    if ($yesno) {
                        $templateArray['{qlist}'] .= '<option value="yes-no" selected>Yes/No</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="yes-no">Yes/No</option>';
                    }
                                        
                    $templateArray['{qlist}'] .= '</select> ';
                    
                    if (!$chk_status_pub) { //don't do remove if already published
                        $templateArray['{qlist}'] .= '<a href="#" class="remove_field">Remove</a>';
                    }

                    $templateArray['{qlist}'] .= '</div>';
                } //echo out options
                
                //echo out uploads
                if (($r_ques['type'] == 'upload') || ($r_ques['type'] == 'image')) {
                    $templateArray['{qlist}'] .= '
					<div class="buttons" id="'.$i.'"><span class="move">'.$i.'</span>
					<label>Upload</label><input type="text" name="myLabel['.$i.']" value="'.$r_ques['question'].'"/> <select name="myText['.$i.']"><option value="">Please select</option>';
                    
                    //get selected option and select from options list
                    if ($upload) {
                        $templateArray['{qlist}'] .= '<option value="upload" selected>File</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="upload">File</option>';
                    }
                    if ($image) {
                        $templateArray['{qlist}'] .= '<option value="image" selected>Image</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="image">Image</option>';
                    }
                    $templateArray['{qlist}'] .= '</select> ';
                    
                    if (!$chk_status_pub) { //don't do remove if already published
                        $templateArray['{qlist}'] .= '<a href="#" class="remove_field">Remove</a>';
                    }
                    
                    $templateArray['{qlist}'] .= '</div>';
                } //echo out uploads
                
                $i++;
            } //while
            //check if published or not
            if (!$chk_status_pub) {
                $templateArray['{form-builder-display}'] = 'block';
            } else {
                $templateArray['{form-builder-display}'] = 'none';
            }
            $templateArray['{initial_count}'] = $i;
        } else {
            //if no questions
            if (!$chk_status_pub) {
                $templateArray['{form-builder-display}'] = 'block';
            } else {
                $templateArray['{form-builder-display}'] = 'none';
            }
        } //c_ques
        
        $templateArray['{qlist}'] .= '<input type="hidden" name="myVersion" value="'.$chk_vid.'"/>';
    } //chk status
} //edit questions


if ($o == "edit-resolution") {
    if (!userSystemRights($uid, "edit_qi")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=check-list"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $fext='&id='.$id;
    $templateArray['{sect_head_ext}'] = ': Edit Resolution';
    $templateArray['{edit-resolution}'] = "block";


    //do anyway

    $q_chk = sql("SELECT * FROM `qi` WHERE `id` = '".$id."'");
    $c_chk = mysqli_num_rows($q_chk);
    if (!$c_chk) {
        $err[] = sysMsg(4);
        $templateArray['{system-rights}'] = "none";
    } else {
        $r_chk = mysqli_fetch_assoc($q_chk);
        $name = $r_chk['name'];
        $chk_status_act = $r_chk['status'];

        $q_chk_ext = sql("SELECT * FROM `qi_ext` WHERE `fid` = '".$id."' ORDER BY `version` DESC LIMIT 0,1");
        $c_chk_ext = mysqli_num_rows($q_chk_ext);
        if (!$c_chk_ext) {
            $err[] = sysMsg(4);
            $templateArray['{system-rights}'] = "block";
        } else {
            $r_chk_ext = mysqli_fetch_assoc($q_chk_ext);
            $chk_vid = $r_chk_ext['id'];
            $chk_ver = $r_chk_ext['version'];
            $chk_status_pub = $r_chk_ext['status'];
            if ($chk_status_pub == '0') {
                if ($chk_ver == '1') {
                    $warning[] = 'Checklist is currently un-published.';
                } else {
                    if ($chk_status_act) {
                        $warning[] = 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.';
                    } else {
                        $warning[] = 'Checklist is currently un-published. No previous versions are available for data recording.';
                    }
                }
            }
            if (!$chk_status_act) {
                $err[] = 'Checklist is disabled. No data recording can be completed using this checklist.';
            }
        } //!$c_chk_ext
        
        //do questions if existing
        $q_ques = sql("SELECT * FROM `qi_resolution_q` WHERE `feid` = '".$chk_vid."' ORDER BY `order` ASC");
        $c_ques = mysqli_num_rows($q_ques);
        if ($c_ques) {
            $i = 1;
            while ($r_ques = mysqli_fetch_assoc($q_ques)) {
                if ($r_ques['type'] == 'text') {
                    $label = "Single Line";
                }
                //if($r_ques['type'] == 'textarea') { $label = "Multiple Line"; }
                if ($r_ques['type'] == 'datetime') {
                    $label = "Date & Time";
                }
                if ($r_ques['type'] == 'date') {
                    $label = "Date";
                }
                if ($r_ques['type'] == 'time') {
                    $label = "Time";
                }
                if ($r_ques['type'] == 'checkbox') {
                    $label = "Options";
                    $option_label = "Check boxes";
                    $checkbox = true;
                } else {
                    $checkbox = false;
                }
                if ($r_ques['type'] == 'radio') {
                    $label = "Options";
                    $option_label = "Radio";
                    $radio = true;
                } else {
                    $radio = false;
                }
                if ($r_ques['type'] == 'singleselect') {
                    $label = "Options";
                    $singleselect = true;
                } else {
                    $singleselect = false;
                }
                //if($r_ques['type'] == 'multipleselect') { $label = "Options"; $multipleselect = true; } else { $multipleselect = false; }
                if ($r_ques['type'] == 'upload') {
                    $label = "Upload";
                    $upload = true;
                } else {
                    $upload = false;
                }
                if ($r_ques['type'] == 'image') {
                    $label = "Upload";
                    $image = true;
                } else {
                    $image = false;
                }
                
                //echo out text, textarea, datetime, time
                if (($r_ques['type'] == 'text') || ($r_ques['type'] == 'textarea') || ($r_ques['type'] == 'datetime') || ($r_ques['type'] == 'date') || ($r_ques['type'] == 'time')) {
                    $templateArray['{qlist}'] .= '<div class="buttons" id="'.$i.'"><span class="move">'.$i.'</span><input type="hidden" name="myText['.$i.']" value="'.$r_ques['type'].'"/><label>'.$label.'</label><input type="text" name="myLabel['.$i.']" value="'.$r_ques['question'].'"/>';
                    if (!$chk_status_pub) { //don't do remove if already published
                        $templateArray['{qlist}'] .= '<a href="#" class="remove_field">Remove</a>';
                    }
                    $templateArray['{qlist}'] .= '</div>';
                }
                
                //echo out options
                if (($r_ques['type'] == 'checkbox') || ($r_ques['type'] == 'radio') || ($r_ques['type'] == 'singleselect') || ($r_ques['type'] == 'multipleselect')) {
                    $templateArray['{qlist}'] .= '
					<div class="buttons" id="'.$i.'"><span class="move">'.$i.'</span>
					<label>Options</label><input type="text" name="myLabel['.$i.']" value="'.$r_ques['question'].'"/> <select name="myText['.$i.']"><option value="">Please select</option>';
                    
                    //get selected option and select from options list
                    if ($checkbox) {
                        $templateArray['{qlist}'] .= '<option value="checkbox" selected>Check boxes</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="checkbox">Check boxes</option>';
                    }
                    if ($radio) {
                        $templateArray['{qlist}'] .= '<option value="radio" selected>Radio</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="radio">Radio</option>';
                    }
                    if ($singleselect) {
                        $templateArray['{qlist}'] .= '<option value="singleselect" selected>Single select</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="singleselect">Single select</option>';
                    }
                    //if($multipleselect) { $templateArray['{qlist}'] .= '<option value="multipleselect" selected>Multiple select</option>'; } else { $templateArray['{qlist}'] .= '<option value="multipleselect">Multiple select</option>'; }
                                        
                    $templateArray['{qlist}'] .= '</select> ';
                    
                    if (!$chk_status_pub) { //don't do remove if already published
                        $templateArray['{qlist}'] .= '<a href="#" class="remove_field">Remove</a>';
                    }
                    
                    if (!$chk_status_pub) { //don't do add more options already published
                        $templateArray['{qlist}'] .= '<br /><a href="#" class="add_options">Add more options</a>';
                    }
                    
                    //get current options values if any and append to options list
                    $q_ques_ext = sql("SELECT * FROM `qi_resolution_q_ext` WHERE `feqid` = '".$r_ques['id']."'");
                    $c_ques_ext = mysqli_num_rows($q_ques_ext);
                    
                    if ($c_ques_ext) {
                        //only do if questions available
                        while ($r_ques_ext = mysqli_fetch_assoc($q_ques_ext)) {
                            $templateArray['{qlist}'] .= '<div class="options"><label>&nbsp;</label><span class="move">Option</span><input type="text" name="myOptions['.$i.'][]" value="'.$r_ques_ext['option'].'" />';
                            if (!$chk_status_pub) { //dont do remove if already published
                                $templateArray['{qlist}'] .= '<a href="#" class="remove_field_options">Remove option</a>';
                            }
                            $templateArray['{qlist}'] .= '</div>';
                        }
                    }
                    $templateArray['{qlist}'] .= '</div>';
                } //echo out options
                
                
                //echo out uploads
                if (($r_ques['type'] == 'upload') || ($r_ques['type'] == 'image')) {
                    $templateArray['{qlist}'] .= '
					<div class="buttons" id="'.$i.'"><span class="move">'.$i.'</span>
					<label>Upload</label><input type="text" name="myLabel['.$i.']" value="'.$r_ques['question'].'"/> <select name="myText['.$i.']"><option value="">Please select</option>';
                    
                    //get selected option and select from options list
                    if ($upload) {
                        $templateArray['{qlist}'] .= '<option value="upload" selected>File</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="upload">File</option>';
                    }
                    if ($image) {
                        $templateArray['{qlist}'] .= '<option value="image" selected>Image</option>';
                    } else {
                        $templateArray['{qlist}'] .= '<option value="image">Image</option>';
                    }
                    $templateArray['{qlist}'] .= '</select> ';
                    
                    if (!$chk_status_pub) { //don't do remove if already published
                        $templateArray['{qlist}'] .= '<a href="#" class="remove_field">Remove</a>';
                    }
                    
                    $templateArray['{qlist}'] .= '</div>';
                } //echo out uploads
                
                $i++;
            } //while
            //check if published or not
            if (!$chk_status_pub) {
                $templateArray['{form-builder-display}'] = 'block';
            } else {
                $templateArray['{form-builder-display}'] = 'none';
            }
            $templateArray['{initial_count}'] = $i;
        } else {
            //if no questions
            if (!$chk_status_pub) {
                $templateArray['{form-builder-display}'] = 'block';
            } else {
                $templateArray['{form-builder-display}'] = 'none';
            }
        } //c_ques
        
        $templateArray['{qlist}'] .= '<input type="hidden" name="myVersion" value="'.$chk_vid.'"/>';
    } //chk status
} //edit resolution


if ($o == "check-list") {
    if (!userSystemRights($uid, "view_qi")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=add-check-list"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
    
    //update preferences if available
    if (cleanString($_GET['upactive']) == 'yes') {
        updUserPreference($uid, 'view-active-checklist', 1);
    }
    if (cleanString($_GET['upactive']) == 'no') {
        updUserPreference($uid, 'view-active-checklist', 0);
    }
    //get user preferences
    $usr_p = userPreference($uid, 'view-active-checklist');
    if (!$usr_p) {
        $active = " WHERE f.status != 0";
        $templateArray['{checked}'] = '';
    } else {
        $active = "";
        $templateArray['{checked}'] = 'checked';
    }

    $q_fl = sql("SELECT f.id,f.name,f.status,fex.date_created,fex.fname, fex.lname, tl.name AS type_name, tu.name AS unit FROM qi f LEFT JOIN ( SELECT fe.fid, MAX(fe.date_created) as date_created, MAX(fe.version) as version, ue.fname, ue.lname FROM qi_ext fe INNER JOIN user_ext ue ON fe.uid=ue.uid GROUP BY fe.fid, ue.fname, ue.lname ) fex ON f.id=fex.fid INNER JOIN type_list tl ON f.type_id=tl.id LEFT JOIN type_list tu ON f.unit=tu.id ".$active." ORDER BY f.name ASC");
    //$q_fl = sql("SELECT f.id,f.name,f.status,fe.date_created,ue.fname, ue.lname, tl.name AS type_name, tu.name AS unit FROM qi f LEFT JOIN qi_ext fe ON f.id=fe.fid LEFT JOIN user_ext ue ON fe.uid=ue.uid LEFT JOIN type_list tl ON f.type_id=tl.id LEFT JOIN type_list tu ON f.unit=tu.id GROUP BY fe.fid ORDER BY fe.version, f.name ASC");
    $c_fl = mysqli_num_rows($q_fl);
    if (!$c_fl) {
        $data = sysMsg(19);
    } else {
        $i = 2;
        while ($r_fl = mysqli_fetch_assoc($q_fl)) {
            $int = $i/2;
            if (is_int($int)) {
                $tr_style = 'class = "odd"';
            } else {
                $tr_style = '';
            }
            if ($r_fl['status']) {
                $im = 'active.gif';
            } else {
                $im = 'non-active.gif';
            }
            if ($r_fl['unit']) {
                $unit_name = $r_fl['unit'];
            } else {
                $unit_name = "All Units";
            }
            $data .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=edit-check-list&id='.$r_fl['id'].'">'.$r_fl['name'].'</a></td><td>'.$r_fl['type_name'].'</td><td>'.$unit_name.'</td><td>'.$r_fl['fname'].' '.$r_fl['lname'].'</td><td>'.$r_fl['date_created'].'</td><td><img src="'.WEBSITE_LOC.'console/_images/'.$im.'" class="img" /></td></tr>';
            $i++;
        }
        $data = '<table class="tablesorter" id="check_list"><thead><tr><th>Check List Name</th><th>Type</th><th>Unit</th><th>Authored by</th><th>Date Created</th><th>Status</th></tr></thead><tbody>'.$data.'</tbody></table>';
    }
    $templateArray['{fl_data}'] = $data;
} //check-list

//Nav
if (!$templateArray['{pagination}']) {
    $templateArray['{pagination}'] = '<p>'.$pagination.'</p>';
}
foreach ($sec_opts as $k => $v) {
    if ($v == $o) {
        $c = "sect_nav_c";
        $disp = "block";
        $templateArray['{sect_head_ext}'] = ": ".$k;
    } else {
        $c = "sect_nav";
        $disp = "none";
    }
    $templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$v.$fext.'" class="'.$c.'">'.$k.'</a>';
    $templateArray['{'.$v.'}'] = $disp;
}
if (!$templateArray['{sect_head_rt}']) {
    $templateArray['{sect_head_rt}'] = $sect_nav_ext;
}
if (!$templateArray['{sect_head_ext}']) {
    $templateArray['{sect_head_ext}'] = '';
}
if (!$templateArray['{success}']) {
    $templateArray['{success}'] = writeMsgs($success, "success");
}
if (!$templateArray['{warning}']) {
    $templateArray['{warning}'] = writeMsgs($warning, "warning");
}
if (!$templateArray['{error}']) {
    $templateArray['{error}'] = writeMsgs($err);
}
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$o.$fext);

if (!$templateArray['{add-check-list}']) {
    $templateArray['{add-check-list}'] = 'none';
}
if (!$templateArray['{edit-check-list}']) {
    $templateArray['{edit-check-list}'] = 'none';
}
if (!$templateArray['{edit-questions}']) {
    $templateArray['{edit-questions}'] = 'none';
}
if (!$templateArray['{edit-resolution}']) {
    $templateArray['{edit-resolution}'] = 'none';
}
//for add check list
$templateArray['{fhead-add-check}'] = $fhead; $templateArray['{fend-add-check}'] = $fend;
$templateArray['{name}'] = drawFld("text", "name", $name, "Check List Name");
$act_arr = array("0" => "Disabled","1" => "Active"); if (!$act) {
    $act = "0";
}
$templateArray['{act}'] = drawSelect("act", $act_arr, $act, "Status");
$templateArray['{submit-add-check-list}'] = drawFld("submit", "add-check-list", "Add List", "&nbsp;", "submit");
//for edit check list
$templateArray['{fhead-edit-check}'] = $fhead; $templateArray['{fend-edit-check}'] = $fend;
$templateArray['{name}'] = drawFld("text", "name", $name, "List Name");
$act_arr = array("0" => "Disabled","1" => "Active"); if (!$chk_status_act) {
    $chk_status_act = "0";
}
$templateArray['{act}'] = drawSelect("act", $act_arr, $chk_status_act, "Status");

$templateArray['{chk-edit-version}'] = drawFld("text", "chk-edit-version", $chk_ver, "Version", "", "", 1);
$templateArray['{chk-edit-vers}'] = drawFld("hidden", "chk-edit-vers", $chk_ver);
$status_pub_arr = array("0" => "Un-Published","1" => "Published"); if (!$chk_status_pub) {
    $chk_status_pub = "0";
}
$templateArray['{chk-edit-status-pub}'] = drawSelect("chk-edit-status-pub", $status_pub_arr, $chk_status_pub, "Publish Status");
$templateArray['{chk-edit-pubs}'] = drawFld("hidden", "chk-edit-pubs", $chk_status_pub);
$templateArray['{submit-edit-check-list}'] = drawFld("submit", "edit-check-list", "Update List", "&nbsp;", "submit");

$q_type = sql("SELECT * FROM `type_list` WHERE `group` = 'chkl_type' ORDER BY `name` ASC");
while ($r_type = mysqli_fetch_assoc($q_type)) {
    $type_arr[''.$r_type['id'].''] = $r_type['name'];
}
$templateArray['{chk-edit-type}'] = drawSelect("chk-edit-type", $type_arr, $type_id, "Type");
$templateArray['{chk-add-type}'] = drawSelect("chk-add-type", $type_arr, $type_id, "Type");

$q_unit = sql("SELECT * FROM `type_list` WHERE `group` = 'units' ORDER BY `name` ASC"); $unit_arr[0] = "All Units";
while ($r_unit = mysqli_fetch_assoc($q_unit)) {
    $unit_arr[''.$r_unit['id'].''] = $r_unit['name'];
}
$templateArray['{chk-edit-unit}'] = drawSelect("chk-edit-unit", $unit_arr, $unit, "Unit");
$templateArray['{chk-add-unit}'] = drawSelect("chk-add-unit", $unit_arr, $unit, "Unit");

if (!$templateArray['{qlist}']) {
    $templateArray['{qlist}'] = '';
} if (!$templateArray['{curr_ver_id}']) {
    $templateArray['{curr_ver_id}'] = drawFld("hidden", "chk-edit-vid", $chk_vid);
}
if (!$templateArray['{initial_count}']) {
    $templateArray['{initial_count}'] = '1';
}
if (!$templateArray['{qa_report_data}']) {
    $templateArray['{qa_report_data}'] = '';
}
$templateArray['{website-loc}'] = WEBSITE_LOC;

$templateArray['{checkedurl}'] = WEBSITE_LOC.'console/index.php?t=checklist-manager&upactive=yes';
$templateArray['{checkedurlfalse}'] = WEBSITE_LOC.'console/index.php?t=checklist-manager&upactive=no';

if (!$templateArray['{check-list}']) {
    $templateArray['{check-list}'] = 'none;';
}
if (!$templateArray['{url}']) {
    $templateArray['{url}'] = WEBSITE_LOC.'console/index.php?t=user-manager&o=groups';
}


//user ntoifications
$q_user_list = sql("SELECT u.id, ue.fname, ue.lname FROM user u
JOIN user_ext ue ON ue.uid=u.id 
WHERE u.active != '0' AND id != 1 ORDER BY ue.fname ASC"); $user_arr[0] = 'Please select...';
while ($r_user_list = mysqli_fetch_assoc($q_user_list)) {
    $user_arr[''.$r_user_list['id'].''] = ''.$r_user_list['fname'].' '.$r_user_list['lname'].'';
}
$templateArray['{individual-list}'] = drawSelect("individual_list", $user_arr, "", "", "", "", "", "individual_list");
$templateArray['{addurl}'] = WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$o.'&id='.$id;
if(!$templateArray['{feedback-link}']) { $templateArray['{feedback-link}'] = ''; }