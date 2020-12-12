<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/12/11
 * Time: 11:25
 */

namespace app\controller;


use app\BaseController;
use app\service\AccountService;

class Account extends BaseController
{
    public function index(){
        return invoke(AccountService::class)->index($this->params);
    }
    public function update(){
        return invoke(AccountService::class)->update($this->params);
    }
}