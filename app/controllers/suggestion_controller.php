<?php

class SuggestionController extends BaseController{

  public static function list(){
    self::check_logged_in();
    $ehdotukset = Ehdotus::all();

    View::make('suggestion/index.html', array('ehdotukset' => $ehdotukset));
  }

}

?>
