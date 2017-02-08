<?php
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      $blank = new Poll(array('name' => '', 'description' => 'Testaus', 'start_time' => '11.01.2017', 'end_time' => '11.03.2017'));
      $errors = $blank->errors();
      Kint::dump($errors);
    }

    public static function polls(){
      View::make('alustavat/polls.html');
    }

    public static function pollpage(){
      View::make('alustavat/pollpage.html');
    }

    public static function polledit(){
      View::make('alustavat/polledit.html');
    }

    public static function login(){
      View::make('alustavat/login.html');
    }

  }
