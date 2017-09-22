
<?php

class Kohde extends BaseModel {
  public $id, $nimi, $tyyppi, $sulkeutumisaika;

  public function __construct($attributes){
    parent::__construct($attributes);
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
      'sulkeutumisaika' => $row['sulkeutumisaika']
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
        'sulkeutumisaika' => $row['sulkeutumisaika']
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

  public function delete($id) {
    $query = DB::connection()->prepare('DELETE FROM Kohde WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
  }
}
