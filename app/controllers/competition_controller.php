<?php

class CompetitionController extends BaseController{

  public static function list(){
    $kilpailut = Kilpailu::all();

    View::make('competition/index.html', array('kilpailut' => $kilpailut));
  }
}

 ?>
