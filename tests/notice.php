<?php
/**
 * 第三方通知聚合
 * (c) Chaim <gc@dtapp.net>
 */

// 初始化
$client = new \tool\notice\Client();
// 钉钉示例
$client->setConfig([
    'webhook' => '通知地址'
]);
// 发送文本信息
$client->dingDingText('测试');

// 企业微信示例
$client->setConfig([
    'webhook' => '通知地址'
]);
// 发送文本信息
$client->qyWxText('测试');
// 发送富文本信息
$client->qyWxMarkdown('测试');

// WorkKile示例
$client->setConfig([
    'webhook' => '通知地址'
]);
// 发送文本信息
$client->workKileText('测试');

// 倍洽示例
$client->setConfig([
    'webhook' => '通知地址'
]);
// 发送文本信息
$client->beAryChatText('测试');
