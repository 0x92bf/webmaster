<?php
namespace app\community\controller;

use app\community\model\RoleUser;
use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller
{
    private static $controller;//控制器
    private static $action;//方法
    protected $key;//用户
    protected $userid;//用户id
    protected $encry;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->key = Session::get("loginUser");
        $this->userid = Session::get("userid");
        $this->encry = comEncry("cyanadmin");

        self::$controller = strtolower($request->controller());
        self::$action = strtolower($request->action());
        $this->getAccess();
    }

    public function isLogin(){
        if(!$this->key || !$this->userid){
            return false;
        }else{
            return true;
        }
    }

    public function accessHas(){
        if(md5(md5($this->key)) === $this->encry){
            return true;
        }
        $wantAccess = self::$controller."/".self::$action;
        if(in_array($wantAccess,Session::get('accesslist'))){
            return true;
        }
        return false;

    }

    private function getAccess(){
        $data = RoleUser::getAuthList($this->userid);
        $arr = [];
        foreach ($data as $v){
            $controller = $v['controller'];
            $action = $v['action'];
            array_push($arr,$controller.'/'.$action);

        }
        Session::set("accesslist",$arr);
    }


}
