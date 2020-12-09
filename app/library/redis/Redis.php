<?php
/**
 * Created by PhpStorm.
 * User: admins
 * Date: 2020/9/8
 * Time: 10:55
 */

namespace app\library\redis;


use think\facade\Config;

class Redis
{
    protected $service;

    public function __construct()
    {
        $this->service=new \Redis();
        $this->service->connect(Config::get('redis.host'),Config::get('redis.port'));
    }
    public static function service(){
        return new Redis();
    }
    //获取原redis实例
    public function getInstance(){
        return $this->service;
    }
    //获取数据
    public function get($key){
        return $this->service->get($key);
    }
    //设置数据
    public function set($key,$value,$timeout=0){
        if($timeout>0){
            $this->service->setex($key,$timeout,$value);
        }else{
            $this->service->set($key,$value);
        }
    }
    //删除数据
    public function del($key){
        $this->service->del($key);
    }
    //发布消息
    public function publish($channel,$message){
       $this->service->publish($channel,$message);
    }
}