<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/12/3
 * Time: 11:32
 */

namespace app\service;


use app\model\ConfigModel;

class SettingService extends BaseService
{
    public function getNotice($params){
        $value=ConfigModel::where('name','notice')->value('value');
        return successResponse('查询成功',['content'=>$value]);
    }
    public function setNotice($params){
        $content=$params['content']??'';
        $data=ConfigModel::where('name','notice')->findOrEmpty();
        $data->name='notice';
        $data->value=$content;
        $data->save();
        return successResponse('保存成功');
    }
}