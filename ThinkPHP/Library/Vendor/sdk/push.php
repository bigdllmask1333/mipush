<?php
namespace sdk;
use xmpush\Builder;

use xmpush\Sender;
use xmpush\Constants;

use xmpush\TargetedMessage;

use xmpush\IOSBuilder;

use xmpush\Stats;
use xmpush\Tracer;

include_once(dirname(__FILE__) . '/autoload.php');

class push
{
    /*
     *  $style   int 推送方式,1,安卓,2,苹果,3,安卓推送打开应用内的某个activity
     *  $aliasList  array,格式为array("1,2,3,4,5,6"),也就是推送的目标别名
     *  $titlse  String     推送标题
     *  $conent  String     推送内容
     *  $payload String     暂时不用
     *  注:因为写的比较仓促,可以将  3  内的跳转到指定activity的参数放在参数列表,以方便调用
     *     也可以将if else 改为switch,此类为举例,完全可以自己构思这个类,我只是举个例子
     * */
    public function pushs($style,$aliasList,$titlse,$conent,$payload="")
    {
        $id = (int)$style;
        $desc = $conent;
        if($id == 1){
            $secret = 'jX0Qc5u9SqPwgsFJrrPoSA==';
            $package = 'com.yikuaiqian.shiye';
            Constants::setPackage($package);
            Constants::setSecret($secret);
            $title = $titlse;
            $sender = new Sender();
            $message = new Builder();
            $message->title($title);
            $message->description($desc);
            $message->passThrough(0);
            $message->payload($payload); // 对于预定义点击行为，payload会通过点击进入的界面的intent中的extra字段获取，而不会调用到onReceiveMessage方法。
            $message->extra(Builder::notifyEffect, 1); // 此处设置预定义点击行为，1为打开app
            $message->extra(Builder::notifyForeground, 1);
            $message->notifyId(0);
            $message->build();
            $targetMessage2 = new TargetedMessage();
            $targetMessage2->setTarget('tag', TargetedMessage::TARGET_TYPE_ALIAS);
            $targetMessage2->setMessage($message);
            $targetMessageList = array( $targetMessage2);
        }else if($id == 2){
            $secret = '填写参数';
            $bundleId = '填写参数';
            Constants::setBundleId($bundleId);
            Constants::setSecret($secret);
            $message = new IOSBuilder();
            $message->description($desc);
            $message->soundUrl('default');
            $message->badge('4');
            $message->extra('payload', $payload);
            $message->build();
            $sender = new Sender();
        }else if($id == 3){
            $secret = '填写参数';
            $package = '填写参数';
            Constants::setPackage($package);
            Constants::setSecret($secret);
            $title = $titlse;
            $sender = new Sender();
            $message = new Builder();
            $message->title($title);
            $message->description($desc);
            $message->passThrough(0);
            $message->payload($payload); // 对于预定义点击行为，payload会通过点击进入的界面的intent中的extra字段获取，而不会调用到onReceiveMessage方法。
            $message->extra(Builder::notifyEffect, 2); // 此处设置预定义点击行为，1为打开app,2为打开应用内的activity
            $message->extra(Builder::notifyForeground, 1);
            $message->extra(Builder::intentUri, "intent:#Intent;component=包名/完整的activity路径;end"); //打开应用内activity必须添加此参数
            $message->notifyId(0);
            $message->build();
            $targetMessage2 = new TargetedMessage();
            $targetMessage2->setTarget('tag', TargetedMessage::TARGET_TYPE_ALIAS);
            $targetMessage2->setMessage($message);
            $targetMessageList = array( $targetMessage2);
        }
        print_r($sender->sendToAliases($message,$aliasList)->getRaw());
    }
    public function dd(){
        echo 12333;
    }
}

?>