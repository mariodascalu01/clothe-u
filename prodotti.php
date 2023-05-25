<link rel="stylesheet" href="../Clothe-u_Finale/css/styleProdottii.css"> 

<?php 

$productMgr = new ProductManager();

/*if(!empty($_POST['colore'])){
  foreach($_POST['colore'] as $colore){
    echo "value : ".$colore.'<br/>';
  }
}
if(!empty($_POST['brand'])){
  foreach($_POST['brand'] as $marca){
    echo "value : ".$marca.'<br/>';
  }
}
if(!empty($_POST['slider'])){
  foreach($_POST['slider'] as $prezzo){
    echo "value : ".$prezzo.'<br/>';
  }
}
*/
$_SESSION["no_filtro"]=true;
//memorizza nella sessione i parametri del filtro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['colore'])){
    $_SESSION['colore'] = $_POST['colore']; 
  }else{
    $_SESSION['colore'] = [];
  }
  if (!empty($_POST['brand'])){
    $_SESSION['brand'] = $_POST['brand']; 
  }else{
    $_SESSION['brand'] = [];
  }
  if (!empty($_POST['fine'])){
    $_SESSION['inizio'] = $_POST['inizio']; 
    $_SESSION['fine'] = $_POST['fine'];
  }else{
    $_SESSION['inizio'] = [];
    $_SESSION['fine'] = [];
  } 
  $_SESSION['slider'] = $_POST['slider'];
}
//metto i valori del filtro nelle variabili
$colori = [];
$marche = [];
$prezzi= [];

if (isset($_SESSION['colore'])) {
  $colori = $_SESSION['colore'];
}
if (isset($_SESSION['brand'])) {
  $marche = $_SESSION['brand'];
}
if (isset($_SESSION['slider'])) {
  $prezzi = $_SESSION['slider'];
}
//altre variabili con valori del filtro
if (isset($_SESSION['colore']) || isset($_SESSION['brand'])|| isset($_SESSION['slider']) || isset($_SESSION['inizio'])||isset($_SESSION['fine'])){
  if (!empty($_SESSION['colore'])){
    $filtro_colori = $_SESSION['colore']; 
  }else{
    $filtro_colori = [];
  }
  if (!empty($_SESSION['brand'])){
    $filtro_brand = $_SESSION['brand']; 
  }else{
    $filtro_brand = [];
  }
  if (!empty($_SESSION['slider'])){
    $filtro_prezzo = $_SESSION['slider']; 
  }else{
    $filtro_prezzo = [];
  }
  if (!empty($_SESSION['inizio'])){
    $filtro_inizio = $_SESSION['inizio']; 
    $_SESSION["no_filtro"]=false;
  }else{
    $filtro_inizio = [];
  }
  if (!empty($_SESSION['fine'])){
    $filtro_fine = $_SESSION['fine']; 
    $_SESSION["no_filtro"]=false;
  }else{
    $filtro_fine = [];
  }
  $products = $productMgr->getFiltered($filtro_colori,$filtro_brand,$filtro_prezzo,$filtro_inizio,$filtro_fine);
}else{
  $products = $productMgr->getAll();
  $_SESSION["no_filtro"]=true;
}


if (!empty($_POST['brand']) || !empty($_POST['slider']) || !empty($_POST['colore']) || !empty($_POST['fine']))  {
  
  if (!empty($_POST['colore'])){
    $filtro_colori = $_POST['colore']; 
  }else{
    $filtro_colori = [];
  }
  if (!empty($_POST['brand'])){
    $filtro_brand = $_POST['brand']; 
  }else{
    $filtro_brand = [];
  }
  if (!empty($_POST['slider'])){
    $filtro_prezzo = $_POST['slider']; 
  }else{
    $filtro_prezzo = [];
  }
  if (!empty($_POST['inizio'])){
    $filtro_inizio = $_POST['inizio']; 
  }else{
    $filtro_inizio = [];
  }
  if (!empty($_POST['fine'])){
    $filtro_fine = $_POST['fine']; 
  }else{
    $filtro_fine = [];
  }
  $products = $productMgr->getFiltered($filtro_colori,$filtro_brand,$filtro_prezzo,$filtro_inizio,$filtro_fine);
}

?> 


<div class="heading">
        <h1>our <span>Products</span></h1>
    </div>
<div class = bottone_filtro> <button onclick="myFunction();">Filtra</button></div>
<div class= "contenitore"> 
  <div class = "sinistra">
    <div class= "filtri">
      <div class="testo">Filtri</div>

      <form id="scelte" method="post" >
      <b>Scelta del prezzo<br></b>
        <div class="slider-prezzo">
          

          <div class="price-content">
            <div>
              <label>Minimo</label>
              <div class ="min_prezzo">
                <p>$</p><p id="min-value"> <?php echo isset($_SESSION['slider']) ? $prezzi[0] : 10; ?></p>
              </div>
            </div>
            <div>
              <label>Massimo</label>
              <div class ="max_prezzo">
                <p>$</p><p id="max-value"> <?php echo isset($_SESSION['slider']) ? $prezzi[1] : 250; ?></p>
              </div>
            </div>
          </div>

          <div class="range-slider">
            <input type="range" id ="min-price" class="min-price" name ="slider[]" value="<?php echo isset($_SESSION['slider']) ? $prezzi[0] : 10; ?>" min="10" max="250" step="5">
            <input type="range" id ="max-price" class="max-price" name = "slider[]" value="<?php echo isset($_SESSION['slider']) ? $prezzi[1] : 250; ?>" min="10" max="250" step="5" <?php echo $prezzi[1]; ?>>
          </div>
        
        </div>

        <b>Periodo del noleggio<br></b>
        <div class = "in_fin"><small > Inserisci inizio e fine</small></div>
        <div class = "noleggio">
          <label for="inizio"> Da: </label>
          <input type="date" id="inizio" min="<?php echo date('Y-m-d')?>" onchange="setRequired()" name="inizio" value = "<?php echo $_SESSION['inizio'] ?>">
          <label for="fine"> A: </label>
          <input type="date" id="fine" min="<?php echo date('Y-m-d')?>" onchange="setRequired()" name="fine" value = "<?php echo $_SESSION['fine'] ?>">
        </div>

        <b>Scelta del colore<br></b>
        <div class = "insieme_colori">  
          <input class = "col_check" type="checkbox" name="colore[]" value="Blu" <?php if (in_array('Blu', $colori)) { echo 'checked'; } ?>>Blu<br>
          <input class = "col_check" type="checkbox" name="colore[]" value="Rosso" <?php if (in_array('Rosso', $colori)) { echo 'checked'; } ?>>Rosso<br>
          <input class = "col_check" type="checkbox" name="colore[]" value="Verde" <?php if (in_array('Verde', $colori)) { echo 'checked'; } ?>>Verde<br>
          <input class = "col_check" type="checkbox" name="colore[]" value="Giallo" <?php if (in_array('Giallo', $colori)) { echo 'checked'; } ?>>Giallo<br>
          <input class = "col_check" type="checkbox" name="colore[]" value="Arancione" <?php if (in_array('Arancione', $colori)) { echo 'checked'; } ?>>Arancione<br>
          <input class = "col_check" type="checkbox" name="colore[]" value="Viola" <?php if (in_array('Viola', $colori)) { echo 'checked'; } ?>>Viola<br>
          <input class = "col_check" type="checkbox" name="colore[]" value="Bianco" <?php if (in_array('Bianco', $colori)) { echo 'checked'; } ?>>Bianco<br>
          <input class = "col_check" type="checkbox" name="colore[]" value="Nero" <?php if (in_array('Nero', $colori)) { echo 'checked'; } ?>>Nero<br>
          <input class = "col_check" type="checkbox" name="colore[]" value="Rosa" <?php if (in_array('Rosa', $colori)) { echo 'checked'; } ?>>Rosa<br> 
        </div>

        <b>Scelta del Brand<br></b>
        <div class = "insieme_brand">   
          <input class = "col_check" type="checkbox" name="brand[]" value="Nike" <?php if (in_array('Nike', $marche)) { echo 'checked'; } ?>>Nike<br>
          <input class = "col_check" type="checkbox" name="brand[]" value="Adidas" <?php if (in_array('Adidas', $marche)) { echo 'checked'; } ?>>Adidas<br>
          <input class = "col_check" type="checkbox" name="brand[]" value="NewBalance" <?php if (in_array('NewBalance', $marche)) { echo 'checked'; } ?>>New Balance<br>
          <input class = "col_check" type="checkbox" name="brand[]" value="Reebok" <?php if (in_array('Reebok', $marche)) { echo 'checked'; } ?>>Reebok<br>
          <input class = "col_check" type="checkbox" name="brand[]" value="Puma" <?php if (in_array('Puma', $marche)) { echo 'checked'; } ?>>Puma<br>
          <input class = "col_check" type="checkbox" name="brand[]" value="Jordan" <?php if (in_array('Jordan', $marche)) { echo 'checked'; } ?>>Jordan<br>
          <input class = "col_check" type="checkbox" name="brand[]" value="Converse" <?php if (in_array('Converse', $marche)) { echo 'checked'; } ?>>Converse<br>
          <input class = "col_check" type="checkbox" name="brand[]" value="Vans" <?php if (in_array('Vans', $marche)) { echo 'checked'; } ?>>Vans<br>
        </div>

      </form> 
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


        document.getElementById('inizio').addEventListener('change', function() {
          var inizio = document.getElementById('inizio').value;
          document.getElementById('fine').min = inizio;
        });
        document.getElementById('fine').addEventListener('change', function() {
          var fine = document.getElementById('fine').value;
          document.getElementById('inizio').max = fine;
        });
        
        var form = document.querySelector('form');
        var data1 = document.getElementById('inizio');
        var data2 = document.getElementById('fine');
        form.addEventListener('submit', function(e) {
            if (data2.value < data1.value) {
              e.preventDefault();
              alert('La seconda data non può essere minore della prima!');
            }
        });
      </script> 
      <script src="../Clothe-u_Finale/js/sliderscript.js"></script>
      <input class = "filtra" type="button" value="Filtra" onclick="submitForms()" />
      <script>
        submitForms = function(){
        
          let form = document.getElementById("scelte");
          let requiredFields = form.querySelectorAll('[required]');
          for (let i = 0; i < requiredFields.length; i++) {
            if (requiredFields[i].value === '') {
              alert('Si prega di compilare tutti i campi obbligatori.');
              return false;
            }
          }
          form.submit();
        }
    </script>
    </div>  
  </div>    
  <div class = "destra">
    <?php 
    if ($_SESSION["no_filtro"] == true){
      echo "
      <div class = 'messaggio'> Non è selezionato nessun filtro sul periodo del noleggio</div>
      ";
    }
    ?>
    <div class = "row">
      <?php foreach($products as $product) : ?>
      <div class="card" style="width: 22%;">
        <div class = "resize">
        <a href="<?php echo 'http://localhost/Clothe-u_Finale/?page=view-product.php&id='.$product ->id ?>" ><img src=" <?php echo $product -> foto?>" class="card-img-top" alt="..."></a>
        </div>
        <div class="card-body">
          <div class="card-title"><?php echo $product -> nome?> </div>
          <!--<p class="card-text"><?php echo $product -> descrizione?></p>-->
          <div class="card-text">$ <?php echo $product -> prezzo ?> / al giorno</div>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><?php echo $product -> prezzo ?> </li>
          <li class="list-group-item">Colore : <?php echo $product -> colore?></li>
          <li class="list-group-item">Brand :<?php echo $product -> marca?></li>
        </ul>
        
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>

<script>
  //window.location.href = "<?php echo 'http://localhost/Clothe-u_Finale/?page=prodotti.php'?>";
  window.onpopstate = function () { 
    history.pushState(null, null, 'http://localhost/Clothe-u_Finale/?page=homepage.php');
    history.go(0);
  };
</script>
<script type = "text/javascript">
function myFunction(){

}
</script>