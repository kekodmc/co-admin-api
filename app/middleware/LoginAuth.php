<?php
declare (strict_types = 1);

namespace app\middleware;

use think\Request;

class LoginAuth
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $token=$request->header('token','');
        if(empty($token)){
            return $this->logout();
        }
        $data=cache($token);
        if(empty($data)){
            return $this->logout();
        }
        $data=json_decode($data,true);
        $request->uid=$data['id'];
        $request->token=$token;
        //检查权限
        $power=$data['power'];
        if(!$this->checkPower($power,$request)){
            return errorResponse('您的权限不足'.$request->controller(true).'-'.$request->action());
        }
        return $next($request);
    }
    //未登录
    protected function logout(){
        return errorResponse('请重新登录',401);
    }
    //检查权限
    protected $safeList=[
        'login-logout',
        'account-update',
    ];//白名单
    protected function checkPower($power,Request $request){
        $c=$request->controller(true);
        $a=$request->action();
        $url="$c-$a";
        if(in_array($url,$this->safeList)){
            return true;
        }
        if(in_array($url,$power)){
            return true;
        }
        return false;
    }
}
