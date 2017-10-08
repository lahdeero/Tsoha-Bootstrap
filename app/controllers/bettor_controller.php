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

    public static function update($id) {
      self::check_logged_in();
      $vedonlyoja = Vedonlyoja::find($_SESSION['user']);

      if ($vedonlyoja->id == $id) {
        View::make('bettor/edit.html', array('vedonlyoja' => $vedonlyoja));
      } else {
        Redirect::to('/bettor/' . $vedonlyoja->id, array('message' => 'Hupsista'));
      }
    }

    public static function change_password($id) {
      self::check_logged_in();
      $params = $_POST;

      $new_password = $params['salasana'];

      $vedonlyoja = Vedonlyoja::find($_SESSION['user']);
      $errors = $vedonlyoja->errors();

      if (count($errors) > 0) {
        View::make('bettor/' . $vedonlyoja->id . '/edit', array('errors' => $errors, 'attributes' => $attributes));
      } else {
        $vedonlyoja->change_password($vedonlyoja->nimi, $id);

        Redirect::to('/bettor/' . $vedonlyoja->id, array('message' => 'Salasana vaihdettu onnistuneesti'));
      }
    }
  }
?>
