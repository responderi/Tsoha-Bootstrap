<?php
	
	class Poll extends BaseModel{
		public $id;
		public $name;
		public $description;
		public $start_time;
		public $end_time;
		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Poll');
			$query->execute();
			$rows = $query->fetchAll();
			$polls = array();

			foreach($rows as $row){
				$polls[] = new Poll(array(
					'id' => $row['id'],
					'name' => $row['name'],
					'description' => $row['description'],
					'start_time' => $row['start_time'],
					'end_time' => $row['end_time']
					));
			}
			return $polls;
		}

		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Poll WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();

			if($row){
				$poll = new Poll(array(
					'id' => $row['id'],
					'name' => $row['name'],
					'description' => $row['description'],
					'start_time' => $row['start_time'],
					'end_time' => $row['end_time']
				));
				return $poll;

			}
			return null;
		}

		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Poll (name, description, start_time, end_time) VALUES (:name, :description, :start_time, :end_time) RETURNING id');
			$query->execute(array('name' => $this->name, 'description' => $this->description, 'start_time' => $this->start_time, 'end_time' => $this->end_time));
			$row = $query->fetch();
			$this->id = $row['id'];
		}
	}