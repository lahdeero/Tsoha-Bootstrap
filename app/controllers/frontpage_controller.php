<?php
  class FrontPageController extends BaseController{

    public static function index(){
      $kohteet = Kohde::newest(3);
      $vedonlyojat = Vedonlyoja::toplist(3);

      View::make('etusivu.html', array('vedonlyojat' => $vedonlyojat, 'kohteet' => $kohteet));

    }
  }
?>
