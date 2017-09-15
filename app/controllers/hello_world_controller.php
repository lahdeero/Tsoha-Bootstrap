<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/etusivu.html');  
    }

    public static function login(){
      View::make('suunnitelmat/login.html');
    }

    public static function bet_list(){
      View::make('suunnitelmat/bet_list.html');
    }

    public static function bet_show(){
      View::make('suunnitelmat/bet_show.html');
    }

    public static function bet_modify(){
      View::make('suunnitelmat/bet_modify.html');
    }

    public static function bettor_list(){
      View::make('suunnitelmat/bettor_list.html');
    }

    public static function bettor_show(){
      View::make('suunnitelmat/bettor_show.html');
    }

    public static function bettor_modify(){
      View::make('suunnitelmat/bettor_modify.html');
    }

    public static function admin_list(){
      View::make('suunnitelmat/admin_list.html');
    }

    public static function sport_list(){
      View::make('suunnitelmat/sport_list.html');
    }

    public static function competition_list(){
      View::make('suunnitelmat/competition_list.html');
    }


    public static function sandbox(){
      View::make('helloworld.html');
    }
  }
?>
