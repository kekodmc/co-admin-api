<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/26
 * Time: 10:41
 */

namespace app\validate;



class AdminValidate extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'id'=>'require',
        'type'=>'require|in:on,off',
        'username'=>'require',
        'password'=>'require',
        'role_id'=>'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'id.require'=>'请输入参数',
        'type.require'=>'请设置类型',
        'type.in'=>'无效的类型值',
        'username.require'=>'请输入登录名',
        'password.require'=>'请输入密码',
        'role_id.require'=>'请选择权限',
    ];

    protected $scene = [
        'save'=>['username','password','role_id'],
        'update'=>['username','role_id'],
        'disable'=>['id','type'],
    ];
}