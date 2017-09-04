<?php

namespace app\community\model;

use think\Db;
use think\Model;

class Node extends Model
{
    protected  $table = 'cyan_auth_node';
    protected static $tb = 'cyan_auth_node';

    /**
     *@content 获取所有控制器
     */
    public static function getAllNode(){
        return Db::table(self::$tb)->where(['pid'=>0])
            ->order(['sort'=>'desc'])->select();
    }

    public static function getByPid($pid){
        return Db::table(self::$tb)->where(['pid'=>$pid])
            ->order(['sort'=>'desc'])->select();
    }
    /**
     *@content 获取所有方法名
     * @param string $pid
     * @return array or false
     */
    public static function getAllMn($pid){
        $res = Db::table(self::$tb)
                 ->field('nodename')
                    ->where(['pid'=>$pid])
                    ->order(['sort'=>'desc'])->select();
        if($res){
            $arr = [];
            $arr = array_column($res,'nodename');
            return $arr;
        }else{
            return false;
        }
    }
}
