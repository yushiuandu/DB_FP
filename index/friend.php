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
	<div class="col-md-12" >
        <input id="search" name="search" type="text" placeholder='這裡可以搜尋你的朋友......還是......你沒朋友......'>
    </div>
    <!-- 搜尋好友 end -->
    <div class="row">
        <div class="col-md-3 friend">
            <a href="?page=chat" style='color:black; text-decoration:none;'>
                <img src='../index/image/test1.jpg' style='width:90%; background-size:contain; border-radius:999em;'>
                <p style="margin:20px; font-family:jf-openhuninn; ">小黑</p>
            </a>
        </div>
        <div class="col-md-3 friend">
            <a href="?page=chat" style='color:black; text-decoration:none;'>
                <img src='../index/image/test2.jpg' style='width:90%; background-size:contain; border-radius:999em;'>
                <p style="margin:20px; font-family:jf-openhuninn;">小白</p>
            </a>
        </div>
        <div class="col-md-3 friend">
            <a href="?page=chat" style='color:black; text-decoration:none;'>
                <img src='../index/image/test3.jpg' style='width:90%; background-size:contain; border-radius:999em;'>
                <p style="margin:20px; font-family:jf-openhuninn;">小可愛</p>
            </a>
        </div>
    </div>

	<?php //聊天頁面
		  	if($page == 'chat'){
			$page = 'index';
			include("../index/chat.php"); }
	?>
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>