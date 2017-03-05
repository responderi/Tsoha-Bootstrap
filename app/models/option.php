<?php
	
	class Option extends BaseModel{
		public $id;
		public $poll_id;
		public $name;
		public $description;
		
		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_name', 'validate_description');
		}

		public static function find_by_poll($poll_id){
			$query = DB::connection()->prepare('SELECT * FROM Option WHERE poll_id = :poll_id');
			$query->execute(array('poll_id' => $poll_id));
			$rows = $query->fetchAll();
			$options = array();

			foreach($rows as $row){
				$options[$row['id']] = new Option(array(
					'id' => $row['id'],
					'poll_id' => $row['poll_id'],
					'name' => $row['name'],
					'description' => $row['description']
				));
				

			}
			return $options;
		}

		public static function find_by_option($id){
			$query = DB::connection()->prepare('SELECT * FROM Option WHERE id = :id');
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

		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Option');
			$query->execute();
			$rows = $query->fetchAll();
			$options = array();

			foreach($rows as $row){
				$options[] = new Option(array(
					'id' => $row['id'],
					'poll_id' => $row['poll_id'],
					'name' => $row['name'],
					'description' => $row['description']
					));
			}
			return $options;
		}

		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Option (poll_id, name, description) VALUES (:poll_id, :name, :description) RETURNING id');
			$query->execute(array('poll_id' => $this->poll_id, 'name' => $this->name, 'description' => $this->description,));
			$row = $query->fetch();
			$this->id = $row['id'];
		}

		public function destroy(){
			$query = DB::connection()->prepare('DELETE FROM Option WHERE id = :id');
			$query->execute(array($this->id));
		}

		public function update(){
			$query = DB::connection()->prepare('UPDATE Option SET name=:name,description=:description where id = :id');
			$query->execute(array('id' => $this->id, 'name' => $this->name, 'description' => $this->description));
		}

		public static function count_votes($id){
			$query = DB::connection()->prepare('SELECT COUNT(*) FROM Vote WHERE option_id = :id');
			$query->execute(array('id' => $id));
			$row = $query->fetch();
			return $row[0];
		}

		public function validate_name(){
			return $this->validate_name_length('Nimi', $this->name, 3, 100);
		}

		public function validate_description(){
			return $this->validate_description_length('Kuvaus', $this->description, 200);
		}
	}