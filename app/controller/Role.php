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
use app\service\RoleService;

class Role extends BaseController
{
    public function index(){
        return invoke(RoleService::class)->list($this->params);
    }
    public function read(){
        return invoke(RoleService::class)->read($this->params);
    }
    public function save(){
        return invoke(RoleService::class)->save($this->params);
    }
    public function update(){
        return invoke(RoleService::class)->update($this->params);
    }
    public function delete(){
        return invoke(RoleService::class)->delete($this->params);
    }
    public function power(){
        return invoke(PowerService::class)->modList($this->params);
    }
}