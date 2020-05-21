<?php session_start();
    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
	if(!$link){
		echo "no connect!";
    }
    #找出uid
    include("../index/forum.php");
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
    }
?><?php 
    $cid = ''; $aid = '';


    // 留言按讚
    if(isset($_GET['cid'])){
        $cid = $_GET['cid'];
        $sql = "SELECT * FROM `good` WHERE `UId` = \"$uid\" AND `CId` = \"$cid\"";
        $result = mysqli_query($link,$sql);
        $num = mysqli_num_rows($result);

        // 取得按讚數
        $sql_num = "SELECT `likeCount` FROM `comment` WHERE `CId` ='$cid'";
        $result_num = mysqli_query($link,$sql_num);
        $row = mysqli_fetch_assoc($result_num);
        $agree = $row['likeCount'];

        // 沒有按讚
        if($num == 0){
            $sql = "INSERT INTO `good` (`UId`,`CId`) VALUES ('$uid','$cid')";
        }else{
            $sql = "DELETE FROM `good` WHERE `UId` = \"$uid\" AND `CId` = \"$cid\"";
        }

        if(mysqli_query($link,$sql)){
            if($_POST['type'] == 'ajax'){
                if($num == 0){
                    $agree = $agree + 1;
                    $sql = "UPDATE `comment` SET `likeCount` = '$agree' WHERE `CId` = '$cid'";
                    mysqli_query($link,$sql);
                    exit(json_encode(array("success"=>"OK")));
                }
                else{
                    $agree = $agree - 1;
                    $sql = "UPDATE `comment` SET `likeCount` = '$agree' WHERE `CId` = '$cid'";
                    mysqli_query($link,$sql);
                    exit(json_encode(array("success"=>"DEL_OK")));
                }
                
            }else{ echo 'failQQ';}
        }else{ echo "fail";
        }

    }
    
    
    //貼文按讚
    if(isset($_GET['aid'])){
        $aid = $_GET['aid'];
        $sql = "SELECT * FROM `good` WHERE `UId` = \"$uid\" AND `Aid` = \"$aid\"";
        $result = mysqli_query($link,$sql);
        $num = mysqli_num_rows($result);

        // 取得按讚數
        $sql_num = "SELECT `agree` FROM `article` WHERE `AId` ='$aid'";
        $result_num = mysqli_query($link,$sql_num);
        $row = mysqli_fetch_assoc($result_num);
        $agree = $row['agree'];

        // 沒有按讚
        if($num == 0){
            $sql = "INSERT INTO `good` (`UId`,`aid`) VALUES ('$uid','$aid')";
        }else{
            $sql = "DELETE FROM `good` WHERE `UId` = \"$uid\" AND `Aid` = \"$aid\"";
        }

        if(mysqli_query($link,$sql)){
            if($_POST['type'] == 'ajax'){
                if($num == 0){
                    $agree = $agree + 1;
                    $sql = "UPDATE `article` SET `agree` = '$agree' WHERE `AId` = '$aid'";
                    mysqli_query($link,$sql);
                    exit(json_encode(array("success"=>"OK")));
                }
                else{
                    $agree = $agree - 1;
                    $sql = "UPDATE `article` SET `agree` = '$agree' WHERE `AId` = '$aid'";
                    mysqli_query($link,$sql);
                    exit(json_encode(array("success"=>"DEL_OK")));
                }
                
            }else{ echo 'failQQ';}
        }else{ echo "fail";
        }
    }
    

?>