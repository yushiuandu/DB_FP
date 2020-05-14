<?php session_start();?>
<?php
	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
	echo "no connect!";
	}
	$sql = "SELECT * FROM `article` ORDER BY `agree` DESC";
	// 將一切都先初始化
	$page = 'index';	$latest = 'false';	$hot = 'false';	$id = 'flase';	$forum = 'all';
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	if(isset($_GET['id'])){
		$forum = $_GET['id'];
	}
	if(isset($_GET['hot'])){
		$hot = $_GET['hot'];
	}
	if(isset($_GET['latest'])){
		$latest = $_GET['latest'];
	}
	if($page == 'logout'){
		unset($_SESSION['user']);
		unset($_SESSION['nickname']);
		session_destroy();
		header("Location:../index/index.php");
		exit;
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
    <link href="./my.css" rel="stylesheet" type="text/css">
    <title>抬槓</title>
	<script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
	<script src="//s3-ap-northeast-1.amazonaws.com/justfont-user-script/jf-60019.js"></script>
  </head>

  <body>
  	<!-- 導覽列 -->
    <div class="head-nav">
		
	
      <div class="row" >
	  	<nav class="navbar-expand-lg navbar-default navbar-light">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</nav>

		  <div class="col-md-9 col-sm-5 mr-auto">
		  	<a class="navbar-brand" href="../index/index.php">
        		<img src="./image/Tai-gun.png" class="Tai-gun">
      		</a>
		  </div>
		  <div class="">
			<form class="form-inline" method="post" action="../index/search.php">
				<input class="form-control mr-sm-2" type="search" placeholder="搜尋標題...." style="width:125px;" name="key">
				<button type="sumbit" class="btn btn-light btn-sm" type="submit">搜尋</button>
			</form>
		  </div>	
	  </div>
	</div>
	<!-- 導覽列end -->
	
	
  <div class="row">
    <!-- 左半部 -->
    <div class="col-md-2" id="left">
      	<nav class=" navbar-expand-lg navbar-default navbar-light" >
			<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button> -->
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav  flex-column">
					<li class="nav-item dropdown">
						<a href = "../index/index.php"><img src="./image/logo.png" width="auto" height="80"></a>
					</li>
					<!-- 所有看板 -->
					<li class="nav-item dropdown" style="font-family:jf-openhuninn;">
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
							<a class="dropdown-item" href="../index/index.php?page=index&id=other">其他版</a>
						</div>
						</div>
					</li><!-- 所有看板end -->
					<!-- 訂閱看板 -->
					<li class="nav-item dropdown" style="font-family:jf-openhuninn;">
						<div class='link-head' id="follow">
						<div id="headingTwo">
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							訂閱看板</a>
						</div>
							<div id="collapseTwo" class="collapse link-body" aria-labelledby="headingTwo" data-parent="#follow">
								<a class="dropdown-item" href="../index/index.php?page=index&id=funny">美食版</a>
								<a class="dropdown-item" href="../index/index.php?page=index&id=funny">美妝穿搭</a>
								<a class="dropdown-item" href="../index/index.php?page=index&id=funny">旅遊版</a>
							</div>
						</div>
					</li>
					<!-- 訂閱看板 end-->
					<!-- 熱門看板 -->
					<li class="nav-item dropdown" style="font-family:jf-openhuninn;"> 
						<div class='link-head' id="hot">
						<div id="headingThree">
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							熱門看板</a>
						</div>
						<div id="collapseThree" class="collapse link-body" aria-labelledby="headingThree" data-parent="#hot">
							<a class="dropdown-item" href="../index.php?page=index&id=funny">有趣版</a>
							<a class="dropdown-item" href="../index.php?page=index&id=relationship">感情版</a>
							<a class="dropdown-item" href="../index.php?page=index&id=fun">其他版</a>
						</div>
						</div>
					</li>
					<!-- 熱門看板 end-->
				</ul>
			</div>
			<!-- 看板end -->
    	</nav>
  	</div>

	<!-- 中間(文章區) -->
	<div class="col-md-8" id="middle">
		<?php 
	  	if($page == 'index'){

		?>
		<!-- 上面的按鈕 -->
		<div class="row">
			<div class="col-md-10 col-sm-10 col-10">
			  <p class='board'>所有看板</p>
			</div>
			<div class="col-md-2 col-sm-2 col-2 right mid">
				<button type="button" class="btn btn-sm btn-info">追蹤此看板</button>
		  </div>
		</div>
  		<div class="row mid">
			<div class="btn-group col-md-4 col-sm-6 col-9" role="group" aria-label="Button group with nested dropdown">
				<button type="button" class="btn btn-sm btn-info active">全部文章</button>    <!--啟用狀態(active)-->
				<button type="button" class="btn btn-sm btn-info">追蹤文章</button>
				<button id="btnGroupDrop1" type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  					排序</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				<?php
					if(!(isset($forum))){
						echo '<a class="dropdown-item" href="../index/index.php?page=index&id=all&hot=true">熱門</a>';
						echo '<a class="dropdown-item" href="../index/index.php?page=index&id=all&latestt=true">熱門</a>';
					}else{
						echo '<a class="dropdown-item" href="../index/index.php?page=index&hot=true">熱門</a>';
						echo '<a class="dropdown-item" href="../index/index.php?page=index&latest=true">最新</a>';
					}
					?>
				</div>
			</div>
			<div class="col-md-5"></div>
			<div class="col-md-3 col-sm-6 col-3 right">
				<a href="?page=write"><img class="pointer gbb2" src="../index/image/pencil.png" title="寫文章"></a>
				<?php  if($forum != 'all'){?>
				<button type="button" class="btn btn-sm btn-info">追蹤此看板</button>
				<?php } ?>
			</div>
		</div>
		<!-- 上面的按鈕 end-->
		
		<?php
		// 最新排序	
			if($forum == 'all'){
				if($latest == "true"){ 
				$sql = "SELECT * FROM `article` ORDER BY `post_time` DESC";
				}else if($hot == "true"){
					$sql = "SELECT * FROM `article` ORDER BY `agree` DESC";
				}
			}else{
				$sql = "SELECT * FROM `article` WHERE `category` = \"$forum\" ORDER BY `agree` DESC";
				if( $latest == 'true'){
					$sql = "SELECT * FROM `article` WHERE `category` = \"$forum\" ORDER BY `post_time` DESC";
				}else if( $hot == 'true'){
					$sql = "SELECT * FROM `article` WHERE `category` = \"$forum\" ORDER BY `agree` DESC";
				}
			}
			$result = mysqli_query($link,$sql);

			if($result){
				include("../index/fourm.php");
				while($row = mysqli_fetch_assoc($result)){
					$id = $row['AId'];
					$category = findFourm($row['category']);
		?>
		<!-- 文章簡圖區 -->
		
		<a href="../index/index.php?page=article&aid=<?php echo $id ?>" style="color:black; text-decoration:none;">
			<div class="art">
				<!-- 簡圖內容(上) -->
				<div class="row art-head mid">
					<!-- 作者-->
					<div class="col-md-10 col-sm-9 col-9">
						<!-- 作者頭像 -->
						<?php 
							if($row['anonymous'] == 1){
								echo '<a href="../index/index.php?page=nickname&uid='.$row[UId].'">';	
						?>
							<img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic"></a>
						<?php
							}else{ ?>
								<img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic">
						<?php	}//end else
						?>
						<!-- 作者名稱 -->
						<p style="display: inline; font-size:2vmin; margin:0px;">
							<?php
								if ($row['anonymous'] == 0){
									echo '匿名';
								}else{
									echo $row['post_name'];
								}
							?>
						</p>
					</div>
					<!-- 作者 end-->

					<!-- 按讚數 --> 
					<div class="col-md-2 col-sm-3 col-3 right">
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
								echo $row['post_time'];
							?>
						</p>
					</div>
					<!-- 看板 - 發文時間 end -->
				</div>
				<!-- 簡圖內容(下) end-->
			</div>
			<!-- 文章簡圖區 end-->
		</a>
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
	</div>
	<!-- 中間end -->

  	<!-- 右半部 -->
    <div class="col-md-2 col-12" id="right">

		<!--右上半部 會員登入格子-->
		<div id="login">

			<!-- 登入了 -->
			<?php // 登入後
				if(isset($_SESSION['user'])){
			?>
			<div>
				<img src="./image/test-user.jpg" class="img-fluid rounded-circle" id="user-pic" alt="image" >
			</div>
			<div>
				<p id='user-name' class="font-weight-bold"><?php echo $_SESSION['user'];?></p>
				<p id='user-nickname'><?php echo $_SESSION['nickname']; ?></p>
			</div>

			<div>
				<button type="button"class="btn btn-info font-weight-bold col-md-6" >
					<a href="../index/index.php?page=logout" style='text-decoration:none; color:white;'>登出</a>
					<?php 
						if($page == 'logout'){
							unset($_SESSION['user']);
							unset($_SESSION['nickname']);
							session_destroy();
							header("Location:../index/index.php");
						}
					?>
				</button>
			</div>
		</div>
			
      		<!-- 登入了end-->

			<!--右下半部 分頁格子-->
			<div id="other-page">
				
				<div class="row">
					<button type="button" class="btn col-md-6" data-toggle="modal" data-target="#exampleModalCenter">
						<img src='../index/image/person.png' title="個人頁面">
					</button>
					<!--四個btn-->
					<div class="modal fade bd-example-modal-sm" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
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
										<div class="col-md-6">
											<a href="?page=collect"><img class="pointer gbb3" src="../index/image/collect.png" title="收藏的文章"></a>
											<p class="font-weight-bold" style='font-size:12pt; margin:0px;'>收藏</p>
										</div>
										<div class="col-md-6">
											<a href="?page=follow"><img class="pointer gbb3" src="../index/image/follow.png" title="追蹤的文章、tag、作者"></a>
											<p class="font-weight-bold" style='font-size:12pt; margin:0px;'>追蹤</p>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<a href="?page=nickname"><img class="pointer gbb3" src="../index/image/nickname.png" title="我的文章"></a>
											<p class="font-weight-bold" style='font-size:12pt; margin:0px;'>我的文章</p>
										</div>
										<div class="col-md-6">
											<a href="?page=user"><img class="pointer gbb3" src="../index/image/setting.png" title="個人資料修改"></a>
											<p class="font-weight-bold" style='font-size:12pt; margin:0px;'>個人設定</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--四個btn end-->

					<button type="button" class="btn col-md-6">
						<a href="?page=bell"  style="color:white;"><img src='../index/image/bell.png' title="通知"></a>
					</button>
				</div>
				<div class="row">
					<button type="button" class="btn col-md-6">
						<a href="?page=test"  style="color:white;"><img src='../index/image/test.png' title="心理測驗"></a>
					</button>
					<button type="button" class="btn col-md-6">
						<a href="?page=friend"  style="color:white;"><img src='../index/image/friend.png' title="好友列表"></a>
					</button>
				</div>
			</div>
			<!--右下半部 分頁格子 end-->
			<?php
				}//end if
				else{ //沒登入
			?>

			<!--沒有登入-->
			<div>
				<img src="./image/user.png" class="img-fluid rounded-circle" id="user-pic" alt="Responsive image" >
			</div>
			<div>
				<button type="button"class="btn btn-info font-weight-bold" data-toggle="modal" data-target="#exampleModalCenter">
					註冊/登入
				</button>
					
				<!--登入畫面-->
				<div class="modal fade bd-example-modal-sm" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
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
									<button type="button" class="btn btn-secondary btn-sm mar">
										<a href='#'  style="color:white;">忘記密碼
									</button>
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
  	<!-- 右半部 end -->
	</div>
	<!-- row end -->
	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
  
</html>