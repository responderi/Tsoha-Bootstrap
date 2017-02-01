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

  $routes->get('/poll', function(){
    PollController::index();
  });

  $routes->post('/poll', function(){
    PollController::store();
  });

  $routes->get('/poll/new', function(){
    PollController::create();
  });

  $routes->get('/poll/:id', function($id){
    PollController::votepage($id);
  });