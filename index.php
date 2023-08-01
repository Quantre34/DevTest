<?php
require_once 'Autoloader.php';
Autoloader::register();


class Api
{
	private static $db;
	public static function getDb()
	{
		return self::$db;
	}

	public function __construct(){

		/* 
		*	@author Quantre34
		*	@label Api
		*	@Api@param $_GET || $_POST 
		*	@Api@return success: ['outcome'=>boolean,'data'=>[...] or 'Id'=>'000'], fail: ['outcome'=>false,'ErrorMessage'=>'Explanation']
		*	@Api@Info Data Type : json && xml
		*/

		$Method = strtolower($_SERVER['REQUEST_METHOD']) ?? 'get';
		self::$db = (new Database())->init();
		$uri = explode('/', $_SERVER['QUERY_STRING']);
		$routes = Helper::ParseYamlFile('Doc.yaml');
		$route = $routes[$Method];
		if ($Method=='get') {
			if (array_key_exists($uri[0], $route)) {
				if (in_array($uri[1],$route[$uri[0]])) {
					$params = [
						'Id'=>@$uri[2],
						'table'=> $uri[3] ?? 'construction_stages'
					];
					$result = Helper::CallUserFunc([$uri[0],$uri[1]],$params);
				}else {
					$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route!'];
				}
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route!'];
			}
		}elseif($Method=='post'){
			if (Helper::isXml($_POST['params'] ?? $_POST)) {
				$params = Helper::Xml2Array($_POST['params']);
			}else {
				$params = $_POST;
			}
			$params['class'] = $params['class'] ?? 'ConstructionStages'; // Setting default class
			$params['table'] = $params['table'] ?? 'construction_stages'; // Setting default table
			$exceptions = ['color','externalId','end_date','Id','table','class','action'];
			$necessities = ($params['action']=='Alter' && empty($Params['Id']))? ['Id'] : []; // we can customize the Necessity list according to action if desired
			if (array_key_exists($params['class'], $route)) {
				if (in_array($params['action'],$route[$params['class']])) {
					$AnyInvalid = Helper::isAnyInvalid($params,$exceptions,$necessities);// $Parameters to sent in && Exceptions which is not going to be Checked if is valid or not && Necessary data list which represent the data Client has to send if is there any -> sample ['name','start_date','durationUnit','status']
					if(!$AnyInvalid){
						$result = Helper::CallUserFunc([$params['class'],$params['action']], $params);
					}else {
						$result = ['outcome'=>false,'ErrorMessage'=>'Invalid Parameter : '.$AnyInvalid];
					}
				}else {
					$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route!'];
				}
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route!'];
			}

		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}


}


new Api();