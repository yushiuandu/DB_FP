<?php
	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
	echo "no connect!";
	}

	if(isset($_GET['NId'])){
        $sql = "UPDATE `notification` SET `is_read` = 1 WHERE `NId` = '$_GET[NId]'";
        mysqli_query($link,$sql);
    }
	
	$is_oneself = 2; //本人看自己的網頁'0'。非本人看為'1'，沒登入看

	if(isset($_GET['nhot'])){
		$nhot = $_GET['nhot'];
	}else{
		$nhot = 'false';
	}

	if(isset($_GET['nlatest'])){
		$nlatest = $_GET['nlatest'];
	}else{
		$nlatest = 'false';
	}
	
	$uid_current="guest";
	
	// 被看網頁的人
	$uid = "";
	if(isset($_GET['uid'])){
		$uid = $_GET['uid'];
	}

	// 現在在看網頁的人
	include("../index/forum.php");
	if(isset($_SESSION['nickname'])){
		$uid_current = finduid($_SESSION['nickname']);
	}else{
		
	}

	// 如果不是從四個框框個人檔案點擊進去的話
	if(isset($_GET['uid'])){
		//為本人看自己的網頁的話
		if($uid == $uid_current){ 
			$uid = $uid_current;
			$sql = "SELECT * FROM member WHERE UId = \"$uid\"";	
			$is_oneself = 0;	
		}else{ //非本人看自己的網頁
			$sql = "SELECT * FROM member WHERE UId = \"$uid\"";
			if(isset($_SESSION['nickname'])){
				$is_oneself = 1;
			}
			
		}
	}else{
		$uid = $uid_current;
		$sql = "SELECT * FROM member WHERE UId = \"$uid\"";
		$is_oneself = 0;
	}

	$result_user = mysqli_query($link, $sql);
	$row_user = mysqli_fetch_assoc($result_user);

	//計算他有幾篇文章
	if($is_oneself == 1){ //如果是非本人看
	$sql_a = "SELECT COUNT(AId) as total FROM `article` WHERE `UId` =\"$uid\" AND `anonymous` = 1 GROUP BY `UId`";
	}else{
		$sql_a = "SELECT COUNT(AId) as total FROM `article` WHERE `UId` =\"$uid\" GROUP BY `UId`";
	}
	$result = mysqli_query($link,$sql_a);
	$row_a = mysqli_fetch_assoc($result);
	$num_a =  $row_a['total'];
	if(!isset($num_a)){
		$num_a = 0;
	}

	//計算他追蹤多少人
	$sql_f = "SELECT COUNT(follow_id) AS total FROM `follow` WHERE `UID` = '$uid' GROUP BY `UId`";
	$result = mysqli_query($link,$sql_f);
	$row_f = mysqli_fetch_assoc($result);
	$num_f = $row_f['total'];
	if(!isset($num_f)){
		$num_f = 0;
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
	<!-- 此nickname資料框 -->
    <div class="nickname">
        <!-- 此nickname的照片 -->
        <div class='n-pic-con'>
            <img src="data:pic/png;base64,<?=base64_encode($row_user["profile"]);?>" id="n-pic">
        </div>
        <!-- 此nickname的照片 -->
        <!-- nickname名稱 -->
        <p style='margin-bottom:0px; font-size:16pt; font-weight:600;'><?php echo $row_user['Nickname'];?></p>

        <!-- nickname的文章列表 & 追蹤人數 -->
        <p style='margin-bottom:5px; color:white;'><?php echo $num_a;?> 篇文章 - <span class="num"><?php echo $row_user['Fans_num'];?> </span>人追蹤 - 追蹤人數 <?php echo $num_f;?></p>
		
		<!-- 如果是本人使用自己的nickname頁面 -->
		<?php  if($is_oneself == 0){ ?>
        	<a href="../index/index.php?page=user"><button type="button" class="btn btn-info font-weight-bold" >編輯</button></a>
		
		<!-- 如果非本人使用自己的nickname頁面 -->
		<?php  }else if($is_oneself == 1){ 
				$sql = "SELECT * FROM `follow` WHERE `follow_id` = \"$uid\" AND `UId` = \"$uid_current\"";
				$result = mysqli_query($link, $sql);
				$num = mysqli_num_rows($result);
				if($num == 0){ //未追蹤
		?>
			<button type="button" class="btn btn-info font-weight-bold follow_nickname" >追蹤</button>
		<?php }else {?>
			<button type="button" class="btn btn-info font-weight-bold follow_nickname" >✔已追蹤</button>
		<?php			}
			} else{?>
			請先登入以便使用追蹤功能
		<?php	}?>
    </div>
    <!-- 此nickname資料框 end-->

	<!-- 區塊title -->
    <div class="row" style="width:90%; margin:30px auto 5px auto;">
        <div class="col-md-6 col-sm-6 col-5">
            <p class="nickname-tit">文章區</P>
        </div>
        <div class="col-md-6 col-sm-6 col-7 right">
			<!-- 熱門文章 -->
            <a href = "../index/index.php?page=nickname&uid=<?php echo $uid;?>&nhot=true">
				<button type="button" class="btn btn-sm btn-info <?php if($nhot == 'true'){echo 'active';}?>">HOT</button>
			</a>    <!--啟用狀態(active)-->
			<!-- 最新文章 -->
			<a href = "../index/index.php?page=nickname&uid=<?php echo $uid;?>&nlatest=true">
				<button type="button" class="btn btn-sm btn-info <?php if($nlatest == 'true'){echo 'active';}?>">NEW</button>
			</a>
        </div>
    </div>
	<!-- 區塊title end -->

	<?php
		if($is_oneself == 1){
			if ($nhot == 'true'){
				$sql = "SELECT * FROM `article` WHERE `UID` = \"$uid\" AND `anonymous` = 1 ORDER BY `agree` DESC";
			}else{
				$sql = "SELECT * FROM `article` WHERE `UID` = \"$uid\" AND `anonymous` = 1 ORDER BY `post_time` DESC";
			}
		}else if($is_oneself == 0){
			if ($nhot == 'true'){
				$sql = "SELECT * FROM `article` WHERE `UID` = \"$uid\" ORDER BY `agree` DESC";
			}else{
				$sql = "SELECT * FROM `article` WHERE `UID` = \"$uid\" ORDER BY `post_time` DESC";
			}
		}
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($result);
	?>

    <!-- 文章區 -->
    <div class="nickname" style='margin-top:0px;'>
			<?php 
				if(isset($row['AId'])){
					
					$result = mysqli_query($link,$sql);
					while($row = mysqli_fetch_assoc($result)){
						$category = findForum($row['category']);

			?>
		
			<!-- 簡圖內容(上) -->
			<a href="../index/index.php?page=article&aid=<?php echo $row['AId']; ?>" style="color:black; text-decoration:none;">
			<div class="art3">
				<div class="row art-head mid">
					<!-- 作者-->
					<div class="col-md-10 col-sm-9 col-7 mid" style='padding:0px;'>
						<div class='pic-container'>
							<img src="./image/user.png" id="writer-pic">
						</div>
						<?php if($row['anonymous']!=0){?>
						<p style="display: inline; font-size:2vmin; margin:0px;"><?php echo $row['post_name'];?></p>
						<?php }else{ ?>
						<p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
						<?php }?>
					</div>
					<!-- 作者 end-->
					
					<!-- 按讚數 --> 
					<div class="col-md-2 col-sm-3 col-5 right">
						<h7 style="display: inline;"><?php echo $row['agree'];?></h7>
						<img src="./image/good-white.png" class="img-fluid" id="good-pic">
					</div>
					<!-- 按讚數 end-->
				</div>
				<!-- 簡圖內容(上) end-->
					
				<!-- 簡圖內容(中) -->
				<div class="row art-body mid">
					<!-- 標題 -->
					<div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
						<p class="font-weight-bold" style='font-size:3vmin; margin:0px;'><?php echo $row['title'];?></p>
						<p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;"><?php echo $row['excerpt'];?>
						</p>
					</div>
					<!-- 標題 end -->
				</div>
				<!-- 簡圖內容(中) end-->
					
				<!-- 簡圖內容(下) -->
				<div class="row art-fotter mid">
					<!-- 看板 - 發文時間 -->
					<div class="col-md-12 col-sm-12 col-12">
						<p style=' font-size:1.75vmin; margin:0px; color:gray;'>
							<?=$category;?> - <?=date('Y-m-d H:i',strtotime($row['post_time']));?>
						</p>
					</div>
					<!-- 看板 - 發文時間 end -->
				</div>
				<!-- 簡圖內容(下) end-->
				</div>
			</a>
			<?php 
						}//end while
					}//end if
				else{ ?>
				<div class="row art-body mid">
					<p style = 'font-family:jf-openhuninn;'>目前尚無文章QQ</p>
				</div>
			<?php
				}
				?>
        
		<!-- 文章簡圖區 end-->
    </div>

	<script>
		$(".follow_nickname").click(function(){
            var nickname = $(".follow_nickname").index($(this));

            console.log(nickname);
            $.ajax({
                type: 'POST',
				url: "../Article/follow.php?followuid=<?=$uid;?>",
				data: {type : "ajax"},
				dataType :"json"
            }).done(function(data) {
				console.log(data);
				if(data['success'] == "OK"){
						var num = data['fans_num'];
						$(".follow_nickname").eq(nickname).html("✔已追蹤");
						$(".num").html(num);
						console.log(nickname);
					}else if(data['success'] == "DEL_OK"){
						var num = data['fans_num'];
						$(".follow_nickname").eq(nickname).html("追蹤");
						$(".num").html(num);
						// console.log("white");
					}
			});
        });
	
	</script>
	
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>