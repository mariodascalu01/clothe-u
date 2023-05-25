<?php
class CartManager extends DBManager{

    public $clientId;
    
    public function __construct(){
        parent::__construct();
        $this->columns = array( 'id_carrello', 'utente' );
        $this->tableName = 'carrello';
        $this -> _initializeClientIdFromSession();
      }

    //ritorna il totale dei pezzi nel carrello e il loro costo
    public function getTotaleCarrello($cartId){
        $result = $this->db->query("
        SELECT SUM(c.quantita) AS numero_p, SUM(p.prezzo * c.quantita * DATEDIFF(c.fine,c.inizio)) AS costo_totale
        FROM prodotti p JOIN prod_carrello c ON p.id = c.id_prodotto
        WHERE c.id_carrello = $cartId;
        ");
        
        return $result[0];
    }

    //ritorna l'insieme dei prodotti del carrello speicificato
    public function getProdottiCarrello($cartId){
        return $this->db->query("
        SELECT prodotti.nome as nome, prodotti.foto as foto, prod_carrello.taglia as taglia, prodotti.prezzo as prezzo, prod_carrello.quantita as quantita,prodotti.id as id,prodotti.colore as colore,prod_carrello.inizio,prod_carrello.fine,prod_carrello.id as id_prod_carrello
        FROM prodotti INNER JOIN prod_carrello ON prodotti.id = prod_carrello.id_prodotto
        WHERE prod_carrello.id_carrello = $cartId;
        ");
    }


    public function getProd_Carrello($cartId){
        return $this->db->query("
        SELECT id as id, id_carrello as id_carrello, id_prodotto as id_prodotto, taglia as taglia, quantita as quantita,inizio as inizio,fine as fine
        FROM prod_carrello
        WHERE id_carrello = $cartId;
        ");
    }

    //aggiunge un prodotto al carrello
    public function addtoCart($cartId,$productId,$size,$inizio,$fine){
        $quantita = 0;
        $result = $this -> db->query("SELECT quantita FROM prod_carrello WHERE id_carrello = '$cartId' AND id_prodotto = '$productId' AND taglia = '$size' AND inizio = '$inizio' AND fine='$fine'");
        if (count($result) >0){
            $quantita = $result[0]['quantita'];
        }
        $quantita = $quantita + 1;
        if (count($result) >0){
            $this -> db->execute("UPDATE prod_carrello SET quantita = '$quantita' WHERE id_carrello = '$cartId' AND id_prodotto = '$productId' AND taglia = '$size' AND inizio = '$inizio' AND fine='$fine' ");
        } else{
            $cartItemManager = new CartItemManager();
            $newId = $cartItemManager -> create([
                'id_carrello' =>$cartId,
                'id_prodotto' =>$productId,
                'taglia' => $size,
                'quantita'=>$quantita,
                'inizio'=>$inizio,
                'fine'=>$fine
            ]);
        }
        
    }

    public function updateCart($cartId,$productId,$inizio,$fine){
        $this -> db->execute("UPDATE prod_carrello SET inizio = '$inizio',fine = '$fine' WHERE id = '$productId'");   
    }

    public function removefromCart($cartId,$productId,$size,$inizio,$fine){
        $quantita = 0;
        $result = $this -> db->query("SELECT quantita,id FROM prod_carrello WHERE id_carrello = '$cartId' AND id_prodotto = '$productId' AND taglia = '$size' AND inizio = '$inizio' AND fine='$fine'");
        $prod_car_id = $result[0]['id'];
        if (count($result) >0){
            $quantita = $result[0]['quantita'];
        }
        $quantita = $quantita - 1;
        if ($quantita >0){
            $this -> db->execute("UPDATE prod_carrello SET quantita = '$quantita' WHERE id_carrello = '$cartId' AND id_prodotto = '$productId' AND taglia = '$size' AND inizio = '$inizio' AND fine='$fine' ");
        } else{
            $cartItemManager = new CartItemManager();
            $newId = $cartItemManager -> delete($prod_car_id);
        }
    }

    
    //restituisce l'id del carrello dell'utente clientid
    public function getCurrentCartId(){
        $cartId = 0;
        if (isset($_SESSION['user'])){
            $utente =$_SESSION['user'] ;
            $result = $this -> db->query("SELECT * FROM carrello WHERE utente = '$utente'");
        }else{
            $result = $this -> db->query("SELECT * FROM carrello WHERE utente = '$this->clientId'");
        }
        if (count($result) > 0) {
            $cartId = $result[0]['id_carrello'];
        }else{
            $cartId = $this ->create([
                'utente' => $this -> clientId
            ]);
        }
        return $cartId;
    }

    //funzione per il random da associare alla sessione
    private function random_stringa(){
        return 1232434343443;
    }

    //inizializza client id
    private function _initializeClientIdFromSession(){
        if (isset($_SESSION['client_id'])){
            $this ->clientId = $_SESSION['client_id'];
        }else{
            $num = 1234354646;
            $str = strval($num);
            $_SESSION['client_id'] = $str;
            $this ->clientId = $str;
        }
    }
    public function mergeCarts(){
        $utente = $_SESSION['user'];
        $oldUserCart = $this->db->query("SELECT id_carrello FROM carrello where utente = '$utente'");
        $oldClientCart = $this->db->query("SELECT id_carrello FROM carrello where utente = '$this->clientId'");
        
        
        //var_dump($oldUserCart, $oldClientCart, $this->userId, $this->clientId); die;
        if (count($oldClientCart) > 0 AND count($oldUserCart) == 0){
            echo "L'utente non aveva un carrello, ora lo creo";
        ////cambia update con insert_one per non eliminare vecchio carrello client.----------------------------------------------------------------------------
          $result = $this->db->query("UPDATE carrello SET utente = $utente WHERE utente = '$this->clientId'");
        }
  
        else if (count($oldClientCart) > 0 AND count($oldUserCart) > 0 ) {
            //L'utente aveva un carrello, ora li unisco;
          $userCartId = $oldUserCart[0]['id_carrello'];
          $userCartItems = $this->getProdottiCarrello($userCartId);
  
          $clientCartId = $oldClientCart[0]['id_carrello'];
          $clientCartItems = $this->getProdottiCarrello($clientCartId);
          
  
          foreach($clientCartItems as $clientItem){
            
            $isAlreadyInCart = false;
            $clientProductId = $clientItem['id'];
  
            foreach($userCartItems as $userItem){
              if ($userItem['id'] == $clientProductId){
                $isAlreadyInCart = true;
                $newQuantity = $userItem['quantita'] + $clientItem['quantita'];
                $this->db->query("UPDATE prod_carrello SET quantita = $newQuantity  WHERE id_carrello = $userCartId AND id_prodotto = $clientProductId");
                $this->db->query("DELETE FROM prod_carrello WHERE id_carrello = $clientCartId AND id_prodotto = $clientProductId");
                break;
              }
            }
  
            if (!$isAlreadyInCart) {
              $this->db->query("UPDATE prod_carrello SET id_carrello = $userCartId  WHERE id_carrello = $clientCartId AND id_prodotto = $clientProductId");
            }
          }
  
          $result = $this->db->query("DELETE FROM carrello WHERE id_carrello = $clientCartId");
        }
  
        //unset($_SESSION['client_id']);
        return $result;
      }
    
}


class CartItemManager extends DBManager{
    public function __construct(){
        parent::__construct();
        $this->columns = array( 'id', 'id_carrello', 'id_prodotto','taglia','quantita','inizio','fine' );
        $this->tableName = 'prod_carrello';
      }
}
?>