<?php

class UserController extends BaseController{
  public static function login() {
      View::make('bettor/login.html');
  }
  
  public static function logout() {
      $_SESSION['user'] = null;
      Redirect::to('/', array('message' => 'Olet kirjautunut ulos.'));
  }

  public static function handle_login(){
    $params = $_POST;

    $user = User::authenticate($params['username'], $params['password']);

    if(!$user){
      View::make('bettor/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->username . '!'));
    }
  }

  public static function get_user_logged_in(){
    // Katsotaan onko user-avain sessiossa
    if(isset($_SESSION['user'])){
      $user_id = $_SESSION['user'];
      // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
      $user = User::find($user_id);

      return $user;
    }

    // Käyttäjä ei ole kirjautunut sisään
    return null;
  }
}

?>
