<?php
/**
 * Created by PhpStorm.
 * User: szj
 * Date: 2017/8/30
 * Time: 15:57
 */

namespace app\community\controller;


use app\community\model\Access;
use app\community\model\Node;
use app\community\model\Role;
use app\community\model\RoleUser;
use app\community\model\User;
use think\Controller;
use think\Request;

class Admin extends Base
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        if(!$this->accessHas()){
            $this->error("无权限","community/Index/welcome");
        }
    }

    /*
     * @content 角色主页*/
    public function role(){

        $allRoles = Role::getAllRoles();
        $count = count($allRoles);
        if($count>=1 && $allRoles){
            $this->assign("data",$allRoles);
            $this->assign("count",$count);
        }else{
            $this->assign("data",[]);
            $this->assign("count",0);
        }

        return $this->fetch("role");
    }

    /**
     * @content 新增角色页面
     */
    public function addRole(){
        $listControl = Node::getAllNode();
        if($listControl){
            $pack = [];//封装数据
            foreach ($listControl as $k => $v){
                $control = $v['node'];
                $controlname = $v['nodename'];
                $id = $v['id'];
                $listMethod = Node::getByPid($id);
                $pack[$k]['controlname'] = $controlname;
                if($listMethod){
                    $pack[$k]['methods'] = $listMethod;
                }else{
                    $pack[$k]['methods'] = [];
                }

            }
            $this->assign('pack',$pack);
        }else{
            $this->assign('pack',[]);
        }
        return $this->fetch('addRole');
    }

    /**
     *@content 执行增加新角色
     */
    public function doAddRole(){
        $roleName = input('post.roleName');
        $remark = input('post.remark',null);
        if(Request::instance()->has('methodid','post')){
            $methodId = $_POST['methodid'];
        }else{
            $methodId = [];
        }
        $listorder = input('post.listorder',0);
        if(Role::get(['name'=>$roleName])){
            return json(['code'=>0,'msg'=>'role already exist']);
        }
        $role = new Role();
        $role->name = $roleName;
        $role->create_time = time();
        $role->update_time = time();
        $role->remark = $remark;
        $role->listorder = $listorder;
        if($role->save()){
            $insertId = $role->id;
            if($methodId){
                foreach ($methodId as $v){
                    $data[] = ['role_id'=>$insertId,'node_id'=>$v];
                }
                $access = new Access();
                if(!$access->saveAll($data)){
                    return json(['code'=>0,'msg'=>'access error']);
                }
            }
            return json(['code'=>1,'msg'=>'success']);
        }else{
            return json(['code'=>0,'msg'=>'role insert error']);
        }

    }

    /**
     *@content 角色修改页面
     */
    public function editRole(){
        $roleid = input('get.roleid');
        $role = Role::get($roleid);
        $roleName = $role->name;
        $remark = $role->remark;
        $listControl = Node::getAllNode();
        if($listControl){
            $pack = [];//封装数据
            foreach ($listControl as $k => $v){
                $control = $v['node'];
                $controlname = $v['nodename'];
                $id = $v['id'];
                $listMethod = Node::getByPid($id);
                $pack[$k]['controlname'] = $controlname;
                if($listMethod){
                    $pack[$k]['methods'] = $listMethod;
                }else{
                    $pack[$k]['methods'] = [];
                }

            }
            $this->assign('pack',$pack);
        }else{
            $this->assign('pack',[]);
        }
        $this->assign('roleName',$roleName);
        $this->assign('remark',$remark);
        $this->assign('roleid',$roleid);
        return $this->fetch('editRole');
    }

    /**
     *@content 获取role权限信息
     */
    public function getRoleAcc(){
        $roleid = input('post.roleid');
        $arr = Access::getRoleId($roleid);
        if($arr){
            return json(['code'=>1,'msg'=>$arr]);
        }else{
            return json(['code'=>0,'msg'=>'nothing']);
        }

    }

    /**
     *@content 更新角色权限
     */
    public function upRoleAcc(){
        $roleName = input('post.roleName');
        $remark = input('post.remark',null);
        $roleid = input('post.roleid');
        if(Request::instance()->has('methodid','post')){
            $methodId = $_POST['methodid'];
        }else{
            $methodId = [];
        }
        $listorder = input('post.listorder',0);

        $role = Role::get($roleid);
        $role->name = $roleName;
        $role->update_time = time();
        $role->remark = $remark;
        $role->listorder = $listorder;
        if($role->save()){
            Access::delByRoleid($roleid);
            if($methodId){
                foreach ($methodId as $v){
                    $data[] = ['role_id'=>$roleid,'node_id'=>$v];
                }
                $access = new Access();
                if(!$access->saveAll($data)){
                    return json(['code'=>0,'msg'=>'access error']);
                }
            }
            return json(['code'=>1,'msg'=>'success']);
        }else{
            return json(['code'=>0,'msg'=>'role insert error']);
        }
    }

    /**
     * @content 删除角色
     */
    public function delRole(){
        $roleid = input('post.roleid');
        if($roleid){
            if(Role::destroy($roleid)){
                if(Access::delByRoleid($roleid)){
                    return json(['code'=>1,'msg'=>'success']);
                }else{
                    return json(['code'=>0,'msg'=>'access del error']);
                }
            }else{
                return json(['code'=>0,'msg'=>'role del error']);
            }
        }else{
            return json(['code'=>0,'msg'=>'param error']);
        }

    }

    /*
     * @content 权限管理
     */
    public function auth(){
        $listControl = Node::getAllNode();
        $count = count($listControl);
        if($listControl && $count>=1){
            foreach ($listControl as $k => $v){
                $listMethod = Node::getAllMn($v['id']);
                if($listMethod){
                    $listControl[$k]['method'] = implode(",",$listMethod);
                }else{
                    $listControl[$k]['method'] = '';
                }

            }
            $this->assign('data',$listControl);
            $this->assign('count',$count);
        }else{
            $this->assign('data',[]);
            $this->assign('count',0);
        }
        return $this->fetch("auth");
    }

    /**
     *@content 增加控制器节点
     */
    public function addChildNode(){
        $nodeid = input('get.nodeid');
        $info = Node::getByPid($nodeid);
        $controlInfo = Node::get($nodeid);
        $count = count($info);
        if($info && $count>=1){
            $this->assign("data",$info);
            $this->assign("count",$count);
        }else{
            $this->assign('data',[]);
            $this->assign('count',0);
        }
        $this->assign("control",$controlInfo->node);
        $this->assign("controlname",$controlInfo->nodename);
        $this->assign("pid",$nodeid);
        return $this->fetch("addChildNode");
    }

    /**
     *@content 删除控制器节点
     */
    public function delNode(){
        $nodeid = input('post.nodeid',null);
        if($nodeid){
            if(Node::get(['pid'=>$nodeid])){
                return json(['code'=>0,'msg'=>'has child cannot del']);
            }
            if(Node::destroy(['id'=>$nodeid])){
                return json(['code'=>1,'msg'=>'success']);
            }else{
                return json(['code'=>0,'del error']);
            }
        }else{
            return json(['code'=>0,'msg'=>'param error']);
        }
    }

    /**
     *@content 增加控制器节点操作页
     */
    public function acNodeHt(){
        $nodeid = input('get.nodeid');
        $this->assign('pid',$nodeid);
        return $this->fetch('acNodeHt');
    }

    /**
     *@content 执行方法添加
     */
    public function doAddMethod(){
        $method = input('post.method');
        $methodname = input('post.methodname');
        $sort = input('post.sort',99);
        $pid = input('post.pid');
        if(!$method || !$methodname || !$pid){
            return json(['code'=>0,'msg'=>'param error']);
        }
        $node = new Node();
        if(Node::get(['node'=>$method])){
            return json(['code'=>0,'msg'=>'method repeat']);
        }
        $node->node = $method;
        $node->nodename = $methodname;
        $node->pid = $pid;
        $node->sort = $sort;
        if($node->save()){
            return json(['code'=>1,'msg'=>'success']);
        }else{
            return json(['code'=>0,'msg'=>'insert error']);
        }
    }

    /**
     *@content 删除方法节点
     */
    public function delMethod(){
        $nodeid = input('post.nodeid',null);
        if(!$nodeid){
            return json(['code'=>0,'msg'=>'param error']);
        }
        if(Node::destroy($nodeid)){
            return json(['code'=>1,'msg'=>'success']);
        }else{
            return json(['code'=>0,'msg'=>'del error']);
        }

    }

    /**
     *@content 增加权限节点
     */
    public function addNode(){
        $control = '';
        $controlname = '';
        $id = '';
        $isupdate = 0;
        if(input('get.nodeid')){
            $nodeid = input('get.nodeid');
            $node = Node::get(['id'=>$nodeid]);
            $control = $node->node;
            $controlname = $node->nodename;
            $id = $node->id;
            $isupdate = 1;
        }
        $this->assign('nodeid',$id);
        $this->assign('node',$control);
        $this->assign('nodename',$controlname);
        $this->assign('isupdate',$isupdate);

        return $this->fetch("addNode");
    }
    /**
     *@content 修改控制器信息
     */
    public function editNode(){
        $control = input("post.control");
        $controlname = input("post.controlname");
        $nodeid = input('post.nodeid');
        $sort = input("post.sort",99);
        if($control && $controlname && $nodeid){
            $node = Node::get(['id'=>$nodeid]);
            $node->node = $control;
            $node->nodename = $controlname;
            $node->sort = $sort;
            if($node->save()){
                return json(["code"=>1,"msg"=>"success"]);
            }else{
                return json(["code"=>0,"msg"=>"insert error"]);
            }
        }else{
            return json(["code"=>0,"msg"=>"参数异常"]);
        }
    }

    /**
     *@content 执行增加控制器
     */
    public function doAddNode(){
        $control = input("post.control");
        $controlname = input("post.controlname");
        $sort = input("post.sort",99);
        if($control && $controlname){
            $node = new Node();
            if(Node::get(['node'=>$control])){
                return json(["code"=>0,"msg"=>"control repeat"]);
            }
            $node->node = $control;
            $node->nodename = $controlname;
            $node->pid = 0;
            $node->sort = $sort;
            if($node->save()){
                return json(["code"=>1,"msg"=>"success"]);
            }else{
                return json(["code"=>0,"msg"=>"insert error"]);
            }
        }else{
            return json(["code"=>0,"msg"=>"参数异常"]);
        }
    }

    /**
     *@content 管理员列表
     */
    public function sysUser(){
        $users = User::getAllUser();
        $this->assign('users',$users);
        return $this->fetch("sysUser");
    }

    /**
     *@content  新增管理员
     */
    public function addUser(){
        if(Request::instance()->isPost()){

            $adminName = input('post.adminName');
            if(User::get(['loginname'=>$adminName])){
                return json(['code'=>0,'msg'=>'admin exist']);
            }
            $realName = input('post.realName');
            $password = input('post.password');
            $password2 = input('post.password2');
            $phone = input('post.phone');
            $adminRole = input('post.adminRole');
            if($password !== $password2){
                return json(['code'=>0,'msg'=>'password not match']);
            }
            $user = new User();
            $user->realname = $realName;
            $user->loginname = $adminName;
            $user->password = md5(md5($password));
            $user->phone = $phone;
            if($user->save()){
                $userid = $user->id;
                $roleUser = new RoleUser();
                $roleUser->role_id = $adminRole;
                $roleUser->user_id = $userid;
                if($roleUser->save()){
                    return json(['code'=>1,'msg'=>'success']);
                }else{
                    return json(['code'=>0,'msg'=>'roleuser save error']);
                }

            }else{
                return json(['code'=>0,'msg'=>'user save error']);
            }
        }else{
            $roles = Role::getAllRoles();
            $arr = [];
            foreach ($roles as $k => $v){
                $arr[$k]['roleid'] = $v['id'];
                $arr[$k]['rolename'] = $v['name'];
            }
            $this->assign('data',$arr);
            return $this->fetch('addSys');
        }

    }

    /**
     *@content 修改管理员
     */
    public function editSys(){
        if(Request::instance()->isPost()){

            $userid = input('post.userid');
            $user = User::get($userid);
            $adminName = input('post.adminName');
            $realName = input('post.realName');
            $password = input('post.password');
            $password2 = input('post.password2');
            $phone = input('post.phone');
            $adminRole = input('post.adminRole');
            if($adminName){
                $user->loginname = $adminName;
            }
            if($realName){
                $user->realname = $realName;
            }
            if($password && $password2){
                if($password !== $password2){
                    return json(['code'=>0,'msg'=>'password not match']);
                }
                $user->password = md5(md5($password));
            }
            if($phone){
                $user->phone = $phone;
            }
            $user->save();
            $roleUser = RoleUser::get(['user_id'=>$userid]);
            $roleUser->role_id = $adminRole;
            $roleUser->save();
            return json(['code'=>1,'msg'=>'success']);
        }else{
            $userid = input('get.userid');
            $roles = Role::getAllRoles();
            $user = User::getUserById($userid);
            $arr = [];
            foreach ($roles as $k => $v){
                $arr[$k]['roleid'] = $v['id'];
                $arr[$k]['rolename'] = $v['name'];
            }
            $this->assign('userid',$userid);
            $this->assign('user',$user);
            $this->assign('data',$arr);
            return $this->fetch('editSys');
        }
    }

    /**
     *@content 更新管理员状态
     */
    public function upSys(){
        $userid = input('post.id');
        $status = input('post.status');
        $user = User::get(['id'=>$userid]);
        $user->status = $status;
        if($user->save()){
            return json(['code'=>1]);
        }else{
            return json(['code'=>0]);
        }
    }

    /**
     *@content 删除管理员
     */
    public function delSys(){
        $userid = input('post.id');
        if(RoleUser::del($userid)){
            if(User::destroy($userid)){
                return json(['code'=>1]);
            }else{
                return json(['code'=>0]);
            }
        }else{
            return json(['code'=>0]);
        }
    }
}