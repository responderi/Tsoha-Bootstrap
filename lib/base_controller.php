<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
      if(isset($_SESSION['operator'])){
        $operator_id = $_SESSION['operator'];
        $operator = Operator::find($operator_id);
        return $operator;
      }
      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['operator'])){
        Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
      }
    }

  }
