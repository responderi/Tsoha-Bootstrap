<?php
	
	class Poll extends BaseModel{
		public $id;
		public $name;
		public $description;
		public $start_time;
		public $end_time;

		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_name', 'validate_description'/*, 'validate_start_time', 'validate_end_time'*/);
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

		public static function options($id){
			$query = DB::connection()->prepare('SELECT * FROM Option WHERE Option.poll_id = :id');
			$query->execute(array('id' => $id));
			$rows = $query->fetchAll();
			$options = array();

			foreach($rows as $row){
				$options[] = new options(array(
					'id' => $row['id'],
					'poll_id' => $row['poll_id'],
					'name' => $row['name'],
					'description' => $row['description']
					));
			}
			return $options;
		}

		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Poll (name, description, start_time, end_time) VALUES (:name, :description, :start_time, :end_time) RETURNING id');
			$query->execute(array('name' => $this->name, 'description' => $this->description, 'start_time' => $this->start_time, 'end_time' => $this->end_time));
			$row = $query->fetch();
			$this->id = $row['id'];
		}

		public function update(){
			$query = DB::connection()->prepare('UPDATE Poll SET name=:name,description=:description,start_time=:start_time,end_time=:end_time where id = :id');
			$query->execute(array('id' => $this->id, 'name' => $this->name, 'description' => $this->description, 'start_time' => $this->start_time, 'end_time' => $this->end_time));
		}

		public function destroy(){
			$query = DB::connection()->prepare('DELETE FROM Poll WHERE id = :id');
			$query->execute(array($this->id));
		}

		public function validate_name(){
			return $this->validate_name_length('Nimi', $this->name, 3, 100);
		}

		public function validate_description(){
			return $this->validate_description_length('Kuvaus', $this->description, 500);
		}

		/*public function validate_start_time(){
			return $this->validate_times('Alkamisaika', $this->start_time);
		}

		public function validate_end_time(){
			return $this->validate_times('Päättymisaika', $this->end_time);
		}*/
	}