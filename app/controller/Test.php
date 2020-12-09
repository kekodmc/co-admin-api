<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/27
 * Time: 10:04
 */

namespace app\controller;


use app\BaseController;

class Test extends BaseController
{
    public function index(){
        $wei = 1e6;
        $datalist = explode('0x','0xa9059cbb0000000000000000000000003f5ce5fbfe3e9af3971dd833d26ba9b5c936f0be00000000000000000000000000000000000000000000000000000004d4610fc0')[1];
        $account = substr($datalist, 32, 40);
        $account = '0x' . $account;
        $account = strtolower($account);
        $amount = substr($datalist, -26);
        $num = hexdec($amount) / $wei;
        dump($account);
        dump($num);
    }
}