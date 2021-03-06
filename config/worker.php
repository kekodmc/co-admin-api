<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | Workerman设置 仅对 php think worker 指令有效
// +----------------------------------------------------------------------
return [
    // 扩展自身需要的配置
    'host'                  => '0.0.0.0', // 监听地址
    'port'                  => 2346, // 监听端口
    'root'                  => '', // WEB 根目录 默认会定位public目录
    'app_path'              => '', // 应用目录 守护进程模式必须设置（绝对路径）
    'file_monitor'          => false, // 是否开启PHP文件更改监控（调试模式下自动开启）
    'file_monitor_interval' => 2, // 文件监控检测时间间隔（秒）
    'file_monitor_path'     => [], // 文件监控目录 默认监控application和config目录

    // 支持workerman的所有配置参数
    'name'                  => 'thinkphp',
    'count'                 => 4,
    'daemonize'             => false,
    'pidFile'               => '',
    // 心跳检测
    'pingInterval' =>50,
    'pingNotResponseLimit' =>0,//1.客户端在pingInterval内必须回复数据,0.不需要回复数据
    'pingData' =>'{"code":0,"message":"心跳检测，请回复任意信息","data":""}',//服务端主动推送数据
];
