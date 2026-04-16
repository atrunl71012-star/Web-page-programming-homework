<?php

//刪除購物車
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    setcookie("cart[$id]", "", time() - 3600, "/");
}

header("Location: shoppingcart.php");
exit();
?>