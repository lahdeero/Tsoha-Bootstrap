<?php

  class Laji extends BaseModel {
    public $id, $nimi;

    public function __construct($attributes){
      parent::__construct($attributes);
    }

    public static function all() {
      $query = DB::connection()->prepare('SELECT * FROM Laji');
      $query->execute();
      $rows = $query->fetchAll();

      $lajit = array();

      foreach($rows as $row){
        $lajit[] = new Laji(array(
          'id' => $row['id'],
          'nimi' => $row['nimi']
        ));
      }

      return $lajit;
    }

  }

?>
