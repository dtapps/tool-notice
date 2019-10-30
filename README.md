# composer-notice
第三方通知聚合

## 安装
```
composer require liguangchun/notice
```

## 更新
```
composer update liguangchun/notice
```

## 删除
```
composer remove liguangchun/notice
```

## 搜索
```
composer search liguangchun/notice
```

## 支持平台
- 钉钉
- 企业微信
- Worktile
- 倍洽
- 邮箱(开发中)

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
### 倍洽机器人
```
use liguangchun\notice\BearyChat;

class Index
{
    public function index()
    {
        // 实例化
        $bc = new BearyChat();
        // 配置通知地址
        $bc->setConfig([
            'key' => 'xxxxxxxxxxxxxxxxxxxx'
        ]);
        // 发送文本消息
        $res = $bc->text('测试测试');
        // 判断是否失败
        if (empty($res)) var_dump($bc->getError());
    }
}
```
### Worktile机器人
```
use liguangchun\notice\Worktile;

class Index
{
    public function index()
    {
        // 实例化
        $wt = new Worktile();
        // 配置通知地址
        $wt->setConfig([
            'key' => 'xxxxxxxxxxxxxxxxxxxx'
        ]);
        // 发送文本消息
        $res = $wt->text('10086',测试测试');
        // 判断是否失败
        if (empty($res)) var_dump($wt->getError());
    }
}
```
