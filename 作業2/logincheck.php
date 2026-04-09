<?php

$fID='derrick';
$fPWD='12345';

$uID=$_POST['uName'];
$uPwd=$_POST['uPwd'];

if($uID==$fID && $uPwd==$fPWD){
    header("Refresh:0;url=success.php");
}else{
    echo "登入失敗！帳號或密碼錯誤";
    $target_url = urlencode("a1133327_黃任玄_作業2.php");
    header("Refresh:2;url=" . $target_url);
}

?>