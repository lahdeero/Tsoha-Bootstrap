<?php

class SuggestionController extends BaseController{

  public static function list(){
    $ehdotukset = Ehdotus::all();

    View::make('suggestion/index.html', array('ehdotukset' => $ehdotukset));
  }

}

?>
