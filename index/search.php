
<?php
    $_SESSION['local'] = '../index/index.php?page=search';

    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
	echo "no connect!";
    }
    
    if(isset($_GET['search'])){
        $search = $_GET['search'];
    }else{
        $search = "all";
    }
    
    // 關鍵詞
    if(isset($_POST['key'])){
        $key = $_POST['key'];
        // echo $key;
        $_SESSION['key'] = $key;
        header("Location:../index/index.php?page=search&key=$key");
    }else{
        $key = "";
    }

    if(isset($_GET['key'])){
        $_SESSION['key'] = $_GET['key'];
    }else{
        $key="";
    }
    
    if(isset($_SESSION['nickname'])){
        $uid = finduid($_SESSION['nickname']);
    }
    if(isset($_SESSION['key'])){
        $key = $_SESSION['key'];
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
    <!-- 按鈕選項( 全部、文章、看板、話題、話題) -->
    <div class="row justify-content-center">
        <div class="col-md-12 bt">
            <!-- now是現在在地分頁 -->
            <div class="btnn pointer <?php if($search == 'all'){ echo 'now';}?>" onclick="location.href='../index/index.php?page=search&search=all';">全部</div>
            <div class="btnn pointer <?php if($search == 'article'){ echo 'now';}?>" onclick="location.href='../index/index.php?page=search&search=article';">文章</div>
            <div class="btnn pointer <?php if($search == 'forum'){ echo 'now';}?>" onclick="location.href='../index/index.php?page=search&search=forum';">看板</div>
            <div class="btnn pointer <?php if($search == 'tag'){ echo 'now';}?>" onclick="location.href='../index/index.php?page=search&search=tag';">話題</div>
            <div class="btnn pointer <?php if($search == 'nickname'){ echo 'now';}?>" onclick="location.href='../index/index.php?page=search&search=nickname';">暱稱</div>
        </div>
    </div>
    <!-- 按鈕選項( 全部、文章、看板、話題、話題)end -->

    <!-- 全部按鈕 -->
    <?php if($search == 'all'){
    ?>
    <!-- 文章 -->
    <div class='search-article'>
        <div class="row justify-content-start">
            <div class="col-md-12">
                <p class='search-title'>文章</p>
            </div>
            <!-- 文章區 -->
            <div class='ser-con'>

                <!-- if 有搜尋結果 -->
                <!-- 文章 -->
                <?php 
                    $sql = "SELECT * FROM `article` JOIN `member`
                            WHERE article.title LIKE '%$key%' AND article.UId = member.UId
                            ORDER BY article.post_time DESC LIMIT 3";
                    $result = mysqli_query($link, $sql);
                    $num = 0;
                    if($result){
                        $num = mysqli_num_rows($result);
                    }
                    if($num>0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="art2 pointer" onclick="location.href='../index/index.php?page=article&aid=<?=$row['AId'];?>'">
                    <div class="row art-head justify-content-start">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <?php if($row['anonymous'] == 1){?>
                                <!-- 作者頭像 -->
                                <div class='pic-container'>
                                    <a href="../index/index.php?page=nickname&uid=<?=$row["UId"];?>">
                                    <img src="data:pic/png;base64,<?=base64_encode($row["profile"]);?>" id="writer-pic"></a>
                                </div>
                                <!-- 作者名稱 -->
                                <p style="display: inline; font-size:2vmin; margin:0px;"><?=$row["Nickname"];?></p>
                            <?php }else if ($row['anonymous'] == 0){?>
                                <div class='pic-container'>
                                    <img src="../index/image/user.png" id="writer-pic">
                                </div>
                                <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                            <?php }?>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 簡圖內容(上) end-->
                    
                    <!-- 簡圖內容(中) -->
                    <div class="row art-body justify-content-start">
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <!-- 標題 -->
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'><?=$row['title'];?></p>
                            <!-- 簡述 -->
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;"><?=$row['excerpt'];?></p>
                        </div>
                    </div>
                    <!-- 簡圖內容(中) end-->
                </div>
                <!-- 文章 end-->
               
                <!-- if 有搜尋結果 end-->
                <?php }//end while 
                        // echo '<a href="../index/index.php?page=search&search=article" style="text-decoration:none"><p class="ser-fot pointer">查看更多</p></a>';
                        }//end if num
                        // 沒有搜尋結果
                       else{
                            echo '<p class="no-result">沒有搜尋結果</p>';
                       } ?>
            </div>
            <!-- 文章區end -->
        </div>
    </div>

    <!-- 看板+暱稱 -->
    <div class='search-article2'>
        <div class="row justify-content-center">   
            <!-- 看板 -->
            <div class='search-nickname'>
                <div class="col-md-6">
                    <p class='search-title'>看板</p>
                </div>
                <!-- 看板內容 -->
                <div class='ser-con left'>
                    
                    <!-- if 有搜尋結果 -->
                    <?php
                         $sql = "SELECT `category`,`eng` FROM `forumid` WHERE `category` LIKE '%$key%' LIMIT 3";
                         $result = mysqli_query($link, $sql);
                         if($result){
                             if((mysqli_num_rows($result)) > 0 ){
                                 while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <!-- 一個看板 -->
                    <div class='row justify-content-start art2 pointer'>
                        <div class="col-md-8">
                        <a href="../index/index.php?page=index&id=<?=$row['eng'];?>">
                            <p class='ser-ww'><?=$row['category'];?></p></a>
                        </div>
                        <div class="col-md-4 right">
                            <?php
                                $Link = "../Article/follow.php?forum=".$row['eng'];
                                if(isset($_SESSION['nickname'])){
                                    $sql_forum = "SELECT * FROM `follow` WHERE `category` = \"$row[eng]\" AND `UId` = \"$uid\"";
                                    $result_forum = mysqli_query($link,$sql_forum);
                                    $num = mysqli_num_rows($result_forum);
                                }else{
                                $num  = 0;}

                                if($num == 0 and isset($_SESSION['nickname'])){
                            ?>
                            <div class='ser-btn pointer follow_forum' data-url="<?=$Link?>">Follow</div>
                            <?php }else if (isset($_SESSION['nickname'])){ ?>
                                <div class='follow_forum ser-btn pointer' data-url="<?=$Link?>">Following</div>
                            <?php }?>
                        </div>
                    </div>
                    <!-- 一個看板end -->
                    
                    <!-- if 有搜尋結果 end-->
                    
                    <?php
                                }//end while
                                // echo '<a href="../index/index.php?page=search&search=forum" style="text-decoration:none"><p class="ser-fot pointer">查看更多</p></a>';
                            }//end num if
                            // 沒有搜尋結果
                            else if((mysqli_num_rows($result)) == 0 ){?>
                            <!-- if沒有搜尋結果 -->
                            <p class='no-result'>沒有搜尋結果</p>
                            <!-- if沒有搜尋結果 end -->
                                
                    <?php       }
                        }//end result if?>
                </div>
                <!-- 看板內容end -->
            </div>
            <!-- 看板end -->
            
            <!-- 暱稱 -->
            <div class='search-nickname'>
                <div class="col-md-6">
                    <p class='search-title'>暱稱</p>
                </div>
                <!-- 暱稱內容 -->
                <div class='ser-con left'>

                    <!-- if 有搜尋結果-->
                    <?php 
                        $sql = "SELECT DISTINCT `Nickname` ,`UId`FROM `member` WHERE `Nickname` LIKE '%$key%' LIMIT 3";
                        $result = mysqli_query($link, $sql);
                        if($result){
                            if((mysqli_num_rows($result)) > 0 ){
                                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <!-- 一個暱稱 -->
                    <div class='row justify-content-start art2 pointer' >
                        <div class="col-md-8">
                            <a href="../index/index.php?page=nickname&uid=<?=$row['UId'];?>">
                            <p class='ser-ww'><?=$row['Nickname'];?></p></a>
                        </div>
                        <div class="col-md-4 right">
                            <?php 
                                $Link = "../Article/follow.php?followuid=$row[UId]";
                                if(isset($_SESSION['nickname'])){
                                    $sql_n = "SELECT * FROM `follow` WHERE `follow_id` = \"$row[UId]\" AND `UId` = \"$uid\"";
                                    $result_n = mysqli_query($link,$sql_n);
                                    $num = mysqli_num_rows($result_n);
                                }else{$num  = 0;}

                                if($num == 0 and isset($_SESSION['nickname'])){
                                    if(($uid != $row["UId"]) ){
                            ?>
                            <div class='ser-btn pointer follow_nickname'data-url="<?=$Link;?>">Follow</div>
                            <?php } }else if( isset($_SESSION['nickname'])){ ?>
                                <div class='follow_nickname ser-btn pointer' data-url="<?=$Link;?>">Following</div>
                            <?php }?>
                        </div>
                    </div>
                    <!-- 一個暱稱end -->
                    
                    <!-- if 有搜尋結果 end-->
                    <!------------------------------------------------------------------->
                    <?php
                            }//end while
                            // echo '<a href="../index/index.php?page=search&search=nickname" style="text-decoration:none"><p class="ser-fot pointer">查看更多</p></a>';
                        }//end num if
                        else{
                            echo '<p class="no-result">沒有搜尋結果</p>';
                       }
                    }//end result if?>
                </div>
                <!-- 暱稱內容end -->
            </div>
            <!-- 暱稱end -->
        </div>
    </div>
    <!-- 看板+暱稱end -->

    <!-- 話題 -->
    <div class='search-article'>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p class='search-title'>話題</p>
            </div>
            <!-- 話題內容 -->
            <div class='ser-con left'>
                
                <!-- if 有搜尋結果 -->
                    <?php 
                        $sql = "SELECT DISTINCT tag FROM `article_tag`  WHERE `tag` LIKE '%$key%' LIMIT 3";
                        $result = mysqli_query($link, $sql);
                        if($result){
                            if((mysqli_num_rows($result)) > 0 ){
                                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class='row justify-content-start art2 pointer'>
                        <div class="col-md-8">
                            <a href="../index/index.php?page=tag&tag=<?=$row['tag'];?>">
                            <p class='ser-ww'>#<?=$row['tag'];?></p></a>
                        </div>
                        <div class="col-md-4 right">
                            <?php   $Link = "../Article/follow.php?tag=".$row['tag']; 
                                    if(isset($_SESSION['nickname'])){
                                        $sql_tag = "SELECT * FROM `follow` WHERE `tag` = \"$row[tag]\" AND `UId` = \"$uid\"";
                                        $result_tag = mysqli_query($link,$sql_tag);
                                        $num = mysqli_num_rows($result_tag);
                                    }else{
                                    $num  = 0;}

                                    if($num == 0 and isset($_SESSION['nickname'])){
                            ?>
                            <div class='follow ser-btn pointer' data-url="<?=$Link?>">Follow</div>
                            <?php }else if (isset($_SESSION['nickname'])){ ?>
                                <div class='follow ser-btn pointer' data-url="<?=$Link?>">Following</div>
                            <?php }?>
                        </div>
                    </div>
                    <!-- 一個話題end -->
                    
                    <!-- if 有搜尋結果 end-->
                    <!------------------------------------------------------------------->
                    <?php
                            }//end while
                            // echo '<a href="../index/index.php?page=search&search=tag" style="text-decoration:none"><p class="ser-fot pointer">查看更多</p></a>';
                        }//end num if
                        else{
                            echo '<p class="no-result">沒有搜尋結果</p>';
                       }
                    }//end result if?>
                
                </div>
            </div>
            <!-- 話題內容end -->
        </div>
    <!-- 話題end -->
    <!-- 全部按鈕end -->
    <?php }?>
    
    <?php if($search == 'article'){ 
    ?>
    <!-- 文章按鈕 -->
    <div class='sm-article'>
        <div class="row justify-content-start mid">
            <div class="col-md-9">
                <p class='search-title'>文章</p>
            </div>
            <div class="col-md-3 right">
                <!-- 熱門文章 -->
				<div class='ser-btn pointer' onclick="location.href='../index/index.php?page=search&search=article&hot=true'" >HOT</div>
			    <!-- 最新文章 -->
			    <div class='ser-btn pointer' onclick="location.href='../index/index.php?page=search&search=article'" >NEW</div>
            </div>
            
            <!-- 文章區 -->
            <div class='ser-con2'>

                <!-- if 有搜尋結果 -->
                <!-- 文章 -->
                <?php 
                    if(isset($_GET['hot'])){
                        $sql = "SELECT * FROM `article` JOIN `member`
                                WHERE article.title LIKE '%$key%' and member.UId = article.UId
                                ORDER BY article.agree DESC LIMIT 20";
                    }else{
                        $sql = "SELECT * FROM `article` JOIN `member`
                                WHERE article.title LIKE '%$key%' and member.UId = article.UId
                                ORDER BY article.post_time DESC LIMIT 20";
                    }
                    $result = mysqli_query($link, $sql);
                    if($result){
                        if((mysqli_num_rows($result)) > 0 ){
                            while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="art2 pointer" onclick="location.href='../index/index.php?page=article&aid=<?=$row['AId'];?>'" >
                    <div class="row art-head justify-content-start">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <!-- 匿名 -->
                            <?php if($row['anonymous'] == 0){?>
                                <!-- 作者頭像 -->
                                <div class='pic-container'>
                                    <img src="../index/image/user.png" id="writer-pic">
                                </div>
                                <!-- 作者名稱 -->
                                <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>

                            <!-- 不匿名 -->
                            <?php }else if($row['anonymous'] == 1){ ?>
                                <!-- 作者頭像 -->
                                <div class='pic-container'>
                                    <a href="../index/index.php?page=nickname&uid=<?php echo $row['UId'];?>" >
                                    <img src="data:pic/png;base64,<?=base64_encode($row["profile"]);?>" id="writer-pic"></a>
                                </div>
                                <!-- 作者名稱 -->
                                <p style="display: inline; font-size:2vmin; margin:0px;"><?php echo $row['Nickname'];?></p>
                            <?php } ?>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 簡圖內容(上) end-->
                    
                    <!-- 簡圖內容(中) -->
                    <div class="row art-body justify-content-start">
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <!-- 標題 -->
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'><?php echo $row['title'];?></p>
                            <!-- 簡述 -->
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;"><?php echo $row['excerpt'];?></p>
                        </div>
                    </div>
                    <!-- 簡圖內容(中) end-->
                </div>
                <!-- 文章 end-->
                <!-- if 有搜尋結果 end-->
                <!------------------------------------------------------------------->
                <?php
                            }//end while
                        }//end num if
                        else{
                            echo '<p class="no-result">沒有搜尋結果</p>';
                       }
                    }//end result if?>
            </div>
            <!-- 文章區end -->
        </div>
    </div>
    <!-- 文章按鈕end -->

    <?php              
            }?>
    <?php if($search == 'forum'){ ?>
    <!-- 看板按鈕 -->
     <div class='sm-article'>
        <div class="row justify-content-start">
            <div class="col-md-12">
                <p class='search-title'>看板</p>
            </div>
            <!-- 看板內容 -->
            <div class="ser-con2 left">
                <!-- if有搜尋結果 -->
                <?php 
                    $sql = "SELECT DISTINCT `category`, `eng` FROM `forumid` WHERE `category` LIKE '%$key%' ";
                    $result = mysqli_query($link, $sql);
                    if($result){
                        if((mysqli_num_rows($result)) > 0 ){
                            while($row = mysqli_fetch_assoc($result)){
                ?>
                <!-- 一個看板 -->
                <div class='row justify-content-start art2 pointer'>
                    <div class="col-md-8">
                        <a href="../index/index.php?page=index&id=<?=$row['eng'];?>">
                        <p class='ser-ww'><?php echo $row['category']; ?></p></a>
                    </div>
                    <div class="col-md-4 right">
                        <?php
                            $Link = "../Article/follow.php?forum=".$row['eng'];
                            if(isset($_SESSION['nickname'])){
                                $sql_forum = "SELECT * FROM `follow` WHERE `category` = \"$row[eng]\" AND `UId` = \"$uid\"";
                                $result_forum = mysqli_query($link,$sql_forum);
                                $num = mysqli_num_rows($result_forum);
                            }else{
                            $num  = 0;}

                            if($num == 0 and isset($_SESSION['nickname'])){
                        ?>
                        <div class='ser-btn pointer follow_forum' data-url="<?=$Link?>">Follow</div>
                        <?php }else if(isset($_SESSION['nickname'])){ ?>
                            <div class='follow_forum ser-btn pointer' data-url="<?=$Link?>">Following</div>
                        <?php }?>
                    </div>
                </div>
                <!-- 一個看板end -->
                
                <!-- if 有搜尋結果 end-->
                <!------------------------------------------------------------------->
                <?php
                            }//end while
                        }//end num if
                        else{
                            echo '<p class="no-result">沒有搜尋結果</p>';
                       }
                    }//end result if?>
            </div>
            <!-- 看板內容end -->
        </div>
    </div>
    <!-- 看板按鈕end -->

    <?php }?>
    
    <?php if($search == 'nickname'){ ?>
    <!-- 暱稱按鈕 -->
    <div class='sm-article'>
        <div class="row justify-content-start">
            <div class="col-md-12">
                <p class='search-title'>暱稱</p>
            </div>
            <!-- 暱稱內容 -->
            <div class='ser-con2 left'>

                <!-- if 有搜尋結果 -->
                <?php 
                    $sql = "SELECT DISTINCT `Nickname` ,`UId`FROM `member` WHERE `Nickname` LIKE '%$key%' ";
                    $result = mysqli_query($link, $sql);
                    if($result){
                        if((mysqli_num_rows($result)) > 0 ){
                            while($row = mysqli_fetch_assoc($result)){
                ?>
                <!-- 一個暱稱 -->
                <div class='row justify-content-start art2 pointer'>
                    <div class="col-md-8">
                        <a href="../index/index.php?page=nickname&uid=<?=$row['UId'];?>" >
                        <p class='ser-ww'><?php echo $row['Nickname'];?></p></a>
                    </div>
                    <div class="col-md-4 right">
                        <?php 
                            $Link = "../Article/follow.php?followuid=$row[UId]";
                            if(isset($_SESSION['nickname'])){
                                $sql_n = "SELECT * FROM `follow` WHERE `follow_id` = \"$row[UId]\" AND `UId` = \"$uid\"";
                                $result_n = mysqli_query($link,$sql_n);
                                $num = mysqli_num_rows($result_n);
                            }else{$num  = 0;}
                            if($num == 0 and isset($_SESSION['nickname'])){
                                if($uid != $row["UId"]){
                        ?>
                        <div class='ser-btn pointer follow_nickname'data-url="<?=$Link;?>">Follow</div>
                        <?php } }else if(isset($_SESSION['nickname'])){ ?>
                            <div class='follow_nickname ser-btn pointer' data-url="<?=$Link;?>">Following</div>
                        <?php }?>
                    </div>
                </div>
                <!-- 一個暱稱end -->
                
                <!-- if 有搜尋結果 end-->
                <!------------------------------------------------------------------->
                <?php
                            }//end while
                        }//end num if
                        else{
                            echo '<p class="no-result">沒有搜尋結果</p>';
                       }
                    }//end result if?>
            </div>
            <!-- 暱稱內容end -->
        </div>
    </div>
    <!-- 暱稱按鈕end -->

    <?php }?>
    <?php if($search == 'tag'){ ?>
    <!-- 話題按鈕 -->
    <div class='sm-article'>
        <div class="row justify-content-start">
            <div class="col-md-12">
                <p class='search-title'>話題</p>
            </div>
            <!-- 話題內容 -->
            <div class='ser-con2 left'>

                <!-- if 有搜尋結果 -->
                <?php 
                    $sql = "SELECT DISTINCT tag FROM `article_tag`  WHERE `tag` LIKE '%$key%' ";
                    $result = mysqli_query($link, $sql);
                    if($result){
                        if((mysqli_num_rows($result)) > 0 ){
                            while($row = mysqli_fetch_assoc($result)){
                ?>
                <!-- 一個話題 -->
                <div class='row justify-content-start art2 pointer'>
                    <div class="col-md-8">
                        <a href="../index/index.php?page=tag&tag=<?=$row['tag'];?>">
                        <p class='ser-ww'>#<?php echo $row['tag'];?></p></a>
                    </div>
                    <div class="col-md-4 right">
                        <?php   $Link = "../Article/follow.php?tag=".$row['tag']; 
                                if(isset($_SESSION['nickname'])){
                                    $sql_tag = "SELECT * FROM `follow` WHERE `tag` = \"$row[tag]\" AND `UId` = \"$uid\"";
                                    $result_tag = mysqli_query($link,$sql_tag);
                                    $num = mysqli_num_rows($result_tag);
                                }else{
                                $num  = 0;}

                                if($num == 0 and isset($_SESSION['nickname'])){
                        ?>
                        <div class='follow ser-btn pointer' data-url="<?=$Link?>">Follow</div>
                        <?php }else if( isset($_SESSION['nickname'])){ ?>
                            <div class='follow ser-btn pointer' data-url="<?=$Link?>">Following</div>
                        <?php }?>
                    </div>
                </div>
                <!-- 一個話題end -->
                <!-- if 有搜尋結果 end-->
                <!------------------------------------------------------------------->
                <?php
                            }//end while
                        }//end num if
                        else{
                            echo '<p class="no-result">沒有搜尋結果</p>';
                       }
                    }//end result if?>
            </div>
            <!-- 話題內容end -->
        </div>
    </div>
    <!-- 話題按鈕end -->

    <?php }?>

    <script>
    <?php if(isset($_SESSION)){?>
    // 追蹤tag
        $(".follow").click(function(){
            var url = $(this).data("url");
            var eq = $(".follow").index($(this));

            console.log(eq);
            $.ajax({
                type: 'POST',
				url: url,
				data: {type : "ajax"},
				dataType :"json"
            }).done(function(data) {
				console.log(data);
				if(data['success'] == "OK"){
						$(".follow").eq(eq).html("Following");
						// console.log("black");
					}else if(data['success'] == "DEL_OK"){
						$(".follow").eq(eq).html("Follow");
						// console.log("white");
					}
			});
        });
    // 追蹤看板
        $(".follow_forum").click(function(){
            var url = $(this).data("url");
            var forum = $(".follow_forum").index($(this));

            // console.log(f);
            $.ajax({
                type: 'POST',
				url: url,
				data: {type : "ajax"},
				dataType :"json"
            }).done(function(data) {
				console.log(data);
				if(data['success'] == "OK"){
						$(".follow_forum").eq(forum).html("Following");
						// console.log(f);
					}else if(data['success'] == "DEL_OK"){
						$(".follow_forum").eq(forum).html("Follow");
						// console.log("white");
					}
			});
        });
        
        // 追蹤暱稱
        $(".follow_nickname").click(function(){
            var url = $(this).data("url");
            var nickname = $(".follow_nickname").index($(this));

            console.log(nickname);
            $.ajax({
                type: 'POST',
				url: url,
				data: {type : "ajax"},
				dataType :"json"
            }).done(function(data) {
				console.log(data);
				if(data['success'] == "OK"){
						$(".follow_nickname").eq(nickname).html("Following");
						console.log(nickname);
					}else if(data['success'] == "DEL_OK"){
						$(".follow_nickname").eq(nickname).html("Follow");
						// console.log("white");
					}
			});
        });

   <?php  }?>
    </script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>