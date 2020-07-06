<?php define('TOPAZ', true);
include('../_constants/constants.php'); include('../_constants/db.php'); include('strings.php'); include('requests.php');
$search = cleanInput($_POST['queryString']);
$q_search = sql("SELECT `did`, `name`, `link`, MATCH(`name`, `link`, `docno`) AGAINST ('".$search."*' IN BOOLEAN MODE) AS `score` FROM `document_properties` WHERE MATCH(`name`, `link`, `docno`) AGAINST ('".$search."*' IN BOOLEAN MODE) AND `active` = '1' ORDER BY `score` DESC LIMIT 0,".SEARCH_ROWS."");
$c_search = mysqli_num_rows($q_search); $docs = '';
if($c_search) { $i = 2;
	while($r_search = mysqli_fetch_assoc($q_search)) {
		$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
		$docs .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_REF.'?p='.$r_search['link'].'">'.$r_search['name'].'</a></td><td>'.($r_search['score']*100).'%</td></tr>';
		$i++;
	}
	$msg = '<table id="search" class="tablesorter"><thead><tr><th>Document</th><th>Match (%)</th></tr></thead><tbody>'.$docs.'</tbody></table>';
} else { $msg = '<p>No documents that match your search criteria.</p>'; }
echo('<br /><h1>Search Results</h1>'.$msg);
?>