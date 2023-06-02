<?php 

function test(){
	/*
	* Only 1 parameter is enough to Insert, Can be customized in index.php by adding the field to the necessities list
	* If Alter, Id And is Necessary
	*/

	// Here Are Some Samples for Get Methods
	$url = 'http://sorupaneli.com/devtest/?ConstructionStages/GetAll';
	$url = 'http://sorupaneli.com/devtest/?ConstructionStages/GetAll/table/construction_stages';
	$url = 'http://sorupaneli.com/devtest/?ConstructionStages/GetSingle/Id';
	$url = 'http://sorupaneli.com/devtest/?ConstructionStages/GetSingle/Id/construction_stages';
	//

	$url = 'http://sorupaneli.com/devtest/';
	$data = [
		'Id'=>'13',
		'name'=> 'Name Or Title right',
		'status'=>'NEW',
		'durationUnit'=>'DAYS',
		'color'=>NULL,
		'table'=>'construction_stages',// optional parameter
		'start_date'=>'2015-03-15T12:10:22.288Z',
		'end_date'=>'2015-03-09T10:06:58.288Z',
		'externalId'=>NULL,
		'action'=>'Alter',
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
