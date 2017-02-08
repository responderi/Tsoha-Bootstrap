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

			}
		}

		public static function findName($name){
			$query = DB::connection()->prepare('SELECT * FROM Operator WHERE name = :name');
			$query->execute(array('name' => $name));
			$row = $query->fetch();

			if($row){
				$operator = new Operator(array(
					'id' => $row['id'],
					'name' => $row['name'],
					'password' => $row['password'],
					'owner' => $row['owner']
				));
				if(isset($operator)){
					return $operator;
				}

			}
		}

		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Operator (name, password, owner) VALUES (:name, :password, :owner) RETURNING id');
			$query->execute(array('name' => $this->name, 'password' => $this->password, 'owner' => $this->owner));
			$row = $query->fetch();
			$this->id = $row['id'];
		}
	}