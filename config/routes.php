<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function() {
  	HelloWorldController::login();
  });

  $routes->get('/votes', function(){
  	HelloWorldController::votes();
  });

  $routes->get('/closed', function(){
    HelloWorldController::closed();
  });

  $routes->get('/create', function(){
  	HelloWorldController::create();
  });

  $routes->get('/account', function(){
    HelloWorldController::account();
  });

  $routes->get('/edit', function(){
    HelloWorldController::edit();
  });

  $routes->get('/account/ownvotes', function(){
    HelloWorldController::ownvotes();
  });

  $routes->get('/votepage', function(){
    HelloWorldController::votepage();
  });
