<?php 	
		session_start();
		$_SESSION['local'] = '../index/index.php';
?>
<?php

	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
	echo "no connect!";
	}
	
	if(isset($_GET['NId'])){
		$sql = "UPDATE `notification` SET `is_read` = 1 WHERE `NId` = '$_GET[NId]'";
		mysqli_query($link,$sql);
		header("Location:../index/index.php");
	}
	$sql = "SELECT * FROM `article` ORDER BY `agree` DESC LIMIT 20";
	// 將一切都先初始化
	$page = 'index';	$latest = 'false';	$hot = 'false';	$aid = 'flase';	$forum = 'all';
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	if(isset($_GET['id'])){
		$forum = $_GET['id'];
		$_SESSION['local'] = "../index/index.php?page=index&id=$forum";
	}
	if(isset($_GET['hot'])){
		$hot = $_GET['hot'];
	}
	if(isset($_GET['latest'])){
		$latest = $_GET['latest'];
	}
	if(isset($_GET['follow'])){
		$follow = $_GET['follow'];
	}else{
		$follow = 'false';
	}
	if($page == 'logout'){
		unset($_SESSION['user']);
		unset($_SESSION['nickname']);
		session_destroy();
		header("Location:../index/index.php");
		exit;
	}

	include("../index/forum.php"); #匯入function
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
	}

	$category = findForum($forum);
	// 時區宣告
	date_default_timezone_set('Asia/Taipei');
	// 每過一天就刪除心理測驗結果
	// $datetime = date ("H:i:s" , mktime(date('H'), date('i'), date('s'))) ;
	// if($datetime >= "23:33:00"){
	// 	$sql_del ="DELETE FROM `user_ans`";
	// 	mysqli_query($link, $sql_del);
	// 	echo "success";
	// }
?>

<!doctype html>
<html lang="en">

  <head>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./my.css" ty="theme">
	<!-- 有心力要來修改這個 -->
	<!-- <script> 
		function setStyleSheet(title){
		// 找到head
		var doc_head = document.head;
		// 找到所有的link標籤
		var link_list = document.getElementsByTagName("link");
		if ( link_list ){
			for ( var i=0;i<link_list.length;i++ ){
				// 找到我們需要替換的link，
				// 一般情況下有些樣式是公共樣式，我們可以寫到功能樣式文件中，不用來做替換；
				// 這樣可以避免每次替換的時候樣式文件都很大；可以節省加載速度；
				if ( link_list[i].getAttribute("ty") === "theme" ){
					// 找到後將這個link標籤重head中移除
					doc_head.removeChild(link_list[i]);
				}
			}
		}
		// 創建一個新link標籤
		var link_style = document.createElement("link");
		// 對link標籤中的屬性賦值
		link_style.setAttribute("rel","stylesheet");
		link_style.setAttribute("type","text/css");
		link_style.setAttribute("href","./my1.css");
		link_style.setAttribute("ty","theme");
		// 加載到head中最後的位置
		doc_head.appendChild(link_style);
		};
	</script> -->
	<script>
		function no(){
			alert("想要這個功能嗎?註冊一下，登入之後就可以囉~");
		}
	</script>
	<title>抬槓</title>
  </head>

  <body>
  	<!-- 導覽列 -->
	  <div class="head-nav">
		
		<div class="row mid">
			<nav class="navbar-expand-md navbar-default navbar-light">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#forum" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</nav>

			<div class="col-md-4 col-sm-6 col-3" style="padding:0px;">
				<a class="navbar-brand" href="../index/index.php">
					<img src="./image/Tai-gun.png" class="Tai-gun">
				</a>
			</div>
			
			<div class="col-md-8 right d-none d-md-block" style="padding:0px;">
				<form class="form-inline" method="POST" action="../index/search.php">
					<input class="form-control mr-sm-2" type="search" placeholder="要找甚麼...." style="width:125px;" name="key">
					<button class="btn btn-light btn-sm" type="submit">搜尋</button>
				</form>
			</div>

			
			<div class="col-sm-4 col-6 right d-md-none">
			<?php if(!(isset($_SESSION['nickname']))){?>
				<!-- 還沒登入 -->
				<button type="button"class="btn btn-info font-weight-bold" data-toggle="modal" data-target="#login-2">
					註冊/登入
				</button>
			<?php }else{?>

				<!-- 登入之後 -->
				<button type="button"class="btn btn-info font-weight-bold">
					<a href="../index/index.php?page=logout" style='text-decoration:none; color:white;'>登出</a>
				</button>
			<?php }?>
						
				<!--登入畫面-->
				
					<div class="modal fade bd-example-modal-sm middle" id="login-2" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content login-page">

								<!--登入頭-->
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">walcome 抬槓!</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<!--登入內容-->
								<form method="post" action="../member/login.php" enctype="multipart/form-data">
								<div class="modal-body">
									<div>
										<img src='./image/hello.png' id='login-pic' class='mar'>
										<h5 class='mar'>帳號 
											<input type="text" placeholder="帳號" name='Account'></h5>
										<h5 class='mar'>密碼 
											<input type="password" placeholder="密碼" name='Password'></h5>
										<!-- <button type="button" class="btn btn-secondary btn-sm mar">
											<a href='#'  style="color:white;">忘記密碼
										</button> -->
										<!-- 如果按還不是會員 會跳轉到 member/login.php的頁面 -->
										<button type="button" class="btn btn-secondary btn-sm mar">
											<a href="?page=register"  style="color:white;">還不是會員?</a>
										</button>
									
									</div>
								</div>
								<!--登入尾-->
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">下次再說</button>
									<button class="btn btn-info font-weight-bold" type="submit">送出</button>
								</div>
							</from>
							</div>
						</div>
					</div>
					<!-- 登入畫面end -->
			</div>
		</div>
		<!-- 導覽列end -->
	</div>
	
  <div class="row">
    <!-- 左半部 -->
    <div class="col-lg-2 col-md-2" id="left">
      	<nav class=" navbar-expand-md navbar-default navbar-light">
			<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button> -->
			
			<div class="collapse navbar-collapse" id="forum">
				<ul class="nav navbar-nav flex-column">
					<li class="nav-item dropdown">
						<a href = "../index/index.php"><img src="./image/logo.png" width="auto" height="80" class="animated fadeInUpBig"></a>
					</li>
					<!-- 所有看板 -->
					<li class="nav-item dropdown" style="font-family:微軟正黑體; font-weight: 600;">
						<div class='link-head' id="all">
						<div id="headingOne">
							<a class="nav-link collapsed" href="../index/index.php" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
							所有看板</a>
						</div>
						<div id="collapseOne" class="collapse link-body" aria-labelledby="headingOne" data-parent="#all">
							<a class="dropdown-item" href="../index/index.php?page=index&id=food">美食版</a>
							<a class="dropdown-item" href="../index/index.php?page=index&id=makeup">美妝穿搭</a>
							<a class="dropdown-item" href="../index/index.php?page=index&id=travel">旅遊版</a>
							<a class="dropdown-item" href="../index/index.php?page=index&id=trending">新聞版</a>
							<a class="dropdown-item" href="../index/index.php?page=index&id=funny">有趣版</a>
							<a class="dropdown-item" href="../index/index.php?page=index&id=relationship">感情版</a>
							<a class="dropdown-item" href="../index/index.php?page=index&id=talk">其他版</a>
						</div>
						</div>
					</li><!-- 所有看板end -->
					<!-- 訂閱看板 -->
					<li class="nav-item dropdown" style="font-family:微軟正黑體; font-weight: 600;">
						<div class='link-head' id="follow">
							<div id="headingTwo">
								<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								訂閱看板</a>
							</div>
						
							<div id="collapseTwo" class="collapse link-body" aria-labelledby="headingTwo" data-parent="#follow">
								<?php 
								if(isset($uid)){	//假設使用者有登入，則從follow裡找到有關此UId的訊息
									$sql_forum = "SELECT `Category` FROM `follow` WHERE `UId` = \"$uid\" AND `Category`!='NULL'";
									$result_forum = mysqli_query($link, $sql_forum);
									$num = mysqli_num_rows($result_forum);
									if($num > 0){	//假設回傳的資料數量不為0
										while($row_forum = mysqli_fetch_assoc($result_forum)){
											if(isset($row_forum['Category'])){
												$follow_forum = findForum($row_forum['Category']);
								?>
								<a class="dropdown-item" href="../index/index.php?page=index&id=<?php echo $row_forum['Category']; ?>"><?php echo $follow_forum; ?></a>
								<?php 
											}//end if
										}//end while
									}//end if
									else{	//假設回傳的資料數量為0
										echo '<ul>';
										echo '<p>還沒追蹤看板QQ</p></ul>';}
								}else{	//假設沒追蹤
									echo '<ul>';
										echo '<p>還沒追蹤看板QQ</p></ul>';
								}
								?>
							</div>
						</div>
					</li>
					<!-- 訂閱看板 end-->
					<!-- 熱門看板 -->
					<!-- <li class="nav-item dropdown" style="font-family:微軟正黑體; font-weight: 600;"> 
						<div class='link-head' id="hot">
						<div id="headingThree">
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							熱門看板</a>
						</div>
						<div id="collapseThree" class="collapse link-body" aria-labelledby="headingThree" data-parent="#hot">
							<a class="dropdown-item" href="../index/index.php?page=index&id=funny">有趣版</a>
							<a class="dropdown-item" href="../index/index.php?page=index&id=relationship">感情版</a>
							<a class="dropdown-item" href="../index/index.php?page=index&id=talk">其他版</a>
						</div>
						</div>
					</li> -->
					<!-- 熱門看板 end-->
					<li class="d-md-none mid">
						<form class="form-inline mid" method="POST" action="../index/search.php">
							<input class="form-control mr-sm-2" type="search" placeholder="要找甚麼...." style="width:125px; margin-right:10px;" name="key">
							<button class="btn btn-light btn-sm" type="submit">搜尋</button>
						</form>
					</li>
				</ul>
			</div>
			<!-- 看板end -->
		</nav>

  	</div>

	<!-- 中間(文章區) -->
	<div class="col-lg-8 col-md-7 col-sm-12" id="middle">
		<?php 
	  	if($page == 'index'){

		?>
		<!-- 方向錯了的限時動態 (可是不知道會不會用到 先留著) -->
		<!-- <div class="time-limit">
			<div class="li-con">
				<div class="li2-con">
					<div class="limi">
						<a href="../index/index.php?page=view" data-toggle="modal" data-target="#limit">
							<img src="../index/image/test1.jpg" class="li-pic">
		  				</a>
					</div>
					<div class="modal fade middle modal2" id="limit" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true" >
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content"  id="sad">-->
								<!-- po文的人 -->
								<!-- <div class="modal-header">
									<div>user</div>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>-->
								<!--限時照片-->
								<!--<div class="modal-body">-->
									<!-- 照片 -->
									<!--<div class="sad-con">
										<img src="../index/image/test1.jpg" class="sad-pic">
									</div>
									<button class="btn btn-info font-weight-bold" type="good">讚</button>						
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- 限時動態 end-->
		<!-- 限時動態 -->
		<!-- 外框 -->
		<div class="time-limit">
			
			<div class="li-con">
				<div class="li2-con">
					<!-- 有登入可以加入限時 -->
					<?php if(isset($_SESSION['nickname'])){ ?>
					<!-- 新增限時 -->
					<div class="limi">
						<a href="../index/index.php?page=add-time">
							<img src="../index/image/add_gray.png" class="add-pic" onmouseout="this.src='../index/image/add_gray.png';" onmouseover="this.src='../index/image/add_white.png';">
		  				</a>
					</div>
					<!-- 新增限時 end -->
					<?php } //end session if?>

					<?php
						$now = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
						$yesterday = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d')-1, date('Y'))) ;
			
						$sql_ig = "SELECT * FROM `instagram` WHERE `post_time` BETWEEN \"$yesterday\" AND \"$now\"";
						$result_ig = mysqli_query($link,$sql_ig);
						$num_ig = mysqli_num_rows($result_ig);
						
						if($num_ig > 0){
							while($row_ig = mysqli_fetch_assoc($result_ig)){
					?>
					<!-- 一則限時 -->
					<div class="limi">
						<a href="../index/time.php?igid=<?=$row_ig['igid'];?>">
							<img src="data:pic/png;base64,<?=base64_encode($row_ig["img"]);?>" class="li-pic">
		  				</a>
					</div>
					<!-- 一則限時 end -->

					<?php 
						}//end while
					}//end if
					?>

				</div>
			</div>
		</div>
		<!-- 限時動態 end -->
		<!-- 上面的按鈕 -->
		<div class="row mid">
			<div class="col-md-6 col-sm-6 col-6">
			  <p class='board'><?php echo $category;?></p>
			</div>
			<?php  if($forum != 'all' AND isset($_SESSION['nickname'])){?>
			<div class="col-md-6 col-sm-6 col-6 right">
				<?php 
					$sql_forum = "SELECT * FROM `follow` WHERE `UId`=\"$uid\" AND `Category` = \"$forum\"";
					$result_forum = mysqli_query($link, $sql_forum);
					$num = mysqli_num_rows($result_forum);
					if($num == 0){
				?>
					<a href="../Article/follow.php?forum=<?php echo $forum;?>">
					<button type="button" class="btn btn-sm btn-info">追蹤此看板</button></a>
				<?php
					}else{
				?>
					<a href="../Article/follow.php?forum=<?php echo $forum;?>">
					<button type="button" class="btn btn-sm btn-info">✔已追蹤</button></a>
					<?php }?>
		  	</div>
		  	<?php } ?>
		</div>

  		<div class="row mid">
			<div class="btn-group col-md-8 col-sm-8 col-10 p0" role="group" aria-label="Button group with nested dropdown">
				<div class='mid'>
					<!-- 全部文章 -->
					<a href="../index/index.php?page=index&id=all&hot=true">
						<button type="button" class="btn btn-sm btn-info <?php if($follow == 'false'){echo 'active';}?>">全部文章</button> 
					</a> 
					<?php if(isset($_SESSION['nickname'])){?>
					<!-- 追蹤文章 -->
					<?php if($forum == 'all'){?>
						<a href="../index/index.php?page=index&follow=true&hot=true">
					<?php }else{ ?>
						<a href="../index/index.php?page=index&id=<?=$forum;?>&follow=true&hot=true">
					<?php }?>
					
						<button type="button" class="btn btn-sm btn-info <?php if($follow == 'true'){echo 'active';}?>">追蹤文章</button>
					</a>
					<?php }?>
					<!-- 排序 -->
					<button id="btnGroupDrop1" type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						排序</button>
					<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
					<?php
						if($follow == 'true'){
							if($forum!="all"){
								echo '<a class="dropdown-item" href="../index/index.php?page=index&id='.$forum.'&follow=true&hot=true">熱門</a>';
								echo '<a class="dropdown-item" href="../index/index.php?page=index&id='.$forum.'&follow=true&latest=true">最新</a>';
							}else{
								echo '<a class="dropdown-item" href="../index/index.php?page=index&follow=true&hot=true">熱門</a>';
								echo '<a class="dropdown-item" href="../index/index.php?page=index&follow=true&latest=true">最新</a>';
							}
						}else if(!(isset($forum))){
							echo '<a class="dropdown-item" href="../index/index.php?page=index&id=all&hot=true">熱門</a>';
							echo '<a class="dropdown-item" href="../index/index.php?page=index&id=all&latest=true">最新</a>';
						}else{
							echo '<a class="dropdown-item" href="../index/index.php?page=index&id='.$forum.'&hot=true">熱門</a>';
							echo '<a class="dropdown-item" href="../index/index.php?page=index&id='.$forum.'&latest=true">最新</a>';
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-1 right p0">
			<?php if(isset($_SESSION['user'])){ ?>
				<a href="?page=write"><img class="pointer gbb2" src="../index/image/pencil.png" title="寫文章"></a>
			<?php }?>
			</div>
			
		</div>
		<!-- 上面的按鈕 end-->
		
		<?php
			// 追蹤文章排序
			if($follow == 'true'){ 
				$sql = "SELECT *
						FROM `follow` JOIN `article` JOIN `member`
						WHERE follow.UId = \"$uid\" AND follow.AId = article.AId AND article.UId = member.UId
						ORDER BY article.agree DESC LIMIT 20";

				if($forum != 'all'){
					if($latest == 'true'){
						$sql = 	"SELECT *
								FROM `follow` JOIN `article` JOIN `member`
								WHERE follow.UId = \"$uid\" AND follow.AId = article.AId AND article.UId = member.UId AND article.category = '$forum'
								ORDER BY article.post_time DESC LIMIT 20 ";
					}else if($hot == 'true'){
						$sql = 	"SELECT *
								FROM `follow` JOIN `article` JOIN `member`
								WHERE follow.UId = \"$uid\" AND follow.AId = article.AId AND article.UId = member.UId AND article.category = '$forum'
								ORDER BY article.agree DESC LIMIT 20 ";
					}
				}else if($latest == "true"){
					$sql = 	"SELECT *
							FROM `follow` JOIN `article` JOIN `member`
							WHERE follow.UId = \"$uid\" AND follow.AId = article.AId AND article.UId = member.UId 
							ORDER BY article.post_time DESC LIMIT 20 ";
				}
				
			}
			// 所有文章排序
			else if($forum == 'all'){
				if($latest == "true"){ 
					$sql = "SELECT * FROM `article` JOIN `member` WHERE article.UId = member.UId ORDER BY `post_time` DESC LIMIT 20";
				}else if($hot == "true"){
					$sql = "SELECT * FROM `article` JOIN `member` WHERE article.UId = member.UId ORDER BY `agree` DESC LIMIT 20 ";
				}else{
					$sql = "SELECT * FROM `article` JOIN `member` WHERE article.UId = member.UId ORDER BY `agree` DESC LIMIT 20 ";
				}
				
			}
			// 看板裡的文章排序
			else{
				if( $latest == 'true'){
					$sql = "SELECT * FROM `article` JOIN `member` WHERE article.UId = member.UId AND `category` = \"$forum\" ORDER BY `post_time` DESC LIMIT 20 ";
				}else if( $hot == 'true'){
					$sql = "SELECT * FROM `article` JOIN `member` WHERE article.UId = member.UId AND `category` = \"$forum\" ORDER BY `agree` DESC LIMIT 20 ";
				}else{
					$sql = "SELECT * FROM `article` JOIN `member` WHERE article.UId = member.UId AND `category` = \"$forum\" ORDER BY `agree` DESC LIMIT 20 ";
				}
			}

			$result = mysqli_query($link,$sql);

			if($result){
				
				while($row = mysqli_fetch_assoc($result)){
					$aid = $row['AId'];
					#找到UId
					$category = findForum($row['category']);
		?>
		<!-- 文章簡圖區 -->
		
		<!-- 顯示文章 -->
		
			<div class="art pointer">
				<!-- 簡圖內容(上) -->
				<div class="row art-head mid">
					<!-- 作者-->
					<div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
						<!-- 作者頭像 -->
						<div class='pic-container'>
							<?php 
								if($row['anonymous'] == 1){
									echo '<a href="../index/index.php?page=nickname&uid='.$row['UId'].'">';	
							?>
								<img src="data:pic/png;base64,<?=base64_encode($row["profile"]);?>" id="writer-pic"></a>
							<?php
								}else{ ?>
									<img src="../index/image/user.png" id="writer-pic">
							<?php	}//end else
							?>
						</div>
						<!-- 作者名稱 -->
						<p class='name'>
							<?php
								if ($row['anonymous'] == 0){
									echo '匿名';
								}else{
									echo $row['Nickname'];
								}
							?>
						</p>
					</div>
					<!-- 作者 end-->

					<!-- 按讚數 --> 
					<div class="col-md-2 col-sm-3 col-3 right">
						<h7 style="display: inline;" class="count"><?php echo $row['agree'];?></h7>
						<?php 
							if(isset($_SESSION['nickname'])){
								$sql_good = "SELECT * FROM `good` WHERE `UId` = \"$uid\" AND `AId` = \"$row[AId]\"";
								$result_good = mysqli_query($link,$sql_good);
								$row_good = mysqli_fetch_assoc($result_good);
								$num = mysqli_num_rows($result_good);

								$Link = "../Article/good.php?aid=".$row['AId'];

								if($num > 0){
										echo '<img src="../index/image/good-black.png" class="good_article img-fluid " data-url="'.$Link.'" id="good-pic">';
								}else{
									echo '<img src="../index/image/good-white.png" class="good_article img-fluid" data-url="'.$Link.'" id="good-pic">';
								}
							}else{
								echo '<img src="../index/image/good-white.png" class="img-fluid" id="good-pic" onclick="no();">';
							}
						?>
						<!-- <img src="./image/good-white.png" class="img-fluid" id="good-pic"> -->
					</div>
					<!-- 按讚數 end-->
				</div>
				<!-- 簡圖內容(上) end-->
				
				<!-- 簡圖內容(中) -->
				<div class="row art-body mid"  onclick="location.href='../index/index.php?page=article&aid=<?php echo $row['AId']; ?>';">
					<!-- 標題 -->
					<div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
						<p class="font-weight-bold" style='font-size:3vmin; margin:0px;'><?php echo $row['title'];?></p>
						<p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
						<?php 
							echo $row['excerpt'];
						?>
						</p>
					</div>
					<!-- 標題 end -->

					<!-- 圖檔 -->
					<!-- <div class="col-md-3 col-sm-3 col-4 col-lg-3" >
						<img src="./image/article-pic.jpg" id="article-pic">
					</div> -->
					<!-- 圖檔 end -->
				</div>
				<!-- 簡圖內容(中) end-->
				
				<!-- 簡圖內容(下) -->
				<div class="row art-fotter mid">
					<!-- 看板 - 發文時間 -->
					<div class="col-md-12 col-sm-12 col-12">
						<p style=' font-size:1.75vmin; margin:0px; color:gray;'>
							<?php
								echo "<a href = '../index/index.php?page=index&id=".$row['category']."' style = 'color:gray;text-decoration:none;'>".$category."</a>";
								echo ' - ';
								echo date('Y-m-d H:i',strtotime($row['post_time']));
							?>
						</p>
					</div>
					<!-- 看板 - 發文時間 end -->
				</div>
				<!-- 簡圖內容(下) end-->
			</div>
			<!-- 文章簡圖區 end-->
		<!-- 文章區 -->
		
  		<?php
		// 註冊頁面 如果按還不是會員 會跳轉到 member/register.php的頁面 
				}//end while
			}//end result  
		}
		  	if($page == 'register'){
			$page = 'index';
			include("../member/register.php"); }
		?> 
		<?php //文章撰寫
		  	if($page == 'write'){
			$page = 'index';
			include("../Article/write.php"); }
		?>
		<?php //個人資料修改
		  	if($page == 'user'){
			$page = 'index';
			include("../index/user.php"); }
		?>
		<?php //通知
		  	if($page == 'bell'){
			$page = 'index';
			include("../index/bell.php"); }
		?>
		<?php //nickname頁面
		  	if($page == 'nickname'){
			$page = 'index';
			include("../index/nickname.php"); }
		?> 
		<?php //文章頁面
			if($page == 'article'){
			$page = 'index';
			include("../Article/article.php"); }
		?>
		<?php //好友頁面
			if($page == 'friend'){
			$page = 'index';
			include("../index/friend.php"); }
		?>
		<?php //追蹤頁面
			if($page == 'follow'){
			$page = 'index';
			include("../index/follow.php"); }
		?>
		<?php //收藏頁面
			if($page == 'collect'){
			$page = 'index';
			include("../index/collect.php"); }
		?>
		<?php //增加限時
			if($page == 'add-time'){
			$page = 'index';
			include("../index/add-time.php"); }
		?>
		<?php //文章編輯頁面
			if($page == 'edit'){
				$page = 'index';
				include("../Article/edit.php"); }	
		?>
		<?php //聊天頁面
			if($page == 'chat'){
			$page = 'index';
			include("../index/chat.php"); }
		?>
		<?php //搜尋
		  	if($page == 'search'){
			$page = 'index';
			include("../index/search.php"); }
		?>
		<?php //TAG頁面
			if($page == 'tag'){
			$page = 'index';
			include("../index/tag.php"); }
		?>
		<?php //心理測驗-1
			if($page == 'test1'){
			$page = 'index';
			include("../index/test1.php"); }
		?>
		<?php //心理測驗-2
			if($page == 'test2'){
			$page = 'index';
			include("../index/test2.php"); }
		?>
		<?php //心理測驗-result
			if($page == 'test-result'){
			$page = 'index';
			include("../index/test-result.php"); }
		?>
	</div>
	<!-- 中間end -->
	
	<!-- 右半部 -->
		<div class="col-lg-2 col-md-3 col-sm-12 col-12" id="right">

			<!--右上半部 會員登入格子-->
			<div id="login" class=" d-none d-md-block">

				<!-- 登入了 -->
				<?php // 登入後
					if(isset($_SESSION['user'])){
						$sql = "SELECT `profile` FROM `member` WHERE `Nickname` = '$_SESSION[nickname]'";
						$result = mysqli_query($link,$sql);
						$row = mysqli_fetch_assoc($result);
				?>
				<div class='user-con'>
					<img src="data:pic/png;base64,<?=base64_encode($row["profile"]);?>" id="user-pic" alt="image" >
				</div>
				<div>
					<p id='user-name' class="font-weight-bold"><?php echo $_SESSION['user'];?></p>
					<p id='user-nickname'><?php echo $_SESSION['nickname']; ?></p>
				</div>

				<div>
					<button type="button"class="btn btn-info font-weight-bold col-md-6" >
						<a href="../index/index.php?page=logout" style='text-decoration:none; color:white;'>登出</a>
					</button>
				</div>
			</div>
				
				<!-- 登入了end-->

				<!--右下半部 分頁格子-->
				<div id="other-page">
					
					<div class="row">
						<button type="button" class="btn col-md-6 col-sm-3 col-3 " data-toggle="modal" data-target="#exampleModalCenter">
							<img src='../index/image/person.png' title="個人頁面">
						</button>
						<!--四個btn-->
						<div class="modal fade bd-example-modal-sm" id="exampleModalCenter" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content login-page">

									<!--btn頭-->
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">想要看甚麼?</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<!--btn內容-->
									
									<div class="modal-body">
										<div class="row">
											<div class="col-md-6 col-sm-6 col-6">
												<a href="?page=collect"><img class="pointer gbb3" src="../index/image/collect.png" title="收藏的文章"></a>
												<p class="font-weight-bold" style='font-size:12pt; margin:0px;'>收藏</p>
											</div>
											<div class="col-md-6 col-sm-6 col-6">
												<a href="?page=follow"><img class="pointer gbb3" src="../index/image/follow.png" title="追蹤的文章、tag、作者"></a>
												<p class="font-weight-bold" style='font-size:12pt; margin:0px;'>追蹤</p>
											</div>
											<div class="col-md-6 col-sm-6 col-6">
												<a href="?page=nickname"><img class="pointer gbb3" src="../index/image/nickname.png" title="我的文章"></a>
												<p class="font-weight-bold" style='font-size:12pt; margin:0px;'>我的文章</p>
											</div>
											<div class="col-md-6 col-sm-6 col-6">
												<a href="?page=user"><img class="pointer gbb3" src="../index/image/setting.png" title="個人資料修改"></a>
												<p class="font-weight-bold" style='font-size:12pt; margin:0px;'>個人設定</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--四個btn end-->

						<button type="button" class="btn col-md-6 col-sm-3 col-3">
							<!-- 沒有跳通知的是<img src='../index/image/bell.png' title="通知">
								有跳通知的是<img src='../index/image/bell-shake.gif' title="通知"> -->
							<a href="../index/index.php?page=bell"  style="color:white;"><img src='../index/image/bell.png' title="通知" id="notification"></a>
						</button>

						<button type="button" class="btn col-md-6 col-sm-3 col-3">
							<a href="../index/index.php?page=test1"  style="color:white;"><img src='../index/image/test.png' title="心理測驗"></a>
						</button>
						<button type="button" class="btn col-md-6 col-sm-3 col-3">
							<a href="../index/index.php?page=friend"  style="color:white;"><img src='../index/image/friend.png' title="好友列表"></a>
						</button>
					</div>
					<!-- <div class="row justify-content-center">
						<button type="button" class="btn btn-light font-weight-bold col-md-10" style='margin-top:10px;'>
							<p onclick="setStyleSheet();" style='font-size:12pt; margin:0px;'>管理員模式</p>
						</button>
					</div> -->
				</div>
				<!--右下半部 分頁格子 end-->
				<?php
					}//end if
					else{ //沒登入
				?>
				<!--沒有登入-->
				<div class='user-con2'>
					<img src="./image/user.png" id="user-pic" alt="Responsive image" >
				</div>
				<div>
					<button type="button"class="btn btn-info font-weight-bold" data-toggle="modal" data-target="#exampleModalCenter">
						註冊/登入
					</button>
						
					<!--登入畫面-->
					<div class="modal fade bd-example-modal-sm" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content login-page">

								<!--登入頭-->
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">walcome 抬槓!</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<!--登入內容-->
								<form method="post" action="../member/login.php" enctype="multipart/form-data">
								<div class="modal-body">
									<div>
										<img src='./image/hello.png' id='login-pic' class='mar'>
										<h5 class='mar'>帳號 
											<input type="text" placeholder="帳號" name='Account'></h5>
										<h5 class='mar'>密碼 
											<input type="password" placeholder="密碼" name='Password'></h5>
										<!-- <button type="button" class="btn btn-secondary btn-sm mar">
											<a href='#'  style="color:white;">忘記密碼
										</button> -->
										<!-- 如果按還不是會員 會跳轉到 member/login.php的頁面 -->
										<button type="button" class="btn btn-secondary btn-sm mar">
											<a href="?page=register"  style="color:white;">還不是會員?</a>
										</button>
									
									</div>
								</div>
								<!--登入尾-->
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">下次再說</button>
									<button class="btn btn-info font-weight-bold" type="submit">送出</button>
								</div>
							</from>
							</div>
						</div>
					</div>
					<!--登入畫面end-->

				</div>
				<!--沒有登入end-->
					<?php } //end else ?>
			</div>
			<!--右上半部 會員登入格子end-->
		</div>
		<!--右上半部 會員登入格子end-->
  	
	</div>
  	<!-- 右半部 end -->
	</div>
	<!-- row end -->

	<script>
		$(".good_article").click(function(){
				var url = $(this).data("url");
				var good = $(".good_article").index($(this));

				console.log(good);
				$.ajax({
					type: 'POST',
					url: url,
					data: {type : "ajax"},
					dataType :"json"
					
				}).done(function(data) {
					console.log(data);
					if(data['success'] == "OK"){
						// $(".Count").eq(count).html("1");
						$(".good_article").eq(good).attr("src","../index/image/good-black.png");
						console.log(good);
						var count = data['likecount'];
						$(".count").eq(good).html(count);
						// console.log(good_c);
					}else if(data['success'] == "DEL_OK"){
						$(".good_article").eq(good).attr("src","../index/image/good-white.png");
						var count = data['likecount'];
						$(".count").eq(good).html(count);
						
					}
				});
			});

			
			$(function(){
				setInterval(getalarm,100)
			});

			function getalarm (){
				$.ajax({
					type: 'POST',                     //GET or POST
					url: "../index/notify.php",  //請求的頁面
					cache: false,   //是否使用快取
					dataType : 'json'
				}).done(function(data) {
					console.log(data);
					if(data['success'] == "YES"){
						$("#notification").attr("src","../index/image/bell-shake.gif");
					}else if(data['success'] == "NO"){
						$("#notification").attr("src","../index/image/bell.png");
								
					}
				});
			};
		
		</script>
		<script>
			// $('#selectTrainer').modal('show');
			function view(){
				setInterval(function(){alert("Hello")},3000);
			}
		</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet"  />
</body>
  </body>
  <!-- iRLijyf
RCDrTZQ
KuTKOqE
B5rugAA
0POa4oS 
VuMgGoG
rqrxJuL
1EGea02
fSvSan9
-->
  
</html>