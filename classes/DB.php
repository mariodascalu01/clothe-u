<?php

class DB{

    private $conn;
    public $pdo;

    public function __construct(){

        global $conn;
        $this ->conn = $conn;

        if (mysqli_connect_errno()){
            echo 'Failed to connect to MySql'.mysqli_connect_errno();
            die;
        }

        $this -> pdo= new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
        $this -> pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } 

    public function query($sql){
        //try{
            $q = $this ->pdo->query($sql);
            if(!$q){
                //throw new Exception("Error executing query...");
                return;
            }
            $data = $q->fetchAll();
            return $data;
       // }
        //catch(Exception $e){
        //    throw $e;
       // }
        
    }

    public function execute($sql){
      $stmt = $this->pdo->prepare($sql);
      $stmt ->execute();
    }
    
    public function select_all($tableName, $columns = array()) {

        $query = 'SELECT ';
    
        $strCol = '';
        //var_dump($columns); die;
        foreach($columns as $colName) {
          $strCol .= ' '. $colName . ',';
        }
        $strCol = substr($strCol, 0, -1);
    
        $query .= $strCol . ' FROM ' . $tableName;
        //echo $query;
        $result = mysqli_query($this->conn, $query);
        $resultArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
        mysqli_free_result($result);
    
        return $resultArray;
    }
    
    public function select_one($tableName, $columns = array(), $id) {
    
        $strCol = '';
        foreach($columns as $colName) {
          $colName =$colName;
          $strCol .= ' ' . $colName . ',';
        }
        $strCol = substr($strCol, 0, -1);
        $id = $id;
        $query = "SELECT $strCol FROM $tableName WHERE id = $id";
    
        $result = mysqli_query($this->conn, $query);
        $resultArray = mysqli_fetch_assoc($result);
    
        mysqli_free_result($result);
    
        return $resultArray;
    }
    
    public function delete_one($tableName, $id) {
    
        $id = $id;
        $query = "DELETE FROM $tableName WHERE id = $id";
    
        if (mysqli_query($this->conn, $query)) {
          $rowsAffected = mysqli_affected_rows($this->conn);
    
          return $rowsAffected;
        } else {
    
          return -1;
        }
    }
    
    public function update_one($tableName, $columns = array(), $id) {
    
        $id = esc($id);
        $strCol = '';
        foreach($columns as $colName => $colValue) {
          $colName = esc($colName);
          $strCol .= " " . $colName . " = '$colValue' ,";
        }
        $strCol = substr($strCol, 0, -1);
    
        $query = "UPDATE $tableName SET $strCol WHERE id = $id";
    
        if (mysqli_query($this->conn, $query)) {
          $rowsAffected = mysqli_affected_rows($this->conn);
    
          return $rowsAffected;
        } else {
    
          return -1;
        }
    }
    
    public function insert_one ($tableName, $columns = array()) {
    
        $strCol = '';
        foreach($columns as $colName => $colValue) {
          $colName = $colName;
          $strCol .= ' ' . $colName . ',';
        }
        $strCol = substr($strCol, 0, -1);
    
        $strColValues = '';
        foreach($columns as $colName => $colValue) {
          $colValue = $colValue;
          $strColValues .= " '" . $colValue . "' ,";
        }
        $strColValues = substr($strColValues, 0, -1);
    
        $query = "INSERT INTO $tableName ($strCol) VALUES ($strColValues)";
        //var_dump($query); die;
        if (mysqli_query($this->conn, $query)) {
          $lastId = mysqli_insert_id($this->conn);
    
          return $lastId;
        } else {
    
          return -1;
        }
    }

    public function select_filtered($tableName, $columns = array(),$colori,$brand,$prezzo,$inizio,$fine){
      $strCol = '';
        foreach($columns as $colName) {
          $colName =$colName;
          $strCol .= ' ' . $colName . ',';
        }
        $strCol = substr($strCol, 0, -1);
        $query = "SELECT $strCol FROM $tableName WHERE ";
        if ($colori!= NULL){
          foreach($colori as $colore){
            $colore =$colore;
            $query .= ' ' . "colore ='". $colore."' ".'OR';
          }
          $query = substr($query, 0, -2);
          $query.= "AND"." ";
        }
        if ($brand!= NULL){
          foreach($brand as $marca){
            $marca =$marca;
            $query .=  "marca = '". $marca."' ".'OR';
          }
          $query = substr($query, 0, -2);
          $query.= "AND"." ";
        }
        if ($inizio!= NULL){
          $nuova_query ="SELECT modello FROM magazzino WHERE magazzino.codice NOT IN
          (SELECT id_prod_magazzino FROM prod_ordine 
          WHERE prod_ordine.inizio >= '$inizio' AND prod_ordine.fine <= '$fine')";
          $query .= $tableName. ".id IN (". $nuova_query.")".' ';
          $query.= "AND"." ";
        }
        if ($prezzo!= NULL){
          $query .= "prezzo >= ".$prezzo[0].' '.'AND'.' '.'prezzo <='.$prezzo[1];
        }
        echo $query;
        $result = mysqli_query($this->conn, $query);
        $resultArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
        mysqli_free_result($result);
    
        return $resultArray;
        
    }
    
}
class DBManager {

    protected $db;
    protected $columns;
    protected $tableName;
  
    public function __construct(){
      $this->db = new DB();
    }
  
    public function get($id) {
      $resultArr = $this->db->select_one($this->tableName, $this->columns, (int)$id);
      return (object) $resultArr;
    }
  
    public function getAll() {
      $results = $this->db->select_all($this->tableName, $this->columns);
      $objects = array();
      foreach($results as $result) {
        array_push($objects, (object)$result);
      }
      return $objects;
    }
  
    public function create($obj) {
      $newId = $this->db->insert_one("$this->tableName", (array) $obj);
      return $newId;
    }
    public function create_utente($obj) {
      $newId = $this->db->insert_one("profili", (array) $obj);
      return $newId;
    }
    public function create_ordine($obj) {
      $newId = $this->db->insert_one("ordini", (array) $obj);
      return $newId;
    }
  
    public function delete($id) {
      $rowsDeleted = $this->db->delete_one($this->tableName, (int)$id);
      return (int) $rowsDeleted;
    }
  
    public function update($obj, $id) {
      $rowsUpdated = $this->db->update_one($this->tableName, (array) $obj, (int)$id);
      return (int) $rowsUpdated;
    }
    public function getFiltered($colori,$brand,$prezzo,$inizio,$fine){
      //echo "colori = ".var_dump($colori)." brand = ".var_dump($brand)."prezzo = ".var_dump($prezzo)." inizio = ".$inizio." fine = ".$fine;
      $results = $this->db->select_filtered($this->tableName, $this->columns,$colori,$brand,$prezzo,$inizio,$fine);
      $objects = array();
      foreach($results as $result) {
        array_push($objects, (object)$result);
      }
      return $objects;
    }
  }