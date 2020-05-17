<?php
	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
	echo "no connect!";
	}
	
	$is_oneself = 0; //本人看自己的網頁'0'。非本人看為'1'

	$nhot = 'true';
	if(isset($_GET['nhot'])){
		$nhot = $_GET['nhot'];
	}

	$nlatest = 'false';
	if(isset($_GET['nlatest'])){
		$nlatest = $_GET['nlatest'];
	}

	if($nlatest == 'true'){
		$nhot == 'false';
	}else{
		$nhot == 'true';
	}
	
	
	// 被看網頁的人
	$uid = "";
	if(isset($_GET['uid'])){
		$uid = $_GET['uid'];
	}

	// 現在在看網頁的人
	include("../index/forum.php");
	if(isset($_SESSION['nickname'])){
		$uid_current = finduid($_SESSION['nickname']);
	}

	// 如果不是從個人檔案點擊進去的話
	if(isset($_GET['uid'])){
		//為本人看自己的網頁的話
		if($uid == $uid_current){ 
			$uid = $uid_current;
			$sql = "SELECT * FROM member WHERE UId = \"$uid\"";		
		}else{ //非本人看自己的網頁
			$sql = "SELECT * FROM member WHERE UId = \"$uid\"";
			$is_oneself = 1;
		}
	}else{
		$uid = $uid_current;
		$sql = "SELECT * FROM member WHERE UId = \"$uid\"";
	}

	$result_user = mysqli_query($link, $sql);
	$row_user = mysqli_fetch_assoc($result_user);
	


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
        <div>
            <img src="../index/image/test-user.jpg" class="img-fluid rounded-circle" id="n-pic">
        </div>
        <!-- 此nickname的照片 -->
        <!-- nickname名稱 -->
        <p style='margin-bottom:0px; font-size:16pt; font-weight:600;'><?php echo $row_user['Nickname'];?></p>
        <!-- nickname的文章列表 & 追蹤人數 -->
        <p style='margin-bottom:5px; color:white;'>53 篇文章 - 35785人追蹤 - 追蹤人數200</p>
		<!-- 如果是本人使用自己的nickname頁面 -->
		<?php  if($is_oneself == 0){ ?>
        <button type="button" class="btn btn-info font-weight-bold" >編輯</button>
		<!-- 如果非本人使用自己的nickname頁面 -->
		<?php  }else if($is_oneself == 1){ ?>
		<button type="button" class="btn btn-info font-weight-bold" >追蹤</button>
		<?php } ?>
    </div>
    <!-- 此nickname資料框 end-->

	<!-- 區塊title -->
    <div class="row" style='width:90%; margin:30px auto 0px auto;'>
        <div class="col-md-9">
            <p style="font-size:20pt; font-weight:800; margin:0px;">文章區</P>
        </div>
        <div class="col-md-3 right">
			<!-- 熱門文章 -->
            <a href = "../index/index.php?page=nickname&uid=<?php echo $uid;?>&nhot=true">
				<button type="button" class="btn btn-sm btn-info <?php if($nhot == true){echo 'active';}?>">HOT</button>
			</a>    <!--啟用狀態(active)-->
			<!-- 最新文章 -->
			<a href = "../index/index.php?page=nickname&uid=<?php echo $uid;?>&nlatest=true">
				<button type="button" class="btn btn-sm btn-info" <?php if($nlatest == true){echo 'active';}?>>NEW</button>
			</a>
        </div>
    </div>
	<!-- 區塊title end -->

	<?php 
		$sql = "SELECT * FROM article WHERE `UID` = \"$uid\" AND `anonymous` = 1";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($result);
	?>

    <!-- 文章區 -->
    <div class="nickname" style='margin-top:0px;'>
        <div class="art">

			<?php 
				if(isset($row['AId'])){
					// 照熱門、最新功能待測
					if ($nhot == 'true'){
						$sql = "SELECT * FROM article WHERE `UID` = \"$uid\" AND `anonymous` = 1 ORDER BY `agree` DESC";
					}else{
						$sql = "SELECT * FROM article WHERE `UID` = \"$uid\" AND `anonymous` = 1 ORDER BY `post_time` DESC";
					}
					$result = mysqli_query($link,$sql);
					while($row = mysqli_fetch_assoc($result)){
			?>
			<!-- 簡圖內容(上) -->
			<a href="../index/index.php?page=article&aid=<?php echo $row['AId']; ?>" style="color:black; text-decoration:none;">
			<div class="row art-head mid">
				<!-- 作者-->
				<div class="col-md-10 col-sm-9 col-9">
					<img src="./image/user.png" class="img-fluid rounded-circle" id="writer-pic">
					<p style="display: inline; font-size:2vmin; margin:0px;"><?php echo $row['post_name'];?></p>
				</div>
                <!-- 作者 end-->
                
				<!-- 按讚數 --> 
				<div class="col-md-2 col-sm-3 col-3">
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
						感情版 - 5月12日 13:45
					</p>
				</div>
				<!-- 看板 - 發文時間 end -->
			</div>
			<!-- 簡圖內容(下) end-->
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
        </div>
		<!-- 文章簡圖區 end-->
    </div>

	
	
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>