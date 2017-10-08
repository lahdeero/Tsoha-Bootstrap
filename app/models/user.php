<?php

class User extends BaseModel {
  public $id, $username, $password, $yllapitaja;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Vedonlyoja WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $user = new User(array(
      'id' => $row['id'],
      'username' => $row['nimi'],
      'password' => $row['salasana'],
      'yllapitaja' => $row['yllapitaja']
    ));

      return $user;
    }
    return null;
  }

  public static function authenticate($username, $password) {
    $query = DB::connection()->prepare('SELECT * FROM Vedonlyoja WHERE nimi = :username AND salasana = :password LIMIT 1');
    $query->execute(array('username' => $username, 'password' => $password));
    $row = $query->fetch();

    if($row){
      $user = new User(array(
      'id' => $row['id'],
      'username' => $row['nimi'],
      'password' => $row['salasana'],
      'yllapitaja' => $row['yllapitaja']
    ));

    return $user;
    }

    return null;
  }


}
