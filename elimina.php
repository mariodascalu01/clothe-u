<?php
$conn = mysqli_connect('localhost','root','','clothe-u');
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
// Elaborazione della richiesta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE profili SET attivo = 0 WHERE id_utente = $id";
    
    if ($conn->query($sql) === TRUE) {?>

<?php
    } else {
        echo "Errore nell'eliminazione del record: " . $conn->error;
    }
    
}
?>
