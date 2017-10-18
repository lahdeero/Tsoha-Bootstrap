<?php
  class MatchController extends BaseController{

    public static function list(){
      $options = self::paging_options(Kohde::count());

      $kohteet = Kohde::all($options);
      $parametrit = array('kohteet' => $kohteet, 'pages' => $options['pages'], 'prev_page' => $options['prev_page'], 'next_page' => $options['next_page']);

      if($_SESSION['yllapitaja'] == 1)  {
        $parametrit['yllapitaja'] = 1;
      }
      View::make('match/index.html', $parametrit);
    }

    public static function show($id){
      $kohde = Kohde::find($id);
      $valinnat = Valinta::find($id);

      $parametrit = array('kohde' => $kohde, 'valinnat' => $valinnat);
      if(isset($_SESSION['user']) && $_SESSION['yllapitaja'] == 1)  {
          $parametrit['yllapitaja'] = 1;
      }
      View::make('match/show.html', $parametrit);
    }

    public static function create() {
      self::check_logged_in();
      $lajit = Laji::all();

      View::make('match/new.html', array('lajit' => $lajit));
    }

    public static function store(){
      // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
      $params = $_POST;
      // Alustetaan uusi Kohde-luokan olion käyttäjän syöttämillä arvoilla
      $attributes = array(
        'nimi' => $params['nimi'],
        'tyyppi' => $params['tyyppi'],
        'laji_id' => $params['laji_id'],
        'sulkeutumisaika' => $params['sulkeutumisaika']
      );

      //tarkistetaan kohde virheiltä
      $kohde = new Kohde($attributes);
      $errors = $kohde->errors();

      // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
      if (count($errors) == 0){
        $kohde->save();
        Redirect::to('/match/' . $kohde->id, array('message' => 'Kohde on lisätty tietokantaan!'));
      } else{
        $lajit = Laji::all();
        View::make('match/new.html', array('errors' => $errors, 'attributes' => $attributes, 'lajit' => $lajit,
        'nimi' => $params['nimi'], 'tyyppi' => $params['tyyppi'], 'laji_id' => $params['laji_id'], 'sulkeutumisaika' => $params['sulkeutumisaika']));
      }

    }
    public static function edit($id) {
      self::check_logged_in();
      $kohde = Kohde::find($id);
      View::make('match/edit.html', array('kohde' => $kohde));
    }

    public static function options($id) {
        self::check_logged_in();
        $kohde = Kohde::find($id);
        $valinnat = Valinta::find($id);
        View::make('match/options.html', array('kohde' => $kohde, 'valinnat' => $valinnat));
    }

    public static function update($id) {
      self::check_logged_in();
      $params = $_POST;

      $attributes = array(
        'id' => $id,
        'nimi' => $params['nimi'],
        'tyyppi' => $params['tyyppi'],
        'sulkeutumisaika' => $params['sulkeutumisaika']
      );

      $kohde = new Kohde($attributes);
      $errors = $kohde->errors();

      if (count($errors) > 0) {
        View::make('match/edit.html', array('errors' => $errors, 'kohde' => $kohde));
      } else {
        $kohde->update($id);

        Redirect::to('/match/' . $kohde->id, array('message' => 'Kohdetta on muokattu onnistuneesti'));
      }
    }
    public static function destroy($id) {
        self::check_logged_in();
        $kohde = new Kohde(array('id' => $id));
        $kohde->destroy($id);
        Redirect::to('/match', array('message' => 'Kohde on poistettu tietokannasta!'));
    }
    public static function complete($id) {
        self::check_logged_in();
        $kohde = Kohde::find($id);
        $valinnat = Valinta::find($id);
        View::make('match/complete.html', array('kohde' => $kohde, 'valinnat' => $valinnat));
    }

    public static function end_match() {
      self::check_admin();
      $params = $_POST;

      $attributes = array(
        'id' => $params['id'],
        'nimi' => $params['nimi'],
        'tyyppi' => $params['tyyppi'],
        'sulkeutumisaika' => $params['sulkeutumisaika'],
        'tulos' => $params['tulos']
      );

      $kohde = new Kohde($attributes);
      $errors = $kohde->errors();

      if (count($errors) > 0) {
        View::make('kohde/complete.html', array('errors' => $errors, 'attributes' => $attributes));
      } else {
        $valinta = Valinta::find_option($kohde->tulos);
        Veto::update($kohde->id, $valinta->kerroin, $kohde->tulos);
        Veto::all_bets_in_match($kohde->id);
        $vedot = Veto::winning_bets($kohde->id, $valinta->kerroin, $kohde->tulos);

        if ($vedot) {
          foreach ($vedot as $veto) {
            $veto->payWin($veto->vedonlyoja_id, $veto->panos * $valinta->kerroin);
          }
          Redirect::to('/match/' . $kohde->id, array('message' => 'Tulos asetettu ja voittajien tileille lisätty saldoa!'));
        }
        Redirect::to('/match/' . $kohde->id, array('message' => 'Tulos asetettu, ei voittajia!'));
      }
    }
  }
?>
