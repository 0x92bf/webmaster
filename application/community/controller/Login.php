<?php
/**
 * Created by PhpStorm.
 * User: szj
 * Date: 2017/9/2
 * Time: 17:07
 */

namespace app\community\controller;


use app\community\model\User;
use think\Controller;
use think\Session;

class Login extends Controller
{
    public function index(){
        return $this->fetch("index");
    }

    public function doLogin(){
        $loginname = input('post.loginname');
        $pwd = input('post.password');
        if(!$loginname || !$pwd){
            $this->error("账号或密码错误","Login/index");
        }
        $pwd = md5(md5($pwd));

        $userInfo = User::get(['loginname'=>$loginname,'password'=>$pwd]);
        if(!$userInfo){
            $this->error("账号或密码错误","Login/index");
        }
        Session::set('realname',$userInfo->realname);
        Session::set("loginUser",$userInfo->loginname);
        Session::set("userid",$userInfo->id);
        $this->redirect('community/Index/index');

    }

    public function logout(){
        Session::clear();
        $this->redirect('community/Login/index');
    }

}