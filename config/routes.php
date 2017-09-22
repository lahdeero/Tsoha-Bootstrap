<?php

	$routes->get('/', function() {
		MatchController::index();
	});

	$routes->get('/login', function() {
	  HelloWorldController::login();
	});

	$routes->get('/match', function() {
	  MatchController::match_list();
	});

	$routes->post('/match', function() {
		MatchController::match_store();
	});

	$routes->get('/match/new', function() {
		MatchController::match_create();
	});

	$routes->get('/match/:id', function($id) {
		MatchController::match_show($id);
	});

	$routes->get('/match/:id/delete', function($id) {
		MatchController::match_delete($id);
	});

	$routes->get('/bet', function() {
	  BetController::bet_list();
	});
	$routes->get('/bet/1', function() {
	  BetController::bet_show();
	});

	$routes->get('/bettor', function() {
	  BettorController::bettor_list();
	});
	$routes->get('/bettor/:id', function($id) {
	  BettorController::bettor_show($id);
	});

	$routes->get('/admin', function() {
	  HelloWorldController::admin_list();
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
