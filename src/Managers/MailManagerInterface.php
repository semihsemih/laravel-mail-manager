<?php

namespace BinaryBuilds\LaravelMailManager\Managers;

use BinaryBuilds\LaravelMailManager\Models\MailManagerMail;

/**
 * Interface MailManagerInterface
 */
interface MailManagerInterface
{
    /**
     * @return mixed
     */
    public static function handleMailSendingEvent($event);

    /**
     * @return mixed
     */
    public static function handleMailSentEvent($event);

    public static function resendMail(MailManagerMail $mail);
}
