<?php
$cm = new CartManager();
$cartId = $cm->getCurrentCartId();
$totale_carrello = $cm->getTotaleCarrello($cartId);
?>



        
<section class="footer">
            <div class="footer-box">
                <h2>Clothe-u</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, voluptas quia repudiandae, facere sit et dolore rerum officiis non expedita quasi, natus alias laboriosam possimus explicabo! Pariatur quaerat deleniti modi!</p>
            
                <div class="social">
                    <a href="#"><i class="bx bxl-facebook"></i></a>
                    <a href="#"><i class="bx bxl-twitter"></i></a>
                    <a href="#"><i class="bx bxl-instagram"></i></a>
                    <a href="#"><i class="bx bxl-tiktok"></i></a>
                </div>
            </div>

            <div class="footer-box">
                <h3>Support</h3>
                <li><a href="#">Products</a></li>
                <li><a href="#">Help & Support</a></li>
                <li><a href="#">Return Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">FAQ</a></li>
            </div>

            <div class="footer-box">
                <h3>Our Collab</h3>
                <li><a href="#">Nike</a></li>
                <li><a href="#">Adidas</a></li>
                <li><a href="#">Puma</a></li>
                <li><a href="#">New Balance</a></li>
                <li><a href="#">Off-White</a></li>
            </div>

            <div class="footer-box">
                <h3>Payment Method</h3>
                <div class="payment">
                    <img src="../Clothe-u_Finale/images/mastercard.png" alt="">
                    <img src="../Clothe-u_Finale/images/visa.png" alt="">
                    <img src="../Clothe-u_Finale/images/paypal.png" alt="">
                    <img src="../Clothe-u_Finale/images/americaEX.png" alt="">

                </div>
            </div>
</section>

        <div class="copyright">
            <p>&#169; Clothe-u All Right Reserved. </p>
        </div>




<script src = "./js/main.js"></script>
<script>
    $(document).ready(function(){
        $('.js-prodottitotali').html('<?php echo $totale_carrello['numero_p'] ?>');
    });
</script>
</body>
</html>