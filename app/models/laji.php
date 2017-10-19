<?php

  class Laji extends BaseModel {
    public $id, $nimi, $kohteita;

    public function __construct($attributes){
      parent::__construct($attributes);
      $this->validators = array('validate_nimi');
    }

    public static function find($id){
      $query = DB::connection()->prepare('SELECT * FROM Laji WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();

      if($row){
        $laji = new Laji(array(
        'id' => $row['id'],
        'nimi' => $row['nimi']
      ));

      return $laji;
      }

      return null;
    }

    public static function find_by_name($name) {
      $query = DB::connection()->prepare('SELECT * FROM Laji WHERE nimi = :name LIMIT 1');
      $query->execute(array('name' => $name));
      $row = $query->fetch();

      if($row){
        $laji = new Laji(array(
        'id' => $row['id'],
        'nimi' => $row['nimi']
      ));

      return $laji;
      }

      return null;
    }

    public static function all() {
      $query = DB::connection()->prepare('SELECT laji.id,laji.nimi,count(kohde.laji_id) FROM Laji LEFT JOIN Kohde ON Kohde.laji_id = Laji.id GROUP BY Laji.id');
      $query->execute();
      $rows = $query->fetchAll();

      $lajit = array();

      foreach($rows as $row){
        $lajit[] = new Laji(array(
          'id' => $row['id'],
          'nimi' => $row['nimi'],
          'kohteita' => $row['count']
        ));
      }

      return $lajit;
    }
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Laji (nimi) VALUES (:nimi) RETURNING id');
        $query->execute(array('nimi' => $this->nimi));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
  }

?>
