<?php
// A.2: 設計登出功能
session_start();

// 清除所有 Session 變數
$_SESSION = array();

// 銷毀 Session
session_destroy();

// 導向回登入頁面
header("Location: index.php");
exit();
?>