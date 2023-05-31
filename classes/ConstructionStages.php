<?php

class ConstructionStages
{
	private $db;

	public function __construct()
	{
		$this->db = Api::getDb();
	}

	public function getAll()
	{
		$stmt = $this->db->prepare("
			SELECT
				ID as id,
				name, 
				strftime('%Y-%m-%dT%H:%M:%SZ', start_date) as startDate,
				strftime('%Y-%m-%dT%H:%M:%SZ', end_date) as endDate,
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

	public function getSingle($Params)
	{
		$stmt = $this->db->prepare("
			SELECT
				ID as Id,
				name, 
				strftime('%Y-%m-%dT%H:%M:%SZ', start_date) as startDate,
				strftime('%Y-%m-%dT%H:%M:%SZ', end_date) as endDate,
				duration,
				durationUnit,
				color,
				externalId,
				status
			FROM construction_stages
			WHERE ID = :Id
		");
		$stmt->execute(['Id' => $Params['Id']]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	///
	public function Delete($Params){
		/*
		* Table can be Customized too
		* Returns a proper ErrorMessage in Every scenario
		*/
		$Table = $Params['Table'] ?? 'construction_stages';
		try {
			// $del = $this->db->query("DELETE FROM {$Table} WHERE ID='{$Params['Id']}' ");
			$del = $this->db->query("UPDATE {$Table} SET status='DELETED' WHERE ID='{$Params['Id']}' ");
			if ($del) {
				$result = ['outcome'=>true,'Deleted'=>$Params['Id']];
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'Internal-Error'];
			}
		} catch (Exception $e) {
			$result = ['outcome'=>false,'ErrorMesage'=>$e->getMessage()];
		}
		return $result;
	}
	///
	public function Alter($Params){
		$Table = $Params['table'] ?? 'construction_stages';
		$QueryString = Helper::prepare($Params);
		try {
			$Update = $this->db->query("UPDATE {$Table} SET ".$QueryString." WHERE ID='{$Params['Id']}' ");
			if ($Update) {
				$result = ['outcome'=>true,'Altered'=>$Params['Id']];
			}else {
				$result = ['outcome'=>false,'ErrorMessage'=>'Internal-Error'];
			}
		} catch (Exception $e) {
			$result = ['outcome'=>false,'ErrorMessage'=>$e->getMessage()];
		}
		return $result;
	}
	///
	public function Insert(){
		$Insert = $this->db->query("INSERT INTO ");
	}
	public function post(ConstructionStagesCreate $data)
	{
		$stmt = $this->db->prepare("
			INSERT INTO construction_stages
			    (name, start_date, end_date, duration, durationUnit, color, externalId, status)
			    VALUES (:name, :start_date, :end_date, :duration, :durationUnit, :color, :externalId, :status)
			");
		$stmt->execute([
			'name' => $data->name,
			'start_date' => $data->startDate,
			'end_date' => $data->endDate,
			'duration' => $data->duration,
			'durationUnit' => $data->durationUnit,
			'color' => $data->color,
			'externalId' => $data->externalId,
			'status' => $data->status,
		]);
		return $this->getSingle($this->db->lastInsertId());
	}

}
