<?php
  class MatchController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/etusivu.html');
    }

    public static function match_list(){
      $kohteet = Kohde::all();

      View::make('match/index.html', array('kohteet' => $kohteet));
    }

    public static function match_show($id){
      $kohde = Kohde::find($id);

      View::make('match/match_show.html', array('kohde' => $kohde));
    }

    public static function match_create() {
      View::make('match/new.html');
    }

    public static function match_delete($id) {
      Kohde::delete($id);
      Redirect::to('/match/', array('message' => 'Kohde on poistettu tietokannasta!'));
    }

    public static function match_store(){
      // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
      $params = $_POST;
      // Alustetaan uusi Kohde-luokan olion käyttäjän syöttämillä arvoilla
      $kohde = new Kohde(array(
        'nimi' => $params['nimi'],
        'tyyppi' => $params['tyyppi'],
        'sulkeutumisaika' => $params['sulkeutumisaika']
      ));

      // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
      $kohde->save();

      // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
      Redirect::to('/match/' . $kohde->id, array('message' => 'Kohde on lisätty tietokantaan!'));
    }
  }
?>
