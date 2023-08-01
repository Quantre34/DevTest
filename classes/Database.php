<?php

class Database
{
	// const name = 'sorupane_testDb';
	// const User = 'sorupane_sorupanelicomuser';
	// const Pass = '13979997622sorupaneli';
	const name = 'test_db';
	const User = 'root';
	const Pass = '';
	private $db;

	public function init()
	{
		
		/*
		*	Old PDO Connection wasnt successfull, didnt respond to actions
		*	$this->db = new PDO('sqlite:'.self::name.'.db', self::User, self::Pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		*/

		$this->db = new PDO("mysql:host=localhost;dbname=".self::name.";charset=utf8",self::User,self::Pass);
		$this->createTables();
		$stmt = $this->db->query('SELECT 1 FROM construction_stages LIMIT 1');
		if (!$stmt->fetchColumn()) {
			$this->loadData();
		}
		return $this->db;
	}

	private function createTables()
	{
		$sql = file_get_contents('database/structure.sql');
		$this->db->exec($sql);
	}

	private function loadData()
	{
		$sql = file_get_contents('database/data.sql');
		$this->db->exec($sql);
	}
}