<?php
  class BettorController extends BaseController{

    public static function bettor_list(){
      $vedonlyojat = Vedonlyoja::all();

      View::make('bettor/index.html', array('vedonlyojat' => $vedonlyojat));
    }

    public static function bettor_show($id){
      $vedonlyoja = Vedonlyoja::find($id);

      View::make('bettor/show.html', array('vedonlyoja' => $vedonlyoja));
    }
  }
?>
