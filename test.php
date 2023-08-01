<?php 
require_once 'Autoloader.php';
Autoloader::register();

/**
 *  WELCOME TO TEST PAGE
 */
class Test 
{
	function __construct($url, $data)
	{
		$this->url = $url;
		$this->data = $data;
	}
	public function Init(){
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $this->url);
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
	    curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,["Cache-Control: no-cache"]);//["Content-Type: text/xml","Cache-Control: no-cache"]
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}

	/*
	* Only 1 parameter is enough to Insert, this can be customized in index.php by adding a field to the necessities list
	* If action==Alter, Id And Only 1 parameter is Necessary
	*/
   
	// Here Are Some Samples for Get Methods
	// $url = 'http://sorupaneli.com/DevTest/?ConstructionStages/GetAll';
	// $url = 'http://sorupaneli.com/DevTest/?ConstructionStages/GetAll/table/{table}';
	// $url = 'http://sorupaneli.com/DevTest/?ConstructionStages/GetSingle/{Id}';
	// $url = 'http://sorupaneli.com/DevTest/?ConstructionStages/GetSingle/Id/{table}';

	$url = 'http://sorupaneli.com/DevTest/';
	$data = [
		'Id'=>'13',
		'name'=> 'Name Or Title right here',
		'status'=>'NEW',
		'durationUnit'=>'DAYS',
		'color'=>NULL,
		'start_date'=>'2015-03-15T12:10:22.288Z',
		'end_date'=>'2015-03-09T10:06:58.288Z',
		'externalId'=>NULL,
		'action'=>'Alter',// or Insert
		'table'=>'construction_stages',// optional parameter
		'class'=>'ConstructionStages' // optional parameter

	];

	$xmlData['params'] =  '<?xml version="1.0"?>
				<root>
					<Id>16</Id>
					<name>Name Or Title</name>
					<status>NEW</status>
					<durationUnit>DAYS</durationUnit>
					<color/>
					<start_date>2015-03-15T12:10:22.288Z</start_date>
					<end_date>2015-03-09T10:06:58.288Z</end_date>
					<externalId/>
					<action>Alter</action>
					<table>construction_stages</table>
					<class>ConstructionStages</class>
				</root>';

	header('Content-Type: Application/json');
	$Test = new Test($url, $data);
	echo $Test->Init();

?>