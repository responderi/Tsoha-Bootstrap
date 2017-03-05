<?php
	
	class Poll extends BaseModel{
		public $id;
		public $name;
		public $description;
		public $creator;
		public $start_time;
		public $end_time;
		public $results;

		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_name', 'validate_description', 'validate_start_time', 'validate_end_time');
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
					'creator' => $row['creator'],
					'start_time' => $row['start_time'],
					'end_time' => $row['end_time'],
					'results' => $row['results']
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
					'creator' => $row['creator'],
					'start_time' => $row['start_time'],
					'end_time' => $row['end_time'],
					'results' => $row['results']
				));
				return $poll;

			}
			return null;
		}

		public static function find_voters($id){
			$query = DB::connection()->prepare('SELECT Operator.* FROM PollAndOperator, Operator WHERE PollAndOperator.poll_id = :id');
			$query->execute(array('id' => $id));
			$rows = $query->fetchAll();
			$operators = array();

			foreach($rows as $row){
				$operators[] = new Operator(array(
					'id' => $row['id'],
					'name' => $row['name']
				));
			}
			return $operators;
		}

		public static function find_creator($id){
			$query = DB::connection()->prepare('SELECT Operator.name FROM Operator, Poll WHERE Operator.id = Poll.creator AND Poll.id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();
			if($row){
				$creator = $row['name'];
				return $creator;
			}
			return null;
		}

		public static function options($id){
			$query = DB::connection()->prepare('SELECT * FROM Option WHERE Option.poll_id = :id');
			$query->execute(array('id' => $id));
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
			$query = DB::connection()->prepare('INSERT INTO Poll (name, description, creator,start_time, end_time, results) VALUES (:name, :description, :creator, :start_time, :end_time, :results) RETURNING id');
			$query->execute(array('name' => $this->name, 'description' => $this->description, 'creator' => $this->creator,'start_time' => $this->start_time, 'end_time' => $this->end_time, 'results' => $this->results));
			$row = $query->fetch();
			$this->id = $row['id'];
		}

		public function update(){
			$query = DB::connection()->prepare('UPDATE Poll SET name=:name,description=:description,start_time=:start_time,end_time=:end_time,results=:results where id = :id');
			$query->execute(array('id' => $this->id, 'name' => $this->name, 'description' => $this->description, 'start_time' => $this->start_time, 'end_time' => $this->end_time, 'results' => $this->results));
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

		public function validate_start_time(){
      		$errors = array();

      		if(strtotime(date("Y-m-d")) > strtotime($this->start_time)){
        		$errors[] = 'Alkamisaika ei saa alkaa ennen nykyistä päivää!';
      		}
      		if($this->start_time == null || $this->start_time == ''){
      			$errors[] = 'Alkamisaika ei saa olla tyhjä!';
      		}
      		return $errors;
    	}

		public function validate_end_time(){
      		$errors = array();

      		if(strtotime($this->end_time) < strtotime(date("Y-m-d"))){
      		  	$errors[] = 'Loppumisaika ei saa olla mennyt jo!';
      		}
      		if(strtotime($this->end_time) < strtotime($this->start_time)){
        		$errors[] = 'Loppumisaika ei saa olla ennen alkamisaikaa!';
      		}
      		/* Jostakin syystä seuraavat komennot eivät toimi jos ne ovat samassa ehtolauseessa, tästä johtuen erotettuna */
      		if($this->end_time == null){
      			$errors[] = 'Loppumisaika ei saa olla tyhjä!';
      		}elseif($this->end_time == ''){
      			$errors[] = 'Loppumisaika ei saa olla tyhjä!';
      		}
      		return $errors;
    	}
	}