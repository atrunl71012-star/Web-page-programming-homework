<?php
session_start();

// 商品目錄
// 將商品型錄資料存入 Session 變數中，供其他網頁使用
// http://localhost/a1133327_玄_作業3/catalog.php
$_SESSION['products'] = [
    'S001' => ['name' => '10吋平板電腦', 'price' => 12000],
    'S002' => ['name' => '15.6吋筆記型電腦', 'price' => 27000],
    'S003' => ['name' => 'iPhone智慧型手機', 'price' => 21000]
];
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>商品目錄</title>
</head>
<body style="background-color: #f0f0f0; padding: 20px;">
    <form action="savecart.php" method="POST" style="background-color: #dcdcdc; padding: 15px; display: inline-block;">
        <label>選擇商品：</label>
        <select name="id">
            <?php
            // 從 Session 讀取商品並動態產生下拉選單
            foreach ($_SESSION['products'] as $id => $product) {
                echo "<option value='$id'>{$product['name']} - \${$product['price']}</option>";
            }
            ?>
        </select>
        <input type="number" name="quantity" value="1" min="1" style="width: 50px;">
        <button type="submit">訂購</button>
    </form>
    
    <br><br>
    <a href="catalog.php">商品目錄</a> | <a href="shoppingcart.php">檢視購物車</a>
</body>
</html>