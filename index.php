<?php
require_once 'Autoloader.php';
header('Content-Type: application/json');
Autoloader::register();


class Api
{
	private static $db;

	public static function getDb()
	{
		return self::$db;
	}



	/*  
	*
	* Old code wasnt working for getSingle method. 
	* call_user_func_array([new $target['class'], $target['method']], $params); was returning errors when i use array as parameters
	* "PATH_INFO"   was causing errors.
	*/
	/* Branch 1 */
	public function __construct(){

		$Method = strtolower($_SERVER['REQUEST_METHOD']) ?? 'cli';
		self::$db = (new Database())->init();
		$uri = explode('/', $_SERVER['QUERY_STRING']);
		if ($Method!=='get') {
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
						'Table'=>@$uri[3]
					];
					$result = Helper::CallUserFunc([$uri[0],$uri[1]],$params);
				}else {
					$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route!'];
				}
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route!'];
			}
		}elseif($Method!=='post'){
			$params = [
				'class'=>'constructionStages',/// this  parameter is optional. if we use it in our own, then we may want to customize class and methods too.
				'action'=>'Alter', ///
				'params'=>[
					'Id'=>'15',
					'status'=>'PLANNED',
					'durationUnit'=>'DAYS',
					'color'=>'#FF0000',
					'table'=>'construction_stages'// its optional too
				]
			];
			$routes = [
				'constructionStages'=>[
					'Delete',
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
					$filter = Helper::isAnyInvalid($params['params']);
					if(!$filter){
						$result = Helper::CallUserFunc([$params['class'],$params['action']], $params['params']);
					}else {
						$result = ['outcome'=>false,'ErrorMessage'=>'Invalid Parameter : '.$filter];
					}
				}else {
					$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route!'];
				}
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'No Such Route!'];
			}

		}
		echo json_encode($result);
	}
	/* Brach 1 */





}


new Api();