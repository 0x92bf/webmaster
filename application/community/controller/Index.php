<?php
namespace app\community\controller;

use think\Controller;
use think\Request;
use think\Session;

class Index extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
        $base = new Base($request);
        if(!$base->isLogin()){
            $this->error("请登录","Login/index");
        }
    }

    public function index()
    {
        $username = Session::get('realname');
        $this->assign('name',$username);
        return $this->fetch('index');
    }

    public function welcome(){
        return $this->fetch('welcome');
    }
}
