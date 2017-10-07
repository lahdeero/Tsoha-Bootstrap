<?php
  class BetController extends BaseController{
    public static function list(){
      self::check_logged_in();
      $vedot = Veto::all();

      View::make('bet/index.html', array('vedot' => $vedot));
    }

    public static function show($id){
      self::check_logged_in();
      $veto = Veto::find($id);

      View::make('bet/show.html', array('veto' => $veto));
    }

    public static function modify(){
      self::check_logged_in();
      View::make('bet/modify.html');
    }

    public static function store(){
      self::check_logged_in();
      $params = $_POST;

      $attributes = array(
        'panos' => $params['panos'],
        'kohde_id' => $params['kohde_id'],
        'valinta_id' => $params['valinta_id'],
        'vedonlyoja_id' => $_SESSION['user']
      );

      $veto = new Veto($attributes);
      $vedonlyoja = Vedonlyoja::find($_SESSION['user']);
      $errors = array();

      if (count($errors) == 0){
        $vedonlyoja->take_money($veto->vedonlyoja_id, $veto->panos);
        $veto->save();
        Redirect::to('/bet/' . $veto->id, array('message' => 'Veto hyväksytty!'));
      } else{
        View::make('/match/' . kohde.id, array('errors' => $errors, 'attributes' => $attributes));
      }
    }

  }
?>
