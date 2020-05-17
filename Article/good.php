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
?>
<?php 
    $cid = ''; $aid = ''; $is_index ="";

    if(isset($_GET['is_index'])){
        $is_index = $_GET['is_index'];
    }

    // 留言按讚
    if(isset($_GET['cid'])){
        $cid = $_GET['cid'];

        #找出留言是否有按讚紀錄
        $sql = "SELECT `ISNOT` FROM `good` WHERE `UId` = \"$uid\" AND `CId` = \"$cid\"";
        $result = mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($result);

        if(isset($row['ISNOT'])){ #如果有
            
            #假設有按讚
            if($row['ISNOT'] == 1){
                $sql_u = "UPDATE good SET `ISNOT` = 0 WHERE `UId` = \"$uid\" AND `CId` = \"$cid\"";
                mysqli_query($link,$sql_u);

                // 更新留言讚數
                $sql_q = "SELECT `likeCount` FROM `comment` WHERE `CId` = \"$cid\"";
                $result_q = mysqli_query($link,$sql_q);
                $row_q = mysqli_fetch_assoc($result_q);
                $likecount = $row_q['likeCount'] - 1;

                $sql_q = "UPDATE comment SET `likeCount` = \"$likecount\" WHERE `CId` = \"$cid\"";
                mysqli_query($link,$sql_q);

                header("Location:../index/index.php?page=article&aid=$_SESSION[aid]");
                exit;
            }else{
                $sql_u = "UPDATE good SET `ISNOT` = 1 WHERE `UId` = \"$uid\" AND `CId` = \"$cid\"";
                mysqli_query($link,$sql_u);

                #更新留言讚數
                $sql_q = "SELECT `likeCount` FROM `comment` WHERE `CId` = \"$cid\"";
                $result_q = mysqli_query($link,$sql_q);
                $row_q = mysqli_fetch_assoc($result_q);
                $likecount = $row_q['likeCount'] + 1;

                $sql_q = "UPDATE comment SET `likeCount` = \"$likecount\" WHERE `CId` = \"$cid\"";
                mysqli_query($link,$sql_q);

                header("Location:../index/index.php?page=article&aid=$_SESSION[aid]");
                exit;
            }
        }else{
            #將它有按讚的東東存進資料庫
            $sql_a = "INSERT INTO `good` (`UId`, `AId`, `CId`, `ISNOT`) VALUES ('$uid','$_SESSION[aid]','$cid',1)";
            $result_a = mysqli_query($link,$sql_a);
            if($result_a){

                #更新留言讚數
                $sql_q = "SELECT `likeCount` FROM `comment` WHERE `CId` = \"$cid\"";
                $result_q = mysqli_query($link,$sql_q);
                $row_q = mysqli_fetch_assoc($result_q);
                $likecount = $row_q['likeCount'] + 1;
                $sql_q = "UPDATE comment SET `likeCount` = \"$likecount\" WHERE `CId` = \"$cid\"";
                mysqli_query($link,$sql_q);

                
                header("Location:../index/index.php?page=article&aid=$_SESSION[aid]");
                exit;
            }else{
                echo '失敗';
            }
        }

    }
    
    
    //貼文按讚
    if(isset($_GET['aid'])){
        $aid = $_GET['aid'];

        #找出貼文是否有按讚紀錄
        $sql = "SELECT `ISNOT` FROM `good` WHERE `UId` = \"$uid\" AND `AId` = \"$aid\"";
        $result = mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($result);

        if(isset($row['ISNOT'])){ #如果有
            
            #假設有按讚
            if($row['ISNOT'] == 1){
                $sql_u = "UPDATE good SET `ISNOT` = 0 WHERE `UId` = \"$uid\" AND `AId` = \"$aid\"";
                mysqli_query($link,$sql_u);

                // 更新留言讚數
                $sql_q = "SELECT `agree` FROM `article` WHERE `AId` = \"$aid\"";
                $result_q = mysqli_query($link,$sql_q);
                $row_q = mysqli_fetch_assoc($result_q);
                $agree = $row_q['agree'] - 1;

                $sql_q = "UPDATE article SET `agree` = \"$agree\" WHERE `AId` = \"$aid\"";
                mysqli_query($link,$sql_q);

                if($is_index == 'true'){
                    header("Location:../index/index.php");
                    exit;
                }else{
                    header("Location:../index/index.php?page=article&aid=$_SESSION[aid]");
                    exit;
                }
                
            }else{
                $sql_u = "UPDATE good SET `ISNOT` = 1 WHERE `UId` = \"$uid\" AND `AId` = \"$aid\"";
                mysqli_query($link,$sql_u);

                #更新留言讚數
                $sql_q = "SELECT `agree` FROM `article` WHERE `AId` = \"$aid\"";
                $result_q = mysqli_query($link,$sql_q);
                $row_q = mysqli_fetch_assoc($result_q);
                $agree = $row_q['agree'] + 1;

                $sql_q = "UPDATE article SET `agree` = \"$agree\" WHERE `AId` = \"$aid\"";
                mysqli_query($link,$sql_q);

                if($is_index == 'true'){
                    header("Location:../index/index.php");
                    exit;
                }else{
                    header("Location:../index/index.php?page=article&aid=$_SESSION[aid]");
                    exit;
                }
            }
        }else{
            #將它有按讚的東東存進資料庫
            $sql_a = "INSERT INTO `good` (`UId`, `AId`, `CId`, `ISNOT`) VALUES ('$uid','$_SESSION[aid]',0,1)";
            $result_a = mysqli_query($link,$sql_a);
            if($result_a){

                #更新留言讚數
                $sql_q = "SELECT `agree` FROM `article` WHERE `AId` = \"$aid\"";
                $result_q = mysqli_query($link,$sql_q);
                $row_q = mysqli_fetch_assoc($result_q);
                $agree = $row_q['agree'] + 1;
                $sql_q = "UPDATE article SET `agree` = \"$agree\" WHERE `AId` = \"$aid\"";
                mysqli_query($link,$sql_q);

                
                if($is_index == 'true'){
                    header("Location:../index/index.php");
                    exit;
                }else{
                    header("Location:../index/index.php?page=article&aid=$_SESSION[aid]");
                    exit;
                }
            }else{
                echo '失敗';
            }
        }
    }
    

?>