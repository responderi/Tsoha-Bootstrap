<?php

	class PollController extends BaseController{
		public static function index(){
			$polls = Poll::all();
			View::make('poll/index.html', array('polls' => $polls));
		}

		public static function store(){
			$params = $_POST;
			$poll = new Poll(array(
				'name' => $params['name'],
				'description' => $params['description'],
				'start_time' => $params['start_time'],
				'end_time' => $params['end_time']
			));
			$poll->save();
			Redirect::to('/poll/' . $poll->id, array('message' => 'Äänestys lisätty!'));
		}

		public static function create(){
			View::make('poll/new.html');
		}

		public static function votepage($id){
			$poll = Poll::find($id);
			$options = Options::findByPoll($id);
			$arrays = array('poll' => $poll, 'options' => $options);
			View::make('poll/votepage.html', $arrays);
		}
	}