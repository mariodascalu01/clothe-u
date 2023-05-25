<?php
class OrderManager extends DBManager{

    public function __construct(){
        parent::__construct();
        $this->columns = array( 'id_ordine', 'id_utente','id_carrello','nome','cognome','indirizzo','civico','cap','modalita','carta' ,'istante' );
        $this->tableName = 'ordini';
      }



    public function nuovo_ordine($id_utente,$cartId,$nome,$cognome,$indirizzo,$civico,$cap,$opzione_spedizione,$carta){
            
            $ordineId = $this -> create_ordine([
                'id_utente'=>$id_utente,
                'id_carrello' =>$cartId,
                'nome'=>$nome,
                'cognome'=>$cognome,
                'indirizzo' =>$indirizzo,
                'civico' => $civico,
                'cap' =>$cap,
                'modalita' => $opzione_spedizione,
                'carta' => $carta
            ]);
            return $ordineId;
        }


    public function addtoProdOrdine($id_ordine,$id_prod_magazzino,$inizio,$fine){
        $OrderItemManager = new OrderItemManager();
        $newId = $OrderItemManager -> create([
                'id_ordine' =>$id_ordine,
                'id_prod_magazzino' =>$id_prod_magazzino,
                'inizio' =>$inizio,
                'fine' =>$fine
            ]);
        
        }

    public function getOrdini($id_utente){
        return $this->db->query("
            SELECT *
            FROM ordini
            WHERE id_utente = '$id_utente'
        ");
    }

    public function getProdottiOrdinati($id_ordine){
        return $this->db->query("
            SELECT prod_ordine.inizio as inizio,prod_ordine.fine as fine,
            magazzino.taglia as taglia,prodotti.nome as nome,prodotti.prezzo as prezzo
            FROM prod_ordine INNER JOIN magazzino 
            ON prod_ordine.id_prod_magazzino = magazzino.codice 
            INNER JOIN prodotti 
            ON prodotti.id = magazzino.modello
            WHERE prod_ordine.id_ordine = $id_ordine
        ");
    }
/*
    public function assegnaProdotto($id){
        $result = $this->db->query("
            SELECT codice as codice
            FROM magazzino
            WHERE modello = (
                SELECT id_prodotto 
                FROM prod_carrello
                WHERE id = '$id'
            ) AND taglia = (
                SELECT taglia
                FROM prod_carrello 
                WHERE id = '$id'
            ) AND disponibile = '1'
        ");
    
        if (count($result) > 0){
            $scelto = $result[0];
            $codice = $scelto["codice"];
            $this->db->query("
            UPDATE magazzino SET disponibile = '0'  
            WHERE codice = $codice
            ");
        }else{
            echo "Non è disponibile";
        }
        return $codice;
    }*/
    public function assegnaProdotto($modello,$inizio,$fine,$taglia){
        $result = $this->db->query("
            SELECT codice
            FROM magazzino
            WHERE magazzino.modello = '$modello'
            AND taglia = '$taglia'
            AND magazzino.codice NOT IN (
            SELECT id_prod_magazzino
            FROM prod_ordine
            WHERE prod_ordine.inizio >= '$inizio'
            AND prod_ordine.fine <= '$fine' 
        )
        ");
        echo "SELECT codice
        FROM magazzino
        WHERE magazzino.modello = '$modello'
        AND magazzino.codice NOT IN (
        SELECT id_prod_magazzino
        FROM prod_ordine
        WHERE prod_ordine.inizio >= '$inizio'
        AND prod_ordine.fine <= '$fine'";
        if (count($result) == 0){
            echo "Non è disponibile";
        }else{
            $scelto = $result[0];
            $codice = $scelto["codice"];
            return $codice;
        }
        
    }

            
}

class OrderItemManager extends DBManager{
    public function __construct(){
        parent::__construct();
        $this->columns = array( 'id_prod_ordine', 'id_ordine', 'id_prodotto_magazzino','inizio','fine');
        $this->tableName = 'prod_ordine';
      }
}
?>