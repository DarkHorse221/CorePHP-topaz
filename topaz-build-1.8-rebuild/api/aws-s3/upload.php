<?php
define('TOPAZ', true);
require '../../_constants/constants.php';
require '../../_functions/strings.php'; 
require 'api/aws/aws-autoloader.php';

//get variables
$objectkey = cleanInput($_GET['objectname']);
$objectsource = cleanInput($_GET['objectsource']);
$objectsourceid = cleanInput($_GET['objectsourceid']);
	
$bucket = AWS_BUCKET;
$secretkey = AWS_SECRET_KEY;
$keysecret = AWS_KEY_SECRET;

//define upload locations
if($objectsource == 'display') { $ext = '../../_uploads/files/'; }
if($objectsource == 'references') { $ext = '../../_uploads/files/_references/'; }
if($objectsource == 'checklists') { $ext = '../../_uploads/files/_checklists/'; }
if($objectsource == 'education') { $ext = '../../_uploads/files/_education/'; }
if($objectsource == 'user') { $ext = '../../_files/'.$objectsourceid.'/'; }

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// Instantiate the client.
$s3 = S3Client::factory(array(
	'credentials' => [
		'key'    => $secretkey,
		'secret' => $keysecret,
		],
	'region' => 'ap-southeast-2',
	'version' => 'latest'
));

try {
  // Upload data.
   $result = $s3->putObject(array(
	   'Bucket' => $bucket,
	   'Key'    => $objectkey,
	   'SourceFile'   => $ext.$objectkey
   ));
   return $result['ObjectURL'];
	
} catch (S3Exception $e) {
	return false;
}
?>