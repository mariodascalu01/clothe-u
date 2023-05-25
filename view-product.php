<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<?php 
    
    function disponibilitacarrello($productId,$size,$inizio,$fine){
        $query = "SELECT quantita FROM prod_carrello WHERE prod_carrello.inizio >= '$inizio' 
        AND prod_carrello.fine <= '$fine' AND prod_carrello.id_prodotto = '$productId'
        AND prod_carrello.taglia = '$size'";
        $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if ($row == NULL){
            return 0;
        }else{
            return $row['quantita'];
        }
        
      }

    //ritorna il numero di singoli prodotti disponibili in magazzino di una determinato modello e taglia in un certo periodo
    function disponibilita($productId,$size,$inizio,$fine){
        $query = "SELECT * FROM magazzino WHERE magazzino.codice NOT IN 
        (SELECT id_prod_magazzino FROM prod_ordine WHERE prod_ordine.inizio >= '$inizio' AND prod_ordine.fine <= '$fine') 
        AND modello = '$productId' AND taglia = '$size'";
        
        $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $result = mysqli_query($conn, $query);
        $num_rows = mysqli_num_rows($result);
        return $num_rows;
      }

    //crea variabili per informazioni sul prodotto e aggiunta al carrello
    if (isset($_POST['aggiungi_al_c'])){
        $productId = $_POST['id'];
        $size = $_POST['taglia'];
        $inizio = $_POST['inizio'];
        $fine = $_POST['fine'];
        $cm = new CartManager();
        $cartId = $cm->getCurrentCartId();
        $cm ->addtoCart($cartId,$productId,$size,$inizio,$fine);
        $_SESSION['inizio'] = $_POST['inizio']; 
        $_SESSION['fine'] = $_POST['fine'];
    }
    // crea variabile prodotto su id
    $id = trim($_GET['id']);
    $pm = new ProductManager();
    $product = $pm->get($id);
    if (!(property_exists($product,'id'))){
        echo "<script>location.href = '".ROOT_URL."';</script>";
        exit;
    }
    
?>

<?php if(isset($_GET['taglia']) ){
    $taglia = $_GET['taglia'];
    echo "
    <style>
        #".$taglia."{
            border: rgb(85, 39, 39) solid 2px;
            background-color: rgb(255, 255, 255);
            border-radius: 10px;
            margin-top: 5px;
            margin-left: 7px;
            background-color: rgb(155, 77, 77);
            color: white;
            width: 80px;
        }
    </style>
    ";} 
?>
<link rel="stylesheet" href="../Clothe-u_Finale/css/stylePaginaprodotto.css">
<section class="sproduct">
    <div class = "sinistra">
        <div class="immagine">
            <img src="<?php echo $product->foto?>" id="MainImg" alt="">
        </div>
        <div class="small-img-group">
            <div class="small-img">
                <img src="<?php echo $product->foto?>" onclick="showImg(this.src)" class = "small-img" alt="">
            </div>
            <div class="small-img">
                <img src="<?php echo $product->foto2?>" onclick="showImg(this.src)" class = "small-img" alt="">
            </div>
            <div class="small-img">
                <img src="<?php echo $product->foto3?>" onclick="showImg(this.src)" class = "small-img" alt="">
            </div>
        </div>
    </div>
    <div class = "right">
        <div class="indirizzo" >Home > Prodotti > <?php echo $product->categoria?></div>
        <div class = "nomep"> <?php echo $product->nome?> </div> 
        <div class = "marca"> <?php echo $product->marca?> </div>  
        <div class="rating">
            <i class="fa fa-star fa-2xs" ></i>
            <i class="fa fa-star fa-2xs" ></i>
            <i class="fa fa-star fa-2xs" ></i>
            <i class="fa fa-star fa-2xs" ></i>
            <i class="fa fa-star fa-2xs" ></i>
        </div> 
        <div class="dettagli">Dettagli prodotto:</div>
        <div class="descrizione"> <d><?php echo $product->descrizione?></d></div>
        <div class="prezzo"> $ <?php echo $product->prezzo?> </div>  
        <div class="container">
            <n>Taglia:</n>
            <div class = "taglia" >  
                <?php 
                    if (disponibilita($id,'38',$_SESSION["inizio"],$_SESSION["fine"]) - disponibilitacarrello($id,'38',$_SESSION["inizio"],$_SESSION["fine"]) == 0){
                        echo "<button id = 'b38' value = '38' class = 'numeroscarpa' disabled style='color:red;'>38</button>";
                    }
                    else{
                        echo "<button id = 'b38' value = '38' class = 'numeroscarpa' onclick='aggiorna(this.id)'>38</button>";
                    }
                ?>
                <?php 
                    if (disponibilita($id,'39',$_SESSION["inizio"],$_SESSION["fine"])- disponibilitacarrello($id,'39',$_SESSION["inizio"],$_SESSION["fine"]) == 0){
                        echo "<button id = 'b39' value = '39' class = 'numeroscarpa' disabled style='color:red;'>39</button>";
                    }
                    else{
                        echo "<button id = 'b39' value = '39' class = 'numeroscarpa' onclick='aggiorna(this.id)'>39</button>";
                    }
                ?>
                <?php 
                    if (disponibilita($id,'40',$_SESSION["inizio"],$_SESSION["fine"]) == 0){
                        echo "<button id = 'b40' value = '40' class = 'numeroscarpa' disabled style='color:red;'>40</button>";
                    }
                    else{
                        echo "<button id = 'b40' value = '40' class = 'numeroscarpa' onclick='aggiorna(this.id)'>40</button>";
                    }
                ?>
                <?php 
                    if (disponibilita($id,'41',$_SESSION["inizio"],$_SESSION["fine"]) == 0){
                        echo "<button id = 'b41' value = '41' class = 'numeroscarpa' disabled style='color:red;'>41</button>";
                    }
                    else{
                        echo "<button id = 'b41' value = '41' class = 'numeroscarpa' onclick='aggiorna(this.id)'>41</button>";
                    }
                ?>
                <?php 
                    if (disponibilita($id,'42',$_SESSION["inizio"],$_SESSION["fine"]) == 0){
                        echo "<button id = 'b42' value = '42' class = 'numeroscarpa' disabled style='color:red;'>42</button>";
                    }
                    else{
                        echo "<button id = 'b42' value = '42' class = 'numeroscarpa' onclick='aggiorna(this.id)'>42</button>";
                    }
                ?>
                <?php 
                    if (disponibilita($id,'43',$_SESSION["inizio"],$_SESSION["fine"]) == 0){
                        echo "<button id = 'b43' value = '43' class = 'numeroscarpa' disabled style='color:red;'>43</button>";
                    }
                    else{
                        echo "<button id = 'b43' value = '43' class = 'numeroscarpa' onclick='aggiorna(this.id)'>43</button>";
                    }
                ?>
                <?php 
                    if (disponibilita($id,'44',$_SESSION["inizio"],$_SESSION["fine"]) == 0){
                        echo "<button id = 'b44' value = '44' class = 'numeroscarpa' disabled style='color:red;'>44</button>";
                    }
                    else{
                        echo "<button id = 'b44' value = '44' class = 'numeroscarpa' onclick='aggiorna(this.id)'>44</button>";
                    }
                ?>
                <?php 
                    if (disponibilita($id,'45',$_SESSION["inizio"],$_SESSION["fine"]) == 0){
                        echo "<button id = 'b45' value = '45' class = 'numeroscarpa' disabled style='color:red;'>45</button>";
                    }
                    else{
                        echo "<button id = 'b45' value = '45' class = 'numeroscarpa' onclick='aggiorna(this.id)'>45</button>";
                    }
                ?>
            </div>
        </div>
        <script>

        /////disabilita bottoni se non c'è dispinibilita
            function controlButton($size) {
                if (disponibilita($id,$size,$_SESSION["inizio"],$_SESSION["fine"]) = 0) {
                    return true;
                } else {
                    return false;
                }
            }
            var buttons = document.getElementsByClassName("numeroscarpa");
            for (var i = 0; i < buttons.length; i++) {
                if (controlButton(buttons[i].value)){
                        buttons[i].disabled = true;
                    }else{
                        buttons[i].disabled = false;
                    }
                };
            
        </script>
        
        <!--<div class = "quantita">
            <n> Quantità:</n>
            <input name = "quan" type="number" value = "1">
        </div>-->
        <div class="btnshopping">
            <form method = "post" class ="periodo"> 
                <b>Periodo del noleggio<br></b>
                <div class = "noleggio-inizio">
                    <label for="inizio"> Da: </label>
                    <input type="date" id="inizio" min="<?php echo date('Y-m-d')?>" onchange="setRequired()" name="inizio" value = "<?php echo $_SESSION['inizio'] ?>">
                </div> 
                <div class = "noleggio-fine">
                    <label for="fine"> A: </label>
                    <input type="date" id="fine" min="<?php echo date('Y-m-d')?>" onchange="setRequired()" name="fine" value = "<?php echo $_SESSION['fine'] ?>"> 
                </div>
                <small > Inserisci inizio e fine</small>
                <script>
                    
                    function setRequired() {
                    // Verifica se il primo campo è stato compilato
                    if (document.getElementById('inizio').value) {
                        // Rendi il secondo campo obbligatorio
                        document.getElementById('fine').required = true;
                    } else {
                        // Rendi il secondo campo non obbligatorio
                        document.getElementById('fine').required = false;
                    }
                    if (document.getElementById('fine').value) {
                        // Rendi il secondo campo obbligatorio
                        document.getElementById('inizio').required = true;
                    } else {
                        // Rendi il secondo campo non obbligatorio
                        document.getElementById('inizio').required = false;
                    }
                    }

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
                <input name ="id" type = "hidden" value ="<?php echo $product->id?>">
                <input name ="taglia" id = "formtaglia" type = "hidden" >
                
                <input name = "aggiungi_al_c" type ="submit" class = "btncarrello" value ="Aggiungi al carrello">
            </form>
            <script>
                //prende il valore id dall'URL
                function getParametroDaUrl(nomeParametro) {
                var url = new URL(window.location.href);
                var valore = url.searchParams.get(nomeParametro);
                return valore;
                }

                var id = getParametroDaUrl("taglia");
                let bottone = document.getElementById(id);
                let valore = bottone.value;
                let inputForm = document.getElementById("formtaglia");
                inputForm.setAttribute("value", valore);
            </script>
            
        </div>
    </div>
                
</section>

<!------------------------------------------------------------------------------------------------------------------------------------------------------

<link rel="stylesheet" href="../Clothe-u_Finale/css/styleprova.css">
<section>
    <div class="contenitore">
        <div class = "contenitore2">
            <input type="radio" name="slider" class="d-none" id="s1" checked>
            <input type="radio" name="slider" class="d-none" id="s2">
            <input type="radio" name="slider" class="d-none" id="s3">
            <input type="radio" name="slider" class="d-none" id="s4">
            <input type="radio" name="slider" class="d-none" id="s5">

            <div class="cards">
            <label for="s1" id="slide1">
                <div class="card">
                <div class="image">
                    <img src="<?php echo $product->foto?>" alt="">
                    
                </div>
                <div class="infos">
                    <span class="name">Nike SuperRep Go</span>
                    <span class="lorem">Lorem ipsum dolor sit amet, sit amet  adipiscing elit. Aenean vel ansd . Nullam
                    lorem. Nulla eu
                    sodales</span>
                </div>
                <a href="/contact" class="btn-contact">Details</a>
                <div class="socials">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-regular fa-bookmark"></i>
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
                </div>
            </label>
            <label for="s2" id="slide2">
                <div class="card">
                <div class="image">
                    <img src="<?php echo $product->foto?>" alt="">
                    
                </div>
                <div class="infos">
                    <span class="name">Nike SuperRep Go</span>
                    <span class="lorem">Lorem ipsum dolor sit amet, sit amet  adipiscing elit. Aenean vel ansd . Nullam
                    lorem. Nulla eu
                    sodales</span>
                </div>
                <a href="/contact" class="btn-contact">Details</a>
                <div class="socials">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-regular fa-bookmark"></i>
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
                </div>
            </label>
            <label for="s3" id="slide3">
                <div class="card">
                <div class="image">
                    <img src="<?php echo $product->foto?>" alt="">
                    
                </div>
                <div class="infos">
                    <span class="name">Nike SuperRep Go</span>
                    <span class="lorem">Lorem ipsum dolor sit amet, sit amet  adipiscing elit. Aenean vel ansd . Nullam
                    lorem. Nulla eu
                    sodales</span>
                </div>
                <a href="/contact" class="btn-contact">Details</a>
                <div class="socials">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-regular fa-bookmark"></i>
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
                </div>
            </label>
            <label for="s4" id="slide4">
                <div class="card">
                <div class="image">
                    <img src="<?php echo $product->foto?>" alt="">
                    
                </div>
                <div class="infos">
                    <span class="name">Nike SuperRep Go</span>
                    <span class="lorem">Lorem ipsum dolor sit amet, sit amet  adipiscing elit. Aenean vel ansd . Nullam
                    lorem. Nulla eu
                    sodales</span>
                </div>
                <a href="/contact" class="btn-contact">Details</a>
                <div class="socials">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-regular fa-bookmark"></i>
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
                </div>
            </label>
            <label for="s5" id="slide5">
                <div class="card">
                <div class="image">
                    <img src="<?php echo $product->foto?>" alt="">
                    
                </div>
                <div class="infos">
                    <span class="name">Nike SuperRep Go</span>
                    <span class="lorem">Lorem ipsum dolor sit amet, sit amet  adipiscing elit. Aenean vel ansd . Nullam
                    lorem. Nulla eu
                    sodales</span>
                </div>
                <a href="/contact" class="btn-contact">Details</a>
                <div class="socials">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-regular fa-bookmark"></i>
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
                </div>
            </label>

            
            </div>
        </div>
    </div>
</section>-->

<!----------inizio script---------------------------->

        <script>
            let immagine = document.querySelector('.immagine img');
            function showImg(pic){
                immagine.src = pic;
            }
        </script>
        <!--<script>
                $(document).ready(function(){
                    $('#38,#39,#40,#41,#42,#43,#44').click(function(){
                        $('#38,#39,#40,#41,#42,#43,#44').removeClass('numeroattivo');
                        $('#38,#39,#40,#41,#42,#43,#44').addClass('numero');
                        $(this).removeClass('numero');
                        $(this).addClass('numeroattivo');
                    });
                });      
        </script>-->
        <script> 
        //gestisce il tasto back
        function aggiorna(id_p) { 
            var button = document.getElementById(id_p);
            history.pushState(null, null, 'http://localhost/Clothe-u_Finale/?page=prodotti.php');
            window.location.href = "<?php echo 'http://localhost/Clothe-u_Finale/?page=view-product.php&id='.$product ->id ?>" + "&taglia=" +button.id;
        }
        </script>
        <script>
            
            window.onpopstate = function () {
                
                history.go(1);
            };
        </script>
        
        