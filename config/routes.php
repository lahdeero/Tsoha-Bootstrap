<?php

	$routes->get('/', function() {
		FrontPageController::index();
	});

	$routes->get('/login', function() {
	  UserController::login();
	});
	$routes->post('/login', function(){
	  UserController::handle_login();
	});
	$routes->get('/logout', function() {
		UserController::logout();
	});
	$routes->get('/match', function() {
	  MatchController::list();
	});

	$routes->post('/match', function() {
		MatchController::store();
	});

	$routes->get('/match/new', function() {
		MatchController::create();
	});

	$routes->get('/match/:id', function($id) {
		MatchController::show($id);
	});

	$routes->get('/match/:id/edit', function($id) {
		MatchController::edit($id);
	});

	$routes->post('/match/:id/edit', function($id) {
		MatchController::update($id);
	});

	$routes->post('/match/:id/destroy', function($id) {
		MatchController::destroy($id);
	});

	$routes->get('/bet', function() {
	  BetController::bet_list();
	});
	$routes->get('/bet/:id', function() {
	  BetController::bet_show();
	});

	$routes->get('/bettor', function() {
	  BettorController::bettor_list();
	});
	$routes->get('/bettor/:id', function($id) {
	  BettorController::bettor_show($id);
	});

	$routes->get('/admin', function() {
	  AdminController::index();
	});

	$routes->get('/competition', function() {
	  HelloWorldController::competition_list();
	});

	$routes->get('/sport', function() {
	  HelloWorldController::sport_list();
	});

	$routes->get('/hiekkalaatikko', function() {
		HelloWorldController::sandbox();
	});

	$routes->get('/hello', function() {
		HelloWorldController::hello();
	});
