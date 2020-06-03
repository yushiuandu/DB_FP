<?php

    date_default_timezone_set('Asia/Taipei');
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;

    session_start();

    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
		if(!$link){
		echo "no connect!";
    }
    
    include("../index/forum.php");
	$uid = "";
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
    }
    
    if(isset($_GET['other'])){

        $other = $_GET['other'];
        $sql = "SELECT * FROM `chat` WHERE `UId` = '$other' AND `other` = '$uid' AND `is_read` = 0 ";
        $result = mysqli_query($link,$sql);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if($num == 0){
            exit(json_encode(array("success"=>"chat_NO")));
        }else{
            $sql = "UPDATE `chat` SET `is_read` = 1 WHERE `CId` = '$row[CId]'";
            mysqli_query($link,$sql);
            exit(json_encode(array("success"=>"YES","content"=>$row['chat'],"date"=>$row['sendtime'])));
        }
    }else{
        $sql = "SELECT * FROM `notification` WHERE `UId` = '$uid' AND `is_read` = 0";
        $result = mysqli_query($link,$sql);
        $num = mysqli_num_rows($result);

        if($num == 0){
            exit(json_encode(array("success"=>"NO")));
        }else{
            exit(json_encode(array("success"=>"YES")));
    }
    }

    


?>