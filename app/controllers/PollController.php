<?php

	class PollController extends BaseController{
		public static function index(){
			$polls = Poll::all();
			View::make('poll/index.html', array('polls' => $polls));
		}

		public static function store(){
			$params = $_POST;
			$attributes = array(
				'name' => $params['name'],
				'description' => $params['description'],
				'start_time' => $params['start_time'],
				'end_time' => $params['end_time']
			);
			$poll = new Poll($attributes);
			/*$errors = $poll->errors();
			if(count($errors) == 0){*/
				$poll->save();
				Redirect::to('/poll/' . $poll->id, array('message' => 'Äänestys lisätty!'));	
			/*}else{
				Redirect::to('/poll/new', array('errors' => $errors, 'attributes' => $attributes));
			}*/
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

		public static function edit($id){
			$poll = array('poll' => Poll::find($id), 'options' => Options::findByPoll($id));
			View::make('poll/edit.html', $poll);
		}

		public static function update($id){
			$params = $_POST;
			$poll = new Poll(array(
				'name' => $params['name'],
				'description' => $params['description'],
				'start_time' => $params['start_time'],
				'end_time' => $params['end_time']
			));
			/*$errors = $poll->errors();
			if(count($errors) == 0){*/
				$poll->update();
				Redirect::to('/poll' . $poll->id, array('message' => 'Äänestystä muokattu!'));	
			/*}else{
				Redirect::to('/poll/edit', array('errors' => $errors));
			}*/
		}

		public static function destroy($id){
			$poll = new Poll(array('id' => $id));
			$poll->destroy();
			Redirect::to('/poll');
		}
	}