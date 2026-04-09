
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>夏令營報名表</title>
</head>
<body>

    <center>
        <h2><b>2026 資管夏令營 報名表</b></h2>
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
        
        <br><br>
        <input type="submit" value="送出報名">
        <input type="reset" value="重新填寫">

        <br><br>
        <a href="high_big_school.png">點這裡進去看看</a>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&t=2s"><h2>這是彩蛋</h2></a>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<hr>";
        echo "<h3>報名成功！以下是您的資料：</h3>";

        $name = $_POST["nName"];
        echo "姓名 (Name): " . htmlspecialchars($name) . "<br>";

        $gender = isset($_POST["mGender"]) ? $_POST["mGender"] : "";
        echo "性別 (Gender): " . ($gender ?: "未填寫") . "<br>";

        $camp = isset($_POST["mCamp"]) ? $_POST["mCamp"] : "";
        echo "報名項目 (Camp Activity): " . ($camp ?: "未填寫") . "<br>";

        $city = $_POST["nCity"];
        $city_map = ["Taipei" => "台北", "Taichung" => "台中", "Kaohsiung" => "高雄"];
        echo "所在城市 (City): " . ($city_map[$city] ?? "") . "<br>";
    }
    ?>
</body>
</html>