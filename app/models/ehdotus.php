<?php

  class Ehdotus extends BaseModel {
    public $id, $nimi, $selvennys, $laji_id, $laji_nimi, $vedonlyoja_id, $vedonlyoja_nimi;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_nimi', 'validate_selvennys');
    }


    public static function all() {
      $query = DB::connection()->prepare('SELECT ehdotus.id, ehdotus.nimi, ehdotus.selvennys,
        ehdotus.laji_id, laji.nimi as laji_nimi, ehdotus.vedonlyoja_id, vedonlyoja.nimi as vedonlyoja_nimi
         FROM Ehdotus LEFT JOIN Laji ON Ehdotus.laji_id = Laji.id
         LEFT JOIN Vedonlyoja ON Ehdotus.vedonlyoja_id = Vedonlyoja.id
          ORDER BY id DESC');

      $query->execute();

      $rows = $query->fetchAll();
      $ehdotukset = array();

      foreach($rows as $row){
        $ehdotukset[] = new Ehdotus(array(
          'id' => $row['id'],
          'nimi' => $row['nimi'],
          'selvennys' => $row['selvennys'],
          'laji_id' => $row['laji_id'],
          'laji_nimi' => $row['laji_nimi'],
          'vedonlyoja_id' => $row['vedonlyoja_id'],
          'vedonlyoja_nimi' => $row['vedonlyoja_nimi']
        ));
      }

      return $ehdotukset;
    }
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Ehdotus (nimi, selvennys, laji_id, vedonlyoja_id) VALUES (:nimi, :selvennys, :laji_id, :vedonlyoja_id) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'selvennys' => $this->selvennys, 'laji_id' => $this->laji_id, 'vedonlyoja_id' => $this->vedonlyoja_id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
  }

?>
