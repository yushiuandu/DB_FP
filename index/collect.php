<?php
    $link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");
	if(!$link){
		echo "no connect!";
    }
    #找出uid
	if(isset($_SESSION['nickname'])){
		$uid = finduid($_SESSION['nickname']);
    }

    $sql = "SELECT * 
            FROM `save` JOIN `article` JOIn `member`
            WHERE save.AId = article.AId and save.UId = '$uid'AND article.UId = member.UId
            ORDER BY `SId` DESC";
    $result = mysqli_query($link,$sql);
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
    <!-- 收藏 -->
    <body>
        <!-- 編輯收藏-->
        <div class='collect-set right pointer' data-toggle="modal" data-target="#collect">
            <p>setting <img src='../index/image/collect-set.png' class='collect-pic'></p>
        </div>

        <div class="modal fade bd-example-modal-sm match-ww middle" id="collect" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"> <!--centered重直置中-->
                <div class="modal-content match-page"> 
                    <!-- 配對頁面內容 -->
                    <p class="match-title">編輯收藏</p>
                    <div class="modal-body">
                        <div class='collect-add'>
                        <!-- 可以新增收藏選項並加入 -->
                            <form action = "../Article/Article.php?collect=add" method="post" id="form3">
                                <input type='text' name='collect' placeholder='請輸入分類名稱'>
                                <button type="submit" class="btn btn-sm btn-secondary">新增</button>
                            </form>
                        </div>
                        <div class='collect'>
                            <?php 
                                $sql_save = "SELECT * FROM `save_group` WHERE `UId` = '$uid'";
                                $result_save = mysqli_query($link,$sql_save);
                                $num = mysqli_num_rows($result_save);
                                while($row = mysqli_fetch_assoc($result_save)){
                            ?>
                            <!-- if有收藏 -->
                            <div class="row justify-content-start" id="collect_button">
                                <div class="col-md-6"> 
                                    <?php if($row['save_group'] != "ALL"){
                                        $Link = "../Article/save.php?delgroup=$row[save_group]";    
                                    ?>
                                    <p class="collect-view"><?=$row['save_group'];?><a href="<?=$Link;?>"><img src='../index/image/delete.png' type="delete" class='delete-pic pointer'></a></p>
                                    <?php }?>
                                </div>
                            </div>
                            <?php }
                            // <!-- if沒有收藏 -->
                            if($num == 0){
                                echo "<p class='collect-no'>你還沒有收藏喔！</p>";
                            }
                            ?>
                        </div>	
                    </div>
                    <!--下面選項-->
                    <div class='collect-fotter'>
                        <!-- 取消收藏 -->
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 編輯收藏end -->

        <!-- 全部收藏 -->
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 long" style="margin-bottom:20px;">
                <div class='tit'>
                    <p class='ww'>全部收藏</p>
                </div>
                <div class="con2">           
                    <?php
                        
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <!-- 文章 -->
                    <div class="bo pointer" onclick="location.href='../index/index.php?page=article&aid=<?=$row['AId']?>';">
                        <!-- 文章(上) -->
                        <div class="row art-head mid">
                            <!-- 作者-->
                            <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                                <div class='pic-container'>
                                    <!-- 作者頭像 -->
                                    <?php 
                                        if($row['anonymous'] == 1){
                                            echo '<a href="../index/index.php?page=nickname&uid='.$row['UId'].'">';	
                                    ?>
                                        <img src="data:pic/png;base64,<?=base64_encode($row["profile"]);?>" id="writer-pic"></a>
                                    <?php
                                        }else{ ?>
                                        <img src="../index/image/user.png" id="writer-pic">
                                    <?php	}//end else
                                    ?>
                                </div>
                                <!-- 作者名稱 -->
                                <p style="display: inline; font-size:2vmin; margin:0px;">
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
                        </div>
                        <!-- 文章(上) end-->
                        
                        <!-- 文章(下) -->
                        <div class="row art-body mid">
                            <!-- 標題 -->
                            <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                                <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'><?=$row['title'];?></p>
                                <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;"><?=$row['excerpt'];?></p>
                            </div>
                            <!-- 標題 end -->
                        </div>
                        <!-- 文章(下) end-->
                    </div>
                    <?php }//end while
                        }//end if
                        else{?>
                    <p>目前尚無收藏</p><?php } //end else?>
                    <!-- 文章 end -->
                </div>
            </div>
        </div>
        <!-- 全部收藏 end -->

        <!-- 收藏分類 -->
        <div class="row justify-content-start">
            <?php
                $sql = "SELECT * FROM `save_group` where `save_group` != 'ALL' AND `UId` = '$uid'";
                $result = mysqli_query($link, $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
            ?>
            <!-- 單個分類(1) -->
            <div class="col-lg-6 col-md-12" style="margin-bottom:20px;">
                <div class='tit'>
                    <p class='ww'><?=$row['save_group'];?></p>
                </div>
                <div class="con">
                    <?php 
                        $group = $row['save_group'];
                        $sql_a = "SELECT article.AId, article.category, article.title, article.excerpt, article.anonymous, article.post_name ,member.profile 
                                FROM `save` JOIN `article` JOIN `member`
                                WHERE article.AId = save.AId AND save.save_group = '$group' AND save.UId = '$uid' AND article.UId = member.UId
                                ORDER BY save.SId DESC";
                        $result_a = mysqli_query($link,$sql_a);
                        if($result_a){
                            $num = mysqli_num_rows($result_a);
                            while($row_a = mysqli_fetch_assoc($result_a)){
                    ?>
                    <!-- 文章 -->
                    <div class="bo2 pointer" onclick="location.href='../index/index.php?page=article&aid=<?=$row_a['AId']?>';">
                        <!-- 文章(上) -->
                        <div class="row art-head mid">
                            <!-- 作者-->
                            <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                                <div class='pic-container'>
                                    <!-- 作者頭像 -->
                                    <?php 
                                        if($row_a['anonymous'] == 1){
                                            echo '<a href="../index/index.php?page=nickname&uid='.$row_a['UId'].'">';	
                                    ?>
                                        <img src="data:pic/png;base64,<?=base64_encode($row_a["profile"]);?>" id="writer-pic"></a>
                                    <?php
                                        }else{ ?>
                                        <img src="../index/image/user.png" id="writer-pic">
                                    <?php	}//end else
                                    ?>
                                </div>
                                <!-- 作者名稱 -->
                                <p style="display: inline; font-size:2vmin; margin:0px;">
                                <?php
                                    if ($row_a['anonymous'] == 0){
                                        echo '匿名';
                                    }else{
                                        echo $row_a['post_name'];
                                    }
                                ?>
                                </p>
                            </div>
                            <!-- 作者 end-->
                        </div>
                        <!-- 文章(上) end-->
                        
                        <!-- 文章(下) -->
                        <div class="row art-body mid">
                            <!-- 標題 -->
                            <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                                <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'><?=$row_a['title'];?></p>
                                <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;"><?=$row_a['excerpt'];?></p>
                            </div>
                            <!-- 標題 end -->
                        </div>
                        <!-- 文章(下) end-->
                    </div>
                    <!-- 文章 end -->
                    <?php } //end article while
                            if($num == 0){echo '<p>目前尚無收藏</p>';}
                        }//end article if
                        ?>
                </div>
            </div>
            <?php   
                   }//end group while
                }//end group if
            ?>
            <!-- 單個分類(1) end -->
        </div>
        <!-- 收藏分類 end -->

        <script>

            function prevent_reloading(){
			var pendingRequests = {};
				jQuery.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
					var key = options.url;
					console.log(key);
					if (!pendingRequests[key]) {
						pendingRequests[key] = jqXHR;
					}else{
						//jqXHR.abort();    //放棄後觸發的提交
						pendingRequests[key].abort();   // 放棄先觸發的提交
					}
					var complete = options.complete;
					options.complete = function(jqXHR, textStatus) {
						pendingRequests[key] = null;
						if (jQuery.isFunction(complete)) {
						complete.apply(this, arguments);
						}
					};
				});
			}

            $("#form3").on("submit", function(e) {
			var form = $(this);
			var url = form.attr('action');
			console.log(form.serialize());

			$.ajax({
				type: "POST",
				url: url,
				data:form.serialize(),
				dataType :"json"
            }).done(function(data) {
				console.log(data);
				if(data['success'] == "OK"){
                    console.log(data);
					var group = data['group'];
					var content = '<div class="col-md-6"><p class="collect-view">'+group+'<a href="../Article/save.php?group='+group+'"><img src="../index/image/delete.png" type="delete" class="delete-pic pointer"></a></p></div>';
					console.log(content);
					$('#collect_button').append(content);
				}
			});

			e.preventDefault(); // avoid to execute the actual submit of the form.
			
		});
        
        </script>
	
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>