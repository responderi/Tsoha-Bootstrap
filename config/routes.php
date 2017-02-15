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

  $routes->get('/poll/:id/edit', function($id){
    PollController::edit($id);
  });

  $routes->post('/poll/:id/edit', function($id){
    PollController::update($id);
  });

  $routes->post('/poll/:id/destroy', function($id){
    PollController::destroy($id);
  });

  $routes->get('/login', function(){
    OperatorController::login();
  });

  $routes->post('/login', function(){
    OperatorController::handle_login();
  });

  $routes->post('/logout', function(){
    OperatorController::logout();
  });

  $routes->get('/register', function(){
    OperatorController::register();
  });

  $routes->post('/register', function(){
    OperatorController::handle_register();
  });

  $routes->post('/operator/:id/destroy', function($id){
    OperatorController::destroy($id);
  });

  $routes->get('/operator/:id', function($id){
    OperatorController::operatorpage($id);
  });

  $routes->get('/operator/:id/edit', function($id){
    OperatorController::edit($id);
  });

  $routes->post('/operator/:id/edit', function($id){
    OperatorController::update($id);
  });

  $routes->get('/operators', function(){
    OperatorController::index();
  });