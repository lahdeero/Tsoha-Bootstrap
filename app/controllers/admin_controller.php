<?php
  class AdminController extends BaseController{

    public static function index(){
      $yllapitajat = Yllapitaja::all();

      View::make('admin/index.html', array('yllapitajat' => $yllapitajat));
    }

    public static function show($id){
      $yllapitaja = Yllapitaja::find($yllapitaja);

      View::make('admin/show.html', array('yllapitaja' => $yllapitaja));
    }

  }
?>
