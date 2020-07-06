<?php
define('TOPAZ', true);
require '../../_constants/constants.php';
require '../../_constants/db.php';
require '../../_functions/strings.php';
require '../../_functions/requests.php';
require 'api/aws/aws-autoloader.php';

//get variables
$sess = cleanInput($_GET['s']);
$objectkey = cleanInput($_GET['objectname']);
$ext = getExt($objectkey);
$bucket = AWS_BUCKET;
$secretkey = AWS_SECRET_KEY;
$keysecret = AWS_KEY_SECRET;

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
    if(!userID($sess)) { $objectkey = ''; $bucket = ''; }
	
		// Get the object.
		$result = $s3->getObject([
			'Bucket' => $bucket,
			'Key'    => $objectkey
		]);
		// Display the object in the browser.
		header("Content-Type: {$result['ContentType']}");
		if($ext !== 'pdf') { header("Content-Disposition:attachment;filename=".$objectkey.""); }
		echo $result['Body'];
	
		} catch (S3Exception $e) {
			echo $e->getMessage() . PHP_EOL;
	}
?>