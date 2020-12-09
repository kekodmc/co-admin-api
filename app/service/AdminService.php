<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/26
 * Time: 10:39
 */

namespace app\service;


use app\model\AdminModel;
use app\validate\AdminValidate;
use think\exception\ValidateException;

class AdminService extends BaseService
{
    public function list($params){
        $page=getPage($params);
        $sort=getSort($params);
        $username=$params['username']??'';
        $list=AdminModel::when($username,function ($q)use($username){
            $q->where('username','like',"$username%");
        });
        $total=$list->count();
        $list=$list->with('role')->withoutField('password')
            ->page($page->page,$page->limit)
            ->order($sort->order,$sort->desc)
            ->select();
        return listResponse($list,$total);
    }
    public function read($params){
        $data=AdminModel::withoutField('password')->find($params['id']);
        return successResponse('查询成功',$data);
    }
    public function save($params){
        try {
            validate(AdminValidate::class)->scene('save')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        //检查登录名
        $count=AdminModel::where('username',$params['username'])->count();
        if($count>0){
            return errorResponse('此登录名已被使用');
        }
        $avatar=!empty($params['avatar'])?$params['avatar']:getHost().'/avatar.jpg';
        $data=new AdminModel();
        $data->username=$params['username'];
        $data->password=password_hash($params['password'],PASSWORD_BCRYPT,['code'=>9527]);//登录密码
        $data->role_id=$params['role_id'];
        $data->avatar=$avatar;
        $data->save();
        return successResponse('添加成功');
    }
    public function update($params){
        try {
            validate(AdminValidate::class)->scene('update')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        $password=$params['password']??'';
        $avatar=!empty($params['avatar'])?$params['avatar']:getHost().'/avatar.jpg';
        //检查登录名
        $count=AdminModel::where('username',$params['username'])
            ->where('id','<>',$params['id'])
            ->count();
        if($count>0){
            return errorResponse('此登录名已被使用');
        }
        $data=AdminModel::find($params['id']);
        if(empty($data))return errorResponse('数据不存在');
        if($data->id==1&&$params['uid']!=1){
            return errorResponse('您没有权限修改此账号信息');
        }
        $data->username=$params['username'];
        if($password){
            $data->password=password_hash($params['password'],PASSWORD_BCRYPT,['code'=>9527]);//登录密码
        }
        $data->role_id=$params['role_id'];
        $data->avatar=$avatar;
        $data->save();
        return successResponse('保存成功');
    }
    public function delete($params){
        $data=AdminModel::find($params['id']);
        if(empty($data))return errorResponse('数据不存在');
        if($data->id==1){
            return errorResponse('此账号不能删除');
        }
        $data->delete();
        return successResponse('删除成功');
    }
    //启用或禁用
    public function disable($params){
        try {
            validate(AdminValidate::class)->scene('disable')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        $data=AdminModel::find($params['id']);
        if(empty($data))return errorResponse('数据不存在');
        if($data->id==1){
            return errorResponse('此账号不能禁用');
        }
        if($params['type']=='on'){
            //启用
            $data->status=1;
        }else{
            //禁用
            $data->status=0;
            //立即下线
            if($data->token){
                cache($data->token,null);
            }
        }
        $data->save();
        return successResponse('操作成功');
    }
}