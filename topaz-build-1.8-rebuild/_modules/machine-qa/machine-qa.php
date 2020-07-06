<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
//get all the machines available
include('_modules/standard_arrays.php'); $chk_details = substr($lvl2, -7); $lvl_id = substr($lvl2, 0, -8); if (is_numeric($lvl_id)) {
    $lvl2 = $lvl_id;
}

//Show QA Lists
if (!$lvl2) {
    $templateArray['{report-sel}'] = ' class="selected"';
    $q_chk = sql("SELECT c.id, c.name, ce.version, m.name AS machine FROM machines m LEFT JOIN machine_qa_checklist c ON m.id=c.mid LEFT JOIN machine_qa_checklist_ext ce ON c.id=ce.cid WHERE ce.status='1' AND c.status='1' ORDER BY c.name ASC");
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
            $chk .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_REF.'?p=machine-qa&o='.$r_chk['id'].'">'.$r_chk['name'].'</a></td><td>'.$r_chk['machine'].'</td><td>'.$r_chk['version'].'</td></tr>';
            $i++;
        } //while
        $templateArray['{qa_checklist_data}'] = '<p>Please select a checklist to begin completing quality assurance.</p><table class="tablesorter" id="qa-forms"><thead><tr><th>Checklist Name</th><th>Machine</th><th>Version</th></thead><tbody>'.$chk.'</tbody></table>';
    } //count
}

//Do QA report
if (!($chk_details == "details") && is_numeric($lvl2) && !$lvl3) {
    $templateArray['{report-sel}'] = ' class="selected"';
    //check details
    if ($_POST['submit-qa']) {
        $text = cleanInput($_POST['text']);
        $e = $_POST['uname'];
        $p = $_POST['pass'];
        $vid = cleanNumber($_POST['vid']);
        //get question list into array
        $q_reqd = sql("SELECT `id`, `question`, `reqd`,`range_lwr`, `range_upp` FROM `machine_qa_checklist_q` WHERE `ceid` = '".$vid."' ORDER BY `order` ASC");
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
                    $reqd_count++;
                }
                $count++;
            }
            $ratio = $reqd_count / $count;
            if ($ratio < 1) {
                $calc = (1 - $ratio) * 100;
                $calc = number_format($calc, 2, '.', '');
            } else {
                $calc = number_format(100, 2, '.', '');
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
                if (userSystemRights($id, "submit_machine_qa")) {
                    if (!$validate) {
                        $date = new DateTime('now');
                        $date = $date->format('Y-m-d H:i:s');
                        if ($text) {
                            $upd_text = '<p>'.$date.' '.$e.': '.$text.'</p>';
                        } else {
                            $upd_text = '';
                        }
                        $q_ins = sql("INSERT INTO `machine_qa_responses` (`ceid`, `uid`, `date`, `text`, `pass`) VALUES ('".$vid."', '".$id."', '".$date."', '".$upd_text."','".$calc."')");
                        $last_id  = mysqli_insert_id($conn);
                        //build insert statment
                        foreach ($qflist as $k=>$v) {
                            if (array_key_exists($v, $_POST['q'])) {
                                if ($_POST['q'][$v] == "on") {
                                    $va = '1';
                                    $eval = '<span style="color:#66CC00;">Pass</span>';
                                } else {
                                    $va = cleanString($_POST['q'][$v]);
                                    $eval = $_POST['q'][$v];
                                }
                                $vals .= '("'.$last_id.'","'.$v.'","'.$va.'"),';
                            } else {
                                $vals .= '("'.$last_id.'","'.$v.'",""),';
                                $eval = '<span style="color:#CC0000;">Failed or no response recorded</span>';
                            }
                            //email builder
                            $results .= $email_list[$v].': '.$eval.'<br />';
                        }
                        $vals = substr($vals, 0, -1);
                        if ($vals) {
                            $q_ins_v = sql("INSERT INTO `machine_qa_responses_ext` (`gid`, `cqid`, `response`) VALUES ".$vals."");
                        }
                        if ($q_ins_v) {
                            //do email
                            require_once(SERVER_PATH.'_functions/mailout.php');
                            $q_name = sql("SELECT m.name, m.mid, mc.tid FROM machine_qa_checklist m JOIN machines mc ON mc.id=m.mid WHERE m.id = '".$lvl2."'");
                            $r_name = mysqli_fetch_assoc($q_name);
							$name = $r_name['name'];
							$type_id = $r_name['tid'];

							//get mail groups
							$q_to = sql("SELECT u.email FROM type_list t LEFT JOIN user_rights_ext ue ON t.id=ue.tid LEFT JOIN user_groups ug ON ug.rid=ue.rid LEFT JOIN user u ON ug.uid=u.id WHERE t.id IN ('".$type_id."','45') AND (u.email IS NOT NULL) GROUP BY u.email");
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
							JOIN machine_qa_checklist q ON q.id=un.refid
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

                            $tpl = sysMsg(49);
                            $tpl_arr['{checklist_header}'] = $date.' '.$name;
                            $tpl_arr['{results}'] = $results;
                            $tpl_arr['{pass}'] = $calc;
                            $tpl_arr['{link}'] = '<a href="'.WEBSITE_REF.'?p=machine-qa&o='.$id.'-details&v='.$last_id.'">Click here</a>';
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
                            $templateArray['{message}'] = "<h1>Machine Quality Assurance</h1><p>Thank you the Machine QA has been successfully submitted.</p><p>Please wait...</p>";
                            $templateForward = 'machine-qa';
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
    $q_chk = sql("SELECT c.id, c.name, m.name AS machine, ce.id AS vid FROM machines m LEFT JOIN machine_qa_checklist c ON m.id=c.mid LEFT JOIN machine_qa_checklist_ext ce ON c.id=ce.cid WHERE ce.status='1' AND c.status='1' AND c.id= '".$lvl2."'");
    $c_chk = mysqli_num_rows($q_chk);
    if (!$c_chk) {
        $templateArray['{qa_checklist_data}'] = '<p>'.sysMsg(4).'</p>';
    } else {
        $r_chk = mysqli_fetch_assoc($q_chk);
        $name = $r_chk['name'];
        $mach_name = $r_chk['machine'];
        $vid = $r_chk['vid'];
        $templateArray['{editor}'] = "//<![CDATA[
		 CKEDITOR.replace( 'text', { toolbar : 'Limited', height: 100 });
		 //]]>";
        $templateArray['{go_back}'] = goBack(WEBSITE_REF.'?p=machine-qa');
        //do question list
        $q_ques = sql("SELECT * FROM `machine_qa_checklist_q` WHERE `ceid` = '".$vid."' ORDER BY `order` ASC");
        $c_ques = mysqli_num_rows($q_ques);
        if ($c_ques) {
            $i=1;
            $cols = 3;
            $lim = ceil($c_ques / $cols);
            while ($r_ques = mysqli_fetch_assoc($q_ques)) {
                if ($i > $lim) {
                    $i = 1;
                    $qlist .= '</span>';
                }
                if ($i == 1) {
                    $qlist .= '<span class="cols_mach_qa">';
                }
                if ($r_ques['reqd'] == '1') {
                    $reqd = '<span class="reqd">*</span>';
                } else {
                    $reqd = '';
                }
                if ($r_ques['type'] == 'chkbox') {
                    if (in_array($r_ques['id'], $qselect)) {
                        $sel = "checked=checked";
                    } else {
                        $sel = "";
                    }
                    $qlist .= '<p>
				<label>'.$r_ques['question'].$reqd.'</label><input type="checkbox" name="q['.$r_ques['id'].']" class="chk" '.$sel.' /></p>';
                }
                if ($r_ques['type'] == 'num') {
                    if ($r_ques['range_lwr'] && $r_ques['range_upp']) {
                        $rules .= '
						"q['.$r_ques['id'].']": {
							required: false,
							range: ['.$r_ques['range_lwr'].', '.$r_ques['range_upp'].']
						},';
                        $ques = $r_ques['question'].' ('.$r_ques['range_lwr'].','.$r_ques['range_upp'].')';
                    } else {
                        $ques = $r_ques['question'];
                    }
                    if (in_array($r_ques['id'], $qselect)) {
                        $sel = $_POST['q'][''.$r_ques['id'].''];
                    } else {
                        $sel = "";
                    }
                    $qlist .= '<p>'.drawFld("text", "q[".$r_ques['id']."]", $sel, $ques.$reqd, "num").'</p>';
                }
                $i++;
            } //while
            if ($rules) {
                $rules = substr($rules, 0, -1);
                $templateArray['{rules}'] = $rules;
            } else {
                $templateArray['{rules}'] = '';
            }
            $templateArray['{qa_checklist_data}'] = '<p><span style="font-weight: bold;">Tick the boxes only if QA procedure passes. Notify physics if any parameters fail.</span></p><br />'.$qlist.'</span>';
            $templateArray['{head_data}'] = $mach_name.': '.$name;
            $templateArray['{comments}'] = '<p style="margin-top: 20px"><span style="font-weight: bold;">Comments required if any mandatory (<span class="reqd">*</span>) parameters fail</span></p>'.drawTxtBox("text", $text);
            $templateArray['{signoff}'] = '<fieldset style="margin-top: 20px"><legend>Sign off</legend><p>'.drawFld("text", "uname", $input, "Username").'</p><p>'.drawFld("password", "pass", "", "Password").'</p></fieldset><p>'.drawFld("hidden", "vid", $vid).drawFld("submit", "submit-qa", "Submit Machine QA", "", "submit").'</p>';
        } //$c_ques
    } //$c_chk
} //report qa

//do history
if (($chk_details == "details") && $lvl_id) {
    $templateArray['{details-sel}'] = ' class="selected"';
    if (is_numeric($lvl3)) { //show individual report details
        $templateArray['{go_back}'] = goBack(WEBSITE_REF.'?p=machine-qa&o='.$lvl_id.'-details');
        if ($_POST['submit-comment']) {
            $comments = cleanInput($_POST['text']);
            $e = $_POST['uname'];
            $p = $_POST['pass'];
            $rpid = cleanNumber($_POST['rid']);
            if (!$comments) {
                $err[] = 'You must enter a comment first.';
            } else {
                if ($id = userAuthOnce($e, $p)) {
                    if (userSystemRights($id, "submit_machine_qa")) {
                        $q_data = sql("SELECT `text` FROM `machine_qa_responses` WHERE `id` = '".$rpid."'");
                        $c_data = mysqli_num_rows($q_data);
                        if (!$c_data) {
                            $err[] = sysMsg(4);
                        } else {
                            $r_data = mysqli_fetch_assoc($q_data);
                            $org_comment = $r_data['text'];
                            $date = new DateTime('now');
                            $date = $date->format('Y-m-d H:i:s');
                            $q_upd = sql("UPDATE `machine_qa_responses` SET `text` = '<p>".$date.' '.$e.': '.$comments.$org_comment."</p>' WHERE `id` = '".$rpid."'");
                            if ($q_upd) {
                                $success[] = sysMsg(9);
                                $comments = '';
                            } else {
                                $err[] = sysMsg(8);
                            }
                        }
                    } else {
                        $err[] = sysMsg(18);
                    }
                } else {
                    $err[] = sysMsg(5);
                }
            }
        }
        
        
        $q_data = sql("SELECT cer.id,cer.date,cer.pass,cer.text, ce.version, ue.fname, ue.lname, m.name AS machine, c.name FROM machine_qa_responses cer LEFT JOIN machine_qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN machine_qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid LEFT JOIN machines m ON m.id=c.mid WHERE cer.id = '".$lvl3."' AND c.status = '1'");
        $c_data = mysqli_num_rows($q_data);
        if (!$c_data) {
            $err[] = sysMsg(4);
        } else {
            $r_data = mysqli_fetch_assoc($q_data);
            $user = $r_data['fname'].' '.$r_data['lname'];
            $text = $r_data['text'];
            $date = dateConvert($r_data['date'], 1);
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
            
            $templateArray['{qa_checklist_data}'] = '<p style="margin-top: 20px; font-weight:bold;">Report Details:</p><p><label>Reported by:</label>'.$user.'</p><p><label>Reported Date:</label>'.$date.'</p><p><label>Pass:</label>'.$pass.'% of required fields</p><p style="margin-bottom: 30px;"></p>'.$qlist.'</span><div class="clear"></div><p style="margin-top: 20px; font-weight:bold;">Comments:</p>'.$text.'<p style="margin-top: 20px; font-weight:bold;">Add comment update:</p>'.drawFld("hidden", "rid", $rid).drawTxtBox("text", $comments);
            $templateArray['{signoff}'] = '<fieldset style="margin-top: 20px"><legend>Sign off</legend><p>'.drawFld("text", "uname", $input, "Username").'</p><p>'.drawFld("password", "pass", "", "Password").'</p></fieldset><p>'.drawFld("submit", "submit-comment", "Add checklist update", "", "submit").'</p>';
            $templateArray['{head_data}'] = $mach_name.': '.$checklist_name;
            $templateArray['{editor}'] = "//<![CDATA[
		 CKEDITOR.replace( 'text', { toolbar : 'Limited', height: 100 });
		 //]]>";
        }
    } else {
        $templateArray['{go_back}'] = goBack(WEBSITE_REF.'?p=machine-qa&o='.$lvl_id);
        $q_data= sql("SELECT cer.id,cer.date,cer.pass, ce.version, ue.fname, ue.lname, m.name AS machine, c.name FROM machine_qa_responses cer LEFT JOIN machine_qa_checklist_ext ce ON cer.ceid=ce.id LEFT JOIN machine_qa_checklist c ON ce.cid=c.id LEFT JOIN user_ext ue ON cer.uid=ue.uid LEFT JOIN machines m ON m.id=c.mid WHERE c.id = '".$lvl_id."' AND c.status = '1' ORDER BY cer.date DESC LIMIT 0, ".DISP_ROWS."");
        $c_data = mysqli_num_rows($q_data);
        if (!$c_data) {
            $templateArray['{qa_checklist_data}'] = '<p>There is no reported QA for this checklist.</p>';
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
                $chk .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_REF.'?p=machine-qa&o='.$lvl_id.'-details&v='.$r_data['id'].'">'.dateConvert($r_data['date'], 1).'</a></td><td>'.$r_data['fname'].' '.$r_data['lname'].'</td><td>'.$r_data['version'].'</td><td>'.$pass.'</td></tr>';
                $i++;
            } //while
            $templateArray['{qa_checklist_data}'] = '<table class="tablesorter" id="qa-forms-details"><thead><tr><th>Date Reported</th><th>Reported By</th><th>QA Version</th><th>Pass Indicator</th></thead><tbody>'.$chk.'</tbody></table>';
            $templateArray['{head_data}'] = $mach_name.': '.$checklist_name;
        }
    } //else $lvl3
} //do history

if (!$templateArray['{sel-id}']) {
    $templateArray['{sel-id}'] = WEBSITE_REF.'?p=machine-qa&o='.$lvl2;
}
if (!$lvl2) {
    $templateArray['{sel-id-details}'] = '';
} else {
    $templateArray['{sel-id-details}'] = WEBSITE_REF.'?p=machine-qa&o='.$lvl2.'-details';
}
if (!$templateArray['{qa_checklist_data}']) {
    $templateArray['{qa_checklist_data}'] = '';
}
if (!$templateArray['{head_data}']) {
    $templateArray['{head_data}'] = 'Machine Quality Assurance';
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
list($fhead, $fend) = drawFormTags('p', WEBSITE_REF.'?p='.$lvl1.'&o='.$lvl2.'&v='.$fheadext, 'machine-qa', 'machine-qa'); $templateArray['{fhead}'] = $fhead;	$templateArray['{fend}'] = $fend;
if (!$templateArray['{success}']) {
    $templateArray['{success}'] = writeMsgs($success, "success");
} if (!$templateArray['{error}']) {
    $templateArray['{error}'] = writeMsgs($err);
} if (!$templateArray['{warning}']) {
    $templateArray['{warning}'] = writeMsgs($warning, "warning");
}
