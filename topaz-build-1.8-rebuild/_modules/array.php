<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
include('standard_arrays.php');

if ($dtype == '15') {
    if ($lvl1 == 'documents') {
        //Folder Data
        $templateArray['{folder}'] = "block";
        $q_subtree = sql("SELECT dp.name, dp.link, dp.doc_type, dpe.pdf, dpe.private, dp.unit, dpe.related_docs FROM document_tree dt, document_properties dp, document_properties_ext dpe WHERE dt.id=dp.did AND dp.did=dpe.did AND dt.parent_id = '1' AND dp.active = '1' ORDER BY dp.name ASC");
        $c_subtree = mysqli_num_rows($q_subtree);
        if ($c_subtree) {
            if (userAuthorise($sid)) {
                $q_usr_grps = sql("SELECT `rid` FROM `user_groups` WHERE `uid` = '".userID($sid)."'");
                $c_usr_grps = mysqli_num_rows($q_usr_grps);
                if ($c_usr_grps) {
                    while ($r_usr_grps = mysqli_fetch_assoc($q_usr_grps)) {
                        $groups[] = $r_usr_grps['rid'];
                    }
                }
            }
            
            $templateArray['{subtree}'] = '<ul id="subtree">';
            while ($r_subtree = mysqli_fetch_assoc($q_subtree)) {
            
            //private folders
                if ($r_subtree['private']) {
                    if (userAuthorise($sid)) {
                        $priv_display = false;
                        $private = explode(';', $r_subtree['private']);
                        foreach ($private as $k=>$v) {
                            if (in_array($v, $groups)) {
                                $priv_display = true;
                            }
                        }
                    } else {
                        $priv_display = false;
                    }
                } else {
                    $priv_display = true;
                }
                //private folders
                $q_temp = sql("SELECT st.link FROM system_templates st, system_templates_ext ste WHERE ste.stid=st.id AND ste.dtid= '".$r_subtree['doc_type']."'");
                $r_temp = mysqli_fetch_assoc($q_temp);
                $class = $r_temp['link'];
                if (!$class) {
                    $class = 'document';
                }
                if (($usr_unit == $r_subtree['unit']) || ($r_subtree['unit'] == '0') || ($usr_unit == '0') || !$usr_unit) {
                    if ($priv_display) {

						if($r_subtree['related_docs']) {
							$rel_docs = ' <a href="'.WEBSITE_REF.'?p='.$r_subtree['link'].'" class="sm_prop">(Related Documents)</a>';
						} else { 
							$rel_docs = '';
						}

						
                        if ($r_subtree['pdf']) {
                            $file_url = '';
                            if (AWS_STORAGE) {
                                $file_url = WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$r_subtree['pdf'].'&s='.$sid;
                            } else {
                                $file_url =	WEBSITE_LOC.UPLOAD_DIR.'files/'.$r_subtree['pdf'].'?'.time();
							}
							
                            $templateArray['{subtree}'] .= '<li><span class="'.$class.'"><a href="'.$file_url.'" target="_blank">'.$r_subtree['name'].'</a>'.$rel_docs.' <a href="'.WEBSITE_LOC.'?p='.$r_subtree['link'].'" class="sm_prop">(Properties)</a></span></li>';
                        } else {
                            $templateArray['{subtree}'] .= '<li><span class="'.$class.'"><a href="'.WEBSITE_LOC.'?p='.$r_subtree['link'].'">'.$r_subtree['name'].'</a>'.$rel_docs.'</span></li>';
                        }
                    }
                } //end if in user category
            }
            $templateArray['{subtree}'] .= '</ul>';
        } else {
            $templateArray['{subtree}'] = 'There are no documents found.';
        }
        $templateArray['{breadcrumb}'] = breadCrumb($doc_id, WEBSITE_LOC);
        $templateArray['{text}'] = replaceText($templateArray, $text);
    } else {
        if (!$text) {
            $err[] = '<p>Oops, looks like the page you are looking for is missing or might be a document assigned as a Wiki Page.<br />Please contact your Systems Administrator to investigate.</p>';
            $text = writeMsgs($err);
        }
        $templateArray['{text}'] = replaceText($templateArray, $text);
    }
} elseif ($dtype == '37') {
    
//Folder Data
    $templateArray['{folder}'] = "block";
    $q_subtree = sql("SELECT dp.name, dp.link, dp.doc_type, dpe.pdf, dpe.private, dp.unit, dpe.related_docs FROM document_tree dt, document_properties dp, document_properties_ext dpe WHERE dt.id=dp.did AND dp.did=dpe.did AND dt.parent_id = '".$doc_id."' AND dp.active = '1' ORDER BY dp.name ASC");
    $c_subtree = mysqli_num_rows($q_subtree);
    if ($c_subtree) {
        if (userAuthorise($sid)) {
            $q_usr_grps = sql("SELECT `rid` FROM `user_groups` WHERE `uid` = '".userID($sid)."'");
            $c_usr_grps = mysqli_num_rows($q_usr_grps);
            if ($c_usr_grps) {
                while ($r_usr_grps = mysqli_fetch_assoc($q_usr_grps)) {
                    $groups[] = $r_usr_grps['rid'];
                }
            }
        }
    
        $templateArray['{subtree}'] = '<ul id="subtree">';
        while ($r_subtree = mysqli_fetch_assoc($q_subtree)) {
    
    //private folders
            if ($r_subtree['private']) {
                if (userAuthorise($sid)) {
                    $priv_display = false;
                    $private = explode(';', $r_subtree['private']);
                    foreach ($private as $k=>$v) {
                        if (in_array($v, $groups)) {
                            $priv_display = true;
                        }
                    }
                } else {
                    $priv_display = false;
                }
            } else {
                $priv_display = true;
            }
            //private folders
            $q_temp = sql("SELECT st.link FROM system_templates st, system_templates_ext ste WHERE ste.stid=st.id AND ste.dtid= '".$r_subtree['doc_type']."'");
            $r_temp = mysqli_fetch_assoc($q_temp);
            $class = $r_temp['link'];
            if (!$class) {
                $class = 'document';
            }
            if (($usr_unit == $r_subtree['unit']) || ($r_subtree['unit'] == '0') || ($usr_unit == '0') || !$usr_unit) {
                if ($priv_display) {

					if($r_subtree['related_docs']) {
						$rel_docs = ' <a href="'.WEBSITE_REF.'?p='.$r_subtree['link'].'" class="sm_prop">(Related Documents)</a>';
					} else { 
						$rel_docs = '';
					}

                    if ($r_subtree['pdf']) {
                        $file_url = '';
                        if (AWS_STORAGE) {
                            $file_url = WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$r_subtree['pdf'].'&s='.$sid;
                        } else {
                            $file_url =	WEBSITE_LOC.UPLOAD_DIR.'files/'.$r_subtree['pdf'].'?'.time();
                        }
                        $templateArray['{subtree}'] .= '<li><span class="'.$class.'"><a href="'.$file_url.'" target="_blank">'.$r_subtree['name'].'</a>'.$rel_docs.' <a href="'.WEBSITE_LOC.'?p='.$r_subtree['link'].'" class="sm_prop">(Properties)</a></span></li>';
                    } else {
                        $templateArray['{subtree}'] .= '<li><span class="'.$class.'"><a href="'.WEBSITE_LOC.'?p='.$r_subtree['link'].'">'.$r_subtree['name'].'</a>'.$rel_docs.'</span></li>';
                    }
                }
            } //end usr unit
        }
        $templateArray['{subtree}'] .= '</ul>';
    } else {
        $templateArray['{subtree}'] = 'There are no documents found.';
    }
    $templateArray['{breadcrumb}'] = breadCrumb($doc_id, WEBSITE_LOC);
//Document data
} else {
    if (userAuthorise($sid)) {
        $q_usr_grps = sql("SELECT `rid` FROM `user_groups` WHERE `uid` = '".userID($sid)."'");
        $c_usr_grps = mysqli_num_rows($q_usr_grps);
        if ($c_usr_grps) {
            while ($r_usr_grps = mysqli_fetch_assoc($q_usr_grps)) {
                $groups[] = $r_usr_grps['rid'];
            }
        }
    }

    $templateArray['{document}'] = "block";
    $q_dp = sql("SELECT dp.did, dp.name, dp.docno, dp.author, dp.reviewer, dp.approver, dpe.standards, dpe.private, dp.imp_date, dp.rev_date, dpe.pdf, dpe.version, dpe.related_docs, dp.unit FROM document_properties dp, document_properties_ext dpe WHERE dp.did=dpe.did AND dp.link = '".$lvl1."' AND dp.active = '1'");
    $r_dp = mysqli_fetch_assoc($q_dp);
    $doc_id = $r_dp['did'];
    //private folders
    if ($r_dp['private']) {
        if (userAuthorise($sid)) {
            $priv_display = false;
            $private = explode(';', $r_dp['private']);
            foreach ($private as $k=>$v) {
                if (in_array($v, $groups)) {
                    $priv_display = true;
                }
            }
        } else {
            $priv_display = false;
        }
    } else {
        $priv_display = true;
    }
    //private folders
    
    
    if ($priv_display) {
        $templateArray['{name}'] = $r_dp['name'];
        $templateArray['{docno}'] = $r_dp['docno'];
        $templateArray['{auth}'] = $r_dp['author'];
        $templateArray['{rev}'] = $r_dp['reviewer'];
        $templateArray['{appr}'] = $r_dp['approver'];
        $templateArray['{ver}'] = $r_dp['version'];
        $templateArray['{imp_date}'] = dateConvert($r_dp['imp_date']);
        $templateArray['{rev_date}'] = dateConvert($r_dp['rev_date']);
        $standards = explode(';', $r_dp['standards']);
        $rel_docs = explode(';', $r_dp['related_docs']);
    
        if ($r_dp['related_docs']) {
            foreach ($rel_docs as $k=>$v) {
                if ($v) {
                    $q_rel_dp = sql("SELECT dp.name, dp.link, dpe.pdf FROM document_properties dp, document_properties_ext dpe WHERE dp.did=dpe.did AND dp.did='".$v."' AND dp.active = '1'");
                    $r_rel_dp = mysqli_fetch_assoc($q_rel_dp);
            
                    $file_url = '';
                    if (AWS_STORAGE) {
                        $file_url = WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$r_rel_dp['pdf'].'&s='.$sid;
                    } else {
                        $file_url =	WEBSITE_LOC.UPLOAD_DIR.'files/'.$r_rel_dp['pdf'].'?'.time();
                    }
            
                    $rel_docs_list .= '<li class="none"><a href="'.$file_url.'" target="_blank">'.$r_rel_dp['name'].'</a> <a href="'.WEBSITE_LOC.'?p='.$r_rel_dp['link'].'" class="sm_link">(Properties)</a></li>';
                }
            }
            $templateArray['{reldocs}'] = '<ul id="related_docs" class="none">'.$rel_docs_list.'</ul>';
        }
    
        $q_sett = sql("SELECT `value` FROM `system_settings` WHERE `id` = '2'");
        $r_sett = mysqli_fetch_assoc($q_sett);
        $q_std = sql("SELECT * FROM `standards` WHERE `type` = '".$r_sett['value']."'");
        while ($r_std = mysqli_fetch_assoc($q_std)) {
            if (in_array($r_std['id'], $standards)) {
                $std[] = $r_std['name'];
            }
        }
        $templateArray['{std}'] = implode(', ', $std);
    
    
        if (AWS_STORAGE) {
            if ($r_dp['pdf']) {
                $templateArray['{pdf}'] = '<a href="'.WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$r_dp['pdf'].'&s='.$sid.'" target="_blank">'.$r_dp['pdf'].'</a>';
                $icon = getDocumentIcon(getExt($r_dp['pdf']));
                $templateArray['{pdf-icon}'] = '<a href="'.WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$r_dp['pdf'].'&s='.$sid.'" target="_blank"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/'.$icon.'" /></a>';
                $templateArray['{size}'] = "";
            } else {
                $templateArray['{pdf}'] = sysMsg(30);
                $templateArray['{pdf-icon}'] = '<img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/icon-not-found.gif" />';
                $templateArray['{size}'] = "";
            }
        } else {
            if (is_file(SERVER_PATH.UPLOAD_DIR.'files/'.$r_dp['pdf'])) {
                $templateArray['{pdf}'] = '<a href="'.WEBSITE_LOC.UPLOAD_DIR.'files/'.$r_dp['pdf'].'?'.time().'" target="_blank">'.$r_dp['pdf'].'</a>';
                $icon = getDocumentIcon(getExt($r_dp['pdf']));
                $templateArray['{pdf-icon}'] = '<a href="'.WEBSITE_LOC.UPLOAD_DIR.'files/'.$r_dp['pdf'].'?'.time().'" target="_blank"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/'.$icon.'" /></a>';
                $templateArray['{size}'] = round(filesize(SERVER_PATH.UPLOAD_DIR.'files/'.$r_dp['pdf']) / 1024, 2).'Kb';
            } else {
                $templateArray['{pdf}'] = sysMsg(30);
                $templateArray['{pdf-icon}'] = '<img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/icon-not-found.gif" />';
                $templateArray['{size}'] = "";
            }
        }
    
        clearstatcache();

        //doc links
        $q_doc_links = sql("SELECT * FROM `document_links` WHERE `did` = '".$r_dp['did']."'");
        $c_doc_links = mysqli_num_rows($q_doc_links);
        if ($c_doc_links) {
            $z = 1;
            while ($r_doc_links = mysqli_fetch_assoc($q_doc_links)) {
                $links .= '<p>'.$z.':<a href="'.$r_doc_links['link'].'" target="_blank">'.$r_doc_links['name'].'</a></p>';
                $z++;
            }
            $templateArray['{doclinks}'] = $links;
        } else {
            $templateArray['{doclinks}'] = '<p>No links could be found.</p>';
        }
        //doc links
    
        //do history
        $q_his = sql("SELECT de.date, de.link, de.eid, ue.fname, ue.lname, st.text, de.text AS changes FROM document_events de, user_ext ue, system_templates st WHERE de.eid=st.id AND ue.uid=de.uid AND de.did = '".$doc_id."' ORDER BY de.date DESC LIMIT 0,30");
        $c_his = mysqli_num_rows($q_his);
        if ($c_his) {
            $i = 2;
            while ($r_his = mysqli_fetch_assoc($q_his)) {
                $int = $i/2;
                if (is_int($int)) {
                    $tr_style = 'class = "odd"';
                } else {
                    $tr_style = '';
                }
                if (is_numeric($r_his['link'])) {
                    $ver = $r_his['link'];
                } else {
                    $ver = '';
                }
                if (($r_his['eid'] == '31') || ($r_his['eid'] == '28')) {
                    $his .= '<tr '.$tr_style.'><td>'.dateConvert($r_his['date']).'</td><td>'.$r_his['fname'].' '.$r_his['lname'].'</td><td><p>'.$r_his['text'].$ver.'</p>'.$r_his['changes'].'</td></tr>';
                }
                $i++;
            }
            $templateArray['{history}'] = '<table id="history" class="tablesorter"><thead><tr><th>Date</th><th>Actioned By</th><th>Event</th></thead><tbody>'.$his.'</tbody></table>';
        } //$chk

        //do feedback
        if ($lvl2 == 'feedback') {
            $templateArray['{feedback-select}'] = 'class="selected"';
            if ($_POST['feedback']) {
                $e = $_POST['uname'];
                $p = $_POST['pass'];
                $text = cleanString($_POST['text']);
                if (userAuthOnce($e, $p)) {
                    docEvents($doc_id, userAuthOnce($e, $p), 42, "", $text);
                    $success[] = sysMsg(43);
                    $text = "";
                } else {
                    $err_tabs_ff[] = sysMsg(5);
                }
            }
        } else {
            $templateArray['{feedback-select}'] = '';
        }

        //do read request
        if ($lvl2 == 'read-request') {
            $templateArray['{readrequest-select}'] = 'class="selected"';
            if ($_POST['read-request']) {
                $e = $_POST['uname_rr'];
                $p = $_POST['pass_rr'];
                $uaid = userAuthOnce($e, $p);
                $date = new DateTime('now');
                $date = $date->format('Y-m-d H:i:s');
        
                if ($uaid) {
                    //get doc id
                    $q_reads = sql("SELECT `id`, `date` FROM `document_reads` WHERE `did` = '".$doc_id."' AND `uid` = '".$uaid."' ORDER BY `deid` DESC LIMIT 0,1");
                    $c_reads = mysqli_num_rows($q_reads);
                    if ($c_reads) {
                        $r_reads = mysqli_fetch_assoc($q_reads);
                        $reads_id = $r_reads['id'];
                        if ($r_reads['date'] == '0000-00-00 00:00:00') {
                            $q_upd = sql("UPDATE `document_reads` SET `date` = '".$date."' WHERE `id` = '".$reads_id."'");
                        } else {
                            $q_ins_read = sql("INSERT INTO `document_reads` (`did`, `deid`,`uid`,`date`) VALUES ('".$doc_id."','','".$uaid."','".$date."')");
                        }
                    } else {
                        $q_ins_read = sql("INSERT INTO `document_reads` (`did`, `deid`,`uid`,`date`) VALUES ('".$doc_id."','','".$uaid."','".$date."')");
                    }
                    if ($q_upd || $q_ins_read) {
                        $success[] = sysMsg(61);
                    } else {
                        $err_tabs[] = sysMsg(8);
                    }
                } else {
                    $err_tabs[] = sysMsg(5);
                } //uaid
            }
        } else {
            $templateArray['{read-request}'] = '';
        }


        //do anyway
        list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'?p='.$lvl1.'&o=feedback');
    
        $templateArray['{fhead}'] = $fhead;
        $templateArray['{fend}'] = $fend;
        $templateArray['{feedback}'] = drawTxtBox("text", $text);
        $templateArray['{submit-feedback}'] = drawFld("submit", "feedback", "Submit Feedback", "", "submit");
        $templateArray['{uname}'] = drawFld("text", "uname", $input, "Username");
        $templateArray['{pass}'] = drawFld("password", "pass", "", "Password");
        $templateArray['{breadcrumb}'] = breadCrumb($r_dp['did'], WEBSITE_LOC);
    
        list($fhead_rr, $fend_rr) = drawFormTags('p', WEBSITE_LOC.'?p='.$lvl1.'&o=read-request');
        $templateArray['{fhead-rr}'] = $fhead_rr;
        $templateArray['{fend-rr}'] = $fend_rr;
        $templateArray['{submit-feedback-rr}'] = drawFld("submit", "read-request", "Submit Read Acknowledgement", "", "submit");
        $templateArray['{uname-rr}'] = drawFld("text", "uname_rr", $input, "Username");
        $templateArray['{pass-rr}'] = drawFld("password", "pass_rr", "", "Password");
    } else {
        $templateArray['{document}'] = "none";
        $err[] = "Insufficient user rights access for this document.";
    }
}


if (!$templateArray['{folder}']) {
    $templateArray['{folder}'] = "none";
} if (!$templateArray['{document}']) {
    $templateArray['{document}'] = "none";
}
if (!$templateArray['{text}']) {
    $templateArray['{text}'] = "";
} if (!$templateArray['{breadcrumb}']) {
    $templateArray['{breadcrumb}'] = "";
}
if (!$templateArray['{reldocs}']) {
    $templateArray['{reldocs}'] = "<p>No related documents are found.</p>";
}
if (!$templateArray['{history}']) {
    $templateArray['{history}'] = "<p>No document history found.</p>";
}
if (!$templateArray['{bulletins}']) {
    $templateArray['{bulletins}'] = "";
}
if (!$templateArray['{success}']) {
    $templateArray['{success}'] = writeMsgs($success, "success");
}
if (!$templateArray['{error}']) {
    $templateArray['{error}'] = writeMsgs($err);
}
if (!$templateArray['{error-tabs}']) {
    $templateArray['{error-tabs}'] = writeMsgs($err_tabs);
}
if (!$templateArray['{error-tabs-ff}']) {
    $templateArray['{error-tabs-ff}'] = writeMsgs($err_tabs_ff);
}
