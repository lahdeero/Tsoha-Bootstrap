<?php
  class BetController extends BaseController{
    public static function bet_list(){
      $vedot = Veto::all();

      View::make('bet/index.html', array('vedot' => $vedot));
    }

    public static function bet_show(){
      View::make('bet/show.html');
    }

    public static function bet_modify(){
      View::make('bet/modify.html');
    }
    
  }
?>
