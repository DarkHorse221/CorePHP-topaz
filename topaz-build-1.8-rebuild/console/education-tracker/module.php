<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
//set options
$uid = userID($sid);
$o = cleanInput($_GET['o']); $id = cleanNumber($_GET['id']); $qid = $_GET['qid']; $aid = $_GET['aid'];
if (!$o) {
    $o = 'ins';
}
$ud = SERVER_PATH.UPLOAD_DIR.'files/_education/';
$sect_head = "Education Tracker";
$sec_opts = array("In-Services" => "ins","Conference/Event" => "conf");
$fext = "&id=".$id; $del_id = $_GET['did']; $qid = $_GET['qid']; $confirm = $_GET['confirm'];

if ($o == "conf") {
    if (!userSystemRights($uid, "view_education")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=conf-add"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
    
    if ($del_id) {
        if ($confirm) {
            $q_del_conf = sql("DELETE FROM `education_conf` WHERE `eid` = '".$del_id."'");
            $q_del = sql("DELETE FROM `education` WHERE `id` = '".$del_id."'");
            if ($q_del && $q_del_conf) {
                $success[] = sysMsg(13);
            } else {
                $err[] = sysMsg(14);
            }
        } else {
            $warning[] = sysMsg(15).'<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.'&did='.$del_id.'&confirm=1">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.'">Cancel</a>.';
        }
    }
    
    $q_conf = sql("SELECT e.id, e.name, ec.loc, ec.start, ec.end FROM education e LEFT JOIN education_conf ec ON e.id=ec.eid WHERE e.tid='41' ORDER BY ec.start DESC");
    $c_conf = mysqli_num_rows($q_conf);
    if (!$c_conf) {
        $templateArray['{conf_data}'] = sysMsg(19);
    } else {
        $num_limit = DISP_ROWS;
        $pagination = '';
        if ($c_conf > $num_limit) { //apply limits to query
            if (!$_GET['pg']) {
                $limit = " LIMIT 0, ".$num_limit."";
            } else {
                $multi = cleanNumber($_GET['pg']);
                $row = ($multi * $num_limit) - $num_limit;
                $limit = " LIMIT ".$row.", ".$num_limit."";
            }
            $q_conf = sql("SELECT e.id, e.name, ec.loc, ec.start, ec.end FROM education e LEFT JOIN education_conf ec ON e.id=ec.eid WHERE e.tid='41' ORDER BY ec.start DESC ".$limit."");
            $x = ceil($c_conf/$num_limit);
            $i = 1;
            while ($i <= $x) {
                if ($i == cleanNumber($_GET['pg'])) {
                    $class = 'pagination_current';
                } else {
                    $class = 'pagination';
                }
                $pagination .= '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.'&pg='.$i.'" class="'.$class.'">'.$i.'</a>';
                $i++;
            }
        }
        $i = 2;
        $conf = '';
        while ($r_conf = mysqli_fetch_assoc($q_conf)) {
            $int = $i/2;
            if (is_int($int)) {
                $tr_style = 'class = "odd"';
            } else {
                $tr_style = '';
            }
            $conf .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=conf-edit&id='.$r_conf['id'].'">'.$r_conf['name'].'</a></td>';
            $conf .= '<td>'.$r_conf['loc'].'</td><td>'.$r_conf['start'].'</td><td>'.$r_conf['end'].'</td>';
            if (userSystemRights($uid, "delete")) {
                $conf .= '<td><a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.'&did='.$r_conf['id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a></td>';
            } else {
                $ins.= '<td>&nbsp;</td>';
            }
            $ins.= '</tr>';
            $i++;
        }
        $templateArray['{conf_data}'] = '<table class="tablesorter" id="conf"><thead><tr><th>Conference/Event</th><th>Venue/Location</th><th>Start</th><th>End</th><th>&nbsp;</th></thead><tbody>'.$conf.'</tbody></table>';
    }
} //conf


if ($o == "conf-add") {
    if (!userSystemRights($uid, "edit_education")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=conf"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $templateArray['{sect_head_ext}'] = ': Add Conference/Event';
    $templateArray['{conf-add}'] = 'block';
    if (!D4600135D233F_LOCKOUT) {
        if ($_POST['conf-add']) {
            if (validateInput($_POST['name'])) {
                $name = cleanInput($_POST['name']);
            } else {
                $name = $_POST['name'];
                $err[] = "Title: ".sysMsg(6);
            }
            if (validateInput($_POST['loc'])) {
                $loc = cleanInput($_POST['loc']);
            } else {
                $loc = $_POST['loc'];
                $err[] = "Location: ".sysMsg(6);
            }
            $conf_desc_add = $_POST['conf-desc-add'];
            $groups = $_POST['grp'];
            if ($groups) {
                foreach ($groups as $k=>$v) {
                    $grps[] = $k;
                }
                $groups = implode(';', $grps);
            }
            $start = $_POST['start'];
            $end = $_POST['end'];
            if (!($start && $end)) {
                $err[] = 'You must have start and end dates';
            }
            if ($_FILES['pdf']['name']) {
                if (getExt($_FILES['pdf']['name']) == "pdf") {
                    $pdf = makeRandom().'.'.getExt($_FILES['pdf']['name']);
                } else {
                    $err[] = "Attachment: ".sysMsg(23);
                }
            }
            if (!$err) {
                $q_aconf = sql("INSERT INTO `education` (`name`,`tid`,`groups`,`text`) VALUES ('".$name."','41','".$groups."','".$conf_desc_add."')");
                $last_id  = mysqli_insert_id($conn);
                $q_econf = sql("INSERT INTO `education_conf` (`eid`,`loc`,`start`,`end`,`attachment`) VALUES ('".$last_id."','".$loc."','".$start."','".$end."','".$pdf."')");
                
                if ($_FILES['pdf']['name']) {
                    move_uploaded_file($_FILES['pdf']['tmp_name'], $ud.$pdf);
                }
                if ($q_aconf && $q_econf) {
                    $templateArray['{message}'] = "Adding new Conference/Event now...";
                    $templateForward = "console/index.php?t=education-tracker&o=conf-edit&id=".$last_id."";
                } else {
                    $err[] = sysMsg(8);
                }
            }
        }
        $q_grp = sql("SELECT * FROM `user_rights` WHERE `tid` = '4' AND `id` != '1' ORDER BY `name` ASC");
        $i=1;
        $lim = 6;
        while ($r_grp = mysqli_fetch_assoc($q_grp)) {
            if ($i == 1) {
                $grp_beg = '<span class="std-grp">';
            } else {
                $grp_beg = '';
            }
            if ($i > $lim) {
                $grp_end = '</span>';
                $i=1;
            } else {
                $i++;
                $grp_end = '';
            }
            if ($groups) {
                $grps = explode(';', $groups);
                if (in_array($r_grp['id'], $grps)) {
                    $sel = 'checked="checked"';
                } else {
                    $sel = '';
                }
            }
            $grp.= $grp_beg.'<p><label>'.$r_grp['name'].'</label><input type="checkbox" name="grp['.$r_grp['id'].']" value="1" class="chk" '.$sel.' /></p>'.$grp_end;
        }
        $templateArray['{conf-groups}'] = $grp;
        $templateArray['{conf-start}'] = '<label class="label">Start Date</label><input type="text" id="start" name="start" value="'.$start.'" class="datetime" />';
        $templateArray['{conf-end}'] = '<label class="label">End Date</label><input type="text" id="end" name="end" value="'.$end.'" class="datetime" />';
        $templateArray['{date_functions}'] .= "$('#start').datetimepicker({ dateFormat: 'yy-mm-dd'}); $('#end').datetimepicker({ dateFormat: 'yy-mm-dd' });";
    } else {
        $err[] = sysMsg('57');
        $templateArray['{system-rights}'] = "none";
    }//lockout mode
} //conf-add

if ($o == "conf-edit") {
    if (!userSystemRights($uid, "edit_education")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=conf"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $q_educ = sql("SELECT `name` FROM `education` WHERE `id` = '".$id."'");
    $r_educ = mysqli_fetch_assoc($q_educ);
    $templateArray['{sect_head_ext}'] = ': Editing Conference/Event ('.$r_educ['name'].')';
    $templateArray['{conf-edit}'] = 'block';

    if ($_POST['edit-conf']) {
        if (validateInput($_POST['name'])) {
            $name = cleanInput($_POST['name']);
        } else {
            $name = $_POST['name'];
            $err[] = "Course: ".sysMsg(6);
        }
        if (validateInput($_POST['loc'])) {
            $loc = cleanInput($_POST['loc']);
        } else {
            $loc = $_POST['loc'];
            $err[] = "Location: ".sysMsg(6);
        }
        $conf_desc_edit = $_POST['conf-desc-edit'];
        $groups = $_POST['grp'];
        if ($groups) {
            foreach ($groups as $k=>$v) {
                $grps[] = $k;
            }
            $groups = implode(';', $grps);
        }
        $start = $_POST['start'];
        $end = $_POST['end'];
        if (!($start && $end)) {
            $err[] = 'You must have start and end dates';
        }
        if ($_FILES['edit-pdf']['name']) {
            if (getExt($_FILES['edit-pdf']['name']) == "pdf") {
                $edit_pdf = makeRandom().'.'.getExt($_FILES['edit-pdf']['name']);
            } else {
                $err[] = "Attachment: ".sysMsg(23);
            }
        }
        if (!$err) {
            $q_conf = sql("UPDATE `education` SET `name` = '".$name."', `groups` = '".$groups."', `text` = '".$conf_desc_edit."' WHERE `id` = '".$id."'");
            $q_conf_ext = sql("UPDATE `education_conf` SET `loc` = '".$loc."', `start` = '".$start."', `end` = '".$end."', `attachment` = '".$edit_pdf."' WHERE `eid` = '".$id."'");
            
            if ($_FILES['edit-pdf']['name']) {
                move_uploaded_file($_FILES['edit-pdf']['tmp_name'], $ud.$edit_pdf);
            }
            if ($q_conf && $q_conf_ext) {
                $success[] = sysMsg(9);
            } else {
                $err[] = sysMsg(8);
            }
        }
    }
    if (!$err) {
        $q_conf_edit = sql("SELECT e.id, e.name, e.text, e.groups, ec.loc, ec.start, ec.end, ec.attachment FROM education e LEFT JOIN education_conf ec ON e.id=ec.eid WHERE e.tid='41' AND e.id='".$id."'");
        $c_conf_edit = mysqli_num_rows($q_conf_edit);
        if (!$c_conf_edit) {
            $templateArray['{system-rights}'] = "none";
            $err[] = sysMsg('4');
        } else {
            $r_conf_edit = mysqli_fetch_assoc($q_conf_edit);
            $name = $r_conf_edit['name'];
            $conf_desc_edit = $r_conf_edit['text'];
            $loc = $r_conf_edit['loc'];
            $start = $r_conf_edit['start'];
            $end = $r_conf_edit['end'];
            $groups = explode(';', $r_conf_edit['groups']);
        }
    }
    if ($err) {
        $groups = explode(';', $groups);
    }
    $q_grp = sql("SELECT * FROM `user_rights` WHERE `tid` = '4' AND `id` != '1' ORDER BY `name` ASC");
    $i=1;
    $lim = 6;
    while ($r_grp = mysqli_fetch_assoc($q_grp)) {
        if ($i == 1) {
            $grp_beg = '<span class="std-grp">';
        } else {
            $grp_beg = '';
        }
        if ($i > $lim) {
            $grp_end = '</span>';
            $i=1;
        } else {
            $i++;
            $grp_end = '';
        }
        if (in_array($r_grp['id'], $groups)) {
            $sel = 'checked="checked"';
        } else {
            $sel = '';
        }
        $grp.= $grp_beg.'<p><label>'.$r_grp['name'].'</label><input type="checkbox" name="grp['.$r_grp['id'].']" value="1" class="chk" '.$sel.' /></p>'.$grp_end;
    }
    //check if attachment
    if ($r_conf_edit['attachment']) {
        if (is_file($ud.$r_conf_edit['attachment'])) {
            $templateArray['{current-attachment}'] = '<p><label>Current attachment</label><a href="'.WEBSITE_LOC.'_uploads/files/_education/'.$r_conf_edit['attachment'].'" target="_blank"><img src="'.WEBSITE_LOC.'console/_images/pdf-icon.png" class="img" /></a></p>';
        } else {
            $templateArray['{current-attachment}'] = '';
        }
    } else {
        $templateArray['{current-attachment}'] = '';
    }
    $templateArray['{conf-e-start}'] = '<label class="label">Start Date</label><input type="text" id="start" name="start" value="'.$start.'" class="datetime" />';
    $templateArray['{conf-e-end}'] = '<label class="label">End Date</label><input type="text" id="end" name="end" value="'.$end.'" class="datetime" />';
    $templateArray['{date_functions}'] .= "$('#start').datetimepicker({ dateFormat: 'yy-mm-dd'}); $('#end').datetimepicker({ dateFormat: 'yy-mm-dd' });";
    $templateArray['{conf-e-groups}'] = $grp;
    //get participants
    $q_attendees = sql("SELECT ue.id FROM education_conf ei LEFT JOIN user_education ue ON ue.conf_date_id=ei.id WHERE ei.eid='".$id."' AND (ue.id IS NOT NULL)");
    $c_attendees = mysqli_num_rows($q_attendees);
    $templateArray['{conf-participants}'] = '<label>Participants</label><a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=edit-conf-participants'.$fext.'">'.$c_attendees.'</a></label>';
} //conf-edit


//conf-participant
if ($o == "edit-conf-participants") {
    if (!userSystemRights($uid, "edit_education")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=conf-edit&id='.$id.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $templateArray['{sect_head_ext}'] = ': View Participants';
    $templateArray['{conf-edit-participants}'] = 'block';
    
    $q_conf_date = sql("SELECT id, start, end FROM education_conf WHERE eid='".$id."'");
    $c_conf_date = mysqli_num_rows($q_conf_date);
    if (!$c_conf_date) {
        $templateArray['{conf-participant-list}'] = '<p>There are no dates for this event.<p>';
    } else {
        while ($r_conf_date = mysqli_fetch_assoc($q_conf_date)) {
            $q_attend = sql("SELECT ue.uid, ue.fname, ue.lname FROM user_education ued LEFT JOIN user_ext ue ON ued.uid=ue.uid WHERE ued.conf_date_id = '".$r_conf_date['id']."' AND (ue.fname IS NOT NULL)");
            $c_attend = mysqli_num_rows($q_attend);
            $attend_list = '';
            if ($c_attend) {
                $i = 2;
                while ($r_attend = mysqli_fetch_assoc($q_attend)) {
                    $int = $i/2;
                    if (is_int($int)) {
                        $tr_style = 'class = "odd"';
                    } else {
                        $tr_style = '';
                    }
                    $attend_list .= '<tr '.$tr_style.'><td>'.$r_attend['fname'].' '.$r_attend['lname'].'</td></tr>';
                    $i++;
                }
                $attend_list .= '<tr class=""><td>Total Participants: <span style="font-weight:bold;">'.$c_attend.'</span></td></tr>';
            } else {
                $attend_list = '<tr><td>Total Participants: <span style="font-weight:bold;">'.$c_attend.'</span></td></tr>';
            }
            $templateArray['{conf-participant-list}'] .= '<table class="tablesorter"><thead><tr><th>'.$r_conf_date['start'].' - '.$r_conf_date['end'].'<span class="addparticipants"><a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=add-ins-participants&id='.$id.'&add-conf-id='.$r_conf_date['id'].'">Add participants</a></span></th></thead><tbody>'.$attend_list.'</tbody></table>';
        } //while
    }
} //conf-participant

if ($o == "ins") {
    if (!userSystemRights($uid, "view_education")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=ins-add"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
    
    if ($del_id) {
        if ($confirm) {
            $q_del_i = sql("DELETE FROM `education_ins` WHERE `eid` = '".$del_id."'");
            $q_del = sql("DELETE FROM `education` WHERE `id` = '".$del_id."'");
            if ($q_del && $q_del_i) {
                $success[] = sysMsg(13);
            } else {
                $err[] = sysMsg(14);
            }
        } else {
            $warning[] = sysMsg(15).'<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.'&did='.$del_id.'&confirm=1">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.'">Cancel</a>.';
        }
    }
    
    $q_ins = sql("SELECT e.id, e.name, e.credits, ei.start, ei.end, ei.presenter, ue.fname, ue.lname FROM education e LEFT JOIN education_ins ei ON e.id=ei.eid LEFT JOIN user_ext ue ON ue.uid=ei.pid WHERE e.tid='32' ORDER BY ei.start DESC");
    $c_ins = mysqli_num_rows($q_ins);
    if (!$c_ins) {
        $templateArray['{ins_data}'] = sysMsg(19);
    } else {
        $num_limit = DISP_ROWS;
        $pagination = '';
        if ($c_ins > $num_limit) { //apply limits to query
            if (!$_GET['pg']) {
                $limit = " LIMIT 0, ".$num_limit."";
            } else {
                $multi = cleanNumber($_GET['pg']);
                $row = ($multi * $num_limit) - $num_limit;
                $limit = " LIMIT ".$row.", ".$num_limit."";
            }
            $q_ins = sql("SELECT e.id, e.name, e.credits, ei.start, ei.end, ei.presenter, ue.fname, ue.lname FROM education e LEFT JOIN education_ins ei ON e.id=ei.eid LEFT JOIN user_ext ue ON ue.uid=ei.pid WHERE e.tid='32' ORDER BY ei.start DESC ".$limit."");
            $x = ceil($c_ins/$num_limit);
            $i = 1;
            while ($i <= $x) {
                if ($i == cleanNumber($_GET['pg'])) {
                    $class = 'pagination_current';
                } else {
                    $class = 'pagination';
                }
                $pagination .= '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.'&pg='.$i.'" class="'.$class.'">'.$i.'</a>';
                $i++;
            }
        }
        $i = 2;

        while ($r_ins = mysqli_fetch_assoc($q_ins)) {
            $int = $i/2;
            if (is_int($int)) {
                $tr_style = 'class = "odd"';
            } else {
                $tr_style = '';
            }
            $ins .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=ins-edit&id='.$r_ins['id'].'">'.$r_ins['name'].'</a></td><td>'.$r_ins['credits'].'</td>';
            if ($r_ins['presenter']) {
                $ins .= '<td>'.$r_ins['presenter'].'</td>';
            } else {
                $ins .= '<td>'.$r_ins['fname'].' '.$r_ins['lname'].'</td>';
            }
            $ins .= '<td>'.$r_ins['start'].'</td><td>'.$r_ins['end'].'</td>';
            if (userSystemRights($uid, "delete")) {
                $ins .= '<td><a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.'&did='.$r_ins['id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a></td>';
            } else {
                $ins.= '<td>&nbsp;</td>';
            }
            $ins.= '</tr>';
            $i++;
        }
        $templateArray['{ins_data}'] = '<table class="tablesorter" id="ins"><thead><tr><th>In-Service</th><th>Credits</th><th>Presenter</th><th>Start</th><th>End</th><th>&nbsp;</th></thead><tbody>'.$ins.'</tbody></table>';
    }
} //ins


if ($o == "ins-add") {
    if (!userSystemRights($uid, "edit_education")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=ins"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $templateArray['{sect_head_ext}'] = ': Add In-Service';
    $templateArray['{ins-add}'] = 'block';
    if (!D4600135D233F_LOCKOUT) {
        if ($_POST['ins-add']) {
            if (validateInput($_POST['name'])) {
                $name = cleanInput($_POST['name']);
            } else {
                $name = $_POST['name'];
                $err[] = "In-Service: ".sysMsg(6);
            }
            if (cleanNumber($_POST['credits'])) {
                $credits = cleanNumber($_POST['credits']);
            } else {
                $credits = $_POST['credits'];
                $err[] = "Credits: ".sysMsg(6);
            }
            $event_type = cleanNumber($_POST['event-type']);
            $groups = $_POST['grp'];
            if ($groups) {
                foreach ($groups as $k=>$v) {
                    $grps[] = $k;
                }
                $groups = implode(';', $grps);
            }
            $mand = cleanNumber($_POST['mand']);
            $desc = $_POST['desc-add'];
            $pid = cleanNumber($_POST['pid']);
            $start = $_POST['start'];
            $end = $_POST['end'];
            $presenter = cleanString($_POST['presenter']);
            if ($pid) {
                $presenter = "";
            }
            if (!($start && $end)) {
                $err[] = 'You must have start and end dates';
            } else {
                if (!$pid && !$presenter) {
                    $err[] = 'No presenter has been selected';
                }
            }
            if (!$err) {
                $q_ains = sql("INSERT INTO `education` (`name`,`tid`,`credits`,`groups`,`mandatory`,`text`,`edu_type`) VALUES ('".$name."','32','".$credits."','".$groups."','".$mand."','".$desc."','".$event_type."')");
                $last_id  = mysqli_insert_id($conn);
                $q_eins = sql("INSERT INTO `education_ins` (`eid`,`start`,`end`,`pid`,`presenter`) VALUES ('".$last_id."','".$start."','".$end."','".$pid."','".$presenter."')");
                if ($q_ains && $q_eins) {
                    $templateArray['{message}'] = "Adding new In-Service now...";
                    $templateForward = "console/index.php?t=education-tracker&o=ins-edit&id=".$last_id."";
                } else {
                    $err[] = sysMsg(8);
                }
            }
        }
        $q_grp = sql("SELECT * FROM `user_rights` WHERE `tid` = '4' AND `id` != '1' ORDER BY `name` ASC");
        $i=1;
        $lim = 6;
        while ($r_grp = mysqli_fetch_assoc($q_grp)) {
            if ($i == 1) {
                $grp_beg = '<span class="std-grp">';
            } else {
                $grp_beg = '';
            }
            if ($i > $lim) {
                $grp_end = '</span>';
                $i=1;
            } else {
                $i++;
                $grp_end = '';
            }
            if ($groups) {
                $grps = explode(';', $groups);
                if (in_array($r_grp['id'], $grps)) {
                    $sel = 'checked="checked"';
                } else {
                    $sel = '';
                }
            }
            $grp.= $grp_beg.'<p><label>'.$r_grp['name'].'</label><input type="checkbox" name="grp['.$r_grp['id'].']" value="1" class="chk" '.$sel.' /></p>'.$grp_end;
        }
        $templateArray['{a-groups}'] = $grp;
        
        $q_users = sql("SELECT u.id, ue.fname, ue.lname FROM user u, user_ext ue WHERE u.id=ue.uid AND u.id !='1' ORDER BY ue.fname ASC");
        $u_arr['0'] = 'Please select...';
        while ($r_users = mysqli_fetch_assoc($q_users)) {
            $u_arr[''.$r_users['id'].''] = $r_users['fname'].' '.$r_users['lname'];
        }
        
        $templateArray['{date_functions}'] .= "$('#start').datetimepicker({ dateFormat: 'yy-mm-dd'}); $('#end').datetimepicker({ dateFormat: 'yy-mm-dd' });";
        $dates .= '<tr><td><input type="text" id="start" name="start" value="'.$start.'" class="datetime" /></td><td><input type="text" id="end" name="end" value="'.$end.'" class="datetime" /></td>
		<td>'.drawSelect("pid", $u_arr, $pid).'</td><td>'.drawFld("text", "presenter", $presenter, "").'</td></tr>';
        $templateArray['{dates-add}'] = '<table class="tablesorter" id="dates-add"><thead><tr><th>Start (Date & Time)</th><th>End (Date & Time)</th><th>Presenter</th><th>External Presenter</th></thead><tbody>'.$dates.'</tbody></table>';
    } else {
        $err[] = sysMsg('57');
        $templateArray['{system-rights}'] = "none";
    }//lockout mode
} //ins-add

//ins-participant
if ($o == "edit-ins-participants") {
    if (!userSystemRights($uid, "edit_education")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
	$sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=ins-edit&id='.$id.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $templateArray['{sect_head_ext}'] = ': Participants';
    $templateArray['{ins-edit-participants}'] = 'block';
	
	$q_ins_date = sql("SELECT `id`, `start`, `end` FROM `education_ins` WHERE `eid`='".$id."'");
	$c_ins_date = mysqli_num_rows($q_ins_date);
	if (!$c_ins_date) {
		$templateArray['{participant-list}'] = '<p>There are no dates for this event.<p>';
	} else {
		while ($r_ins_date = mysqli_fetch_assoc($q_ins_date)) {
			$q_attend = sql("SELECT ue.uid, ue.fname, ue.lname FROM user_education ued LEFT JOIN user_ext ue ON ued.uid=ue.uid WHERE ued.ins_date_id = '".$r_ins_date['id']."' AND (ue.fname IS NOT NULL)");
			$c_attend = mysqli_num_rows($q_attend);
			$attend_list = '';
			if ($c_attend) {
				$i = 2;
				while ($r_attend = mysqli_fetch_assoc($q_attend)) {
					$int = $i/2;
					if (is_int($int)) {
						$tr_style = 'class = "odd"';
					} else {
						$tr_style = '';
					}
					$attend_list .= '<tr '.$tr_style.'><td>'.$r_attend['fname'].' '.$r_attend['lname'].'</a></td></tr>';
					$i++;
				}
				$attend_list .= '<tr class=""><td>Total Participants: <span style="font-weight:bold;">'.$c_attend.'</span></td></tr>';
			} else {
				$attend_list = '<tr><td>Total Participants: <span style="font-weight:bold;">'.$c_attend.'</span></td></tr>';
			}
			$templateArray['{participant-list}'] .= '<table class="tablesorter"><thead><tr><th>'.$r_ins_date['start'].' - '.$r_ins_date['end'].'<span class="addparticipants"><a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=add-ins-participants&id='.$id.'&add-date-id='.$r_ins_date['id'].'">Add participants</a></span></th></thead><tbody>'.$attend_list.'</tbody></table>';
		} //while
	}

} //ins-participant


//add-participant
if ($o == "add-ins-participants") {
    if (!userSystemRights($uid, "edit_education")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
	}
	
	$event_id = cleanString($_GET['add-date-id']);
	$conf_id = cleanString($_GET['add-conf-id']);
	
	//only do if there are ids available
    if (($event_id || $conf_id) && $id) {
        if ($event_id) {
            $sqlext = 'education_ins';
			$sqlcol = 'ins_date_id';
			$query_id = $event_id;
			$oext = 'edit-ins-participants';
			$surl = 'add-date-id';
        }
        if ($conf_id) {
            $sqlext = 'education_conf';
			$sqlcol = 'conf_date_id';
			$query_id = $conf_id;
			$oext = 'edit-conf-participants';
			$surl = 'add-conf-id';
		}
		
		$sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$oext.'&id='.$id.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
		$templateArray['{sect_head_ext}'] = ': Participants';
		$templateArray['{ins-add-participants}'] = 'block';


        $q_getname = sql("SELECT e.name, ei.start, ei.end FROM education e LEFT JOIN  ".$sqlext." ei ON e.id=ei.eid WHERE e.id = '".$id."' AND ei.id = '".$query_id."'");
        $r_getname = mysqli_fetch_assoc($q_getname);
        $templateArray['{eventname}'] = $r_getname['name'].' ('.$r_getname['start'].' - '.$r_getname['end'].')';

        //do anyway
        if ($_POST['edit-managers']) {
            $listusrs_arr = array();
            $q_listofusrs = sql("SELECT `uid` FROM `user_education` WHERE ".$sqlcol." = '".$query_id."'");
            while ($r_listofusrs = mysqli_fetch_assoc($q_listofusrs)) {
                $listusrs_arr[] = $r_listofusrs['uid'];
            }

            if ($_POST['sm']) {
                foreach ($_POST['sm'] as $k => $v) {
                    if (!in_array($v, $listusrs_arr)) {
                        $q_ins_usrs = sql("INSERT INTO `user_education` (`uid`, ".$sqlcol.") VALUES ('".$v."','".$query_id."')");
                    }
                }
            }
            if ($q_ins_usrs) {
                $success[] = sysMsg(9);
            }
        }
    
        //get all the users who have already attended the inservice
        $q_cman = sql("SELECT `uid` FROM `user_education` WHERE ".$sqlcol." = '".$query_id."'");
        while ($r_cman = mysqli_fetch_assoc($q_cman)) {
            $man_arr[] = $r_cman['uid'];
        }

        $q_man = sql("SELECT u.id, ue.fname, ue.lname FROM user u, user_ext ue WHERE u.id=ue.uid AND u.active = '1' AND u.id != '".$id."' AND u.id != '1' ORDER BY ue.fname ASC");
        while ($r_man = mysqli_fetch_assoc($q_man)) {
            if ($man_arr && in_array($r_man['id'], $man_arr)) {
                $sm .= '<option value="'.$r_man['id'].'">'.$r_man['fname'].' '.$r_man['lname'].'</option>';
            } else {
                $lom .= '<option value="'.$r_man['id'].'">'.$r_man['fname'].' '.$r_man['lname'].'</option>';
            }
        }
        $templateArray['{lom}'] = '<select name="lom[]" multiple id="lom" class="multiple-select">'.$lom.'</select>';
        $templateArray['{sm}'] = '<select name="sm[]" multiple id="sm" class="multiple-select"></select>';
        $templateArray['{attendees-list}'] = '<select name="al[]" multiple id="al" class="multiple-select disabled" disabled>'.$sm.'</select>';
    } else {
		$err[] = "No system IDs exist";
		$templateArray['{ins-add-participants}'] = 'none';
	}
} //ins-participant


if ($o == "ins-edit") {
    if (!userSystemRights($uid, "edit_education")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=ins"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $templateArray['{sect_head_ext}'] = ': Edit In-Service';
    $templateArray['{ins-edit}'] = 'block';
    if ($del_id) {
        if ($confirm) {
            $q_del = sql("DELETE FROM `education_ins` WHERE `id` = '".$del_id."'");
            if ($q_del) {
                $success[] = sysMsg(13);
            } else {
                $err[] = sysMsg(14);
            }
        } else {
            $warning[] = sysMsg(15).'<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.$fext.'&did='.$del_id.'&confirm=1">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.$fext.'">Cancel</a>.';
        }
    }
    if ($_POST['edit-ins']) {
        if (validateInput($_POST['name'])) {
            $name = cleanInput($_POST['name']);
        } else {
            $name = $_POST['name'];
            $err[] = "In-Service: ".sysMsg(6);
        }
        if (cleanNumber($_POST['credits'])) {
            $credits = cleanNumber($_POST['credits']);
        } else {
            $credits = $_POST['credits'];
            $err[] = "Credits: ".sysMsg(6);
        }
        $event_type = cleanNumber($_POST['event-type']);
        $groups = $_POST['grp'];
        if ($groups) {
            foreach ($groups as $k=>$v) {
                $grps[] = $k;
            }
            $groups = implode(';', $grps);
        }
        $mand = cleanNumber($_POST['mand']);
        $desc = $_POST['desc'];
        if (!$err) {
            $i = 2;
            $size = count($_POST['did']) + $i;
            while ($i < $size) {
                $did = $_POST['did'][$i];
                $start = $_POST['start'][$i];
                $end = $_POST['end'][$i];
                $pid = $_POST['pid'][$i];
                $presenter = $_POST['presenter'][$i];
                if ($pid) {
                    $presenter = "";
                }
                if ($start && $end) {
                    if (!$pid && !$presenter) {
                        $warning[] = 'No presenter has been selected for the '.$start;
                    }
                }
                if ($did && ($pid || $presenter)) {
                    if ($start && $end) {
                        $q_udate = sql("UPDATE `education_ins` SET `start` = '".$start."', `end` = '".$end."', `pid` = '".$pid."', `presenter` =  '".$presenter."' WHERE `id` = '".$did."'");
                        if ($q_udate) {
                            $success[] = sysMsg(9);
                        } else {
                            $err[] = sysMsg(8);
                        }
                    }
                } else {
                    if ($start && $end) {
                        $q_idate = sql("INSERT INTO `education_ins` (`eid` , `start` , `end` , `pid`, `presenter`) VALUES ('".$id."', '".$start."', '".$end."', '".$pid."', '".$presenter."')");
                        if ($q_idate) {
                            $success[] = sysMsg(9);
                        } else {
                            $err[] = sysMsg(8);
                        }
                    }
                }
                $i++;
            }
            $q_edu = sql("UPDATE `education` SET `name` = '".$name."', `credits` = '".$credits."', `groups` = '".$groups."', `mandatory` = '".$mand."', `text` =  '".$desc."', `edu_type` =  '".$event_type."' WHERE `id` = '".$id."'");
            if ($q_edu) {
                $success[] = sysMsg(9);
            } else {
                $err[] = sysMsg(8);
            }
        }
    }
    if (!$err) {
        $q_iedit = sql("SELECT id, name, credits, tid, groups, mandatory, text, edu_type FROM education WHERE id='".$id."'");
        $c_iedit = mysqli_num_rows($q_iedit);
        if (!$c_iedit) {
            $templateArray['{system-rights}'] = "none";
            $err[] = sysMsg('4');
        } else {
            //get participants
            $q_attendees = sql("SELECT ue.id FROM education_ins ei LEFT JOIN user_education ue ON ue.ins_date_id=ei.id WHERE ei.eid='".$id."' AND (ue.id IS NOT NULL)");
            $c_attendees = mysqli_num_rows($q_attendees);
            $templateArray['{participants}'] = '<label>Participants</label><a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=edit-ins-participants'.$fext.'">'.$c_attendees.'</a></label>';
            $r_iedit = mysqli_fetch_assoc($q_iedit);
            $name = $r_iedit['name'];
            $credits = $r_iedit['credits'];
            $groups = explode(';', $r_iedit['groups']);
            $mand = $r_iedit['mandatory'];
            $desc = $r_iedit['text'];
            $event_type = $r_iedit['edu_type'];
            $q_eins = sql("SELECT * FROM `education_ins` WHERE `eid` = '".$id."'");
            $c_eins = mysqli_num_rows($q_eins);
            if (!$c_eins) { //do something
                $q_users = sql("SELECT u.id, ue.fname, ue.lname FROM user u, user_ext ue WHERE u.id=ue.uid AND u.id !='1' ORDER BY ue.fname ASC");
                $u_arr['0'] = 'Please select...';
                while ($r_users = mysqli_fetch_assoc($q_users)) {
                    $u_arr[''.$r_users['id'].''] = $r_users['fname'].' '.$r_users['lname'];
                }
                $i = 2;
            } else {
                $q_users = sql("SELECT u.id, ue.fname, ue.lname FROM user u, user_ext ue WHERE u.id=ue.uid AND u.id !='1' ORDER BY ue.fname ASC");
                $u_arr['0'] = 'Please select...';
                while ($r_users = mysqli_fetch_assoc($q_users)) {
                    $u_arr[''.$r_users['id'].''] = $r_users['fname'].' '.$r_users['lname'];
                }
                $i = 2;
                while ($r_eins = mysqli_fetch_assoc($q_eins)) {
                    $int = $i/2;
                    if (is_int($int)) {
                        $tr_style = 'class = "odd"';
                    } else {
                        $tr_style = '';
                    }
                    
                    //check if any users, if not delete date
                    $q_usr_ins = sql("SELECT `id` FROM `user_education` WHERE `ins_date_id` = '".$r_eins['id']."'");
                    $c_usr_ins = mysqli_num_rows($q_usr_ins);
                    
                    //script the dates
                    if ($r_eins['start']) {
                        $s_data = $r_eins['start'];
                        $start = new DateTime($s_data);
                        $def_sdate = $start->format('Y-m-d');
                        $h_sdate = $start->format('H');
                        $m_sdate = $start->format('i');
                    } else {
                        $start = new DateTime('now');
                        $def_sdate = $start->format('Y-m-d');
                        $h_sdate = '';
                        $m_sdate = '';
                    }
                    if ($r_eins['end']) {
                        $e_data = $r_eins['end'];
                        $end = new DateTime($e_data);
                        $def_edate = $end->format('Y-m-d');
                        $h_edate = $end->format('H');
                        $m_edate = $end->format('i');
                    } else {
                        $end = new DateTime('now');
                        $def_edate = $end->format('Y-m-d');
                        $h_edate = '';
                        $m_edate = '';
                    }
                    
                    
                    $del_chk = new DateTime('now');
                    $del_chk = $del_chk->format('Y-m-d H:i:s');
                    if ($c_usr_ins) {
                        $dis = 'disabled="disabled"';
                        $sel_dis = 1;
                    } else {
                        $dis = '';
                        $sel_dis = '';
                    }
                    
                    $templateArray['{date_functions}'] .= "$('#start".$i."').datetimepicker({ dateFormat: 'yy-mm-dd', defaultDate: '".$def_sdate."', hour: '".$h_sdate."', minute: '". $m_sdate."' }); $('#end".$i."').datetimepicker({ dateFormat: 'yy-mm-dd',	defaultDate: '".$def_edate."', hour: '".$h_edate."', minute: '". $m_edate."' });";
                    //
                    $dates .= '<tr '.$tr_style.'><td>'.drawFld("hidden", "did[$i]", $r_eins['id']).'<input type="text" id="start'.$i.'" name="start['.$i.']" value="'.$r_eins['start'].'" class="datetime" '.$dis.' /></td><td><input type="text" id="end'.$i.'" name="end['.$i.']" value="'.$r_eins['end'].'" class="datetime" '.$dis.' /></td>
					<td>'.drawSelect("pid[$i]", $u_arr, $r_eins['pid'], '', '', '', $sel_dis).'</td><td>'.drawFld("text", "presenter[$i]", $r_eins['presenter'], "", "", "", $sel_dis).'</td><td>';
                    
                    if (!$dis) {
                        $dates .= '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.$fext.'&did='.$r_eins['id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" style="margin-top:6px;" /></a>';
                    }
                    $dates .= '</td></tr>';
                    $i++;
                }
            }
            //always add one more date
            $templateArray['{date_functions}'] .= "$('#start".$i."').datetimepicker({ dateFormat: 'yy-mm-dd'}); $('#end".$i."').datetimepicker({ dateFormat: 'yy-mm-dd' });";
            $dates .= '<tr '.$tr_style.'><td>'.drawFld("hidden", "did[$i]", '').'<input type="text" id="start'.$i.'" name="start['.$i.']" value="" class="datetime" /></td><td><input type="text" id="end'.$i.'" name="end['.$i.']" value="" class="datetime" /></td>
					<td>'.drawSelect("pid[$i]", $u_arr, $r_eins['pid']).'</td><td>'.drawFld("text", "presenter[$i]", $r_eins['presenter'], "").'</td><td>&nbsp;</td></tr>';
            $templateArray['{dates}'] = '<table class="tablesorter" id="dates"><thead><tr><th>Start (Date & Time)</th><th>End (Date & Time)</th><th>Presenter</th><th>External Presenter</th><th>&nbsp;</th></thead><tbody>'.$dates.'</tbody></table>';
        }
    }
    
    if ($err) {
        $groups = explode(';', $groups);
    }
    $q_grp = sql("SELECT * FROM `user_rights` WHERE `tid` = '4' AND `id` != '1' ORDER BY `name` ASC");
    $i=1;
    $lim = 6;
    while ($r_grp = mysqli_fetch_assoc($q_grp)) {
        if ($i == 1) {
            $grp_beg = '<span class="std-grp">';
        } else {
            $grp_beg = '';
        }
        if ($i > $lim) {
            $grp_end = '</span>';
            $i=1;
        } else {
            $i++;
            $grp_end = '';
        }
        if (in_array($r_grp['id'], $groups)) {
            $sel = 'checked="checked"';
        } else {
            $sel = '';
        }
        $grp.= $grp_beg.'<p><label>'.$r_grp['name'].'</label><input type="checkbox" name="grp['.$r_grp['id'].']" value="1" class="chk" '.$sel.' /></p>'.$grp_end;
    }
    $templateArray['{groups}'] = $grp;
} //ins-edit


//Nav
foreach ($sec_opts as $k => $v) {
    if ($v == $o) {
        $c = "sect_nav_c";
        $disp = "block";
        $templateArray['{sect_head_ext}'] = ": ".$k;
    } else {
        $c = "sect_nav";
        $disp = "none";
    }
    $templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$v.'" class="'.$c.'">'.$k.'</a>';
    $templateArray['{'.$v.'}'] = $disp;
}

if (!$templateArray['{section_nav}']) {
    $templateArray['{section_nav}'] = "";
}

if (!$sect_head) {
    $sect_head = "Error";
}
if (!$templateArray['{sect_head}']) {
    $templateArray['{sect_head}'] = $sect_head;
}
if (!$templateArray['{sect_head_ext}']) {
    $templateArray['{sect_head_ext}'] = "";
}
if (!$templateArray['{sect_head_rt}']) {
    $templateArray['{sect_head_rt}'] = $sect_nav_ext;
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
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=education-tracker&o='.$o.$fext, "", "", 1);

if (!$templateArray['{ins-edit}']) {
    $templateArray['{ins-edit}'] = 'none';
}
if (!$templateArray['{ins-add}']) {
    $templateArray['{ins-add}'] = 'none';
}
if (!$templateArray['{ins_data}']) {
    $templateArray['{ins_data}'] = '';
}
if (!$templateArray['{conf-edit}']) {
    $templateArray['{conf-edit}'] = 'none';
}
if (!$templateArray['{conf-add}']) {
    $templateArray['{conf-add}'] = 'none';
}
if (!$templateArray['{conf_data}']) {
    $templateArray['{conf_data}'] = '';
}
if (!$templateArray['{ins-edit-participants}']) {
    $templateArray['{ins-edit-participants}'] = 'none';
}
if (!$templateArray['{ins-add-participants}']) {
    $templateArray['{ins-add-participants}'] = 'none';
}
if (!$templateArray['{conf-edit-participants}']) {
    $templateArray['{conf-edit-participants}'] = 'none';
}
//for edit ins
$templateArray['{fhead-ins-edit}'] = $fhead; $templateArray['{fend-ins-edit}'] = $fend;
$templateArray['{name}'] = drawFld("text", "name", $name, "In-Service");
$templateArray['{credits}'] = drawFld("text", "credits", $credits, "Credits");
$mand_arr = array("0" => "No","1" => "Yes"); if (!$mand) {
    $mand = "0";
}
$templateArray['{mandatory}'] = drawSelect("mand", $mand_arr, $mand, "Mandatory");
$templateArray['{submit-ins-edit}'] = drawFld("submit", "edit-ins", "Update In-Service", "", "submit");
//for edit participants
if (!$templateArray['{participant-list}']) {
    $templateArray['{participant-list}'] = '';
}
//for edit conf participants
if (!$templateArray['{conf-participant-list}']) {
    $templateArray['{conf-participant-list}'] = '';
}
//for add ins
$templateArray['{fhead-ins-add}'] = $fhead; $templateArray['{fend-ins-add}'] = $fend;
$templateArray['{a-name}'] = drawFld("text", "name", $name, "In-Service");
$templateArray['{a-credits}'] = drawFld("text", "credits", $credits, "Credits");
$templateArray['{a-mandatory}'] = drawSelect("mand", $mand_arr, $mand, "Mandatory");
$templateArray['{submit-ins-add}'] = drawFld("submit", "ins-add", "Add In-Service", "", "submit");
$q_edu = sql("SELECT * FROM `type_list` WHERE `group` = 'edu_typ' ORDER BY `name` ASC");
$edu_arr[] = 'Please select...';
while ($r_edu = mysqli_fetch_assoc($q_edu)) {
    $edu_arr[''.$r_edu['id'].''] = $r_edu['name'];
}
$templateArray['{ins-event-type}'] = drawSelect("event-type", $edu_arr, $event_type, "Event type");
//for add conf
$templateArray['{fhead-conf-add}'] = $fhead; $templateArray['{fend-conf-add}'] = $fend;
$templateArray['{conf-name}'] = drawFld("text", "name", $name, "Title");
$templateArray['{conf-loc}'] = drawFld("text", "loc", $loc, "Venue/Location");
$templateArray['{conf-attachment}'] = drawFld("file", "pdf", "", "Attachment");
$templateArray['{conf-desc-add}'] = drawTxtBox("conf-desc-add", $conf_desc_add);
$templateArray['{submit-conf-add}'] = drawFld("submit", "conf-add", "Add Conference/Event", "", "submit");
//for add crs
$templateArray['{fhead-crs-add}'] = $fhead; $templateArray['{fend-crs-add}'] = $fend;
$templateArray['{c-name}'] = drawFld("text", "name", $name, "Course");
$templateArray['{c-credits}'] = drawFld("text", "credits", $credits, "Credits");
$templateArray['{c-exp-period}'] = drawFld("text", "exp_period", $exp_period, "Renewal Period (Months)");
$templateArray['{c-mandatory}'] = drawSelect("mand", $mand_arr, $mand, "Mandatory");
$templateArray['{c-pass-mark}'] = drawFld("text", "pass_mark", $pass_mark, "Pass Mark %");
$templateArray['{submit-crs-add}'] = drawFld("submit", "crs-add", "Add Course", "", "submit");
//for edit ins
$templateArray['{fhead-crs-edit}'] = $fhead; $templateArray['{fend-crs-edit}'] = $fend;
$templateArray['{ce-name}'] = drawFld("text", "name", $name, "Course");
$templateArray['{ce-credits}'] = drawFld("text", "credits", $credits, "Credits");
$templateArray['{ce-exp-period}'] = drawFld("text", "exp_period", $exp_period, "Renewal Period (Months)");
$mand_arr = array("0" => "No","1" => "Yes"); if (!$mand) {
    $mand = "0";
}
$templateArray['{ce-mandatory}'] = drawSelect("mand", $mand_arr, $mand, "Mandatory");
$templateArray['{ce-pass-mark}'] = drawFld("text", "pass_mark", $pass_mark, "Pass Mark %");
$templateArray['{submit-crs-edit}'] = drawFld("submit", "edit-crs", "Update Course", "", "submit");
$templateArray['{ins-edit-event-type}'] = drawSelect("event-type", $edu_arr, $event_type, "Event type");
//for edit conf
$templateArray['{fhead-conf-edit}'] = $fhead; $templateArray['{fend-conf-edit}'] = $fend;
$templateArray['{conf-e-name}'] = drawFld("text", "name", $name, "Title");
$templateArray['{conf-e-loc}'] = drawFld("text", "loc", $loc, "Venue/Location");
$templateArray['{conf-desc-edit}'] = drawTxtBox("conf-desc-edit", $conf_desc_edit);
$templateArray['{conf-edit-attachment}'] = drawFld("file", "edit-pdf", "", "Attachment");
$templateArray['{submit-conf-edit}'] = drawFld("submit", "edit-conf", "Update Converence/Event", "", "submit");
//other
$templateArray['{desc-c-edit}'] = drawTxtBox("desc-c-edit", $desc);
$templateArray['{desc-c-add}'] = drawTxtBox("desc-c-add", $desc);
$templateArray['{desc-add}'] = drawTxtBox("desc-add", $desc);
$templateArray['{desc}'] = drawTxtBox("desc", $desc);
if (!$templateArray['{date_functions}']) {
    $templateArray['{date_functions}'] = '';
}
if (!$templateArray['{pagination}']) {
    $templateArray['{pagination}'] = $pagination;
}
if (!$templateArray['{info}']) {
    $templateArray['{info}'] = '';
}
$templateArray['{fhead-managers}'] = '<form method="post" action="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$o.'&id='.$id.'&'.$surl.'='.$query_id.'" id="managers" onsubmit="selectAllOptions(\'sm\');" >';$templateArray['{fend-managers}'] = '</form>';
$templateArray['{submit-managers}'] = drawFld("submit","edit-managers","Add Attendees/Participants","","submit");