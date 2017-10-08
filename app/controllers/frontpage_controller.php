<?php
  class FrontPageController extends BaseController{

    public static function index(){
      $kohteet = Kohde::newest(3);
      $vedonlyojat = Vedonlyoja::toplist(3);
      $vedot = Veto::newest(3);

      View::make('index.html', array('vedonlyojat' => $vedonlyojat, 'kohteet' => $kohteet, 'vedot' => $vedot));

    }
  }
?>
