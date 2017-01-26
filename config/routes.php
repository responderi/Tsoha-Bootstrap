<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/polls', function(){
    HelloWorldController::polls();
  });

  $routes->get('/pollpage', function(){
    HelloWorldController::pollpage();
  });

  $routes->get('/polledit', function(){
    HelloWorldController::polledit();
  });

  $routes->get('/login', function(){
    HelloWorldController::login();
  });