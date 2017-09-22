
<?php

class Vedonlyoja extends BaseModel {
  public $id, $nimi, $saldo;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT id,nimi,saldo FROM Vedonlyoja WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $vedonlyoja = new Vedonlyoja(array(
      'id' => $row['id'],
      'nimi' => $row['nimi'],
      'saldo' => $row['saldo']
    ));

    return $vedonlyoja;
    }

    return null;
  }

  public static function all() {
    $query = DB::connection()->prepare('SELECT id, nimi, saldo FROM Vedonlyoja');

    $query->execute();

    $rows = $query->fetchAll();
    $kohteet = array();

    foreach($rows as $row){
      $vedonlyojat[] = new Vedonlyoja(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'saldo' => $row['saldo']
      ));
    }

    return $vedonlyojat;
  }
}
