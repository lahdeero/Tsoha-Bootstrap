<?php

  class BaseController{

    public static function get_yllapitaja_logged_in(){
      $user = User::find($user_id);

      return $user;
    }

    public static function get_user_logged_in(){
      if(isset($_SESSION['user'])){
        $user_id = $_SESSION['user'];
        // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
        $user = User::find($user_id);

        return $user;
      }
      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['user'])){
        Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
      }
    }

    public static function check_admin(){
      if(!isset($_SESSION['yllapitaja'])){
        Redirect::to('/login', array('message' => 'Toiminto vaatii ylläpitäjätunnuksen!'));
      }
    }

  }
