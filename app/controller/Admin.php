<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/27
 * Time: 15:40
 */

namespace app\controller;


use app\BaseController;
use app\service\AdminService;
use app\service\RoleService;

class Admin extends BaseController
{
    public function index(){
        return invoke(AdminService::class)->list($this->params);
    }
    public function read(){
        return invoke(AdminService::class)->read($this->params);
    }
    public function save(){
        return invoke(AdminService::class)->save($this->params);
    }
    public function update(){
        return invoke(AdminService::class)->update($this->params);
    }
    public function delete(){
        return invoke(AdminService::class)->delete($this->params);
    }
    public function role(){
        return invoke(RoleService::class)->list($this->params);
    }
    public function disable(){
        return invoke(AdminService::class)->disable($this->params);
    }
}