<?php
session_start();

//將商品放入購物車
if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $id = $_POST['id'];
    $new_quantity = (int)$_POST['quantity'];
    
    // 檢查是否已經有這個商品
    if (isset($_COOKIE['cart'][$id])) {
        // 累加數量
        $current_quantity = (int)$_COOKIE['cart'][$id];
        $final_quantity = $current_quantity + $new_quantity;
    } else {
        // 如果是第一次買這個商品，數量就是這次選的數量
        $final_quantity = $new_quantity;
    }
    
    setcookie("cart[$id]", $final_quantity, time() + 86400, "/");
}

// 處理完畢後轉址到購物車頁面
header("Location: shoppingcart.php");
exit();
?>