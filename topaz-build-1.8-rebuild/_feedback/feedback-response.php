<?php define('TOPAZ', true);
error_reporting(E_ERROR | E_WARNING | E_PARSE); ini_set("display_errors", 1);
include('../_constants/constants.php'); include('../_constants/db.php'); include('../_functions/strings.php'); include('../_functions/requests.php');
session_start(); $sid = session_id();

//get variables
$fid = cleanInput($_POST['fid']);
$currqid = cleanInput($_POST['currqid']);
$response = cleanInput($_POST['response']);
$respid = cleanInput($_POST['respid']);
$date_now = new DateTime('now');
$date_now = $date_now->format('Y-m-d H:i:s');
$machineid = '';
$unit_sel = '';

//get version for submission
$q_fid = sql("SELECT fe.id AS ext_id, f.name, f.status, fe.status, f.type_id, f.unit, f.mids FROM qi f LEFT JOIN qi_ext fe ON fe.fid=f.id LEFT JOIN type_list tl ON f.type_id=tl.id WHERE f.status = '1' AND fe.status = '1' AND f.id = '".$fid."'");
$c_fid = mysqli_num_rows($q_fid);
if ($c_fid) {
    
    if (!$respid) {
    //insert values
        $r_fid = mysqli_fetch_assoc($q_fid);
        $q_ins = sql("INSERT INTO `qi_responses` (`feid`, `date`,`uid`, `mid`, `unit`, `status`) VALUES ('".$r_fid['ext_id']."', '".$date_now."', '1', '".$machineid."', '".$unit_sel."', '100')");
        $respid  = mysqli_insert_id($conn);
    }

    if($respid) {
        $q_ins_r = sql("INSERT INTO `qi_responses_ext` (`frid`,`fqid`,`answer`) VALUES ('".$respid."','".$currqid."','".$response."')");
    }

}
echo($respid);
?>