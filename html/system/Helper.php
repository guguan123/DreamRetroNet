<?php
require_once('TaskTemplate.php');
require_once('Mailbox.php');

class Helper
{
    public static function sendEmail($address, string $subject, $body, array $params = [], array $config = [])
    {
        $taskTemplate = new TaskTemplate($config);
        $taskTemplate->setBody($body)->setParams($params)->setAddress(is_array($address) ? $address : [$address]);
        if ($subject) {
            // 默认从body参数中取标题
            $taskTemplate->setSubject($subject);
        }
        return (new Mailbox)->send($taskTemplate);
    }
}