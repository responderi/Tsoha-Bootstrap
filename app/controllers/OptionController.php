<?php

	class OptionController extends BaseController{
		public static function index($id){
			$option = Option::findByOption($id);
			$poll = Poll::all();
			self::get_user_logged_in();
			View::make('option/optionpage.html', array('poll' => $poll, 'option' => $option));
		}

		public static function create($id){
			$poll = Poll::find($id);
			View::make('option/new.html', array('poll' => $poll));
		}

		public static function store($id){
			self::check_logged_in();
			self::get_user_logged_in();
			$params = $_POST;
			$attributes = array(
				'name' => $params['name'],
				'description' => $params['description'],
				'poll_id' => $id
			);
			$option = new Option($attributes);
			$errors = $option->errors();
			if(count($errors) == 0){
				$option->save();
				Redirect::to('/poll/' . $id, array('message' => 'Vaihtoehto lisätty!'));	
			}else{
				$poll = Poll::find($attributes->poll_id);
				View::make('option/new.html', array('errors' => $errors, 'attributes' => $attributes));
			}
		}

		public static function edit($id){
			self::check_logged_in();
			self::get_user_logged_in();
			$option = Option::findByOption($id);
			View::make('option/edit.html', $option);
		}

		public static function update($id){
			self::check_logged_in();
			self::get_user_logged_in();
			$params = $_POST;
			$attributes = array(
				'id' => $id,
				'name' => $params['name'],
				'description' => $params['description'],
			);
			$option = new Option($attributes);
			$errors = $option->errors();
			if(count($errors) > 0){
				$poll = Poll::find($attributes->poll_id);
				View::make('option/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'poll' => $poll));	
			}else{
				$option->update();
				Redirect::to('/option/' . $poll->id, array('message' => 'Muokkaus onnistui!'));
			}
		}

		public static function destroy($id){
			self::check_logged_in();
			self::get_user_logged_in();
			$option = Option::findByOption($id);
			$poll = Poll::find($option->poll_id);
			$option->destroy();
			Redirect::to('/poll' . $poll->id, array('message' => 'Vaihtoehto poistettu!'));
		}
	}