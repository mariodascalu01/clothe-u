<link rel="stylesheet" href="../Clothe-u_Finale/css/styleAcquisto.css">

<?php
$cm = new CartManager();
$cartId = $cm->getCurrentCartId();
$totale_carrello = $cm->getTotaleCarrello($cartId);
$prod_car = $cm->getProdottiCarrello($cartId);

$userMgr = new UserManager();
$dati_utente = $userMgr->getDatiUtente($_SESSION["user"]);
$dati = $dati_utente[0];

if (isset($_POST['ordina'])){
    $id_utente = $_SESSION["user"];
    $nome = $_POST['nome'];
    $cognome =$_POST['cognome'];
    $indirizzo = $_POST['indirizzo'];
    $civico = $_POST['civico'];
    $cap = $_POST['cap'];
    $inizio = $_POST['inizio'];
    $fine = $_POST['fine'];
    $opzione_spedizione = $_POST['opzione_spedizione'];
    $carta = $_POST['carta'];
    $prod_carrello = $cm->getProd_Carrello($cartId);
    var_dump($prod_carrello);
    $om = new OrderManager();
    $ordineId = $om ->nuovo_ordine($id_utente,$cartId,$nome,$cognome,$indirizzo,$civico,$cap,$inizio,$fine,$opzione_spedizione,$carta);
    foreach($prod_carrello as $item):
        $modello = $item["id_prodotto"];
        $taglia = $item["taglia"];
        $inizio =$item["inizio"];
        $fine =$item["fine"];
        echo " Questa è la taglia = ".$taglia;
        echo " Questo è l' id del prodotto(modello) = ".$modello;
        echo " Questo è l' id del carrello = ".$cartId;
        for ($i = 0 ; $i < $item["quantita"]; $i++){ 
            $codice = $om  ->assegnaProdotto($modello,$inizio,$fine,$taglia);
            echo "Codice =" .$codice;
            $om ->addtoProdOrdine($ordineId,$codice,$inizio,$fine);
            $cm->removefromCart($cartId,$modello,$taglia,$inizio,$fine);
        }
    endforeach;
}

if (isset($_POST['aggiorna_carrello'])){
    $cm = new CartManager();
    $cartId = $cm->getCurrentCartId();
    $productId = $_POST['id'];
    $inizio = $_POST['inizio'];
    $fine = $_POST['fine'];
    $cm ->updateCart($cartId,$productId,$inizio,$fine);
    header("Refresh:0");
}
?>




<div class= "contenitore"> 
    <title>Form Pagamento</title> 
    <div class ="contenitore2">
        <div class ="compila">
        <h2>Compila il form per il pagamento</h2>
            <form class ="form" method="post" action="" > 
                <label>Nome:</label> 
                <input type="text" name="nome" value = "<?php echo $dati['nome'] ?>" required><br><br> 
                <label>Cognome:</label> 
                <input type="text" name="cognome" value = "<?php echo $dati['cognome'] ?>" required><br><br> 
                <label>Indirizzo:</label> 
                <input type="text" name="indirizzo" value = "<?php echo $dati['indirizzo'] ?>" required><br><br> 
                <label>Civico:</label> 
                <input type="text" name="civico" value = "<?php echo $dati['civico'] ?>" required><br><br> 
                <label>CAP:</label> 
                <input type="text" name="cap" value = "<?php echo $dati['cap'] ?>" required><br><br> 
                <label>Inizio noleggio: </label> 
                <input type="date" id="inizio" name="inizio" min="<?php echo date('Y-m-d')?>" onchange="setRequired()" value = "<?php echo $_SESSION['inizio'] ?>" required><br><br> 
                <label>Fine noleggio: </label> 
                <input type="date" id="fine" name="fine" min="<?php echo date('Y-m-d')?>" onchange="setRequired()" value = "<?php echo $_SESSION['fine'] ?>" required><br><br> 
                <!--<label>Scegli l'opzione di spedizione:</label><br><br> -->
                <script>
                    
                    document.getElementById('inizio').addEventListener('change', function() {
                    var inizio = document.getElementById('inizio').value;
                    document.getElementById('fine').min = inizio;
                    });
                    document.getElementById('fine').addEventListener('change', function() {
                    var fine = document.getElementById('fine').value;
                    document.getElementById('inizio').max = fine;
                    });
                    
                </script>
                <div class = "scelta">
                    <input type="radio" name="opzione_spedizione" value="ritira_punto_raccolta" required >Ritira in un punto di raccolta<br><br> 
                    <input type="radio" name="opzione_spedizione" value="ricevi_casa" required>Ricevi a casa<br><br> 
                </div>
                <label>Carta di credito</label> 
                <input type="text" name="carta" value = "" required><br><br>
                <input type="submit" name = "ordina" value="Paga"> 
            </form> 
        </div>
        <div class="recap">
            <div class = "prodotti">
                <span class="titolo">Il tuo Carrello </span>
                <span class="quantita"><span class ="badge bg-black rounded-pill"><?php echo $totale_carrello['numero_p'] ?></span></span>
                </h4>
                <ul class="gruppo">
                    <?php foreach($prod_car as $item) :?>
                    <li class="nelcarrello">
                        <div class="nomep">
                            <?php echo $item['nome'] ?>
                        </div>
                        <div class = "taglia">
                            <?php echo "Taglia: ".$item['taglia'] ?>
                        </div>
                        <span class="prezzo">  
                            <?php echo "$". $item['prezzo'] ?>
                        </span>
                        <div class = "colore">
                            <?php echo "".$item['colore'] ?>
                        </div>
                    </li>
                    <form method = "post" class ="periodo"  name = "noleggio"> 
                        <b>Periodo del noleggio<br></b>
                        <div class = "noleggio-inizio">
                            <label for="inizio"> Da: </label>
                            <input type="date" id="inizio" min="<?php echo date('Y-m-d')?>"  name="inizio" value = "<?php echo $item['inizio'] ?>" required>
                        </div> 
                        <div class = "noleggio-fine">
                            <label for="fine"> A: </label>
                            <input type="date" id="fine" min="<?php echo date('Y-m-d')?>" name="fine" value = "<?php echo $item['fine'] ?>" required> 
                        </div>
                        <script>
                            
                            //setta valori minimi e mazzimi per inizio e fine noleggio
                            document.getElementById('inizio').addEventListener('change', function() {
                            var inizio = document.getElementById('inizio').value;
                            document.getElementById('fine').min = inizio;
                            });
                            document.getElementById('fine').addEventListener('change', function() {
                            var fine = document.getElementById('fine').value;
                            document.getElementById('inizio').max = fine;
                            });
                        </script>
                        <input name ="id" type = "hidden" value ="<?php echo $item['id_prod_carrello']?>">                       
                        <input name = "aggiorna_carrello" type ="submit" class = "aggiorna_carrello" value ="Cambia giorni">
                    </form>       




                    <?php endforeach; ?>
                </ul>
                <div class = "totale">
                    <div class = "tot">
                        Totale (USD)
                    </div>
                    <div class = "costo" >
                        <sp><strong><?php echo "$".$totale_carrello['costo_totale'] ?></strong></sp>
                    </div>
                </div>
            </div>
            <div class = "costi">

            </div>

        </div>
    </div>
</div>

