<?php
  class HelloWorldController extends BaseController{

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

    public static function hello() {
      View::make('helloworld.html');
    }

    public static function sandbox(){
      $ekapeli = Kohde::find(1);
      $kohteet = Kohde::all();

      Kint::dump($ekapeli);
      Kint::dump($kohteet);
    }
  }
?>
