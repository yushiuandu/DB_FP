<?php session_start();?>
<?php 

    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
        if(!$link){
        echo "no connect!";
    }

    // 先找出UID
    $sql = "SELECT `UId` FROM `member` WHERE `Nickname` = \"$_SESSION[nickname]\"";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $UId = $row['UId'];
    

    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
    $content = $_POST["content"];
    $anonymous = $_POST["anonymous"];
    $aid = $_SESSION["aid"];


    $sql = "SELECT max(floor) FROM `comment` WHERE `AId` = \"$aid\"";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($result); 
    $floor = $row["0"] +1;

    $sql = "INSERT INTO `comment`(`AId`, `UId`, `content`, `likeCount`, `time`, `anonymous`, `post_name`, `floor`) 
    VALUES('$aid', '$UId','$content',0 ,'$datetime','$anonymous', '$_SESSION[nickname]','$floor')";
    
    if (!mysqli_query($link,$sql))
    {die('Error: ' . mysqli_error());}
    else{
    header("Location:../index/index.php?page=article&aid=$aid"); 
    }
?>