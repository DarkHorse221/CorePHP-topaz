<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
//set options
$uid = userID($sid);
$del_id = cleanNumber($_GET['del']); $confirm = cleanNumber($_GET['confirm']);
$stat = cleanNumber($_GET['status']); $id = cleanNumber($_GET['id']); $hid = cleanNumber($_GET['hid']);

$sec_opts = array("Audit Records" => "qa-records","Audits" => "qa-checklist");
$o = cleanInput($_GET['o']); if (!$o) {
    $o = 'qa-records';
} //set default

if ($o == "qa-records") {
    if (!userSystemRights($uid, "view_qa_audit_records")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $q_list = sql("SELECT cer.id,cer.date, ce.version, ue.fname, ue.lname, c.name, c.id AS cid, tl.name AS type_name, tu.name AS unit FROM qa_responses cer LEFT JOIN qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid LEFT JOIN type_list tl ON c.type_id=tl.id LEFT JOIN type_list tu ON c.unit=tu.id WHERE c.status = '1' ORDER BY cer.date DESC");
        $c_list = mysqli_num_rows($q_list);
        $num_limit = DISP_ROWS;
        if ($c_list > $num_limit) { //apply limits to query
            if (!$_GET['pg']) {
                $limit = " LIMIT 0, ".$num_limit."";
            } else {
                $multi = cleanNumber($_GET['pg']);
                $row = ($multi * $num_limit) - $num_limit;
                $limit = " LIMIT ".$row.", ".$num_limit."";
            }
            $q_list = sql("SELECT cer.id,cer.date, ce.version, ue.fname, ue.lname, c.name, c.id AS cid, tl.name AS type_name, tu.name AS unit FROM qa_responses cer LEFT JOIN qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid LEFT JOIN type_list tl ON c.type_id=tl.id LEFT JOIN type_list tu ON c.unit=tu.id WHERE c.status = '1' ORDER BY cer.date DESC ".$limit."");
    
            $max_pages = ceil($c_list / $num_limit); //edit c_list for row count
            $page_limit = PAGE_LIMIT;
            $curr_pg = cleanNumber($_GET['pg']);
            if (!$curr_pg) {
                $curr_pg = 1;
            }
            if ($curr_pg == 1) {
                $prev_pg = $curr_pg;
            } else {
                $prev_pg = $curr_pg - 1;
            }
    
            if ($max_pages > $page_limit) {
                $int = ceil($curr_pg/$page_limit);
                $end_pg = $int*$page_limit;
                $start_pg = $end_pg - ($page_limit - 1);
            } else {
                $int = ceil($curr_pg/$max_pages);
                $end_pg = $int*$max_pages;
                $start_pg = $end_pg - ($max_pages - 1);
            }
    
            if ($end_pg >= $max_pages) {
                $end_pg = $max_pages;
            }
            if ($start_pg <=1) {
                $start_pg = 1;
            }
            if ($curr_pg == $max_pages) {
                $next_pg = $curr_pg;
            } else {
                $next_pg = $curr_pg + 1;
            }
    
            //$i = 1;
            while ($start_pg <= $end_pg) {
                if ($start_pg == $curr_pg) {
                    $class = 'pagination_current';
                } else {
                    $class = 'pagination';
                }
                $pgs .= '<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=qa-records&pg='.$start_pg.'" class="'.$class.'">'.$start_pg.'</a>';
                $start_pg++;
            }
        }
        $pagination = '<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=qa-records&pg='.$prev_pg.'" class="pagination">Prev</a>'.$pgs.'<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=qa-records&pg='.$next_pg.'" class="pagination">Next</a>';

        if (!$c_list) {
            $list = '<tr><td colspan="6">No records for any audits</td></tr>';
        } else {
            $i = 2;
            while ($r_list = mysqli_fetch_assoc($q_list)) {
                $int = $i/2;
                if (is_int($int)) {
                    $tr_style = 'class = "odd"';
                } else {
                    $tr_style = '';
                }
                if ($r_list['unit']) {
                    $unit_name = $r_list['unit'];
                } else {
                    $unit_name = "All Units";
                }
                $list .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=qa-checklist-history&id='.$r_list['cid'].'&hid='.$r_list['id'].'">'.$r_list['name'].'</a></td><td>'.$r_list['type_name'].'</td><td>'.$unit_name.'</td><td>'.$r_list['version'].'</td><td>'.$r_list['date'].'</td><td>'.$r_list['fname'].' '.$r_list['lname'].'</td></tr>';
                $i++;
            }
            $templateArray['{qa_report_data}'] = '<table class="tablesorter" id="qa-records"><thead><tr><th>Audit Name</th><th>Type</th><th>Unit</th><th>Version</th><th>Date Reported</th><th>Reported By</th></thead><tbody>'.$list.'</tbody></table>';
        } //$c_list
    } //!$err
}

if ($o == "qa-checklist") {
    if (!userSystemRights($uid, "view_qa_audit_records")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=add-qa-checklist"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
        //update preferences if available
        if (cleanString($_GET['upactive']) == 'yes') {
            updUserPreference($uid, 'view-active-audit', 1);
        }
        if (cleanString($_GET['upactive']) == 'no') {
            updUserPreference($uid, 'view-active-audit', 0);
        }
        //get user preferences
        $usr_p = userPreference($uid, 'view-active-audit');
        if (!$usr_p) {
            $active = " AND c.status != 0";
            $templateArray['{checked}'] = '';
        } else {
            $active = "";
            $templateArray['{checked}'] = 'checked';
        }

        $q_chk = sql("SELECT c.id, c.name, c.status, cex.date_created, cex.version, cex.status AS published, cex.fname, cex.lname, tl.name AS type_name, tu.name AS unit
FROM qa_checklist c
LEFT JOIN (
	SELECT ce.cid, MAX(ce.date_created) as date_created, MAX(ce.version) as version, MAX(ce.status) as status, ue.fname, ue.lname
		FROM qa_checklist_ext ce
		INNER JOIN user_ext ue ON ce.uid=ue.uid
		GROUP BY ce.cid, ue.fname, ue.lname
) cex ON c.id=cex.cid
LEFT JOIN type_list tl ON c.type_id=tl.id
LEFT JOIN type_list tu ON c.unit=tu.id
WHERE c.name IS NOT NULL ".$active."
ORDER BY c.name ASC");
        $c_chk = mysqli_num_rows($q_chk);
        if (!$c_chk) {
            $templateArray['{qa_checklist_data}'] = "There are no Audits found.";
        } else {
            $i = 2;
            while ($r_chk = mysqli_fetch_assoc($q_chk)) {
                $int = $i/2;
                if (is_int($int)) {
                    $tr_style = 'class = "odd"';
                } else {
                    $tr_style = '';
                }
                if ($r_chk['status']) {
                    $im = 'active.gif';
                } else {
                    $im = 'non-active.gif';
                }
                if ($r_chk['unit']) {
                    $unit_name = $r_chk['unit'];
                } else {
                    $unit_name = "All Units";
                }
                $chk .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=edit-qa-checklist&id='.$r_chk['id'].'">'.$r_chk['name'].'</a></td><td>'.$r_chk['type_name'].'</td><td>'.$unit_name.'</td><td><img src="'.WEBSITE_LOC.'console/_images/'.$im.'" class="img" /></td></tr>';
                $i++;
            } //while
            $templateArray['{qa_checklist_data}'] = '<table class="tablesorter" id="qa-forms"><thead><tr><th>Audit Name</th><th>Type</th><th>Unit</th><th>Status</th></thead><tbody>'.$chk.'</tbody></table>';
        } //count
    }
}

if ($o == "add-qa-checklist") {
    if (!userSystemRights($uid, "add_qa_audit_records")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=qa-checklist"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
        $fext = '&id='.$id;
        $templateArray['{add-qa-checklist}'] = 'block';
        $templateArray['{sect_head_ext}'] = ": Add Audit";
        if (!D4600135D233F_LOCKOUT) {
            if ($_POST['add-qa-checklist']) {
                //error checking
                if (validateInput($_POST['chk-add-name'])) {
                    $chk_name = cleanInput($_POST['chk-add-name']);
                } else {
                    $chk_name = $_POST['chk-add-name'];
                    $err[] = "Audit Name: ".sysMsg(6);
                }
                $type_id = cleanInput($_POST['chk-add-type']);
                $unit = cleanInput($_POST['chk-add-unit']);
                
                if (!$err) {
                    $q_ins = sql("INSERT INTO `qa_checklist` (`name`, `type_id`, `unit`, `status`) VALUES ('".$chk_name."', '".$type_id."', '".$unit."', '0')");
                    $last_id  = mysqli_insert_id($conn);
                    $date = new DateTime('now');
                    $date = $date->format('Y-m-d H:i:s');
                    $q_ins_ext = sql("INSERT INTO `qa_checklist_ext` (`cid`,`uid`, `date_created`, `version`,`status`) VALUES ('".$last_id."', '".$uid."', '".$date."', '1','0')");
                    if ($q_ins && $q_ins_ext) {
                        $templateArray['{message}'] = "Adding new Audit...";
                        $templateForward = "console/index.php?t=qa-audits&o=edit-qa-checklist&id=$last_id";
                    } else {
                        $err[] = sysMsg(8);
                    }
                }
            }
        } else {
            $err[] = sysMsg('57');
            $templateArray['{system-rights}'] = "none";
        }//lockout mode
    } //errs
}

if (($o == "edit-qa-checklist") || ($o == "qa-checklist-history")) {
    $sec_opts = array("Edit Audit" => "edit-qa-checklist","History" => "qa-checklist-history");
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=qa-checklist"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $fext = '&id='.$id;
}

if ($o == "edit-qa-checklist") {
    if (!userSystemRights($uid, "edit_qa_audit_records")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $templateArray['{edit-qa-checklist}'] = 'block';
        $templateArray['{sect_head_ext}'] = ": Edit Audit";
        
        
        if ($_POST['edit-qa-checklist']) {
            $chk_status_act = cleanNumber($_POST['chk-edit-status-act']);
            $chk_status_pub = cleanNumber($_POST['chk-edit-status-pub']);
            $chk_vers = cleanNumber($_POST['chk-edit-vers']);
            $chk_pubs = cleanNumber($_POST['chk-edit-pubs']);
            $vid = cleanNumber($_POST['chk-edit-vid']);
            if (validateInput($_POST['chk-edit-name'])) {
                $chk_name = cleanInput($_POST['chk-edit-name']);
            } else {
                $chk_name = $_POST['chk-edit-name'];
                $err[] = "Audit Name: ".sysMsg(6);
            }
            $type_id = cleanInput($_POST['chk-edit-type']);
            $unit = cleanInput($_POST['chk-edit-unit']);
            $stan = $_POST['std'];
            if ($stan) {
                foreach ($stan as $k=>$v) {
                    $stds[] = $k;
                }
                $stan = implode(';', $stds);
            }
            if (!$err) {
                $date = new DateTime('now');
                $date = $date->format('Y-m-d H:i:s');
                
                //going from unpublished to published
                if (!$chk_pubs && $chk_status_pub) {
                    $old_ver = $chk_vers - 1;
                    if ($old_ver) { //update publish date and retire previous versions if not original version
                        $q_upd_ext = sql("UPDATE `qa_checklist_ext` SET `date_retired` = '".$date."', `status` = '2' WHERE `cid` = '".$id."' AND `version` = '".$old_ver."'");
                    }
                    $q_upd_ext = sql("UPDATE `qa_checklist_ext` SET `date_active` = '".$date."', `status` = '1' WHERE `cid` = '".$id."' AND `version` = '".$chk_vers."'");
                }
                //going from published to unpublished
                if ($chk_pubs && !$chk_status_pub) {
                    $q_get_q = sql("SELECT * FROM `qa_checklist_q` WHERE `ceid` = '".$vid."' ORDER BY `order`");
                    $c_get_q = mysqli_num_rows($q_get_q);
                    if ($c_get_q) {
                        $new_ver = $chk_vers+1;
                        $q_ins_ext = sql("INSERT INTO `qa_checklist_ext` (`cid`,`uid`, `date_created`, `version`, `status`) VALUES ('".$id."', '".$uid."', '".$date."', '".$new_ver."', '0')");
                        $last_id  = mysqli_insert_id($conn);
                        $i = 1;
                        
                        while ($r_get_q = mysqli_fetch_array($q_get_q)) {
                            if ($i == $c_get_q) {
                                $sep = ';';
                            } else {
                                $sep = ',';
                            }
                            $v1 .= "('".$last_id."', '".$r_get_q['question']."', '".$r_get_q['type']."', '".$r_get_q['reqd']."', '".$r_get_q['order']."')".$sep."";
                            $i++;
                        }
                        if ($v1) {
                            $q_builder = sql("INSERT INTO `qa_checklist_q` (`ceid`,`question`, `type`, `reqd`, `order`) VALUES ".$v1."");
                        }
                    }
                }
                //do regardless
                $q_upd = sql("UPDATE `qa_checklist` SET `name` = '".$chk_name."', `type_id` = '".$type_id."', `unit` = '".$unit."', `locations` = '".$stan."', `status` = '".$chk_status_act."' WHERE `id` = '".$id."'");
                if ($q_upd) {
                    $success[] = sysMsg(9);
                } else {
                    $err[] = sysMsg(8);
                }
            }//$err
        } //$_POST
        
        if ($_POST['edit-qa-checklist-list']) {
            $cnt = end($_POST['input_label']);
            if (!$cnt) {
                $cnt = $_POST['input_counter'];
            }
            $key = key($_POST['input_label']);
            reset($_POST['input_label']);
            $vid = cleanNumber($_POST['chk-edit-vid']);
            if (!$vid) {
                $err[] = 'Can not establish current version update can not proceed.';
            } else {
                if ($_POST['remove_id']) {
                    foreach ($_POST['remove_id'] as $k=>$v) {
                        if (!in_array($v, $_POST['qid'])) {
                            $q_del = sql("DELETE FROM `qa_checklist_q` WHERE `id` = '".$v."'");
                        }
                    }
                }
                    
                if ($cnt) {
                    $i = 1;
                    $order = 1;
                    while ($i <= $key) {
                        $qid = $_POST['qid'][$i];
                        $question = cleanInput($_POST['input_label'][$i]);
                        if ($question) {
                            $type = $_POST['input_type'][$i];
                            $reqd = $_POST['reqd'][$i];
                            if ($qid) {
                                $q_upd_q = sql("UPDATE `qa_checklist_q` SET `question` = '".$question."', `type` = '".$type."', `reqd` = '".$reqd."', `order` = '".$order."' WHERE `id` = '".$qid."'");
                            } else {
                                $q_ins_q = sql("INSERT INTO `qa_checklist_q` (`ceid`, `question`, `type`, `reqd`, `order`) VALUES ('".$vid."', '".$question."', '".$type."', '".$reqd."', '".$order."')");
                            }
                        } //$question
                        $i++;
                        $order++;
                    } //while
                    if ($q_upd_q || $q_ins_q) {
                        $success[] = sysMsg(9);
                    } else {
                        $err[] = sysMsg(8);
                    }
                } //$cnt
            } //$err
        }
        
        //Do this anyway
        $q_chk = sql("SELECT * FROM `qa_checklist` WHERE `id` = '".$id."'");
        $c_chk = mysqli_num_rows($q_chk);
        if (!$c_chk) {
            $err[] = sysMsg(4);
            $templateArray['{system-rights}'] = "block";
        } else {
            $r_chk = mysqli_fetch_assoc($q_chk);
            $chk_name = $r_chk['name'];
            $chk_status_act = $r_chk['status'];
            $type_id = $r_chk['type_id'];
            $unit = $r_chk['unit'];
            $locs = $r_chk['locations'];
            $locs = explode(';', $locs);
            
            //get all locations
            $q_locs = sql("SELECT * FROM `type_list` WHERE `group` = 'locations' ORDER BY `name` ASC");
            $i=1;
            $lim = 1;
            while ($r_locs = mysqli_fetch_assoc($q_locs)) {
                if ($i == 1) {
                    $std_beg = '<span class="std-grp">';
                } else {
                    $std_beg = '';
                }
                if ($i > $lim) {
                    $std_end = '</span>';
                    $i=1;
                } else {
                    $i++;
                    $std_end = '';
                }
                if (in_array($r_locs['id'], $locs)) {
                    $sel = 'checked="checked"';
                } else {
                    $sel = '';
                }
                $std .= $std_beg.'<p><label>'.$r_locs['name'].'</label><input type="checkbox" name="std['.$r_locs['id'].']" value="1" class="chk" '.$sel.' /></p>'.$std_end;
            }
            $templateArray['{locations}'] = $std;
			
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
				JOIN qa_checklist q ON q.id=un.refid
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

            //get latest version of checklist
            $q_chk_ext = sql("SELECT * FROM `qa_checklist_ext` WHERE `cid` = '".$id."' ORDER BY `version` DESC LIMIT 0,1");
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
                        $warning[] = 'Audit is currently un-published.';
                    } else {
                        if ($chk_status_act) {
                            $warning[] = 'Audit is currently un-published. A previous version of this audit is still active for recording.';
                        } else {
                            $warning[] = 'Audit  is currently un-published. No previous versions are available for recording.';
                        }
                    }
                }
                if (!$chk_status_act) {
                    $err[] = 'Audit is disabled. No recording can be completed using this audit.';
                }
            }
        } //count

        //do questions if existing
        $q_ques = sql("SELECT * FROM `qa_checklist_q` WHERE `ceid` = '".$chk_vid."' ORDER BY `order` ASC");
        $c_ques = mysqli_num_rows($q_ques);
        if ($c_ques) {
            $i = 1;
            while ($r_ques = mysqli_fetch_assoc($q_ques)) {
                if ($r_ques['type'] == 'yn') {
                    $yn = 'selected="selected"';
                    $yn_style = '';
                } else {
                    $yn = '';
                    $yn_style = 'style="display:none;"';
                }
                if ($r_ques['type'] == 'yna') {
                    $yna = 'selected="selected"';
                    $yna_style = '';
                } else {
                    $yna = '';
                    $yna_style = 'style="display:none;"';
                }
                if ($r_ques['type'] == 'tf') {
                    $tf = 'selected="selected"';
                    $tf_style = '';
                } else {
                    $tf = '';
                    $tf_style = 'style="display:none;"';
                }
                if ($r_ques['type'] == 'txt') {
                    $txt = 'selected="selected"';
                    $txt_style = '';
                } else {
                    $txt = '';
                    $txt_style = 'style="display:none;"';
                }
                if ($r_ques['type'] == 'sec') {
                    $sec = 'selected="selected"';
                    $txt_style = '';
                } else {
                    $sec = '';
                    $sec_style = 'style="display:none;"';
                }
                if ($r_ques['reqd'] == '1') {
                    $reqd_yes = 'selected="selected"';
                    $reqd_no = '';
                } else {
                    $reqd_no = 'selected="selected"';
                    $reqd_yes = '';
                }
                
                $templateArray['{qlist}'] .= '<div id="item_'.$r_ques['id'].'"><input type="hidden" name="remove_id['.$i.']" value="'.$r_ques['id'].'"><div id="row'.$i.'" class="row"><label for="input_name'.$i.'">Question '.$i.':&nbsp;&nbsp;</label>
			<div class="col_label">
			<input type="hidden" name="qid['.$i.']" id="qid'.$i.'" value="'.$r_ques['id'].'"><input type="text" size="20" name="input_label['.$i.']" id="input_label'.$i.'" value="'.$r_ques['question'].'">&nbsp;&nbsp;
			</div>
			<div class="col_input_type">
			<select name="input_type['.$i.']" id="input_type'.$i.'" class="input_type" >
				<option value="0">Please Select</option>
				<option value="yn" '.$yn.'>Yes/No</option>
				<option value="yna" '.$yna.'>Yes/No/NA</option>
				<option value="tf" '.$tf.'>True/False</option>
				<option value="txt" '.$txt.'>Text</option>
				<option value="sec" '.$sec.'>Section Header</option>
			</select>
			</div>
			<div class="col_reqd">
			<select name="reqd['.$i.']" id="reqd'.$i.'" class="input_type" >
				<option value="0" '.$reqd_no.'>No</option>
				<option value="1" '.$reqd_yes.'>Yes</option>
			</select>
			</div>
			<div class="col_remove">';
                if (!$chk_status_pub) {
                    $templateArray['{qlist}'] .= '<a href="#" onClick="removeFormField(\'#row'.$i.'\'); return false;"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" alt="Remove" title="Remove" /></a>';
                }
                $templateArray['{qlist}'] .= '</div>
			<div class="clear"></div></div></div>';
                $i++;
            } //while
            if (!$chk_status_pub) {
                $templateArray['{submit-chk-edit}'] = drawFld("submit", "edit-qa-checklist-list", "Update Audit", "", "submit");
                $templateArray['{submit-add-fields}'] = '<input name="sbt_add" id="sbt_add" type="button" class="submit"  value="Add" onClick="addFormField(); return false;" />';
            } else {
                $templateArray['{submit-chk-edit}'] = '';
                $templateArray['{submit-add-fields}'] = '';
            }
            $templateArray['{initial_count}'] = $i;
        } else {
            $templateArray['{submit-chk-edit}'] = drawFld("submit", "edit-qa-checklist-list", "Update Audit", "", "submit");
            $templateArray['{submit-add-fields}'] = '<input name="sbt_add" id="sbt_add" type="button" class="submit"  value="Add" onClick="addFormField(); return false;" />';
        } //c_ques
    }//err
} //edit checklist



if ($o == "qa-checklist-history") {
    if (!userSystemRights($uid, "edit_qa_audit_records")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $templateArray['{qa-checklist-history}'] = 'block';
        $templateArray['{sect_head_ext}'] = ": History";
        
        if ($hid) { //do individual history record
            $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=qa-checklist-history&id='.$id.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';


            $q_data = sql("SELECT cer.id,cer.date,cer.text, ce.version, ue.fname, ue.lname, c.name FROM qa_responses cer LEFT JOIN qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid  WHERE cer.id = '".$hid."' AND c.status = '1'");
            $c_data = mysqli_num_rows($q_data);
            if (!$c_data) {
                $err[] = sysMsg(4);
            } else {
                $r_data = mysqli_fetch_assoc($q_data);
                $user = $r_data['fname'].' '.$r_data['lname'];
                $text = $r_data['text'];
                $date = $r_data['date'];
                $checklist_name = $r_data['name'];
                $rid = $r_data['id'];
                //get responses
                $q_dataq = sql("SELECT cere.response, cerq.question, cerq.type, cerq.reqd FROM qa_responses cer LEFT JOIN qa_responses_ext cere ON cer.id=cere.gid LEFT JOIN qa_checklist_q cerq ON cere.cqid=cerq.id WHERE cer.id = '".$rid."' ORDER BY cerq.order ASC");
                $c_dataq = mysqli_num_rows($q_dataq);
                $i=1;
                $z = 2;
                $ques_num = $c_dataq;
                $add = 0;
                while ($r_dataq = mysqli_fetch_assoc($q_dataq)) {
                    if ($r_dataq['response'] == 'y') {
                        $sel_y = 'checked="checked"';
                        $add++;
                    } else {
                        $sel_y = '';
                    }
                    if ($r_dataq['response'] == 'n') {
                        $sel_n = 'checked="checked"';
                    } else {
                        $sel_n = '';
                    }
                    if ($r_dataq['response'] == 'na') {
                        $sel_na = 'checked="checked"';
                        $ques_num--;
                    } else {
                        $sel_na = '';
                    }
                    if ($r_dataq['response'] == 't') {
                        $sel_t = 'checked="checked"';
                        $add++;
                    } else {
                        $sel_t = '';
                    }
                    if ($r_dataq['response'] == 'f') {
                        $sel_f = 'checked="checked"';
                    } else {
                        $sel_f = '';
                    }
                    if ($r_dataq['response'] && ($r_dataq['response'] !== 'y') && ($r_dataq['response'] !== 'n') && ($r_dataq['response'] !== 'na') && ($r_dataq['response'] !== 't') && ($r_dataq['response'] !== 'f')) {
                        $ques_num--;
                    }
                
                    if ($r_dataq['reqd'] == '1') {
                        $reqd = '<span class="reqd">*</span>';
                    } else {
                        $reqd = '';
                    }
                    $int = $z/2;
                    if (is_int($int)) {
                        $style = 'audit-row-alt';
                    } else {
                        $style = 'audit-row';
                    }
                
                    if ($r_dataq['type'] == 'yn') {
                        $qlist .= '<div class="'.$style.'">
					<span class="question">'.$r_dataq['question'].$reqd.'</span>
					<span class="answer">
						<span class="radio"><input type="radio" class="chk" '.$sel_y.' /> Yes</span>
						<span class="radio"><input type="radio" class="chk" '.$sel_n.' /> No</span>
					</span>
					</div>';
                    }
                    
                    if ($r_dataq['type'] == 'yna') {
                        $qlist .= '<div class="'.$style.'">
					<span class="question">'.$r_dataq['question'].$reqd.'</span>
					<span class="answer">
						<span class="radio"><input type="radio" class="chk" '.$sel_y.' /> Yes</span>
						<span class="radio"><input type="radio" class="chk" '.$sel_n.' /> No</span>
						<span class="radio"><input type="radio" class="chk" '.$sel_na.' /> NA</span>
					</span>
					</div>';
                    }
                    
                    if ($r_dataq['type'] == 'tf') {
                        $qlist .= '<div class="'.$style.'">
					<span class="question">'.$r_dataq['question'].$reqd.'</span>
					<span class="answer">
						<span class="radio"><input type="radio" class="chk" '.$sel_t.' /> True</span>
						<span class="radio"><input type="radio"class="chk" '.$sel_f.' /> False</span>
					</span>
					</div>';
                    }
                    
                    if ($r_dataq['type'] == 'txt') {
                        $qlist .= '<div class="'.$style.'">
					<span class="question">'.$r_dataq['question'].$reqd.'</span>
					<span class="answer">
						<input type="text" value="'.$r_dataq['response'].'" disabled="disabled" />
					</span>
					</div>';
                    }
                    
                    $i++;
                    $z++;
                }
                $compliance = $add / $ques_num * 100;
                $compliance = number_format($compliance, 2, '.', '');
                $templateArray['{qa_history}'] = '<p style="font-weight:bold;">Report Details:</p><p><label>Reported by:</label>'.$user.'</p><p><label>Reported Date:</label>'.$date.'</p><p><label>Compliance:</label>'.$compliance.'%</p><p style="margin-bottom: 20px;"></p><p style="margin-top: 20px; font-weight:bold;">Results:</p>'.$qlist.'<div class="clear"></div><p style="margin-top: 20px; font-weight:bold;">Comments:</p>'.$text;
            }
        } else { //do hisotyry list
        
            $q_data= sql("SELECT cer.id,cer.date,ce.version, ue.fname, ue.lname, c.name FROM qa_responses cer LEFT JOIN qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid WHERE c.id = '".$id."' AND c.status = '1' ORDER BY cer.date DESC");
            $c_data = mysqli_num_rows($q_data);
        
            $num_limit = DISP_ROWS;
            if ($c_data > $num_limit) { //apply limits to query
                if (!$_GET['pg']) {
                    $limit = " LIMIT 0, ".$num_limit."";
                } else {
                    $multi = cleanNumber($_GET['pg']);
                    $row = ($multi * $num_limit) - $num_limit;
                    $limit = " LIMIT ".$row.", ".$num_limit."";
                }
            
                $q_data= sql("SELECT cer.id,cer.date,ce.version, ue.fname, ue.lname, c.name FROM qa_responses cer LEFT JOIN qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid WHERE c.id = '".$id."' AND c.status = '1' ORDER BY cer.date DESC ".$limit."");
                $c_data = mysqli_num_rows($q_data);
        
                $max_pages = ceil($c_data / $num_limit); //edit c_list for row count
                $page_limit = PAGE_LIMIT;
                $curr_pg = cleanNumber($_GET['pg']);
                if (!$curr_pg) {
                    $curr_pg = 1;
                }
                if ($curr_pg == 1) {
                    $prev_pg = $curr_pg;
                } else {
                    $prev_pg = $curr_pg - 1;
                }
            
                if ($max_pages > $page_limit) {
                    $int = ceil($curr_pg/$page_limit);
                    $end_pg = $int*$page_limit;
                    $start_pg = $end_pg - ($page_limit - 1);
                } else {
                    $int = ceil($curr_pg/$max_pages);
                    $end_pg = $int*$max_pages;
                    $start_pg = $end_pg - ($max_pages - 1);
                }
            
                if ($end_pg >= $max_pages) {
                    $end_pg = $max_pages;
                }
                if ($start_pg <=1) {
                    $start_pg = 1;
                }
                if ($curr_pg == $max_pages) {
                    $next_pg = $curr_pg;
                } else {
                    $next_pg = $curr_pg + 1;
                }
            
                //$i = 1;
                while ($start_pg <= $end_pg) {
                    if ($start_pg == $curr_pg) {
                        $class = 'pagination_current';
                    } else {
                        $class = 'pagination';
                    }
                    $pgs .= '<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o='.$o.'&id='.$id.'&pg='.$start_pg.'" class="'.$class.'">'.$start_pg.'</a>';
                    $start_pg++;
                }
            }
            $pagination = '<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o='.$o.'&id='.$id.'&pg='.$prev_pg.'" class="pagination">Prev</a>'.$pgs.'<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o='.$o.'&id='.$id.'&pg='.$next_pg.'" class="pagination">Next</a>';
        
        
            if (!$c_data) {
                $templateArray['{qa_history}'] = '<p>There is no reported data for this Audit.</p>';
            } else {
                $i = 2;
                while ($r_data = mysqli_fetch_assoc($q_data)) {
                    $checklist_name = $r_data['name'];
                    $int = $i/2;
                    if (is_int($int)) {
                        $tr_style = 'class = "odd"';
                    } else {
                        $tr_style = '';
                    }
                    $chk .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o='.$o.'&id='.$id.'&hid='.$r_data['id'].'">'.$r_data['date'].'</a></td><td>'.$r_data['fname'].' '.$r_data['lname'].'</td><td>'.$r_data['version'].'</td></tr>';
                    $i++;
                } //while
                $templateArray['{qa_history}'] = '<table class="tablesorter" id="qa-forms-details"><thead><tr><th>Date Reported</th><th>Reported By</th><th>Version</th></thead><tbody>'.$chk.'</tbody></table>';
            } //$c_data
        } //hid
    }
}


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
    $templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o='.$v.'&id='.$id.'" class="'.$c.'">'.$k.'</a>';
    $templateArray['{'.$v.'}'] = $disp;
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

if (!$templateArray['{add-qa-checklist}']) {
    $templateArray['{add-qa-checklist}'] = 'none';
}
if (!$templateArray['{edit-qa-checklist}']) {
    $templateArray['{edit-qa-checklist}'] = 'none';
}
if (!$templateArray['{qa_checklist_data}']) {
    $templateArray['{qa_checklist_data}'] = '';
}
if (!$templateArray['{qa-checklist-history}']) {
    $templateArray['{qa-checklist-history}'] = 'none';
}
if (!$templateArray['{qa-records}']) {
    $templateArray['{qa-records}'] = 'none';
}
if (!$templateArray['{qa-checklist}']) {
    $templateArray['{qa-checklist}'] = 'none';
}

list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=qa-audits&o='.$o.$fext);

//add checklist
$templateArray['{fhead-chk-add}'] = $fhead; $templateArray['{fend-chk-add}'] = $fend;
$templateArray['{chk-add-name}'] = drawFld("text", "chk-add-name", $chk_name, "Audit Name");
$templateArray['{submit-chk-add}'] = drawFld("submit", "add-qa-checklist", "Add new Audit", "&nbsp;", "submit");

//edit checklist
$templateArray['{fhead-chk-edit}'] = $fhead; $templateArray['{fend-chk-edit}'] = $fend;
$templateArray['{chk-edit-name}'] = drawFld("text", "chk-edit-name", $chk_name, "Audit Name");
$templateArray['{chk-edit-version}'] = drawFld("text", "chk-edit-version", $chk_ver, "Version", "", "", 1);
$templateArray['{chk-edit-vers}'] = drawFld("hidden", "chk-edit-vers", $chk_ver);
$status_pub_arr = array("0" => "Un-Published","1" => "Published"); if (!$chk_status_pub) {
    $chk_status_pub = "0";
}
$templateArray['{chk-edit-status-pub}'] = drawSelect("chk-edit-status-pub", $status_pub_arr, $chk_status_pub, "Publish Status");
$templateArray['{chk-edit-pubs}'] = drawFld("hidden", "chk-edit-pubs", $chk_status_pub);
$status_act_arr = array("0" => "Disabled","1" => "Active"); if (!$chk_status_act) {
    $chk_status_act = "0";
}
//get all QA types
$q_type = sql("SELECT * FROM `type_list` WHERE `group` = 'qa_type' ORDER BY `name` ASC");
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

$templateArray['{chk-edit-status-act}'] = drawSelect("chk-edit-status-act", $status_act_arr, $chk_status_act, "Status");

$templateArray['{submit-chk-edit-settings}'] = drawFld("submit", "edit-qa-checklist", "Update Audit Settings", "&nbsp;", "submit");
if (!$templateArray['{qlist}']) {
    $templateArray['{qlist}'] = '';
} if (!$templateArray['{curr_ver_id}']) {
    $templateArray['{curr_ver_id}'] = drawFld("hidden", "chk-edit-vid", $chk_vid);
}
if (!$templateArray['{initial_count}']) {
    $templateArray['{initial_count}'] = '1';
} if (!$templateArray['{qa_report_data}']) {
    $templateArray['{qa_report_data}'] = '';
}

$templateArray['{checkedurl}'] = WEBSITE_LOC.'console/index.php?t=qa-audits&o=qa-checklist&upactive=yes';
$templateArray['{checkedurlfalse}'] = WEBSITE_LOC.'console/index.php?t=qa-audits&&o=qa-checklist&upactive=no';

if (!$templateArray['{url}']) {
    $templateArray['{url}'] = WEBSITE_LOC.'console/index.php?t=user-manager&o=groups';
}

//user notifications
$q_user_list = sql("SELECT u.id, ue.fname, ue.lname FROM user u
JOIN user_ext ue ON ue.uid=u.id 
WHERE u.active != '0' AND id != 1 ORDER BY ue.fname ASC"); $user_arr[0] = 'Please select...';
while ($r_user_list = mysqli_fetch_assoc($q_user_list)) {
    $user_arr[''.$r_user_list['id'].''] = ''.$r_user_list['fname'].' '.$r_user_list['lname'].'';
}
$templateArray['{individual-list}'] = drawSelect("individual_list", $user_arr, "", "", "", "", "", "individual_list");
$templateArray['{addurl}'] = WEBSITE_LOC.'console/index.php?t='.$t.'&o='.$o.'&id='.$id;
