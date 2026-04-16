<?php
session_start();

// 檢查購物車並計算
// 確保有商品型錄的資料
$products = isset($_SESSION['products']) ? $_SESSION['products'] : [];
$total = 0; // 總金額初始為 0
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>檢視購物車</title>
    <style>
        table { border-collapse: collapse; background-color: #a9a9a9; }
        th, td { border: 1px solid #555; padding: 5px 10px; }
        th { background-color: #808080; color: white; }
    </style>
</head>
<body style="background-color: #f0f0f0; padding: 20px;">
    
    <table>
        <tr>
            <th>功能</th>
            <th>編號</th>
            <th>名稱</th>
            <th>價格</th>
            <th>數量</th>
        </tr>
        <?php
        // 檢查是否存在名為 cart 的陣列 Cookie
        if (isset($_COOKIE['cart']) && is_array($_COOKIE['cart'])) {
            // 取出 Cookie 中的每一個商品與數量
            foreach ($_COOKIE['cart'] as $id => $quantity) {
                // 確保該商品編號存在於型錄中
                if (isset($products[$id])) {
                    $name = $products[$id]['name'];
                    $price = $products[$id]['price'];
                    $subtotal = $price * $quantity;
                    $total += $subtotal; // 累加總金額
                    
                    echo "<tr>";
                    // 刪除商品的超連結，將商品編號透過GET傳遞給 delete.php
                    echo "<td><a href='delete.php?id=$id' style='color: black; text-decoration: none;'>刪除</a></td>";
                    echo "<td>$id</td>";
                    echo "<td>$name</td>";
                    echo "<td>$price</td>";
                    echo "<td>$quantity</td>";
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='5' style='text-align: center;'>目前購物車是空的</td></tr>";
        }
        ?>
        <tr>
            <td colspan="5" style="text-align: right; background-color: #dcdcdc;">
                總金額 = NT$<?php echo $total; ?>元
            </td>
        </tr>
    </table>

    <br>
    <a href="catalog.php">商品目錄</a> | <a href="shoppingcart.php">檢視購物車</a>

</body>
</html>