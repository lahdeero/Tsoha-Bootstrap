<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['user'])){
        $user_id = $_SESSION['user'];
        // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
        $user = User::find($user_id);

        return $user;
      }
      return null;
    }

    public static function get_user_admin() {
      if(isset($_SESSION['user'])){
        $user_id = $_SESSION['user'];
        // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
        $user = User::find($user_id);
        if ($user['yllapitaja'] != 0) {
          return $user;
        }
      }
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).

    }

  }
