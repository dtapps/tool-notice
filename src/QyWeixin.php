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

namespace liguangchun\notice;

class QyWeixin
{
    /**
     * 企业微信自定义机器人接口链接
     * @var string
     */
    protected $url = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=';

    /**
     * 企业微信自定义机器人接口链接
     * @var string
     */
    protected $webhook = '';

    /**
     * 消息类型
     * @var string
     */
    protected $msgType = 'text';

    /**
     * 错误信息
     * @var string
     */
    protected $error = '';

    /**
     * 初始化
     * @return $this
     */
    public function init()
    {
        return $this;
    }

    /**
     * 设置配置
     * @param array $config 配置信息数组
     * @return $this
     */
    public function setConfig(array $config = [])
    {
        if (!empty($config['key'])) $this->webhook = $this->url . $config['key'];
        return $this;
    }

    /**
     * 发送文本消息
     * @param string $content 消息内容
     * @return bool    发送结果
     */
    public function text(string $content = '')
    {
        $this->msgType = 'text';
        return $this->sendMsg([
            'text' => [
                'content' => $content,
            ],
        ]);
    }

    /**
     * 组装发送消息
     * @param array $data 消息内容数组
     * @return bool 发送结果
     */
    public function sendMsg(array $data)
    {
        if (empty($data['msgtype'])) $data['msgtype'] = $this->msgType;
        $this->init();
        $result = json_decode($this->request($data), true);
        if ($result['errcode'] == 0) return true;
        $this->error = $result['errmsg'];
        return false;
    }

    /**
     * 获取错误信息
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 发送数据
     * @param array $postData 发送消息数据数组
     * @return bool|string
     */
    protected function request(array $postData)
    {
        $postStr = json_encode($postData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->webhook);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
