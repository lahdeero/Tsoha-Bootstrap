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
      $_SESSION['yllapitaja'] = $user->yllapitaja;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->username . '!'));
    }
  }

  public static function update() {
    self::check_logged_in();
    $params = $_POST;

    $new_password = $params['password'];

    $vedonlyoja = Vedonlyoja::find($_SESSION['user']);
    $errors = array();
    //validoitaan salasana täällä kun vedonlyoja luokka ei hae/käytä salasanaa turvallisuussyistä
    if (strlen($new_password) < 3) {
      $errors[] = 'Salasanan pituuden tulee olla vähintään kolme merkkiä!';
    } else if (strlen($new_password) > 25) {
      $errors[] = 'Salasanan pituus ei saa ylittää 25 merkkiä';
    }

    if (count($errors) > 0) {
      Redirect::to('/bettor/' . $vedonlyoja->id . '/update', array('errors' => $errors));
    } else {
      $attributes = array(
        'username' => $vedonlyoja->nimi
      );
      $user = new User($attributes);
      $user->change_password($vedonlyoja->nimi, $new_password);
      Redirect::to('/bettor/' . $vedonlyoja->id, array('message' => 'Salasana vaihdettu onnistuneesti'));
    }
  }
}

?>
