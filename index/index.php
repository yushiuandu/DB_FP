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
        <img src="./image/title.png" width="32" high="32"> Tai-gun
      </a>
      <form class="form-inline search">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button type="button" class="btn btn-light" type="submit">Search</button>
      </form>
    </nav>
<!-- 導覽列end -->
  <div class="row">
    <!-- 左半部 -->
    <div class="col-12 col-md-2" id="left">
      <nav class=" navbar-expand-lg navbar-default navbar-light" >
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav  flex-column">
          <li class="nav-item">
            <div class='link-head' id="all">
              <div id="headingOne">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                所有看板</a>
              </div>
                <div id="collapseOne" class="collapse link-body" aria-label ledby="headingOne" data-parent="#all">
                  <a class="dropdown-item" href="#">美食版</a>
                  <a class="dropdown-item" href="#">美妝穿搭</a>
                  <a class="dropdown-item" href="#">旅遊版</a>
                  <a class="dropdown-item" href="#">新聞版</a>
                  <a class="dropdown-item" href="#">有趣版</a>
                  <a class="dropdown-item" href="#">感情版</a>
                  <a class="dropdown-item" href="#">其他版</a>
                </div>
              </div>
          </li>
            <li class="nav-item dropdown">
              <div class='link-head'>
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                訂閱看板</a>
                <div id="collapseOne" class="collapse link-body" aria-label ledby="headingOne" data-parent="#all">
                  <a class="dropdown-item" href="#">美食版</a>
                  <a class="dropdown-item" href="#">美妝穿搭</a>
                  <a class="dropdown-item" href="#">旅遊版</a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <div class='link-head'>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                熱門看板</a>
                <div id="collapseOne" class="collapse link-body" aria-label ledby="headingOne" data-parent="#all">
                  <a class="dropdown-item" href="#">有趣版</a>
                  <a class="dropdown-item" href="#">感情版</a>
                  <a class="dropdown-item" href="#">其他版</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  <!-- 中間(文章區) -->
    <div class="col-12 col-md-8" id="middle">
	<?php if($page == 'index'):?>
        <h1>article</h1>
      
	<?php elseif($page == 'login'):?>
	  	<?php include("login.php");?>
	<?php endif;?>     
    </div>
  <!-- 右半部 -->
    <div class="col-12 col-md-2" id="right">
      	<div id="login">
			<!-- 如果登入了 -->
			<!-- <div id="user-pic">
				<img src="./image/test-user.jpg" class="img-fluid rounded-circle" alt="Responsive image" >
			</div>
			<div>
				<p id='user-name' class="font-weight-bold">賀琬茹</p>
				<p id='user-nickname'>小賀</p>
			</div> -->
			<!--如果沒有登入-->
			<div id="user-pic">
				<img src="./image/user.png" class="img-fluid rounded-circle" alt="Responsive image" >
			</div>
			<div >
				<button type="button"class="btn btn-outline-info font-weight-bold" data-toggle="modal" data-target="#exampleModalCenter">註冊/登入</button>
				
				<div class="modal fade bd-example-modal-sm" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content login-page">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">walcome Tai-gun!</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div>
									<img src='./image/hello.png' id='login-pic' class='mar'>
									<h5 class='mar'>帳號 <input type="account" placeholder="帳號" ></h5>
									<h5 class='mar'>密碼 <input type="password" placeholder="密碼"></h5>
									<button type="button" class="btn btn-secondary btn-sm mar"><a href='#'  style="color:white;">忘記密碼</button>
									<button type="button" class="btn btn-secondary btn-sm mar"><a href="?page=login"  style="color:white;">還不是會員?</a></button>
            		</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">下次再說</button>
								<button class="btn btn-info font-weight-bold" type="submit">送出</button>
							</div>
						</div>
  					</div>
				</div>
			</div>
		</div>
		<div id="other-page">
      <button type="button" class="btn"><img src='./image/pencil.png'></button>
      <button type="button" class="btn"><img src='./image/bell.png'></button>
			<button type="button" class="btn"><img src='./image/test.png'></button>
			<button type="button" class="btn"><img src='./image/friend.png'></button>
		</div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>