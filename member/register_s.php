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
    $f = "0x".bin2hex(fread( fopen( $_FILES["YouFile"]["tmp_name"] , "r") ,  filesize( $_FILES["YouFile"]["tmp_name"]) ));
    
    $sql = "SELECT * FROM `member` WHERE `Nickname` = '$nickname'";
    $result = mysqli_query($link,$sql);
    $num = mysqli_num_rows($result);

    if($num > 0){
        echo '<script language="javascript">';
        echo 'alert("此綽號已有他人使用");';
        echo "window.location.href='../index/index.php?page=register'";
        echo '</script>';
    }else{

        $sql_check = "SELECT * FROM `member` WHERE `Account` = '$Account'";
        $result = mysqli_query($link,$sql_check);
        $num = mysqli_num_rows($result);

        if($num > 0){
            echo '<script language="javascript">';
            echo 'alert("此帳號已有他人使用");';
            echo "window.location.href='../index/index.php?page=register'";
            echo '</script>';
        }else{
            $sql_add = "INSERT INTO `member`(`Name`, `Account`, `Gender`, `Password`, `Email`, `Birth_date`, `Nickname`,`profile`) 
                        VALUES ('$user','$Account','$gender','$pass','$email','$birthdate','$nickname',$f)";
            
            if (!mysqli_query($link,$sql_add))
                {   echo '<script language="javascript">';
                    echo 'alert("檔案大小不得超過1MB！");';
                    echo "window.location.href='../index/index.php'";
                    echo '</script>';
                    die('Error: ' . mysqli_error());}
            else{
                $_SESSION['user'] = $user;
                $_SESSION['nickname'] = $nickname;
                header("Location:../index/index.php"); }
        }
    }

    // $sql = "SELECT * FROM `member`";
    // $result = mysqli_query($link,$sql);

   
?>