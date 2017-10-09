<?php
  class OptionController extends BaseController{

    public static function add() {
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
      $errors = $valinta->errors();

      // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
      if (count($errors) == 0){
        $valinta->save();
        Redirect::to('/match/' . $kohde->id . '/options', array('message' => 'Valinta on lisätty kohteeseen!'));
      } else{
        Redirect::to('/match/' . $kohde->id . '/options', array('errors' => $errors,
        'valinnan_nimi' => $params['valinnan_nimi'], 'kerroin' => $params['kerroin']));
      }
    }

    public static function destroy($id) {
      self::check_logged_in();

      $params = $_POST;

      $valinta = new Valinta(array('id' => $id));

      $valinta->destroy($id);

      Redirect::to('/match/' . $params['kohde_id'] . '/options', array('message' => 'Valinta poistettu kohteesta!'));
    }

  }
?>
