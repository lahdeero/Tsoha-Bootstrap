<?php

class Kohde extends BaseModel {
  public $id, $nimi, $tyyppi, $sulkeutumisaika, $tulos, $laji_id, $laji_nimi;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_nimi');
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT kohde.id, kohde.nimi, kohde.tyyppi, kohde.sulkeutumisaika, kohde.tulos,
      laji.nimi as laji_nimi FROM Kohde LEFT JOIN Laji ON Kohde.laji_id = Laji.id WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $kohde = new Kohde(array(
      'id' => $row['id'],
      'nimi' => $row['nimi'],
      'tyyppi' => $row['tyyppi'],
      'sulkeutumisaika' => $row['sulkeutumisaika'],
      'tulos' => $row['tulos'],
      'laji_nimi' => $row['laji_nimi']
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
        'tulos' => $row['tulos'],
        'laji_id' => $row['laji_id']
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
      $query = DB::connection()->prepare('INSERT INTO Kohde (nimi, tyyppi, sulkeutumisaika, laji_id) VALUES (:nimi, :tyyppi, :sulkeutumisaika, :laji_id) RETURNING id');
      $query->execute(array('nimi' => $this->nimi, 'tyyppi' => $this->tyyppi, 'sulkeutumisaika' => $this->sulkeutumisaika, 'laji_id' => $this->laji_id));
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
