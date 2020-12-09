<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/26
 * Time: 10:41
 */

namespace app\validate;



class ConfigValidate extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'notice'=>'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'notice.require'=>'请输入公告内容',
    ];

    protected $scene = [
        'setNotice'=>['notice']
    ];
}