<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/26
 * Time: 10:41
 */

namespace app\validate;



class PowerValidate extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'type'=>'require',
        'name'=>'requireIf:type,1',
        'controller'=>'requireIf:type,0',
        'action'=>'requireIf:type,0',
        'parent_id'=>'requireIf:type,0',
        'sort'=>'requireIf:type,1',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'type.require'=>'请选择类型',
        'name.requireIf'=>'请输入模块名称',
        'sort.requireIf'=>'请输入排序值',
        'controller.requireIf'=>'请输入控制器名称',
        'action.requireIf'=>'请输入方法名称',
        'parent_id.requireIf'=>'请选择所属模块',
    ];

    protected $scene = [
        'save'=>['type','name','sort','controller','action','parent_id'],
        'update'=>['type','name','sort','controller','action','parent_id'],
    ];
}