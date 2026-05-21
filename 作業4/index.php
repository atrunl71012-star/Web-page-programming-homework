<?php
// 1. 資料庫連線與自動建表 (請確保有 test 資料庫)
$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
$pdo->exec("CREATE TABLE IF NOT EXISTS emails (No INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255))");

// 2. 處理背景 API 請求
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'add') { // A. 構建資料庫
        $stmt = $pdo->prepare("INSERT INTO emails (email) VALUES (?)");
        $stmt->execute([$_POST['email']]);
        die("新增成功！");
    }
    if ($_GET['action'] == 'get_list') { // 取得寄信名單
        $sql = "SELECT email FROM emails";
        if ($_POST['type'] == 'random') {
            $num = (int)$_POST['num'];
            $sql .= " ORDER BY RAND() LIMIT $num";
        }
        echo json_encode($pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN));
        die();
    }
    if ($_GET['action'] == 'send') { // 執行單筆寄信
        // mail($_POST['email'], $_POST['sub'], $_POST['msg']); // 實際寄信函式
        die("ok");
    }
}
?>

<!-- ================= 3. 基本前端介面 ================= -->
<!DOCTYPE html>
<html>
<body>
    <h3>A. 構建資料庫</h3>
    信箱：<input type="text" id="email"> 
    <button onclick="addEmail()">新增</button>
    <hr>

    <h3>B. 寄信系統</h3>
    主旨：<input type="text" id="sub"><br>
    內容：<textarea id="msg"></textarea><br><br>

    寄送對象：
    <select id="type">
        <option value="all">全部寄送</option>
        <option value="random">隨機寄送</option>
    </select>
    (隨機時)筆數：<input type="number" id="num" value="5" style="width:50px;"><br>

    寄送間隔：
    <select id="time_type">
        <option value="fixed">固定秒數</option>
        <option value="random">隨機秒數(1~5秒)</option>
    </select>
    (固定時)秒數：<input type="number" id="sec" value="1" style="width:50px;"><br><br>

    <button onclick="sendMail()">開始寄信</button>

    <!-- ================= 4. 控制邏輯 ================= -->
    <script>
        // 新增 Email
        function addEmail() {
            let fd = new FormData();
            fd.append('email', document.getElementById('email').value);
            fetch('?action=add', { method: 'POST', body: fd })
                .then(res => res.text()).then(alert);
        }

        // 寄件邏輯
        async function sendMail() {
            // 取得名單
            let fd = new FormData();
            fd.append('type', document.getElementById('type').value);
            fd.append('num', document.getElementById('num').value);
            let list = await fetch('?action=get_list', { method: 'POST', body: fd }).then(res => res.json());
            
            let total = list.length;
            if (total === 0) return alert("沒有信箱可寄送");

            // 開始迴圈寄信
            for (let i = 0; i < total; i++) {
                let mailData = new FormData();
                mailData.append('email', list[i]);
                mailData.append('sub', document.getElementById('sub').value);
                mailData.append('msg', document.getElementById('msg').value);
                
                // 呼叫 PHP 寄信
                await fetch('?action=send', { method: 'POST', body: mailData });
                
                // 計算並等待秒數
                if (i < total - 1) {
                    let waitTime = document.getElementById('time_type').value === 'fixed' 
                        ? document.getElementById('sec').value 
                        : (Math.random() * 4 + 1); // 隨機 1~5 秒
                    await new Promise(r => setTimeout(r, waitTime * 1000));
                }
            }
            alert("寄送完成！");
        }
    </script>
</body>
</html>