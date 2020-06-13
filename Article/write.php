<?php
	// 設定時間
	date_default_timezone_set('Asia/Taipei');

	$link = mysqli_connect("localhost","taigun","ELn3yv07F567MwOF","taigun");//連結伺服器//選擇資料庫
	if(!$link){
		echo "no connect!";
	}

	$write = "false";
	if(isset($_GET['write'])){
		session_start();
		$write = $_GET['write'];
	}

	
	if($write == 'true'){

		if(!(empty($_FILES["YouFile"]["tmp_name"]))){
			echo $_FILES["YouFile"]["tmp_name"];
			$image = "0x".bin2hex(fread( fopen( $_FILES["YouFile"]["tmp_name"] , "r") ,  filesize( $_FILES["YouFile"]["tmp_name"]) ));
		}
		
		// 計算tag
		$tag = array("tag","tag1", "tag2", "tag3", "tag4");
		$i  = 0;

		include("../index/forum.php");
		$uid = finduid($_SESSION['nickname']);
		echo $uid;

		$datetime = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
		$excerpt = substr( $_POST['content'] , 0 , 200 );
		
		if(!(empty($_FILES["YouFile"]["tmp_name"]))){
			$sql = "INSERT INTO article (`category`,`UId`, `title`, `content`, `excerpt`, `post_time`, `anonymous`, `post_name`,`address`,`img`) 
					VALUES ('$_POST[forum]', '$uid', '$_POST[title]', '$_POST[content]', '$excerpt', '$datetime', '$_POST[anonymous]','$_SESSION[nickname]','$_POST[address]',$image)";
		}else{
			$sql = "INSERT INTO article (`category`,`UId`, `title`, `content`, `excerpt`, `post_time`, `anonymous`, `post_name`,`address`) 
					VALUES ('$_POST[forum]', '$uid', '$_POST[title]', '$_POST[content]', '$excerpt', '$datetime', '$_POST[anonymous]','$_SESSION[nickname]','$_POST[address]')";
		}
		

		if(!(mysqli_query($link, $sql))){
			mysqli_error();
		}else{
			// 存tag
			$sql = "SELECT `AId` FROM `article` WHERE `UId` = \"$uid\" AND `post_time` = \"$datetime\"";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
			$aid = $row['AId'];
			
			while($i<5){
				if($_POST[$tag[$i]] != NULL){
					$TAG = $_POST[$tag[$i]];
					echo $TAG;
					$sql = "INSERT INTO `article_tag` (`AId`,`tag`) VALUES ('$aid','$TAG')";
					mysqli_query($link,$sql);
				}
				$i = $i+1;
			}

			// 找有誰follow這個作者，如果發文為匿名，則不通知
			if($_POST['anonymous'] == 1){
				$nickname = $_SESSION['nickname'];
				$content = "你追蹤的作家<b>".$nickname."</b>發布了新貼文快點去看看吧";
				$sql = "SELECT * FROM `follow` WHERE `follow_id` = '$uid'";
				$result_a = mysqli_query($link,$sql);

				$num = mysqli_num_rows($result_a);
				if($num > 0){
					while($row = mysqli_fetch_assoc($result_a)){
						$follower = $row['UId'];
						$sql_a = "INSERT INTO `notification` (`UId`,`AId`,`content`,`type`) VALUES ('$follower','$aid','$content',6)";
						if(mysqli_query($link,$sql_a)){

						}else{

						}
					}
				}
			}


			header('Location:../index/index.php?page=article&aid='.$aid.'');
			exit;
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
		<script type="text/javascript">
			function autogrow(textarea){
			var adjustedHeight=textarea.clientHeight;

			adjustedHeight=Math.max(textarea.scrollHeight,adjustedHeight);
			if (adjustedHeight>textarea.clientHeight){
				textarea.style.height=adjustedHeight+'px';}
		}
	</script>
	<style>
     	#map {
            height: 100%;
            width: 100%;
        }
    </style>
</head>
	<!-- 撰寫文章 -->
<body>
	<div class='write-head'>
		<p class='board'>寫篇文章吧</p>
	</div>
	<div class='write'>
		<form method='post' action='../Article/write.php?write=true' enctype="multipart/form-data">
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
				<label class="col-sm-3 col-form-label">標題</label>
				<div class="col-sm-9">
				<input name = "title" type="text" class="form-control" placeholder="請輸入文章標題" required> 
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-3 col-form-label">文章內容</label>
				<!-- 自動變長 -->
				<div class="col-sm-9">
				<textarea id="text" required name = "content" type="text" class="form-control" placeholder="文章內容" cols="90" rows="13" onkeyup="autogrow(this);"></textarea>
				</div>
			</div>

			<div class="from-group row">
				<label class='col-sm-3 col-form-label'> tag</label>
				<div class='col-sm-6' id="add">
					<input type='text' name='tag' class='add-input' placeholder="不用輸入hashtag" pattern="^[^#]+(?=.*[\u4e00-\u9fa5A-Za-z0-9]).{1,}$">
					
					<label>
						<img src='../index/image/plus.png' class='tag-pic'>
						<input name="tag" type="button" value="文本框" onClick="AddElement('text')" class='add-tag'/>
					</label>
				</div>
			</div>

			<!-- google map api-->
			<div id="app">
				<div class="form-group row">
					<label class="col-sm-3 col-form-label">請輸入地址</label>
					<div class="col-sm-9">
						<input type="text" ref="site" v-model="site" class="form-control" name="address">
					</div>
				</div>
				<!-- 放google map的div -->
				<div class="row justify-content-end">
					<div class="col-sm-9">
						<div id="map" class="embed-responsive embed-responsive-16by9"></div>
					</div>
				</div>
			</div>
			<!-- google map end -->
		<!-- </form> -->
		<!-- <form id = "form1" action="../Article/img.php" method="POST" enctype="multipart/form-data"> -->
			<div class="form-group row">
				<label class="col-sm-3 col-3 col-form-label">傳送圖檔</label>
				<div class="col-sm-9 col-9">
					<label>
						<img src='../index/image/add-image.png' class='write-pic'>
						<span id="file_name"></span>
						<input Type="File" name="YouFile" class='write-file pointer' id='FileInput'>
					</label>
				</div>
			</div>
			<div class='right'>
				<button type="submit" class="btn btn-info font-weight-bold">發送</button>
			</div>
		</form>

		<p id="check"></p>

		
	</div>
	
	<!-- google map api -->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>

	<!-- 抓圖檔的資訊 -->
	<script>
		var inputFile = document.getElementById('FileInput');

		inputFile.addEventListener('change', function(e) {

	  		var fileData = e.target.files[0]; // 檔案資訊
	  		var fileName = fileData.name; // 檔案名稱
			
			console.log(fileName);
			console.log(fileData); // 用開發人員工具可看到資料
			document.getElementById('file_name').innerText = fileName;
			// document.getElementById('file_thumbnail').src = URL.createObjectURL(fileData);
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
				newInput.name="tag"+count;
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

	<script>
		// var imageProc = function (input) {
		// 	if (input.files && input.files[0]) {
		// 		// 建立一個 FileReader 物件
		// 		var reader = new FileReader();
		// 		// 當檔案讀取完後，所要進行的動作
		// 		reader.onload = function (e) {
		// 			// 顯示圖片
		// 			var content = "<img src='" + e.target.result + "'>";
		// 			$('#text').val($('#text').val() + content);
		// 			// $('#show_image').attr("src", e.target.result).css("height", "500px").css("width", "500px");
		// 			// 將 DataURL 放到表單中
		// 			// $("input[name='imagestring']").val(e.target.result);
		// 		};
		// 		reader.readAsDataURL(input.files[0]);
		// 		}
		// 	}	
		// 	$(document).ready(function() {
		// 	// 綁定事件
		// 	$("#YouFile").change(function () {
		// 	readImage(this);
		// 	});
		// });
		// function prevent_reloading(){
		// 	var pendingRequests = {};
		// 		jQuery.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
		// 			var key = options.url;
		// 			console.log(key);
		// 			if (!pendingRequests[key]) {
		// 				pendingRequests[key] = jqXHR;
		// 			}else{
		// 				//jqXHR.abort();    //放棄後觸發的提交
		// 				pendingRequests[key].abort();   // 放棄先觸發的提交
		// 			}
		// 			var complete = options.complete;
		// 			options.complete = function(jqXHR, textStatus) {
		// 				pendingRequests[key] = null;
		// 				if (jQuery.isFunction(complete)) {
		// 				complete.apply(this, arguments);
		// 				}
		// 			};
		// 		});
		// 	}

			
		// $("#sub").click( function(e){
		// 	var url = $(this).data("url");

		// 	var file_data = $('#FileInput').prop('files')[0];   //取得上傳檔案屬性
		// 	var form_data = new FormData();  //建構new FormData()
		// 	// console.log(form_data);
		// 	form_data.append('YouFile', file_data);  //吧物件加到file後面
		// 	console.log(form_data);
		// 	$.ajax({
		// 		type: "POST",
		// 		url: url,
		// 		data:form_data,
		// 		dataType :"json",
		// 		cache: false,
        //         contentType: false,
        //         processData: false,
        //     }).done(function(data) {
		// 		console.log(data);
		// 		if(data['success'] == "OK"){
		// 			var imgid = data['imgid'];
		// 			var content = '<blockquote  class="imgur-embed-pub" lang="en" data-id="'+imgid+'"><a href="//imgur.com//'+imgid+'"></a></blockquote>';
					
		// 			$('#text').val($('#text').val() + content);
		// 		}else if(data['success'] == "NO"){
		// 			$('#text').val($('#text').val() + '圖片未上傳成功');
						
		// 		}
		// 	});
			
		// });

	</script>

	<!-- 引用vue.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>

	<!-- google map -->
	<script>
        const googleMap = new Vue({
        	el: '#app',
            data: {
                map: null,
                autocomplete: null, // google map Autocomplete method
                site: '', // place API要綁定的搜尋框
                place: null // 存place確定後回傳的資料
            },
            methods: {
                // init google map
                initMap() {

                let location = {
                    lat: 22.628477,
                    lng: 120.264994
                };

                this.map = new google.maps.Map(document.getElementById('map'), {
                    center: location,
                    zoom: 16
                });
                
                },
                // 地址自動完成 + 地圖的中心移到輸入結果的地址上
                siteAuto() {

                let options = {
                    componentRestrictions: { country: 'tw' } // 限制在台灣範圍
                };
                this.autocomplete = new google.maps.places.Autocomplete(this.$refs.site, options);
                
                // 地址的輸入框，值有變動時執行
                this.autocomplete.addListener('place_changed', () => {
                    this.place = this.autocomplete.getPlace(); // 地點資料存進place
                    
                    // 確認回來的資料有經緯度
                    if(this.place.geometry) {
                    
                    // 改變map的中心點
                    let searchCenter = this.place.geometry.location;
                    
                    // panTo是平滑移動、setCenter是直接改變地圖中心
                    this.map.panTo(searchCenter);

                    // 在搜尋結果的地點上放置標記
                    let marker = new google.maps.Marker({
                        position: searchCenter,
                        map: this.map
                    });

                    // info window
                    let infowindow = new google.maps.InfoWindow({
                        content: this.place.formatted_address
                    });
                    infowindow.open(this.map, marker);

                    }
                    
                });
                }
            },
            mounted() {
                window.addEventListener('load', () => {

                this.initMap();
                this.siteAuto();

                });
            }
        })

    </script>

		
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>