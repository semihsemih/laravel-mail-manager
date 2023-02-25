<?php

namespace BinaryBuilds\LaravelMailManager\Managers;

use BinaryBuilds\LaravelMailManager\Models\MailManagerMail;

/**
 * Class MailManager
 */
class MailManager
{
    /**
     * @param  \BinaryBuilds\LaravelMailManager\Managers\MailManagerInterface  $mail_manager
     */
    public static function handleMailSendingEvent(MailManagerInterface $mail_manager, $event)
    {
        if (! is_array(config('mail_manager.ignore')) || ! in_array(get_class($event), config('mail_manager.ignore'))) {
            $mail_manager->handleMailSendingEvent($event);
        }
    }

    /**
     * @param  \BinaryBuilds\LaravelMailManager\Managers\MailManagerInterface  $mail_manager
     */
    public static function handleMailSentEvent(MailManagerInterface $mail_manager, $event)
    {
        if (! is_array(config('mail_manager.ignore')) || ! in_array(get_class($event), config('mail_manager.ignore'))) {
            $mail_manager->handleMailSentEvent($event);
        }
    }

    public static function resendMail(MailManagerMail $mail)
    {
        if ($mail->is_notification) {
            NotificationManager::resendMail($mail);
        } else {
            MailableManager::resendMail($mail);
        }
    }

    public static function resendMailById($id)
    {
        $mail = MailManagerMail::find($id);

        if ($mail) {
            self::resendMail($mail);
        }
    }

    public static function resendMailByUuid($uuid)
    {
        $mail = MailManagerMail::whereUuid($uuid)->first();

        if ($mail) {
            self::resendMail($mail);
        }
    }

    /**
     * @return int
     */
    public static function resendUnsentMails()
    {
        $mails = MailManagerMail::whereIsSent(false)->get();

        foreach ($mails as $mail) {
            self::resendMail($mail);
        }

        return $mails->count();
    }

    /**
     * @return int
     */
    public static function pruneMails($date)
    {
        return MailManagerMail::where('created_at', '<=', $date)->delete();
    }
}
