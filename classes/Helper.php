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
	static public function isISO8601($date){
		if (preg_match('/^([\+-]?\d{4}(?!\d{2}\b))((-?)((0[1-9]|1[0-2])(\3([12]\d|0[1-9]|3[01]))?|W([0-4]\d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]\d|[12]\d{2}|3([0-5]\d|6[1-6])))([T\s]((([01]\d|2[0-3])((:?)[0-5]\d)?|24\:?00)([\.,]\d+(?!:))?)?(\17[0-5]\d([\.,]\d+)?)?([zZ]|([\+-])([01]\d|2[0-3]):?([0-5]\d)?)?)?)?$/', $date) > 0) {
			return true;
		} else {
			return false;
		}
	}
	///
    public function isAnyEmpty($array, $exceptions=[]){
        if (empty($exceptions)){
            foreach ($array as $key => $value){
                if (is_array($value)){
                    return $this->isAnyEmpty($value, $exceptions);
                }else {
                    if (empty($value) || $value == 'null'  || $value == null) {
                        if ($value != '0') {
                            return $key;
                        }
                    }
                }
            }
            return false;
        }else {
            foreach ($array as $key => $value){
                if (is_array($value)){
                    return $this->isAnyEmpty($value, $exceptions);
                }else {
                    if (empty($value) || $value == 'null' || $value == null) {
                        if (!in_array($key, $exceptions)){
                            if ($value != '0') {
                                return $key;
                            }
                        }
                    }
                }
            }
            return false;
        }
    }
    ///
	static public function isAnyInvalid($Params){
		/*
		*	this method is to check if any value is invalid and if it is, returns $key so we can show which parameter is invalid..!
		*
		*/
		$result = [];
		$AllowedStatus = ['NEW','PLANNED','DELETED'];
		$AllowedDurationUnits = ['HOURS','DAYS','WEEKS'];
		foreach($Params as $key => $value){
			if (!is_array($value)) {
				Switch($key){
					case 'status':
						$result[] =  (!in_array($value,$AllowedStatus)) ? $key : false;
						break;
					case 'name':
						$result[] = (strlen($value)>255) ? $key : false;
						break;
					case 'start_date':
						$result[] = (!Helper::isISO8601($value)) ? $key : false;
						break;
					case 'end_date':
						$result[] = (empty($value) || strtotime($value) < strtotime($Params['start_date'])) ? $key : false;
						break;
					case 'durationUnit':
						$result[] = (!in_array($value, $AllowedDurationUnits)) ? $key : false;
						break;
					case 'color':
						$result[] = (empty($value) || strlen($value)>7 || !str_contains($value, '#'))? $key : false;
						break;
					case 'externalId':
						$result[] = (empty($value) || strlen($value)>255) ? $key : false;
						break;
					case 'Id':
						$result[] = false;
						break;
					case 'table':
						$result[] = false;
						break;
					default:
						$result[] = $value;
						break;
				}
			}else {
				return Helper::isAnyInvalid($value);
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
						$duration = $Diff->d;
						break;
					case 'HOURS':
						$duration = $Diff->h;
						break;
					case 'WEEKS':
						$duration = intval($Diff->days) / 7;
						break;	
				}
			$Params['duration'] = intval($duration);
		}
		foreach($Params as $key => $value){
			if ($key!='Id' && $key != 'table') {
				$comma = ($i < count($Params)-3) ? ',': '';
				$QueryString .= $key.'=\''.$value.'\''.$comma;
				$i++;
			}
		}
		return $QueryString;
	}

}








?>