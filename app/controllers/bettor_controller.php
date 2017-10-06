<?php
  class BettorController extends BaseController{

    public static function index(){
      self::check_logged_in();
      $vedonlyojat = Vedonlyoja::all();

      View::make('bettor/index.html', array('vedonlyojat' => $vedonlyojat));
    }

    public static function show($id){
      self::check_logged_in();
      $vedonlyoja = Vedonlyoja::find($id);
      $vedot = Veto::user_bets($id);

      View::make('bettor/show.html', array('vedonlyoja' => $vedonlyoja, 'vedot' => $vedot));
      //View::make('etusivu.html', array('vedonlyojat' => $vedonlyojat, 'kohteet' => $kohteet));
    }
  }
?>
