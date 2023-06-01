<?php 

function test(){
	$data = [
		'Id'=>'12',
		'name'=> 'datum',
		'status'=>'DELETED',
		'durationUnit'=>'HOURS',
		'color'=>NULL,
		'table'=>'construction_stages',// its optional too
		'start_date'=>'2015-03-15T12:10:22.288T',
		'end_date'=>'2015-03-14T10:06:58.240Z',
		'externalId'=>NULL,
		'action'=>'Alter',
		'class'=>'constructionStages'
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

