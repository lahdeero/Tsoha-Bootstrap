<?php

class Valinta extends BaseModel {

  public $id, $nimi, $kohde_id;

  public static function find($kohde_id) {
    $query = DB::connection()->prepare('SELECT * FROM Valinta WHERE kohde_id = :kohde_id');
    $query->execute(array('kohde_id' => $kohde_id));

    $rows = $query->fetchAll();
    $valinnat = array();

    foreach($rows as $row){
      $valinnat[] = new Valinta(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'kohde_id' => $row['kohde_id']
      ));
    }

    return $valinnat;
  }
}

?>
