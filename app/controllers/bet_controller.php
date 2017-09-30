<?php
  class BetController extends BaseController{
    public static function list(){
      $vedot = Veto::all();

      View::make('bet/index.html', array('vedot' => $vedot));
    }

    public static function show($id){
      $veto = Veto::find($id);

      View::make('bet/show.html', array('veto' => $veto));
    }

    public static function modify(){
      View::make('bet/modify.html');
    }

    public static function store(){
      $params = $_POST;

      $attributes = array(
        'merkki' => $params['merkki'],
        'panos' => $params['panos'],
        'kohde_id' => $params['kohde_id'],
        'vedonlyoja_id' => $_SESSION['user']
      );

      $veto = new Veto($attributes);
      $vedonlyoja = Vedonlyoja::find($_SESSION['user']);
      $errors = array();

      if (count($errors) == 0){
        $veto->save();
        Redirect::to('/bet/' . $veto->id, array('message' => 'Veto hyväksytty!'));
      } else{
        View::make('/match/' . kohde.id, array('errors' => $errors, 'attributes' => $attributes));
      }
    }

  }
?>
