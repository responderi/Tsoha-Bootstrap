<?php

class OperatorController extends BaseController{
	public static function login(){
		View::make('operator/login.html');
	}

	public static function handle_login(){
		$params = $_POST;

		$operator = Operator::authenticate($params['name'], $params['password']);

		if(!$operator){
			View::make('operator/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
		}else{
			$_SESSION['operator'] = $operator->id;

			Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $operator->name . '!'));
		}
	}
}