<?php
  class OptionController extends BaseController{

    public static function destroy($id) {
      self::check_logged_in();

      $params = $_POST;

      $valinta = new Valinta(array('id' => $id));

      $valinta->destroy($id);

      Redirect::to('/match/' . $params['kohde_id'] . '/options', array('message' => 'Kohdetta on muokattu onnistuneesti'));
    }

  }
?>
