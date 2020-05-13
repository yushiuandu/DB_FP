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
    <img src="../index/image/test-user.jpg" class="img-fluid rounded-circle" id="u-pic">
    <form method="post" action="../member/register_s.php" enctype="multipart/form-data">
    	<div class="form-row">
        <!-- 綽號 -->
        <div class="form-group col-md-6">
          <label>綽號</label>
          <input type="text" class="form-control" placeholder="請輸入您的綽號" name="nickname" required>
        </div>
        <!-- 生日 -->
        <div class="form-group col-md-6">
          <label for="exampleFormControlSelect1">你的生日</label>
          <input type="date" class="form-control" name="birthdate" required>
        </div>
          </div>   
      <!-- row end -->
        <!-- 密碼 -->
        <div class="form-group">
        <label>密碼</label>
        <input type="password" class="form-control" placeholder="注意:長度超過7個字，包含英文大小寫及數字" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,}" name="pass">
        </div>
        <!-- 信箱 -->
        <div class="form-group">
        <label>信箱</label>
        <input type="text" class="form-control" placeholder="@example.com" name="email">
        </div>
        <div class="right" style='margin-top:20px;'>
          <button type="update" class="btn btn-info font-weight-bold">編輯</button>
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