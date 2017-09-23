<?php

class Yllapitaja extends BaseModel {
  public $nimi;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function all() {
    $query = DB::connection()->prepare('SELECT nimi FROM Yllapitaja');

    $query->execute();

    $rows = $query->fetchAll();
    $yllapitajat = array();

    foreach($rows as $row){
      $yllapitajat[] = new Vedonlyoja(array(
        'nimi' => $row['nimi']
      ));
    }

    return $yllapitajat;
  }
}
