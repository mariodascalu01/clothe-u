<?php
unset($loggedInUser);
unset($_SESSION['user']);
echo '<script>location.href = "'.'http://localhost/Clothe-u_Finale/'.'?page=homepage.php"</script>';
exit;
?>