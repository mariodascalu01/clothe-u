<?php

$cm = new CartManager();
$cartId = $cm->getCurrentCartId();

function disponibilita($productId,$size,$inizio,$fine,$quantita){
  $query = "SELECT * FROM magazzino WHERE magazzino.codice NOT IN 
  (SELECT id_prod_magazzino FROM prod_ordine WHERE prod_ordine.inizio >= '$inizio' AND prod_ordine.fine <= '$fine') 
  AND modello = '$productId' AND taglia = '$size'";
  $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  $result = mysqli_query($conn, $query);
  $num_rows = mysqli_num_rows($result)-$quantita;
  return $num_rows;
}

if (isset($_POST['meno'])){
  $productId = $_POST['id'];
  $size = $_POST['taglia'];
  $inizio =$_POST['inizio'];
  $fine=$_POST['fine'];
  $cm ->removefromCart($cartId,$productId,$size,$inizio,$fine);
}
if(isset($_POST['piu'])){
  $productId = $_POST['id'];
  $size = $_POST['taglia'];
  $disp = $_POST['disp'];
  $inizio =$_POST['inizio'];
  $fine=$_POST['fine'];
  $quantita = $_POST['quantita'] + 1;
  echo $quantita;
  echo $disp;
  if($disp > 0){
    $cm ->addtoCart($cartId,$productId,$size,$inizio,$fine);
  }else{
    $message = "Non è disponibile";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
  
}


$totale_carrello = $cm->getTotaleCarrello($cartId);
$prod_car = $cm->getProdottiCarrello($cartId);


?>


<link rel="stylesheet" href="../Clothe-u_Finale/css/styleCarrello.css">
<?php if(count($prod_car) > 0) : ?>
<div class="contenitore">
    <div class="sinistra" > 
        
        <h4 class="intestazione">
          <span class="titolo">Il tuo Carrello </span>
          <span class="quantita"><span class ="badge bg-black rounded-pill"><?php echo $totale_carrello['numero_p'] ?></span></span>
        </h4>
        <!--<div class ="categorie">
           <i class = "nomep"> Nome del prodotto</i> 
           <i class = "quan"> Quantità </i>
           <i class = "Costo"> Costo </i>
        </div>-->
        
        <ul class="gruppo">
          <?php foreach($prod_car as $item) :?>
            <li class="dacomprare">
              <div class ="immagine">
                <img src="<?php echo $item['foto'] ?>" alt="">
              </div>
              <div class = "nome">
                <h6 class="nomep"><?php echo $item['nome'] ?></h6>
              </div>
              <div class = "taglia">
                <?php echo "Taglia: ".$item['taglia'] ?>
              </div>
              <div class = "noleggio">
                <?php echo "<div class = 'inizio'> Dal : ".$item['inizio']."</div>" ?>
                <?php echo "<div class = 'fine'> Al : ".$item['fine']."</div>" ?>
              </div>
              <div class = "disponibilta">
                <?php 
                  $disponibilita = disponibilita($item["id"],$item['taglia'],$item["inizio"],$item["fine"],$item['quantita']);
                  echo "Disponibilità:".$disponibilita 
                ?>
              </div>
              
              <form method = "post" class = "quantita" >
                <div class ="btn-group" role = "group"> Quantità
                    <input type="hidden" name = "inizio" value = "<?php echo $item['inizio']?> "/>
                    <input type="hidden" name = "fine" value = "<?php echo $item['fine']?> "/>
                    <input type="hidden" name = "taglia" value = "<?php echo $item['taglia']?> "/>
                    <input type="hidden" name = "disp" value = "<?php echo $disponibilita?> "/>
                    <input type="hidden" name = "quantita" value = "<?php echo $item['quantita'] ?>"/>
                    <button name = "meno" type="submit" class="bmeno">-</button>
                    <span type="text-muted" class="bq"> <?php echo $item['quantita'] ?>  </span>
                    <button name ="piu" type="submit" class="bpiu">+</button>
                    <input type="hidden" name = "id" value="<?php echo $item['id'] ?>" />
                </div>
              </form>
              <span class="prezzo">  <?php echo "$". $item['prezzo'] ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
        <div class="totale">
            <sp>Total (USD)</sp>
            <sp><strong>$<?php echo $totale_carrello['costo_totale'] ?></strong></sp>
        </div>
    </div>   
    <div class ="destra"> 
            <?php if(isset($_SESSION["user"])){
              echo "
              <form method = 'post' name ='acquisto' action ='http://localhost/Clothe-u_Finale/?page=acquisto.php'> 
                <input name = 'procedi' type ='submit' class = 'acq' value ='Procedi con l acquisto.'>
              </form>
              ";
            }else{
              echo "<div class='accediacq'><a href='http://localhost/Clothe-u_Finale/?page=login.php'>Accedi</a> per acquistare.</div>
              <div class ='regacq'><a href = 'http://localhost/Clothe-u_Finale/?page=register.php'>Registrati</a> se non hai un account.</div>";
            }
            ?>
    </div> 
    <?php else: ?>
      <div class = "lead"> Nessun elemento nel carrello.</div>
      
    </div>
    <?php endif;?>   
</div>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>