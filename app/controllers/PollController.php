<?php

	class PollController extends BaseController{
		public static function index(){
			$polls = Poll::all();
			self::get_user_logged_in();
			View::make('poll/index.html', array('polls' => $polls));
		}

		public static function store(){
			self::check_logged_in();
			self::get_user_logged_in();
			$params = $_POST;
			$attributes = array(
				'name' => $params['name'],
				'description' => $params['description'],
				'start_time' => $params['start_time'],
				'end_time' => $params['end_time']
			);
			$poll = new Poll($attributes);
			$errors = $poll->errors();
			if(count($errors) == 0){
				$poll->save();
				Redirect::to('/poll/' . $poll->id, array('message' => 'Äänestys lisätty!'));	
			}else{
				View::make('poll/new.html', array('errors' => $errors, 'attributes' => $attributes));
			}
		}

		public static function create(){
			self::check_logged_in();
			self::get_user_logged_in();
			View::make('poll/new.html');
		}

		public static function votepage($id){
			self::get_user_logged_in();
			$poll = Poll::find($id);
			$options = Options::findByPoll($id);
			$arrays = array('poll' => $poll, 'options' => $options);
			View::make('poll/votepage.html', $arrays);
		}

		public static function edit($id){
			self::check_logged_in();
			self::get_user_logged_in();
			$poll = array('poll' => Poll::find($id), 'options' => Options::findByPoll($id));
			View::make('poll/edit.html', $poll);
		}

		public static function update($id){
			self::check_logged_in();
			self::get_user_logged_in();
			$params = $_POST;
			$attributes = array(
				'id' => $id,
				'name' => $params['name'],
				'description' => $params['description'],
				'start_time' => $params['start_time'],
				'end_time' => $params['end_time']
			);
			$poll = new Poll($attributes);
			$errors = $poll->errors();
			if(count($errors) > 0){
				View::make('poll/edit.html', array('errors' => $errors, 'attributes' => $attributes));	
			}else{
				$poll->update();
				Redirect::to('/poll/' . $poll->id, array('message' => 'Muokkaus onnistui!'));
			}
		}

		public static function destroy($id){
			self::check_logged_in();
			self::get_user_logged_in();
			$poll = new Poll(array('id' => $id));
			$poll->destroy();
			Redirect::to('/poll', array('message' => 'Äänestys poistettu!'));
		}
	}