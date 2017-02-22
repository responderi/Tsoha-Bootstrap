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

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $validator_errors = $this->{$validator}();
        $errors = array_merge($errors, $validator_errors);
      }

      return $errors;
    }

    public function validate_name_length($stringtype, $string, $minimum, $maximum){
      $errors = array();

      if($string == null || $string == ''){
        $errors[] = $stringtype . ' ei saa olla tyhjä!';
      }
      if(strlen($string) < $minimum){
        $errors[] = $stringtype . ' täytyy olla vähintään ' . $minimum . ' merkkiä pitkä!';
      }
      if(strlen($string) > $maximum){
        $errors[] = $stringtype . ' ei saa olla pidempi kuin ' . $maximum . ' merkkiä!';
      }

      return $errors;
    }

    public function validate_description_length($stringtype, $string, $maximum){
      $errors = array();

      if(strlen($string) > $maximum){
        $errors[] = $stringtype . ' ei saa olla pidempi kuin ' . $maximum . ' merkkiä!';
      }

      return $errors;
    }
  }
