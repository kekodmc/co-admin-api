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
use app\validate\PowerValidate;
use think\exception\ValidateException;

class PowerService extends BaseService
{
    public function list($params){
        $page=getPage($params);
        $sort=getSort($params);
        $username=$params['username']??'';
        $list=PowerModel::when($username,function ($q)use($username){
            $q->where('username','like',"$username%");
        });
        $total=$list->count();
        $list=$list->withoutField('password')
            ->page($page->page,$page->limit)
            ->order($sort->order,$sort->desc)
            ->select();
        return listResponse($list,$total);
    }
    public function read($params){
        $data=PowerModel::find($params['id']);
        return successResponse('查询成功',$data);
    }
    public function save($params){
        try {
            validate(PowerValidate::class)->scene('save')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        $data=new PowerModel();
        $data->name=$params['name']??'';
        $data->status=1;
        $data->type=$params['type'];
        if($params['type']==0){
            //检查权限
            $count=PowerModel::where('controller',$params['controller'])
                ->where('action',$params['action'])
                ->count();
            if($count>0){
                return errorResponse('此权限已存在，请勿重复添加');
            }
            $data->controller=$params['controller'];
            $data->action=$params['action'];
            $data->parent_id=$params['parent_id'];
            $data->url=$params['controller'].'-'.$params['action'];
        }else{
            $data->sort=$params['sort'];
        }
        $data->save();
        return successResponse('添加成功');

    }
    public function update($params){
        try {
            validate(PowerValidate::class)->scene('update')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        $data=PowerModel::find($params['id']);
        if(empty($data))return errorResponse('数据不存在');
        $data->name=$params['name']??'';
        $data->status=1;
        $data->type=$params['type'];
        if($params['type']==0){
            //检查权限
            $count=PowerModel::where('controller',$params['controller'])
                ->where('action',$params['action'])
                ->where('id','<>',$data->id)
                ->count();
            if($count>0){
                return errorResponse('此权限已存在，请勿重复添加');
            }
            $data->controller=$params['controller'];
            $data->action=$params['action'];
            $data->parent_id=$params['parent_id'];
            $data->url=$params['controller'].'-'.$params['action'];
        }else{
            $data->sort=$params['sort'];
            $data->controller='';
            $data->action='';
            $data->url='';
            $data->parent_id=0;
        }
        $data->save();
        return successResponse('保存成功');

    }
    public function delete($params){
        $data=PowerModel::find($params['id']);
        if(empty($data))return errorResponse('数据不存在');
        $data->delete();
        return successResponse('删除成功');
    }
    //获取模块列表
    public function modList($params){
        $list=PowerModel::with([
            'children'=>function($q){
                $q->order('sort');
            }
        ])
            ->where('parent_id',0)
            ->where('status',1)
            ->order('sort')
            ->select();
        $total=PowerModel::count('id');
        return listResponse($list,$total);
    }
}