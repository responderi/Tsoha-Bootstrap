<?php
	
	class Options extends BaseModel{
		public $id;
		public $poll_id;
		public $name;
		public $description;
		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public static function findByPoll($poll_id){
			$query = DB::connection()->prepare('SELECT * FROM Option WHERE poll_id = :poll_id');
			$query->execute(array('poll_id' => $poll_id));
			$rows = $query->fetchAll();
			$options = array();

			foreach($rows as $row){
				$options[$row['id']] = new Options(array(
					'id' => $row['id'],
					'poll_id' => $row['poll_id'],
					'name' => $row['name'],
					'description' => $row['description']
				));
				

			}
			return $options;
		}

		public static function findByOption($id){
			$query = DB::connection()->prepare('SELECT * FROM Options WHERE id = :id');
			$query->execute(array('id' => $id));
			$row = $query->fetch();

			if($row){
				$option = new Option(array(
					'id' => $row['id'],
					'poll_id' => $row['poll_id'],
					'name' => $row['name'],
					'description' => $row['description']
				));
				return $option;

			}
			return null;
		}

		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Options (poll_id, name, description) VALUES (:poll_id, :name, :description) RETURNING id');
			$query->execute(array('poll_id' => $this->poll_id, 'name' => $this->name, 'description' => $this->description,));
			$row = $query->fetch();
			$this->id = $row['id'];
		}
	}