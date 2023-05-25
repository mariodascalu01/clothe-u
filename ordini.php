<?php
$idUtente = $_SESSION['user'];
$ord = new OrderManager();
$ordini = $ord->getOrdini($idUtente);
?>


<link rel="stylesheet" href="../Clothe-u_Finale/css/styleOrdinii.css">
<?php if(count($ordini) > 0) : ?>
<div class="contenitore">
<span class="titolo">Il tuo Carrello </span>
<div class="accordion" id="accordionExample">
    <?php foreach($ordini as $item) :?>
        <?php 
        $prod_ordinati = $ord->getProdottiOrdinati($item['id_ordine']);
        ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $item["id_ordine"]?>" aria-expanded="true" aria-controls="collapse<?php echo $item["id_ordine"]?>">
            Ordine effettuato il : <?php echo $item['istante'] ?>
            </button>
            </h2>
            <div id="collapse<?php echo $item["id_ordine"]?>" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php foreach($prod_ordinati as $prodotto) :?>
                        <div class ="info_prod">
                            <p><?php echo $prodotto['nome'] ?></p>
                            <p>Taglia: <?php echo $prodotto['taglia'] ?></p>
                            <p>Dal : <?php echo $prodotto['inizio'] ?></p>
                            <p>Al : <?php echo $prodotto['fine'] ?></p>
                            <p>$<?php echo $prodotto['prezzo'] ?>/al giorno</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
<?php else: ?>
    <div class = "lead"> Non è stato effettuato ancora nessun ordine.</div>
<?php endif;?>   

