<?php
session_start();

// A.2: Session 控制 - 檢查是否登入且角色為學生
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    die("權限不足！您不是學生或尚未登入。<br><a href='index.php'>回到登入頁面</a>");
}

// A.3: 處理刪除 Cookie 的請求
if (isset($_POST['delete_cookie'])) {
    setcookie('user_id', '', time() - 3600, "/"); // 將過期時間設為過去，藉此刪除
    header("Location: student.php"); // 重新整理頁面以更新顯示
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>學生專區</title>
</head>
<body>
    <h1 style="color: blue;">歡迎來到 學生專區</h1>
    
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <h3>使用者資訊</h3>
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