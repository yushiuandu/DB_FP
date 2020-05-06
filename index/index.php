<?php session_start();?>
<?php
  $page = "index";
  if(isset($_GET['page'])){
    $page = $_GET['page'];
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
    <title>Tai-gun</title>
  </head>

  <body>
  	<!-- 導覽列 -->
    <nav class="navbar navbar-default navbar-expend-lg head-nav">
      <a class="navbar-brand" href="?page=index">
        <img src="./image/Tai-gun.png" class="Tai-gun">
      </a>
      <form class="form-inline search col-md-0">
        <input class="form-control mr-sm-2" type="search" placeholder="搜尋...." aria-label="Search">
        <button type="button" class="btn btn-light" type="submit">搜尋</button>
      </form>
    </nav>
	<!-- 導覽列end -->

	
  <div class="row">
    <!-- 左半部 -->
    <div class="col-md-2" id="left">
      	<nav class=" navbar-expand-lg navbar-default navbar-light" >
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav  flex-column">
					<li class="nav-item dropdown">
						<img src="./image/logo.png" width="auto" height="80">
					</li>
					<!-- 所有看板 -->
					<li class="nav-item dropdown">
						<div class='link-head' id="all">
						<div id="headingOne">
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
							所有看板</a>
						</div>
						<div id="collapseOne" class="collapse link-body" aria-labelledby="headingOne" data-parent="#all">
							<a class="dropdown-item" href="#">美食版</a>
							<a class="dropdown-item" href="#">美妝穿搭</a>
							<a class="dropdown-item" href="#">旅遊版</a>
							<a class="dropdown-item" href="#">新聞版</a>
							<a class="dropdown-item" href="#">有趣版</a>
							<a class="dropdown-item" href="#">感情版</a>
							<a class="dropdown-item" href="#">其他版</a>
						</div>
						</div>
					</li><!-- 所有看板end -->
					<!-- 訂閱看板 -->
					<li class="nav-item dropdown">
						<div class='link-head' id="follow">
						<div id="headingTwo">
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							訂閱看板</a>
						</div>
							<div id="collapseTwo" class="collapse link-body" aria-labelledby="headingTwo" data-parent="#follow">
								<a class="dropdown-item" href="#">美食版</a>
								<a class="dropdown-item" href="#">美妝穿搭</a>
								<a class="dropdown-item" href="#">旅遊版</a>
							</div>
						</div>
					</li>
					<!-- 訂閱看板 end-->
					<!-- 熱門看板 -->
					<li class="nav-item dropdown">
						<div class='link-head' id="hot">
						<div id="headingThree">
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							熱門看板</a>
						</div>
						<div id="collapseThree" class="collapse link-body" aria-labelledby="headingThree" data-parent="#hot">
							<a class="dropdown-item" href="#">有趣版</a>
							<a class="dropdown-item" href="#">感情版</a>
							<a class="dropdown-item" href="#">其他版</a>
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
	<div class="col-md-8 col-12" id="middle">

		<!-- 文章區 -->
		<?php if($page == 'index'):
			include("../Article/Article.php"); ?>
	
		<!-- 註冊頁面 --> <!-- 如果按還不是會員 會跳轉到 member/register.php的頁面 -->
		<?php elseif($page == 'register'):
			include("../member/register.php");
		endif; ?> 
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
				<img src="./image/test-user.jpg" class="img-fluid rounded-circle" id="user-pic" alt="Responsive image" >
			</div>
			<div>
				<p id='user-name' class="font-weight-bold"><?php echo $_SESSION['user'];?></p>
				<p id='user-nickname'><?php echo $_SESSION['nickname']; ?></p>
			</div>
      		<!-- 登入了end-->
			<?php
				}//end if
				else{ //沒登入
			?>

			<!--沒有登入-->
			<div>
				<img src="./image/user.png" class="img-fluid rounded-circle" id="user-pic" alt="Responsive image" >
			</div>
			<div>
				<button type="button"class="btn btn-outline-info font-weight-bold" data-toggle="modal" data-target="#exampleModalCenter">
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
							<div class="modal-body">
								<div>
								<form method="post" action="../member/login.php" enctype="multipart/form-data">
									<img src='./image/hello.png' id='login-pic' class='mar'>
									<h5 class='mar'>帳號 <input type="account" placeholder="帳號" namme = 'Account'></h5>
									<h5 class='mar'>密碼 <input type="password" placeholder="密碼" name = 'Password'></h5>
									<button type="button" class="btn btn-secondary btn-sm mar">
										<a href='#'  style="color:white;">忘記密碼
									</button>
									<!-- 如果按還不是會員 會跳轉到 member/login.php的頁面 -->
									<button type="button" class="btn btn-secondary btn-sm mar">
										<a href="?page=register"  style="color:white;">還不是會員?</a>
									</button>
								</from>
								</div>
							</div>
							<!--登入尾-->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">下次再說</button>
								<button class="btn btn-info font-weight-bold" type="submit">送出</button>
							</div>

						</div>
					</div>
				</div>
				<!--登入畫面end-->
			</div>
			<!--沒有登入end-->
				<?php } //end else ?>
		</div>
		<!--右上半部 會員登入格子end-->

    	<!--右下半部 分頁格子-->
		<div id="other-page">
			<button type="button" class="btn">
				<a href="?page=pencil"  style="color:white;"><img src='./image/pencil.png'></a>
			</button>

			<button type="button" class="btn">
				<a href="?page=bell"  style="color:white;"><img src='./image/bell.png'></a>
			</button>

			<button type="button" class="btn">
				<a href="?page=test"  style="color:white;"><img src='./image/test.png'></a>
			</button>
			<button type="button" class="btn">
				<a href="?page=friend"  style="color:white;"><img src='./image/friend.png'></a>
			</button>
		</div>
		 <!--右下半部 分頁格子 end-->
  	
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