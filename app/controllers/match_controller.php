<?php
  class MatchController extends BaseController{

    public static function list(){
      $kohteet = Kohde::all();

      View::make('match/index.html', array('kohteet' => $kohteet));
    }

    public static function show($id){
      $kohde = Kohde::find($id);
      $valinnat = Valinta::find($id);

      View::make('match/show.html', array('kohde' => $kohde, 'valinnat' => $valinnat));
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
        View::make('match/new.html', array('errors' => $errors, 'attributes' => $attributes));
      }

      // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle

    }
    public static function edit($id) {
      self::check_logged_in();
      $kohde = Kohde::find($id);
      View::make('match/edit.html', array('kohde' => $kohde));
    }

    public static function show_options($id) {
        self::check_logged_in();
        $kohde = Kohde::find($id);
        $valinnat = Valinta::find($id);
        View::make('match/options.html', array('kohde' => $kohde, 'valinnat' => $valinnat));
    }

    public static function add_option() {
      $params = $_POST;
      // Alustetaan uusi Kohde-luokan olion käyttäjän syöttämillä arvoilla
      $attributes = array(
        'nimi' => $params['valinnan_nimi'],
        'kerroin' => $params['kerroin'],
        'kohde_id' => $params['kohde_id'],
      );

      //tarkistetaan kohde virheiltä
      $valinta = new Valinta($attributes);
      $kohde = Kohde::find($params['kohde_id']);
      //$kohde = Kohde::find($valinta->kohde_id);

      //$errors = $kohde->errors();
      $errors = array();

      // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
      if (count($errors) == 0){
        $valinta->save();
        Redirect::to('/match/' . $kohde->id . '/options', array('message' => 'Valinta on lisätty kohteeseen!'));
      } else{
        View::make('match/' . $kohde->id . '/options', array('errors' => $errors, 'attributes' => $attributes));
      }
    }

    public static function update($id) {
      self::check_logged_in();
      $params = $_POST;

      $attributes = array(
        'id' => $id,
        'nimi' => $params['nimi'],
        'tyyppi' => $params['tyyppi'],
        'sulkeutumisaika' => $params['sulkeutumisaika'],
        'tulos' => $params['tulos']
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

      //$kohde->destroy_options($id);
      $kohde->destroy($id);

      Redirect::to('/match', array('message' => 'Kohde on poistettu tietokannasta!'));
    }

  }
?>
