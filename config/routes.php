<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;
#####tool
#图形验证码
Router::get('/captcha', 'App\Controller\tool\CaptchaController@getCaptcha');
#发送短信
Router::addGroup('/sms', function () {
    Router::post('/signup', 'App\Controller\tool\SmsController@sendSignupSms');
    Router::post('/forget', 'App\Controller\tool\SmsController@sendForgetSms');
    Router::get('/area', 'App\Controller\tool\SmsController@getArea');
});
#上传图片
Router::addGroup('/upload', function () {
    Router::post('/image', 'App\Controller\tool\UploadController@index');
    Router::post('/file', 'App\Controller\tool\UploadController@file');
}, ['middleware' => [Phper666\JwtAuth\Middleware\JwtAuthMiddleware::class]]);


####api
# 登录
Router::post('/login', 'App\Controller\api\UserController@login');
#注册
Router::post('/signup', 'App\Controller\api\UserController@signup');
#获取滚动图
Router::post('/rotation', 'App\Controller\api\RotationController@index');
#项目管理
Router::addGroup('/project', function () {
    Router::get('/page', 'App\Controller\api\ProjectController@page');
    Router::get('/add', 'App\Controller\api\ProjectController@addProject');
}, ['middleware' => [Phper666\JwtAuth\Middleware\JwtAuthMiddleware::class]]);
# 获取数据
Router::addGroup('/index', function () {
    Router::get('/data', 'App\Controller\IndexController@getData');
}, ['middleware' => [Phper666\JwtAuth\Middleware\JwtAuthMiddleware::class]]);

###admin
# 登录
Router::post('/admin/login', 'App\Controller\admin\UserController@login');
# 获取数据
Router::addGroup('/admin', function () {
    #注册
    Router::get('/signup', 'App\Controller\admin\UserController@signup');
}, ['middleware' => [Phper666\JwtAuth\Middleware\JwtAuthMiddleware::class]]);