<?php 
setcookie("user_id", False, time() - 3600,'/'); // Suppresion du cookie permettant de rester connecté
header('Location: ../Pages/shop.php'); // Redirection vers shop.php
exit;
?>