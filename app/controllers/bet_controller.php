<?php
  class BetController extends BaseController{
    public static function list(){
      self::check_logged_in();
      $options = self::paging_options(Veto::count());

      $vedot = Veto::all($options);
      View::make('bet/index.html', array('vedot' => $vedot, 'pages' => $options['pages'], 'prev_page' => $options['prev_page'], 'next_page' => $options['next_page']));
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
      $errors = array();
      $kohde = Kohde::find($params['kohde_id']);
      $sulkeutumispaiva = strtotime($kohde->sulkeutumisaika);
      $nykyhetki = time();

      if (!isset($params['valinta_id'])) {
        $errors[] = 'Et voi lyödä kohdetta ilman valintaa!';
      }
      if ($sulkeutumispaiva < $nykyhetki) {
        $errors[] = 'Kohde on suljettu!';
  	     // $errors[] = 'nykyhetki: ' . $nykyhetki; // Jätetään nää jos tarvii vielä debugata
  	    // $errors[] =  'sulkeutumishetki: ' . $sulkeutumispaiva;
      }

      if (count($errors) > 0) {
	       Redirect::to('/match/' . $params['kohde_id'], array('errors' => $errors));
      }

      $attributes = array(
        'panos' => $params['panos'],
        'kohde_id' => $params['kohde_id'],
        'valinta_id' => $params['valinta_id'],
        'vedonlyoja_id' => $_SESSION['user']
      );

      $veto = new Veto($attributes);
      $vedonlyoja = Vedonlyoja::find($_SESSION['user']);
      $errors = $veto->errors();

      if (count($errors) == 0){
        $vedonlyoja->takeMoney($veto->vedonlyoja_id, $veto->panos);
        $veto->save();
        Redirect::to('/bet/' . $veto->id, array('message' => 'Veto hyväksytty!'));
      } else{
        Redirect::to('/match/' . $veto->kohde_id, array('errors' => $errors, 'attributes' => $attributes));
      }
    }

  }
?>
