<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/26
 * Time: 10:27
 */

namespace app\controller;


use app\BaseController;
use app\service\LoginService;

class Login extends BaseController
{
    public function login(){
        return invoke(LoginService::class)->login($this->params);
    }
    public function logout(){
        return invoke(LoginService::class)->logout($this->params);
    }
}