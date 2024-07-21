<?php
require_once('PHPMailer/Exception.php');
require_once('PHPMailer/OAuth.php');
require_once('PHPMailer/POP3.php');
require_once('PHPMailer/SMTP.php');
require_once('PHPMailer/PHPMailer.php');

use PHPMailer\PHPMailer\PHPMailer;

class Mailbox
{
    protected $phpMailer;

    public function __construct()
    {
        $this->phpMailer = new PHPMailer(true);
    }

    public function send(\TaskTemplate $taskTemplate)
    {
        try {
            // 实例化PHPMailer核心类
            $phpMailer = $this->phpMailer;
            // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
            $phpMailer->SMTPDebug = $taskTemplate->isSmtpDebug();
            // 使用smtp鉴权方式发送邮件
            $phpMailer->isSMTP();
            // smtp需要鉴权 这个必须是true
            $phpMailer->SMTPAuth = true;
            $phpMailer->Host = $taskTemplate->getHost();
            // 设置使用ssl加密方式登录鉴权
            $phpMailer->SMTPSecure = 'ssl';
            // 设置ssl连接smtp服务器的远程服务器端口号
            $phpMailer->Port = $taskTemplate->getPort();
            // 设置发送的邮件的编码
            $phpMailer->CharSet = $taskTemplate->getCharSet();
            // 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
            $phpMailer->FromName = $taskTemplate->getNickname();
            // smtp登录的账号
            $phpMailer->Username = $taskTemplate->getUsername();
            // smtp登录的密码 使用生成的授权码
            $phpMailer->Password = $taskTemplate->getPassword();
            // 设置发件人邮箱地址 同登录账号
            $phpMailer->From = $taskTemplate->getUsername();
            // 邮件正文是否为html编码 注意此处是一个方法
            $phpMailer->isHTML($taskTemplate->isHTML());

            if (empty($taskTemplate->getAddress())) {
                throw new Exception('缺少收件人地址');
            }
            // 添加收件人邮箱地址
            foreach ($taskTemplate->getAddress() as $mail) {
                $phpMailer->addAddress($mail);
            }
            // 添加该邮件的主题
            $phpMailer->Subject = $taskTemplate->getSubject();
            // 添加邮件正文
            $phpMailer->Body = self::interpolate($taskTemplate->getBody(), $taskTemplate->getParams());
            //  判断是否有内容
            if (empty($phpMailer->Body)) {
                throw new Exception('邮件正文内容不能为空');
            }

            // 发送邮件
            $phpMailer->send();

            return [true, '发送成功'];
        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }
    public static function interpolate($message, array $context = array())
    {
        // 构建一个花括号包含的键名的替换数组
        $replace = array();
        foreach ($context as $key => $val) {
            // 检查该值是否可以转换为字符串
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }
        // 替换记录信息中的占位符，最后返回修改后的记录信息。
        return strtr($message, $replace);
    }

    /**
     * @return PHPMailer
     */
    public function getPhpMailer(): PHPMailer
    {
        return $this->phpMailer;
    }
}