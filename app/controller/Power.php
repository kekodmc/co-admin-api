<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/27
 * Time: 15:54
 */

namespace app\controller;


use app\BaseController;
use app\service\PowerService;

class Power extends BaseController
{
    public function index(){
        return invoke(PowerService::class)->list($this->params);
    }
    public function read(){
        return invoke(PowerService::class)->read($this->params);
    }
    public function save(){
        return invoke(PowerService::class)->save($this->params);
    }
    public function update(){
        return invoke(PowerService::class)->update($this->params);
    }
    public function delete(){
        return invoke(PowerService::class)->delete($this->params);
    }
    public function mod(){
        return invoke(PowerService::class)->modList($this->params);
    }
}