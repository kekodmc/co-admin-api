<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/26
 * Time: 10:39
 */

namespace app\service;


use app\model\AdminModel;
use app\model\PowerModel;
use app\validate\LoginValidate;
use think\exception\ValidateException;

class LoginService extends BaseService
{
    public function login($params){
        try {
            validate(LoginValidate::class)->scene('login')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        $data=AdminModel::with('role')->where('username',$params['username'])->find();
        if(empty($data)){
            return errorResponse('账号或密码不正确');
        }
        if(!password_verify($params['password'],$data->password)){
            return errorResponse('账号或密码不正确');
        }
        if($data->status<1){
            return errorResponse('您的账号已被禁用');
        }
        //获取账号权限
        $power=PowerModel::where('parent_id','>',0)
            ->where('id','in',$data->role->power_id)
//            ->order('sort')
            ->column('url');
        $token=createToken($data->username);
        $result=[
            'id'=>$data->id,
            'username'=>$data->username,
            'power'=>$power,
        ];
        //清除旧token
        if($data->token){
            cache($data->token,null);
        }
        cache($token,json_encode($result,JSON_UNESCAPED_UNICODE));
        $data->token=$token;
        $data->login_time=time();
        $data->save();
        $result['token']=$token;
        $result['avatar']=$data->avatar;
        return successResponse('登录成功',$result);
    }
    public function logout($params){
        cache($params['token'],null);
        AdminModel::update(['id'=>$params['uid'],'token'=>'']);
        return successResponse('退出登录成功');
    }
}