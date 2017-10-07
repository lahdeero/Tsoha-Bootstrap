<?php

class Valinta extends BaseModel {

  public $id, $nimi, $kerroin, $kohde_id;

  public static function find($kohde_id) {
    $query = DB::connection()->prepare('SELECT * FROM Valinta WHERE kohde_id = :kohde_id');
    $query->execute(array('kohde_id' => $kohde_id));

    $rows = $query->fetchAll();
    $valinnat = array();

    foreach($rows as $row){
      $valinnat[] = new Valinta(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'kerroin' => $row['kerroin'],
        'kohde_id' => $row['kohde_id']
      ));
    }

    return $valinnat;
  }

  public function save() {
      $query = DB::connection()->prepare('INSERT INTO Valinta (nimi, kerroin, kohde_id) VALUES (:nimi, :kerroin, :kohde_id) RETURNING id');
      $query->execute(array('nimi' => $this->nimi, 'kerroin' => $this->kerroin, 'kohde_id' => $this->kohde_id));
      $row = $query->fetch();
      $this->id = $row['id'];
  }

  public static function destroy($id) {
    $query = DB::connection()->prepare('DELETE FROM Valinta WHERE id = :id');
    $query->execute(array('id' => $id));
  }

}

?>
