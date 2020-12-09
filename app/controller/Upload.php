<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/12/1
 * Time: 18:37
 */

namespace app\controller;


use app\BaseController;
use app\service\UploadService;

class Upload extends BaseController
{
    public function index(){
        $params=$this->params;
        $params['file']=request()->file('file');
        return invoke(UploadService::class)->img($params);
    }
}