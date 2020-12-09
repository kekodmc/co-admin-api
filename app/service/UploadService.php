<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/12/1
 * Time: 18:38
 */

namespace app\service;


use app\validate\UploadValidate;
use think\exception\ValidateException;
use think\facade\App;
use think\facade\Filesystem;
use think\Image;

class UploadService extends BaseService
{
    //图片上传
    public function img($params){
        try {
            validate(UploadValidate::class)->scene('img')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        try{
            $image=Image::open($params['file']);
        }catch (\Exception $e){
            return errorResponse('请上传正确的图片文件');
        }
        //创建目录
        $path='/uploads/'.date('Ymd').'/';
        $root_path=App::getInstance()->getRootPath().'public';
        $this->mkdirs($root_path.'/uploads');// 检查uploads目录是否存在
        $this->mkdirs($root_path.$path);
        //生成文件名
        $filename=$this->make_file_name().'.'.$image->type();
        $url=getHost().$path.$filename;// 图片访问路径
        try{
            //压缩并保存图片
            switch ($params['type']){
                case 'avatar':
                    // 头像
                    $image->thumb(200,200,Image::THUMB_CENTER)->save($root_path.$path.$filename);
                    break;
                default:
                    //普通图片
                    $image->thumb(1000,1000,Image::THUMB_SCALING)->save($root_path.$path.$filename);
            }
        }catch (\Exception $e){
            return errorResponse('上传图片失败',400,$e->getMessage());
        }
        return successResponse('上传成功',[
            'url'=>$url
        ]);
    }
    //普通文件上传
    public function file($params){
        try {
            validate(UploadValidate::class)->scene('file')->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return errorResponse($e->getError());
        }
        $fielname=Filesystem::disk('public')->putFile('/uploads',$params['file']);
        return successResponse('上传成功',['url'=>'http://'.$_SERVER['HTTP_HOST'].'/'.$fielname]);
    }
    //创建目录
    protected function mkdirs($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) return true;
        return @mkdir($dir, $mode);
    }
    //生成文件名
    protected function make_file_name($user_id=1){
        return $user_id.uniqid().rand(100,999);
    }
}