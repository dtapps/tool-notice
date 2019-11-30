<?php
/*
                   _ooOoo_
                  o8888888o
                  88" . "88
                  (| -_- |)
                  O\  =  /O
               ____/`---'\____
             .'  \\|     |//  `.
            /  \\|||  :  |||//  \
           /  _||||| -:- |||||-  \
           |   | \\\  -  /// |   |
           | \_|  ''\---/''  |   |
           \  .-\__  `-`  ___/-. /
         ___`. .'  /--.--\  `. . __
      ."" '<  `.___\_<|>_/___.'  >'"".
     | | :  `- \`.;`\ _ /`;.`/ - ` : | |
     \  \ `-.   \_ __\ /__ _/   .-` /  /
======`-.____`-.___\_____/___.-`____.-'======
                   `=---='
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
*/

require_once './vendor/autoload.php';

$qywx = new \Tool\Notice\QyWeixin([
    'webhook' => '通知地址'
]);
$ding = new \Tool\Notice\DingDing([
    'webhook' => '通知地址'
]);
$wt = new \Tool\Notice\Worktile([
    'webhook' => '通知地址'
]);
$bc = new \Tool\Notice\BearyChat([
    'webhook' => '通知地址'
]);
$sc = new \Tool\Notice\SendCloud([
    'api_user' => 'apiUser',
    'api_key' => 'apiKey',
    'from' => '发件人邮箱',
    'from_name' => '发件人名称',
    'notice' => '模板名称'
]);

// 邮箱推送
$res = $sc->send('邮箱地址', '邮箱标题', '邮箱描述', [
    "%name%" => ["name对应值"],
    "%content%" => ["content对应值"],
    "%sitename%" => ["sitename对应值"],
]);
if (empty($res)) var_dump($wt->getError());

// 倍洽
$res = $bc->text('测试测试');
if (empty($res)) var_dump($bc->getError());
var_dump($res);

// Worktile
$res = $wt->text(10086, '测试测试');
if (empty($res)) var_dump($wt->getError());
var_dump($res);

// 钉钉机器人
$res = $ding->text('测试测试');
if (empty($res)) var_dump($ding->getError());
var_dump($res);

// 企业微信机器人
$res = $qywx->text('测试测试');
if (empty($res)) var_dump($qywx->getError());
var_dump($res);
