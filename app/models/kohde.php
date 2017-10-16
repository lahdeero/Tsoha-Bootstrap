<?php

class Kohde extends BaseModel {
  public $id, $nimi, $tyyppi, $sulkeutumisaika, $tulos, $laji_id, $laji_nimi;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_nimi', 'validate_tyyppi', 'validate_sulkeutumisaika');
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT kohde.id, kohde.nimi, kohde.tyyppi, kohde.sulkeutumisaika, kohde.tulos,
      laji.nimi as laji_nimi FROM Kohde LEFT JOIN Laji ON Kohde.laji_id = Laji.id WHERE kohde.id = :id LIMIT 1');
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


  public static function all($options) {
    if(isset($options['page']) && isset($options['page_size'])) {
      $page_size = $options['page_size'];
      $page = $options['page'];
    }else {
      $page_size = 10;
      $page = 1;
    }
    $query = DB::connection()->prepare('SELECT * FROM Kohde ORDER BY sulkeutumisaika DESC LIMIT :limit OFFSET :offset');
    $query->execute(array('limit' => $page_size, 'offset' => $page_size * ($page - 1)));

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
  public static function count() {
	  $query = DB::connection()->prepare('SELECT count(*) as count FROM Kohde');
	  $query->execute();

	  $rows = $query->fetchAll();
	  if (!$rows) {
		  return 0;
	  }
	  foreach($rows as $row){
		  $count = $row['count'];
	  }
	  return $count;
  }

  public static function list_by_sport($laji_id) {
    $query = DB::connection()->prepare('SELECT * FROM Kohde WHERE laji_id = :laji_id');
    $query->execute(array('laji_id' => $laji_id));

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

  public static function destroy_options($id) {
    $query = DB::connection()->prepare('DELETE FROM Valinta WHERE kohde_id = :id');
    $query->execute(array('id' => $id));
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
