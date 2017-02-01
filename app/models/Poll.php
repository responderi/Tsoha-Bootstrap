<?php
	
	class Poll extends BaseModel{
		public $id, $name, $description, $start_time, $end_time;
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
				$poll new Poll(array(
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
	}