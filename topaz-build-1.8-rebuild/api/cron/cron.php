<?php
define('TOPAZ', true);
include('../../_constants/constants.php'); include('../../_constants/db.php'); include('../../_functions/requests.php'); include('../../_functions/strings.php'); include('../../_functions/class.phpmailer.php');
include('../../_functions/mailout.php'); $date = new DateTime('now'); $curr_date = $date->format('Y-m-d');
$q_mail = sql("SELECT * FROM `mail_queue` WHERE `mail_date` <= '".$curr_date."' ORDER BY `id` ASC LIMIT 0, ".MAIL_SEND_LIMIT."");
while($r_mail = mysqli_fetch_array($q_mail)) { 
$m = smtpmailer($r_mail['to'], $r_mail['from'], $r_mail['from_name'], $r_mail['subject'], $r_mail['body'], $r_mail['authcode']);
if($r_mail['del']) { $q_del = sql("DELETE FROM `mail_queue` WHERE `id` = '".$r_mail['id']."'"); }
}
?>