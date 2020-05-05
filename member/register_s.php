<?php session_start();?>

<?php 

    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
        if(!$link){
        echo "no connect!";
    }
    $user = $_POST['Name'];
    $pass = $_POST['pass'];
    $gender = $_POST['gender'];
    $nickname = $_POST['nickname'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $Account = $_POST['Account'];

    
    // $sql = "SELECT * FROM `member`";
    // $result = mysqli_query($link,$sql);

    $sql_add = "INSERT INTO `member`(`Name`, `Account`, `Gender`, `Password`, `Email`, `Birth_date`, `Nickname`) 
    VALUES ('$user','$Account','$gender','$pass','$email','$birthdate','$nickname')";
    
    if (!mysqli_query($link,$sql_add))
        {die('Error: ' . mysqli_error());}
    else{
        $_SESSION['user'] = $user;
        $_SESSION['nickname'] = $nickname;
        header("Location:../index/index.php"); }
?>