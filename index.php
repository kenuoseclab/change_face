<?php

require_once ('vendor/autoload.php');

//$app = new \App\Application();

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers:x-requested-with,content-type');

if(isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD'])=='POST'){
    if ($_FILES['file']['error'] == 0) {
        $app = new \App\Application();
        $app->setUploadFile($_FILES['file']);
        $result = $app->detect();
        echo json_encode([
            'data'=>$result,
            'img_path'=>$app->getFilePath(),
            'img_path2'=>$app->getFilePath()
        ]);
    }
}else{
    echo json_encode(['msg'=>'hello world']);
}

