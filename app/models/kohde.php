<?php

class Kohde extends BaseModel {
  public $id, $nimi, $tyyppi, $sulkeutumisaika, $tulos, $kilpailu_id;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_nimi', 'validate_tyyppi');
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Kohde WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $kohde = new Kohde(array(
      'id' => $row['id'],
      'nimi' => $row['nimi'],
      'tyyppi' => $row['tyyppi'],
      'sulkeutumisaika' => $row['sulkeutumisaika'],
      'tulos' => $row['tulos']
    ));

    return $kohde;
    }

    return null;
    }

  public static function all() {
    $query = DB::connection()->prepare('SELECT * FROM Kohde');

    $query->execute();

    $rows = $query->fetchAll();
    $kohteet = array();

    foreach($rows as $row){
      $kohteet[] = new Kohde(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'tyyppi' => $row['tyyppi'],
        'sulkeutumisaika' => $row['sulkeutumisaika'],
        'tulos' => $row['tulos']
      ));
    }

    return $kohteet;
  }

  public static function newest($howmany) {
    $query = DB::connection()->prepare('SELECT * FROM Kohde ORDER BY id DESC LIMIT :howmany');
    $query->execute(array('howmany' => $howmany));

    $rows = $query->fetchAll();
    $kohteet = array();

    foreach($rows as $row){
      $kohteet[] = new Kohde(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'tyyppi' => $row['tyyppi'],
        'sulkeutumisaika' => $row['sulkeutumisaika'],
        'tulos' => $row['tulos']
      ));
    }

    return $kohteet;
  }

  public function save() {
      $query = DB::connection()->prepare('INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika) VALUES (:nimi, :tyyppi, :sulkeutumisaika) RETURNING id');
      $query->execute(array('nimi' => $this->nimi, 'tyyppi' => $this->tyyppi, 'sulkeutumisaika' => $this->sulkeutumisaika));
      $row = $query->fetch();
      $this->id = $row['id'];
  }

  public static function destroy($id) {
    $query = DB::connection()->prepare('DELETE FROM Kohde WHERE id = :id');
    $query->execute(array('id' => $id));
  }

  public function update($id) {
    $query = DB::connection()->prepare('UPDATE Kohde SET nimi = :nimi, tyyppi = :tyyppi, sulkeutumisaika = :sulkeutumisaika, tulos = :tulos WHERE id = :id');
    $query->execute(array('nimi' => $this->nimi, 'tyyppi' => $this->tyyppi, 'sulkeutumisaika' => $this->sulkeutumisaika, 'tulos' => $this->tulos, 'id' => $id));
  }
}
