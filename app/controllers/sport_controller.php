<?php

class SportController extends BaseController{

  public static function list(){
    $lajit = Laji::all();

    View::make('sport/index.html', array('lajit' => $lajit));
  }

}
?>
