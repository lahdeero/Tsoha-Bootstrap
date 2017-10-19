
<?php

class Veto extends BaseModel {
  public $id, $nimi, $panos, $palautus, $kohde, $kohde_nimi, $kohde_id, $kohde_tyyppi,
  $vedonlyoja_nimi, $vedonlyoja_id, $valinta, $valinta_id, $valinta_nimi, $kerroin, $mahdollinen_voitto;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_panos', 'validate_saldo', 'validate_valinta');
  }

  public static function find($id){
    if (!isset($id) || $id == 0) {
      return;
    }
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

  public static function all($options) {

    if(isset($options['page']) && isset($options['page_size'])) {
      $page_size = $options['page_size'];
      $page = $options['page'];
    }else {
      $page_size = 10;
      $page = 1;
    }

    $query = DB::connection()->prepare('SELECT Veto.Id, Veto.kohde_id, Kohde.nimi as kohde_nimi, Panos,
       Valinta.nimi as valinta_nimi, Veto.vedonlyoja_id,  vedonlyoja.nimi as vedonlyoja_nimi
       FROM Veto LEFT JOIN Kohde ON Veto.kohde_id = Kohde.id LEFT JOIN Valinta ON Veto.valinta_id = Valinta.id
       LEFT JOIN Vedonlyoja ON Veto.vedonlyoja_id = Vedonlyoja.id ORDER BY Veto.id DESC LIMIT :limit OFFSET :offset');

    $query->execute(array('limit' => $page_size, 'offset' => $page_size * ($page - 1)));

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
  public static function count() {
    $query = DB::connection()->prepare('SELECT count(*) as count FROM VETO');
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

  public function save() {
      $query = DB::connection()->prepare('INSERT INTO Veto (panos, kohde_id, vedonlyoja_id, valinta_id) VALUES (:panos, :kohde_id, :vedonlyoja_id, :valinta_id) RETURNING id');
      $query->execute(array('panos' => $this->panos, 'kohde_id' => $this->kohde_id, 'vedonlyoja_id' => $this->vedonlyoja_id, 'valinta_id' => $this->valinta_id));
      $row = $query->fetch();
      $this->id = $row['id'];
  }

  public static function update($kohde_id, $kerroin, $tulos) {
    $query = DB::connection()->prepare('UPDATE Veto SET palautus = panos * :kerroin WHERE kohde_id = :kohde_id AND valinta_id = :tulos');
    $query->execute(array('kohde_id' => $kohde_id, 'kerroin' => $kerroin, 'tulos' => $tulos));
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
      LEFT JOIN Kohde ON Veto.kohde_id = Kohde.id LEFT JOIN Valinta ON Veto.valinta_id = Valinta.id WHERE vedonlyoja_id = :id ORDER BY Veto.id DESC');
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
  public static function all_bets_in_match($kohde_id) {
    $query = DB::connection()->prepare('UPDATE Veto SET palautus = 0 WHERE kohde_id = :kohde_id');
    $query->execute(array('kohde_id' => $kohde_id));
  }
  public static function winning_bets($kohde_id, $tulos) {
    $query = DB::connection()->prepare('SELECT id,panos,vedonlyoja_id FROM Veto WHERE kohde_id = :kohde_id AND valinta_id = :tulos');
    $query->execute(array('kohde_id' => $kohde_id, 'tulos' => $tulos));
    $rows = $query->fetchAll();

    $vedot = array();
    if($rows){
      foreach($rows as $row){
        $vedot[] = new Veto(array(
          'id' => $row['id'],
          'panos' => $row['panos'],
          'vedonlyoja_id' => $row['vedonlyoja_id']
        ));
      }
      return $vedot;
    }
    return null;
  }
  public static function payWin($id, $bettor_id, $how_much) {
    $query = DB::connection()->prepare('UPDATE Veto SET palautus = panos + :how_much WHERE id = :id');
    $query->execute(array('how_much' => $how_much, 'id' => $id));

    $query = DB::connection()->prepare('UPDATE Vedonlyoja SET saldo = saldo + :how_much WHERE id = :bettor_id');
    $query->execute(array('how_much' => $how_much, 'bettor_id' => $bettor_id));
  }

}
