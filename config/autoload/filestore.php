<?php

return [

    'local' => [
        'save_path' => BASE_PATH.'/runtime/storage/',
        'path' => '/storage/',
        'url'   => '127.0.0.1' //访问不了的 反代吧
    ],

    'oss' => [

        'appid' => env('ALY_APP_ID'),
        'appsec' => env('ALY_APP_SEC'),
        'bucket' => env('ALY_BUCKET','min-common'),
        'endpoint' => env('ALY_endpoint','oss-cn-shenzhen.aliyuncs.com'),

        'socket_timeout' => '5184000', // 设置Socket层传输数据的超时时间

        'connection_timeout' => '10', //建立链接的超时时间
        'save_path' => 'qkl/storage/',  //存储目录
        'url'       =>  'https://min-common.oss-cn-shenzhen.aliyuncs.com'
    ],

    'dependencies' => [
        //JunBaby\FileStore\Service\FileStoreInterface::class => JunBaby\FileStore\Service\OssFileStoreService::class
        JunBaby\FileStore\Service\FileStoreInterface::class =>  JunBaby\FileStore\Service\LocalFileStoreService::class
    ]


];