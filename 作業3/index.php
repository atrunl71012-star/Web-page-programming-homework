<?php
session_start();

// 如果已經登入，根據角色自動導向對應頁面
// http://localhost/作業3/index.php
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'student') header("Location: student.php");
    if ($_SESSION['role'] === 'teacher') header("Location: teacher.php");
    if ($_SESSION['role'] === 'admin') header("Location: admin.php");
    exit();
}

// 處理表單送出
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = trim($_POST['user_id']);
    $role = $_POST['role'];

    if (!empty($user_id)) {
        // A.2: 設定 Session (記錄角色與登入狀態)
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;

        // A.3: 設定 Cookie (儲存使用者 ID，設定存活時間為 1 天)
        setcookie('user_id', $user_id, time() + 86400, "/");

        // 依據角色導向
        if ($role === 'student') header("Location: student.php");
        elseif ($role === 'teacher') header("Location: teacher.php");
        elseif ($role === 'admin') header("Location: admin.php");
        exit();
    } else {
        $error = "請輸入使用者 ID！";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>系統登入 - 作業3</title>
</head>
<body>
    <h2>系統登入</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    
    <form method="POST" action="index.php">
        <label>使用者 ID：</label>
        <input type="text" name="user_id" value="<?php echo isset($_COOKIE['user_id']) ? htmlspecialchars($_COOKIE['user_id']) : ''; ?>" required>
        <br><br>
        
        <label>身分：</label>
        <select name="role">
            <option value="student">學生 (Student)</option>
            <option value="teacher">教師 (Teacher)</option>
            <option value="admin">管理者 (Admin)</option>
        </select>
        <br><br>
        
        <button type="submit">登入</button>
    </form>
</body>
</html>