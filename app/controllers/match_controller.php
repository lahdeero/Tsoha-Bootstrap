<?php
  class MatchController extends BaseController{

    public static function list(){
      $kohteet = Kohde::all();

      View::make('match/index.html', array('kohteet' => $kohteet));
    }

    public static function show($id){
      $kohde = Kohde::find($id);

      View::make('match/show.html', array('kohde' => $kohde));
    }

    public static function create() {
      View::make('match/new.html');
    }

    public static function store(){
      // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
      $params = $_POST;
      // Alustetaan uusi Kohde-luokan olion käyttäjän syöttämillä arvoilla
      $attributes = array(
        'nimi' => $params['nimi'],
        'tyyppi' => $params['tyyppi'],
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
      $kohde = Kohde::find($id);
      View::make('match/edit.html', array('kohde' => $kohde));
    }

    public static function update($id) {
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
      $kohde = new Kohde(array('id' => $id));

      $kohde->destroy($id);

      Redirect::to('/match', array('message' => 'Kohde on poistettu tietokannasta!'));
    }

  }
?>
