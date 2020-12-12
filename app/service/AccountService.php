<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/12/11
 * Time: 18:08
 */

namespace app\service;


use app\model\AdminModel;
use app\validate\AccountValidate;
use think\exception\ValidateException;

class AccountService extends BaseService
{
    public function index($params){
        $data=AdminModel::find($params['uid']);
        return successResponse('查询成功',[
            'username'=>$data->username,
            'avatar'=>$data->avatar,
        ]);
    }
    public function update($params){
        try {
            validate(AccountValidate::class)->scene('update')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        $password=$params['password']??'';
        $data=AdminModel::find($params['uid']);
        $data->avatar=$params['avatar'];
        if($password){
            $data->password=password_hash($password,PASSWORD_BCRYPT,['code'=>9527]);
        }
        $data->save();
        return successResponse('保存成功');
    }
}