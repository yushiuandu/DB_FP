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
        // 找尋發送對象為對方、接受對象為自己的未讀訊息
        $sql = "SELECT * FROM `chat` WHERE `UId` = '$other' AND `other` = '$uid' AND `is_read` = 0 ";
        $result = mysqli_query($link,$sql);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        // 假設查詢結果為0列資料，則返回chat_No
        if($num == 0){
            exit(json_encode(array("success"=>"chat_NO")));
        }else{ 
            // 假設查詢結果>0，則將訊息變為已讀
            $sql = "UPDATE `chat` SET `is_read` = 1 WHERE `CId` = '$row[CId]'";
            mysqli_query($link,$sql);
            // 以json回傳yes結果，並回傳訊息內容和發送時間
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