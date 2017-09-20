<?php
namespace common\components;
use Yii;
/**
 * 调试日志记录类
 * @zz
 */
class _Xlog
{
     //日志默认路径  liunx 默认 @app/runtime/logs
     const LOGPATH = 'D:\www\logs';
     //日志总开关
     const LOGSWITCH = true;
     //debug日志开关
     const LOGDEBUG = true;

     //调试日志
     static public function __logDebug($app='namespace', $msg='',$msg2=NULL,$msg3=NULL,$msg4=NULL,$msg5=NULL,$msg6=NULL,$msg7=NULL,$msg8=NULL,$msg9=NULL){
          if(self::LOGDEBUG === false){
               return;
          }
          $app = 'debug-'.$app;
          self::__log($app,$msg,$msg2,$msg3,$msg4,$msg5,$msg6,$msg7,$msg8,$msg9);
     }
     //业务日志
     static public function __logRecord($app='namespace',$msg='',$msg2=NULL,$msg3=NULL,$msg4=NULL,$msg5=NULL,$msg6=NULL,$msg7=NULL,$msg8=NULL,$msg9=NULL){
          self::__log($app,$msg,$msg2,$msg3,$msg4,$msg5,$msg6,$msg7,$msg8,$msg9);
     }

     /**
      * 是否是类unix系统
      */
     public static function _isUnixOs(){
          $os_name = PHP_OS;
          if(stripos($os_name,"Linux")!==false){
               return true;
          }else if(stripos($os_name,"WIN")!==false){
               return false;
          }
          //默认linux
          return true;
     }

     /**
      * 无情的日志记录函数,区分多进程进行记录
      * @param string $app
      * @param string $msg
      * @param string $msg2
      * @param string $msg3
      * @param string $msg4
      * @param string $msg5
      * @param string $msg6
      * @param string $msg7
      * @param string $msg8
      * @param string $msg9
      */
     public static function __log($app='namespace',$msg='',$msg2=NULL,$msg3=NULL,$msg4=NULL,$msg5=NULL,$msg6=NULL,$msg7=NULL,$msg8=NULL,$msg9=NULL)
     {
          if(self::LOGSWITCH === false){
               return;
          }
          //2016-10-13T16:27:53+08:00  | 错误值反馈  |   [-3] | [数据未获取到]
          //$date = date('c');
          $date = date('Y-m-d H:i:s');
          $data = self::_utf8_json($msg);
          if (isset($msg2)) $data .= '  |  '.self::_utf8_json($msg2);
          if (isset($msg3)) $data .= '  |  '.self::_utf8_json($msg3);
          if (isset($msg4)) $data .= '  |  '.self::_utf8_json($msg4);
          if (isset($msg5)) $data .= '  |  '.self::_utf8_json($msg5);
          if (isset($msg6)) $data .= '  |  '.self::_utf8_json($msg6);
          if (isset($msg7)) $data .= '  |  '.self::_utf8_json($msg7);
          if (isset($msg8)) $data .= '  |  '.self::_utf8_json($msg8);
          if (isset($msg9)) $data .= '  |  '.self::_utf8_json($msg9);
          $log =   $date . '  |  ' . $app . '  |  '.$data . "\r\n";

          if(self::_isUnixOs()){
               //linux os
               //$path = '/tmp';
               $path = \Yii::getAlias('@app/runtime/logs/');
          }else{
               //Win os
               //$path = self::LOGPATH;
               $path = \Yii::getAlias('@app/runtime/logs/');
          }

          if(!is_dir($path))
               mkdir($path,0777,true);
          //$file = rtrim($path,'/').'/' . $app.'-'.date('Ymd').'.log';
          $file = rtrim($path,'/').'/' . $app.'.log';
          file_put_contents($file, ($log) . "",FILE_APPEND);
          unset($data,$msg,$msg2,$msg3,$msg4,$msg5);
     }

     /**
      * 将Json数据更好的展示出来
      * @param string|array|object $data
      * @return string
      */
     public static function _utf8_json($data,$json = true)
     {
          if($json){
               if (is_array($data) || is_object($data)) {
                    $data = json_encode($data);
                    $data = preg_replace_callback("#\\\u([0-9a-f]{4})#i", function($r){
                         return iconv('UCS-2BE', 'UTF-8', pack('H4', "{$r[1]}"));
                    } , $data);
                    $data = str_replace("\\", "", $data);
               }
               return '['.$data.'] ';
               //return $data;
          }else{
               return is_array($data)?var_export($data,true):$data;
          }
     }

}