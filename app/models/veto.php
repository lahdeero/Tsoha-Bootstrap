
<?php

class Veto extends BaseModel {
  public $id, $nimi, $panos, $palautus, $kohde, $kohde_nimi, $kohde_id, $kohde_tyyppi,
  $vedonlyoja_nimi, $vedonlyoja_id, $valinta, $valinta_id, $valinta_nimi, $kerroin, $mahdollinen_voitto;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_panos', 'validate_saldo');
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT veto.id, veto.panos, veto.palautus,
      kohde.nimi as kohde, kohde.tyyppi as kohde_tyyppi, veto.vedonlyoja_id, veto.kohde_id, veto.vedonlyoja_id, vedonlyoja.nimi as vedonlyoja_nimi,
      valinta.nimi as valinta, valinta.kerroin as kerroin, veto.panos*valinta.kerroin as mahdollinen_voitto FROM Veto
      LEFT JOIN Kohde ON Veto.kohde_id = Kohde.id
      LEFT JOIN Valinta ON Veto.valinta_id = Valinta.id
      LEFT JOIN Vedonlyoja ON Veto.vedonlyoja_id = Vedonlyoja.id
      WHERE veto.id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $veto = new Veto(array(
      'id' => $row['id'],
      'panos' => $row['panos'],
      'palautus' => $row['palautus'],
      'kohde' => $row['kohde'],
      'kohde_id' => $row['kohde_id'],
      'kohde_tyyppi' => $row['kohde_tyyppi'],
      'vedonlyoja_id' => $row['vedonlyoja_id'],
      'vedonlyoja_nimi' => $row['vedonlyoja_nimi'],
      'valinta' => $row['valinta'],
      'kerroin' => $row['kerroin'],
      'mahdollinen_voitto' => $row['mahdollinen_voitto']
    ));

    return $veto;
    }

    return null;
  }

  public static function all() {
    $query = DB::connection()->prepare('SELECT Veto.Id, Veto.kohde_id, Kohde.nimi as kohde_nimi, Panos,
       Valinta.nimi as valinta_nimi, Veto.vedonlyoja_id,  vedonlyoja.nimi as vedonlyoja_nimi
       FROM Veto LEFT JOIN Kohde ON Veto.kohde_id = Kohde.id LEFT JOIN Valinta ON Veto.valinta_id = Valinta.id
       LEFT JOIN Vedonlyoja ON Veto.vedonlyoja_id = Vedonlyoja.id');

    $query->execute();

    $rows = $query->fetchAll();
    $vedot = array();

    foreach($rows as $row){
      $vedot[] = new Veto(array(
        'id' => $row['id'],
        'kohde_id' => $row['kohde_id'],
        'kohde_nimi' => $row['kohde_nimi'],
        'panos' => $row['panos'],
        'valinta_nimi' => $row['valinta_nimi'],
        'vedonlyoja_id' => $row['vedonlyoja_id'],
        'vedonlyoja_nimi' => $row['vedonlyoja_nimi']
      ));
    }

    return $vedot;
  }

  public function save() {
      $query = DB::connection()->prepare('INSERT INTO Veto (panos, kohde_id, vedonlyoja_id, valinta_id) VALUES (:panos, :kohde_id, :vedonlyoja_id, :valinta_id) RETURNING id');
      $query->execute(array('panos' => $this->panos, 'kohde_id' => $this->kohde_id, 'vedonlyoja_id' => $this->vedonlyoja_id, 'valinta_id' => $this->valinta_id));
      $row = $query->fetch();
      $this->id = $row['id'];
  }

  public static function newest($howmany) {
    $query = DB::connection()->prepare('SELECT Veto.id, Kohde.nimi as nimi, Vedonlyoja.nimi as pelaaja, Veto.panos as panos,
      Veto.kohde_id, Valinta.nimi as valinta, Veto.vedonlyoja_id FROM Veto
      LEFT JOIN Kohde ON Veto.kohde_id = Kohde.id LEFT JOIN Vedonlyoja ON Veto.vedonlyoja_id = Vedonlyoja.id LEFT JOIN Valinta ON Veto.valinta_id = Valinta.id
      ORDER BY Veto.id DESC LIMIT :howmany');
    $query->execute(array('howmany' => $howmany));

    $rows = $query->fetchAll();
    $vedot = array();

    foreach($rows as $row){
      $vedot[] = new Veto(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'vedonlyoja_nimi' => $row['pelaaja'],
        'panos' => $row['panos'],
        'kohde_id' => $row['kohde_id'],
        'valinta' => $row['valinta'],
        'vedonlyoja_id' => $row['vedonlyoja_id']
      ));
    }

    return $vedot;
  }

  public static function user_bets($id) {
    $query = DB::connection()->prepare('SELECT Veto.id, kohde.id as kohde_id, kohde.nimi as kohde_nimi, Valinta.nimi as valinta_nimi, veto.panos, veto.palautus FROM Veto
      LEFT JOIN Kohde ON Veto.kohde_id = Kohde.id LEFT JOIN Valinta ON Veto.valinta_id = Valinta.id WHERE vedonlyoja_id = :id');
    $query->execute(array('id' => $id));

    $rows = $query->fetchAll();
    $vedot = array();

    if($rows){
      foreach($rows as $row){
        $vedot[] = new Veto(array(
          'id' => $row['id'],
          'kohde_id' => $row['kohde_id'],
          'kohde_nimi' => $row['kohde_nimi'],
          'valinta_nimi' => $row['valinta_nimi'],
          'panos' => $row['panos'],
          'palautus' => $row['palautus']
        ));
      }
      return $vedot;
    }

      return null;
  }
}
