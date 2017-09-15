<?php

	$routes->get('/', function() {
		HelloWorldController::index();
	});


	$routes->get('/login', function() {
	  HelloWorldController::login();
	});


	$routes->get('/bet', function() {
	  HelloWorldController::bet_list();
	});
	$routes->get('/bet/1', function() {
	  HelloWorldController::bet_show();
	});

	$routes->get('/bettor', function() {
	  HelloWorldController::bettor_list();
	});
	$routes->get('/bettor/1', function() {
	  HelloWorldController::bettor_show();
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


        
