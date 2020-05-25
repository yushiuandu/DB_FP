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
    $sql = "SELECT * FROM `article` WHERE `AId` ='$_SESSION[aid]'";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
 
    $cid = ''; $aid = '';


    // 留言按讚
    if(isset($_GET['cid'])){
        $aid = $_SESSION['aid'];
        $cid = $_GET['cid'];

        $sql = "SELECT * FROM `good` WHERE `UId` = \"$uid\" AND `CId` = \"$cid\"";
        $result = mysqli_query($link,$sql);
        $num = mysqli_num_rows($result);

        // 取得按讚數
        $sql_num = "SELECT * FROM `comment` WHERE `CId` ='$cid'";
        $result_num = mysqli_query($link,$sql_num);
        $row = mysqli_fetch_assoc($result_num);
        $agree = $row['likeCount'];
        $author = $row["UId"];

        // 沒有按讚
        if($num == 0){
            $sql = "INSERT INTO `good` (`UId`,`CId`) VALUES ('$uid','$cid')";
        }else{
            $sql = "DELETE FROM `good` WHERE `UId` = \"$uid\" AND `CId` = \"$cid\"";
        }

        if(mysqli_query($link,$sql)){
                if($num == 0){

                    $sql = "SELECT * FROM `notification` WHERE `CId` = '$cid' AND `is_read` = 0 AND `type` = 7";
					$result = mysqli_query($link,$sql);
                    $num_r = mysqli_num_rows($result);
                    
					if($num_r == 0){
                    
                    $content = "你在「<b>".$title."</b>」的留言有人來按讚囉";
                    $sql = "INSERT INTO `notification` (`UId`,`AId`,`CId`,`content`,`type`) values('$author','$_SESSION[aid]','$cid','$content',7)";
                    mysqli_query($link,$sql);}

                    $agree = $agree + 1;
                    $sql = "UPDATE `comment` SET `likeCount` = '$agree' WHERE `CId` = '$cid'";
                    mysqli_query($link,$sql);

                    }else{

                    $agree = $agree - 1;
                    $sql = "UPDATE `comment` SET `likeCount` = '$agree' WHERE `CId` = '$cid'";
                    mysqli_query($link,$sql);
                    
                }
                if($_POST['type'] == 'ajax'){
                    if($num != 0){
                        exit(json_encode(array("success"=>"DEL_OK","likecount"=>$agree)));
                    }else{
                        exit(json_encode(array("success"=>"OK","likecount"=>$agree)));
                    }
                }
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
        $sql_num = "SELECT * FROM `article` WHERE `AId` ='$aid'";
        $result_num = mysqli_query($link,$sql_num);
        $row = mysqli_fetch_assoc($result_num);
        $agree = $row['agree'];
        $author = $row['UId'];

        // 沒有按讚
        if($num == 0){
            $sql = "INSERT INTO `good` (`UId`,`aid`) VALUES ('$uid','$aid')";
        }else{
            $sql = "DELETE FROM `good` WHERE `UId` = \"$uid\" AND `Aid` = \"$aid\"";
        }

        if(mysqli_query($link,$sql)){
            if($num == 0){
                $sql = "SELECT * FROM `notification` WHERE `AId` = '$_SESSION[aid]' AND `is_read` = 0 AND `type` = 2";
                    $result = mysqli_query($link,$sql);
                    if($result){
                         $num_r = mysqli_num_rows($result);
                    }else{
                        $num_r = 0;
                    }
                   
                    
					if($num_r == 0){
                        $content = "你的文章「<b>".$row['title']."</b>」有人來按讚囉";
                        $sql_a = "INSERT INTO `notification` (`UId`,`AId`,`content`,`type`) VALUES ('$author','$_SESSION[aid]','$content',2)";
                        if((mysqli_query($link,$sql_a))){
                            
                        }else{mysqli_error();
                        }
                    }
            }
            if($_POST['type'] == 'ajax'){
                if($num == 0){
                    $agree = $agree + 1;
                    $sql = "UPDATE `article` SET `agree` = '$agree' WHERE `AId` = '$aid'";
                    mysqli_query($link,$sql);
                    exit(json_encode(array("success"=>"OK","likecount"=>$agree)));
                }
                else{
                    $agree = $agree - 1;
                    $sql = "UPDATE `article` SET `agree` = '$agree' WHERE `AId` = '$aid'";
                    mysqli_query($link,$sql);
                    exit(json_encode(array("success"=>"DEL_OK","likecount"=>$agree)));
                }
                
            }else{ echo 'failQQ';}
        }else{ echo "fail";
        }
    }
    

?>