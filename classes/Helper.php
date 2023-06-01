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
		/*
		*	this method is to check if any value is invalid and if it is, returns $key so we can show which parameter is invalid to the api client..!
		*
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
							$result[] = (!empty($value) && strtotime($value) < strtotime($Params['start_date']) || !Helper::isISO8601($value)) ? $key : false;
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
							$result[] = $key; /// cause error when an unexpected data is sent
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
			$comma = ($i < count($Params)-1) ? ',': '';
			$QueryString .= $key.'=\''.$value.'\''.$comma;
			$i++;
		}
		return $QueryString;
	}

}







?>