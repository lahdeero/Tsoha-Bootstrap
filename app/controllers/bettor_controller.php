<?php
  class BettorController extends BaseController{

    public static function bettor_list(){
      $vedonlyojat = Vedonlyoja::all();

      View::make('bettor/index.html', array('vedonlyojat' => $vedonlyojat));
    }

    public static function bettor_show($id){
      $vedonlyoja = Vedonlyoja::find($id);
      $vedot = Veto::user_bets($id);

      View::make('bettor/show.html', array('vedonlyoja' => $vedonlyoja, 'vedot' => $vedot));
      //View::make('etusivu.html', array('vedonlyojat' => $vedonlyojat, 'kohteet' => $kohteet));
    }
  }
?>
