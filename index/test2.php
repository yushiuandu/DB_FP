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
  <!-- 心理測驗-2 -->
  <body>
    <div class='test'>
		<?php 
			// $random = rand(1,25);
			// echo $random;

			$choice = array("A","B","C","D","E","F");

			$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
			if(!$link){
			echo "no connect!";
			}
		
			$sql = "SELECT * 
					FROM `test` AS T JOIN `ans` AS A 
					WHERE T.testid = 25 AND A.testid = 25";

			$result = mysqli_query($link,$sql);
			$num =  mysqli_num_rows($result);
			echo $num;
			$row = mysqli_fetch_assoc($result);
		?>

		<div class='question'>
			<!-- 第18題 -->
			<p class='test2-ww'><?=$row['title'];?></p>
		</div>
		<div class='q2'>
			<div class='choose row justify-content-end'>
				<div class="form-group">
					<form action="../index/index.php?page=test-result&tid=<?=$row['testid'];?>" method="post">
						<select class="form-control form-control-sm " id="choice" name="choice" required style=" width: 100px;">
							<option selected disabled>你的選擇?</option>
							<?php for($i = 0; $i < $num ; $i++ ){
								echo '<option value="'.($i+1).'">'.$choice[$i].'</option>';}
							?>
						</select>
						<button type="submit" class="btn btn-secondary btn-sm choice">送出</button>
					</form>
				</div>
			</div>
		</div>
		<div class='row justify-content-center'>
			<?php
				for($i = 0; $i < $num ; $i++){ ?>
				<div class="col-md-6 col-sm-6 col-6">
					<div class='op mid <?=$choice[$i]?>'>
						<p class='test3-ww'><?=$row['choice'];?></p>
					</div>
				</div>

			<?php
				$row = mysqli_fetch_assoc($result);} 
			?>
		</div>
    </div>
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>