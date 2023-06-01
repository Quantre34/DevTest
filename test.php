<?php 

function test(){
	$data = [
		'Id'=>'13',
		'name'=> 'Cansu Özmen\'s Company',
		'status'=>'NEW',
		'durationUnit'=>'DAYS',
		'color'=>NULL,
		'table'=>'construction_stages',// optional parameter
		'start_date'=>'2015-03-15T12:10:22.288Z',
		// 'end_date'=>'2015-03-09T10:06:58.288Z',
		'externalId'=>NULL,
		'action'=>'Alter',
		// 'class'=>'ConstructionStages' // optional parameter
	];

	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/devtest/');
    curl_setopt($ch, CURLOPT_POST, true);
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
