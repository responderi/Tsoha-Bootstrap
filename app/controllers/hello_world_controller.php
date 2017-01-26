<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function login(){
      View::make('alustavat/login.html');
    }

    public static function votes(){
      View::make('alustavat/votes.html');
    }

    public static function create(){
      View::make('alustavat/create.html');
    }

    public static function closed(){
      View::make('alustavat/closed.html');
    }

    public static function account(){
      View::make('alustavat/account.html');
    }

    public static function edit(){
      View::make('alustavat/edit.html');
    }

    public static function ownvotes(){
      View::make('alustavat/ownvotes.html');
    }

    public static function votepage(){
      View::make('alustavat/votepage.html');
    }

    public static function results(){
      View::make('alustavat/results.html');
    }
  }
