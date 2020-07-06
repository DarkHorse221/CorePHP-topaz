<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }

function export($filename = 'Document_Manager_Export') {
    $csv_terminated = "\n";
    $csv_separator = ",";
    $csv_enclosed = '"';
    $csv_escaped = "\\";
	$out .= "Doc No.,Document Name,Document Type,Implement Date,Review Date,Author,Reviewer,Approver,Status,PDF,DOC,Version,Category\n";
	$q_topcat = sql("SELECT dt.lft, dt.rgt, dp.name FROM document_properties dp LEFT JOIN document_tree dt ON dt.id=dp.did WHERE dt.parent_id = '1' ORDER BY dt.lft");
	
	while($r_topcat = mysqli_fetch_assoc($q_topcat)) {
		$lft = $r_topcat['lft']; $rgt = $r_topcat['rgt']; $total = $rgt - $lft;
		if($total > 1) { //get the sub pages
			$q_dp = sql("SELECT dp.docno, dp.name, tl.name, dp.imp_date, dp.rev_date, dp.author, dp.reviewer, dp.approver,dp.active,dpe.pdf,dpe.doc,dpe.version FROM document_tree dt LEFT JOIN document_properties dp ON dt.id=dp.did LEFT JOIN type_list tl ON tl.id=dp.doc_type LEFT JOIN document_properties_ext dpe ON dp.did=dpe.did ORDER BY dp.docno ASC"); $c_dp = mysqli_num_rows($q_dp); $si = '';
			// Format the data
			if($c_dp) { $cf_dp = mysqli_num_fields($q_dp);
				while ($r_dp = mysqli_fetch_array($q_dp)) {
					$i = 0; 
					while($i < $cf_dp) { 
						if($i == ($cf_dp - 1)) { 
						$name = str_replace('&#39;','\'',$r_topcat['name']); $ext = $name.$csv_terminated; } else { $ext = ''; }
						$text = str_replace('&#39;','\'',$r_dp[$i]); $si .= $csv_enclosed.$text.$csv_enclosed.$csv_separator.$ext;
						$i++;
					} // end while
				} // end while
				$out .= $si;
			} //c_data
		} //$total
	} //end while
	$filename = $filename."_".date("d-m-Y_H-i-s",time()).".csv";
  	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  	header("Content-Length: " . strlen($out));
   	header("Content-type: text/x-csv");
   	header("Content-Disposition: attachment; filename=$filename");
    echo $out;
	exit;
}
export();
?>