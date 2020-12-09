<?php
// 应用公共文件

//返回成功
function successResponse($msg='操作成功',$data=[]){
    return json([
        'code'=>200,
        'msg'=>$msg,
        'data'=>$data,
    ]);
}
//返回失败
function errorResponse($msg='操作失败',$code=400,$data=[]){
    return json([
        'code'=>$code,
        'msg'=>$msg,
        'data'=>$data,
    ]);
}
//返回列表
function listResponse($list,$total){
    return json([
        'code'=>200,
        'msg'=>'查询成功',
        'data'=>[
            'list'=>$list,
            'total'=>$total
        ],
    ]);
}
//创建登录令牌
function createToken($str=''){
    $string  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890'.$str;
    //打乱字符串
    $randStr = str_shuffle($string);
    //substr(string,start,length);返回字符串的一部分
    $rands   = substr($randStr,0,6);
    // 参数一：截取的字符串 uniqid() 微秒 ，参数二：从哪里开始，参数三：长度
    $token   = substr(md5(uniqid()).md5($rands),16,26);
    // 用英文作为开头
    $start  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    //打乱字符串
    $randStart = str_shuffle($start);
    //substr(string,start,length);返回字符串的一部分
    $randStart   = substr($randStart,0,6);
    return $randStart.$token;
}
//获取分页
function getPage($params){
    $page=$params['page']??1;
    $limit=$params['limit']??10;
    $page=$page<1?1:$page;
    $limit=$limit<1?10:$limit>30?30:$limit;
    $obj=new \stdClass();
    $obj->page=$page;
    $obj->limit=$limit;
    return $obj;
}
//获取排序
function getSort($params){
    $order=$params['order']??'';
    $desc=$params['desc']??'';
    $obj=new \stdClass();
    $obj->order=$order;
    $obj->desc=$desc;
    return $obj;
}
//获取域名
function getHost() {
    if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
        return 'https://'.$_SERVER['HTTP_HOST'];
    }elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
        return 'https://'.$_SERVER['HTTP_HOST'];
    }
    return 'http://'.$_SERVER['HTTP_HOST'];
}