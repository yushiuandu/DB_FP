<?php

	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
		echo "no connect!";
	}

	$modifyuser = "false";
	if(isset($_GET['modifyuser'])){
		session_start();
		$modifyuser = $_GET['modifyuser'];
	}

	include("../index/forum.php");
	$uid = finduid($_SESSION['nickname']);
	

	if($modifyuser == 'true'){

		$nickname = $_POST['nickname'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$birthdate = $_POST['birthdate'];
		
		//綽號沒有被更改
		if(($_SESSION['nickname']) == $_POST['nickname']){
			
				$sql_m = "UPDATE `member` SET `Email` = '$email' , `Password` = '$pass' 
				, `Birth_date` = '$birthdate' WHERE `UId` = '$uid'";

				if(mysqli_query($link,$sql_m)){
					echo '<script language="javascript">';
					echo 'alert("已修改完畢");';
					echo "window.location.href='../index/index.php'";
					echo '</script>';
				}else{
					mysqli_error();
				}

		}else{//綽號有更改
			$sql_check = "SELECT * FROM `member` WHERE `Nickname` = '$nickname'";
			$result_check = mysqli_query($link, $sql_check);
			$row_check = mysqli_fetch_assoc($result_check);

			if(isset($row_check['UId'])){
				echo '<script language="javascript">';
				echo 'alert("此綽號已有他人使用");';
				echo "window.location.href='../index/index.php?page=user'";
				echo '</script>';
			}else{
				// UPDATE `member` SET`Password`=[value-5],`Email`=[value-6],`Birth_date`=[value-7],`MId`=[value-8],`Nickname`=[value-9],`Fans_num`=[value-10] WHERE 1
				$sql_m = "UPDATE member SET `Email` = \"$email\" , `Password` = \"$pass\" , `Birth_date` = \"$birthdate\" , `Nickname` = \"$nickname\" WHERE `UId` = \"$uid\"";
					
				if(mysqli_query($link,$sql_m)){
					$_SESSION['nickname'] = $nickname;
					echo '<script language="javascript">';
					echo 'alert("已修改完畢");';
					echo "window.location.href='../index/index.php'";
					echo '</script>';

					$_SESSION['nickname'] = $nickname;
					$modifyuser = 'false';
					exit;
				}else{
					mysqli_error();
				}	
			}
		}
		
	}


	$sql = "SELECT * FROM `member` WHERE `Nickname` = \"$_SESSION[nickname]\"";
	$result = mysqli_query($link,$sql);
	if($result){
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
	</head>
  <body>
  <!-- 修改個人資料(我覺得可以抓他已經填過的資料進來讓他修改) -->
  <div class='u1'>
	<div class="u-con">
		<img src="data:pic/png;base64,<?=base64_encode($row["profile"]);?>" id="u-pic">
	</div>
    <form method="post" action="../index/user.php?modifyuser=true" enctype="multipart/form-data">
    	<div class="form-row">
        <!-- 綽號 -->
        <div class="form-group col-md-6">
			<label>綽號</label>
			<input type="text" class="form-control" value="<?php echo $row['Nickname'];?>" name="nickname">
        </div>
        <!-- 生日 -->
        <div class="form-group col-md-6">
			<label for="exampleFormControlSelect1">你的生日</label>
			<input type="date" class="form-control" name="birthdate" value="<?php echo $row['Birth_date'];?>">
        </div>
          </div>   
      <!-- row end -->
        <!-- 密碼 -->
        <div class="form-group">
			<label>密碼</label>
			<input type="password" class="form-control" value="<?php echo $row['Password'];?>" placeholder="注意:長度超過7個字，包含英文大小寫及數字" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}" name="pass">
        </div>
        <!-- 信箱 -->
        <div class="form-group">
			<label>信箱</label>
			<input type="text" class="form-control" value="<?php echo $row['Email'];?>" name="email">
        </div>
        <div class="right" style='margin-top:20px;'>
          <button type="update" class="btn btn-info font-weight-bold">確認修改</button>
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
	
?>