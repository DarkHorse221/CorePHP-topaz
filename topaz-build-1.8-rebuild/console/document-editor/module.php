<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
//set options
$uid = userID($sid);
$ud = SERVER_PATH.UPLOAD_DIR.'files/'; $uda = SERVER_PATH.UPLOAD_DIR.'files/archive/'; $udl = WEBSITE_LOC.UPLOAD_DIR.'files/'; $udr = SERVER_PATH.UPLOAD_DIR.'files/_references/'; $udlr = WEBSITE_LOC.UPLOAD_DIR.'files/_references/';

$o = cleanInput($_GET['o']); $id = cleanNumber($_GET['id']); if(!$o) { $o = "document-edit"; } $pagn = cleanNumber($_GET['pg']);
if(!$id) { $err[] = sysMsg('4'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }
if(!userSystemRights($uid, "edit_documents")) { $err[] = sysMsg('17'); $templateArray['{system-rights}'] = "none"; } else { $templateArray['{system-rights}'] = "block"; }

$q_chk = sql("SELECT dt.id FROM document_tree dt, document_properties dp WHERE dt.id=dp.did AND dt.id='".$id."'");
$c_chk = mysqli_num_rows($q_chk);
@include('collaboration-tool.php');
if($c_chk) {
	if($o == "document-edit") {
		if($_POST['edit-doc']) {
			$act = cleanNumber($_POST['act']); $unit = cleanNumber($_POST['unit']); $imp_date = cleanString($_POST['date-imp']); $rev_date = cleanString($_POST['date-rev']); $doc_no = cleanString($_POST['doc_number_h']); $no_revision_date = cleanNumber($_POST['no_revision_date']);
			if($no_revision_date == '1') { $rev_date = '0000-00-00'; }
			$doc_type = cleanNumber($_POST['doc_type']); $author = cleanInput($_POST['author']); $reviewer = cleanInput($_POST['reviewer']); $approver = cleanInput($_POST['approver']); $version = cleanNumber($_POST['version_h']); if($_POST['text']) { $text = $_POST['text']; } if($_POST['changes']) { $changes = $_POST['changes']; }
			$stan = $_POST['std']; if($stan) { foreach($stan as $k=>$v) { $stds[] = $k; }
			$stan = implode(';', $stds); }
			if(validateInput($_POST['name'])) { $name = cleanInput($_POST['name']); } else { 
			$name = $_POST['name']; $err[] = "Document name: ".sysMsg(6); $n_err = "input_err"; }
			if(validateInput($_POST['doc_link'])) { $doc_link = strtolower(sanitize($_POST['doc_link'])); } else { $doc_link = strtolower(sanitize($_POST['name'])); }
			$q_chk_link = sql("SELECT `did` FROM `document_properties` WHERE `link` = '".$doc_link."' AND `did` != '".$id."'");
			$c_chk_link = mysqli_num_rows($q_chk_link); if($c_chk_link) { $doc_link = strtolower($doc_link."-".$doc_no); }
			
			$exceptions = explode(';',EXCEPTIONS_LIST);
			if($_FILES['pdf']['name']) { 
				if(getExt($_FILES['pdf']['name']) == "pdf") { 
					$version = $version+1; $pdf = $doc_no.'_v'.$version.'.'.getExt($_FILES['pdf']['name']);
				} elseif(in_array(getExt($_FILES['pdf']['name']), $exceptions)) {
					$version = $version+1; $pdf = $doc_no.'_v'.$version.'.'.getExt($_FILES['pdf']['name']);
				} else { 
					$err[] = "File 1 (.pdf): ".sysMsg(23); $p_err = "input_err";
				}
			}
				
		if($_FILES['doc']['name']) { $doc = $doc_no.'_v'.$version.'.'.getExt($_FILES['doc']['name']); }
		
			if(!$err) {
				//do some advanced checking
				$q_chk = sql("SELECT * FROM document_tree dt, document_properties dp, document_properties_ext dpe WHERE dt.id=dp.did AND dt.id=dpe.did AND dt.id='".$id."'"); $r_chk = mysqli_fetch_assoc($q_chk); $chk_name = $r_chk['name']; $chk_author = $r_chk['author']; $chk_reviewer = $r_chk['reviewer']; $chk_approver = $r_chk['approver']; $chk_doc_link = $r_chk['link']; $chk_imp_date = $r_chk['imp_date']; $chk_rev_date = $r_chk['rev_date']; $chk_act = $r_chk['active']; $chk_unit = $r_chk['unit']; $chk_doc_type = $r_chk['doc_type'];
				
				if($name !== $chk_name) { $chg .= 'Document name: '.$chk_name.', '; }
				if($doc_link !== $chk_doc_link) { $chg .= 'Link (slug): '.$chk_doc_link.', '; }
				if($author !== $chk_author) { $chg .= 'Author: '.$chk_author.', '; }
				if($reviewer !== $chk_reviewer) { $chg .= 'Reviewer: '.$chk_reviewer.', '; }
				if($approver !== $chk_approver) { $chg .= 'Approver: '.$chk_approver.', '; }
				if($imp_date !== $chk_imp_date) { $chg .= 'Implement Date: '.$chk_imp_date.', '; }
				if($rev_date !== $chk_rev_date) { $chg .= 'Revision Date: '.$chk_rev_date.', '; }
				if($act !== $chk_act) { if($chk_act == '1') { $chk_status = "Active"; } else { $chk_status = "Disabled"; } $chg .= 'Status: '.$chk_status.', '; }
				if($unit != $chk_unit) { 
					if($chk_unit == 0) { $unit_name = "All Units"; } else {
						$q_unit_chk = sql("SELECT `name` FROM `type_list` WHERE `id` = '".$chk_unit."'"); $r_unit_chk = mysqli_fetch_assoc($q_unit_chk);
						$unit_name = $r_unit_chk['name'];
					} $chg .= 'Unit: '.$unit_name.', ';
				}
				if($doc_type !== $chk_doc_type) {
					$q_chk_typ = sql("SELECT `name` FROM `type_list` WHERE `id` = '".$chk_doc_type."'");
					$r_chk_typ = mysqli_fetch_assoc($q_chk_typ);
					$chg .= 'Document Type: '.$r_chk_typ['name'].', ';
				}
				
				if($chg) {
					$chg = substr($chg, 0, -2);
					docEvents($id, $uid, 67, "",$chg);
				}
				
				
				$q_upd = sql("UPDATE `document_properties` SET `name` = '".$name."', `link` = '".$doc_link."', `active` = '".$act."', `author` = '".$author."', `reviewer` = '".$reviewer."', `approver` = '".$approver."', `doc_type` = '".$doc_type."', `imp_date` = '".$imp_date."', `rev_date` = '".$rev_date."', `unit` = '".$unit."' WHERE `did` = '".$id."'");
				$q_upd_stan = sql("UPDATE `document_properties_ext` SET `standards` = '".$stan."' WHERE `did` = '".$id."'");
				$q_doc_search = sql("UPDATE `document_search` SET `name` = '".$name."', `link` = '".$doc_link."', `active` = '".$act."' WHERE `did` = '".$id."'");
				if($text) { $q_upd_txt = sql("UPDATE `document_properties_ext` SET `text` = '".$text."' WHERE `did` = '".$id."'"); }
				
				
				if($_POST['notification'] && !$changes) { $warning[] = sysMsg(32); }
				if($_POST['read_request'] && !$_POST['notification']) { $warning[] = sysMsg(64); }
				if($changes) {
					if($_POST['notification']) { $read_request = false;
						foreach($_POST['notification'] as $k=>$v) {
							if($k == '0') { $email = 'all'; $read_request_notf = 'All Groups'; } else {
								$q_list = sql("SELECT u.email, u.id FROM user u, user_groups ur WHERE u.id=ur.uid AND ur.rid = '".$k."' AND u.active = '1'"); $c_list = mysqli_num_rows($q_list);
								if($c_list) { while($r_list = mysqli_fetch_assoc($q_list)) { $to[] = $r_list['email']; $ids[] = $r_list['id']; } }
								
								$q_usr_rights_grp = sql("SELECT `name` FROM `user_rights` WHERE `id` = '".$k."'");
								$r_usr_rights_grp = mysqli_fetch_assoc($q_usr_rights_grp);
								$read_request_notfi .= $r_usr_rights_grp['name'].',';
							}
						}
						if(!$read_request_notf) { $read_request_notf = substr($read_request_notfi, 0, -1); }
					
						include('../_functions/mailout.php');
						$tmp = sysMsg(34); $t_arr['{link}'] = WEBSITE_LOC.'?p='.$doc_link; $t_arr['{doc_name}'] = $name;
						$t_arr['{change}'] = $changes; $t_arr['{year}'] = date("Y", time()); $t_arr['{company}'] = EMAIL_COMPANY;
						if($_POST['read_request']) {
							$t_arr['{read_request}'] = '
										<p>You have been request to acknowledge reading this document.<p>
										<div>
<!--[if mso]>
  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="'.WEBSITE_LOC.'?p='.$doc_link.'&o=read-request" style="height:40px;v-text-anchor:middle;width:300px;" arcsize="10%" stroke="f" fillcolor="#d62828">
    <w:anchorlock/>
    <center style="color:#ffffff;font-family:sans-serif;font-size:16px;font-weight:bold;">
      Button Text Here!
    </center>
  </v:roundrect>
  <![endif]-->
  <![if !mso]>
  <table cellspacing="0" cellpadding="0"> <tr> 
  <td align="center" width="300" height="40" bgcolor="#d62828" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
    <a href="'.WEBSITE_LOC.'?p='.$doc_link.'&o=read-request" style="font-size:16px; font-weight: bold; font-family:sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">
    <span style="color: #ffffff;">
      Complete read request
    </span>
    </a>
  </td> 
  </tr> </table> 
  <![endif]>
</div>';
						} else { $t_arr['{read_request}'] = "<p>Please ensure that you read the updated document.</p>"; }
						
						foreach($t_arr as $k=>$v) { $ks[] = $k; $vs[] = $v; } $html = str_replace($ks, $vs, $tmp);
						$date_now = new DateTime('now'); $date_now = $date_now->format('Y-m-d');
						if($email == 'all') {
							$q_usr = sql("SELECT `value` FROM `system_settings` WHERE `id`= '3'"); $r_usr = mysqli_fetch_assoc($q_usr);
							if($r_usr['value']) { $to[] = $r_usr['value']; } else {
								$q_email = sql("SELECT `id`, `email` FROM `user` WHERE `active` = '1'");
								while($r_email = mysqli_fetch_assoc($q_email)) { $to[] = $r_email['email']; $ids[] = $r_email['id']; }
							}
						}
						if($to) {
						$to = array_unique($to); $to_list = implode(",", $to); $ids = array_unique($ids);
						q_smtpmailer($to_list, NO_REPLY_EMAIL, WEBSITE_OWNER, 'Document Change Notification', $html, $date_now, MAIL_SEND_CODE);
						
						//add to history
						docEvents($id, $uid, 31, "", $changes);	$changes = "";
						
						if($_POST['read_request']) {
							docEvents($id, $uid, 60, "", $read_request_notf); $last_id  = mysqli_insert_id($conn); 
							foreach($ids as $k=>$v) {
								$q_ins = sql("INSERT INTO `document_reads` (`did`, `deid`,`uid`) VALUES ('".$id."','".$last_id."','".$v."')");
							}
						}
						docEvents($id, $uid, 63, "", $read_request_notf);
						
						} else { $err[] = "Read request failed. No users are assigned to the selected groups."; }
						//if$to
					} else {
						docEvents($id, $uid, 31, "", $changes);	$changes = "";	
					}
					
				}
				if($_FILES['pdf']['name'] || $_FILES['doc']['name']) {
					
					if($_FILES['pdf']['name']) { 
					$q_chk_pdf = sql("SELECT `pdf` FROM `document_properties_ext` WHERE `did` = '".$id."'"); $r_chk_pdf = mysqli_fetch_assoc($q_chk_pdf);
					if(is_file($ud.$r_chk_pdf['pdf'])) { copy($ud.$r_chk_pdf['pdf'], $uda.$r_chk_pdf['pdf']); unlink($ud.$r_chk_pdf['pdf']); docEvents($id, $uid, 25, $r_chk_pdf['pdf']); }
					$q_upd_e = sql("UPDATE `document_properties_ext` SET `pdf` = '".$pdf."', `version` = '".$version."' WHERE `did` = '".$id."'");
					move_uploaded_file($_FILES['pdf']['tmp_name'], $ud.$pdf); docEvents($id, $uid, 24, $pdf); docEvents($id, $uid, 28, $version); }
					
					if(AWS_STORAGE) {
						$payload = file_get_contents(WEBSITE_LOC.'api/aws-s3/upload.php?objectname='.$pdf.'&objectsource=display');
					}
										
					include(SERVER_PATH.'_functions/class.pdf2text.php');
					//use pdf extraction class
					$a = new PDF2Text();
					$a->setFilename($ud.$pdf);
					$a->decodePDF();
					$text = $a->output();
					//remove all irrelevant punctuation
					$gentext = preg_replace('/[^a-z ]+/i', '', $text);
					//get keywords list
					$words = extractCommonWords($gentext,15);
					$keywords = implode(',', array_keys($words));
					//check if document search exists or not, insert instead
					$q_docs = sql("SELECT `did` FROM `document_search` WHERE `did` = '".$id."'");
					$c_docs = mysqli_num_rows($q_docs);
					if(!$c_docs) {
						//insert
						$q_doc_search = sql("INSERT INTO `document_search` (`did`, `name`, `link`, `keywords`, `gentext`, `active`) VALUES ('".$id."', '".$name."', '".$doc_link."','".$keywords."', '".$gentext."', '".$act."')");
					} else {
						//update
						$q_doc_search = sql("UPDATE `document_search` SET `keywords` = '".$keywords."', `gentext` = '".$gentext."' WHERE `did` = '".$id."'");
					}
					
					if($_FILES['doc']['name']) { 
					$q_chk_doc = sql("SELECT `doc` FROM `document_properties_ext` WHERE `did` = '".$id."'"); $r_chk_doc = mysqli_fetch_assoc($q_chk_doc);
					if(is_file($udr.$r_chk_doc['doc'])) { copy($udr.$r_chk_doc['doc'], $uda.$r_chk_doc['doc']); unlink($udr.$r_chk_doc['doc']); docEvents($id, $uid, 27, $r_chk_doc['doc']);  }
					$q_upd_e = sql("UPDATE `document_properties_ext` SET `doc` = '".$doc."' WHERE `did` = '".$id."'");
					move_uploaded_file($_FILES['doc']['tmp_name'], $udr.$doc); docEvents($id, $uid, 26, $doc);  }
					
					if(AWS_STORAGE) {
						$payload = file_get_contents(WEBSITE_LOC.'api/aws-s3/upload.php?objectname='.$doc.'&objectsource=references');
					}
				}
				if($q_upd) { $success[] = sysMsg(9); } else { $err[] = sysMsg(8); }
			}
		}
		if(!$err) { $q_doc = sql("SELECT * FROM document_tree dt, document_properties dp, document_properties_ext dpe WHERE dt.id=dp.did AND dt.id=dpe.did AND dt.id='".$id."'"); $r_doc = mysqli_fetch_assoc($q_doc); $name = $r_doc['name']; $author = $r_doc['author']; $reviewer = $r_doc['reviewer']; $approver = $r_doc['approver']; $doc_link = $r_doc['link']; $doc_no = $r_doc['docno']; $imp_date = $r_doc['imp_date']; $rev_date = $r_doc['rev_date']; $act = $r_doc['active']; $unit = $r_doc['unit']; $doc_type = $r_doc['doc_type']; $pdf_file = $r_doc['pdf']; $doc_file = $r_doc['doc']; $version = $r_doc['version']; $standards = explode(';',$r_doc['standards']); $text = $r_doc['text']; $lock = $r_doc['lock']; 
		$q_sett = sql("SELECT `value` FROM `system_settings` WHERE `id` = '2'"); $r_sett = mysqli_fetch_assoc($q_sett);
		$q_std = sql("SELECT * FROM `standards` WHERE `type` = '".$r_sett['value']."'");
		$i=1; $lim = 12;
		while($r_std = mysqli_fetch_assoc($q_std)) {
			if($i == 1) { $std_beg = '<span class="std-grp">';} else { $std_beg = ''; }
			if($i > $lim) { $std_end = '</span>'; $i=1; } else { $i++;  $std_end = ''; }
			if(in_array($r_std['id'], $standards)) { $sel = 'checked="checked"'; } else { $sel = ''; }
			$std .= $std_beg.'<p><label class="chk">'.$r_std['name'].'</label><input type="checkbox" name="std['.$r_std['id'].']" value="1" class="chk" '.$sel.' /></p>'.$std_end;
		}
		$templateArray['{standards}'] = $std;
		}
	}

	if($o == "document-history") {
		$q_his = sql("SELECT de.date, de.link, de.eid, ue.fname, ue.lname, st.text, de.text AS changes FROM document_events de, user_ext ue, system_templates st WHERE de.eid=st.id AND ue.uid=de.uid AND de.did = '".$id."' ORDER BY de.date DESC");
		$c_his = mysqli_num_rows($q_his);
		if($c_his) {
			$num_limit = DISP_ROWS;
			if($c_his > $num_limit) { //apply limits to query
			if(!$_GET['pg']) { $limit = " LIMIT 0, ".$num_limit.""; } else { $multi = cleanNumber($_GET['pg']); $row = ($multi * $num_limit) - $num_limit; $limit = " LIMIT ".$row.", ".$num_limit.""; }
			$q_his = sql("SELECT de.date, de.link, de.eid, ue.fname, ue.lname, st.text, de.text AS changes FROM document_events de, user_ext ue, system_templates st WHERE de.eid=st.id AND ue.uid=de.uid AND de.did = '".$id."' ORDER BY de.date DESC ".$limit."");
			$x = ceil($c_his/$num_limit); $i = 1;
			while($i <= $x) { if($i == cleanNumber($_GET['pg'])) { $class = 'pagination_current'; } else { $class = 'pagination'; }
			$pagination .= '<a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o=document-history&id='.$id.'&pg='.$i.'" class="'.$class.'">'.$i.'</a>'; $i++; } }
		$i = 2;
		while($r_his = mysqli_fetch_assoc($q_his)) {
			$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
			if(is_numeric($r_his['link'])) {
				$ver = $r_his['link']; $link = '';
			
			} elseif($r_his['link']) {
				
				if(AWS_STORAGE) {
					$link = '<a href="'.WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$r_his['link'].'&s='.$sid.'" target="_blank">View</a>';
				} else {
					
					if(is_file(SERVER_PATH.UPLOAD_DIR.'files/'.$r_his['link'])) {
						$link = '<a href="'.WEBSITE_LOC.UPLOAD_DIR.'files/'.$r_his['link'].'" target="_blank">View</a>';
					} elseif(is_file(SERVER_PATH.UPLOAD_DIR.'files/archive/'.$r_his['link'])) {
						$link = '<a href="'.WEBSITE_LOC.UPLOAD_DIR.'files/archive/'.$r_his['link'].'" target="_blank">View</a>';
					} else {
						$link = '';
					}
					
				} //aws
				
			} else {
				
				$link = ''; $ver = '';
			
			}
			if(($r_his['eid'] == '31') || ($r_his['eid'] == '42') || ($r_his['eid'] == '58') || ($r_his['eid'] == '59') || ($r_his['eid'] == '60') || ($r_his['eid'] == '63') || ($r_his['eid'] == '67') || ($r_his['eid'] == '69') || ($r_his['eid'] == '70')) { $txt = $r_his['text'].$r_his['changes']; } else { $txt = $r_his['text']; } 
			$his .= '<tr '.$tr_style.'><td>'.$r_his['date'].'</td><td>'.$r_his['fname'].' '.$r_his['lname'].'</td><td>'.$txt.$ver.'</td><td>'.$link.'</td></tr>';
			$i++;
		}
		$templateArray['{history}'] = '<table id="history" class="tablesorter"><thead><tr><th width="150">Date</th><th width="200">Actioned By</th><th>Event</th><th>Links</th></thead><tbody>'.$his.'</tbody></table>';
		} //$chk
	}
	
	if($o == "document-links") {
		
		if(cleanNumber($_GET['unassign'])) {
			if(cleanNumber($_GET['confirm'])) {
				$q_get_link = sql("SELECT `link` FROM `document_links` WHERE `id` = '".cleanNumber($_GET['unassign'])."'");
				$r_get_link = mysqli_fetch_assoc($q_get_link);
				$q_del = sql("DELETE FROM `document_links` WHERE `id` = '".cleanNumber($_GET['unassign'])."'");
				if($q_del) { $success[] = sysMsg(10); docEvents($id, $uid, 70, "", $r_get_link['link']); } else { $err[] = sysMsg(8); }
			} else {
				$warning[] = sysMsg(37).' <a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o=document-links&id='.$id.'&unassign='.cleanNumber($_GET['unassign']).'&confirm=1">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o=document-links&id='.$id.'">Cancel</a>.';
			}
		}
		
		if($_POST['link-add']) {
			$link_name = cleanInput($_POST['link-name']);
			$link_src = cleanInput($_POST['link-src']);
			//add link if both exists
			if($link_name && $link_src) {
				$q_ins = sql("INSERT INTO `document_links` (`name`, `link`,`did`) VALUES ('".$link_name."','".$link_src."','".$id."')");
				if($q_ins) { $success[] = sysMsg(9); docEvents($id, $uid, 69, "", $link_src); $link_name = ''; $link_src = '';
				
				} else { $err[] = sysMsg(8); }
			} else {
				$warning[] = "A link name and link reference must be specified.";
			}
		}
		
		//do anyway
		$q_link = sql("SELECT * FROM document_links WHERE did = '".$id."' ORDER BY `name` DESC");
		$c_link = mysqli_num_rows($q_link);
		if($c_link) {
			$i = 2;
			while($r_link = mysqli_fetch_assoc($q_link)) {
				$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
				$links .= '<tr '.$tr_style.'><td>'.$r_link['name'].'</td><td><a href="'.$r_link['link'].'">'.$r_link['link'].'</a></td><td>
				<a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o=document-links&id='.$id.'&unassign='.$r_link['id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a></td></tr>';
				$i++;
			} 
			$templateArray['{links}'] = '<table id="links" class="tablesorter"><thead><tr><th width="150">Name</th><th>Link</th><th width="50">&nbsp;</th></thead><tbody>'.$links.'</tbody></table>';
		} else {
			$templateArray['{links}'] = '<p>No links to display</p>';
		}
	}
	
	if($o == "related-documents") {
		if(cleanNumber($_GET['unassign'])) {
			if(cleanNumber($_GET['confirm'])) {
				$q_unass = sql("SELECT `related_docs` FROM `document_properties_ext` WHERE `did` = '".$id."'");
				$r_unass = mysqli_fetch_assoc($q_unass); $unass = explode(';',$r_unass['related_docs']);
				$key = array_search($_GET['unassign'], $unass);
				unset($unass[''.$key.'']); $unass_upd = implode(';', $unass);
				$q_unass_upd = sql("UPDATE `document_properties_ext` SET `related_docs` = '".$unass_upd."' WHERE `did` = '".$id."'");
				
				$q_unass_2 = sql("SELECT `related_docs` FROM `document_properties_ext` WHERE `did` = '".$_GET['unassign']."'");
				$r_unass_2 = mysqli_fetch_assoc($q_unass_2); $unass_2 = explode(';',$r_unass_2['related_docs']);
				$key_2 = array_search($id, $unass_2);
				unset($unass_2[''.$key_2.'']); $unass_upd_2 = implode(';', $unass_2);
				$q_unass_upd_2 = sql("UPDATE `document_properties_ext` SET `related_docs` = '".$unass_upd_2."' WHERE `did` = '".$_GET['unassign']."'");
				
				$q_rel_doc = sql("SELECT `name`, `docno` FROM `document_properties` WHERE `did` = '".$_GET['unassign']."'");
				$r_rel_doc = mysqli_fetch_assoc($q_rel_doc);
				docEvents($id, $uid, 59, "", $r_rel_doc['name'].' ('.$r_rel_doc['docno'].')');
			} else {
				$warning[] = sysMsg(37).' <a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o=related-documents&id='.$id.'&unassign='.cleanNumber($_GET['unassign']).'&confirm=1">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o=related-documents&id='.$id.'">Cancel</a>.';
			}
		}
		if($_POST['assign-rel']) {
			$q_rel = sql("SELECT `related_docs` FROM `document_properties_ext` WHERE `did` = '".$id."'");
			$r_rel = mysqli_fetch_assoc($q_rel); $rel_arr = $r_rel['related_docs'].$_POST['doc_list'].';';
			$q_rel_upd = sql("UPDATE `document_properties_ext` SET `related_docs` = '".$rel_arr."' WHERE `did` = '".$id."'");
			$q_rel_other = sql("SELECT `related_docs` FROM `document_properties_ext` WHERE `did` = '".$_POST['doc_list']."'");
			$r_rel_other = mysqli_fetch_assoc($q_rel_other); $rel_arr_other = $r_rel_other['related_docs'].$id.';';
			$q_rel_upd_other = sql("UPDATE `document_properties_ext` SET `related_docs` = '".$rel_arr_other."' WHERE `did` = '".$_POST['doc_list']."'");
			$q_rel_doc = sql("SELECT `name`, `docno` FROM `document_properties` WHERE `did` = '".$_POST['doc_list']."'");
			$r_rel_doc = mysqli_fetch_assoc($q_rel_doc);
			docEvents($id, $uid, 58, "", $r_rel_doc['name'].' ('.$r_rel_doc['docno'].')');
			if($q_rel_upd) { $success[] = sysMsg(9); } else { $err[] = sysMsg(8); }
		}
		$q_doc_list = sql("SELECT `did`, `name` FROM `document_properties` WHERE `did` != '".$id."' AND `doc_type` NOT IN(37,15) ORDER BY `name` ASC");
		while($r_doc_list = mysqli_fetch_assoc($q_doc_list)) { $doc_list[''.$r_doc_list['did'].''] = $r_doc_list['name']; }
		
		$q_rel_d = sql("SELECT `related_docs` FROM `document_properties_ext` WHERE `did` = '".$id."'");
		$c_rel_d = mysqli_num_rows($q_rel_d);
		if($c_rel_d) {	
			$r_rel_d = mysqli_fetch_assoc($q_rel_d); $rel_d = explode(";", $r_rel_d['related_docs']);
			foreach($rel_d as $k) {	unset($doc_list[$k]); }
		}
		$templateArray['{related-docs}'] = drawSelect("doc_list",$doc_list,"","Document List");
		//print rel documents
		$q_rel_docs = sql("SELECT `related_docs` FROM `document_properties_ext` WHERE `did` = '".$id."'");
		$r_rel_docs = mysqli_fetch_assoc($q_rel_docs); $rel_arr = explode(';',$r_rel_docs['related_docs']);
		$i = 2;
		foreach($rel_arr as $k) {
			$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
			$q_rel_list = sql("SELECT `did`, `name` FROM `document_properties` WHERE `did` = '".$k."'"); $c_rel_list = mysqli_num_rows($q_rel_list);
			if($c_rel_list) { $r_rel_list = mysqli_fetch_assoc($q_rel_list); $rel_list .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o=document-edit&id='.$k.'">'.$r_rel_list['name'].'</a></td><td><a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o=related-documents&id='.$id.'&unassign='.$k.'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a></td></tr>';}
			$i++;
		}
		$templateArray['{rel-docs-list}'] = '<table id="related_docs" class="tablesorter"><thead><tr><th>Document Name</th><th>Un-Assign</th></thead><tbody>'.$rel_list.'</tbody></table>';
	} //related docs
	

	if($o == "document-reads") {
		$q_events = sql("SELECT `id`, `date`, `text` FROM `document_events` WHERE `eid` = '60' AND `did` = '".$id."' ORDER BY `date` DESC");
		$c_events = mysqli_num_rows($q_events);
		if($c_events) {
			while($r_events = mysqli_fetch_assoc($q_events)) {
				$users = '';
				$q_get_usrs = sql("SELECT r.date,ue.fname,ue.lname FROM document_reads r LEFT JOIN user_ext ue ON r.uid=ue.uid WHERE r.deid = '".$r_events['id']."' ORDER BY ue.fname ASC");
				$c_get_usrs = mysqli_num_rows($q_get_usrs);
				if(!$c_get_usrs) { $users = '<p>No users to display</p>'; } else {
					$i = 1; $lim = ($c_get_usrs - 1) / 5;
					while($r_get_usrs = mysqli_fetch_assoc($q_get_usrs)) {
						if($i == 1) { $std_beg = '<span class="std-grp">';} else { $std_beg = ''; }
						if($i > $lim) { $std_end = '</span>'; $i=1; } else { $i++;  $std_end = ''; }
						if($r_get_usrs['date'] !== '0000-00-00 00:00:00') { $sel = 'checked="checked"'; } else { $sel = ''; }
						
						$users .= $std_beg.'<p><label>'.$r_get_usrs['fname'].' '.$r_get_usrs['lname'].'</label><input type="checkbox" name="" value="1" class="chk" '.$sel.' disabled="disabled" /></p>'.$std_end;
					} //while
				} //if
				$builder .= '<p class="header">Requested on '.dateConvert($r_events['date']).': '.$r_events['text'].'</p><div>'.$users.'</div><div class="clear">&nbsp;</div><br />';
			} //while
		} //c_events
		
		//do non requested user reads
		$q_get_usrs1 = sql("SELECT r.date,ue.fname,ue.lname FROM document_reads r LEFT JOIN user_ext ue ON r.uid=ue.uid WHERE r.deid = '0' AND `did` = '".$id."' ORDER BY r.date DESC");
		$c_get_usrs1 = mysqli_num_rows($q_get_usrs1);
		if($c_get_usrs1) {
			while($r_get_usrs1 = mysqli_fetch_assoc($q_get_usrs1)) {
				$users1 .= '<p>'.$r_get_usrs1['date'].' ('.$r_get_usrs1['fname'].' '.$r_get_usrs1['lname'].')</p>';
			} //while
			$builder1 = '<p class="header">Non-requested read acknowledgements</p>'.$users1.'<div class="clear">&nbsp;</div>';
		} //if
		
		$templateArray['{doc-reads}'] = $builder.$builder1;
	} //document-reads
	
	
	if($o == "privatise") {
	
		if(!userSystemRights($uid, "edit_document_privacy")) {
			$templateArray['{privatise}'] = 'none'; $err[] = sysMsg('17');  $templateArray['{system-rights}'] = "none";
		} else {
		$templateArray['{privatise}'] = 'block';
		$templateArray['{sect_head_ext}'] = ': Privatise Folder';
		$q_get_lr = sql("SELECT `lft`, `rgt` FROM `document_tree` WHERE `id` = '".$id."'");
		$r_get_lr = mysqli_fetch_assoc($q_get_lr); $lft = $r_get_lr['lft']; $rgt = $r_get_lr['rgt'];
		$maths = $rgt - $lft; $children[] = $id;
		if($maths > 1) {		
			$q_get_children = sql("SELECT `id` FROM `document_tree` WHERE `lft` > '".$lft."' AND `rgt` < '".$rgt."'");
			$c_get_children = mysqli_num_rows($q_get_children);
			if($c_get_children) {
				while($r_get_children = mysqli_fetch_assoc($q_get_children)) {
					$children[] = $r_get_children['id'];
				}
			} //$c
		} //$maths
		
		if($_POST['submit-private']) {
			if($_POST['private'] == false) {
				foreach($children as $k=>$v) {
					$del_priv = sql("UPDATE `document_properties_ext` SET `private` = '' WHERE `did` = '".$v."'");
				}
				if($del_priv) { $success[] = sysMsg(9); } else { $err[] = sysMsg(8); }
			}
			if($_POST['private']) {
				foreach($_POST['private'] as $k=>$v) { $priv[] = $k; }	$private = implode(';', $priv);
				foreach($children as $k=>$v) {
					$q_upd_priv = sql("UPDATE `document_properties_ext` SET `private` = '".$private."' WHERE `did` = '".$v."'");
				}
				if($q_upd_priv) { $success[] = sysMsg(9); } else { $err[] = sysMsg(8); }
			}
		}
		
		//get document details
		$q_sel_dpe = sql("SELECT `private` FROM `document_properties_ext` WHERE `did` = '".$id."'");
		$c_sel_dpe = mysqli_num_rows($q_sel_dpe);
		if($c_sel_dpe) {
			$r_sel_dpe = mysqli_fetch_assoc($q_sel_dpe);
			$private_eye = explode(';',$r_sel_dpe['private']);
		} else { $private_eye[] = false; }
		//get user rights groups
		$q_usr_rights = sql("SELECT `id`, `name` FROM `user_rights` WHERE `tid` = '4' ORDER BY `id` ASC");
		$c_usr_rights = mysqli_num_rows($q_usr_rights);
		$i = 1; $lim = ($c_usr_rights - 1) / 2;
		
		while($r_usr_rights = mysqli_fetch_assoc($q_usr_rights)) {
			if($i == 1) { $std_beg = '<span class="std-grp">';} else { $std_beg = ''; }
			if($i > $lim) { $std_end = '</span>'; $i=1; } else { $i++;  $std_end = ''; }
			if(in_array($r_usr_rights['id'], $private_eye)) { $sel = 'checked="checked"'; } else { $sel = ''; }
			$notf .= $std_beg.'<p><label>'.$r_usr_rights['name'].'</label><input type="checkbox" name="private['.$r_usr_rights['id'].']" value="1" class="chk" '.$sel.' /></p>'.$std_end;
		}
		$templateArray['{private}'] = $notf;
		} //user rights
	}//privatise


} else { $templateArray['{system-rights}'] = "none"; $err[] = sysMsg('4'); }

$q_pid = sql("SELECT `parent_id` FROM `document_tree` WHERE `id`='".$id."'"); $r_pid = mysqli_fetch_assoc($q_pid);
$sect_head = "Document Editor";
$sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&pid='.$r_pid['parent_id'].'&pg='.$pagn.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
if(AWS_STORAGE) {
	if($doc_file) {
		$sect_nav_ext .= '<a href="'.WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$doc_file.'&s='.$sid.'" target="_blank"><img src="'.WEBSITE_LOC.'console/_images/ref-icon.png" class="img" /></a>';
	}
	if($pdf_file) {
		$sect_nav_ext .= '<a href="'.WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$pdf_file.'&s='.$sid.'" target="_blank"><img src="'.WEBSITE_LOC.'console/_images/pdf-icon.png" class="img" /></a>';
	}
} else {
	if(is_file($udr.$doc_file) && !$lock) { $sect_nav_ext .= '<a href="'.$udlr.$doc_file.'" target="_blank"><img src="'.WEBSITE_LOC.'console/_images/ref-icon.png" class="img" /></a>'; }
	if(is_file($ud.$pdf_file) && !$lock) { $sect_nav_ext .= '<a href="'.$udl.$pdf_file.'" target="_blank"><img src="'.WEBSITE_LOC.'console/_images/pdf-icon.png" class="img" /></a>'; }
}
if($coll) { $sect_nav_ext .= $coll_sect_nav_ext; }

//privatise folders
$q_sel_dpe = sql("SELECT `private` FROM `document_properties_ext` WHERE `did` = '".$id."'");
$r_sel_dpe = mysqli_fetch_assoc($q_sel_dpe); $dpe_private = $r_sel_dpe['private'];
if($dpe_private) { $img = 'eye-private.png'; } else { $img = 'eye-open.png'; }
$sect_nav_ext .= '<a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o=privatise&id='.$id.'"><img src="'.WEBSITE_LOC.'console/_images/'.$img.'" class="img" /></a>';


$sec_opts = array("Edit Document" => "document-edit","Related Documents" => "related-documents","Document Links" => "document-links","Document History" => "document-history","Document Reads" => "document-reads");
$fext = "&id=".$id;

foreach($sec_opts as $k => $v) { if($v == $o) { $c = "sect_nav_c"; $disp = "block"; $templateArray['{sect_head_ext}'] = ": ".$k; } else { $c = "sect_nav"; $disp = "none"; }
$templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&o='.$v.'&id='.$id.'&pg='.$pagn.'" class="'.$c.'">'.$k.'</a>'; $templateArray['{'.$v.'}'] = $disp; }

if(!$templateArray['{section_nav}']) { $templateArray['{section_nav}'] = ""; }

if(!$sect_head) { $sect_head = "Error"; }
if(!$templateArray['{sect_head}']) { $templateArray['{sect_head}'] = $sect_head; }
if(!$templateArray['{sect_head_ext}']) { $templateArray['{sect_head_ext}'] = ""; }
if(!$templateArray['{sect_head_rt}']) { $templateArray['{sect_head_rt}'] = $sect_nav_ext; }

if(!$templateArray['{success}']) { $templateArray['{success}'] = writeMsgs($success, "success"); }
if(!$templateArray['{warning}']) { $templateArray['{warning}'] = writeMsgs($warning, "warning"); }
if(!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($err); }
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=document-editor&pg='.$pagn.'&o='.$o.$fext,"","",true);

//for document edit
$templateArray['{fhead-doc}'] = $fhead; $templateArray['{fend-doc}'] = $fend;
$templateArray['{name}'] = drawFld("text","name",$name,"Document Name",$n_err);
$templateArray['{author}'] = drawFld("text","author",$author,"Author");
$templateArray['{reviewer}'] = drawFld("text","reviewer",$reviewer,"Reviewer");
$templateArray['{approver}'] = drawFld("text","approver",$approver,"Approver");
$templateArray['{doc-link}'] = drawFld("text","doc_link",$doc_link,"Link (Slug)");
$templateArray['{doc_no}'] = drawFld("text","doc_number",$doc_no,"Document Number", "","",1);
$templateArray['{doc_no_h}'] = drawFld("hidden","doc_number_h",$doc_no);
if(!$imp_date) { $date_imp = new DateTime('now'); $imp_date = $date_imp->format('Y-m-d'); }
if(!$templateArray['{date-imp}']) { $templateArray['{date-imp}'] = $imp_date; }
if(!$rev_date) { $date_rev = new DateTime('now'); $date_rev->add(new DateInterval('P1Y'));  $rev_date = $date_rev->format('Y-m-d'); }
if(!$templateArray['{date-rev}']) { $templateArray['{date-rev}'] = $rev_date; }
if($rev_date == '0000-00-00') { $sel = 'checked=checked';  $templateArray['{rev-hidden}'] = 'none'; } else { $sel = '';  $templateArray['{rev-hidden}'] = 'block'; }
$templateArray['{no_rev_date}'] = '<input type="checkbox" name="no_revision_date" value="1" '.$sel.' class="chk" />';
$templateArray['{version}'] = drawFld("text","version",$version,"Version", "date","",1);
$templateArray['{version_h}'] = drawFld("hidden","version_h",$version);
$templateArray['{pdf}'] = drawFld("file","pdf","","Display File (pdf;".EXCEPTIONS_LIST.")",$p_err);
$templateArray['{doc}'] = drawFld("file","doc","","Reference File", $d_err);

//notifcation groups
$q_usr_rights = sql("SELECT `id`, `name` FROM `user_rights` WHERE `tid` = '4' ORDER BY `id` ASC");
$c_usr_rights = mysqli_num_rows($q_usr_rights);
$i = 1; $lim = ($c_usr_rights - 1) / 2;

while($r_usr_rights = mysqli_fetch_assoc($q_usr_rights)) {
	if($i == 1) { $std_beg = '<span class="std-grp">';} else { $std_beg = ''; }
	if($i > $lim) { $std_end = '</span>'; $i=1; } else { $i++;  $std_end = ''; }
	$notf .= $std_beg.'<p>'.drawFld("checkbox","notification[".$r_usr_rights['id']."]",1,$r_usr_rights['name'],"chk").'</p>'.$std_end;
}
$templateArray['{notification}'] = '<span class="std-grp"><p>'.drawFld("checkbox","notification[0]",1,"Notify change to ALL users?","chk").'</p></span>
<span class="std-grp shadow"><p>'.drawFld("checkbox","read_request",1,"Request read acknowledgement?","chk").'</p></span>
<br /><p style="font-weight:bold;">Or specify groups:</p>'.$notf;
//notifcation groups


if(!$coll) { $templateArray['{submit-doc}'] = drawFld("submit","edit-doc","Update Document","&nbsp;","submit"); }
$act_arr = array("0" => "Disabled","1" => "Active");
$templateArray['{act}'] = drawSelect("act",$act_arr ,$act,"Status");

$q_unit = sql("SELECT * FROM `type_list` WHERE `group` = 'units' ORDER BY `name` ASC");
$unit_arr[0] = 'All Units';
while($r_unit = mysqli_fetch_assoc($q_unit)) { $unit_arr[$r_unit['id']] = $r_unit['name']; }
$templateArray['{unit}'] = drawSelect("unit",$unit_arr,$unit,"Unit");

if(!$templateArray['{history}']) { $templateArray['{history}'] = 'No history has been recorded.'; }
if(!$templateArray['{doc-reads}']) { $templateArray['{doc-reads}'] = 'No document read acknowledgements have been requested.'; }
$q_doc_typ = sql("SELECT `id`, `name` FROM `type_list` WHERE `group` = 'doc_type' ORDER BY `name` ASC");
while($r_doc_typ = mysqli_fetch_assoc($q_doc_typ)) { $type_arr[''.$r_doc_typ['id'].''] = $r_doc_typ['name']; }
$templateArray['{doc_type}'] = drawSelect("doc_type",$type_arr,$doc_type,"Document Type");
$templateArray['{changes}'] = drawTxtBox("changes",$changes,"","","","changes");

//related docs
$templateArray['{fhead-rel-docs}'] = $fhead; $templateArray['{fend-rel-docs}'] = $fend;
$templateArray['{submit-rel-docs}'] = drawFld("submit","assign-rel","Assign Related Document","&nbsp;","submit");

if($doc_type == '15') { $templateArray['{text}'] = '<br /><p class="header">Use the Page Editor to update the page</p>'.drawTxtBox("text",$text,"","","","editor"); } else { $templateArray['{text}'] = ''; }
if(!$templateArray['{pagination}']) { $templateArray['{pagination}'] = '<p>'.$pagination.'</p>'; }

//document links
$templateArray['{fhead-links}'] = $fhead; $templateArray['{fend-links}'] = $fend;
$templateArray['{link-add}'] = drawFld("submit","link-add","Add link","&nbsp;","submit");
$templateArray['{link-name}'] = drawFld("text","link-name",$link_name,"Name");
$templateArray['{link-src}'] = drawFld("text","link-src",$link_src,"Link");

//privatise
$templateArray['{fhead-privatise}'] = $fhead; $templateArray['{fend-privatise}'] = $fend;
$templateArray['{submit-private}'] = drawFld("submit","submit-private","Update Privacy","","submit");
if(!$templateArray['{privatise}']) { $templateArray['{privatise}'] = 'none'; }
?>