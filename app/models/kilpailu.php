<?php

  class Kilpailu extends BaseModel {
    public $id, $nimi, $laji_id;

    public function __construct($attributes){
      parent::__construct($attributes);
    }


    public static function all() {
      $query = DB::connection()->prepare('SELECT * FROM Kilpailu');

      $query->execute();

      $rows = $query->fetchAll();
      $kilpailut = array();

      foreach($rows as $row){
        $kilpailut[] = new Kilpailu(array(
          'id' => $row['id'],
          'nimi' => $row['nimi'],
          'laji_id' => $row['laji_id']
        ));
      }

      return $kilpailut;
    }

  }

?>
