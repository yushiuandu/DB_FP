<?php
	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
		echo "no connect!";
	}

	include("../index/forum.php"); #匯入function
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
	}

	$sql = "SELECT * FROM `user_ans` WHERE `UId` = '$uid'";
	$result = mysqli_query($link,$sql);
	if($result){
		$num = mysqli_num_rows($result);
	}else{
		$num = 0;
	}

	if($num > 0){
		echo '<script language="javascript">';
        echo 'alert("您今天已做過心理測驗");';
        echo "window.location.href='../index/index.php'";
        echo '</script>';
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
 	<!-- 心理測驗-1 -->
  	<body>
		<div class='test'>
		<div class="row justify-content-center">
			<div class="col-md-12">
				<!-- 照片 -->
				<img src='../index/image/test.png' class='test-logo'></img>
				<!-- slogn -->
				<p class='test-ww'>性格決定一切！？<br>
						讓抬槓幫你找到合適的人吧！</p>
			</div>
		</div>
		<div class="row justify-content-center">
			<!-- 測驗button -->
			<div class='col-md-4 col-sm-5 col-4 test-btn'>
				<a href='../index/index.php?page=test2' class='link-ww'>開始測驗</a>
			</div>
		</div>
		</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>