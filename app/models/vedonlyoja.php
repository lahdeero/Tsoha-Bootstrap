
<?php

class Vedonlyoja extends BaseModel {
  public $id, $nimi, $saldo, $rekisteroitymispaiva, $yllapitaja;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_nimi', 'validate_salasana');
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Vedonlyoja WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $vedonlyoja = new Vedonlyoja(array(
      'id' => $row['id'],
      'nimi' => $row['nimi'],
      'saldo' => $row['saldo'],
      'rekisteroitymispaiva' => $row['rekisteroitymispaiva'],
      'yllapitaja' => $row['yllapitaja']
    ));

    return $vedonlyoja;
    }

    return null;
  }

  public static function all() {
    $query = DB::connection()->prepare('SELECT id, nimi, saldo, rekisteroitymispaiva FROM Vedonlyoja');

    $query->execute();

    $rows = $query->fetchAll();
    $kohteet = array();

    foreach($rows as $row){
      $vedonlyojat[] = new Vedonlyoja(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'saldo' => $row['saldo'],
        'rekisteroitymispaiva' => $row['rekisteroitymispaiva']
      ));
    }

    return $vedonlyojat;
  }

  public static function toplist($howmany) {
    $query = DB::connection()->prepare('SELECT id,nimi,saldo,rekisteroitymispaiva FROM Vedonlyoja ORDER BY saldo DESC LIMIT :howmany');
    $query->execute(array('howmany' => $howmany));

    $rows = $query->fetchAll();
    $vedonlyojat = array();

    foreach($rows as $row){
      $vedonlyojat[] = new Vedonlyoja(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'saldo' => $row['saldo'],
        'rekisteroitymispaiva' => $row['rekisteroitymispaiva']
      ));
    }

    return $vedonlyojat;
  }
  public static function takeMoney($id, $how_much) {
    $query = DB::connection()->prepare('UPDATE Vedonlyoja SET saldo = saldo - :how_much WHERE id = :id');
    $query->execute(array('how_much' => $how_much, 'id' => $id));
  }


}
