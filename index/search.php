
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
    <!-- 按鈕選項( 全部、文章、看板、話題、暱稱) -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class='btnn'><a href='../index/?page=search-all'>全部</a></div>
            <div class='btnn'><a href='../index/?page=search-article'>文章</a></div>
            <div class='btnn'><a href='../index/?page=search-board'>看板</a></div>
            <div class='btnn'><a href='../index/?page=search-topic'>話題</a></div>
            <div class='btnn'><a href='../index/?page=search-nickname'>暱稱</a></div>
        </div>
    </div>
    <!-- 按鈕選項( 全部、文章、看板、話題、暱稱)end -->

    <?php if($page == 'search-all'):?>
<!-- 全部按鈕 -->
    <!-- 文章 -->
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
    </div>
    <!-- 文章end -->


    <div class="row justify-content-center">
        <!-- 看板 -->
        <div class="col-md-6"></div>
        <!-- 暱稱 -->
        <div class="col-md-6"></div>
    </div>

    <!-- 話題 -->
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
    </div>
    <!-- 話題end -->
<!-- 全部按鈕end -->

    <?php elseif($page == 'search-article'):?>
<!-- 文章按鈕 -->
    <!-- 文章 -->
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
    </div>
    <!-- 文章end -->
<!-- 文章按鈕end -->

    <?php elseif($page == 'search-board'):?>
<!-- 看板按鈕 -->
    <!-- 看板 -->
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
    </div>
    <!-- 看板end -->
<!-- 看板按鈕end -->

<?php elseif($page == 'search-topic'):?>
<!-- 話題按鈕 -->
    <!-- 話題 -->
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
    </div>
    <!-- 話題end -->
<!-- 話題按鈕end -->

<?php elseif($page == 'search-nickname'):?>
<!-- 暱稱按鈕 -->
    <!-- 暱稱 -->
    <div class="row justify-content-center">
        <div class="col-md-12"></div>
    </div>
    <!-- 暱稱end -->
<!-- 暱稱按鈕end -->

<?php endif;?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>