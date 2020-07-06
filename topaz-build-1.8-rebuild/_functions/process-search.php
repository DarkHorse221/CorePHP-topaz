<?php define('TOPAZ', true);
include('../_constants/constants.php'); include('../_constants/db.php'); include('strings.php'); include('requests.php'); include('../_modules/standard_arrays.php');
$search = cleanInput($_POST['queryString']);

$q_search = sql("SELECT `did`, `name`, `link`, `keywords`,
		MATCH (`name`) AGAINST ('".$search."*' IN BOOLEAN MODE) AS rel1,
		MATCH (`link`) AGAINST ('".$search."*' IN BOOLEAN MODE) AS rel2,
		MATCH (`keywords`) AGAINST ('".$search."*' IN BOOLEAN MODE) AS rel3,
		MATCH (`gentext`) AGAINST ('".$search."*' IN BOOLEAN MODE) AS rel4
		FROM `document_search`
		WHERE MATCH(`name`, `link`, `keywords`, `gentext`) AGAINST ('".$search."*' IN BOOLEAN MODE) AND `active` = '1'
		ORDER BY (rel1*2)+(rel2*0.5)+(rel3*1.5)+(rel4) DESC LIMIT 0,".SEARCH_ROWS."
		");

$c_search = mysqli_num_rows($q_search); $docs = '';

if($c_search) { $i = 2;
	while($r_search = mysqli_fetch_assoc($q_search)) {
		$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
		$score = ($r_search['rel1']*2)+($r_search['rel2']*0.5)+($r_search['rel3']*1.5)+($r_search['rel4']);
		if($i == '2') { $int_score = $score; }
		$disp_score = $score / $int_score*100;
		
		//add keywords
		if(!$r_search['keywords']) { $kw = 'not matched'; } else {
			$strlen = strlen($r_search['keywords']);
			if($strlen < 50) { $len = $strlen; } else { //cap length
				$len = 50;
			}
			$pos = strpos($r_search['keywords'],',', $len);
			$kw = substr($r_search['keywords'],0,$pos); 
		 }
		$docs .='<tr '.$tr_style.'><td><a href="'.WEBSITE_REF.'?p='.$r_search['link'].'">'.$r_search['name'].'</a>';
		//add keywords
		$docs .='<br /><span style="color: #CCC; font-size:0.9em; line-height: 20px;">&nbsp;&nbsp;Keywords: '.$kw.'</span><br />';
		$docs .='</td><td>'.number_format($disp_score, 2, '.', '').'%</td></tr>';
		$i++;
	}
	$msg = '<table id="search" class="tablesorter"><thead><tr><th>Document</th><th>Match (%)</th></tr></thead><tbody>'.$docs.'</tbody></table>';
} else { $msg = '<p>No documents that match your search criteria.</p>'; }
echo($msg);
?>