<?php

class ConstructionStages
{
	private $db;

	public function __construct()
	{
		$this->db = Api::getDb();
	}

	public function GetAll()
	{
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
			FROM construction_stages
		");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function GetSingle($Params)
	{
		$table = $Params['table'] ?? 'construction_stages';
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
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	///
	public function Delete($Params){
		/*
		* Returns a proper ErrorMessage in Every scenario
		*/
		$Table = $Params['table'];
		try {
			//$del = $this->db->query("DELETE FROM {$Table} WHERE ID='{$Params['Id']}' ");
			$del = $this->db->query("UPDATE {$Table} SET status='DELETED' WHERE ID='{$Params['Id']}' ");
			if ($del) {
				$result = ['outcome'=>true,'Deleted'=>$Params['Id']];
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
		/* 
		*  Returns Id and the parameters back on success or
		*  Returns a proper ErrorMessage in Every scenario
		*/
		$Table = $Params['table'];
		try {
			$QueryString = Helper::prepare($Params);
			$Update = $this->db->query("UPDATE {$Table} SET ".$QueryString." WHERE ID='{$Params['Id']}' ");
			if ($Update) {
				$result = ['outcome'=>true,'Id'=>$Params['Id'],'data'=>$Params];
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
		/*
		*  In this case, ID Column is auto_increment
		*  Returns Parameters back on success or
		*  Returns a proper ErrorMessage in Every scenario
		*/
		$Table = $Params['table'];
		try {
			$QueryString = Helper::prepare($Params);
			$Insert = $this->db->query("INSERT INTO {$Table} SET ".$QueryString." ");
			if ($Insert) {
				$result = ['outcome'=>true,'parameters'=>$Params];
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'Internal-Error'];
			}
		} catch (Exception $e){
			$result = ['outcome'=>false,'ErrorMesage'=>'External-Error']; // we can also return $e->getMessage()
		}
		return $result;
	}


}
