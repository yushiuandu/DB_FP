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
    <div class='collect-set right pointer' data-toggle="modal" data-target="#collect">
        <p>setting <img src='../index/image/collect-set.png' class='collect-pic'></p>
    </div>
    <div class="modal fade bd-example-modal-sm match-ww middle" id="collect" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-dialog-centered"> <!--centered重直置中-->
            <div class="modal-content match-page"> 
                <!-- 配對頁面內容 -->
                <p class="match-title">編輯收藏</p>
                <div class="modal-body">
                    <div class='collect-add'>
                    <!-- 可以新增收藏選項並加入 -->
                        <input type='text' name='collect' placeholder='請輸入分類名稱'>
                        <button type="submit" class="btn btn-sm btn-secondary">新增</button>
                    </div>
                    <div class='collect'>
                        <!-- if有收藏 -->
                        <div class="row justify-content-start">
                            <div class="col-md-6 col-sm-6 sol-6">
                                <p class="collect-view">網美店 <img src='../index/image/delete.png' type="delete" class='delete-pic pointer'></p>
                            </div>
                            <div class="col-md-6 col-sm-6 sol-6">
                                <p class="collect-view">桌布分享 <img src='../index/image/delete.png' type="delete" class='delete-pic pointer'></p>
                            </div>
                            <div class="col-md-6 col-sm-6 sol-6">
                                <p class="collect-view">貓貓狗狗 <img src='../index/image/delete.png' type="delete" class='delete-pic pointer'></p>
                            </div>
                        </div>
                        <!-- if沒有收藏 -->
                        <!-- <p class='collect-no'>你還沒有收藏喔！</p> -->
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
    <!-- 全部收藏 -->
    <div class="row justify-content-center">
        <div class="col-md-12 long">
            <div class='tit'>
                <p class='ww'>全部收藏</p>
            </div>
            <div class="con2">
                <!-- 文章 -->
                <div class="bo pointer" onclick="location.href='#';">
                    <!-- 文章(上) -->
                    <div class="row art-head mid">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <div class='pic-container'>
                                <!-- 作者頭像 -->
                                <img src="../index/image/user.png" id="writer-pic"></a>
                            </div>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 文章(上) end-->
                    
                    <!-- 文章(下) -->
                    <div class="row art-body mid">
                        <!-- 標題 -->
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>同學，你勾起我的惡夢。</p>
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
                            大學四年級空課很多，就在等待上課的悠閒時光，突然間，我同學壞掉了。
    他開始念念有詞……
    「Lucy你是耐ㄟ這呢敖」
                            </p>
                        </div>
                        <!-- 標題 end -->
                    </div>
                    <!-- 文章(下) end-->
                </div>
                <!-- 文章 end -->

                <!-- 文章2 -->
                <div class="bo pointer" onclick="location.href='#';">
                    <!-- 文章(上) -->
                    <div class="row art-head mid">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <div class='pic-container'>
                                <!-- 作者頭像 -->
                                <img src="../index/image/user.png" id="writer-pic"></a>
                            </div>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 文章(上) end-->
                    
                    <!-- 文章(下) -->
                    <div class="row art-body mid">
                        <!-- 標題 -->
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>同學，你勾起我的惡夢。</p>
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
                            大學四年級空課很多，就在等待上課的悠閒時光，突然間，我同學壞掉了。
    他開始念念有詞……
    「Lucy你是耐ㄟ這呢敖」
                            </p>
                        </div>
                        <!-- 標題 end -->
                    </div>
                    <!-- 文章(下) end-->
                    
                </div>
                <!-- 文章2 end -->
                
                <!-- 文章3 -->
                <div class="bo pointer" onclick="location.href='#';">
                    <!-- 文章(上) -->
                    <div class="row art-head mid">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <div class='pic-container'>
                                <!-- 作者頭像 -->
                                <img src="../index/image/user.png" id="writer-pic"></a>
                            </div>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 文章(上) end-->
                    
                    <!-- 文章(下) -->
                    <div class="row art-body mid">
                        <!-- 標題 -->
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>同學，你勾起我的惡夢。</p>
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
                            大學四年級空課很多，就在等待上課的悠閒時光，突然間，我同學壞掉了。
    他開始念念有詞……
    「Lucy你是耐ㄟ這呢敖」
                            </p>
                        </div>
                        <!-- 標題 end -->
                    </div>
                    <!-- 文章(下) end-->
                    
                </div>
                <!-- 文章3 end -->
            </div>
        </div>
    </div>
    <!-- 全部收藏 end -->

    <!-- 收藏分類 -->
    <div class="row justify-content-start">
        <!-- 單個分類(1) -->
        <div class="col-lg-6 col-md-12" style="margin-bottom:20px;">
            <div class='tit'>
                <p class='ww'>桌布分享</p>
            </div>
            <div class="con">
                <!-- 文章 -->
                <div class="bo2 pointer" onclick="location.href='#';">
                    <!-- 文章(上) -->
                    <div class="row art-head mid">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <div class='pic-container'>
                                <!-- 作者頭像 -->
                                <img src="../index/image/user.png" id="writer-pic"></a>
                            </div>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 文章(上) end-->
                    
                    <!-- 文章(下) -->
                    <div class="row art-body mid">
                        <!-- 標題 -->
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>同學，你勾起我的惡夢。</p>
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
                            大學四年級空課很多，就在等待上課的悠閒時光，突然間，我同學壞掉了。
    他開始念念有詞……
    「Lucy你是耐ㄟ這呢敖」
                            </p>
                        </div>
                        <!-- 標題 end -->
                    </div>
                    <!-- 文章(下) end-->
                </div>
                <!-- 文章 end -->

                <!-- 文章2 -->
                <div class="bo2 pointer" onclick="location.href='#';">
                    <!-- 文章(上) -->
                    <div class="row art-head mid">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <div class='pic-container'>
                                <!-- 作者頭像 -->
                                <img src="../index/image/user.png" id="writer-pic"></a>
                            </div>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 文章(上) end-->
                    
                    <!-- 文章(下) -->
                    <div class="row art-body mid">
                        <!-- 標題 -->
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>同學，你勾起我的惡夢。</p>
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
                            大學四年級空課很多，就在等待上課的悠閒時光，突然間，我同學壞掉了。
    他開始念念有詞……
    「Lucy你是耐ㄟ這呢敖」
                            </p>
                        </div>
                        <!-- 標題 end -->
                    </div>
                    <!-- 文章(下) end-->
                </div>
                <!-- 文章2 end -->
            </div>
        </div>
        <!-- 單個分類(1) end -->


        <!-- 單個分類(2) -->
        <div class="col-lg-6 col-md-12" style="margin-bottom:10px;">
            <div class='tit'>
                <p class='ww'>網美店</p>
            </div>
            <div class="con">
                <!-- 文章 -->
                <div class="bo2 pointer" onclick="location.href='#';">
                    <!-- 文章(上) -->
                    <div class="row art-head mid">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <div class='pic-container'>
                                <!-- 作者頭像 -->
                                <img src="../index/image/user.png" id="writer-pic"></a>
                            </div>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 文章(上) end-->
                    
                    <!-- 文章(下) -->
                    <div class="row art-body mid">
                        <!-- 標題 -->
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>同學，你勾起我的惡夢。</p>
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
                            大學四年級空課很多，就在等待上課的悠閒時光，突然間，我同學壞掉了。
    他開始念念有詞……
    「Lucy你是耐ㄟ這呢敖」
                            </p>
                        </div>
                        <!-- 標題 end -->
                    </div>
                    <!-- 文章(下) end-->
                </div>
                <!-- 文章 end -->

                <!-- 文章2 -->
                <div class="bo2 pointer" onclick="location.href='#';">
                    <!-- 文章(上) -->
                    <div class="row art-head mid">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <div class='pic-container'>
                                <!-- 作者頭像 -->
                                <img src="../index/image/user.png" id="writer-pic"></a>
                            </div>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 文章(上) end-->
                    
                    <!-- 文章(下) -->
                    <div class="row art-body mid">
                        <!-- 標題 -->
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>同學，你勾起我的惡夢。</p>
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
                            大學四年級空課很多，就在等待上課的悠閒時光，突然間，我同學壞掉了。
    他開始念念有詞……
    「Lucy你是耐ㄟ這呢敖」
                            </p>
                        </div>
                        <!-- 標題 end -->
                    </div>
                    <!-- 文章(下) end-->
                    
                </div>
                <!-- 文章2 end -->
            </div>
        </div>
        <!-- 單個分類(2)  -->
        <!-- 單個分類(1) -->
        <div class="col-lg-6 col-md-12" style="margin-bottom:10px;">
            <div class='tit'>
                <p class='ww'>桌布分享</p>
            </div>
            <div class="con">
                <!-- 文章 -->
                <div class="bo2 pointer" onclick="location.href='#';">
                    <!-- 文章(上) -->
                    <div class="row art-head mid">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <div class='pic-container'>
                                <!-- 作者頭像 -->
                                <img src="../index/image/user.png" id="writer-pic"></a>
                            </div>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 文章(上) end-->
                    
                    <!-- 文章(下) -->
                    <div class="row art-body mid">
                        <!-- 標題 -->
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>同學，你勾起我的惡夢。</p>
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
                            大學四年級空課很多，就在等待上課的悠閒時光，突然間，我同學壞掉了。
    他開始念念有詞……
    「Lucy你是耐ㄟ這呢敖」
                            </p>
                        </div>
                        <!-- 標題 end -->
                    </div>
                    <!-- 文章(下) end-->
                </div>
                <!-- 文章 end -->

                <!-- 文章2 -->
                <div class="bo2 pointer" onclick="location.href='#';">
                    <!-- 文章(上) -->
                    <div class="row art-head mid">
                        <!-- 作者-->
                        <div class="col-md-10 col-sm-9 col-9 mid" style='padding:0px;'>
                            <div class='pic-container'>
                                <!-- 作者頭像 -->
                                <img src="../index/image/user.png" id="writer-pic"></a>
                            </div>
                            <!-- 作者名稱 -->
                            <p style="display: inline; font-size:2vmin; margin:0px;">匿名</p>
                        </div>
                        <!-- 作者 end-->
                    </div>
                    <!-- 文章(上) end-->
                    
                    <!-- 文章(下) -->
                    <div class="row art-body mid">
                        <!-- 標題 -->
                        <div class="col-md-11 col-sm-11 col-11 col-lg-11 text-truncate">
                            <p class="font-weight-bold" style='font-size:3vmin; margin:0px;'>同學，你勾起我的惡夢。</p>
                            <p style="color:gray; font-size:2vmin; margin:0px;font-family:jf-openhuninn;">
                            大學四年級空課很多，就在等待上課的悠閒時光，突然間，我同學壞掉了。
    他開始念念有詞……
    「Lucy你是耐ㄟ這呢敖」
                            </p>
                        </div>
                        <!-- 標題 end -->
                    </div>
                    <!-- 文章(下) end-->
                </div>
                <!-- 文章2 end -->
            </div>
        </div>
        <!-- 單個分類(1) end -->
        
    </div>
	<!-- 收藏分類 end -->
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>