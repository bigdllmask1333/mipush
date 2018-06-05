<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function push(){
        Vendor('sdk.push');
        $push = new \sdk\push();

        $user = array("2882303761517800549");
//        $push->pushs(1,$user,"在游戏中消费100元","获得了奖励注意查收");


        for ($x=0; $x<=10; $x++) {
            $push->pushs(1,$user,"快活啊","好热啊！");
        }



        /*推送包名
        package    com.yikuaiqian.shiye
        用户别名   APPID    2882303761517800549
        appKey   5341780066549
        secret   appSecret   jX0Qc5u9SqPwgsFJrrPoSA==*/

//至此,融合完成,调用即可进行推送,注意配置文件的写入
//        $str="qktzEm2LCPTuaWDF743INnsC7XmFDM+j5Q30CK9wj3o=";
//        $cc=base64_decode($str);
//        var_dump($cc);
    }

    public function dd(){
        echo 123;
    }
}