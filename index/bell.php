
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

    if(isset($_GET['NId'])){
        $sql = "UPDATE `notification` SET `is_read` = 1 WHERE `NId` = '$_GET[NId]'";
        mysqli_query($link,$sql);
        header("Location:../index/index.php?page=bell");
    }

    if(isset($_GET['delfriend'])){
        session_start();
        $delfriend = $_GET['delfriend'];
        if(isset($_SESSION['nickname'])){
            $uid = finduid($_SESSION['nickname']);
        }
        echo $delfriend;
        echo $uid;

        $sql = "DELETE FROM `friend` WHERE `UId` = '$uid' and `otherid` = '$delfriend'";
        if(!(mysqli_query($link,$sql))){
            mysqli_error();
        }

        $sql = "DELETE FROM `friend` WHERE `UId` = '$delfriend' and `otherid` = '$uid'";
        if(!(mysqli_query($link,$sql))){
            mysqli_error();
        }

        $content = "嗚嗚嗚。。你的對象不選擇跟你繼續聊天。。";
        $sql = "UPDATE `notification` SET `content`='$content', `type` = 10 , `is_read` = 0
                WHERE `UId`= '$delfriend' AND `type` = 9 AND `friendid` = '$uid'";
        if(!(mysqli_query($link,$sql))){
            mysqli_error();
        }       

        if(isset($_GET['NId'])){
            $sql = "UPDATE `notification` SET `is_read` = 1 WHERE `NId` = '$_GET[NId]'";
            mysqli_query($link,$sql);
            header("Location:../index/index.php?page=bell");
            exit;
        }
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
                        $link_url = "../Article/Article.php?page=nickname&uid=".$row['UId']."&NId=".$row['NId'];
                        $image = "../index/image/follower.png";
                    }//end type 1 

                    if($row['type'] == 2 OR $row['type'] == 7){
                        $link_url = "../Article/Article.php?aid=".$row['AId']."&NId=".$row['NId'];
                        $image = "../index/image/like.png";
                    }//end type 2

                    if($row['type'] == 3 OR $row['type'] == 5){
                        $link_url = "../Article/Article.php?aid=".$row['AId']."&NId=".$row['NId'];
                        $image = "../index/image/message.png";
                    }//end type 3

                    if($row['type'] == 4){
                        $link_url = "../Article/Article.php?aid=".$row['AId']."&NId=".$row['NId'];
                        $image = "../index/image/design.png";
                    }//end type 4

                    if($row['type'] == 6){
                        $link_url = "../Article/Article.php?aid=".$row['AId']."&NId=".$row['NId'];
                        $image = "../index/image/article.png";
                    }//end type 6
                    
                    if($row['type'] == 8 ){
                        $link_url = "../index/index.php?page=friend&NId=".$row['NId'];
                        $image = "../index/image/new-friend.png";
                    }//end type 8
                    if($row['type'] == 9){
                        $image = "../index/image/new-friend.png";
                    }
                    if($row['type'] == 10){
                        $link_url = "../index/index.php?NId=".$row['NId'];
                        $image = "../index/image/sad.png";
                    }//end type 10
                    if($row['type'] == 11){
                        $link_url = "../index/chat.php?NId=".$row['NId']."&other=".$row['friendid'];
                        $image = "../index/image/design.png";
                    }
        ?>
        <!-- 一則通知 -->
        
        <div class="bell pointer notify" <?php if($row['type'] != 9){?>onclick="location.href='<?=$link_url;?>';"<?php }?>>
        <!-- <a href="../index/bell.php?nid=<?=$row["NId"];?>"> </a>            有新的追蹤者 -->
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <img src='<?=$image;?>' style='width:50px; height:50px;'>
                </div>
                <div class="col-md-10 mid">
                    <?php if($row['type'] == 9){
                        $friendid = $row['friendid'];
                        $NId = $row['NId'];
                        echo '<p style="margin:0px;" data-toggle="modal" data-target="#match">'.$row['content'].'</p>';
                    }else{
                        echo '<p style="margin:0px;">'.$row['content'].'</p>';
                    } ?>
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
        <!--配對畫面-->
        <?php
        if(isset($friendid)){
            $sql = "SELECT * FROM `follow` WHERE `UId` = '$friendid' and `follow_id` != 'NULL'";
            $result = mysqli_query($link,$sql);
            $follow = mysqli_num_rows($result);

            $sql = "SELECT COUNT(article.AId) as anum ,member.Nickname as nickname
                            ,member.profile as profile , member.Name as name, member.Fans_num as fans_num
                    FROM `member` JOIN `article`
                    WHERE member.UId = '$friendid' and  article.UId = '$friendid'";
            $result = mysqli_query($link,$sql);
            $row = mysqli_fetch_assoc($result);
        }
            
        ?>
                <!-- data-backdrop點背景不會關閉視窗/data-keyboard可用esc關閉 -->
				<div class="modal fade bd-example-modal-sm match-ww" id="match" aria-hidden="true" data-backdrop="static" data-keyboard="true">
					<div class="modal-dialog modal-dialog-centered"> <!--centered重直置中-->
						<div class="modal-content match-page"> 
                            <!-- 配對頁面內容 -->
                            <p class="match-title">夢中情人</p>
							<div class="modal-body match-con">
                                <div class="row justify-content-center">
                                    <!-- 配對到的人照片 -->
                                    <div class="col-md-7 mid">
                                        <img class='match-pic' src='data:pic/png;base64,<?=base64_encode($row["profile"]);?>'>
                                    </div>
                                    <!-- 配對到的人簡介 -->
                                    <div class="col-md-5 match-intro left">
                                        <p class='match-ww'>姓名：　　<?=$row['name'];?></p>
                                        <p class='match-ww'>暱稱：　　<?=$row['nickname'];?></p>
                                        <p class='match-ww'>文章：　　<?=$row['anum'];?>篇</p>
                                        <p class='match-ww'>追蹤者：　<?=$follow;?>個</p>
                                        <p class='match-ww'>追隨者：　<?=$row['fans_num'];?>個</p>
                                    </div>
                                </div>
							</div>
							<!--下面選項-->
							<div class='match-fotter'>
                                <!-- 開始聊天 -->
								<button class="btn btn-secondary">
                                    <a href='../index/chat.php?NId=<?=$NId;?>&other=<?=$friendid;?>' class='link-ww'>開始聊天</a>
                                </button>
                                <!-- 拒絕聊天 -->
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#match2">下次再說...</button>
                                <div class="modal fade bd-example-modal-sm match-ww" id="match2" aria-hidden="true" data-backdrop="static" data-keyboard="true">
                                    <div class="modal-dialog modal-dialog-centered"> <!--centered重直置中-->
                                        <div class="modal-content match-page mid"> 
                                            <!-- 配對頁面內容 -->
                                            <p class="match-title">Oh...No...</p>
                                            <div class="modal-body match-con">
                                                <div class="sorry-con">
                                                    <img src='../index/image/cry.png' class='sorry-pic'></img>
                                                </div>
                                                <p class='match-ww'>你錯過進一步認識他/她的機會</p>
                                            </div>
                                            <!--下面選項-->
                                            <div class='match-fotter'>
                                                <!-- bye -->
                                                <a href="../index/index.php?NId=<?=$NId;?>">
                                                <button type="button" id="byebye" class="btn btn-secondary" >關閉</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
				<!--配對頁面end-->
    </div>
    <script>
    
        $("#byebye").click(function(){
			var url = "../index/bell.php?delfriend=<?=$friendid;?>&NId=<?=$NId;?>";
			
			console.log(url);

			$.ajax({
				type: 'POST',
				url: url,
				data: {type : "ajax"},
				dataType :"json",
			});
		});
    
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>