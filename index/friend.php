<?php
	#connect to sql
	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
	if(!$link){
		echo "no connect!";
    }
    
    if(isset($_GET['NId'])){
        $sql = "UPDATE `notification` SET `is_read` = 1 WHERE `NId` = '$_GET[NId]'";
        mysqli_query($link,$sql);
    }

	#找到UId
	include("../index/forum.php");
	$uid = "";
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
    }
   
    if(isset($_GET['search'])){
        $key = $_POST['name'];
        $sql = "SELECT M.Nickname as nickname, F.otherId as FId ,M.profile as profile
                FROM `friend` AS F JOIN `member` AS M 
                WHERE F.otherId = M.UId AND F.UId = \"$uid\" AND M.Nickname LIKE '%$key%'";
    }else{
        $sql = "SELECT M.Nickname as nickname, F.otherId as FId ,M.profile as profile
                FROM `friend` AS F JOIN `member` AS M 
                WHERE F.otherId = M.UId AND F.UId = \"$uid\"";
    }

    $result = mysqli_query($link, $sql);
    
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
    <!-- 搜尋好友 -->
    <form method="post" action="../index/index.php?page=friend&search=true">
        <div class="row">
                <div class="col-10" >
                    <input id="search" name="name" type="text" placeholder='這裡可以搜尋你的朋友......還是......你沒朋友......'>
                </div>

                <div row = "col-2">
                    <button type="submit" class="btn btn-secondary btn-sm my-1">提交</button>
                </div>
        </div>
    </form>
    <!-- 搜尋好友 end -->
    <div class="row justify-content-start align-items-start">
    <?php
        if($result){
            $num = mysqli_num_rows($result);
        }else{
            $num = 0;
        }
        
        if($num > 0 ){
            while($row = mysqli_fetch_assoc($result)){
    ?>
            
        <div class="col-md-3 friend">
            <a href="../index/index.php?page=chat&other=<?php echo $row['FId'];?>" style='color:black; text-decoration:none;'>
                <img src="data:pic/png;base64,<?=base64_encode($row['profile']);?>" style='width:90%; background-size:contain; border-radius:999em;'>
                <p style="margin:20px; font-family:jf-openhuninn; "><?php echo $row['nickname'];?></p>
            </a>
        </div>
    <?php
            }//end while
        }//end if
    ?>
    </div>

	
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>