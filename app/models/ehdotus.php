<?php

  class Ehdotus extends BaseModel {
    public $id, $nimi, $selvennys, $laji_id;

    public function __construct($attributes){
      parent::__construct($attributes);
    }


    public static function all() {
      $query = DB::connection()->prepare('SELECT * FROM Ehdotus');

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

  }

?>
