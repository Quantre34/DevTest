<?php 

function test(){
	/*
	* Only 1 parameter is enough to Insert, Can be customized in index.php
	* If Alter, Id And is Necessary
	*/
	$url = 'http://localhost/devtest/?ConstructionStages/GetAll';
	$url = 'http://localhost/devtest/?ConstructionStages/GetAll/table/construction_stages';
	$url = 'http://localhost/devtest/?ConstructionStages/GetSingle/Id';
	$url = 'http://localhost/devtest/?ConstructionStages/GetSingle/Id/construction_stages';
	$url = 'http://localhost/devtest/';
	$data = [
		'Id'=>'13',
		'name'=> 'Name Or Title',
		'status'=>'NEW',
		'durationUnit'=>'DAYS',
		'color'=>NULL,
		'table'=>'construction_stages',// optional parameter
		'start_date'=>'2015-03-15T12:10:22.288Z',
		'end_date'=>'2015-03-09T10:06:58.288Z',
		'externalId'=>NULL,
		'action'=>'Insert',
		'class'=>'ConstructionStages' // optional parameter
	];

	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, @$data);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);                                                                    
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

$result = test();
echo $result;

?>
