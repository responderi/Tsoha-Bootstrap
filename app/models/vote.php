<?php

	class Vote extends BaseModel{
		public $id;
		public $option_id;
		public $timegiven;
		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public function saveGivenVote($option_id){
			//Tämä funktio tallentaa käyttäjän antaman äänen tietylle ehdokkaalle tiettyyn aikaan//
			$query = DB::connection()->prepare('INSERT INTO Vote (option_id, timegiven) VALUES (:option_id, :timegiven) RETURNING id');
			$query->execute(array('option_id' => $option_id, 'timegiven' => date("Y-m-d H:i:s")));
		}

		public function addConnectedTable($operator_id, $poll_id){
			$query = DB::connection()->prepare('INSERT INTO PollAndOperator (operator_id, poll_id) VALUES (:operator_id, :poll_id)');
			$query->execute(array('operator_id' => $operator_id, 'poll_id' => $poll_id));
		}
	}