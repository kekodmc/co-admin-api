<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/26
 * Time: 10:41
 */

namespace app\validate;



class UploadValidate extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'file'=>'require|file',
        'type'=>'require|in:file,avatar,content',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'file.require'=>'请选择要上传的文件',
        'file.file'=>'请上传正确的文件',
        'type.require'=>'请设置上传类型',
        'type.in'=>'无效的上传类型',
    ];

    protected $scene = [
        'img'=>['file','type'],
        'file'=>['file','type'],
    ];
}