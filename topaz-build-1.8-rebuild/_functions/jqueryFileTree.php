<?php define('TOPAZ', true);

include('../_constants/constants.php'); include('../_constants/db.php'); include('strings.php'); include('requests.php');

$_POST['dir'] = urldecode($_POST['dir']);

$q_subtree = sql("SELECT dt.id, dp.name, dp.link, dp.doc_type FROM document_tree dt, document_properties dp WHERE dt.id=dp.did AND dt.parent_id = '".$_POST['dir']."' AND dp.active = '1' ORDER BY dp.name ASC"); $c_subtree = mysqli_num_rows($q_subtree);
$sid = $_GET['sid']; if(userAuthorise($sid)) { $usr_unit = userUnit(userID($sid)); } 

if($c_subtree) { 
	echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
	
	while($r_subtree = mysqli_fetch_assoc($q_subtree)) {
		$q_temp = sql("SELECT st.link FROM system_templates st, system_templates_ext ste WHERE ste.stid=st.id AND ste.dtid= '".$r_subtree['doc_type']."'");
		$r_temp = mysqli_fetch_assoc($q_temp); $class = $r_temp['link'];
		
		if($class == "folder") {
			echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . $r_subtree['id'] . "/\">" . $r_subtree['name'] . "</a></li>";
		} else {
			if($class == "body") { $ext = "html"; } else { $ext = "pdf"; }
			echo "<li class=\"file ext_$ext\"><a href=\"" . WEBSITE_LOC.'?p='.$r_subtree['link'] . "\" rel=\"" . $r_subtree['id'] . "\">" . $r_subtree['name'] . "</a></li>";
		}
	}
	echo "</ul>";
	
} 

?>