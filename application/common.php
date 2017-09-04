<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/*
* 日志记录
* @param $file       (string)  文件夹名称
* @param $module     (string)  功能模块名称
* @param $msgString  (string)  日志内容
*/
function writeLogs($file,$module,$msgString){
    $month=date('Ym',time());
    $logPath=RUNTIME_PATH.'log/'.$file."/".$module.'/';
    $msgString = date('H:s:i',time()).$msgString . "\r\n" . "\r\n";
    $logPath=$logPath.$month.'/';
    $filename=date('Ymd',time()).'.log';
    $filename=$logPath.$filename;
    if(!file_exists($logPath)){
        mkdir($logPath,0777,true);
    }
    file_put_contents( $filename,$msgString,FILE_APPEND);
}