<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/12/3
 * Time: 11:32
 */

namespace app\controller;


use app\BaseController;
use app\service\SettingService;

class Setting extends BaseController
{
    public function getNotice(){
        return invoke(SettingService::class)->getNotice($this->params);
    }
    public function setNotice(){
        return invoke(SettingService::class)->setNotice($this->params);
    }
}