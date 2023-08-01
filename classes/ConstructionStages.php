<?php

class ConstructionStages
{
	private $db;

	public function __construct()
	{
		$this->db = Api::getDb();
	}

	public function GetAll($Params)
	{	
		/*	@label GetAll
		*	@GetAll@param table (optional)
		*	@GetAll@return success: ['outcome'=>boolean,'data'=>[...]], fail: ['outcome'=>false,'ErrorMessage'=>'Explanation']
		*/
		try {
			$table = $Params['table'];
			$stmt = $this->db->prepare("
				SELECT
					ID as id,
					name, 
					DATE_FORMAT( CONVERT_TZ(start_date, @@session.time_zone, '+00:00')  ,'%Y-%m-%dT%TZ') as start_date,
					DATE_FORMAT( CONVERT_TZ(end_date, @@session.time_zone, '+00:00')  ,'%Y-%m-%dT%TZ') as end_date,
					duration,
					durationUnit,
					color,
					externalId,
					status
				FROM {$table}
			");
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if (count($data)) {
				$result = ['outcome'=>true,'data'=>$data];
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'No Such data!'];
			}
		} catch (Exception $e){
			$result = ['outcome'=>false,'ErrorMessage'=>'No Such data!'];
		}
	return $result;
	}

	public function GetSingle($Params)
	{	
		/*	@label GetSingle
		*	@GetSingle@param Id & table (optional)
		*	@GetSingle@return success: ['outcome'=>boolean,'data'=>[...]], fail: ['outcome'=>false,'ErrorMessage'=>'Explanation']
		*/
		try {
			$table = $Params['table'];
			$stmt = $this->db->prepare("
				SELECT
					ID as Id,
					name, 
					DATE_FORMAT( CONVERT_TZ(start_date, @@session.time_zone, '+00:00')  ,'%Y-%m-%dT%TZ') as start_date,
					DATE_FORMAT( CONVERT_TZ(end_date, @@session.time_zone, '+00:00')  ,'%Y-%m-%dT%TZ') as end_date,
					duration,
					durationUnit,
					color,
					externalId,
					status
				FROM {$table}
				WHERE ID = :Id
			");
			$stmt->execute(['Id' => $Params['Id']]);
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if (count($data)) {
				$result = ['outcome'=>true,'data'=>$data];
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'No Such data!'];
			}
		} catch (Exception $e){
			$result = ['outcome'=>false,'ErrorMessage'=>'No Such data!'];
		}
		return $result;
	}
	///
	public function Delete($Params){
		/*	@label Delete
		*	@Delete@param Id & table (optional)
		*	@Delete@return success: ['outcome'=>boolean,'Id'=>123], fail: ['outcome'=>false,'ErrorMessage'=>'Explanation']
		*/
		$Table = $Params['table'];
		try {
			//$del = $this->db->query("DELETE FROM {$Table} WHERE ID='{$Params['Id']}' ");
			$del = $this->db->query("UPDATE {$Table} SET status='DELETED' WHERE ID='{$Params['Id']}' ");
			if ($del) {
				$result = ['outcome'=>true,'Id'=>$Params['Id']];
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'Internal-Error'];
			}
		} catch (Exception $e) {
			$result = ['outcome'=>false,'ErrorMesage'=>'External-Error']; // we can also return $e->getMessage()
		}
		return $result;
	}
	///
	public function Alter($Params){
		/*	@label Alter
		*	@Alter@param Id & table & columns and values that going to be Altered (Id is necessary but table&class is optional, except these only one parameter is enough to Alterization) [Id,name,status,durationUnit,color,table,start_date,end_date,externalId,action,class=optional]
		*	@Alter@return success: ['outcome'=>boolean,'Id'=>123], fail: ['outcome'=>false,'ErrorMessage'=>'Explanation']
		*	@Info Alter Method can be used as Patch. takes [Id,action,parameter1]
		*/
		$Table = $Params['table'];
		try {
			$QueryString = Helper::prepare($Params);
			$Update = $this->db->query("UPDATE {$Table} SET ".$QueryString." WHERE ID='{$Params['Id']}' ");
			if ($Update) {
				$result = ['outcome'=>true,'Id'=>$Params['Id']];
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'Internal-Error'];
			}
		} catch (Exception $e) {
			$result = ['outcome'=>false,'ErrorMesage'=>'External-Error']; // we can also return $e->getMessage()
		}
		return $result;
	}
	///
	public function Insert($Params){
		/*	@label Insert
		*	@Insert@param Id & table & columns and values that going to be Inserted (Id is necessary but table is optional) [name,status,durationUnit,color,table,start_date,end_date,externalId,action,class=optional]
		*	@Insert@return success: ['outcome'=>boolean,'Id'=>123], fail: ['outcome'=>false,'ErrorMessage'=>'Explanation']
		*	@Insert@Info In this case, ID Column is auto_increment
		*/
		$Table = $Params['table'];
		try {
			$QueryString = Helper::prepare($Params);
			$Insert = $this->db->query("INSERT INTO {$Table} SET ".$QueryString." ");
			if ($Insert) {
				$result = ['outcome'=>true,'Id'=>$this->db->lastInsertId()];
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'Internal-Error'];
			}
		} catch (Exception $e){
			$result = ['outcome'=>false,'ErrorMesage'=>'External-Error']; // we can also return $e->getMessage()
		}
		return $result;
	}


}
