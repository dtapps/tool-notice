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

class SendCloud
{
    /**
     * 邮箱
     * @var string
     */
    protected $url = 'https://api.sendcloud.net/apiv2/mail/sendtemplate';

    /**
     * apiUser
     * @var string
     */
    protected $api_user = '';

    /**
     * apiKey
     * @var string
     */
    protected $api_key = '';

    /**
     * 发件人地址
     * @var string
     */
    protected $from = '';

    /**
     * 发件人名称
     * @var string
     */
    protected $from_name = '';

    /**
     * 邮件模板调用名称
     * @var string
     */
    protected $template = '';

    /**
     * 错误信息
     * @var string
     */
    protected $error = '';

    /**
     * 设置配置
     * @param array $config 配置信息数组
     * @return $this
     */
    public function setConfig(array $config = [])
    {
        if (!empty($config['api_user'])) $this->api_user = $config['api_user'];
        if (!empty($config['api_key'])) $this->api_key = $config['api_key'];
        if (!empty($config['from'])) $this->from = $config['from'];
        if (!empty($config['from_name'])) $this->from_name = $config['from_name'];
        if (!empty($config['template'])) $this->template = $config['template'];
        return $this;
    }

    /**
     * @param string $email 收件人地址
     * @param string $title 邮箱标题
     * @param string $desc 邮箱描述
     * @param array $content 邮箱内容
     * @return bool
     */
    public function send(string $email, string $title, string $desc, array $content)
    {
        $res = $this->send_mail($email, $title, $content, $desc);
        $result = json_decode($res, true);
        if ($result['result'] !== true) {
            $this->error = $result['message'];
            $this->error = $result['statusCode'];
            return false;
        }
        return true;
    }

    /**
     * @param $to
     * @param $subject
     * @param $xsmtpapi
     * @param $content_summary
     * @return false|string
     */
    private function send_mail($to, $subject, $xsmtpapi, $content_summary)
    {
        //您需要登录SendCloud创建API_USER，使用API_USER和API_KEY才可以进行邮件的发送。
        $param = [
            'apiUser' => $this->api_user, // API_USER
            'apiKey' => $this->api_key, // API_KEY
            'from' => $this->from, // 发件人地址
            'fromName' => $this->from_name, // 发件人名称
            'to' => $to, // 地址列表
            'subject' => $subject, // 邮件标题
            'templateInvokeName' => $this->template,// 邮件模板调用名称
            'contentSummary' => $content_summary, // 邮件摘要
            'xsmtpapi' => json_encode([
                'to' => [$to],
                'sub' => $xsmtpapi
            ])// SMTP 扩展字段
        ];
        $data = http_build_query($param);
        var_dump($data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $data
            ));
        $context = stream_context_create($options);
        $result = file_get_contents($this->url, false, $context);

        return $result;
    }
}
