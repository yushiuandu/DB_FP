<?php
    #connect to sql
	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
	if(!$link){
		echo "no connect!";
    }
    
    if(isset($_GET['tag'])){
		$tag = $_GET['tag'];
		$_SESSION['local'] = "../index/index.php?page=tag&tag=$tag";
    }

    #找到UId
	include("../index/forum.php");
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
    }
    
    if(isset($_GET['tlatest'])){
        $tlatest = $_GET['tlatest'];
    }else{
        $tlatest = 'false';
    }
    if(isset($_GET['thot'])){
        $thot = $_GET['thot'];
    }else{
        $thot = 'false';
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
    
    
		<!-- 上面的按鈕 -->
		<div class="row">
			<div class="col-md-10 col-sm-10 col-10">
			  <p class='board'>#<?php echo $tag;?></p>
			</div>
		
			<div class="col-md-2 col-sm-2 col-2 right mid">
				<?php 
					$sql_tag = "SELECT * FROM `follow` WHERE `UId`=\"$uid\" AND `Tag` = \"$tag\"";
					$result_tag = mysqli_query($link, $sql_tag);
					$num = mysqli_num_rows($result_tag);
					if($num == 0){
				?>
					<a href="../Article/follow.php?tag=<?php echo $tag;?>">
					<button type="button" class="btn btn-sm btn-info">追蹤此標籤</button></a>
				<?php
					}else{
				?>
					<a href="../Article/follow.php?tag=<?php echo $tag;?>">
					<button type="button" class="btn btn-sm btn-info">✔已追蹤</button></a>
					<?php }?>
		  	</div>
		  	
		</div>

  		<div class="row mid">
			<div class="btn-group col-md-2 col-sm-3 col-3" role="group" aria-label="Button group with nested dropdown">
				<!-- 排序 -->
				<button id="btnGroupDrop1" type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  					排序</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				<?php
					echo '<a class="dropdown-item" href="../index/index.php?page=tag&tag='.$tag.'&thot=true">熱門</a>';
					echo '<a class="dropdown-item" href="../index/index.php?page=tag&tag='.$tag.'&tlatest=true">最新</a>';
                ?>
				</div>
			</div>
			<div class="col-md-5"></div>
		
		</div>
		<!-- 上面的按鈕 end-->

		
		<!-- 顯示文章 -->
        <?php 
           
            
            if($tlatest == "true" ){
                $sql = "SELECT *
                FROM `article_tag` AS T JOIN `article` AS A
                WHERE T.AId = A.AId AND T.tag = \"$tag\"
                ORDER BY A.post_time DESC";
            }else if($thot == "true"){
                $sql = "SELECT *
                FROM `article_tag` AS T JOIN `article` AS A
				WHERE T.AId = A.AId AND T.tag = \"$tag\"
				ORDER BY A.agree DESC";
            }else{
                $sql = "SELECT *
                FROM `article_tag` AS T JOIN `article` AS A
                WHERE T.AId = A.AId AND T.tag = \"$tag\"
                ORDER BY A.agree DESC";
            }

            $result = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result)){
        ?>
		
			<div class="art pointer" onclick="location.href='../index/index.php?page=article&aid=<?php echo $row['AId']; ?>';">
				<!-- 簡圖內容(上) -->
				<div class="row art-head mid">
					<!-- 作者-->
					<div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
						<!-- 作者頭像 -->
						<div class='pic-container'>
						<?php 
							if($row['anonymous'] == 1){
								echo '<a href="../index/index.php?page=nickname&uid='.$row['UId'].'">';	
						?>
							<img src="data:pic/png;base64,<?=base64_encode($row["profile"]);?>"` id="writer-pic"></a>
						<?php
							}else{ ?>
								<img src="../index/image/user.png"` id="writer-pic">
						<?php	}//end else
						?>
						</div>
						<!-- 作者名稱 -->
						<p class='name'>
							<?php
								if ($row['anonymous'] == 0){
									echo '匿名';
								}else{
									echo $row['post_name'];
								}
							?>
						</p>
					</div>
					<!-- 作者 end-->

					<!-- 按讚數 --> 
					<div class="col-md-2 col-sm-3 col-3 right">
						<h7 style="display: inline;"><?php echo $row['agree'];?></h7>
						<?php 

						
							if(isset($_SESSION['nickname'])){
								$sql_good = "SELECT * FROM `good` WHERE `UId` = \"$uid\" AND `AId` = \"$row[AId]\"";
								$result_good = mysqli_query($link,$sql_good);
								$row_good = mysqli_fetch_assoc($result_good);
								$num = mysqli_num_rows($result_good);

								$Link = "../Article/good.php?aid=".$row['AId'];
								
								if($num > 0){
									echo '<img src="../index/image/good-black.png" class="good_article img-fluid " data-url="'.$Link.'" id="good-pic">';
							}else{
								echo '<img src="../index/image/good-white.png" class="good_article img-fluid" data-url="'.$Link.'" id="good-pic">';
							}
						}else{
							echo '<img src="../index/image/good-white.png" class="img-fluid" id="good-pic">';
						}
					?>
						<!-- <img src="./image/good-white.png" class="img-fluid" id="good-pic"> -->
					</div>
					<!-- 按讚數 end-->
				</div>
				<!-- 簡圖內容(上) end-->
				
				<!-- 簡圖內容(中) -->
				<div class="row art-body mid">
					<!-- 標題 -->
					<div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
						<p class="font-weight-bold" style='font-size:3vmin; margin:0px;'><?php echo $row['title'];?></p>
						<p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
						<?php 
							echo $row['excerpt'];
						?>
						</p>
					</div>
					<!-- 標題 end -->

					<!-- 圖檔 -->
					<!-- <div class="col-md-3 col-sm-3 col-4 col-lg-3" >
						<img src="./image/article-pic.jpg" id="article-pic">
					</div> -->
					<!-- 圖檔 end -->
				</div>
				<!-- 簡圖內容(中) end-->
				
				<!-- 簡圖內容(下) -->
				<div class="row art-fotter mid">
					<!-- 看板 - 發文時間 -->
					<div class="col-md-12 col-sm-12 col-12">
						<p style=' font-size:1.75vmin; margin:0px; color:gray;'>
							<?php
								$category = findForum($row['category']);
								echo "<a href = '../index/index.php?page=index&id=".$row['category']."' style = 'color:gray;text-decoration:none;'>".$category."</a>";
								echo ' - ';
								echo date('Y-m-d H:i',strtotime($row['post_time']));
							?>
						</p>
					</div>
					<!-- 看板 - 發文時間 end -->
				</div>
				<!-- 簡圖內容(下) end-->
			</div>
			<!-- 文章簡圖區 end-->
        
                        <?php }//end while?>
		<!-- 文章區 -->
    
    </body>

</html>