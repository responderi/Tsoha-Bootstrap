<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      $presidentti = Poll::find(1);
      $polls = Poll::all();
      Kint::dump($presidentti);
      Kint::dump($polls);
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
