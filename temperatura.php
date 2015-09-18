<?php

header('Access-Control-Allow-Origin: *');

$m = new MongoClient();

$db = $m->test;

$collection = $db->temperatura;

$value = $_GET["value"];

if( $value != null) {
	$document = array( "value" => $value);
	$collection->drop();
	$collection->insert($document);
} else {
	$cursor = $collection->find();

	$data = array();

	foreach ($cursor as $document) {
		array_push($data, $document["value"]);
	}

	echo json_encode($data);
}
?>
