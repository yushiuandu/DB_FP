<?php

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

    $sql = "SELECT * FROM `notification` WHERE `UId` = '$uid' AND `is_read` = 0";
    $result = mysqli_query($link,$sql);
    $num = mysqli_num_rows($result);

    if($num == 0){
        exit(json_encode(array("success"=>"NO")));
    }else{
        exit(json_encode(array("success"=>"YES")));
    }


?>