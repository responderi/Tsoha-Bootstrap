<?php

class OperatorController extends BaseController{
	public static function index(){
			$operators = Operator::all();
			self::get_user_logged_in();
			View::make('operator/operatorlist.html', array('operators' => $operators));
	}

	public static function login(){
		View::make('operator/login.html');
	}

	public static function logout(){
		$_SESSION['operator'] = null;
		Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
	}

	public static function edit($id){
		self::check_logged_in();
		$operator = self::get_user_logged_in();
		if($operator->id == $id){
			View::make('operator/edit.html', array('operator' => $operator));
		}
		Redirect::to('/', array('message' => 'Voit muokata vain omia tietojasi!'));
	}

	public static function update($id){
		self::check_logged_in();
		self::get_user_logged_in();
		$params = $_POST;
		$attributes = array(
			'id' => $id,
			'name' => $params['name'],
			'password' => $params['password']
		);
		$operator = new Operator($attributes);
		$errors = $operator->errors();
		if(!($operator->find_name($params['name']) == null)){
			$errors[] = 'Et voi vaihtaa nimeä jo olemassa olevaan!';
		}
		if(count($errors) > 0){
			View::make('operator/edit.html', array('errors' => $errors, 'operator' => $attributes));	
		}else{
			$operator->update();
			Redirect::to('/operator/' . $operator->id, array('message' => 'Muokkaus onnistui!'));
		}
	}

	public static function destroy($id){
			self::check_logged_in();
			self::get_user_logged_in();
			$operator = new Operator(array('id' => $id));
			$operator->destroy();
			Redirect::to('/', array('message' => 'Käyttäjätili poistettu!'));
		}

	public static function handle_login(){
		$params = $_POST;

		$operator = Operator::authenticate($params['name'], $params['password']);

		if(!$operator){
			View::make('operator/login.html', array('errors' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
		}else{
			$_SESSION['operator'] = $operator->id;

			Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $operator->name . '!'));
		}
	}

	public static function operatorpage($id){
		self::get_user_logged_in();
		$operator = Operator::find($id);
		View::make('operator/operatorpage.html', array('operator' => $operator));
		}

	public static function register(){
		View::make('operator/register.html');
	}

	public static function handle_register(){
		$params = $_POST;

		$attributes = array(
			'name' => $params['name'],
			'password' => $params['password']
		);
		$operator = new Operator($attributes);


		$errors = $operator->errors();
		if(!($params['password'] == $params['repeatedPassword'])){
			View::make('operator/register.html', array('errors' => 'Annetut salasanat eivät täsmää', 'name' => $params['name']));
		} 

		if(!($operator->find_name($params['name']) == null)){
			View::make('operator/register.html', array('errors' => 'Annetulla käyttäjänimellä on jo luotu tunnus'));
		}

		if(count($errors) > 0){
			View::make('operator/register.html', array('errors' => $errors, 'operator' => $attributes));
		}else{
			$operator->save();
			$_SESSION['operator'] = $operator->id;
			Redirect::to('/', array('message' => 'Voit nyt äänestää ja luoda omia äänestyksiäsi!'));
		}
	}
}