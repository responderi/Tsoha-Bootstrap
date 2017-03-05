<?php

class Operator extends BaseModel{
		public $id;
		public $name;
		public $password;

		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_name', 'validate_password');
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
					'password' => $row['password']
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
					'password' => $row['password']
				));
				return $operator;

			}
			
			return null;
			
		}

		public static function find_name($name){
			$query = DB::connection()->prepare('SELECT * FROM Operator WHERE name = :name LIMIT 1');
			$query->execute(array('name' => $name));
			$row = $query->fetch();

			if($row){
				$operator = new Operator(array(
					'id' => $row['id'],
					'name' => $row['name'],
					'password' => $row['password']
				));
				return $operator;
			}
			return null;
		}

		public static function find_if_voted($operator_id, $poll_id){
 			$query = DB::connection()->prepare('SELECT * FROM PollAndOperator WHERE operator_id = :operator_id AND poll_id = :poll_id');
 			$query->execute(array('operator_id'=>$operator_id, 'poll_id'=>$poll_id));
 			$rows = $query->fetchAll();
 			if($rows){
 				return TRUE;
 			}
			return FALSE;
 		}

		public static function authenticate($name, $password){
			$query = DB::connection()->prepare('SELECT * FROM Operator WHERE name=:name AND password=:password LIMIT 1');
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

		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Operator (name, password) VALUES (:name, :password) RETURNING id');
			$query->execute(array('name' => $this->name, 'password' => $this->password));
			$row = $query->fetch();
			$this->id = $row['id'];
		}

		public function update(){
			$query = DB::connection()->prepare('UPDATE Operator SET name=:name,password=:password where id = :id');
			$query->execute(array('id' => $this->id, 'name' => $this->name, 'password' => $this->password));
		}

		public function destroy(){
			$query = DB::connection()->prepare('DELETE FROM Operator WHERE id = :id');
			$query->execute(array($this->id));
		}

		public function validate_name(){
			return $this->validate_name_length('Nimi', $this->name, 3, 15);
		}

		public function validate_password(){
			return $this->validate_name_length('Nimi', $this->name, 3, 30);
		}

}