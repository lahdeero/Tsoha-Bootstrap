<?php
  class HelloWorldController extends BaseController{

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
