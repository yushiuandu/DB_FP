<?php 
	if(isset($_GET['submit'])){
		// 圖檔
		$f = "0x".bin2hex(fread( fopen( $_FILES["YouFile"]["tmp_name"] , "r") ,  filesize( $_FILES["YouFile"]["tmp_name"]) ));
		// connect to sql
		$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
		if(!$link){
			echo "no connect!";
		}

		// find uid
		include("../index/forum.php"); #匯入function
		if(isset($_SESSION['nickname'])){
			$uid = finduid($_SESSION['nickname']);
		}

		// set time
		date_default_timezone_set('Asia/Taipei');
		$datetime = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;

		// add to sql 
		$sql = "INSERT INTO `instagram` (`UId`,`category`,`post_time`,`img`,`anonymous`) VALUE
				('$uid','$_POST[forum]','$datetime',$f,'$_POST[anonymous]')";

		if(mysqli_query($link,$sql)){
			echo '成功';
			header("Location:../index/index.php");
		}else{
			echo '<script language="javascript">';
			echo 'alert("檔案大小不得超過1MB！");';
			echo "window.location.href='../index/index.php'";
            echo '</script>';
		}

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
    <div class='write-head'>
		<p class='board'>限時動態</p>
	</div>
	<div class='write'>
		<form action="../index/index.php?page=add-time&submit=true" method="POST" enctype="multipart/form-data">
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
				<label class="col-sm-3 col-3 col-form-label">傳送圖檔</label>
				<div class="col-sm-9 col-9">
					<label>
						<img src='../index/image/add-image.png' class='write-pic'>
						<span id="file_name"></span>
                        <input Type="File" Name="YouFile" class='write-file pointer' id='FileInput' required>
                    </label>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-3 col-3 col-form-label">縮圖</label>
				<div class="col-sm-9 col-9">
                    <figure>
                        <img id="file_thumbnail" style="width:auto; height:auto; max-height:40vh; max-width:30vw;">
                    </figure>
				</div>
			</div>
        

			<div class='right'>
				<button id="sub" type="submit" class="btn btn-info font-weight-bold">發送</button>
			</div>
		</form>
	</div>

	<!-- 抓圖檔的資訊 -->
	<script>
		var inputFile = document.getElementById('FileInput');

		inputFile.addEventListener('change', function(e) {

	  		var fileData = e.target.files[0]; // 檔案資訊
	  		var fileName = fileData.name; // 檔案名稱
			
			console.log(fileName);
			console.log(fileData); // 用開發人員工具可看到資料
			document.getElementById('file_name').innerText = fileName;
			document.getElementById('file_thumbnail').src = URL.createObjectURL(fileData);
		}, false);

		
	</script>
	<!-- 抓圖檔的資訊end -->

	<!-- 動態加input -->
	<script>
		var count = 1;
		var countMax = 5;

		function AddElement(mytype){
			if(count < countMax){
				var mytype,TemO=document.getElementById("add"); 
				var newInput = document.createElement("input");  
				newInput.type=mytype;
				newInput.name="input"+"count";
				newInput.className="add-input"; //class
				newInput.placeholder="不用輸入hashtag";
				newInput.pattern="^[^#]+(?=.*[\u4e00-\u9fa5A-Za-z0-9]).{1,}$";
				TemO.appendChild(newInput); //將元素追加到某個標籤内容中
				var newline= document.createElement("br"); //建一个BR為了換行 
				TemO.appendChild(newline);
				count++;
			}else{
				alert("最多只能五個tag");
			}
		}
	</script>
	<!-- 動態加input end-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
