<?php

class SuggestionController extends BaseController{

  public static function list(){
    self::check_logged_in();
    $ehdotukset = Ehdotus::all();

    View::make('suggestion/index.html', array('ehdotukset' => $ehdotukset));
  }
  public static function new() {
    self::check_logged_in();
    $lajit = Laji::all();
    View::make('suggestion/new.html', array('lajit' => $lajit));
  }
  public static function store() {
    self::check_logged_in();
    $params = $_POST;

    $attributes = array(
      'nimi' => $params['nimi'],
      'selvennys' => $params['selvennys'],
      'laji_id' => $params['laji_id'],
      'vedonlyoja_id' => $_SESSION['user']
    );

    $ehdotus = new Ehdotus($attributes);
    $errors = $ehdotus->errors();

    if (count($errors) == 0) {
      $ehdotus->save();
      Redirect::to('/suggestion', array('message' => 'Ehdotus lisätty!'));
    } else {
      Redirect::to('/suggestion/new', array('errors' => $errors, 'attributes' => $attributes));
    }

  }

}

?>
