<?php
	date_default_timezone_set('Asia/Taipei');
	$datetime = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
	#connect to sql
	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
	if(!$link){
		echo "no connect!";
	}

	#找到UId
	include("../index/forum.php");
	$uid = "";
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
	}
	if(isset($_GET['other'])){
		$other = $_GET['other'];
	}

	// 找到對方的綽號
	$sql = "SELECT `nickName` FROM `member` WHERE `UId` = \"$other\"";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($result);
	$other_name = $row['nickName'];

	//找尋聊天紀錄
	$sql = "SELECT * FROM `chat` 
			WHERE (`UId` = \"$uid\" AND `other` = \"$other\") OR (`UId` = \"$other\" AND `other` = \"$uid\")
			ORDER BY `sendtime` ASC";
	$result = mysqli_query($link, $sql);

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
			function showSite(str)
			{
				if (str=="")
				{
					document.getElementById("txtHint").innerHTML="";
					return;
				} 
				if (window.XMLHttpRequest)
				{
					// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
					xmlhttp=new XMLHttpRequest();
				}
				else
				{
					// IE6, IE5 浏览器执行代码
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","getsite_mysql.php?q="+str,true);
				xmlhttp.send();
			}


		</script>

	</head>
  <!-- 聊天室 -->
	<body>
		<!-- 聊天室的頭 -->
		<div class="chat-head">
			<div class="row">
				<div class="col-md-6">
					<p style='position:relative; top:35px; font-size:18pt; font-weight:600;'><?php echo $other_name; ?></p>
				</div>

				<div class="col-md-6">
					<a href="../index/index.php?page=nickname&uid=<?php echo $other;?>">
					<img src="../index/image/test1.jpg" class="img-fluid rounded-circle" id="chat-pic">   
					</a>      
				</div>
			</div>
		</div>
		<!-- 聊天室的頭 end -->
		<!-- 聊天室的中間段(對話區) -->
		<div class="chat-body">

			<?php 
				if((mysqli_num_rows($result)) > 0 ){
					while($row = mysqli_fetch_assoc($result)){
						if($row['UId'] == $other){
			?>
			<!-- 對方的對話框 -->
			<div style='text-align:left;'>
				<!-- 對方頭貼 -->
				<img src="../index/image/test2.jpg" class="img-fluid rounded-circle c-pic" >
				
				<!-- 對方的話 -->
				<div class="talk">
					<pre class='talk-word'><?php echo $row['chat']; ?></pre>
				</div>
			</div>
			<!-- 對方的對話框 end -->
			<?php }//end if 
					else if($row['UId'] == $uid){?>

			<!-- 自己的對話框 -->
			<div style='text-align:right;'>
				<!-- 自己的話 -->
				<div class="talk"> 
				<pre class='talk-word'><?php echo $row['chat']; ?></pre>
				</div>
			<!-- 自己的頭貼 -->
				<img src="../index/image/test1.jpg" class="img-fluid rounded-circle c-pic" >
			</div>
			<!-- 自己對話框 end -->
					<?php 		}//end else if
					}//end while
				}//end if?>
			
		</div>
		<!-- 聊天室的中間段(對話區) -->
		<!-- 聊天室的尾段(輸入區) -->
		<div class="chat-fotter">
			<form action="../index/chat.php?send=<?php echo $other;?>" method="post">
				<input id="chat" name="chat" type="text" placeholder='說點什麼吧...'>
				<button type="submit" class="btn btn-secondary btn-sm my-1">傳送</button>
			</form>
		</div>
		<!-- 聊天室的尾段(輸入區) -->
		
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>

<?php

	if(isset($_GET['send'])){
		session_start();
		include("../index/forum.php");
		$uid = "";
		if(isset($_SESSION['nickname'])){
			$uid = finduid($_SESSION['nickname']);
		}
		$content = $_POST['chat'];
		$sql = "INSERT INTO `chat` (`UId`,`other`,`chat`,`sendtime`) VALUES ('$uid','$_GET[send]','$content','$datetime')";
		if(mysqli_query($link, $sql)){
			header("Location:../index/index.php?page=chat&other=$_GET[send]");
		}else{
			mysqli_error();
		}
	}

?>