<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/28
 * Time: 11:27
 */

namespace app\service;


use app\model\AdminModel;
use app\model\RoleModel;
use app\validate\RoleValidate;
use think\exception\ValidateException;

class RoleService extends BaseService
{
    public function list($params){
        $page=getPage($params);
        $sort=getSort($params);
        $username=$params['username']??'';
        $list=RoleModel::when($username,function ($q)use($username){
            $q->where('username','like',"$username%");
        });
        $total=$list->count();
        $list=$list->page($page->page,$page->limit)
            ->order($sort->order,$sort->desc)
            ->select();
        return listResponse($list,$total);
    }
    public function read($params){
        $data=RoleModel::find($params['id']);
        return successResponse('查询成功',$data);
    }
    public function save($params){
        try {
            validate(RoleValidate::class)->scene('save')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        $data=new RoleModel();
        $data->name=$params['name'];
        $data->power_id=$params['power_id'];
        $data->status=1;
        $data->save();
        return successResponse('添加成功');
    }
    public function update($params){
        try {
            validate(RoleValidate::class)->scene('update')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        $data=RoleModel::find($params['id']);
        if(empty($data))return errorResponse('找不到此数据');
        $data->name=$params['name'];
        $data->power_id=$params['power_id'];
        $data->status=1;
        $data->save();
        return successResponse('保存成功');
    }
    public function delete($params){
        $data=RoleModel::find($params['id']);
        if(empty($data))return errorResponse('找不到此数据');
        $count=AdminModel::where('role_id',$data->id)->count();
        if($count>0){
            return errorResponse("删除失败，当前角色还有{$count}个账号在使用");
        }
        $data->delete();
        return successResponse('删除成功');
    }
}