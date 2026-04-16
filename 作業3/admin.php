<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("權限不足！此為管理者專區。<br><a href='index.php'>回到登入頁面</a>");
}

if (isset($_POST['delete_cookie'])) {
    setcookie('user_id', '', time() - 3600, "/");
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>管理者專區</title>
</head>
<body>
    <h1 style="color: red;">歡迎來到 管理者專區</h1>
    
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <p>目前的 Session ID: <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
        <?php if(isset($_COOKIE['user_id'])): ?>
            <p>目前儲存的 Cookie ID: <strong><?php echo htmlspecialchars($_COOKIE['user_id']); ?></strong></p>
        <?php else: ?>
            <p style="color: gray;">(Cookie 已被刪除，目前無紀錄)</p>
        <?php endif; ?>
    </div>

    <form method="POST" style="display:inline;">
        <button type="submit" name="delete_cookie">刪除 Cookie</button>
    </form>
    <a href="logout.php"><button>登出系統</button></a>
</body>
</html>