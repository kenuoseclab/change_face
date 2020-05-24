<?php
/**
 * Created by PhpStorm.
 * User: jinmi
 * Date: 2020-05-22
 * Time: 23:47
 */

namespace App;

class Application
{
    protected $client;
    protected $uploadFile;
    protected $saveFilePath; //保存图片地址

    public function __construct()
    {
        $this->client = new \AipFace(Config::APP_ID, Config::API_KEY, Config::SECRET_KEY);
    }

    //保存上传的文件
    public function setUploadFile($file)
    {
        $this->uploadFile = $file;

        //移动文件到运行
        $this->saveFile($this->uploadFile['tmp_name'],$this->uploadFile['type']);
    }

    //查找图片中的人脸信息
    public function detect() :array

    {
        $base64 = base64_encode(file_get_contents($this->saveFilePath));
        $result = $this->client->detect($base64,'BASE64');

        if(!$result['error_code']){
            return $result['result'];
        }

        return ['face_num'=>0];
    }

    public function saveFile($tempPath,$type)
    {
        $this->saveFilePath = __DIR__.'/../runtime/'.'tmp1.'.str_replace('image/','',$type);
        move_uploaded_file($tempPath,$this->saveFilePath);
    }

    public function getFilePath()
    {
        return 'runtime/tmp1.png';
    }

    public function getBgFilePath()
    {
        return 'runtime/bg.png';
    }
}