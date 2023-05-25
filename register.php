<?php

$email = '';
$password = '';
$conferma_password = '';
$nome_utente = '';
$nome = '';
$cognome ='';
$indirizzo = '';
$civico = '';
$cap = '';
$telefono = '';

/*if($loggedInUser){

    echo '<script>location.href = "'.ROOT_URL.'?page=homepage.php"</script>';

}*/
if (isset($_POST['register'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];
  $encr_password = md5($password);
  
  $conferma_password =  $_POST['conferma_password'];
  $nome_utente = $_POST['nome_utente'];
  $nome = $_POST['nome'];
  $cognome =$_POST['cognome'];
  $indirizzo = $_POST['indirizzo'];
  $civico = $_POST['civico'];
  $cap = $_POST['cap'];
  $telefono = $_POST['telefono'];

  $userMgr = new UserManager();
  if ($userMgr->passwordsMatch($password,$conferma_password)){
    $userObj = $userMgr->register($nome_utente,$email, $nome,$cognome,$indirizzo,$civico,$cap,$encr_password, $telefono);
    if ($userObj){
      echo "<script>location.href='".ROOT_URL."?page=login.php';</script>";
      exit;
    } else{
      $errMsg = 'registrazione fallita';
    }
  }else{
    $errMsg = 'Errore';
  }
  
  

  
}
?>

<h1>Registrati</h1>

<form method="post" class="mb-4">
  <div class="form-group">
    <label for="email">Email</label>
    <input name="email" id="email" type="email" class="form-control" value="<?php echo $email; ?>">
  </div>
  <div class="form-group">
    <label for="nome_utente">Nome Utente</label>
    <input name="nome_utente" id="nome_utente" type="text" class="form-control" value="<?php echo $nome_utente; ?>">
  </div>
  <div class="form-group">
    <label for="nome">Nome </label>
    <input name="nome" id="nome" type="text" class="form-control" value="<?php echo $nome; ?>">
  </div>
  <div class="form-group">
    <label for="cognome">Cognome </label>
    <input name="cognome" id="cognome" type="text" class="form-control" value="<?php echo $cognome; ?>">
  </div>
  <div class="form-group">
    <label for="indirizzo">Indirizzo </label>
    <input name="indirizzo" id="indirizzo" type="text" class="form-control" value="<?php echo $indirizzo; ?>">
  </div>
  <div class="form-group">
    <label for="civico">Civico </label>
    <input name="civico" id="civico" type="text" class="form-control" value="<?php echo $civico; ?>">
  </div>
  <div class="form-group">
    <label for="cap">CAP </label>
    <input name="cap" id="cap" type="text" class="form-control" value="<?php echo $cap; ?>">
  </div>
  <div class="form-group">
    <label for="telefono">Telefono </label>
    <input name="telefono" id="telefono" type="text" class="form-control" value="<?php echo $telefono; ?>">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input name="password" id="password" type="password" class="form-control" value="<?php echo $password; ?>">
  </div>
  <div class="form-group">
    <label for="conferma_password">Conferma password</label>
    <input name="conferma_password" id="conferma_password" type="password" class="form-control" value="<?php echo $conferma_password; ?>">
  </div>
  <input class="btn btn-primary right" type="submit" value="Register" name="register">
</form>


