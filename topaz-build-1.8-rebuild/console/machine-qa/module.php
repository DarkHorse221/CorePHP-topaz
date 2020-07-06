<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
//set options
$uid = userID($sid);
$del_id = cleanNumber($_GET['del']); $confirm = cleanNumber($_GET['confirm']);
$stat = cleanNumber($_GET['status']); $id = cleanNumber($_GET['id']); $hid = cleanNumber($_GET['hid']);

$sec_opts = array("QA Records" => "qa-records","QA Checklist" => "qa-checklist","Machine List" => "machine-list");
$o = cleanInput($_GET['o']); if (!$o) {
    $o = 'qa-records';
} //set default

if ($o == "qa-records") {
    if (!userSystemRights($uid, "view_machine_qa_records")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $q_list = sql("SELECT cer.id,cer.date,cer.pass, ce.version, ue.fname, ue.lname, m.name AS machine, c.name,c.id AS cid FROM machine_qa_responses cer LEFT JOIN machine_qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN machine_qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid LEFT JOIN machines m ON m.id=c.mid WHERE c.status = '1' ORDER BY cer.date DESC");
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
            $q_list = sql("SELECT cer.id,cer.date,cer.pass, ce.version, ue.fname, ue.lname, m.name AS machine, c.name,c.id AS cid FROM machine_qa_responses cer LEFT JOIN machine_qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN machine_qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid LEFT JOIN machines m ON m.id=c.mid WHERE c.status = '1' ORDER BY cer.date DESC ".$limit."");
    
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
                $pgs .= '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=qa-records&pg='.$start_pg.'" class="'.$class.'">'.$start_pg.'</a>';
                $start_pg++;
            }
        }
        $pagination = '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=qa-records&pg='.$prev_pg.'" class="pagination">Prev</a>'.$pgs.'<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=qa-records&pg='.$next_pg.'" class="pagination">Next</a>';

        if (!$c_list) {
            $list = '<tr><td colspan="6">No QA has been recorded for any checklist</td></tr>';
        } else {
            $i = 2;
            while ($r_list = mysqli_fetch_assoc($q_list)) {
                $int = $i/2;
                if (is_int($int)) {
                    $tr_style = 'class = "odd"';
                } else {
                    $tr_style = '';
                }
                if ($r_list['pass'] == 100) {
                    $pass = '<img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/pass.gif" />';
                } else {
                    $pass = '<img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/fail.gif" />';
                }
                $list .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=qa-checklist-history&id='.$r_list['cid'].'&hid='.$r_list['id'].'">'.$r_list['name'].'</a></td><td>'.$r_list['machine'].'</td><td>'.$r_list['version'].'</td><td>'.$r_list['date'].'</td><td>'.$r_list['fname'].' '.$r_list['lname'].'</td><td>'.$pass.'</td></tr>';
                $i++;
            }
            $templateArray['{qa_report_data}'] = '<table class="tablesorter" id="qa-records"><thead><tr><th>Checklist Name</th><th>Machine</th><th>Version</th><th>Date Reported</th><th>Reported By</th><th>Status</th></thead><tbody>'.$list.'</tbody></table>';
        } //$c_list
    } //!$err
}

if ($o == "qa-checklist") {
    if (!userSystemRights($uid, "view_machine_qa")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=add-qa-checklist"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
        
        //update preferences if available
        if (cleanString($_GET['upactive']) == 'yes') {
            updUserPreference($uid, 'view-active-machineqa', 1);
        }
        if (cleanString($_GET['upactive']) == 'no') {
            updUserPreference($uid, 'view-active-machineqa', 0);
        }
        //get user preferences
        $usr_p = userPreference($uid, 'view-active-machineqa');
        if (!$usr_p) {
            $active = " AND c.status != 0";
            $templateArray['{checked}'] = '';
        } else {
            $active = "";
            $templateArray['{checked}'] = 'checked';
        }
                
        
        $q_chk = sql("SELECT c.id, c.name, c.status, m.name AS machine, cex.date_created, cex.version, cex.status AS published, cex.fname, cex.lname
FROM machines m
LEFT JOIN machine_qa_checklist c ON m.id=c.mid
LEFT JOIN (
	SELECT ce.cid, MAX(ce.date_created) as date_created, MAX(ce.version) as version, MAX(ce.status) as status, ue.fname, ue.lname
		FROM machine_qa_checklist_ext ce
		INNER JOIN user_ext ue ON ce.uid=ue.uid
		GROUP BY ce.cid, ue.fname, ue.lname
) cex ON c.id=cex.cid
WHERE c.name IS NOT NULL ".$active."
ORDER BY c.name ASC");
        $c_chk = mysqli_num_rows($q_chk);
        if (!$c_chk) {
            $templateArray['{qa_checklist_data}'] = "There are no QA checklists found.";
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
                $chk .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=edit-qa-checklist&id='.$r_chk['id'].'">'.$r_chk['name'].'</a></td><td>'.$r_chk['machine'].'</td><td><img src="'.WEBSITE_LOC.'console/_images/'.$im.'" class="img" /></td></tr>';
                $i++;
            } //while
            $templateArray['{qa_checklist_data}'] = '<table class="tablesorter" id="qa-forms"><thead><tr><th>Checklist Name</th><th>Machine</th><th>Status</th></thead><tbody>'.$chk.'</tbody></table>';
        } //count
    }
}

if ($o == "add-qa-checklist") {
    if (!userSystemRights($uid, "add_machine_qa")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=qa-checklist"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
        $fext = '&id='.$id;
        $templateArray['{add-qa-checklist}'] = 'block';
        $templateArray['{sect_head_ext}'] = ": Add QA Checklist";
        
        if (!D4600135D233F_LOCKOUT) {
            if ($_POST['add-qa-checklist']) {
                //error checking
                if (validateInput($_POST['chk-add-name'])) {
                    $chk_name = cleanInput($_POST['chk-add-name']);
                } else {
                    $chk_name = $_POST['chk-add-name'];
                    $err[] = "Checklist Name: ".sysMsg(6);
                }
                if ($_POST['chk-add-mid']) {
                    $chk_mid = cleanNumber($_POST['chk-add-mid']);
                } else {
                    $chk_mid = $_POST['chk-add-mid'];
                    $err[] = "Machine: You must select a machine";
                }
                
                if (!$err) {
                    $q_ins = sql("INSERT INTO `machine_qa_checklist` (`name`, `mid`, `status`) VALUES ('".$chk_name."', '".$chk_mid."', '0')");
                    $last_id  = mysqli_insert_id($conn);
                    $date = new DateTime('now');
                    $date = $date->format('Y-m-d H:i:s');
                    $q_ins_ext = sql("INSERT INTO `machine_qa_checklist_ext` (`cid`,`uid`, `date_created`, `version`,`status`) VALUES ('".$last_id."', '".$uid."', '".$date."', '1','0')");
                    if ($q_ins && $q_ins_ext) {
                        $templateArray['{message}'] = "Adding new QA Checklist...";
                        $templateForward = "console/index.php?t=machine-qa&o=edit-qa-checklist&id=$last_id";
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
    $sec_opts = array("Edit QA Checklist" => "edit-qa-checklist","History" => "qa-checklist-history");
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=qa-checklist"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $fext = '&id='.$id;
}

if ($o == "edit-qa-checklist") {
    if (!userSystemRights($uid, "edit_machine_qa")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $templateArray['{edit-qa-checklist}'] = 'block';
        $templateArray['{sect_head_ext}'] = ": Edit QA Checklist";
        
        
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
                $err[] = "Checklist Name: ".sysMsg(6);
            }
            if (!$err) {
                $date = new DateTime('now');
                $date = $date->format('Y-m-d H:i:s');
                
                //going from unpublished to published
                if (!$chk_pubs && $chk_status_pub) {
                    $old_ver = $chk_vers - 1;
                    if ($old_ver) { //update publish date and retire previous versions if not original version
                        $q_upd_ext = sql("UPDATE `machine_qa_checklist_ext` SET `date_retired` = '".$date."', `status` = '2' WHERE `cid` = '".$id."' AND `version` = '".$old_ver."'");
                    }
                    $q_upd_ext = sql("UPDATE `machine_qa_checklist_ext` SET `date_active` = '".$date."', `status` = '1' WHERE `cid` = '".$id."' AND `version` = '".$chk_vers."'");
                }
                //going from published to unpublished
                if ($chk_pubs && !$chk_status_pub) {
                    $q_get_q = sql("SELECT * FROM `machine_qa_checklist_q` WHERE `ceid` = '".$vid."' ORDER BY `order`");
                    $c_get_q = mysqli_num_rows($q_get_q);
                    if ($c_get_q) {
                        $new_ver = $chk_vers+1;
                        $q_ins_ext = sql("INSERT INTO `machine_qa_checklist_ext` (`cid`,`uid`, `date_created`, `version`, `status`) VALUES ('".$id."', '".$uid."', '".$date."', '".$new_ver."', '0')");
                        $last_id  = mysqli_insert_id($conn);
                        $i = 1;
                        while ($r_get_q = mysqli_fetch_array($q_get_q)) {
                            if ($i == $c_get_q) {
                                $sep = ';';
                            } else {
                                $sep = ',';
                            }
                            $v .= "('".$last_id."', '".$r_get_q['question']."', '".$r_get_q['type']."', '".$r_get_q['reqd']."', '".$r_get_q['range_lwr']."', '".$r_get_q['range_upp']."', '".$r_get_q['order']."')".$sep."";
                            $i++;
                        }
                        if ($v) {
                            $q_builder = sql("INSERT INTO `machine_qa_checklist_q` (`ceid`,`question`, `type`, `reqd`, `range_lwr`, `range_upp`, `order`) VALUES ".$v."");
                        }
                    }
                }
                //do regardless
                $q_upd = sql("UPDATE `machine_qa_checklist` SET `name` = '".$chk_name."', `status` = '".$chk_status_act."' WHERE `id` = '".$id."'");
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
                            $q_del = sql("DELETE FROM `machine_qa_checklist_q` WHERE `id` = '".$v."'");
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
                            $range_lwr = $_POST['extra_values'][$i][0];
                            $range_upp = $_POST['extra_values'][$i][1];
                            if ($qid) {
                                $q_upd_q = sql("UPDATE `machine_qa_checklist_q` SET `question` = '".$question."', `type` = '".$type."', `reqd` = '".$reqd."', `range_lwr` = '".$range_lwr."', `range_upp` = '".$range_upp."', `order` = '".$order."' WHERE `id` = '".$qid."'");
                            } else {
                                $q_ins_q = sql("INSERT INTO `machine_qa_checklist_q` (`ceid`, `question`, `type`, `reqd`, `range_lwr`, `range_upp`, `order`) VALUES ('".$vid."', '".$question."', '".$type."', '".$reqd."', '".$range_lwr."', '".$range_upp."', '".$order."')");
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
        $q_chk = sql("SELECT mqa.id, mqa.name, mqa.mid, m.tid, mqa.status FROM machine_qa_checklist mqa JOIN machines m ON mqa.id=m.id WHERE mqa.id = '".$id."'");
        $c_chk = mysqli_num_rows($q_chk);
        if (!$c_chk) {
            $err[] = sysMsg(4);
            $templateArray['{system-rights}'] = "block";
        } else {
            $r_chk = mysqli_fetch_assoc($q_chk);
            $chk_name = $r_chk['name'];
			$chk_mid = $r_chk['mid'];
			$type_id = $r_chk['tid'];
            $chk_status_act = $r_chk['status'];
            //get latest version of checklist
            $q_chk_ext = sql("SELECT * FROM `machine_qa_checklist_ext` WHERE `cid` = '".$id."' ORDER BY `version` DESC LIMIT 0,1");
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
                        $warning[] = 'QA Checklist is currently un-published.';
                    } else {
                        if ($chk_status_act) {
                            $warning[] = 'QA Checklist is currently un-published. A previous version of this checklist is still active for QA recording.';
                        } else {
                            $warning[] = 'QA Checklist is currently un-published. No previous versions are available for QA recording.';
                        }
                    }
				}
				
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
					WHERE ure.tid IN ('".$type_id."','45')");
					//add type 45 as mail group legacy code
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
					JOIN machine_qa_checklist q ON q.id=un.refid 
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


                if (!$chk_status_act) {
                    $err[] = 'Checklist is disabled. No QA recording can be completed using this checklist.';
                }
            }
        } //count

        //do questions if existing
        $q_ques = sql("SELECT * FROM `machine_qa_checklist_q` WHERE `ceid` = '".$chk_vid."' ORDER BY `order` ASC");
        $c_ques = mysqli_num_rows($q_ques);
        if ($c_ques) {
            $i = 1;
            while ($r_ques = mysqli_fetch_assoc($q_ques)) {
                if ($r_ques['type'] == 'chkbox') {
                    $chk = 'selected="selected"';
                    $chk_style = '';
                } else {
                    $chk = '';
                    $chk_style = 'style="display:none;"';
                }
                if ($r_ques['type'] == 'num') {
                    $num = 'selected="selected"';
                    $num_style = 'style="display:block;"';
                } else {
                    $num = '';
                    $num_style = 'style="display:none;"';
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
			<input type="hidden" name="qid['.$i.']" id="qid'.$i.'" value="'.$r_ques['id'].'"><input type="text" size="20" name="input_label['.$i.']" id="input_label'.$i.'" value="'.$r_ques['question'].'">&nbsp;&nbsp
			</div>
			<div class="col_input_type">
			<select name="input_type['.$i.']" id="input_type'.$i.'" class="input_type" >
				<option value="0">Please Select</option>
				<option value="chkbox" '.$chk.'>Check Box</option>
				<option value="num" '.$num.'>Numeric Field</option>
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
                $templateArray['{qlist}'] .= '</div><div class="clear"></div>';
            
                $templateArray['{qlist}'] .= '<div class="col_extra_values" id="col_extra_values'.$i.'" '.$num_style.'>
			<span class="text_black_bold">Range Lower</span> 
			<input type="text" size="10" name="extra_values['.$i.'][0]" value="'.$r_ques['range_lwr'].'" class="sm"> 
			&nbsp;&nbsp;<span class="text_black_bold">Range Upper</span>
			<input type="text" size="10" name="extra_values['.$i.'][1]" value="'.$r_ques['range_upp'].'" class="sm">
			</div>
			<div class="clear"></div>	
			</div></div>';
                $i++;
            } //while
            if (!$chk_status_pub) {
                $templateArray['{submit-chk-edit}'] = drawFld("submit", "edit-qa-checklist-list", "Update Checklist", "", "submit");
                $templateArray['{submit-add-fields}'] = '<input name="sbt_add" id="sbt_add" type="button" class="submit"  value="Add" onClick="addFormField(); return false;" />';
            } else {
                $templateArray['{submit-chk-edit}'] = '';
                $templateArray['{submit-add-fields}'] = '';
            }
            $templateArray['{initial_count}'] = $i;
        } else {
            $templateArray['{submit-chk-edit}'] = drawFld("submit", "edit-qa-checklist-list", "Update Checklist", "", "submit");
            $templateArray['{submit-add-fields}'] = '<input name="sbt_add" id="sbt_add" type="button" class="submit"  value="Add" onClick="addFormField(); return false;" />';
        } //c_ques
    }//err
} //edit checklist



if ($o == "qa-checklist-history") {
    if (!userSystemRights($uid, "edit_machine_qa")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $templateArray['{qa-checklist-history}'] = 'block';
        $templateArray['{sect_head_ext}'] = ": History";
        
        if ($hid) { //do individual history record
            $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=qa-checklist-history&id='.$id.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
            $q_data = sql("SELECT cer.id,cer.date,cer.pass,cer.text, ce.version, ue.fname, ue.lname, m.name AS machine, c.name FROM machine_qa_responses cer LEFT JOIN machine_qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN machine_qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid LEFT JOIN machines m ON m.id=c.mid WHERE cer.id = '".$hid."'");
            $c_data = mysqli_num_rows($q_data);
            if (!$c_data) {
                $err[] = sysMsg(4);
            } else {
                $r_data = mysqli_fetch_assoc($q_data);
                $user = $r_data['fname'].' '.$r_data['lname'];
                $text = $r_data['text'];
                $date = $r_data['date'];
                $pass = $r_data['pass'];
                $mach_name = $r_data['machine'];
                $checklist_name = $r_data['name'];
                $rid = $r_data['id'];
                //get responses
                $q_dataq = sql("SELECT cere.response, cerq.question, cerq.type, cerq.reqd, cerq.range_lwr, cerq.range_upp FROM machine_qa_responses cer LEFT JOIN machine_qa_responses_ext cere ON cer.id=cere.gid LEFT JOIN machine_qa_checklist_q cerq ON cere.cqid=cerq.id WHERE cer.id = '".$rid."' ORDER BY cerq.order ASC");
                $c_dataq = mysqli_num_rows($q_dataq);
                $i=1;
                $cols = 3;
                $lim = ceil($c_dataq / $cols);
                while ($r_dataq = mysqli_fetch_assoc($q_dataq)) {
                    if ($i > $lim) {
                        $i = 1;
                        $qlist .= '</span>';
                    }
                    if ($i == 1) {
                        $qlist .= '<span class="cols_mach_qa">';
                    }
                    if ($r_dataq['reqd'] == '1') {
                        $reqd = '<span class="reqd">*</span>';
                    } else {
                        $reqd = '';
                    }
                    if ($r_dataq['response'] == '1') {
                        $sel = ' checked=checked';
                    } else {
                        $sel = '';
                    }
                    
                    if ($r_dataq['type'] == 'chkbox') {
                        $qlist .= '<p>
					<label>'.$r_dataq['question'].$reqd.'</label><input type="checkbox" name="q['.$r_dataq['id'].']" class="chk" '.$sel.' disabled=disabled/></p>';
                    }
                    if ($r_dataq['type'] == 'num') {
                        if ($r_dataq['range_lwr'] && $r_dataq['range_upp']) {
                            $ques = $r_dataq['question'].' ('.$r_dataq['range_lwr'].','.$r_dataq['range_upp'].')';
                            if (($r_dataq['range_lwr'] <= $r_dataq['response']) && ($r_dataq['response'] <= $r_dataq['range_upp'])) {
                                $all_good = '';
                            } else {
                                $all_good = 'error';
                            }
                        } else {
                            $ques = $r_dataq['question'];
                            $all_good = '';
                        }
                        $num_val = $r_dataq['response'];
                        $qlist .= '<p>'.drawFld("text", "q[".$r_dataq['id']."]", $num_val, $ques.$reqd, "num ".$all_good, "", 1).'</p>';
                    }
                    $i++;
                }
                
                $templateArray['{qa_history}'] = '<p style="font-weight:bold;">Report Details:</p><p><label>Reported by:</label>'.$user.'</p><p><label>Reported Date:</label>'.$date.'</p><p><label>Pass:</label>'.$pass.'% of required fields</p><p style="margin-bottom: 30px;"></p><p style="font-weight:bold;">Results:</p>'.$qlist.'</span><div class="clear"></div><p style="margin-top: 20px; font-weight:bold;">Comments:</p>'.$text;
            }
        } else { //do history list
            
            $q_data= sql("SELECT cer.id,cer.date,cer.pass, ce.version, ue.fname, ue.lname, m.name AS machine, c.name FROM machine_qa_responses cer LEFT JOIN machine_qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN machine_qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid LEFT JOIN machines m ON m.id=c.mid WHERE c.id = '".$id."' ORDER BY cer.date DESC");
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
            
                $q_data= sql("SELECT cer.id,cer.date,cer.pass, ce.version, ue.fname, ue.lname, m.name AS machine, c.name FROM machine_qa_responses cer LEFT JOIN machine_qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN machine_qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid LEFT JOIN machines m ON m.id=c.mid WHERE c.id = '".$id."' ORDER BY cer.date DESC ".$limit."");
            
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
                    $pgs .= '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o='.$o.'&id='.$id.'&pg='.$start_pg.'" class="'.$class.'">'.$start_pg.'</a>';
                    $start_pg++;
                }
            }
            $pagination = '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o='.$o.'&id='.$id.'&pg='.$prev_pg.'" class="pagination">Prev</a>'.$pgs.'<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o='.$o.'&id='.$id.'&pg='.$next_pg.'" class="pagination">Next</a>';
                
            //pagination
            
            if (!$c_data) {
                $templateArray['{qa_history}'] = '<p>There is no reported QA for this checklist.</p>';
            } else {
                $i = 2;
                while ($r_data = mysqli_fetch_assoc($q_data)) {
                    $mach_name = $r_data['machine'];
                    $checklist_name = $r_data['name'];
                    $int = $i/2;
                    if (is_int($int)) {
                        $tr_style = 'class = "odd"';
                    } else {
                        $tr_style = '';
                    }
                    if ($r_data['pass'] == 100) {
                        $pass = '<img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/pass.gif" />';
                    } else {
                        $pass = '<img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/fail.gif" />';
                    }
                    $chk .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o='.$o.'&id='.$id.'&hid='.$r_data['id'].'">'.$r_data['date'].'</a></td><td>'.$r_data['fname'].' '.$r_data['lname'].'</td><td>'.$r_data['version'].'</td><td>'.$pass.'</td></tr>';
                    $i++;
                } //while
                $templateArray['{qa_history}'] = '<table class="tablesorter" id="qa-forms-details"><thead><tr><th>Date Reported</th><th>Reported By</th><th>QA Version</th><th>Pass Indicator</th></thead><tbody>'.$chk.'</tbody></table>';
            }
        } //hid
    }
}

if ($o == "machine-list") {
    if (!userSystemRights($uid, "view_machines")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=add-machines"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
        
        //update preferences if available
        if (cleanString($_GET['upactive']) == 'yes') {
            updUserPreference($uid, 'view-active-machinelist', 1);
        }
        if (cleanString($_GET['upactive']) == 'no') {
            updUserPreference($uid, 'view-active-machinelist', 0);
        }
        //get user preferences
        $usr_p = userPreference($uid, 'view-active-machinelist');
        if (!$usr_p) {
            $active = " AND m.active != 0";
            $templateArray['{checked}'] = '';
        } else {
            $active = "";
            $templateArray['{checked}'] = 'checked';
        }
        $q_mach = sql("SELECT m.id, m.name, m.manufacturer, m.serial_no, m.active, tl.name AS type FROM machines m, type_list tl WHERE m.tid=tl.id ".$active." ORDER BY m.name ASC");
        $c_mach = mysqli_num_rows($q_mach);
        if (!$c_mach) {
            $templateArray['{mach}'] = "<p>There are no machines found.</p>";
        } else {
            $i = 2;
            while ($r_mach = mysqli_fetch_assoc($q_mach)) {
                $int = $i/2;
                if (is_int($int)) {
                    $tr_style = 'class = "odd"';
                } else {
                    $tr_style = '';
                }
                if ($r_mach['active']) {
                    $im = 'active.gif';
                } else {
                    $im = 'non-active.gif';
                }
                $mach .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=edit-machines&id='.$r_mach['id'].'">'.$r_mach['name'].'</a></td><td>'.$r_mach['manufacturer'].'</td><td>'.$r_mach['serial_no'].'</td><td>'.$r_mach['type'].'</td><td><img src="'.WEBSITE_LOC.'console/_images/'.$im.'" class="img" /></td></tr>';
                $i++;
            } //while
            $templateArray['{mach}'] = '<table class="tablesorter" id="machines"><thead><tr><th>Machine Name</th><th>Manufacturer</th><th>Serial No</th><th>Machine Type</th><th>Status</th></thead><tbody>'.$mach.'</tbody></table>';
        } //count
    } //errs
}

if ($o == "edit-machines") {
    if (!userSystemRights($uid, "edit_machines")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=machine-list"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
        $fext = '&id='.$id;
        $templateArray['{edit-machines}'] = 'block';
        $templateArray['{sect_head_ext}'] = ": Edit Machine";
        
        if ($_POST['edit-machine']) {
            $mach_act = cleanNumber($_POST['mach-edit-act']);
            $mach_type = cleanNumber($_POST['mach-edit-type']);
            //error checking
            if (validateInput($_POST['mach-edit-name'])) {
                $mach_name = cleanInput($_POST['mach-edit-name']);
            } else {
                $mach_name = $_POST['mach-edit-name'];
                $err[] = "Name: ".sysMsg(6);
            }
            if ($_POST['mach-edit-man']) {
                $mach_man = cleanInput($_POST['mach-edit-man']);
            }
            if ($_POST['mach-edit-sn']) {
                $mach_sn = cleanInput($_POST['mach-edit-sn']);
            }
            
            if (!$err) {
                $q_upd = sql("UPDATE `machines` SET `name` = '".$mach_name."', `manufacturer` = '".$mach_man."', `serial_no` = '".$mach_sn."', `tid` = '".$mach_type."', `active` = '".$mach_act."' WHERE `id` = '".$id."'");
                if ($mach_act == '0') {
                    $q_upd_chkl = sql("UPDATE `machine_qa_checklist` SET `status` = '0' WHERE  `mid` = '".$id."'");
                }
                if ($q_upd) {
                    $success[] = sysMsg(9);
                } else {
                    $err[] = sysMsg(8);
                }
            }
        }
        $q_mach = sql("SELECT * FROM `machines` WHERE `id` = '".$id."'");
        $c_mach = mysqli_num_rows($q_mach);
        if (!$c_mach) {
            $err[] = sysMsg(4);
            $templateArray['{system-rights}'] = "block";
        } else {
            $r_mach = mysqli_fetch_assoc($q_mach);
            $mach_name = $r_mach['name'];
            $mach_man = $r_mach['manufacturer'];
            $mach_sn = $r_mach['serial_no'];
            $mach_act = $r_mach['active'];
            $mach_type = $r_mach['tid'];
        } //count
    } //errs
}

if ($o == "add-machines") {
    if (!userSystemRights($uid, "add_machines")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if (!$err) {
        $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=machine-list"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
        $fext = '&id='.$id;
        $templateArray['{add-machines}'] = 'block';
        $templateArray['{sect_head_ext}'] = ": Add Machine";
        if (!D4600135D233F_LOCKOUT) {
            if ($_POST['add-machine']) {
                $mach_act = cleanNumber($_POST['mach-add-act']);
                $mach_type = cleanNumber($_POST['mach-add-type']);
                //error checking
                if (validateInput($_POST['mach-add-name'])) {
                    $mach_name = cleanInput($_POST['mach-add-name']);
                } else {
                    $mach_name = $_POST['mach-add-name'];
                    $err[] = "Name: ".sysMsg(6);
                }
                if ($_POST['mach-add-man']) {
                    $mach_man = cleanInput($_POST['mach-add-man']);
                }
                if ($_POST['mach-add-sn']) {
                    $mach_sn = cleanInput($_POST['mach-add-sn']);
                }
                
                if (!$err) {
                    $q_ins = sql("INSERT INTO `machines` (`name`,`manufacturer`, `serial_no`, `tid`, `active`) VALUES ('".$mach_name."', '".$mach_man."', '".$mach_sn."', '".$mach_type."', '".$mach_act."')");
                    if ($q_ins) {
                        $templateArray['{message}'] = "Adding new machine...";
                        $templateForward = "console/index.php?t=machine-qa&o=machine-list";
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
    $templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o='.$v.'&id='.$id.'" class="'.$c.'">'.$k.'</a>';
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

if (!$templateArray['{edit-machines}']) {
    $templateArray['{edit-machines}'] = 'none';
}
if (!$templateArray['{add-machines}']) {
    $templateArray['{add-machines}'] = 'none';
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
if (!$templateArray['{mach}']) {
    $templateArray['{mach}'] = '';
}

list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=machine-qa&o='.$o.$fext);
//edit machines
$templateArray['{fhead-mach-edit}'] = $fhead; $templateArray['{fend-mach-edit}'] = $fend;
$templateArray['{mach-edit-name}'] = drawFld("text", "mach-edit-name", $mach_name, "Name");
$templateArray['{mach-edit-man}'] = drawFld("text", "mach-edit-man", $mach_man, "Manufacturer");
$templateArray['{mach-edit-sn}'] = drawFld("text", "mach-edit-sn", $mach_sn, "Serial No");
$q_typ = sql("SELECT `id`, `name` FROM `type_list` WHERE `group` = 'mach_type'");
while ($r_typ = mysqli_fetch_assoc($q_typ)) {
    $t_arr[$r_typ['id']] = $r_typ['name'];
}
if (!$type) {
    $type = "42";
} $templateArray['{mach-edit-type}'] = drawSelect("mach-edit-type", $t_arr, $mach_type, "Machine Type");
$act_arr = array("0" => "Disabled","1" => "Active"); if (!$act) {
    $act = "0";
}
$templateArray['{mach-edit-act}'] = drawSelect("mach-edit-act", $act_arr, $mach_act, "Status");
$templateArray['{submit-mach-edit}'] = drawFld("submit", "edit-machine", "Update Machine", "&nbsp;", "submit");

//add machines
$templateArray['{fhead-mach-add}'] = $fhead; $templateArray['{fend-mach-add}'] = $fend;
$templateArray['{mach-add-name}'] = drawFld("text", "mach-add-name", $mach_name, "Name");
$templateArray['{mach-add-man}'] = drawFld("text", "mach-add-man", $mach_man, "Manufacturer");
$templateArray['{mach-add-sn}'] = drawFld("text", "mach-add-sn", $mach_sn, "Serial No");
$q_typ = sql("SELECT `id`, `name` FROM `type_list` WHERE `group` = 'mach_type'");
while ($r_typ = mysqli_fetch_assoc($q_typ)) {
    $t_arr[$r_typ['id']] = $r_typ['name'];
}
if (!$type) {
    $type = "42";
} $templateArray['{mach-add-type}'] = drawSelect("mach-add-type", $t_arr, $mach_type, "Machine Type");
$act_arr = array("0" => "Disabled","1" => "Active"); if (!$act) {
    $act = "0";
}
$templateArray['{mach-add-act}'] = drawSelect("mach-add-act", $act_arr, $mach_act, "Status");
$templateArray['{submit-mach-add}'] = drawFld("submit", "add-machine", "Add new Machine", "&nbsp;", "submit");

//add checklist
$templateArray['{fhead-chk-add}'] = $fhead; $templateArray['{fend-chk-add}'] = $fend;
$templateArray['{chk-add-name}'] = drawFld("text", "chk-add-name", $chk_name, "Checklist Name");
$q_mach = sql("SELECT `id`, `name` FROM `machines` WHERE `active` = '1'"); $m_arr[0] = 'Please select...';
while ($r_mach = mysqli_fetch_assoc($q_mach)) {
    $m_arr[$r_mach['id']] = $r_mach['name'];
}
if (!$chk_mid) {
    $chk_mid = "0";
} $templateArray['{chk-add-mid}'] = drawSelect("chk-add-mid", $m_arr, $chk_mid, "For Machine");
$templateArray['{submit-chk-add}'] = drawFld("submit", "add-qa-checklist", "Add new QA Checklist", "&nbsp;", "submit");

//edit checklist
$templateArray['{fhead-chk-edit}'] = $fhead; $templateArray['{fend-chk-edit}'] = $fend;
$templateArray['{chk-edit-name}'] = drawFld("text", "chk-edit-name", $chk_name, "Checklist Name");
$templateArray['{chk-edit-mid}'] = drawSelect("chk-edit-mid", $m_arr, $chk_mid, "For Machine", "", "", 1);
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
$templateArray['{chk-edit-status-act}'] = drawSelect("chk-edit-status-act", $status_act_arr, $chk_status_act, "Status");

$templateArray['{submit-chk-edit-settings}'] = drawFld("submit", "edit-qa-checklist", "Update Checklist Settings", "&nbsp;", "submit");
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

$templateArray['{checkedurl}'] = WEBSITE_LOC.'console/index.php?t=machine-qa&o='.$o.'&upactive=yes';
$templateArray['{checkedurlfalse}'] = WEBSITE_LOC.'console/index.php?t=machine-qa&o='.$o.'&upactive=no';

if (!$templateArray['{machine-list}']) {
    $templateArray['{machine-list}'] = 'none;';
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