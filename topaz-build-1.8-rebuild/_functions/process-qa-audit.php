<?php define('TOPAZ', true);
include('../_constants/constants.php'); include('../_constants/db.php'); include('strings.php'); include('requests.php');
foreach ($_GET['item'] as $position => $item) {
	$q_upd = sql("UPDATE `qa_checklist_q` SET `order` = '".$position."' WHERE `id` = '".$item."'");
}
if($q_upd) { $success[] = sysMsg(36); $msg = '<div class="errors">'.writeMsgs($success, "success").'</div>'; } else { $err[] = sysMsg(8); $msg = writeMsgs($err); }
print($msg);
?>