<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
include('_modules/standard_arrays.php');
$ud = SERVER_PATH.'/'.UPLOAD_DIR.'files/_checklists/';

//get type data if passed and validate for mdule type
$type_id = cleanNumber($_GET['t']); $mach_id = cleanNumber($_GET['mid']);
$q_type = sql("SELECT `id`, `custom` FROM `type_list` WHERE `id` = '".$type_id."' AND `group` = 'chkl_type'");
$c_type = mysqli_num_rows($q_type);


//apply where clause
if ($c_type) {
    $r_type = mysqli_fetch_assoc($q_type);
    $type_list_name = $r_type['custom'];
    $typ_sql = "AND tl.id = '".$type_id."'";
}

if ($_POST['submit']) {
    $templateArray['{check_list}'] = 'block';
    $u = cleanString($_POST['uname']);
    $p = cleanString($_POST['pass']);
    $unit_sel = cleanString($_POST['unit-sel']);
    $machineid = cleanString($_POST['machineid']);
    $subject = cleanString($_POST['subject']);
    $category = cleanString($_POST['category']);
    $id = userAuthOnce($u, $p);
    if ($id) {
        if (userSystemRights($id, "submit_qi")) {
            //get question array
            $q_ques = sql("SELECT `id`, `question` FROM `qi_q` WHERE `feid` = '".$lvl2."' ORDER BY `order` ASC");
            while ($r_cl = mysqli_fetch_assoc($q_ques)) {
                $ques[''.$r_cl['id'].''] = $r_cl['question'];
            }
            $date_now = new DateTime('now');
            $date_now = $date_now->format('Y-m-d H:i:s');
            $q_ins = sql("INSERT INTO `qi_responses` (`feid`, `date`,`uid`, `mid`, `unit`, `status`, `subject`, `category`) VALUES ('".$lvl2."', '".$date_now."', '".$id."', '".$machineid."', '".$unit_sel."', '100', '".$subject."', '".$category."')");
            $last_id  = mysqli_insert_id($conn);
            
            foreach ($_POST['q'] as $k=>$v) {
                
                //record options if exists
                if (is_array($v)) {
                    $v = '';
                    foreach ($_POST['q'][$k] as $o => $r) {
                        $v .= $o.',';
                        //for emails only
                        $q_ans = sql("SELECT `option` FROM `qi_q_ext` WHERE `id` = '".$o."'");
                        $r_ans = mysqli_fetch_assoc($q_ans);
                        $ansr .= $r_ans['option'].', ';
                    }
                    $v = substr($v, 0, -1);
                    $ans = substr($ansr, 0, -2);
                } else {
                    $v = cleanInput($v);
                    if (($typ[$k] == 'singleselect') || ($typ[$k] == 'checkbox') || ($typ[$k] == 'multipleselect') || ($typ[$k] == 'radio')) {
                        $q_ans1 = sql("SELECT `option` FROM `qi_q_ext` WHERE `id` = '".$v."'");
                        $c_ans = mysqli_num_rows($q_ans1);
                        if ($c_ans) {
                            $r_ans1 = mysqli_fetch_assoc($q_ans1);
                            $ans = $r_ans1['option'];
                        } else {
                            $ans = $v;
                        }
                    } else {
                        $ans = $v;
                    }
                }
                
                $ins_build .= "('".$last_id."','".$k."','".cleanInput($v)."'),";
                if (array_key_exists($k, $ques)) {
                    if (!$v && !$ans) {
                        $ans = 'No response recorded';
                    }
                    if (!$ans) {
                        $ans = $v;
                    }
                    $results .= '<p><strong>'.$ques[$k].':</strong> '.$ans.'</p>';
                }
                $ans = '';
                $ansr = '';
                $v = '';
            }
            
            foreach ($_FILES['q']['name'] as $k=>$v) {
                //add support for multiple files
                foreach ($_FILES['q']['name'][$k] as $k2=>$v2) {
                    $img_link = '';
                    $nImg_src = '';
                    $rImg_src = '';
                    
                    if ($_FILES['q']['name'][$k][$k2]) {
                        $ext = getExt($_FILES['q']['name'][$k][$k2]);
                        $fn = date("d-m-Y-", time()).$_FILES['q']['name'][$k][$k2];
                        if (($ext == 'jpg') || ($ext == 'gif')) {
                            move_uploaded_file($_FILES['q']['tmp_name'][$k][$k2], $ud.$fn);
                            list($nImg_src, $rImg_src) = img_upload($fn, $ud, 1000, 1);
                            if ($rImg_src) {
                                $img_link = $rImg_src;
                            } else {
                                $img_link = $nImg_src;
                            }
                            $ins_build .= "('".$last_id."','".$k."','".$img_link."'),";
                            if (AWS_STORAGE) {
                                $payload = file_get_contents(WEBSITE_LOC.'api/aws-s3/upload.php?objectname='.$img_link.'&objectsource=checklists');
                            }
                        } else {
                            move_uploaded_file($_FILES['q']['tmp_name'][$k][$k2], $ud.$fn);
                            chmod($ud.$fn, 0777);
                            $ins_build .= "('".$last_id."','".$k."','".$fn."'),";
                            if (AWS_STORAGE) {
                                $payload = file_get_contents(WEBSITE_LOC.'api/aws-s3/upload.php?objectname='.$fn.'&objectsource=checklists');
                            }
                        }
                    } else {
                        $ins_build .= "('".$last_id."','".$k."','N/A'),";
                    }
                }
            }
            
            if ($ins_build) {
                $ins_build = substr($ins_build, 0, -1);
                $q_ins_r = sql("INSERT INTO `qi_responses_ext` (`frid`,`fqid`,`answer`) VALUES ".$ins_build."");
                //do email
                require_once(SERVER_PATH.'_functions/mailout.php');
                $q_name = sql("SELECT f.name FROM qi f LEFT JOIN qi_ext fe ON fe.fid=f.id WHERE fe.id = '".$lvl2."'");
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
                JOIN qi q ON q.id=un.refid
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
                $tpl = sysMsg(56);
                $tpl_arr['{checklist_header}'] = dateConvert($date_now, 1).' '.$name;
                $tpl_arr['{subject}'] = $subject;
                $tpl_arr['{category}'] = $category;
                $tpl_arr['{results}'] = $results;
                $tpl_arr['{link}'] = '<a href="'.WEBSITE_REF.'?p=checklist-manager&t='.$type_id.'&o=rapidlook&v='.$last_id.'">Click here</a>';
                $tpl_arr['{company}'] = EMAIL_COMPANY;
                $tpl_arr['{year}'] = date("Y", time());
                foreach ($tpl_arr as $k=>$v) {
                    $ks[] = $k;
                    $vs[] = $v;
                }
                $html = str_replace($ks, $vs, $tpl);
                q_smtpmailer($to_list, NO_REPLY_EMAIL, WEBSITE_OWNER, $name, $html, $date_now, MAIL_SEND_CODE);
                //email
                if (!$type_list_name) {
                    $type_list_name = 'Checklists';
                }
                if ($q_ins_r) {
                    $templateArray['{message}'] = "<h1>".$type_list_name."</h1><p>Thank you your response has been successfully submitted.</p><p>Please wait...</p>";
                    $templateForward = 'checklist-manager&t='.$type_id;
                } else {
                    $err[] = sysMsg(8);
                }
            }
        } else {
            $err[] = sysMsg(18);
        } //user system rights
    } else {
        $err[] = sysMsg(5);
    }//user auth
} //post

//Apply usr unit filtering and access
if ($usr_unit == 0) {
    $sql_unit = "";
} else {
    $sql_unit = "AND `unit` IN (".$usr_unit.",0)";
}
//get all the faults
$q_faults = sql("SELECT fe.id AS ext_id, f.name, f.status, fe.status, f.type_id, f.unit, f.mids FROM qi f LEFT JOIN qi_ext fe ON fe.fid=f.id LEFT JOIN type_list tl ON f.type_id=tl.id WHERE f.status = '1' AND fe.status = '1' ".$typ_sql." ".$sql_unit." ORDER BY f.name ASC");
$c_faults = mysqli_num_rows($q_faults);
if (!$c_faults) {
    $templateArray['{checklists}'] = 'There are no lists available for selection.';
} else {
    
    while ($r_faults = mysqli_fetch_assoc($q_faults)) {
        //$type_id = $r_faults['type_id'];
        if ($lvl2 == $r_faults['ext_id']) {
            $sel = 'selected=selected';
        } else {
            $sel = '';
        }
        if ($lvl2) {
            $data .= '<option value="'.WEBSITE_REF.'?p=checklist-manager&t='.$r_faults['type_id'].'&o='.$r_faults['ext_id'].'" '.$sel.'>'.$r_faults['name'].'</option>';
        } else {        
            $data .= '
            <div class="accordionItem close">
            <h2 class="accordionItemHeading">'.$r_faults['name'].'</h2>';
            
            //do for machine data
            if ($r_faults['mids']) {
                $machd = '';
                $mids = str_replace(';',',',$r_faults['mids']);
                $q_mids = sql("SELECT `id`, `name` FROM `machines` WHERE `id` IN (".$mids.")");
                while ($r_mids = mysqli_fetch_assoc($q_mids)) {
                    $machd .= '<p><a href="'.WEBSITE_REF.'?p=checklist-manager&t='.$r_faults['type_id'].'&o='.$r_faults['ext_id'].'&mid='.$r_mids['id'].'"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/add.gif" /> '.$r_mids['name'].'</a></p>';
                }
                $itemcontent = '<p>Add a new checklist report for:</p>'.$machd;
                
            } else {
                $itemcontent = '<p><a href="'.WEBSITE_REF.'?p=checklist-manager&t='.$r_faults['type_id'].'&o='.$r_faults['ext_id'].'"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/add.gif" /> Add a new checklist report</a></p>';
            }
            $data .= '<div class="accordionItemContent">'.$itemcontent.'</div></div>';
        }   
    }
    if($lvl2) {
        $templateArray['{checklists}'] = '<label>Selected Checklist</label><select id="faults" class="marginb" disabled><option value="'.WEBSITE_REF.'?p=checklist-manager&t='.$type_id.'">Please Select...</option>'.$data.'</select>';
    } else {
        $templateArray['{checklists}'] = '<p>Pleaase select a checklist to report on: </p><div class="accordionWrapper">'.$data.'</div>';
    }

    if($mach_id) {
        $q_machs = sql("SELECT `id`, `name` FROM `machines` WHERE `id` = '".$mach_id."'");
        $r_machs = mysqli_fetch_assoc($q_machs);
        $templateArray['{checklists}'] .= '<br /><label>Selected Machine</label><p>'.$r_machs['name'].'<input type="hidden" name="machineid" value="'.$r_machs['id'].'" /></p>';
    } 
    
    
    $templateArray['{checklist-manager}'] = ' class="selected"';
}

//do report
if (!is_numeric($lvl2)) {
    $templateArray['{system-block}'] = 'none';
} else {
    $templateArray['{checklist-manager}'] = ' class="selected"';
            
    //load checklist table
    $q_cl = sql("SELECT * FROM `qi_q` WHERE `feid` = '".$lvl2."' ORDER BY `order` ASC");
    $c_cl = mysqli_num_rows($q_cl);
    if (!$c_cl) {
        $templateArray['{system-block}'] = 'none';
        $err[] = sysMsg(4);
    } else {
        //do common
        $templateArray['{check_list}'] = 'block';
        $date = new DateTime('now');
        $d_date = $date->format('Y-m-d');
        $h_date = $date->format('H');
        $i_date = $date->format('i');
                
        //Apply usr unit filtering and access
        //get units
        $q_unit = sql("SELECT * FROM `type_list` WHERE `group` = 'units' ORDER BY `name` ASC");
        $unit_arr['all'] = 'All Units';
        while ($r_unit = mysqli_fetch_assoc($q_unit)) {
            $unit_arr[$r_unit['id']] = $r_unit['name'];
        }
                
        //get unit info
        $q_qi_u = sql("SELECT f.unit FROM qi f LEFT JOIN qi_ext fe ON fe.fid=f.id WHERE fe.id = '".$lvl2."'");
        $r_qi_u = mysqli_fetch_assoc($q_qi_u);
                
        //enable unit selection based on conditions
        if ($r_qi_u['unit'] && $usr_unit == '0') {
            $out = '<p>'.drawSelect("unit-sel", $unit_arr, $usr_unit, "Please select a unit").'</p>';
        } elseif ($r_qi_u['unit']) {
            $out = '<p>'.drawSelect("unit-sel-dis", $unit_arr, $usr_unit, "Please select a unit", "", "", 1).'<input name="unit-sel" type="hidden" value="'.$usr_unit.'" /></p>';
        } else {
            $out = '<p>'.drawSelect("unit-sel", $unit_arr, $usr_unit, "Please select a unit").'</p>';
        }
        
        //do subject and comments
         $out .= '<p><label>Subject</label><input type="text" name="subject" value="'.$subject.'" /></p>';
         $out .= '<p><label>Category</label><input type="text" name="category" value="'.$category.'" /></p>';

        //do question data out
        while ($r_cl = mysqli_fetch_assoc($q_cl)) {
            if (array_key_exists($r_cl['id'], $_POST['q'])) {
                $val = $_POST['q'][''.$r_cl['id'].''];
            } else {
                $val = '';
            }
            //do date
            if ($r_cl['type'] == 'date') {
                if ($val) {
                    $date = new DateTime($val);
                    $d_date = $date->format('Y-m-d');
                    $h_date = $date->format('H');
                    $i_date = $date->format('i');
                }
                $out .= '<p><label>'.$r_cl['question'].'</label><input type="text" id="q'.$r_cl['id'].'" name="q['.$r_cl['id'].']" value="" class="date" /></p>';
                $templateArray['{dates}'] .= "$('#q".$r_cl['id']."').datepicker({ dateFormat: 'yy-mm-dd', defaultDate: '".$d_date."' });";
            }
            //do date and time
            if ($r_cl['type'] == 'datetime') {
                if ($val) {
                    $date = new DateTime($val);
                    $d_date = $date->format('Y-m-d');
                    $h_date = $date->format('H');
                    $i_date = $date->format('i');
                }
                $out .= '<p><label>'.$r_cl['question'].'</label><input type="text" id="q'.$r_cl['id'].'" name="q['.$r_cl['id'].']" value="'.$d_date.' '.$h_date.':'.$i_date.'" class="datetime" /></p>';
                $templateArray['{dates}'] .= "$('#q".$r_cl['id']."').datetimepicker({ dateFormat: 'yy-mm-dd', defaultDate: '".$d_date."', hour: '".$h_date."', minute: '".$i_date."' });";
            }
            //do text field
            if ($r_cl['type'] == 'text') {
                $out .= '<p><label>'.$r_cl['question'].'</label><input type="text" name="q['.$r_cl['id'].']" value="'.$val.'" /></p>';
            }
            //do textarea
            if ($r_cl['type'] == 'textarea') {
                $out .= '<p><label>'.$r_cl['question'].'</label><textarea name="q['.$r_cl['id'].']" class="textarea">'.$val.'</textarea></p>';
            }
            //do time
            if ($r_cl['type'] == 'time') {
                $out .= '<p><label>'.$r_cl['question'].'</label><input type="text" id="q'.$r_cl['id'].'" name="q['.$r_cl['id'].']" value="'.$val.'" class="date" /></p>';
                $templateArray['{dates}'] .= "
					$('#q".$r_cl['id']."').timepicker({
						hourMax: 100
					});";
            }
            //do section break
            if ($r_cl['type'] == 'sectionbreak') {
                $out .= '<h1 class="sectionbreak">'.$r_cl['question'].'</h1><input type="hidden" name="q['.$r_cl['id'].']" value="'.$val.'" />';
            }
            //do upload image
            if ($r_cl['type'] == 'image') {
                $out .= '<p><label>'.$r_cl['question'].'</label><input type="file" multiple name="q['.$r_cl['id'].'][]" value="" /></p>';
            }
            //do upload file
            if ($r_cl['type'] == 'upload') {
                $out .= '<p><label>'.$r_cl['question'].'</label><input type="file" multiple name="q['.$r_cl['id'].'][]" value="" /></p>';
            }
                    
            //do for all options lists
            if (($r_cl['type'] == 'checkbox') || ($r_cl['type'] == 'radio') || ($r_cl['type'] == 'singleselect') || ($r_cl['type'] == 'multipleselect')) {
                $q_opts = sql("SELECT * FROM `qi_q_ext` WHERE `feqid` = '".$r_cl['id']."' ORDER BY `option` ASC");
            }
                    
            //do for all options lists
            if ($r_cl['type'] == 'checkbox') {
                while ($r_opts = mysqli_fetch_assoc($q_opts)) {
                    if (array_key_exists($r_opts['id'], $_POST['q'][''.$r_cl['id'].''])) {
                        $chkd = "checked=checked";
                    } else {
                        $chkd = '';
                    }
                    $opts .= '<div class="chkopts"><label class="italics">'.$r_opts['option'].'</label><input type="checkbox" name="q['.$r_cl['id'].']['.$r_opts['id'].']" value="1" class="chk" '.$chkd.' /></div>';
                }
                $out .= '<div><p class="italics">'.$r_cl['question'].'</p><div class="optionsbox">'.$opts.'</div></div><div class="clear">&nbsp;</div>';
                $opts = '';
            }
            if ($r_cl['type'] == 'radio') {
                while ($r_opts = mysqli_fetch_assoc($q_opts)) {
                    if ($_POST['q'][''.$r_cl['id'].''] == $r_opts['id']) {
                        $chkd = "checked=checked";
                    } else {
                        $chkd = '';
                    }
                    $opts .= '<div class="chkopts"><label class="italics">'.$r_opts['option'].'</label><input type="radio" name="q['.$r_cl['id'].']" value="'.$r_opts['id'].'" class="chk" '.$chkd.' /></div>';
                }
                $out .= '<div><p class="italics">'.$r_cl['question'].'</p><div class="optionsbox">'.$opts.'</div></div><div class="clear">&nbsp;</div>';
                $opts = '';
            }
            if ($r_cl['type'] == 'singleselect') {
                while ($r_opts = mysqli_fetch_assoc($q_opts)) {
                    if ($_POST['q'][''.$r_cl['id'].''] == $r_opts['id']) {
                        $sel = "selected=selected";
                    } else {
                        $sel = '';
                    }
                    $opts .= '<option value="'.$r_opts['id'].'" '.$sel.'>'.$r_opts['option'].'</option>';
                }
                $out .= '<div><p><label class="label">'.$r_cl['question'].'</label>
						<select name="q['.$r_cl['id'].']"><option value="">Please select...</option>'.$opts.'</select></p></div>';
                $opts = '';
            }
        } //while
        $templateArray['{out}'] = $out.'<p>
				<fieldset style="margin-top: 20px"><legend>Sign off</legend><p>'.drawFld("text", "uname", $input, "Username").'</p>
				<p>'.drawFld("password", "pass", "", "Password").'</p></fieldset>
				'.drawFld("submit", "submit", "Submit", "", "submit").'</p>';
    }
}

if ($lvl2 == 'rapidlook') {
    $templateArray['{rapidlook}'] = ' class="selected"';
    $templateArray['{checklist-manager}'] = '';
    $templateArray['{rlblock}'] = 'block';

    //do if any of the faults in the list have machines
    if ($usr_unit == 0) {
        $sql_limit = "";
    } else {
        $sql_limit = "AND fr.unit = '".$usr_unit."'";
    }
   
    $q_mlist = sql("SELECT fr.mid FROM qi_responses fr LEFT JOIN qi_ext fe ON fr.feid=fe.id LEFT JOIN qi f ON fe.fid=f.id LEFT JOIN user_ext ue ON ue.uid=fr.uid LEFT JOIN type_list tl ON f.type_id=tl.id WHERE f.status IN (0,1) AND  fr.mid > 0 ".$typ_sql." ".$sql_limit." ORDER BY fr.date DESC");
    $machines = mysqli_num_rows($q_mlist);
    if($machines) {
        $templateArray['{rlblockmachines}'] = 'block';
        //get machine list
		$q_mach = sql("SELECT * FROM `machines` WHERE `active` = '1'");
		$c_mach = mysqli_num_rows($q_mach);
		if($c_mach) {
			while($r_mach = mysqli_fetch_assoc($q_mach)) {
				$mach_builder .= '
				<div class="filters">
					<span class="filter-labels">'.$r_mach['name'].'</span>
					<input type="checkbox" name="machine['.$r_mach['id'].']" value="'.$r_mach['id'].'" class="chk" onclick="machines()">
				</div>';
			}
			$templateArray['{machinefilter}'] = $mach_builder;
		} //machine list
    }
    //get status lists
    $q_stat = sql("SELECT `id`, `name` FROM `type_list` WHERE `group` = 'mach_stat' ORDER BY `id`");
    while ($r_stat = mysqli_fetch_assoc($q_stat)) {
        $stat[$r_stat['id']] = $r_stat['name'];
        $stat_builder .= '
				<div class="filters">
					<span class="filter-labels">'.$r_stat['name'].'</span>
					<input type="checkbox" id="'.$r_stat['id'].'" name="status['.$r_stat['id'].']" value="'.$r_stat['id'].'" class="chk" onclick="stat()">
				</div>';
    }
    $templateArray['{statusfilter}'] = $stat_builder;

                    
    if ($lvl3) { //do details
        $templateArray['{go_back}'] = goBack(WEBSITE_REF.'?p=checklist-manager&t='.$type_id.'&o='.$lvl2);
        
        if (!is_numeric($lvl3)) {
            $templateArray['{checklists}'] = '';
            $err[] = sysMsg(4);
        } else {
            $templateArray['{rlblock}'] = '';
            $fext = $lvl3;
        
            $date_now = new DateTime('now');
            $date_now = $date_now->format('Y-m-d H:i:s');
        
            //do updating of fault status
            if (userSystemRights($uid, "close_qi")) {
                if ($_POST['close_fault']) {
                    $fault_key = key($_POST['close_fault']);
                    $q_comments = sql("SELECT `comments` FROM `qi_responses` WHERE `id` = '".$lvl3."'");
                    $c_comments = mysqli_num_rows($q_comments);
                    if ($c_comments) {
                        $r_comments = mysqli_fetch_assoc($q_comments);
                        $comments = $r_comments['comments'].'\n'.$date_now.' Fault status updated to: '.$_POST['close_fault'][$fault_key].', '.userName($uid);
                    }
                    $q_cls_fault = sql("UPDATE `qi_responses` SET `status` = '".$fault_key."', `comments` = '".$comments."' WHERE `id` = '".$lvl3."'");
                    if ($q_cls_fault) {
                        $success[] = "Status updated successfully!";
                    } else {
                        $err[] = sysMsg(8);
                    }
                }
                if ($stat) {
                    foreach ($stat as $k=>$v) {
                        $fault_close .= drawFld("submit", "close_fault[".$k."]", $v, "", "submit").' ';
                    }
                }
                $fault_close = '<div>'.$fault_close.'</div>';
            }
        
            if ($_POST['upd-details']) {
                $post_qa = $_POST['post_qa'];
                $subject = cleanInput($_POST['subject']);
                $comments = cleanInput($_POST['comments']);
                $engineer = cleanInput($_POST['engineer']);
                $released = cleanInput($_POST['released']);
                $released_to = cleanInput($_POST['released_to']);
                
                foreach ($_FILES['file']['name'] as $k3 => $v3) {
                    $fn = '';
                    $ext = '';
                    if ($_FILES['file']['name'][$k3]) {
                        $ext = getExt($_FILES['file']['name'][$k3]);
                        $fn = date("d-m-Y-", time()).$_FILES['file']['name'][$k3];
                        move_uploaded_file($_FILES['file']['tmp_name'][$k3], $ud.$fn);
                        chmod($ud.$fn, 0777);
                        if (AWS_STORAGE) {
                            $payload = file_get_contents(WEBSITE_LOC.'api/aws-s3/upload.php?objectname='.$fn.'&objectsource=checklists');
                        }
                        $q_files = sql("SELECT `files` FROM `qi_responses` WHERE `id` = '".$lvl3."'");
                        $c_files = mysqli_num_rows($q_files);
                        if ($c_files) {
                            $r_files = mysqli_fetch_assoc($q_files);
                            $prev_files = $r_files['files'];
                            if ($prev_files) {
                                $files = $prev_files.';'.$fn;
                            } else {
                                $files = $fn;
                            }
                        } else {
                            $files = $fn;
                        }
                        $q_upd_files = sql("UPDATE `qi_responses` SET `files` = '".$files."' WHERE `id` = '".$lvl3."'");
                        $comments_ext = '\n'.$date_now.' Resolution Document '.$fn.' has been uploaded.';
                    }
                }
                        
                        
                $q_comments = sql("SELECT `comments` FROM `qi_responses` WHERE `id` = '".$lvl3."'");
                $c_comments = mysqli_num_rows($q_comments);
                if ($c_comments) {
                    $r_comments = mysqli_fetch_assoc($q_comments);
                    $prev_comments = $r_comments['comments'];
                    if ($comments) {
                        $comments = $prev_comments.'\n'.dateConvert($date_now, 1).' '.$comments.$comments_ext;
                    } else {
                        $comments = $prev_comments.$comments_ext;
                    }
                } else {
                    $comments = dateConvert($date_now, 1).' '.$comments.$comments_ext;
                }
                $q_upd = sql("UPDATE `qi_responses` SET `post_qa` = '".$post_qa."', `comments` = '".$comments."', `subject` = '".$subject."', `engineer` = '".$engineer."', `released` = '".$released."', `released_to` = '".$released_to."' WHERE `id` = '".$lvl3."'");
                if ($q_upd) {
                    if (!$type_list_name) {
                        $type_list_name = 'Checklists';
                    }
                    $templateArray['{message}'] = "<h1>".$type_list_name."</h1><p>Thank you the Resolution details have been updated successfully.</p><p>Please wait...</p>";
                    $templateForward = 'checklist-manager&t='.$type_id.'&o=rapidlook&v='.$lvl3;
                } else {
                    $err[] = sysMsg(8);
                }
            }


    //do updating of related faults
		if($_POST['rel-fault']) {

            $rel_post = cleanString($_POST['rel_fault_opts']);
			//do first fault relationship
			$q_rel = sql("SELECT `related_faults` FROM `qi_responses` WHERE `id` = '".$lvl3."'");
			$c_rel = mysqli_num_rows($q_rel);
			if($c_rel) {
				$r_rel = mysqli_fetch_assoc($q_rel);
				if($r_rel['related_faults']) {
					$prev_rel = explode(';',$r_rel['related_faults']);
					if($_POST['rel_fault_opts']) {	$prev_rel[] = $rel_post;	}
					$rel = implode(';',$prev_rel);
				} else {
					if($rel_post) { $rel = $rel_post;	}
				}
			}
			if($rel) {
				$q_upd_rel = sql("UPDATE `qi_responses` SET `related_faults` = '".$rel."' WHERE `id` = '".$lvl3."'");
			}
			//do other fault relationship
			$q_rel = sql("SELECT `related_faults` FROM `qi_responses` WHERE `id` = '".$rel_post."'");
			$c_rel = mysqli_num_rows($q_rel);
				if($c_rel) {
					$r_rel = mysqli_fetch_assoc($q_rel);
					if($r_rel['related_faults']) {
						$prev_rel = explode(';',$r_rel['related_faults']);
						if($lvl3) {	$prev_rel[] = $lvl3;	}
						$rel = implode(';',$prev_rel);
					} else {
						if($lvl3) { $rel = $lvl3;}
					}
				if($rel) {
					$q_upd_rel = sql("UPDATE `qi_responses` SET `related_faults` = '".$rel."' WHERE `id` = '".$rel_post."'");
				}
			}
			if($q_upd_rel) { 
				$success[] = "Related faults updated successfully!";
			} else { $err[] = sysMsg(8); }
		}

        
            $q_details = sql("SELECT fr.id, fr.status, fr.unit, fr.comments, fr.subject, fr.category, fr.files, fr.date, fr.post_qa, fr.engineer,fr.related_faults, fr.released,fr.released_to, fr.mid, ue.fname, ue.lname FROM qi_responses fr LEFT JOIN qi_ext fe ON fr.feid=fe.id LEFT JOIN qi f ON fe.fid=f.id LEFT JOIN user_ext ue ON ue.uid=fr.uid WHERE fr.id = '".$lvl3."'");
            $c_details = mysqli_num_rows($q_details);
            if (!$c_details) {
                $templateArray['{checklists}'] = '';
                $err[] = sysMsg(4);
            } else {
                $templateArray['{check_details}'] = 'block';
                $r_details = mysqli_fetch_assoc($q_details);
                $templateArray['{checklists}'] = '';
                $templateArray['{reported_by}'] = '<label>Reported By</label>'.$r_details['fname'].' '.$r_details['lname'];
                $templateArray['{reported_date}'] = '<label>Date Reported</label>'.dateConvert($r_details['date'], 1);
                
                if($r_details['mid']) {
                    $q_machs = sql("SELECT `id`, `name` FROM `machines` WHERE `id` = '".$r_details['mid']."'");
                    $r_machs = mysqli_fetch_assoc($q_machs);
                    $templateArray['{reported_machine}'] = '<p><label>Machine</label>'.$r_machs['name'].'</p>';
                } else { $templateArray['{reported_machine}'] = ''; }

                if ($r_details['unit'] == 0) {
                    $unit_rl = "All Units";
                } else {
                    $q_typ = sql("SELECT `name` FROM `type_list` WHERE `id` = '".$r_details['unit']."'");
                    $r_typ = mysqli_fetch_assoc($q_typ);
                    $unit_rl = $r_typ['name'];
                }
                $templateArray['{unit}'] = '<label>Unit</label>'.$unit_rl;
                $templateArray['{subject}'] = '<label>Subject</label>'.$r_details['subject'];
                $templateArray['{category}'] = '<label>Category</label>'.$r_details['category'];

                if ($r_details['status'] == '101') {
                    $hidden = true;
                } else {
                    $hidden = false;
                }
                
                $templateArray['{status}'] = '<label>Status</label>'.$stat[''.$r_details['status'].''].$fault_close;
                $prev_comments = $r_details['comments'];
                if ($r_details['files']) {
                    $file_list = explode(';', $r_details['files']);
                    $i = 1;
                    $files_list = '<p style="font-weight:bold;">Uploaded Resolution Documents</p>';
                    foreach ($file_list as $k=>$v) {
                        $file_url = '';
                        if (AWS_STORAGE) {
                            $file_url = WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$v.'&s='.$sid;
                        } else {
                            $file_url = WEBSITE_LOC.UPLOAD_DIR.'files/_checklists/'.$v;
                        }
                        
                        $files_list .= '<p><label>Document '.$i.'</label><a href="'.$file_url.'" target="_blank"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/doc.gif" /> '.$v.'</a></p>';
                        $i++;
                    }
                    $templateArray['{files}'] = $files_list;
                } else {
                    $templateArray['{files}'] = '';
                }
                
                if (!$_POST['upd-details']) {
                    $subject = $r_details['subject'];
                    $category = $r_details['category'];
                    $post_qa = $r_details['post_qa'];
                    $engineer = $r_details['engineer'];
                    $released = $r_details['released'];
                    $released_to = $r_details['released_to'];
                    $comments = '';
                }
                if ($prev_comments) {
                    $templateArray['{prev_comments}'] = '<p style="font-weight:bold;">Previous Resolution Details<textarea name="prev_comments" class="textarea" disabled="disabled">'.$prev_comments.'</textarea></p>';
                } else {
                    $templateArray['{prev_comments}'] = '';
                }
                if ($post_qa) {
                    $sel = 'checked="checked"';
                } else {
                    $sel = '';
                }
                if ($hidden) {
                    $disabled = 'disabled="disabled"';
                } else {
                    $disabled = '';
                }
                $templateArray['{subject}'] = drawFld("text", "subject", $subject, "Subject", '', '', $hidden);
                $templateArray['{category}'] = $category;

                $templateArray['{post_qa}'] = '<label>Post QA performed?</label><input type="checkbox" name="post_qa" class="chk" value="1" '.$sel.' '.$disabled.'/>';
                
                $templateArray['{engineer}'] = drawFld("text", "engineer", $engineer, "Engineer", '', '', $hidden);
                $templateArray['{released}'] = drawFld("text", "released", $released, "Released by", '', '', $hidden);
                $templateArray['{released_to}'] = drawFld("text", "released_to", $released_to, "Released to", '', '', $hidden);
                if (!$hidden) {
                    $templateArray['{upd-details}'] = drawFld("submit", "upd-details", "Update Resolution Details", "", "submit");
                    $templateArray['{comments}'] = '<label style="font-weight:bold;">Resolution Details</label><textarea name="comments" class="textarea">'.$comments.'</textarea>';
                    //$templateArray['{file}'] = drawFld("file","file","","File Upload");
                    $templateArray['{file}'] = '<label>File Upload</label><input type="file" multiple name="file[]" value="" />';
                } else {
                    $templateArray['{upd-details}'] = '';
                    $templateArray['{comments}'] = '';
                    $templateArray['{file}'] = '';
                }

                //generate related faults
                $rel_faults = explode(';', $r_details['related_faults']); $rel_fault_list = '';
                if($r_details['related_faults']) {
                    foreach($rel_faults as $k=>$v) {
                        $q_rel_fault = sql("SELECT * FROM qi_responses qr LEFT JOIN user_ext ue ON ue.uid=qr.uid WHERE qr.id = '".$v."'");
                        $r_rel_fault = mysqli_fetch_assoc($q_rel_fault);
                        
                        $int = $i/2;
                        if (is_int($int)) {
                            $tr_style = 'class = "odd"';
                        } else {
                            $tr_style = '';
                        }
                        $rel_fault_list .= '<tr '.$tr_style.'>
                        <td>
                        <a href="'.WEBSITE_LOC.'?p='.$lvl1.'&t='.$type_id.'&o='.$lvl2.'&v='.$v.'">'.$r_rel_fault['id'].'</a>
                        </td>
                        <td><a href="'.WEBSITE_LOC.'?p='.$lvl1.'&t='.$type_id.'&o='.$lvl2.'&v='.$v.'">'.dateConvert($r_rel_fault['date'], 1).'</a>
                        </td>
                        <td>
                        <a href="'.WEBSITE_LOC.'?p='.$lvl1.'&t='.$type_id.'&o='.$lvl2.'&v='.$v.'">'.truncate($r_rel_fault['subject'],30,"...").'</a></td>
                        <td><a href="'.WEBSITE_LOC.'?p='.$lvl1.'&t='.$type_id.'&o='.$lvl2.'&v='.$v.'">'.truncate($r_rel_fault['category'],30,"...").'</a></td>
                        <td><a href="'.WEBSITE_LOC.'?p='.$lvl1.'&t='.$type_id.'&o='.$lvl2.'&v='.$v.'">'.$r_rel_fault['fname'].' '.$r_rel_fault['lname'].'</a></td>
                        </tr>';
                        $i++;

                    }
                    $rel_fault_list = '<br /><table class="tablesorter"><thead><tr><th>ID</th><th>Report Date/Time</th><th>Subject</th><th>Category</th><th>Reported By</th></thead><tbody>'.$rel_fault_list.'</tbody></table>';
                } else { $rel_fault_list = 'There are no related faults'; }
                
                $templateArray['{relatedfaults}'] = $rel_fault_list;

                //get fault ids
                $rllist = str_replace(';',',',$r_details['related_faults']);
                if($rllist) { 
                    $sql_ext = "AND fr.id NOT IN (".$rllist.")";
                } else {
                    $sql_ext = "";
                }
                $q_relf = sql("SELECT fr.id, fr.date, m.name AS mach_name, fr.subject, fr.category FROM qi_responses fr LEFT JOIN qi_ext fe ON fr.feid=fe.id LEFT JOIN qi f ON fe.fid=f.id LEFT JOIN machines m ON fr.mid=m.id WHERE fr.unit = '".$r_details['unit']."' ".$sql_ext." AND fr.id != '".$lvl3."' ORDER BY fr.id DESC");
                while($r_relf = mysqli_fetch_assoc($q_relf)) {
                    if($r_relf['id'] !== $rlid) {
                        if($r_relf['mach_name']) {
                            $mach = ' | '.$r_relf['mach_name'];
                        } else {
                            $mach = '';
                        }
                        $opts .= '<option value="'.$r_relf['id'].'">'.$r_relf['id'].' | '.$r_relf['date'].' | '.truncate($r_relf['subject'], 30).' | '.truncate($r_relf['category'], 30).$mach.'</option>';
                    }
                }
                $templateArray['{relatedfaultsopts}'] = '<select name="rel_fault_opts"><option value="">Please select...</option>'.$opts.'</select>';
                $templateArray['{relatedfaultsubmit}'] = drawFld("submit","rel-fault","Add related checklist report","","submit");
            
                //get responses
                $q_resp = sql("SELECT fre.answer, fq.question, fq.type FROM qi_responses_ext fre LEFT JOIN qi_q fq ON fq.id=fre.fqid WHERE fre.frid = '".$lvl3."' ORDER BY fq.order ASC");
                $c_resp = mysqli_num_rows($q_resp);
                if (!$c_resp) {
                    $templateArray['{checklists}'] = '';
                    $templateArray['{check_details}'] = '';
                    $err[] = sysMsg(4);
                } else {
                    while ($r_resp = mysqli_fetch_assoc($q_resp)) {
                        if (!$r_resp['answer']) {
                            $ans = '&nbsp;';
                        } else {
                            $ans = $r_resp['answer'];
                        }
                            
                        if ($r_resp['type'] == 'image' && $r_resp['answer'] && $r_resp['answer'] !== 'N/A') {
                            $file_url = '';
                            if (AWS_STORAGE) {
                                $file_url = WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$r_resp['answer'].'&s='.$sid;
                            } else {
                                $file_url = WEBSITE_LOC.UPLOAD_DIR.'files/_checklists/'.$r_resp['answer'];
                            }
                        
                            $ans = '<a href="'.$file_url.'" rel="lightbox[qi]"><img src="'.WEBSITE_LOC.UPLOAD_DIR.'files/_checklists/'.$r_resp['answer'].'" height="100" /></a>';
                        }
                    
                        if ($r_resp['type'] == 'upload' && $r_resp['answer'] && $r_resp['answer'] !== 'N/A') {
                            $ext = getExt($r_resp['answer']);
                            if (($ext == 'jpg') || ($ext == 'gif') || ($ext == 'png')) {
                                $rel = 'rel="lightbox[qi]"';
                            } else {
                                $rel = '';
                            }
                        
                            $file_url = '';
                            if (AWS_STORAGE) {
                                $file_url = WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$r_resp['answer'].'&s='.$sid;
                            } else {
                                $file_url = WEBSITE_LOC.UPLOAD_DIR.'files/_checklists/'.$r_resp['answer'];
                            }
                        
                            $ans = '<a href="'.$file_url.'" '.$rel.' target="_blank"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/doc.gif" /> '.$r_resp['answer'].'</a></a>';
                        }
                    
                        if ($r_resp['type'] == 'datetime' && $r_resp['answer']) {
                            $ans = dateConvert($r_resp['answer'], 1);
                        }
                        if ($r_resp['type'] == 'date' && $r_resp['answer']) {
                            $ans = dateConvert($r_resp['answer']);
                        }
                    
                        if ($r_resp['type'] == 'checkbox' || $r_resp['type'] == 'radio' || $r_resp['type'] == 'singleselect' && $r_resp['answer']) {
                            $ansarr = explode(",", $r_resp['answer']);
                            $ansr = '';
                            foreach ($ansarr as $k=>$v) {
                                $q_ans = sql("SELECT `option` FROM `qi_q_ext` WHERE `id` = '".$v."'");
                                $r_ans = mysqli_fetch_assoc($q_ans);
                                $ansr .= $r_ans['option'].', ';
                            }
                            $ans = substr($ansr, 0, -2);
                        }
                        if ($r_resp['type'] == 'sectionbreak') {
                            $rows .= '<h1 class="sectionbreak">'.$r_resp['question'].'</h1>';
                        } else {
                            $rows .= '<div><p><label>'.$r_resp['question'].'</label>'.$ans.'</p></div>';
                        }
                    }
                    $templateArray['{responses}'] = $rows;
                }
            } //$c_details
        } //is_numeric lvl3
    } else { //do standard list
        if ($usr_unit == 0) {
            $sql_limit = "";
        } else {
            $sql_limit = "AND fr.unit = '".$usr_unit."'";
        }
        $q_list = sql("SELECT fr.id, fr.status, fr.date, fr.mid, fr.subject, fr.category, ue.fname, ue.lname FROM qi_responses fr LEFT JOIN qi_ext fe ON fr.feid=fe.id LEFT JOIN qi f ON fe.fid=f.id LEFT JOIN user_ext ue ON ue.uid=fr.uid LEFT JOIN type_list tl ON f.type_id=tl.id WHERE f.status IN (0,1) ".$typ_sql." ".$sql_limit." ORDER BY fr.date DESC");
        $c_list = mysqli_num_rows($q_list);
        if (!$c_list) {
            $templateArray['{checklists}'] = 'There is nothing reported yet.';
        } else {
            $i=2;

            
            while ($r_list = mysqli_fetch_assoc($q_list)) {
                if($machines && $r_list['mid']) {
                   
                    $q_mach_name = sql("SELECT `name` FROM `machines` WHERE `id` = '".$r_list['mid']."'");
                    $r_mach_name = mysqli_fetch_assoc($q_mach_name);
                    $mach_name = $r_mach_name['name'];
                       
                } else {
                    $mach_name = '';
                }
               
                $int = $i/2;
                if (is_int($int)) {
                    $tr_style = 'class = "odd"';
                } else {
                    $tr_style = '';
                }
                $d_row .= '<tr '.$tr_style.'>
                <td>
                <a href="'.WEBSITE_REF.'?p=checklist-manager&t='.$type_id.'&o=rapidlook&v='.$r_list['id'].'">
                '.$r_list['id'].'</a>
                </td>
                <td><a href="'.WEBSITE_REF.'?p=checklist-manager&t='.$type_id.'&o=rapidlook&v='.$r_list['id'].'">'.dateConvert($r_list['date'], 1).'</a>
                </td>';

                if($machines) {
                    $d_row .= '<td>
                    <a href="'.WEBSITE_REF.'?p=checklist-manager&t='.$type_id.'&o=rapidlook&v='.$r_list['id'].'">'.$mach_name.'</a></td>';
                }
                $d_row .= '<td>
                <a href="'.WEBSITE_REF.'?p=checklist-manager&t='.$type_id.'&o=rapidlook&v='.$r_list['id'].'">'.truncate($r_list['subject'],30,"...").'</a></td>
                <td><a href="'.WEBSITE_REF.'?p=checklist-manager&t='.$type_id.'&o=rapidlook&v='.$r_list['id'].'">'.truncate($r_list['category'],30,"...").'</a></td>
                <td><a href="'.WEBSITE_REF.'?p=checklist-manager&t='.$type_id.'&o=rapidlook&v='.$r_list['id'].'">'.$r_list['fname'].' '.$r_list['lname'].'</a></td>
                <td><a href="'.WEBSITE_REF.'?p=checklist-manager&t='.$type_id.'&o=rapidlook&v='.$r_list['id'].'">'.$stat[''.$r_list['status'].''].'</a></td>
                </tr>';
                $i++;
            }
            if (!userSystemRights($uid, "view_qi")) {
                $err[] = sysMsg(17);
                $templateArray['{checklists}'] = '';
            } else {
                $templateArray['{checklists}'] = '<table class="tablesorter" id="rapidlook"><thead><tr><th>ID</th><th>Report Date/Time</th>';
                if($machines) {
                    $templateArray['{checklists}'] .= '<th>Machine</th>';
                }
                $templateArray['{checklists}'] .= '<th>Subject</th><th>Category</th><th>Reported By</th><th>Status</th></thead><tbody>'.$d_row.'</tbody></table>';
            } //end user_rights
        } //$c_lsit
    } //$lvl3
}

list($fhead, $fend) = drawFormTags('p', WEBSITE_REF.'?p='.$lvl1.'&t='.$type_id.'&o='.$lvl2.'&v='.$fext, '', '', true);
$templateArray['{fhead}'] = $fhead; $templateArray['{fend}'] = $fend;
if (!$templateArray['{system-block}']) {
    $templateArray['{system-block}'] = 'none';
}
if (!$templateArray['{error}']) {
    $templateArray['{error}'] = writeMsgs($err);
}
if (!$templateArray['{checklists}']) {
    $templateArray['{checklists}'] = '';
} if (!$templateArray['{m_sel}']) {
    $templateArray['{m_sel}'] = '';
}
if (!$templateArray['{check_list}']) {
    $templateArray['{check_list}'] = 'none';
}
if (!$templateArray['{rapidlook}']) {
    $templateArray['{rapidlook}'] = '';
}
if (!$templateArray['{times}']) {
    $templateArray['{times}'] = '';
} if (!$templateArray['{dates}']) {
    $templateArray['{dates}'] = '';
}
if (!$templateArray['{checklist-manager}']) {
    $templateArray['{checklist-manager}'] = '';
}
if (!$templateArray['{go_back}']) {
    $templateArray['{go_back}'] = '';
}
if (!$templateArray['{check_details}']) {
    $templateArray['{check_details}'] = 'none';
}
if ($success) {
    $templateArray['{success}'] = '<div class="errors">'.writeMsgs($success, "success").'</div>';
} else {
    $templateArray['{success}'] = '';
}
if (!$templateArray['{type}']) {
    $templateArray['{type}'] = $type_id;
}
if (!$templateArray['{head_data}']) {
    if ($c_type) {
        $templateArray['{head_data}'] = $type_list_name;
    } else {
        $templateArray['{head_data}'] = 'Checklists';
    }
}
if (!$templateArray['{rlblock}']) {
    $templateArray['{rlblock}'] = 'none';
}
if (!$templateArray['{rlblockmachines}']) {
    $templateArray['{rlblockmachines}'] = 'none';
}
if(!$templateArray['{statusfilter}']) {
    $templateArray['{statusfilter}'] = '';
}
if(!$templateArray['{machinefilter}']) {
    $templateArray['{machinefilter}'] = '';
}