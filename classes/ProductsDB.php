<?php

class ProductsDB {

  public $id;
  public $name;
  public $photo;
  public $brand;
  public $color;
  public $price;
  public $description;
  public $rating;
  public $category;

  public function __construct($id, $name,$photo,$brand,$color, $price, $description,$rating,$category){
    $this->id = (int)$id;
    $this->nome = $name;
    $this->foto = $photo;
    $this->marca = $brand;
    $this->colore = $color;
    $this->prezzo = (float)$price;
    $this->descrizione = $description;
    $this->rating = (float)$rating;
    $this->categoria = $category;
  }
}

class ProductManager extends DBManager {

  public function __construct(){
    parent::__construct();
    $this->columns = array( 'id', 'nome', 'foto','foto2', 'foto3' ,'marca','colore','prezzo', 'descrizione', 'rating','categoria' );
    $this->tableName = 'prodotti';
  }
}