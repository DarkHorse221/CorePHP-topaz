<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
if (!userAuthorise($sid)) {
    $templateArray['{message}'] = "<p>You are not logged in. Please wait as we transfer you to login...</p>";
    $templateForward = "login&o=secure";
    $templateArray['{d_nav}'] = "none";
} else {
    include('_modules/standard_arrays.php');
    $uid = userID($sid);
    $ud = SERVER_PATH.FILES_DIR.$uid.'/';
    
    if (userSystemRights($uid, "view_education")) {
        if (!$lvl2) {
            $lvl2 = 'events';
        }
        if ($lvl2 == 'events') {
            $events_details = true;
            $events_sel = 'class="selected"';
        } else {
            $events_details = false;
        }
        //if($lvl2 == 'training') { $train_details = true; $train_sel = 'class="selected"'; } else { $train_details = false; }
        if ($lvl2 == 'cpd') {
            $cpe_details = true;
            $cpe_sel = 'class="selected"';
        } else {
            $cpe_details = false;
        }
        if ($lvl2 == 'cpd-presentation') {
            $cpe_pres = true;
            $cpe_pres = 'class="selected"';
        } else {
            $cpe_pres = false;
        }
        if ($lvl2 == 'add-self-cpd') {
            $cpe_self_add = true;
            $cpe_self_add_sel = 'class="selected"';
        } else {
            $cpe_self_add = false;
        }
        if ($lvl2 == 'cpd-summary') {
            $cpd_summary = true;
            $cpd_summary_sel = 'class="selected"';
        } else {
            $cpd_summary = false;
        }
        
        //navigation / rights
        $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=events" '.$events_sel.'>Events</a></li>';
        //$templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=training" '.$train_sel.'>Training</a></li>';
        $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=cpd" '.$cpe_sel.'>CPD Attendance Record</a></li>';
        $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=cpd-presentation" '.$cpe_pres.'>CPD Presentation Record</a></li>';
        if (userSystemRights($uid, "add_education")) {
            $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=add-self-cpd" '.$cpe_self_add_sel.'><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/add.gif" class="img" /> Personal Record</a></li>';
        }
        $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=cpd-summary" '.$cpd_summary_sel.'>CPD Summary</a></li>';
        $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=logoff">Log Off</a></li>';
        
        //cpe record
        if ($cpe_details) {
            $q_cpe = sql("SELECT u.id, u.ins_date_id, u.conf_date_id, u.rating, u.feedback, uee.name AS act_name, uee.date_start, uee.date_end, uee.credits AS act_credits, uee.certificate, uee.q1, uee.q2, uee.q3, uee.q4, uee.q5, e.name, e.credits, e.mandatory, e.text, ins.start, ins.end, ins.presenter, ue.fname, ue.lname, conf.start AS conf_start, conf.end AS conf_end, conf.loc, ec.name AS conf_name, ec.text AS conf_text FROM user_education u LEFT JOIN user_education_ext uee ON u.id=uee.ueid LEFT JOIN education_ins ins ON ins.id=u.ins_date_id LEFT JOIN education_conf conf ON conf.id=u.conf_date_id LEFT JOIN education e ON ins.eid=e.id LEFT JOIN education ec ON conf.eid=ec.id LEFT JOIN user_ext ue ON ins.pid=ue.uid WHERE u.uid = '".$uid."' ORDER BY u.id DESC");
            $c_cpe = mysqli_num_rows($q_cpe);
            if (!$c_cpe) {
                $templateArray['{nav-tabs}'] = '<p>'.sysMsg(19).'</p>';
            } else {
            
                //Get cpe details
                while ($r_cpe = mysqli_fetch_assoc($q_cpe)) {
                    if ($r_cpe['mandatory']) {
                        $man = 'Yes';
                    } else {
                        $man = 'No';
                    }
                    if ($r_cpe['presenter']) {
                        $presenter = $r_cpe['presenter'];
                    } else {
                        $presenter = $r_cpe['fname'].' '.$r_cpe['lname'];
                    }
                    if ($r_cpe['text']) {
                        $summary = $r_cpe['text'];
                    } else {
                        $summary = '<p>There is no summary for this event.</p>';
                    }
                    if ($r_cpe['conf_text']) {
                        $conf_summary = $r_cpe['conf_text'];
                    } else {
                        $conf_summary = '<p>There is no summary for this event.</p>';
                    }
                    
                    //get Inservice details
                    if ($r_cpe['ins_date_id']) {
                        $now = new DateTime($r_cpe['start']);
                        $ref = new DateTime($r_cpe['end']);
                        $diff = $now->diff($ref);
                        $hours = $diff->h;
                        $mins = $diff->i;
                        $time = $hours.' hour(s) '.$mins.' minute(s)';
                        
                        $builder .= '<div>
						<h1 class="expand"><a href="#"><span class="blue">'.$r_cpe['name'].'</span><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/certificate.gif" style="vertical-align: middle; margin-right: 10px;" /><span class="black">'.dateConvert($r_cpe['start'], 1).'</span><span class="black">'.dateConvert($r_cpe['end'], 1).'</span></a></h1>
												
						<div class="extra">
						<h1>Event Details</h1>
						<p><label>In-Service</label>'.$r_cpe['name'].'</p>
						<p><label>Credit Points</label>'.$r_cpe['credits'].'</p>
						<p><label>Time</label>'.$time.'</p>
						<p><label>Mandatory</label>'.$man.'</p>
						<p><label>Scheduled start</label>'.dateConvert($r_cpe['start'], 1).'</p>
						<p><label>Scheduled end</label>'.dateConvert($r_cpe['end'], 1).'</p>
						<p><label>Presented by</label>'.$presenter.'</p>
						<p><label>View Certificate</label><a href="'.WEBSITE_LOC.'api/certificate-generator.php?uid='.$uid.'&eid='.$r_cpe['ins_date_id'].'&id='.$sid.'" target="_blank"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/certificate.gif" style="vertical-align: middle; margin-right: 10px;" /></a></p>
						<br /><h1>Event Summary</h1>
						<p>'.$summary.'</p><br />
						<h1>Event Record</h1>
						<p><em>Your rating for this presentation</em></p>
						<p>'.$r_cpe['rating'].' / 5</p><br />
						<p><em>Your feedback for this presentation</em></p>
						<p>'.$r_cpe['feedback'].'</p><br />
						<p><em>What were the three main things you learnt from the event?</em></p>
						<p>'.$r_cpe['q1'].'</p><br />
						<p><em>Does this differ from your previous knowledge of these areas?</em></p>
						<p>'.$r_cpe['q2'].'</p><br />
						<p><em>Do you see any value in the knowledge gained, is it accurate and why?</em></p>
						<p>'.$r_cpe['q3'].'</p><br />
						<p><em>Will this new knowledge change your practice?</em></p>
						<p>'.$r_cpe['q4'].'</p>
						</div>
						
						</div>';
                    } elseif ($r_cpe['conf_date_id']) {
                        //get conference details
                        $builder .= '<div>
						<h1 class="expand"><a href="#"><span class="blue">'.$r_cpe['conf_name'].'</span><span style="margin-right: 23px;">&nbsp;</span><span class="black">'.dateConvert($r_cpe['conf_start'], 1).'</span><span class="black">'.dateConvert($r_cpe['conf_end'], 1).'</span></a></h1>
												
						<div class="extra">
						<h1>Event Details</h1>
						<p><label>Conference</label>'.$r_cpe['conf_name'].'</p>
						<p><label>Scheduled start</label>'.dateConvert($r_cpe['conf_start'], 1).'</p>
						<p><label>Scheduled end</label>'.dateConvert($r_cpe['conf_end'], 1).'</p>
						<br />
						<h1>Event Summary</h1>
						<p>'.$conf_summary.'</p><br />
						<h1>Event Record</h1>
						<p><em>What were the three main things you learnt from the event?</em></p>
						<p>'.$r_cpe['q1'].'</p><br />
						<p><em>Does this differ from your previous knowledge of these areas?</em></p>
						<p>'.$r_cpe['q2'].'</p><br />
						<p><em>Do you see any value in the knowledge gained, is it accurate and why?</em></p>
						<p>'.$r_cpe['q3'].'</p><br />
						<p><em>Will this new knowledge change your practice?</em></p>
						<p>'.$r_cpe['q4'].'</p>
						</div>
						
						</div>';
                    } else {
                        //get self registered details
                        if (is_file(SERVER_PATH.FILES_DIR.$uid.'/'.$r_cpe['certificate'])) {
                            $link = '<a href="'.WEBSITE_LOC.'_files/'.$uid.'/'.$r_cpe['certificate'].'"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/certificate.gif" style="vertical-align: middle; margin-right: 10px;" /></a>';
                        } else {
                            $link = 'No certificate uploaded.';
                        }
                        
                        $now = new DateTime($r_cpe['date_start']);
                        $ref = new DateTime($r_cpe['date_end']);
                        $diff = $now->diff($ref);
                        $hours = $diff->h;
                        $mins = $diff->i;
                        $time = $hours.' hour(s) '.$mins.' minute(s)';
                        
                        $builder .= '<div>
						<h1 class="expand"><a href="#"><span class="blue">'.$r_cpe['act_name'].'</span><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/certificate.gif" style="vertical-align: middle; margin-right: 10px;" /><span class="black">'.dateConvert($r_cpe['date_start'], 1).'</span><span class="black">'.dateConvert($r_cpe['date_end'], 1).'</span></a></h1>
												
						<div class="extra">
						<h1>Event Details</h1>
						<p><label>Activity Name</label>'.$r_cpe['act_name'].'</p>
						<p><label>Credit Points</label>'.$r_cpe['act_credits'].'</p>
						<p><label>Time</label>'.$time.'</p>
						<p><label>Start Date</label>'.dateConvert($r_cpe['date_start'], 1).'</p>
						<p><label>End Date</label>'.dateConvert($r_cpe['date_end'], 1).'</p>					
						<p><label>View Certificate</label>'.$link.'</p><br /><br />
						<h1>Reflective Summary</h1>
						<p><em>What were the three main things you learnt from the event?</em></p>
						<p>'.$r_cpe['q1'].'</p><br />
						<p><em>Does this differ from your previous knowledge of these areas?</em></p>
						<p>'.$r_cpe['q2'].'</p><br />
						<p><em>Do you see any value in the knowledge gained, is it accurate and why?</em></p>
						<p>'.$r_cpe['q3'].'</p><br />
						<p><em>Will this new knowledge change your practice?</em></p>
						<p>'.$r_cpe['q4'].'</p><br />
						<p><em>Who facilitated the course or workshop and what was the subject area?</em></p>
						<p>'.$r_cpe['q5'].'</p>
						</div>
						
						</div>';
                    } //$r_cpe['ins_date_id']
                } //while $r_cpe
                
                $templateArray['{nav-tabs}'] = '<div class="act_header"><span class="name_header">Activity Name</span><span class="img_header">&nbsp;</span><span class="black_header">Scheduled Start</span><span class="black_header">Scheduled End</span></div>'.$builder;
            } //$c_cpe
        }//get cpe details
        
        //cpd presentation history
        if ($cpe_pres) {
            $q_cpe_pres = sql("SELECT e.id, e.name, e.credits, e.mandatory, ei.id AS ins_date_id, ei.start, ei.end, ue.fname, ue.lname, e.text FROM education_ins ei LEFT JOIN education e ON ei.eid=e.id LEFT JOIN user_ext ue ON ue.uid = ei.pid WHERE ei.pid = '".$uid."' ORDER BY ei.start DESC");
            $c_cpe_pres = mysqli_num_rows($q_cpe_pres);
            if (!$c_cpe_pres) {
                $templateArray['{nav-tabs}'] = '<p>'.sysMsg(19).'</p>';
            } else {
                while ($r_cpe_pres = mysqli_fetch_assoc($q_cpe_pres)) {
                    if ($r_cpe_pres['mandatory']) {
                        $man = 'Yes';
                    } else {
                        $man = 'No';
                    }
                    $presenter = $r_cpe_pres['fname'].' '.$r_cpe_pres['lname'];
                    if ($r_cpe_pres['text']) {
                        $summary = $r_cpe_pres['text'];
                    } else {
                        $summary = '<p>There is no summary for this event.</p>';
                    }
                    
                    //do feedback
                    $q_fb = sql("SELECT `rating`, `feedback` FROM `user_education` WHERE `ins_date_id` = '".$r_cpe_pres['ins_date_id']."'");
                    $c_fb = mysqli_num_rows($q_fb);
                    $total = '';
                    $feedback = '';
                    $tot_num_feedback = '';
                    if (!$c_fb) {
                        $feedback = '<p>No feedback has been recorded yet.</p>';
                        $rating = 'Not recorded';
                        $total = 'N/A';
                    } else {
                        while ($r_fb = mysqli_fetch_assoc($q_fb)) {
                            $total = $total + $r_fb['rating'];
                            $feedback .= '<p>"'.$r_fb['feedback'].'"</p>';
                        } //$r_fb
                        $total = $total / $c_fb;
                        $total = round($total, 2);
                        $tot_num_feedback = $c_fb;
                    } //$c_fb
                    
                    $now = new DateTime($r_cpe_pres['start']);
                    $ref = new DateTime($r_cpe_pres['end']);
                    $diff = $now->diff($ref);
                    $hours = $diff->h;
                    $mins = $diff->i;
                    $time = $hours.' hour(s) '.$mins.' minute(s)';
                    
                    $builder .= '<div>
						<h1 class="expand"><a href="#"><span class="blue">'.$r_cpe_pres['name'].'</span><span style="margin-right: 23px;">&nbsp;</span><span class="black">'.dateConvert($r_cpe_pres['start'], 1).'</span><span class="black">'.dateConvert($r_cpe_pres['end'], 1).'</span></a></h1>
												
						<div class="extra">
						<h1>Event Details</h1>
						<p><label>In-Service</label>'.$r_cpe_pres['name'].'</p>
						<p><label>Credit Points</label>'.$r_cpe_pres['credits'].'</p>
						<p><label>Time</label>'.$time.'</p>
						<p><label>Mandatory</label>'.$man.'</p>
						<p><label>Scheduled start</label>'.dateConvert($r_cpe_pres['start'], 1).'</p>
						<p><label>Scheduled end</label>'.dateConvert($r_cpe_pres['end'], 1).'</p>
						<p><label>Presented by</label>'.$presenter.'</p>
						<br /><h1>Event Summary</h1>
						<p>'.$summary.'</p><br />
						<h1>Feedback Summary</h1>
						<p>Overall rating for presentation <strong>'.$total.' / 5</strong> ('.$tot_num_feedback.' ratings)</p>
						'.$feedback.'
						</div>
						</div>';
                }
                $templateArray['{nav-tabs}'] = '<div class="act_header"><span class="name_header">Activity Name</span><span class="img_header">&nbsp;</span><span class="black_header">Scheduled Start</span><span class="black_header">Scheduled End</span></div>'.$builder;
            } //$c_cpe_pres
        }//get cpe_pres details
        
        
        //get event details
        if ($events_details) {
            if ($lvl3) { //get detailed event details
                $fext = $lvl3;
                $templateArray['{go_back}'] = goBack(WEBSITE_LOC.'?p=learning-and-education');
                
                if ($_POST['submit-feedback']) { //submit inservice attendance details
                    $disp = 'block';
                    $date_id = cleanNumber($_POST['date']);
                    $rating = cleanNumber($_POST['rating']);
                    $feedback_comment = cleanInput($_POST['feedback']);
                    $q1 = cleanInput($_POST['q1']);
                    $q2 = cleanInput($_POST['q2']);
                    $q3 = cleanInput($_POST['q3']);
                    $q4 = cleanInput($_POST['q4']);
                    if (!$feedback_comment || !$q1 || !$q2 || !$q3 || !$q4) {
                        $errs[] = 'You must complete all feedback and questions to record attendance.';
                    }
                    if (!$errs) {
                        $q_ins = sql("INSERT INTO `user_education` (`uid`, `ins_date_id`, `rating`, `feedback`) VALUES ('".$uid."', '".$date_id."','".$rating."','".$feedback_comment."')");
                        $last_id  = mysqli_insert_id($conn);
                        $q_ins_ue = sql("INSERT INTO `user_education_ext` (`ueid`, `q1`, `q2`, `q3`, `q4`) VALUES ('".$last_id."', '".$q1."','".$q2."','".$q3."','".$q4."')");
                        if ($q_ins && $q_ins_ue) {
                            $disp = 'none';
                            $success[] = 'Your attendance has been recorded for this activity. You CPD record has been updated.';
                        } else {
                            $errs[] = sysMsg(8);
                        }
                    }	//if(!$errs
                } elseif ($_POST['submit-feedback-conf']) { //submit conference attendance details
                    
                    $disp = 'block';
                    $conf_date = cleanNumber($_POST['conf_date']);
                    $q1 = cleanInput($_POST['q1']);
                    $q2 = cleanInput($_POST['q2']);
                    $q3 = cleanInput($_POST['q3']);
                    $q4 = cleanInput($_POST['q4']);
                    if (!$q1 || !$q2 || !$q3 || !$q4) {
                        $errs[] = 'You must complete all questions to record attendance.';
                    }
                    if (!$errs) {
                        $q_ins = sql("INSERT INTO `user_education` (`uid`, `conf_date_id`) VALUES ('".$uid."', '".$conf_date."')");
                        $last_id  = mysqli_insert_id($conn);
                        $q_ins_ue = sql("INSERT INTO `user_education_ext` (`ueid`, `q1`, `q2`, `q3`, `q4`) VALUES ('".$last_id."', '".$q1."','".$q2."','".$q3."','".$q4."')");
                        if ($q_ins && $q_ins_ue) {
                            $disp = 'none';
                            $success[] = 'Your attendance has been recorded for this activity. You CPD record has been updated.';
                        } else {
                            $errs[] = sysMsg(8);
                        }
                    }
                } else {
                    $disp = 'none';
                }
                
                //do anyway and get details for event
                $q_edu = sql("SELECT e.id, e.name, e.groups, e.credits, e.mandatory, e.text, ei.pid, ei.id AS date_id, ei.start, ei.end, ei.presenter, ue.fname, ue.lname, ec.loc, ec.start AS conf_start, ec.end AS conf_end,ec.id AS conf_date, ec.attachment FROM education e LEFT JOIN education_ins ei ON e.id=ei.eid LEFT JOIN education_conf ec ON e.id=ec.eid LEFT JOIN user_ext ue ON ue.uid=ei.pid WHERE e.id = '".$lvl3."'");
                $c_edu = mysqli_num_rows($q_edu);
                
                if (!$c_edu) {
                    $errs[] = sysMsg(4);
                } else {
                    $i= '0';
                    
                    while ($r_edu = mysqli_fetch_array($q_edu)) {
                        //get conference details
                        if ($r_edu['conf_start']) {
                            $conf_submit = '-conf';
                            $int = $i/2;
                            if (is_int($int)) {
                                $tr_style = 'class = "odd"';
                            } else {
                                $tr_style = '';
                            }
                            if ($r_edu['text']) {
                                $conf_summary = $r_edu['text'];
                            } else {
                                $conf_summary = '<p>There is no summary for this event.</p>';
                            }
                            $q_chk_user_attend = sql("SELECT `id` FROM `user_education` WHERE `uid` = '".$uid."' AND `conf_date_id` = '".$r_edu['conf_date']."'");
                            $c_chk_user_attend = mysqli_num_rows($q_chk_user_attend);
                            if ($c_chk_user_attend) {
                                $display_dates = 'no';
                            } else {
                                $display_dates = 'conf';
                            }
                        
                            $time = new DateTime('now');
                            $now = $time->format('Y-m-d H:i:s');
                            $endDate = new DateTime();
                            $endDateInt = new DateInterval("P".DAYS_FOR_CPE_RECORDING."D");
                            $endDate->sub($endDateInt);
                            $end = $endDate->format('Y-m-d H:i:s');
                            
                            if ($end <= $r_edu['conf_end'] && $r_edu['conf_end'] <= $now) {
                                if ($date_id == $r_edu['conf_date']) {
                                    $chkd = "checked=checked";
                                } else {
                                    $chkd = '';
                                }
                                
                                $inp = '<input type="radio" name="conf_date" value="'.$r_edu['conf_date'].'" class="chk" '.$chkd.'  /> Record Attendance';
                                $rating_arr = array("0" => "Please select","1" => "1 (Poor)","2" => "2","3" => "3","4" => "4","5" => "5 (Excellent)");
                                if (!$rating) {
                                    $rating = "0";
                                }
                            } elseif ($end >= $r_edu['conf_end']) {
                                $inp = '<input type="radio" name="conf_date" value="'.$r_edu['conf_date'].'" class="chk" disabled=disabled /> Locked';
                            } else {
                                $inp = '<input type="radio" name="conf_date" value="'.$r_edu['conf_date'].'" class="chk" disabled=disabled /> Conference pending';
                            }
                            
                            if ($r_edu['attachment']) {
                                $ude = SERVER_PATH.UPLOAD_DIR.'files/_education/';
                                
                                if (is_file($ude.$r_edu['attachment'])) {
                                    $attachment = '<p><label>More Information</label><a href="'.WEBSITE_LOC.'_uploads/files/_education/'.$r_edu['attachment'].'" target="_blank"><img src="'.WEBSITE_LOC.'_images/_layout/pdf-icon-super-sm.gif" /></a></p>';
                                } else {
                                    $templateArray['{current-attachment}'] = '';
                                }
                            } else {
                                $templateArray['{current-attachment}'] = '';
                            }
                            
                            
                            $data_header = '<h1>Event Details</h1><p><label>Conference</label>'.$r_edu['name'].'</p><p><label>Venue/Location</label>'.$r_edu['loc'].'</p>'.$attachment.'
							<br /><h1>Event Summary</h1>'.$conf_summary.'';
                            $dates .= '<tr '.$tr_style.'><td>'.$inp.'</td><td>'.$r_edu['conf_start'].'</td><td>'.$r_edu['conf_end'].'</td></tr>';
                        } else { //do inservice details
                        
                            $int = $i/2;
                            if (is_int($int)) {
                                $tr_style = 'class = "odd"';
                            } else {
                                $tr_style = '';
                            }
                            if ($r_edu['mandatory']) {
                                $man = 'Yes';
                            } else {
                                $man = 'No';
                            }
                            if ($r_edu['presenter']) {
                                $presenter = $r_edu['presenter'];
                            } else {
                                $presenter = $r_edu['fname'].' '.$r_edu['lname'];
                            }
                            if ($r_edu['text']) {
                                $summary = $r_edu['text'];
                            } else {
                                $summary = '<p>There is no summary for this event.</p>';
                            }
                            
                            $q_chk_user_attend = sql("SELECT `id` FROM `user_education` WHERE `uid` = '".$uid."' AND `ins_date_id` = '".$r_edu['date_id']."'");
                            $c_chk_user_attend = mysqli_num_rows($q_chk_user_attend);
                            if ($c_chk_user_attend) {
                                $display_dates = 'no';
                            }
                            $time = new DateTime('now');
                            $now = $time->format('Y-m-d H:i:s');
                            $endDate = new DateTime();
                            $endDateInt = new DateInterval("P".DAYS_FOR_CPE_RECORDING."D");
                            $endDate->sub($endDateInt);
                            $end = $endDate->format('Y-m-d H:i:s');
                            
                            if ($end <= $r_edu['end'] && $r_edu['end'] <= $now) {
                                if ($date_id == $r_edu['date_id']) {
                                    $chkd = "checked=checked";
                                } else {
                                    $chkd = '';
                                }
                                if ($r_edu['pid'] == $uid) {
                                    $pres_dis = 'disabled=disabled';
                                    $pres_text = 'N/A';
                                } else {
                                    $pres_dis = '';
                                    $pres_text = 'Record Attendance';
                                }
                                $inp = '<input type="radio" name="date" value="'.$r_edu['date_id'].'" class="chk" '.$chkd.' '.$pres_dis.' /> '.$pres_text;
                                $rating_arr = array("0" => "Please select","1" => "1 (Poor)","2" => "2","3" => "3","4" => "4","5" => "5 (Excellent)");
                                if (!$rating) {
                                    $rating = "0";
                                }
                            } elseif ($end >= $r_edu['end']) {
                                $inp = '<input type="radio" name="date" value="'.$r_edu['date_id'].'" class="chk" disabled=disabled /> Locked';
                            } else {
                                $inp = '<input type="radio" name="date" value="'.$r_edu['date_id'].'" class="chk" disabled=disabled /> Presentation pending';
                            }
                            
                            $data_header = '<h1>Event Details</h1><p><label>In-Service</label>'.$r_edu['name'].'</p><p><label>Credit Points</label>'.$r_edu['credits'].'</p>
							<p><label>Mandatory</label>'.$man.'</p><br /><h1>Event Summary</h1>'.$summary.'';
                            $dates .= '<tr '.$tr_style.'><td>'.$inp.'</td><td>'.$presenter.'</td><td>'.$r_edu['start'].'</td><td>'.$r_edu['end'].'</td></tr>';
                            $i++;
                        } //else
                    } //if conf
                } //while
                
                $templateArray['{nav-tabs}'] = $data_header.'<br /><h1>Event Dates</h1>';
                
                if ($display_dates == 'no') {
                    $templateArray['{nav-tabs}'] .= '<p>Your attendance to this activity has already been recorded.</p>';
                } elseif ($display_dates == 'conf') {
                    $templateArray['{nav-tabs}'] .= '<table id="dates" class="tablesorter"><thead><tr><th>Status</th><th>Scheduled Start</th><th>Scheduled End</th></thead>
					<tbody>'.$dates.'</tbody></table></fieldset><br /><fieldset class="highlight-upd" style="display:'.$disp.';">
					<legend class="highlight-upd">Submit Attendance and add to CPD record</legend>
					<p>In order to record your attendance and submit this event to your CPD record, please fill in the following details.</p>
					<p>'.drawTxtBox("q1", $q1, "What were the three main things you learnt from the event?", "", "textbox").'</p>
					<p>'.drawTxtBox("q2", $q2, "Does this differ from your previous knowledge of these areas?", "", "textbox").'</p>
					<p>'.drawTxtBox("q3", $q3, "Do you see any value in the knowledge gained, is it accurate and why?", "", "textbox").'</p>
					<p>'.drawTxtBox("q4", $q4, "Will this new knowledge change your practice?", "", "textbox").'</p>
					<p>'. drawFld("submit", "submit-feedback-conf", "Submit Feedback and Add to CPD record", "", "submit").'
					<input type="button" class="submit-cancel" name="cancel" value="Cancel" /></p>
					</fieldset>';
                } else {
                    $templateArray['{nav-tabs}'] .= '<table id="dates" class="tablesorter"><thead><tr><th>Status</th><th>Presenter</th><th>Scheduled Start</th>
					<th>Scheduled End</th></thead><tbody>'.$dates.'</tbody></table></fieldset><br />
					<fieldset class="highlight-upd" style="display:'.$disp.';"><legend class="highlight-upd">Submit Attendance and add to CPD record</legend>
					<p>In order to record your attendance and submit this event to your CPD record, please fill in the following details.</p>
					<p>'.drawSelect("rating", $rating_arr, $rating, "Please provide an overall rating for this event", "", "textbox").'</p>
					<p>'.drawTxtBox("feedback", $feedback_comment, "Please provide some feedback to the presenter of this event", "", "textbox").'</p>
					<p>'.drawTxtBox("q1", $q1, "What were the three main things you learnt from the event?", "", "textbox").'</p>
					<p>'.drawTxtBox("q2", $q2, "Does this differ from your previous knowledge of these areas?", "", "textbox").'</p>
					<p>'.drawTxtBox("q3", $q3, "Do you see any value in the knowledge gained, is it accurate and why?", "", "textbox").'</p>
					<p>'.drawTxtBox("q4", $q4, "Will this new knowledge change your practice?", "", "textbox").'</p>
					<p>'. drawFld("submit", "submit-feedback", "Submit Feedback and Add to CPD record", "", "submit").'
					<input type="button" class="submit-cancel" name="cancel" value="Cancel" /></p>
					</fieldset>';
                } //display dates
            } else {
                $templateArray['{nav-tabs}'] = '<div id="loading" style="display:none">loading...</div><div id="calendar"></div>';
            }
        } //end event details
    
        
        //add personal CPD record
        if ($cpe_self_add && userSystemRights($uid, "add_education")) {
            $fext_attr = 'enctype="multipart/form-data"';
            if ($_POST['add-self-record']) { //submit inservice attendance details
                $name = cleanInput($_POST['name']);
                $credits = cleanInput($_POST['credits']);
                $date_start = cleanInput($_POST['date_start']);
                $date_end = cleanInput($_POST['date_end']);
                $q1 = cleanInput($_POST['q1']);
                $q2 = cleanInput($_POST['q2']);
                $q3 = cleanInput($_POST['q3']);
                $q4 = cleanInput($_POST['q4']);
                $q5 = cleanInput($_POST['q5']);
                if ($_FILES['cert']['name']) {
                    $cert = makeRandom().'.'.getExt($_FILES['cert']['name']);
                }
                    
                if (!$name) {
                    $errs[] = 'You must enter the name of the activity to record it in your CPD history.';
                }
                if (!$errs) {
                    if ($_FILES['cert']['name']) {
                        move_uploaded_file($_FILES['cert']['tmp_name'], $ud.$cert);
                    }
                    $q_ins = sql("INSERT INTO `user_education` (`uid`) VALUES ('".$uid."')");
                    $last_id  = mysqli_insert_id($conn);
                    $q_ins_ue = sql("INSERT INTO `user_education_ext` (`ueid`, `name`,`date_start`, `date_end`, `credits`, `certificate`, `q1`, `q2`, `q3`, `q4`, `q5`) VALUES ('".$last_id."', '".$name."', '".$date_start."', '".$date_end."', '".$credits."', '".$cert."', '".$q1."','".$q2."','".$q3."','".$q4."','".$q5."')");
                    if ($q_ins && $q_ins_ue) {
                        $templateArray['{message}'] = "<h1>Learning & Education</h1><p>Please wait as your CPD record is updated...</p>";
                        $templateForward = 'learning-and-education&o=cpd';
                    } else {
                        $errs[] = sysMsg(8);
                    }
                }	//if(!$errs
            } //$post
            
            //do dates
            if ($date_start) {
                $date_s = new DateTime($date_start);
                $ds_date = $date_s->format('Y-m-d');
                $hs_date = $date_s->format('H');
                $is_date = $date_s->format('i');
            } else {
                $date_s = new DateTime('now');
                $ds_date = $date_s->format('Y-m-d');
                $hs_date = $date_s->format('H');
                $is_date = $date_s->format('i');
            }
            if ($date_end) {
                $date_e = new DateTime($date_end);
                $de_date = $date_e->format('Y-m-d');
                $he_date = $date_e->format('H');
                $ie_date = $date_e->format('i');
            } else {
                $date_e = new DateTime('now');
                $de_date = $date_e->format('Y-m-d');
                $he_date = $date_e->format('H');
                $ie_date = $date_e->format('i');
            }
            
            $templateArray['{dates}'] .= "$('#date_start').datetimepicker({ dateFormat: 'yy-mm-dd', defaultDate: '".$ds_date."', hour: '".$hs_date."', minute: '".$is_date."' });";
            $templateArray['{dates}'] .= "$('#date_end').datetimepicker({ dateFormat: 'yy-mm-dd', defaultDate: '".$de_date."', hour: '".$he_date."', minute: '".$ie_date."' });";
            
            //do inputs
            $templateArray['{nav-tabs}'] .= '
			<h1>Event Details</h1>
			<p>Fill out the below details to record a personal education event to your CPD record.</p>
			<p>'.drawFld("text", "name", $name, "Activity Name").'</p>
			<p>'.drawFld("text", "credits", $credits, "Credit Points").'</p>
			<p><label>Start Date</label><input type="text" id="date_start" name="date_start" value="'.$ds_date.' '.$hs_date.':'.$is_date.'" class="datetime" /></p>
			<p><label>End Date</label><input type="text" id="date_end" name="date_end" value="'.$de_date.' '.$he_date.':'.$ie_date.'" class="datetime" /></p>
			<p>'.drawFld("file", "cert", '', "Certificate").'</p>
			<h1>Reflective Summary</h1>
			<p>'.drawTxtBox("q1", $q1, "What were the three main things you learnt from the event?", "", "textbox").'</p>
			<p>'.drawTxtBox("q2", $q2, "Does this differ from your previous knowledge of these areas?", "", "textbox").'</p>
			<p>'.drawTxtBox("q3", $q3, "Do you see any value in the knowledge gained, is it accurate and why?", "", "textbox").'</p>
			<p>'.drawTxtBox("q4", $q4, "Will this new knowledge change your practice?", "", "textbox").'</p>
			<p>'.drawTxtBox("q5", $q5, "Who facilitated the course or workshop and what was the subject area?", "", "textbox").'</p>
			<p>'. drawFld("submit", "add-self-record", "Add to CPD record", "", "submit").'</p>';
        } // add personal CPD record
        
        
        //add personal CPD record
        if ($cpd_summary) {
            if ($_POST['cpd-summary']) { //submit date range for report
                $date_start = cleanInput($_POST['date_start']);
                $date_end = cleanInput($_POST['date_end']);
                $start_d = strtotime($date_start);
                $end_d = strtotime($date_end);
                if (!$errs) {
                    $templateArray['{message}'] = "<h1>Learning & Education</h1><p>Please wait as your CPD Summary is generated...</p>";
                    $templateForwardAPI = 'api/cpd-summary.php?uid='.$uid.'&s='.$start_d.'&d='.$end_d.'&id='.$sid;
                }	//if(!$errs
            } //$post
            
            //do dates
            if ($date_start) {
                $date_s = new DateTime($date_start);
                $ds_date = $date_s->format('Y-m-d');
            } else {
                $date_s = new DateTime('now');
                $ds_date = $date_s->format('Y-m-d');
            }
            if ($date_end) {
                $date_e = new DateTime($date_end);
                $de_date = $date_e->format('Y-m-d');
            } else {
                $date_e = new DateTime('now');
                $de_date = $date_e->format('Y-m-d');
            }
            
            $templateArray['{dates}'] = "$('#date_start').datepicker({ dateFormat: 'yy-mm-dd', defaultDate: '".$ds_date."' });";
            $templateArray['{dates}'] .= "$('#date_end').datepicker({ dateFormat: 'yy-mm-dd', defaultDate: '".$de_date."' });";
            
            //do inputs
            $templateArray['{nav-tabs}'] .= '
			<h1>CPD Summary</h1>
			<p>Please select the date range for your CPD Summary</p>
			<p><label>Start Date</label><input type="text" id="date_start" name="date_start" value="'.$ds_date.'" class="datetime" /></p>
			<p><label>End Date</label><input type="text" id="date_end" name="date_end" value="'.$de_date.'" class="datetime" /></p>
			<p>'. drawFld("submit", "cpd-summary", "Generate CPD Summary", "&nbsp;", "submit").'</p>';
        } // cpd summary
    } //userSystemRights
    
    //end
    $templateArray['{fhead}'] = '<form method="post" action="'.WEBSITE_LOC.'?p=learning-and-education&o='.$lvl2.'&v='.$fext.'" '.$fext_attr.'>';
    $templateArray['{fend}'] = '</form>';
    if (!$success) {
        $templateArray['{success}'] = '';
    } else {
        $templateArray['{success}'] = '<div class="errors">'.writeMsgs($success, "success").'</div>';
    }
    if (!$errs) {
        $templateArray['{error}'] = '';
    } else {
        $templateArray['{error}'] = writeMsgs($errs);
    }
    if (!$templateArray['{d_nav}']) {
        $templateArray['{d_nav}'] = 'block';
    }
    if (!$templateArray['{nav-tabs}']) {
        $templateArray['{nav-tabs}'] = '';
    }
    if (!$templateArray['{dates}']) {
        $templateArray['{dates}'] = '';
    }
    if (!$templateArray['{ck}']) {
        $templateArray['{ck}'] = '';
    }
    if (!$templateArray['{go_back}']) {
        $templateArray['{go_back}'] = '';
    }
    $templateArray['{uid}'] = $uid;
}
