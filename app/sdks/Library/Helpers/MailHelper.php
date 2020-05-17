<?php

namespace App\Sdks\Library\Helpers;

/**
 * 邮件帮助类库
 *
 * 
 * @link https://swiftmailer.symfony.com
 */
class MailHelper
{
    /**
     * 获取配置
     *
     * @return array
     */
    protected static function getConfig()
    {
        return DiHelper::getConfig()->mail->toArray();
    }

    /**
     * 发送邮件
     *
     * @param  string $subject
     * @param  string $body
     * @param  array  $to_mails
     * @param  array  $attachments
     * @return bool
     */
    public static function send($subject, $body, $to_mails = [], $attachments = [])
    {
        // 获取配置
        $mail = self::getConfig();

        $transport = new \Swift_SmtpTransport($mail['host'], $mail['port']);
        $transport->setUsername($mail['user_name'])
                  ->setPassword($mail['password']);

        $message = new \Swift_Message();
        $message->setSubject($subject);
        $message->setFrom($mail['from']);
        $message->setBody($body);

        // 发送邮件用户
        if ($to_mails) {
            foreach ($to_mails as $v) {
                $message->setTo($v['mail'], $v['name']);
            }
        }

        // 发送附件
        if ($attachments) {
            foreach ($attachments as $attachment) {
                $message->attach(\Swift_Attachment::fromPath($attachment['path']));
            }
        }

        $mailer = new \Swift_Mailer($transport);
        $res = (bool)$mailer->send($message);

        return $res;
    }

}
