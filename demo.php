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

$qywx = new \liguangchun\notice\QyWeixin();
$ding = new \liguangchun\notice\DingDing();
$wt = new \liguangchun\notice\Worktile();
$bc = new \liguangchun\notice\BearyChat();
$sc = new \liguangchun\notice\SendCloud();

// 邮箱推送
$sc->setConfig([
    'api_user' => 'apiUser',
    'api_key' => 'apiKey',
    'from' => '发件人邮箱',
    'from_name' => '发件人名称',
    'notice' => '模板名称'
]);
$res = $sc->send('邮箱地址', '邮箱标题', '邮箱描述', [
    "%name%" => ["name对应值"],
    "%content%" => ["content对应值"],
    "%sitename%" => ["sitename对应值"],
]);
if (empty($res)) var_dump($wt->getError());

// 倍洽
$bc->setConfig([
    'key' => 'xxxxxxxxxxxxxxxxxxxx'
]);
$res = $bc->text('测试测试');
if (empty($res)) var_dump($bc->getError());
var_dump($res);

// Worktile
$wt->setConfig([
    'key' => 'xxxxxxxxxxxxxxxxxxxx'
]);
$res = $wt->text(10086, '测试测试');
if (empty($res)) var_dump($wt->getError());
var_dump($res);

// 钉钉机器人
$ding->setConfig([
    'access_token' => 'xxxxxxxxxxxxxxxxxxxx'
]);
$res = $ding->text('测试测试');
if (empty($res)) var_dump($ding->getError());
var_dump($res);

// 企业微信机器人
$qywx->setConfig([
    'key' => 'xxx-xx-xx-xx-xxx'
]);
$res = $qywx->text('测试测试');
if (empty($res)) var_dump($qywx->getError());
var_dump($res);
