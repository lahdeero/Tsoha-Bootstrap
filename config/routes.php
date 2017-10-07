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

	$routes->get('/match/:id/options', function($id) {
		MatchController::show_options($id);
	});

	$routes->post('/match/:id/options', function() {
		MatchController::add_option();
	});

	$routes->post('/match/:id/destroy', function($id) {
		MatchController::destroy($id);
	});

	$routes->get('/bet', function() {
	  BetController::list();
	});
	$routes->get('/bet/:id', function($id) {
	  BetController::show($id);
	});
	$routes->post('/bet', function() {
		BetController::store();
	});

	$routes->get('/bettor', function() {
	  BettorController::index();
	});
	$routes->get('/bettor/:id', function($id) {
	  BettorController::show($id);
	});

	$routes->get('/admin', function() {
	  AdminController::index();
	});

	$routes->get('/sport', function() {
	  SportController::index();
	});

	$routes->get('/sport/:id', function($id) {
	  SportController::list($id);
	});

	$routes->post('/option/:id/destroy', function($id) {
		OptionController::destroy($id);
	});

	$routes->get('/suggestion', function() {
	  SuggestionController::list();
	});

	$routes->get('/hiekkalaatikko', function() {
		HelloWorldController::sandbox();
	});

	$routes->get('/hello', function() {
		HelloWorldController::hello();
	});
