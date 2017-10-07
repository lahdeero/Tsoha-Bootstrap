<?php

class SportController extends BaseController{

  public static function index(){
    $lajit = Laji::all();

    View::make('sport/index.html', array('lajit' => $lajit));
  }

  public static function list($id) {
    $laji = Laji::find($id);
    $kohteet = Kohde::list_by_sport($id);

    View::make('sport/show.html', array('laji' => $laji, 'kohteet' => $kohteet));
  }

}
?>
