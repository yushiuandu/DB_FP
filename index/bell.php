
<?php
    //$key = $_GET["key"];
    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
	if(!$link){
		echo "no connect!";
    }

    include("../index/forum.php");
	$uid = "";
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
    }

    
?>
<!doctype html>
<html lang="en">
    <head>
    
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="../index/my.css" rel="stylesheet" type="text/css">
        <title>抬槓</title>
        <script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
        <script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
    </head>
    <body>
    <!-- 通知頁面 -->
    <div class='be'>
        <?php
            $sql = "SELECT * FROM `notification` WHERE `UId` = '$uid' AND `is_read` = 0";
            $result = mysqli_query($link,$sql);
            $num = mysqli_num_rows($result);

            if($num>0){
                while($row = mysqli_fetch_assoc($result)){
                    if($row['type'] == 1){
                        $link_url = "../index/index.php?page=nickname&uid=".$row['UId']."&NId=".$row['NId'];
                        $image = "../index/image/follower.png";
                    }//end type 1 

                    if($row['type'] == 2 OR $row['type'] == 7){
                        $link_url = "../index/index.php?page=article&aid=".$row['AId']."&NId=".$row['NId'];
                        $image = "../index/image/like.png";
                    }//end type 2

                    if($row['type'] == 3 OR $row['type'] == 5){
                        $link_url = "../index/index.php?page=article&aid=".$row['AId']."&NId=".$row['NId'];
                        $image = "../index/image/message.png";
                    }//end type 3

                    if($row['type'] == 4){
                        $link_url = "../index/index.php?page=article&aid=".$row['AId']."&NId=".$row['NId'];
                        $image = "../index/image/design.png";
                    }//end type 4

                    if($row['type'] == 6){
                        $link_url = "../index/index.php?page=article&aid=".$row['AId']."&NId=".$row['NId'];
                        $image = "../index/image/article.png";
                    }//end type 6
                    
                    if($row['type'] == 8){
                        $link_url = "../index/index.php?page=friend&NId=".$row['NId'];
                        $image = "../index/image/new-friend.png";
                    }//end type 8
        ?>
        <!-- 一則通知 -->
        
        <div class="bell pointer notify" onclick="location.href='<?=$link_url;?>';">
        <a href="../index/bell.php?nid=<?=$row["NId"];?>"> </a>            <!-- 有新的追蹤者 -->
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <img src='<?=$image;?>' style='width:50px; height:50px;'>
                </div>
                <div class="col-md-10 mid">
                    <p style='margin:0px;'><?=$row['content'];?></p>
                </div>
            </div>
            <!-- 有新的追蹤者 end -->
        </div>
        <!-- 一則通知 end -->

        <?php        
                }//end while
            }//end if
            else{
        ?>
        <div class="bell pointer">
            <div class="row justify-content-center">
                 <p style='margin:0px;'>目前暫無通知</p>
            </div>
            <!-- 有新的追蹤者 end -->
        </div>
        <?php }
        ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>