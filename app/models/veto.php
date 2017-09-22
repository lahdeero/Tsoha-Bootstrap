
<?php

class Veto extends BaseModel {
  public $id, $merkki, $summa, $kohde_id, $vedonlyoja_id;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Veto WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $kohde = new Kohde(array(
      'id' => $row['id'],
      'merkki' => $row['merkki'],
      'summa' => $row['summa'],
      'kohde_id' => $row['kohde_id'],
      'vedonlyoja_id' => $row['vedonlyoja_id']
    ));

    return $veto;
    }

    return null;
    }

  public static function all() {
    $query = DB::connection()->prepare('SELECT * FROM Veto');

    $query->execute();

    $rows = $query->fetchAll();
    $vedot = array();

    foreach($rows as $row){
      $vedot[] = new Veto(array(
        'id' => $row['id'],
        'merkki' => $row['merkki'],
        'summa' => $row['summa'],
        'kohde_id' => $row['kohde_id'],
        'vedonlyoja_id' => $row['vedonlyoja_id']
      ));
    }

    return $vedot;
  }
}
