<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	ini_set("display_errors", 1);
	
	define('TOPAZ', true);
	include('../../_constants/constants.php'); include('../../_constants/db.php'); include('../../_functions/strings.php'); include('../../_functions/requests.php'); @include('../../licence.php'); include('../../_modules/standard_arrays.php');
	
	if(DEBUG_MODE_FORM_BUILDER) { print_r($_POST)."<br>"; }
	
	//set up basic variables
	$order = 1; $errors = ''; $options_errs = false; $label_errs = false; $ov_errs = false; 
		
		if(!$_POST['myVersion']) { $errors[] = 'Version can not be established. Update failed.'; } else {
			
			//get question data and purge on update
			$q_get_q = sql("SELECT * FROM `qi_resolution_q` WHERE `feid` = '".$_POST['myVersion']."'");
			$c_get_q = mysqli_num_rows($q_get_q);
			//purge questions and option data for current version
			if($c_get_q) {
				while($r_get_q = mysqli_fetch_assoc($q_get_q)) {
					$q_del_options = sql("DELETE FROM `qi_resolution_q_ext` WHERE `feqid` = '".$r_get_q['id']."'");
				}
				$q_del = sql("DELETE FROM `qi_resolution_q` WHERE `feid` = '".$_POST['myVersion']."'");
			}
			
			//start inserting new data	
			if(!$_POST['myText']) { $errors[] = 'Oops, better add some fields before submitting!'; } else {
						
				foreach($_POST['myText'] as $k => $v) {
					if(DEBUG_MODE_FORM_BUILDER) { $debug .= $k.": ".$_POST['myLabel'][$k].": ".$v.": Order:".$order."<br />"; }
						
						//error checking						
						if(!$v && ($options_errs == false)) { $errors[] = 'Oops, can not find what type of options list is required'; $options_errs = true; }
						if(!$_POST['myLabel'][$k] && ($label_errs == false)) { $errors[] = 'Oops, you have some missing text labels'; $label_errs = true; } else {
							//insert new question if label exists
							$q_ins_q = sql("INSERT INTO `qi_resolution_q` (`feid`, `question`, `type`, `order`) VALUES ('".$_POST['myVersion']."', '".$_POST['myLabel'][$k]."', '".$v."', '".$order."')");
							$last_id  = mysqli_insert_id($conn);
						}
						
						if($v == "checkbox" || $v == "radio" || $v == "singleselect" || $v == "multipleselect") {
							if($_POST['myOptions']) { 
								foreach($_POST['myOptions'][$k] as $o => $ov) {	if(DEBUG_MODE_FORM_BUILDER) { $debug .= $k."options: ".$o.": ".$ov."<br />"; }
									
									if(!$ov && ($ov_errs == false)) { $errors[] = 'Oops, you have some missing options'; $ov_errs = true; } else {
										//insert options
										$q_builder_ext = sql("INSERT INTO `qi_resolution_q_ext` (`feqid`,`option`) VALUES ('".$last_id."', '".$ov."')");
									}
								} //foreach options
							} // post my options
						} //if multiples
						
						//do field order
						$order++;
				
					} //foreach mytext	
			} //mytext
		} //myVersion
	//display errors
	if($errors) {
		echo writeMsgs($errors);
	} else {
		$success[] = 'Success!!';
		echo $debug.'<div class="errors">'.writeMsgs($success, "success").'</div>';
	}
?>