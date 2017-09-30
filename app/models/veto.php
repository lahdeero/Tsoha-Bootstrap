
<?php

class Veto extends BaseModel {
  public $id, $nimi, $pelaaja, $merkki, $panos, $palautus, $kohde, $kohde_id, $vedonlyoja_id;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT veto.id,veto.merkki,veto.panos,veto.palautus,
      kohde.nimi as kohde,veto.vedonlyoja_id, veto.kohde_id, veto.vedonlyoja_id FROM Veto
      LEFT JOIN Kohde ON Veto.kohde_id = Kohde.id WHERE veto.id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $veto = new Veto(array(
      'id' => $row['id'],
      'merkki' => $row['merkki'],
      'panos' => $row['panos'],
      'palautus' => $row['palautus'],
      'kohde' => $row['kohde'],
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

  public function save() {
      $query = DB::connection()->prepare('INSERT INTO Veto (merkki, panos, kohde_id, vedonlyoja_id) VALUES (:merkki, :panos, :kohde_id, :vedonlyoja_id) RETURNING id');
      $query->execute(array('merkki' => $this->merkki, 'panos' => $this->panos, 'kohde_id' => $this->kohde_id, 'vedonlyoja_id' => $this->vedonlyoja_id));
      $row = $query->fetch();
      $this->id = $row['id'];
  }

  public static function newest($howmany) {
    $query = DB::connection()->prepare('SELECT kohde.nimi as nimi, Vedonlyoja.nimi as pelaaja, Veto.merkki as merkki, Veto.panos as panos FROM Veto
      LEFT JOIN Kohde ON Veto.kohde_id = Kohde.id LEFT JOIN Vedonlyoja ON Veto.vedonlyoja_id = Vedonlyoja.id
      ORDER BY Veto.id DESC LIMIT :howmany');
    $query->execute(array('howmany' => $howmany));

    $rows = $query->fetchAll();
    $vedot = array();

    foreach($rows as $row){
      $vedot[] = new Veto(array(
        'nimi' => $row['nimi'],
        'pelaaja' => $row['pelaaja'],
        'merkki' => $row['merkki'],
        'panos' => $row['panos']
      ));
    }

    return $vedot;
  }

  public static function user_bets($id) {
    $query = DB::connection()->prepare('SELECT kohde.nimi as nimi, veto.merkki, veto.panos, veto.palautus FROM Veto
      LEFT JOIN Kohde ON Veto.kohde_id = Kohde.id WHERE vedonlyoja_id = :id');
    $query->execute(array('id' => $id));

    $rows = $query->fetchAll();
    $vedot = array();

    if($rows){
      foreach($rows as $row){
        $vedot[] = new Veto(array(
          'nimi' => $row['nimi'],
          'merkki' => $row['merkki'],
          'panos' => $row['panos'],
          'palautus' => $row['palautus']
        ));
      }
      return $vedot;
    }

      return null;
  }
}
