<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>夏令營報名表</title>
</head>
<body>

    <center>
        <h2><b>2026 創客與奇幻夏令營 報名表</b></h2>
    </center>
    <hr width="80%" color="blue"/>

    <form action="" method="post">
        
        姓名 (Name): <input type="text" placeholder="your name" name="nName" required><br><br>

        性別 (Gender):
        <input type="radio" name="mGender" value="男" id="gender_m"> <label for="gender_m">男</label>
        <input type="radio" name="mGender" value="女" id="gender_f"> <label for="gender_f">女</label>
        <br><br>

        報名項目 (Camp Activity):<br>
        <input type="radio" name="mCamp" value="游泳" id="camp_swim"> <label for="camp_swim">游泳</label>
        <input type="radio" name="mCamp" value="攀岩" id="camp_climb"> <label for="camp_climb">攀岩</label>
        <input type="radio" name="mCamp" value="球類運動" id="camp_ball"> <label for="camp_ball">球類運動</label>
        <br><br>

        所在城市 (City):
        <select name="nCity">
            <option value="Taipei">台北</option>
            <option value="Taichung">台中</option>
            <option value="Kaohsiung">高雄</option>
        </select>
        
        <br>
        <input type="submit" value="送出報名">
        <input type="reset" value="重新填寫">

        <a href="high_big_school.png">點這裡進去看看</a>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&t=2s"><h2>這是彩蛋</h2></a>
    </form>

    <?php
    // 檢查使用者是否已經按下「送出」按鈕
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        echo "<hr>";
        echo "<h3>報名成功！以下是您的資料：</h3>";

        // 接收姓名 (對應 HTML 裡的 name="nName")
        $name = $_POST["nName"];
        echo "姓名 (Name): " . htmlspecialchars($name) . "<br>";

        // 接收性別 (對應 HTML 裡的 name="mGender")
        $gender = isset($_POST["mGender"]) ? $_POST["mGender"] : "";
        if ($gender) {
            echo "性別 (Gender): " . $gender . "<br>";
        } else {
            echo "性別 (Gender): 未填寫<br>";
        }

        // 接收報名項目 (對應 HTML 裡的 name="mCamp")
        $camp = isset($_POST["mCamp"]) ? $_POST["mCamp"] : "";
        if ($camp) {
            echo "報名項目 (Camp Activity): " . $camp . "<br>";
        } else {
            echo "報名項目 (Camp Activity): 未填寫<br>";
        }

        // 接收城市 (對應 HTML 裡的 name="nCity")
        $city = $_POST["nCity"];
        // 為了將英文 value 轉為中文，我加了一個簡單的對應表
        $city_map = ["Taipei" => "台北", "Taichung" => "台中", "Kaohsiung" => "高雄"];
        echo "所在城市 (City): " . ($city_map[$city] ?? "") . "<br>";
    }
    ?>

</body>
</html>

http://localhost/a1133327_黃任玄_作業1.php