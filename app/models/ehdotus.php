<?php

  class Ehdotus extends BaseModel {
    public $id, $nimi, $selvennys, $laji_id;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_nimi', 'validate_selvennys');
    }


    public static function all() {
      $query = DB::connection()->prepare('SELECT * FROM Ehdotus ORDER BY id DESC');

      $query->execute();

      $rows = $query->fetchAll();
      $ehdotukset = array();

      foreach($rows as $row){
        $ehdotukset[] = new Ehdotus(array(
          'id' => $row['id'],
          'nimi' => $row['nimi'],
          'selvennys' => $row['selvennys'],
          'laji_id' => $row['laji_id']
        ));
      }

      return $ehdotukset;
    }
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Ehdotus (nimi, selvennys) VALUES (:nimi, :selvennys) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'selvennys' => $this->selvennys));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
  }

?>
