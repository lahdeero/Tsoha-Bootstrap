
<?php

class Veto extends BaseModel {
  public $id, $merkki, $panos, $palautus, $kohde_id, $vedonlyoja_id;

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
      'panos' => $row['panos'],
      'palautus' => $row['palautus'],
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
        'panos' => $row['panos'],
        'palautus' => $row['palautus'],
        'kohde_id' => $row['kohde_id'],
        'vedonlyoja_id' => $row['vedonlyoja_id']
      ));
    }

    return $vedot;
  }

  public static function bets($id) {
    $query = DB::connection()->prepare('SELECT * FROM Veto WHERE vedonlyoja_id = :id');
    $query->execute(array('id' => $id));

    $rows = $query->fetchAll();
    $vedot = array();

    if($rows){
      foreach($rows as $row){
        $vedot[] = new Veto(array(
          'id' => $row['id'],
          'merkki' => $row['merkki'],
          'panos' => $row['panos'],
          'palautus' => $row['palautus'],
          'kohde_id' => $row['kohde_id'],
          'vedonlyoja_id' => $row['vedonlyoja_id']
        ));
      }
      return $vedot;
    }

      return null;
  }
}
