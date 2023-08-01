<?php 

/**
 * 
 */
class Helper
{
	private $db;
	function __construct()
	{
		$this->db = Api::getDb();
	}

	static public function CallUserFunc($Arr,$Params){
		/*
		*	@param both array, class and method names && Parameters to send in this class|method
		*	@return result of the Method of the Class that is called
		*	@Info call_user_func_array Func was causing error with arrays, like arrays passing as string or only the first element passes. so i wrote it myself
		*/
		$Func = new $Arr[0];
		$result = [$Func, $Arr[1]]($Params);
		return json_encode($result);
	}
	static public function isISO8601($value){
	    $results = array();
	    $results[] = \DateTime::createFromFormat("Y-m-d\TH:i:s",$value);
	    $results[] = \DateTime::createFromFormat("Y-m-d\TH:i:s.u",$value);
	    $results[] = \DateTime::createFromFormat("Y-m-d\TH:i:s.uP",$value);
	    $results[] = \DateTime::createFromFormat("Y-m-d\TH:i:sP",$value);
	    $results[] = \DateTime::createFromFormat(DATE_ATOM,$value);

	    $success = array_values(array_filter($results));
	    if(count($success) > 0) {
	        return true;//$success[0];
	    }
	    return false;
	}
    ///
	static public function isAnyInvalid($Params,$exceptions=[], $necessities=[]){
		/*	@param parameters which have to be checked if is Valid or not && $exceptions list that cant be checked && List of required parameters
		*	@return false if All parameters except the ones in the exception list are valid && $key of the parameter for invalid parameter
		*/
		$result = [];
		$AllowedStatus = ['NEW','PLANNED','DELETED'];
		$AllowedDurationUnits = ['HOURS','DAYS','WEEKS'];
		foreach($Params as $key => $value){
			if (!in_array($key, $exceptions)) {
				if (!is_array($value)) {
					Switch($key){
						case 'status':
							$result[] =  (empty($value) || !in_array($value, $AllowedStatus)) ? $key : false;
							break;
						case 'name':
							$result[] = (empty($value) || strlen($value) > 255) ? $key : false;
							break;
						case 'start_date':
							$result[] = (empty($value) || !Helper::isISO8601($value)) ? $key : false;
							break;
						case 'end_date':
							$result[] = (!empty($value) && strtotime($value) <= strtotime($Params['start_date']) || !Helper::isISO8601($value)) ? $key : false;
							break;
						case 'durationUnit':
							$result[] = (!in_array($value, $AllowedDurationUnits)) ? $key : false;
							break;
						case 'color':
							$result[] = (strlen($value) > 7 || !str_contains($value, '#')) ? $key : false;
							break;
						case 'externalId':
							$result[] = (strlen($value) > 255) ? $key : false;
							break;
						default:
							$result[] = $key; /// causes error when an unexpected data is sent
							break;
					}
				}else {
					return Helper::isAnyInvalid($value);
				}
			}	
		}
		foreach($necessities as $Necessity){
			if (!array_key_exists($Necessity, $Params)) {
				return $Necessity;
			}
		}
		foreach($result as $row){
			if ($row) {
				return $row;
			}
		}
		return false;
	}
	///
	static public function prepare($Params){
		/*
		*	@param requires the parameters desired to be Inserted or Altered (column names and values)
		*	@return string to be used in sql command
		*/
		$columns = '';
		$values = [];
		$i = 0;
		$QueryString = '';
		if (!empty($Params['start_date']) && !empty($Params['end_date']) && !empty($Params['durationUnit'])) {
			$date1 = new DateTime($Params['start_date']);
			$date2 = new DateTime($Params['end_date']);
			$Diff = $date1->diff($date2);
			switch ($Params['durationUnit']) {
				case 'DAYS':
					$duration = $Diff->days;
					break;
				case 'HOURS':
					$duration = (intval($Diff->days * 24) + $Diff->h);
					break;
				case 'WEEKS':
					$duration = intval($Diff->days) / 7;
					break;	
			}
			$Params['duration'] = intval($duration);
		}
		$Defaults = ['Id','table','class','action'];
		foreach($Defaults as $row){
			if (in_array($row, $Defaults)) {
				unset($Params[$row]);
			}
		}
		foreach($Params as $key => $value){
			$value = htmlspecialchars((empty($value))? NULL : '');
			$comma = ($i < count($Params)-1) ? ',': '';
			$QueryString .= $key.'=\''.$value.'\''.$comma;
			$i++;
		}
		return $QueryString;
	}
	///
	static public function ParseYamlFile($file){
	    $yamlContents = file_get_contents($file);
	    return yaml_parse($yamlContents);
	}
	///
	static public function EmitYamlFile($file, $data){
		return yaml_emit_file($file, $data);
	}
	///
	static public function Array2Xml($array, $rootElement = null, $xml = null) {
	    $_xml = $xml;
	     
	    // If there is no Root Element then insert root
	    if ($_xml === null) {
	        $_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
	    }
	     
	    // Visit all key value pair
	    foreach ($array as $k => $v) {
	         
	        // If there is nested array then
	        if (is_array($v)) {
	             
	            // Call function for nested array
	            arrayToXml($v, $k, $_xml->addChild($k));
	            }
	             
	        else {
	             
	            // Simply add child element.
	            $_xml->addChild($k, $v);
	        }
	    }
	     
	    return $_xml->asXML();
	}
	///
	static public function Xml2Array($data){
		return json_decode(json_encode(simplexml_load_string($data)), true);
	}
	///
	static public function isXml($value){
		if (!is_array($value)) {
		    $prev = libxml_use_internal_errors(true);
		    $doc = simplexml_load_string($value);
		    $errors = libxml_get_errors();
		    libxml_clear_errors();
		    libxml_use_internal_errors($prev);
		    return false !== $doc && empty($errors);
		}else {
			return false;
		}
	}

}







?>