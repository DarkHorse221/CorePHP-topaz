<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
//get all the machines available
include('_modules/standard_arrays.php'); $chk_details = substr($lvl2, -7); $lvl_id = substr($lvl2, 0, -8); if (is_numeric($lvl_id)) {
    $lvl2 = $lvl_id;
}

//get type data if passed and validate for mdule type
$type_id = cleanNumber($_GET['t']);
$q_type = sql("SELECT `id`, `custom` FROM `type_list` WHERE `id` = '".$type_id."' AND `group` = 'qa_type'");
$c_type = mysqli_num_rows($q_type);

//apply where clause
if ($c_type) {
    $r_type = mysqli_fetch_assoc($q_type);
    $type_list_name = $r_type['custom'];
    $typ_sql = "AND tl.id = '".$type_id."'";
}

//Apply usr unit filtering and access
if ($usr_unit == 0) {
    $sql_unit = "";
} else {
    $sql_unit = "AND c.unit IN (".$usr_unit.",0)";
}

//Show QA Lists
if (!$lvl2) {
    $templateArray['{report-sel}'] = ' class="selected"';
    $q_chk = sql("SELECT c.id, c.name, ce.version, ce.date_active FROM qa_checklist c LEFT JOIN qa_checklist_ext ce ON c.id=ce.cid LEFT JOIN type_list tl ON c.type_id=tl.id WHERE ce.status='1' AND c.status='1' ".$typ_sql." ".$sql_unit." ORDER BY c.name ASC");
    $c_chk = mysqli_num_rows($q_chk);
    if (!$c_chk) {
        $templateArray['{qa_checklist_data}'] = "<p>There are no QA checklists found.</p>";
    } else {
        $i = 2;
        while ($r_chk = mysqli_fetch_assoc($q_chk)) {
            $int = $i/2;
            if (is_int($int)) {
                $tr_style = 'class = "odd"';
            } else {
                $tr_style = '';
            }
            $chk .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_REF.'?p=qa-audits&t='.$type_id.'&o='.$r_chk['id'].'">'.$r_chk['name'].'</a></td><td>'.$r_chk['version'].'</td><td>'.dateConvert($r_chk['date_active']).'</td></tr>';
            $i++;
        } //while
        $templateArray['{qa_checklist_data}'] = '<p>Please select a checklist to begin completing quality assurance.</p><table class="tablesorter" id="qa-forms"><thead><tr><th>Checklist Name</th><th>Version</th><th>Active from</th</thead><tbody>'.$chk.'</tbody></table>';
    } //count
}

//Do QA report
if (!($chk_details == "details") && is_numeric($lvl2) && !$lvl3) {
    $templateArray['{report-sel}'] = ' class="selected"';
    //check details
    if ($_POST['submit-qa']) {
        $text = cleanString($_POST['text']);
        $e = $_POST['uname'];
        $p = $_POST['pass'];
        $vid = cleanNumber($_POST['vid']);
        $text = cleanString($_POST['text']);
        $loc = cleanString($_POST['loc']);
        $unit_sel = $_POST['unit-sel'];
        //get question list into array
        $q_reqd = sql("SELECT `id`, `question`, `reqd` FROM `qa_checklist_q` WHERE `ceid` = '".$vid."' ORDER BY `order` ASC");
        $c_reqd = mysqli_num_rows($q_reqd);
        if ($c_reqd) {
            while ($r_reqd = mysqli_fetch_assoc($q_reqd)) {
                if ($r_reqd['reqd']) {
                    $qplist_reqd[] = $r_reqd['id'];
                }
                $qflist[] = $r_reqd['id'];
                $email_list[$r_reqd['id']] = $r_reqd['question'];
            }
            $validate = false;
            foreach ($qplist_reqd as $k=>$v) {
                if (!array_key_exists($v, $_POST['q'])) {
                    $validate = true;
                }
                if (array_key_exists($v, $_POST['q'])) {
                    if (!$_POST['q'][$v]) {
                        $validate = true;
                    }
                }
            }
            foreach ($qflist as $k=>$v) {
                if (array_key_exists($v, $_POST['q'])) {
                    $qselect[] = $v;
                }
            }
            if ($validate) {
                if (!$text) {
                    $warning[] = 'A comment is required as some of the mandatory fields have not been recorded.';
                } else {
                    $validate = false;
                }
            }
            if ($id = userAuthOnce($e, $p)) {
                if (userSystemRights($id, "submit_qa_audits")) {
                    if (!$validate) {
                        $date = new DateTime('now');
                        $date = $date->format('Y-m-d H:i:s');
                        if ($text) {
                            $upd_text = '<p>'.dateConvert($date, 1).' '.$e.': '.$text.'</p>';
                        } else {
                            $upd_text = '';
                        }
                        $q_ins = sql("INSERT INTO `qa_responses` (`ceid`, `uid`, `date`, `location`, `unit`, `text`) VALUES ('".$vid."', '".$id."', '".$date."', '".$loc."', '".$unit_sel."', '".$upd_text."')");
                        $last_id  = mysqli_insert_id($conn);
                        //build insert statment
                        foreach ($qflist as $k=>$v) {
                            if (array_key_exists($v, $_POST['q'])) {
                                $va = '';
                                if (($_POST['q'][$v] == "t") || ($_POST['q'][$v] == "y")) {
                                    if ($_POST['q'][$v] == "t") {
                                        $va = 't';
                                        $va_txt = 'True';
                                    }
                                    if ($_POST['q'][$v] == "y") {
                                        $va = 'y';
                                        $va_txt = 'Yes';
                                    }
                                    $eval = '<span style="color:#66CC00;">'.$va_txt.'</span>';
                                } else {
                                    if ($_POST['q'][$v] == "f") {
                                        $va = 'f';
                                        $va_txt = 'False';
                                    }
                                    if ($_POST['q'][$v] == "n") {
                                        $va = 'n';
                                        $va_txt = 'No';
                                    }
                                    if ($_POST['q'][$v] == "na") {
                                        $va = 'na';
                                        $va_txt = 'N/A';
                                    }
                                    if ($_POST['q'][$v] == "sec") {
                                        $va = 'sec';
                                        $va_txt = '';
                                    }
                                    if ($_POST['q'][$v] && ($_POST['q'][$v] !== 'f') && ($_POST['q'][$v] !== 'n') && ($_POST['q'][$v] !== 'na')) {
                                        $va = $_POST['q'][$v];
                                        $va_txt = $_POST['q'][$v];
                                    }
                                    $eval = '<span style="color:#CC0000;">'.$va_txt.'</span>';
                                }
                            
                                $vals .= '("'.$last_id.'","'.$v.'","'.$va.'"),';
                            } else {
                                $vals .= '("'.$last_id.'","'.$v.'",""),';
                                $eval = '<span style="color:#CC0000;">No response recorded</span>';
                            }
                            //email builder
                            $results .= $email_list[$v].': '.$eval.'<br />';
                        }
                        $vals = substr($vals, 0, -1);
                        if ($vals) {
                            $q_ins_v = sql("INSERT INTO `qa_responses_ext` (`gid`, `cqid`, `response`) VALUES ".$vals."");
                        }
                        if ($q_ins_v) {
                            //do email
                            require_once(SERVER_PATH.'_functions/mailout.php');
                            $q_name = sql("SELECT `name` FROM `qa_checklist` WHERE `id` = '".$lvl2."'");
                            $r_name = mysqli_fetch_assoc($q_name);
							$name = $r_name['name'];
							
							//get mail groups
							$q_to = sql("SELECT u.email FROM type_list t LEFT JOIN user_rights_ext ue ON t.id=ue.tid LEFT JOIN user_groups ug ON ug.rid=ue.rid LEFT JOIN user u ON ug.uid=u.id WHERE t.id='".$type_id."' AND (u.email IS NOT NULL) GROUP BY u.email");
							//add to to[] array
							$c_to = mysqli_num_rows($q_to);
                            if($c_to) {
								while ($r_to = mysqli_fetch_assoc($q_to)) {
									$to[] = $r_to['email'];
								}
							}
							
							//get individuals
							$q_to_ind = sql("SELECT u.email FROM user u
							JOIN user_notifications un ON un.uid=u.id
							JOIN qa_checklist q ON q.id=un.refid
							WHERE q.id = '".$lvl2."' AND un.tid = '".$type_id."'");
							//add to to[] array
                            $c_to_ind = mysqli_num_rows($q_to_ind);
                            if($c_to_ind) {
								while ($r_to_ind = mysqli_fetch_assoc($q_to_ind)) {
									$to[] = $r_to_ind['email'];
								}
							}
							
							//use array unique to only send one email if the user belongs to a mail group and is also an individual receiving notifications
                            $to_list = implode(",", array_unique($to));
                            $tpl = sysMsg(51);
                            $tpl_arr['{checklist_header}'] = $date.' '.$name;
                            $tpl_arr['{results}'] = $results;
                            $tpl_arr['{link}'] = '<a href="'.WEBSITE_REF.'?p=qa-audits&t='.$type_id.'&o='.$id.'-details&v='.$last_id.'">Click here</a>';
                            $tpl_arr['{company}'] = EMAIL_COMPANY;
                            $tpl_arr['{year}'] = date("Y", time());
                            if ($text) {
                                $tpl_arr['{comments}'] = cleanString($text);
                            } else {
                                $tpl_arr['{comments}'] = 'No comments reported.';
                            }
                            foreach ($tpl_arr as $k=>$v) {
                                $ks[] = $k;
                                $vs[] = $v;
                            }
                            $html = str_replace($ks, $vs, $tpl);
                            q_smtpmailer($to_list, NO_REPLY_EMAIL, WEBSITE_OWNER, $name, $html, $date, MAIL_SEND_CODE);
                            //email
                            $templateArray['{message}'] = "<h1>Quality Assurance Audit</h1><p>Thank you the QA Audit has been successfully submitted.</p><p>Please wait...</p>";
                            $templateForward = 'qa-audits';
                        }
                    }
                } else {
                    $err[] = sysMsg(18);
                }
            } else {
                $err[] = sysMsg(5);
            }
        } else {
            $err[] = 'Error: No corresponding question list could be found.';
        }
    }
    
    //check id is ok and status is active
    $q_chk = sql("SELECT c.id, c.name, c.locations, ce.id AS vid FROM qa_checklist c LEFT JOIN qa_checklist_ext ce ON c.id=ce.cid WHERE ce.status='1' AND c.status='1' AND c.id= '".$lvl2."'");
    $c_chk = mysqli_num_rows($q_chk);
    if (!$c_chk) {
        $templateArray['{qa_checklist_data}'] = '<p>'.sysMsg(4).'</p>';
    } else {
        $r_chk = mysqli_fetch_assoc($q_chk);
        $name = $r_chk['name'];
        $vid = $r_chk['vid'];
        $locations = $r_chk['locations'];
        $templateArray['{editor}'] = "//<![CDATA[
		 CKEDITOR.replace( 'text', { toolbar : 'Limited', height: 100 });
		 //]]>";
        $templateArray['{go_back}'] = goBack(WEBSITE_REF.'?p=qa-audits&t='.$type_id.'');
         
        //get locations list
        if ($r_chk['locations']) {
            $locs_list = true;
            $q_locs = sql("SELECT * FROM `type_list` WHERE `group` = 'locations' AND `id` IN (".str_replace(';', ',', $r_chk['locations']).") ORDER BY `name` ASC");
            $loc_arr[0] = 'Please Select';
            while ($r_locs = mysqli_fetch_assoc($q_locs)) {
                $loc_arr[$r_locs['id']] = $r_locs['name'];
            }
        } else {
            $locs_list = false;
        }
                
        //do question list
        $q_ques = sql("SELECT * FROM `qa_checklist_q` WHERE `ceid` = '".$vid."' ORDER BY `order` ASC");
        $c_ques = mysqli_num_rows($q_ques);
        if ($c_ques) {
            
            //Apply usr unit filtering and access
            //get units
            $q_unit = sql("SELECT * FROM `type_list` WHERE `group` = 'units' ORDER BY `name` ASC");
            $unit_arr['all'] = 'All Units';
            while ($r_unit = mysqli_fetch_assoc($q_unit)) {
                $unit_arr[$r_unit['id']] = $r_unit['name'];
            }
            
            //get unit info
            $q_qa_u = sql("SELECT q.unit FROM qa_checklist q LEFT JOIN qa_checklist_ext qe ON qe.cid=q.id WHERE qe.cid = '".$lvl2."' ORDER BY qe.version DESC LIMIT 0,1 ");
            $r_qa_u = mysqli_fetch_assoc($q_qa_u);
            
            //enable unit selection based on conditions
            if ($r_qa_u['unit'] && $usr_unit == '0') {
                $qlist = '<p>'.drawSelect("unit-sel", $unit_arr, $usr_unit, "Please select a unit").'</p>';
            } elseif ($r_qa_u['unit']) {
                $qlist = '<p>'.drawSelect("unit-sel-dis", $unit_arr, $usr_unit, "Please select a unit", "", "", 1).'<input name="unit-sel" type="hidden" value="'.$usr_unit.'" /></p>';
            } else {
                $qlist = '<p>'.drawSelect("unit-sel", $unit_arr, $usr_unit, "Please select a unit").'</p>';
            }
            
            $i=1;
            $z = 2;
            while ($r_ques = mysqli_fetch_assoc($q_ques)) {
                if ($_POST['q']) {
                    if (in_array($r_ques['id'], $qselect)) {
                        $sel = $_POST['q'][''.$r_ques['id'].''];
                        if ($sel == 'y') {
                            $sel_y = 'checked="checked"';
                        } else {
                            $sel_y = '';
                        }
                        if ($sel == 'n') {
                            $sel_n = 'checked="checked"';
                        } else {
                            $sel_n = '';
                        }
                        if ($sel == 'na') {
                            $sel_na = 'checked="checked"';
                        } else {
                            $sel_na = '';
                        }
                        if ($sel == 't') {
                            $sel_t = 'checked="checked"';
                        } else {
                            $sel_t = '';
                        }
                        if ($sel == 'f') {
                            $sel_f = 'checked="checked"';
                        } else {
                            $sel_f = '';
                        }
                    } else {
                        $sel_y = '';
                        $sel_n = '';
                        $sel_na = '';
                        $sel_t = '';
                        $sel_f = '';
                    }
                }
                $int = $z/2;
                if (is_int($int)) {
                    $style = 'audit-row-alt';
                } else {
                    $style = 'audit-row';
                }
                
                if ($r_ques['reqd'] == '1') {
                    $reqd = '<span class="reqd">*</span>';
                } else {
                    $reqd = '';
                }
                if ($r_ques['type'] == 'yn') {
                    $qlist .= '<div class="'.$style.'">
					<label class="question">'.$r_ques['question'].$reqd.'</label>
					<span class="answer">
						<span class="radio"><input type="radio" name="q['.$r_ques['id'].']" value="y" class="chk" '.$sel_y.' /> Yes</span>
						<span class="radio"><input type="radio" name="q['.$r_ques['id'].']" value="n" class="chk" '.$sel_n.' /> No</span>
					</span>
				</div>
				<div style="clear: both;"></div>
				';
                }
                
                            
                if ($r_ques['type'] == 'sec') {
                    $qlist .= '<div><h1 class="sectionbreak">'.$r_ques['question'].'</h1><input type="hidden" name="q['.$r_ques['id'].']" value="sec" /></div>';
                }
                
                if ($r_ques['type'] == 'yna') {
                    $qlist .= '<div class="'.$style.'">
					<label class="question">'.$r_ques['question'].$reqd.'</label>
					<span class="answer">
						<span class="radio"><input type="radio" name="q['.$r_ques['id'].']" value="y" class="chk" '.$sel_y.' /> Yes</span>
						<span class="radio"><input type="radio" name="q['.$r_ques['id'].']" value="n" class="chk" '.$sel_n.' /> No</span>
						<span class="radio"><input type="radio" name="q['.$r_ques['id'].']" value="na" class="chk" '.$sel_na.' /> NA</span>
					</span>
				</div>
				<div style="clear: both;"></div>
				';
                }
                
                if ($r_ques['type'] == 'tf') {
                    $qlist .= '<div class="'.$style.'">
					<label class="question">'.$r_ques['question'].$reqd.'</label>
					<span class="answer">
						<span class="radio"><input type="radio" name="q['.$r_ques['id'].']" value="t" class="chk" '.$sel_t.' /> True</span>
						<span class="radio"><input type="radio" name="q['.$r_ques['id'].']" value="f" class="chk" '.$sel_f.' /> False</span>
					</span>
				</div>
				<div style="clear: both;"></div>';
                }
                
                if ($r_ques['type'] == 'txt') {
                    $qlist .= '<div class="'.$style.'">
				<div class="question">'.$r_ques['question'].$reqd.'</div>
					<div class="answer">
						<input type="text" name="q['.$r_ques['id'].']" value="'.$sel.'" />
					</div>
				</div>
				<div style="clear: both;"></div>';
                }
                
                $i++;
                $z++;
            } //while
            
            $templateArray['{qa_checklist_data}'] = '<p><span style="font-weight: bold;">Please make a comment for any missed responses</span></p>';
            if ($locs_list) {
                $templateArray['{qa_checklist_data}'] .= drawSelect("loc", $loc_arr, $loc, "Location");
            }
            $templateArray['{qa_checklist_data}'] .= $qlist;
            
            $templateArray['{head_data}'] = $name;
            $templateArray['{comments}'] = '<p style="margin-top: 20px"><span style="font-weight: bold;">Comments required if any mandatory (<span class="reqd">*</span>) criteria not answered</span></p>'.drawTxtBox("text", $text);
            $templateArray['{signoff}'] = '<fieldset style="margin-top: 20px"><legend>Sign off</legend><p>'.drawFld("text", "uname", $input, "Username").'</p><p>'.drawFld("password", "pass", "", "Password").'</p></fieldset><p>'.drawFld("hidden", "vid", $vid).drawFld("submit", "submit-qa", "Submit QA Audit", "", "submit").'</p>';
        } //$c_ques
    } //$c_chk
} //report qa

//do history
if (($chk_details == "details") && $lvl_id) {
    $templateArray['{details-sel}'] = ' class="selected"';
    

    if (is_numeric($lvl3)) { //show individual report details
        $templateArray['{go_back}'] = goBack(WEBSITE_REF.'?p=qa-audits&t='.$type_id.'&o='.$lvl_id.'-details');
            
        if (!userSystemRights($uid, "view_qa_audit_records")) {
            $err[] = sysMsg(17);
        } else {
            $q_data = sql("SELECT cer.id,cer.date,cer.text, cer.unit, ce.version, ue.fname, ue.lname, c.name FROM qa_responses cer LEFT JOIN qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid  WHERE cer.id = '".$lvl3."' AND c.status = '1'");
            $c_data = mysqli_num_rows($q_data);
            if (!$c_data) {
                $err[] = sysMsg(4);
            } else {
                $r_data = mysqli_fetch_assoc($q_data);
                $user = $r_data['fname'].' '.$r_data['lname'];
                $text = $r_data['text'];
                $date = dateConvert($r_data['date'], 1);
                $checklist_name = $r_data['name'];
                $rid = $r_data['id'];
            
                if ($r_data['unit'] == 0) {
                    $unit_rl = "All Units";
                } else {
                    $q_typ = sql("SELECT `name` FROM `type_list` WHERE `id` = '".$r_data['unit']."'");
                    $r_typ = mysqli_fetch_assoc($q_typ);
                    $unit_rl = $r_typ['name'];
                }
                $unit = $unit_rl;
            
                //get responses
                $q_dataq = sql("SELECT cer.location, cere.response, cerq.question, cerq.type, cerq.reqd FROM qa_responses cer LEFT JOIN qa_responses_ext cere ON cer.id=cere.gid LEFT JOIN qa_checklist_q cerq ON cere.cqid=cerq.id WHERE cer.id = '".$rid."' ORDER BY cerq.order ASC");
                $c_dataq = mysqli_num_rows($q_dataq);
                $i=1;
                $z = 2;
                $ques_num = $c_dataq;
                $add = 0;
                while ($r_dataq = mysqli_fetch_assoc($q_dataq)) {
                    $q_loc = sql("SELECT `name` FROM `type_list` WHERE `id` = '".$r_dataq['location']."'");
                    $c_loc = mysqli_num_rows($q_loc);
                    if (!$c_loc) {
                        $location = 'Not reported';
                    } else {
                        $r_loc = mysqli_fetch_assoc($q_loc);
                        $location = $r_loc['name'];
                    }
                
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
                    if ($r_dataq['response'] == 'sec') {
                        $ques_num--;
                    }
                    
                    if ($r_dataq['response'] && ($r_dataq['response'] !== 'y') && ($r_dataq['response'] !== 'sec') && ($r_dataq['response'] !== 'n') && ($r_dataq['response'] !== 'na') && ($r_dataq['response'] !== 't') && ($r_dataq['response'] !== 'f')) {
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
					<label class="question">'.$r_dataq['question'].$reqd.'</label>
					<span class="answer">
						<span class="radio"><input type="radio" class="chk" '.$sel_y.' disabled=disabled /> Yes</span>
						<span class="radio"><input type="radio" class="chk" '.$sel_n.' disabled=disabled /> No</span>
					</span>
					</div>
					<div style="clear: both;"></div>';
                    }
                    
                    if ($r_dataq['type'] == 'sec') {
                        $qlist .= '<div><h1 class="sectionbreak">'.$r_dataq['question'].'</h1></div>';
                    }
                    
                    if ($r_dataq['type'] == 'yna') {
                        $qlist .= '<div class="'.$style.'">
					<label class="question">'.$r_dataq['question'].$reqd.'</label>
					<span class="answer">
						<span class="radio"><input type="radio" class="chk" '.$sel_y.' disabled=disabled /> Yes</span>
						<span class="radio"><input type="radio" class="chk" '.$sel_n.' disabled=disabled /> No</span>
						<span class="radio"><input type="radio" class="chk" '.$sel_na.' disabled=disabled /> NA</span>
					</span>
					</div>
					<div style="clear: both;"></div>';
                    }
                    
                    if ($r_dataq['type'] == 'tf') {
                        $qlist .= '<div class="'.$style.'">
					<label class="question">'.$r_dataq['question'].$reqd.'</label>
					<span class="answer">
						<span class="radio"><input type="radio" class="chk" '.$sel_t.' disabled=disabled /> True</span>
						<span class="radio"><input type="radio"class="chk" '.$sel_f.' disabled=disabled /> False</span>
					</span>
					</div>
					<div style="clear: both;"></div>';
                    }
                    
                    if ($r_dataq['type'] == 'txt') {
                        $qlist .= '<div class="'.$style.'">
					<div class="question">'.$r_dataq['question'].$reqd.'</div>
						<div class="answer">
							<input type="text" value="'.$r_dataq['response'].'" disabled="disabled" />
						</div>
					</div>
					<div style="clear: both;"></div>';
                    }
                    
                    $i++;
                    $z++;
                }
            
                $compliance = $add / $ques_num * 100;
                $compliance = number_format($compliance, 2, '.', '');
                $templateArray['{qa_checklist_data}'] = '<p style="margin-top: 20px; font-weight:bold;">Report Details:</p><p><label>Reported by:</label>'.$user.'</p><p><label>Reported Date:</label>'.$date.'</p><p><label>Unit:</label>'.$unit.'</p><p><label>Location:</label>'.$location.'</p><p><label>Compliance:</label>'.$compliance.'%</p><p style="margin-bottom: 20px;"></p><p style="margin-top: 20px; font-weight:bold;">Results:</p>'.$qlist.'<div class="clear"></div><p style="margin-top: 20px; font-weight:bold;">Comments:</p>'.$text;
                $templateArray['{head_data}'] = $checklist_name;
            } //user rights
        }
    } else {
        $templateArray['{go_back}'] = goBack(WEBSITE_REF.'?p=qa-audits&t='.$type_id.'&o='.$lvl_id);
        $q_data= sql("SELECT cer.id,cer.date,ce.version, ue.fname, ue.lname, c.name FROM qa_responses cer LEFT JOIN qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid WHERE c.id = '".$lvl_id."' AND c.status = '1' ORDER BY cer.date DESC LIMIT 0, ".DISP_ROWS."");
        $c_data = mysqli_num_rows($q_data);
        if (!$c_data) {
            $templateArray['{qa_checklist_data}'] = '<p>There is no reported QA for this checklist.</p>';
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
                $chk .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_REF.'?p=qa-audits&t='.$type_id.'&o='.$lvl_id.'-details&v='.$r_data['id'].'">'.dateConvert($r_data['date'], 1).'</a></td><td>'.$r_data['fname'].' '.$r_data['lname'].'</td><td>'.$r_data['version'].'</td></tr>';
                $i++;
            } //while
            $templateArray['{qa_checklist_data}'] = '<table class="tablesorter" id="qa-forms-details"><thead><tr><th>Date Reported</th><th>Reported By</th><th>QA Version</th></thead><tbody>'.$chk.'</tbody></table>';
            $templateArray['{head_data}'] = $checklist_name;
        }
    } //else $lvl3
} //do history

if (!$templateArray['{sel-id}']) {
    $templateArray['{sel-id}'] = WEBSITE_REF.'?p=qa-audits&t='.$type_id.'&o='.$lvl2;
}
if (!$lvl2) {
    $templateArray['{sel-id-details}'] = '';
} else {
    $templateArray['{sel-id-details}'] = WEBSITE_REF.'?p=qa-audits&t='.$type_id.'&o='.$lvl2.'-details';
}
if (!$templateArray['{qa_checklist_data}']) {
    $templateArray['{qa_checklist_data}'] = '';
}
if (!$templateArray['{head_data}']) {
    if ($c_type) {
        $templateArray['{head_data}'] = $type_list_name;
    } else {
        $templateArray['{head_data}'] = 'Audits';
    }
}
if (!$templateArray['{signoff}']) {
    $templateArray['{signoff}'] = '';
} if (!$templateArray['{comments}']) {
    $templateArray['{comments}'] = '';
} if (!$templateArray['{editor}']) {
    $templateArray['{editor}'] = '';
} if (!$templateArray['{go_back}']) {
    $templateArray['{go_back}'] = '';
}
if (!$templateArray['{details-sel}']) {
    $templateArray['{details-sel}'] = '';
} if (!$templateArray['{report-sel}']) {
    $templateArray['{report-sel}'] = '';
}
if ($lvl3) {
    $lvl2 = $lvl2.'-details';
    $fheadext = $lvl3;
} else {
    $fheadext = '';
}
list($fhead, $fend) = drawFormTags('p', WEBSITE_REF.'?p='.$lvl1.'&t='.$type_id.'&o='.$lvl2.'&v='.$fheadext); $templateArray['{fhead}'] = $fhead;	$templateArray['{fend}'] = $fend;
if (!$templateArray['{success}']) {
    $templateArray['{success}'] = writeMsgs($success, "success");
} if (!$templateArray['{error}']) {
    $templateArray['{error}'] = writeMsgs($err);
} if (!$templateArray['{warning}']) {
    $templateArray['{warning}'] = writeMsgs($warning, "warning");
}
