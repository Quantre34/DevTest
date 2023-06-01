<?php
require_once 'Autoloader.php';
Autoloader::register();
// error_reporting(0);
class Api
{
	private static $db;
	public static function getDb()
	{
		return self::$db;
	}

	/*  
	* Old code wasnt working properly actually. 
	* call_user_func_array([new $target['class'], $target['method']], $params); was returning errors when i use array as parameters
	* "PATH_INFO"  was causing errors.
	*/

	public function __construct(){

		$Method = strtolower($_SERVER['REQUEST_METHOD']) ?? 'get';
		self::$db = (new Database())->init();
		$uri = explode('/', $_SERVER['QUERY_STRING']);
		if ($Method=='get') {
			$routes = [
				'constructionStages'=>[
					'GetAll',
					'GetSingle',
					'Delete'
				],
				'SomOtherclass'=>[
					'AndItsMethods'
				]
			];
			if (array_key_exists($uri[0], $routes)) {
				if (in_array($uri[1],$routes[$uri[0]])) {
					$params = [
						'Id'=>@$uri[2],
						'table'=>@$uri[3]
					];
					$result = Helper::CallUserFunc([$uri[0],$uri[1]],$params);
				}else {
					$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route!'];
				}
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route!'];
			}
		}elseif($Method=='post'){

			$params = @$_POST;

			$routes = [
				'constructionStages'=>[
					'Insert',
					'Alter'			
				],
				'SomOtherclass'=>[
					'AndItsMethods'
				]
			];

			$params['class'] = $params['class'] ?? 'constructionStages';
			if (array_key_exists($params['class'], $routes)) {
				if (in_array($params['action'],$routes[$params['class']])) {
					$AnyInvalid = Helper::isAnyInvalid($params,['color','externalId','end_date','Id','table','class','action'],['name','start_date','durationUnit','status']);// $Parameters to sent in && Exceptions which is not going to be Checked if is valid or not && Necessary data
					if(!$AnyInvalid){
						$result = Helper::CallUserFunc([$params['class'],$params['action']], $params);
					}else {
						$result = ['outcome'=>false,'ErrorMessage'=>'Invalid Parameter : '.$AnyInvalid];
					}
				}else {
					$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route: action'];
				}
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route: class'];
			}

		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}





}


new Api();