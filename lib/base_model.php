<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function validate_nimi(){
      $errors = array();
      if($this->nimi == '' || $this->nimi == null){
        $errors[] = 'Nimi ei saa olla tyhjä!';
      }
      if(strlen($this->nimi) < 3){
        $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
      } else if(strlen($this->nimi) > 65){
        $errors[] = 'Nimen pituus ei saa olla yli 65 merkkiä!';
      }

      return $errors;
    }

    public function validate_salasana(){
      $errors = array();
      if($this->salasana == '' || $this->salasana == null){
        $errors[] = 'Salasana ei saa olla tyhjä!';
      }
      if(strlen($this->salasana) < 3){
        $errors[] = 'Salasanan pituuden tulee olla vähintään kolme merkkiä!';
      }
      if(strlen($this->salasana) > 15){
        $errors[] = 'Salasana ei saa olla yli 15 merkkiä pitkä!';
      }
      return $errors;
    }
    public function validate_panos(){
      $errors = array();
      if($this->panos < 1) {
        $errors[] = 'Panos ei saa olla alle yhden!';
      }
      return $errors;
    }
    public function validate_saldo(){
      $errors = array();
      $vedonlyoja = Vedonlyoja::find($this->vedonlyoja_id);

      if($this->panos > $vedonlyoja->saldo) {
        $errors[] = 'Ei tarpeeksi saldoa!';
      }
      return $errors;
    }
    public function validate_kerroin() {
      $errors = array();

      if($this->kerroin <= 1) {
        $errors[] = 'Kertoimen tulee olla yli yhden!';
      } else if ($this->kerroin > 1000) {
        $errors[] = 'Kerroin ei saa olla yli tuhat!';
      }
      return $errors;
    }
    public function validate_valinta() {
      $errors = array();

      if  ($this->valinta_id == null) {
        $errors[] = 'Valinta ei saa olla tyhjä!';
      } else if (!is_numeric($this->valinta_id)) {
        $errors[] = 'Jotain outoa tapahtui!';
      }
      return $errors;
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();
      $validator_errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $validator_errors = $this->{$validator}();
        $errors = array_merge($errors, $validator_errors);
      }

      return $errors;
    }

  }
