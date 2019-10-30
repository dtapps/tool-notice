# composer-notice
第三方通知聚合

## 安装
```
composer require liguangchun/notice
```

## 使用

可参考包里demo.php文件或使用下面的方法

### 钉钉机器人
```
use liguangchun\notice\DingDing;

class Index
{
    public function index()
    {
        // 实例化
        $ding = new DingDing();
        // 配置通知地址
        $ding->setConfig([
            'access_token' => 'xxxxxxxxxxxxxxxxxxxx'
        ]);
        // 发送文本消息
        $res = $ding->text('测试测试');
        // 判断是否失败
        if (empty($res)) var_dump($ding->getError());
    }
}
```

### 企业微信机器人
```
use liguangchun\notice\QyWeixin;

class Index
{
    public function index()
    {
        // 实例化
        $qywx = new QyWeixin();
        // 配置通知地址
        $qywx->setConfig([
            'key' => 'xxx-xx-xx-xx-xxx'
        ]);
        // 发送文本消息
        $res = $qywx->text('测试测试');
        // 判断是否失败
        if (empty($res)) var_dump($qywx->getError());
    }
}
```
