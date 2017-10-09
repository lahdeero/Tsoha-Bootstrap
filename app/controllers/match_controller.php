<?php
  class MatchController extends BaseController{

    public static function list(){
      $kohteet = Kohde::all();

      View::make('match/index.html', array('kohteet' => $kohteet, 'yllapitaja' => $_SESSION['yllapitaja']));
    }

    public static function show($id){
      $kohde = Kohde::find($id);
      $valinnat = Valinta::find($id);

      View::make('match/show.html', array('kohde' => $kohde, 'valinnat' => $valinnat, 'yllapitaja' => $_SESSION['yllapitaja']));
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
        View::make('match/new.html', array('errors' => $errors, 'attributes' => $attributes, 'lajit' => $lajit));
      }

    }
    public static function edit($id) {
      self::check_logged_in();
      $kohde = Kohde::find($id);
      $valinnat = Valinta::find($id);
      View::make('match/edit.html', array('kohde' => $kohde, 'valinnat' => $valinnat));
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
        View::make('kohde/edit.html', array('errors' => $errors, 'attributes' => $attributes));
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

    public static function end() {
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
          Redirect::to('/match/' . $kohde->id, array('message' => 'Tulos asetettu ja voittajien tileille hyvitetty lisätty saldoa!'));
        }
        Redirect::to('/match/' . $kohde->id, array('message' => 'Tulos asetettu, ei voittajia!'));
      }
    }
  }
?>
