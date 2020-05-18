<?php session_start();?>

<?php 

    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
        if(!$link){
        echo "no connect!";
    }
    echo $_POST['Account'];
    $account = $_POST['Account'];
    $pass =$_POST['Password'];
    
    $sql = "SELECT * FROM `member` WHERE `Account` = '$account'";
    $result = mysqli_query($link,$sql);

    if($result){
        $row = mysqli_fetch_assoc($result);
        if($row['Password'] == $pass){
            $_SESSION['user'] = $row['Name'];
            $_SESSION['nickname'] = $row['Nickname'];
            header("Location:$_SESSION[local]");
        }else{
        echo '帳號或密碼錯誤！';
        }
    }
    
?>