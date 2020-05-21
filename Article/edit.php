<?php
	date_default_timezone_set('Asia/Taipei');

	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
		echo "no connect!";
	}

	if(isset($_GET['aid'])){
		$aid = $_GET['aid'];
		$sql = "SELECT * FROM `article` WHERE `AId` =\"$aid\"";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_assoc($result);
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
			<p class='board'>編輯文章</p>
		</div>
	<div class='write'>
		<form action="../Article/edit.php?edit=<?php echo $aid;?>" method ="post">
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">標題</label>
			<div class="col-sm-10">
			<input name="title" type="text" class="form-control" value="<?php echo $row['title'];?>" require>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">文章內容</label>
			<!-- 自動變長 -->
			<div class="col-sm-10">
			<textarea name="content" type="text" class="form-control" cols="90" rows="12" onkeyup="autogrow(this);" require><?php echo $row['content'];?></textarea>
			</div>
		</div>
		<!-- <div class="form-group row">
			<div class="col-sm-10">
			<input Type="File" Name="YouFile">
			</div>
		</div> -->
		<div class='right'>
			<button type="update" class="btn btn-info font-weight-bold">更改</button>
		</div>
		</form>
	</div>
		
		
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>

<?php
	if(isset($_GET['edit'])){
		$aid = $_GET['edit'];
		$sql = "UPDATE `article` SET `title` = \"$_POST[title]\", `content` = \"$_POST[content]\" WHERE `AId` = \"$aid\"";
		if(mysqli_query($link,$sql)){
			header("Location:../index/index.php?page=article&aid=$aid");
		}
		else{
			mysqli_error();
		}
	}

	// 刪除文章
	if(isset($_GET['delete'])){
		$aid = $_GET['delete'];
		$sql = "DELETE FROM `article` WHERE `AId` = \"$aid\"";
		if(mysqli_query($link,$sql)){
			header("Location:../index/index.php");
		}
		else{
			mysqli_error();
		}
	}

	if(isset($_GET['deletec'])){
		session_start();
		$aid = $_SESSION['aid'];
		$content = "該則留言已遭刪除QQ";
		$sql = "UPDATE `comment` SET `content` = \"$content\" , `anonymous` = 2 , `likeCount` = 0 WHERE `CId` = \"$_GET[deletec]\"";

		if(mysqli_query($link,$sql)){
			header("Location:../index/index.php?page=article&aid=$aid");
			exit;
		}else{
			mysqli_error();
		}
	}

?>