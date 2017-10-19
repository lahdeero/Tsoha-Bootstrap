<?php

class SportController extends BaseController{

  public static function index(){
    $lajit = Laji::all();

    if(isset($_SESSION['user']) && $_SESSION['yllapitaja'] == 1) {
      View::make('sport/index.html', array('lajit' => $lajit, 'yllapitaja' => 1));
    }

    View::make('sport/index.html', array('lajit' => $lajit));
  }

  public static function list($id) {
    $laji = Laji::find($id);
    $kohteet = Kohde::list_by_sport($id);

    View::make('sport/show.html', array('laji' => $laji, 'kohteet' => $kohteet));
  }

  public static function add() {
    $lajit = Laji::all();
    View::make('sport/new.html', array('lajit' => $lajit));
  }

  public static function store() {
    $params = $_POST;

    $laji = new Laji(array ('nimi' => $params['nimi']));

    $errors = array();
    if (Laji::find_by_name($laji->nimi)) {
      $errors[] = 'Et voi lisätä lajia samalla nimellä';
    }

    $errors += $laji->errors();

    if (count($errors) == 0) {
      $laji->save();
      Redirect::to('/sport', array('message' => 'Laji lisätty tietokantaan!'));
    } else {
      Redirect::to('/sport/new', array('errors' => $errors, 'nimi' => $params['nimi']));
    }
  }



}
?>
