
<?php

class Vedonlyoja extends BaseModel {
  public $id, $nimi, $saldo, $rekpvm;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT id,nimi,saldo,rekpvm FROM Vedonlyoja WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $vedonlyoja = new Vedonlyoja(array(
      'id' => $row['id'],
      'nimi' => $row['nimi'],
      'saldo' => $row['saldo'],
      'rekpvm' => row['rekpvm']
    ));

    return $vedonlyoja;
    }

    return null;
  }

  public static function all() {
    $query = DB::connection()->prepare('SELECT id, nimi, saldo, rekpvm FROM Vedonlyoja');

    $query->execute();

    $rows = $query->fetchAll();
    $kohteet = array();

    foreach($rows as $row){
      $vedonlyojat[] = new Vedonlyoja(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'saldo' => $row['saldo'],
        'rekpvm' => $row['rekpvm']
      ));
    }

    return $vedonlyojat;
  }

  public static function toplist($howmany) {
    $query = DB::connection()->prepare('SELECT nimi,saldo,rekpvm FROM Vedonlyoja ORDER BY saldo DESC LIMIT :howmany');
    $query->execute(array('howmany' => $howmany));

    $rows = $query->fetchAll();
    $vedonlyojat = array();

    foreach($rows as $row){
      $vedonlyojat[] = new Vedonlyoja(array(
        'nimi' => $row['nimi'],
        'saldo' => $row['saldo'],
        'rekpvm' => $row['rekpvm']
      ));
    }

    return $vedonlyojat;
  }
}
