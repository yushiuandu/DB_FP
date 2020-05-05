<?php session_start();?>

<?php 

    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
        if(!$link){
        echo "no connect!";
    }

    $Account = $_POST['Account'];
    
    $sql = "SELECT * FROM `member` WHERE `Account` = '$Account'";
    $result = mysqli_query($link,$sql);

    if($result){
        $row = mysqli_fetch_assoc($result);
        if($row['pass'] == $pass){
            $_SESSION['user'] = $row['Name'];
            $_SESSION['nickname'] = $row['Nickname'];
            header("Location:../index/index.php");
        }
    }else{
        echo '帳號或密碼錯誤！';
    }
    
?>