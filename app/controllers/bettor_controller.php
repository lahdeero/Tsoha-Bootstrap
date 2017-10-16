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

    public static function edit($id) {
      self::check_logged_in();
      $vedonlyoja = Vedonlyoja::find($_SESSION['user']);

      View::make('bettor/edit.html', array('vedonlyoja' => $vedonlyoja));
    }
    public static function balance() {
      self::check_logged_in();
      $vedonlyoja = Vedonlyoja::find($_SESSION['user']);
      View::make('bettor/balance.html', array('vedonlyoja' => $vedonlyoja));
    }
    public static function deposit() {
      self::check_logged_in();
      $params = $_POST;
      $lisattava_summa = $params['lisattava_saldo'];
      $vedonlyoja = Vedonlyoja::find($_SESSION['user']);
      $errors = array();


      if (!is_numeric($lisattava_summa) || $lisattava_summa < 1 || $lisattava_summa > 1000) {
        $errors[] = 'Virheellinen summa';
      }

      if (count($errors) > 0) {
         Redirect::to('/bettor/' . $vedonlyoja->id, array('errors' => $errors));
      }

      $vedonlyoja->deposit($vedonlyoja->id, $lisattava_summa);
      Redirect::to('/bettor/' . $vedonlyoja->id, array('vedonlyoja' => $vedonlyoja, 'message' => 'Talletettu onnistuneesti!'));
    }

  }
?>
