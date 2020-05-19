
<?php
    //$key = $_GET["key"];

    
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
            <div class="btnn pointer now" onclick="location.href='../index/index/?page=search&';">全部</div>
            <div class="btnn pointer" onclick="location.href='../index/index/?page=search&';">文章</div>
            <div class="btnn pointer" onclick="location.href='../index/index/?page=search&';">看板</div>
            <div class="btnn pointer" onclick="location.href='../index/index/?page=search&';">話題</div>
            <div class="btnn pointer" onclick="location.href='../index/index/?page=search&';">話題</div>
        </div>
    </div>
    <!-- 按鈕選項( 全部、文章、看板、話題、話題)end -->

    <!-- 全部按鈕 -->
    <!-- 文章 -->
    <div class='search-article'>
        <div class="row justify-content-start">
            <div class="col-md-12">
                <p class='search-title'>文章</p>
            </div>
            <!-- 文章區 -->
            <div class='ser-con'>
                <!-- 文章 -->
                <div class="art2 pointer" onclick="location.href='#'">
                    <div class="row art-head justify-content-start">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9">
                            <!-- 作者頭像 -->
                            <img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic"></a>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 簡圖內容(上) end-->
                    
                    <!-- 簡圖內容(中) -->
                    <div class="row art-body justify-content-start">
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <!-- 標題 -->
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>一則簡訊差點毀了我六年的感情</p>
                            <!-- 簡述 -->
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">昨天早上準備出門的時候
    男友突然問：寶貝你愛我嗎？
    正在畫眼線的我 沒空理他
    直接回：不愛啦！
                            </p>
                        </div>
                    </div>
                    <!-- 簡圖內容(中) end-->
                </div>
                <!-- 文章 end-->
                <!-- 文章 -->
                <div class="art2 pointer" onclick="location.href='#'">
                    <div class="row art-head justify-content-start">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9">
                            <!-- 作者頭像 -->
                            <img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic"></a>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 簡圖內容(上) end-->
                    
                    <!-- 簡圖內容(中) -->
                    <div class="row art-body justify-content-start">
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <!-- 標題 -->
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>一則簡訊差點毀了我六年的感情</p>
                            <!-- 簡述 -->
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">昨天早上準備出門的時候
    男友突然問：寶貝你愛我嗎？
    正在畫眼線的我 沒空理他
    直接回：不愛啦！
                            </p>
                        </div>
                    </div>
                    <!-- 簡圖內容(中) end-->
                </div>
                <!-- 文章 end-->
                <p onclick="location.href='#'" class='ser-fot pointer'>查看更多</p>
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
                    <!-- 一個看板 -->
                    <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                        <div class="col-md-8">
                            <p class='ser-ww'>感情版</p>
                        </div>
                        <div class="col-md-4 right">
                            <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                        </div>
                    </div>
                    <!-- 一個看板end -->

                    <!-- 一個看板 -->
                    <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                        <div class="col-md-8">
                            <p class='ser-ww'>有趣版</p>
                        </div>
                        <div class="col-md-4 right">
                            <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                        </div>
                    </div>
                    <!-- 一個看板end -->
                    <p onclick="location.href='#'" class='ser-fot pointer'>查看更多</p>
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
                    <!-- 一個暱稱 -->
                    <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                        <div class="col-md-8">
                            <p class='ser-ww'>小賀</p>
                        </div>
                        <div class="col-md-4 right">
                            <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                        </div>
                    </div>
                    <!-- 一個暱稱end -->

                    <!-- 一個暱稱 -->
                    <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                        <div class="col-md-8">
                            <p class='ser-ww'>姸姸</p>
                        </div>
                        <div class="col-md-4 right">
                            <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                        </div>
                    </div>
                    <!-- 一個暱稱end -->
                    <p onclick="location.href='#'" class='ser-fot pointer'>查看更多</p>
                </div>
                <!-- 看板內容end -->
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
                    <!-- 一個話題 -->
                    <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                        <div class="col-md-8">
                            <p class='ser-ww'>#條碼女孩吧啦吧啦吧啦</p>
                        </div>
                        <div class="col-md-4 right">
                            <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                        </div>
                    </div>
                    <!-- 一個看板end -->

                    <!-- 一個看板 -->
                    <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                        <div class="col-md-8">
                            <p class='ser-ww'>#乖乖女的戀愛指南</p>
                        </div>
                        <div class="col-md-4 right">
                            <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                        </div>
                    </div>
                    <!-- 一個看板end -->
                    <p onclick="location.href='#'" class='ser-fot pointer'>查看更多</p>
                </div>
                <!-- 看板內容end -->
        </div>
    </div>
    <!-- 話題end -->
    <!-- 全部按鈕end -->
    
    <?php ?>
    
    <!-- 文章按鈕 -->
    <div class='sm-article'>
        <div class="row justify-content-start mid">
            <div class="col-md-2">
                <p class='search-title'>文章</p>
            </div>
            <div class="col-md-10 right">
                <!-- 熱門文章 -->
				<button type="button" class="btn btn-sm btn-info">HOT</button>
			    <!-- 最新文章 -->
			    <button type="button" class="btn btn-sm btn-info">NEW</button>
            </div>
            <!-- 文章區 -->
            <div class='ser-con2'>
                <!-- 文章 -->
                <div class="art2 pointer" onclick="location.href='#'">
                    <div class="row art-head justify-content-start">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9">
                            <!-- 作者頭像 -->
                            <img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic"></a>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 簡圖內容(上) end-->
                    
                    <!-- 簡圖內容(中) -->
                    <div class="row art-body justify-content-start">
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <!-- 標題 -->
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>一則簡訊差點毀了我六年的感情</p>
                            <!-- 簡述 -->
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">昨天早上準備出門的時候
    男友突然問：寶貝你愛我嗎？
    正在畫眼線的我 沒空理他
    直接回：不愛啦！
                            </p>
                        </div>
                    </div>
                    <!-- 簡圖內容(中) end-->
                </div>
                <!-- 文章 end-->
                <!-- 文章 -->
                <div class="art2 pointer" onclick="location.href='#'">
                    <div class="row art-head justify-content-start">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9">
                            <!-- 作者頭像 -->
                            <img src="../index/image/user.png" class="img-fluid rounded-circle" id="writer-pic"></a>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 簡圖內容(上) end-->
                    
                    <!-- 簡圖內容(中) -->
                    <div class="row art-body justify-content-start">
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <!-- 標題 -->
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>一則簡訊差點毀了我六年的感情</p>
                            <!-- 簡述 -->
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">昨天早上準備出門的時候
    男友突然問：寶貝你愛我嗎？
    正在畫眼線的我 沒空理他
    直接回：不愛啦！
                            </p>
                        </div>
                    </div>
                    <!-- 簡圖內容(中) end-->
                </div>
                <!-- 文章 end-->
                <p onclick="location.href='#'" class='ser-fot pointer'>查看更多</p>
            </div>
            <!-- 文章區end -->
        </div>
    </div>
    <!-- 文章按鈕end -->

    <?php ?>

    <!-- 看板按鈕 -->
     <div class='sm-article'>
        <div class="row justify-content-start">
            <div class="col-md-12">
                <p class='search-title'>看板</p>
            </div>
            <!-- 看板內容 -->
            <div class='ser-con2 left'>
                <!-- 一個看板 -->
                <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                    <div class="col-md-8">
                        <p class='ser-ww'>感情版</p>
                    </div>
                    <div class="col-md-4 right">
                        <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                    </div>
                </div>
                <!-- 一個看板end -->

                <!-- 一個看板 -->
                <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                    <div class="col-md-8">
                        <p class='ser-ww'>有趣版</p>
                    </div>
                    <div class="col-md-4 right">
                        <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                    </div>
                </div>
                <!-- 一個看板end -->
                
                <p onclick="location.href='#'" class='ser-fot pointer'>查看更多</p>
            </div>
            <!-- 看板內容end -->
        </div>
    </div>
    <!-- 看板按鈕end -->

    <?php ?>

    <!-- 暱稱按鈕 -->
    <div class='sm-article'>
        <div class="row justify-content-start">
            <div class="col-md-12">
                <p class='search-title'>暱稱</p>
            </div>
            <!-- 暱稱內容 -->
            <div class='ser-con2 left'>
                <!-- 一個暱稱 -->
                <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                    <div class="col-md-8">
                        <p class='ser-ww'>小賀</p>
                    </div>
                    <div class="col-md-4 right">
                        <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                    </div>
                </div>
                <!-- 一個暱稱end -->

                <!-- 一個暱稱 -->
                <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                    <div class="col-md-8">
                        <p class='ser-ww'>姸姸</p>
                    </div>
                    <div class="col-md-4 right">
                        <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                    </div>
                </div>
                <!-- 一個暱稱end -->
                
                <p onclick="location.href='#'" class='ser-fot pointer'>查看更多</p>
            </div>
            <!-- 暱稱內容end -->
        </div>
    </div>
    <!-- 暱稱按鈕end -->

    <?php ?>
    <!-- 話題按鈕 -->
    <div class='sm-article'>
        <div class="row justify-content-start">
            <div class="col-md-12">
                <p class='search-title'>話題</p>
            </div>
            <!-- 話題內容 -->
            <div class='ser-con2 left'>
                <!-- 一個話題 -->
                <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                    <div class="col-md-8">
                        <p class='ser-ww'>#條碼女孩吧啦吧啦吧啦</p>
                    </div>
                    <div class="col-md-4 right">
                        <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                    </div>
                </div>
                <!-- 一個話題end -->

                <!-- 一個話題 -->
                <div class='row justify-content-start art2 pointer' onclick="location.href='#'">
                    <div class="col-md-8">
                        <p class='ser-ww'>#乖乖女的戀愛指南</p>
                    </div>
                    <div class="col-md-4 right">
                        <div class='ser-btn pointer ' onclick="location.href='#'" >Follow</div>
                    </div>
                </div>
                <!-- 一個話題end -->
                
                <p onclick="location.href='#'" class='ser-fot pointer'>查看更多</p>
            </div>
            <!-- 話題內容end -->
        </div>
    </div>
    <!-- 話題按鈕end -->

    <?php ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>