<!-- 如果按還不是會員 會跳轉到 member/login.php的頁面 -->
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
    <link href="../index/my.css" rel="stylesheet" type="text/css">
    <title>抬槓</title>
</head>
  <body>
  <!-- 註冊頁面 -->
    <div id='register' >
    <!-- 左半邊 -->
      <div id='re1' class='d-none d-md-block'>
        <img src='./image/test.png' id="test-pic">
        <div id="slogan">想要交到契合的朋友嗎?</div>
        <div id="slogan">來抬槓用心理測驗</div>
        <div id="slogan">交朋友吧!</div>
      </div>
      <!-- 左半邊 end -->
      <!-- 右半邊 -->
      <div id='re2'>
        <form method="post" action="../member/register_s.php" enctype="multipart/form-data" id='form'>
        	<div class="form-row">
				<!-- 姓名 -->
				<div class="form-group col-md-6 ">
					<label>你的姓名</label>
					<input type="name" class="form-control" placeholder="請輸入您的姓名" name="Name" required>
				</div>
				<!-- 性別 -->
				<div class="form-group col-md-6">
					<label for="gender">你的性別</label>
					<select class="form-control" id="gender" type="gender" required name="gender">
					<option selected>選擇你的性別...
					<option value="1">我是男生
					<option value="2">我是女生
					</select>
				</div>
				<!-- 綽號 -->
				<div class="form-group col-md-6">
					<label for='nickname'>取個綽號</label>
					<input id='nickname' type="text" class="form-control" placeholder="請輸入您的綽號" name="nickname" required>
				</div>
				<!-- 生日 -->
				<div class="form-group col-md-6">
					<label for='birthday'>你的生日</label>
					<input id='birthday' type="date" class="form-control" name="birthdate" required min="1990-01-01" max="2003-12-30">
				</div>
        	</div>   
			<!-- row end -->
			<!-- 帳號 -->
			<div class="form-group">
				<label>帳號</label>
				<input type="text" class="form-control" placeholder="注意:長度為10個字元以內" maxlength="10" required name="Account">
			</div>
			<!-- 密碼 -->
			<div class="form-group">
				<label>密碼</label>
				<input type="password" class="form-control" placeholder="注意:長度超過7個字，包含英文大小寫及數字" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}" name="pass">
			</div>
			<!-- 信箱 -->
			<div class="form-group">
				<label>信箱</label>
				<input type="text" class="form-control" placeholder="@example.com" name="email" required>
			</div>
			<div class="form-group">
				<label>你的照片</label> <br>
				<input id="upload" Type="File" Name="YouFile" accept="image/*" @change="showFile" required>
			</div>
        	<button type="submit" class="btn btn-info font-weight-bold">註冊</button>
      </form>
      </div>
      <!-- 右半邊 end-->
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>