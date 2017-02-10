<?php

class Operator extends BaseModel{
		public $id;
		public $name;
		public $password;
		public $owner;

		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Operator');
			$query->execute();
			$rows = $query->fetchAll();
			$operators = array();

			foreach($rows as $row){
				$operators[] = new Operator(array(
					'id' => $row['id'],
					'name' => $row['name'],
					'password' => $row['password'],
					'owner' => $row['owner']
					));
			}
			return $operators;
		}

		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Operator WHERE id = :id');
			$query->execute(array('id' => $id));
			$row = $query->fetch();

			if($row){
				$operator = new Operator(array(
					'id' => $row['id'],
					'name' => $row['name'],
					'password' => $row['password'],
					'owner' => $row['owner']
				));
				return $operator;

			}else{
				return null;
			}
		}

		public static function authenticate($name, $password){
			$query = DB::connection()->prepare('SELECT * FROM Operator' . ' WHERE name=:name AND password=:password ' . 'LIMIT 1');
			$query->execute(array('name' => $name, 'password' => $password));
			$row = $query->fetch();
			if($row){
				$operator = new Operator(array(
					'id' => $row['id'],
					'name' => $row['name'],
					'password' => $row['password']
					));
				return $operator;
			}else{
				return null;
			}
		}

}