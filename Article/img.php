<?php
    
    $image = base64_encode(fread( @fopen( $_FILES["YouFile"]["tmp_name"] , "r") ,  filesize( $_FILES["YouFile"]["tmp_name"]) ));
    $curl_post_array = [
        'image' => $image,
    ];
    $timeout = 30;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_array);
    $curl_result = curl_exec($curl);
    curl_close ($curl);
    $Received = json_decode($curl_result,true);
    $Imgid = $Received['data']['id'];
    //echo $Imgid;
    if ($Received['success'] == true){
        exit(json_encode(array("success"=>"OK","imgid"=>$Imgid)));
    }else{
        exit(json_encode(array("success"=>"NO")));
    }
?>
