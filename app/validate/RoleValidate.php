<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/26
 * Time: 10:41
 */

namespace app\validate;



class RoleValidate extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'name'=>'require',
        'power_id'=>'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'name.require'=>'请输入模块名称',
        'power_id.require'=>'请输入排序值',
    ];

    protected $scene = [
        'save'=>['name','power_id'],
        'update'=>['name','power_id'],
    ];
}