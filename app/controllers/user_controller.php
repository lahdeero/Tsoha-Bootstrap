<?php

class UserController extends BaseController{
  public static function login() {
      View::make('bettor/login.html');
  }

  public static function logout() {
      session_destroy();
      Redirect::to('/', array('message' => 'Olet kirjautunut ulos.'));
  }

  public static function handle_login(){
    $params = $_POST;

    $user = User::authenticate($params['username'], $params['password']);

    if(!$user){
      View::make('bettor/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
    }else{
      $_SESSION = array();
      $_SESSION['user'] = $user->id;
      $_SESSION['admin'] = $user->yllapitaja;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->username . '!'));
    }
  }

}

?>
