<?php
    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
	if(!$link){
		echo "no connect!";
    }
    #找出uid
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
    }
    
    $sql = "SELECT `AId` FROM `follow` WHERE `UId` = \"$uid\" AND `AId` != 'NULL' ORDER BY `follow_time` DESC";
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
  <!-- 追蹤 -->
  <body>
    <!-- 文章追蹤 -->
    <div class="row justify-content-center">
        <div class="col-md-12 long">
            <div class='tit'>
                <p class='ww'>追蹤的文章</p>
            </div>

            
            <!-- 文章顯示 -->
            <div class="con2">
                <?php if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        $sql = "SELECT * FROM `article` WHERE `AId` = \"$row[AId]\"";
                        $result_follow = mysqli_query($link, $sql);
                        $row_follow = mysqli_fetch_assoc($result_follow);
                    
                ?>
                <!-- 文章 -->
                <div class="bo pointer" onclick="location.href='../index/index.php?page=article&aid=<?php echo $row_follow['AId']; ?>';">
                    <!-- 文章(上) -->
                    <div class="row art-head mid">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <div class='pic-container'>
                                <?php 
                                    if($row_follow['anonymous'] == 1){
                                        echo '<a href="../index/index.php?page=nickname&uid='.$row_follow['UId'].'">';	
                                ?>
                                    <img src="../index/image/user.png" id="writer-pic"></a>
                                <?php
                                    }else{ ?>
                                        <img src="../index/image/user.png" id="writer-pic">
                                <?php	}//end else
                                ?>
                                <!-- 作者頭像 -->
                            </div>
                            <!-- <img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic"></a> -->
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">
                                <?php
								if ($row_follow['anonymous'] == 0){
									echo '匿名';
								}else{
									echo $row_follow['post_name'];
								}
							    ?></p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 文章(上) end-->
                    
                    <!-- 文章(下) -->
                    <div class="row art-body mid">
                        <!-- 標題 -->
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'><?php echo $row_follow['title'];?></p>
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
                            <?php echo $row_follow['excerpt'];?>
                            </p>
                        </div>
                        <!-- 標題 end -->
                    </div>
                    <!-- 文章(下) end-->
                </div>
                <!-- 文章 end -->
                <?php }//end while
                    }//end if
                    ?>
            </div>
            
        </div>
    </div>
    <!-- 文章追蹤 end -->
    
    <!-- 追蹤人、TAG -->
    <div class="row justify-content-center">
        <!-- 追蹤的人 -->
        <div class="col-md-6">
            <!-- title -->
            <div class='tit'>
                <p class='ww'>追蹤的人</p>
            </div>
            <!-- title end -->
            <!-- body -->
            <div class='con'>
                <!-- user -->
                <?php 
                    $sql = "SELECT M.UId, M.Nickname 
                            FROM `follow` AS F JOIN `member` AS M
                            WHERE F.follow_id = M.UId AND F.UId = \"$uid\"";
                    $result = mysqli_query($link, $sql);
                    $row = mysqli_fetch_assoc($result);
                    while($row){
                ?>
                <a href='#' style='color:black;'>
                    <div class='cc'>
                        <div class="card" style="width: 9rem;">
                            <img class="card-img-top" src="../index/image/test1.jpg" alt="user">
                            <div class="card-body">
                                <p class='ss'><?php echo $row['Nickname'];?></p>
                            </div>
                        </div>
                    </div>
                </a>
                <!-- user end -->
                    <?php $row = mysqli_fetch_assoc($result);
                        }?>
            </div>
            <!-- body -->
            
        </div>
        <!-- 追蹤的人 end -->
        <!-- 追蹤的tag -->
        <div class="col-md-6">
            <div class='tit'>
                <p class='ww'>追蹤的tag</p>
            </div>
            <!-- body -->
            <div class='con'>
                <!-- tag -->
                <?php
                    $sql_tag = "SELECT * FROM `follow` WHERE `UId` = \"$uid\" AND `Tag`!= 'NULL' 
                    ORDER BY `follow_time` DESC";
                    $result_tag = mysqli_query($link, $sql_tag);
                    $row = mysqli_fetch_assoc($result_tag);
                    while($row){
                ?>
                <a href='../index/index.php?page=tag&tag=<?php echo $row['Tag'];?>' style='color:black;'>
                    <div class='tag'>
                        <p class='ss'>#<?php echo $row['Tag'];?></p>
                    </div>
                </a>
                <!-- tag end -->
                <?php $row = mysqli_fetch_assoc($result);
                        }?>
            </div>
            <!-- body -->
        </div>
        <!-- 追蹤的tag end -->
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>