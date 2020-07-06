<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
//clean strings for mysql input
function cleanString($dirty) {
	$dirty = strip_tags($dirty);
	$clean = htmlentities($dirty,ENT_QUOTES);
	return $clean;
}
function sanitize($str) {
	$str = preg_replace("/[^a-zA-Z0-9-\s]/", "", $str); $str = trim($str); $str = str_replace(" ", "-", $str); return $str;
}
//Get a file Extension
function getExt($str) {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$pre_ext = substr($str,$i+1,$l);
	$ext = strtolower($pre_ext);
	return $ext;
}
//Captcha function
function captcha() {
	$n = array("1", "2", "3", "4", "5", "6", "7", "8", "9");
	$rand = array_rand($n, 2);
	$txt = "Because we like humans to: ".$n[$rand[0]]." plus ".$n[$rand[1]]." equals?";
	$n1 = $n[$rand[0]];
	$n2 = $n[$rand[1]];
	return $captcha = array($txt, $n1, $n2);
}
//Division calculator
function divide($num, $dem) {
	$div = $num / $dem;
	$mod = $num % $dem;
	if (0 == $mod) { return true; } else { return false; }
}
//Replaces the Template Arrays
function replaceTemplate($l, $p) {
	if(@is_file($p)) {
		foreach($l as $k => $v) { 
			$keys[] = $k;
			$vals[] = $v;
		}
		$str = @file_get_contents($p); //Generates a string from template file
		$upd = @str_replace($keys, $vals, $str); //This replaces all keys and values in the string
		return $upd;
	}
	return false;
}
//Replaces the Text in Arrays
function replaceText($l, $p) {
	foreach($l as $k => $v) { 
		$keys[] = $k;
		$vals[] = $v;
	}
	$upd = @str_replace($keys, $vals, $p);
	return $upd;
}
//check radiation dose format
function check_dose_format($s) {
	if(is_numeric($s)) { $n = number_format($s, 2, '.', '');
	} elseif(strtolower($s) == 'min') { $n = strtoupper($s);
	} else { $n = false; } return $n;
}
function dateConvert($d,$t = 0) {
	if($d) { $date = new DateTime($d);
		$zone = date_default_timezone_get();
		//if($zone == 'Australia/Sydney') { if($t) { return $date->format('d-m-Y H:i:s'); } else {  return $date->format('d-m-Y'); } }
		if($t) { return $date->format('d-m-Y H:i:s'); } else {  return $date->format('d-m-Y'); }
	} else { return false; }
}
function dateConvertEducation($d,$t = 0) {
	if($d) { $date = new DateTime($d);
		return $date->format('d-m-Y H:i:s');
	} else { return false; }
}
function checkModule($link) {
	$q_mod = sql("SELECT `id` FROM `system_modules` WHERE `link` = '".$link."' AND `active` = '1'"); $c_mod = mysqli_num_rows($q_mod);
	if($c_mod) { return true; } else { return false; }
}
function docNumber() {
	$q_doc = sql("SELECT `docno` FROM `document_properties`"); while($r_doc = mysqli_fetch_assoc($q_doc)) { $arr[] = $r_doc['docno']; }
	$docno = rand("100000", "999999"); while(in_array($docno, $arr)) { $docno = rand("100000", "999999");} return $docno;
}
function drawFld($t,$n,$v,$l = "",$c = "input",$lc = "label",$dis = "",$req="") {
	if($dis) { $dis = 'disabled=disabled'; } if($req) { $c .= "required"; }
	if($t && $n) { if($l) { $fld = '<label class="'.$lc.'">'.$l.'</label>'; } $fld .= '<input type="'.$t.'" name="'.$n.'" id="'.$n.'" value="'.$v.'" class="'.$c.'" '.$dis.' />'; return $fld; } else { return false; }	
}
function drawSelect($n,$k,$def="",$l = "",$class = "select",$lc = "label",$disabled = "0", $selectid = "") {
	if($n) {
		if($l) {
			$fld = '<label class="'.$lc.'">'.$l.'</label>';
		}
		if($disabled) { $disabled = 'disabled'; } else { $disabled = ''; }
		$fld .= '<select name="'.$n.'" id="'.$selectid.'" class="'.$class.'" '.$disabled.'>'; 
		foreach($k as $key=>$val) {
			if($def == $key) {
				$fld .= '<option value="'.$key.'" selected="selected">'.$val.'</option>';
			} else {
				$fld .= '<option value="'.$key.'">'.$val.'</option>';
			}
		}
		$fld .= '</select>';
		return $fld;
	} else {
		return false;
	}
}

function drawTxtBox($n,$v,$l = "",$c = "textarea",$lc = "label",$id="") {
	if($id) { $id = 'id="'.$id.'"'; }
	if($n) { if($l) { $fld = '<label class="'.$lc.'">'.$l.'</label>'; } $fld .= '<textarea name="'.$n.'" class="'.$c.'" '.$id.'>'.$v.'</textarea>'; return $fld; } else { return false; }	
}
function drawFormTags($m,$a,$n="",$id="",$e="") {
	if($m && $a) { 
		if($m == 'p') { $m = 'post'; }	if($m == 'g') { $m = 'get'; } if($n) { $n = 'name="'.$n.'"'; }  if($id) { $id = 'id="'.$id.'"'; } if($e) { $e = 'enctype="multipart/form-data"'; }
		$fhead = '<form method="'.$m.'" action="'.$a.'" '.$n.' '.$id.' '.$e.'>'; $fend = '</form>'; 
		return array($fhead, $fend); } else { return false; }
}
function makeSalt() {
	static $seed = "./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	for ($i = 0; $i < 22; $i++) { $salt .= substr($seed, mt_rand(0, 63), 1); } return $salt;
}
function makeRandom() {
	static $seed = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	for ($i = 0; $i < 22; $i++) { $salt .= substr($seed, mt_rand(0, 63), 1); } return $salt;
}
function makeTempPassword() {
	static $seed = "./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	for ($i = 0; $i < 8; $i++) { $salt .= substr($seed, mt_rand(0, 63), 1); } return $salt;
}
function truncate($string,$length=100,$append="") {
	$string = trim($string);
	
	if(strlen($string) > $length) {
	  $string = wordwrap($string, $length);
	  $string = explode("\n", $string, 2);
	  $string = $string[0] . $append;
	}
  
	return $string;
  }
function cleanEmail($z) { $z = filter_var($z, FILTER_SANITIZE_EMAIL); return $z; }
function validateEmail($z) { $z = cleanEmail($z); if (filter_var($z, FILTER_VALIDATE_EMAIL)) { return true; } else { return false; }}
function cleanInput($z) { $z = filter_var($z, FILTER_SANITIZE_STRING); return $z; }
function validateInput($z) { $z = cleanInput($z); if($z !== "") { return true; } else { return false; }}
function cleanURL($z) { $z = filter_var($z, FILTER_SANITIZE_URL); return $z; }
function validateURL($z) { $z = cleanURL($z); if (filter_var($z, FILTER_VALIDATE_URL)) { return true; } else { return false; }}
function cleanNumber($z) { $z = filter_var($z, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); return $z; }
function validateIP($z) { $z = cleanNumber($z); if (filter_var($z, FILTER_VALIDATE_IP)) { return true; } else { return false; }} //IPv4 Only
?>