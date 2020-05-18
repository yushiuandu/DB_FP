<?php
	date_default_timezone_set('Asia/Taipei');

	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
		echo "no connect!";
	}

	$write = "false";
	if(isset($_GET['write'])){
		session_start();
		$write = $_GET['write'];
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
		<script type="text/javascript">
			function autogrow(textarea){
			var adjustedHeight=textarea.clientHeight;

			adjustedHeight=Math.max(textarea.scrollHeight,adjustedHeight);
			if (adjustedHeight>textarea.clientHeight){
				textarea.style.height=adjustedHeight+'px';}
		}
	</script>
</head>
	<!-- 撰寫文章 -->
<body>
	<div class='write-head'>
		<p class='board'>寫篇文章吧</p>
	</div>
	<div class='write'>
		<form method='post' action='../Article/write.php?write=true'>
		<div class="form-group row">
			<label class="col-sm-3 col-form-label">選擇名稱</label>
			<div class="col-sm-9">
			<select id="inputState" class="form-control" name = "anonymous">
				<option selected value = '1'>綽號</option>
				<option value = '0'>匿名</option>
			</select>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label">選擇看板</label>
			<div class="col-sm-9">
			<select id="inputState" class="form-control" name = "forum">
				<option selected value="funny">	有趣版</option>
				<option value = "relationship">	感情版</option>
				<option value = "makeup">		美妝穿搭版</option>
				<option value = "trending">		新聞版</option>
				<option value = "food">			美食版</option>
				<option value = "travel">		旅遊版</option>
				<option value = "talk">			其他版</option>
			</select>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label">標題</label>
			<div class="col-sm-9">
			<input name = "title" type="text" class="form-control" placeholder="請輸入文章標題" required> 
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-3 col-form-label">文章內容</label>
			<!-- 自動變長 -->
			<div class="col-sm-9">
			<textarea required name = "content" type="text" class="form-control" placeholder="文章內容" cols="90" rows="13" onkeyup="autogrow(this);"></textarea>
			</div>
		</div>

		<!-- <div class="form-group row">
			<label class="col-sm-3 col-form-label">傳送圖檔</label>
			<div class="col-sm-9">
			<input Type="File" Name="YouFile">
			</div>
		</div> -->
		
		<div class='right'>
			<button type="submit" class="btn btn-info font-weight-bold">發送</button>
		</div>

		</form>
	</div>
		
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php

	if($write == 'true'){
		include("../index/forum.php");
		$uid = finduid($_SESSION['nickname']);
		echo $uid;

		$datetime = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
		$excerpt = substr( $_POST['content'] , 0 , 200 );
		$sql = "INSERT INTO article (`category`,`UId`, `title`, `content`, `excerpt`, `post_time`, `anonymous`, `post_name`) 
				VALUES ('$_POST[forum]', '$uid', '$_POST[title]', '$_POST[content]', '$excerpt', '$datetime', '$_POST[anonymous]','$_SESSION[nickname]')";

		if(!(mysqli_query($link, $sql))){
			mysqli_error();
		}else{
			$sql = "SELECT AId FROM article WHERE `UId` = \"$uid\" AND `post_time` = \"$datetime\"";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
			$aid = $row['AId'];
			header('Location:../index/index.php?page=article&aid='.$aid.'');
		}



	}

?>